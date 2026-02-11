<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Inventory;
use App\Models\Company;
use App\Models\Terminal;
use App\Models\Vessel;
use App\Models\Product;
use App\Models\ClearingAgent;
use App\Models\InventoryBL;
use App\Models\Business;
use App\Models\Document;
use App\Models\Surveyor;
use App\Models\LocalContract;
use App\Models\SalesRequest;
use App\Models\CommingleBL;
use App\Models\InventoryStock;
use App\Models\VesselAllocation;
use File;
use DataTables;
use Illuminate\Http\Request;
use DB;
use Spatie\Activitylog\Models\Activity;

class InventoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
         $this->middleware('permission:inventory-list|inventory-create|inventory-edit|inventory-delete|inventory-delete-bl|inventory-update-bl|inventory-add-document|inventory-delete-document|inventory-show-bl|inventory-show', ['only' => ['index','store']]);
         $this->middleware('permission:inventory-create', ['only' => ['create','store']]);
         $this->middleware('permission:inventory-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:inventory-delete', ['only' => ['destroy']]);
         $this->middleware('permission:inventory-delete-bl', ['only' => ['delete_bl']]);
         $this->middleware('permission:inventory-update-bl', ['only' => ['update_bl']]);
         $this->middleware('permission:inventory-add-document', ['only' => ['add_doc']]);
         $this->middleware('permission:inventory-delete-document', ['only' => ['delete_doc']]);
         $this->middleware('permission:inventory-show-bl', ['only' => ['show_bl']]);
         $this->middleware('permission:inventory-show', ['only' => ['show']]);         
    }


    public function index()
    {
        // $inventories = Inventory::orderBy('company_id', 'ASC')->orderBy('arrival_date', 'DESC')->get();
        $inventories = InventoryStock::with('inventory')->get()->groupBy(['inventory_id','product_id'])->sortBy(['inventory.arrival_date'],'ASC');
        $sellers = Company::where('local','1')->get();
        $vessels = Vessel::all();
        $products = Product::all();
        $anEloquentModel = new Inventory;
        
        activity()
        ->performedOn($anEloquentModel)
        ->causedBy(auth()->user()->id)
        ->inLog('inventory_list')
        ->log('User Viewed the Inventory List');
        return view('pages.inventories.index',compact('inventories','sellers','vessels','products'));
    }

    public function liftings($id)
    {
        $sales = SalesRequest::whereIn('status',[1,2])->where('inventory_id',$id)->get();
        return view('pages.inventories.lifting',compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sellers = Company::where('local','1')->get();
        $terminals = Terminal::all();
        $vessels = Vessel::all();
        $products = Product::all();
        $clearing_agents = ClearingAgent::all();
        $buyers = Business::get();
        $surveyors = Surveyor::get();

        $anEloquentModel = new Inventory;
        activity()
        ->performedOn($anEloquentModel)
        ->causedBy(auth()->user()->id)
        ->inLog('inventory_create')
        ->log('User visited to Inventory create');
        return view('pages.inventories.create', compact('surveyors','sellers','products','terminals','vessels','clearing_agents','buyers'));
    }

    public function view_inv($id)
    {
        $inventory = Inventory::find($id);
        $stocks = $inventory->stocks;
        $sellers = Company::where('local','1')->get();
        $terminals = Terminal::all();
        $vessels = Vessel::all();
        $products = Product::all();
        $clearing_agents = ClearingAgent::all();
        $buyers = Business::get();
        $surveyors = Surveyor::get();
        return view('pages.inventories.view',compact('inventory','stocks','sellers','terminals','vessels','products','clearing_agents','buyers','surveyors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required',
            'transaction_type' => 'required',
            'company_id' => 'required',
            'buyer_id' => 'required',
            'vessel_id' => 'required',
            'vessel_qty' => 'required',
            'inventory_stock' => 'required'
        ]);
        
        if ($request->voyage_number && $request->igm_date && $request->arrival_date) {
            $exists = Inventory::where('company_id',$request->company_id)
                ->where('vessel_id',$request->vessel_id)
                ->where('igm_date',$request->igm_date)
                ->where('arrival_date',$request->arrival_date)
                ->where('voyage_number',$request->voyage_number)->first();
        }

        if (isset($exists)) {

            if ($exists) {
                return redirect()->back()->with('error','This Inventory Already Exist!');
            }
        }

        if(!empty($request->input('inventory_stock')))
         {
            $terminal_shortage = 0;
            $terminal_qty = 0;
            
            foreach ($request->input('inventory_stock') as $key => $value) {
                $terminal_shortage += $value['terminal_shortage'];
            }

            foreach ($request->input('inventory_stock') as $key => $value) {
                $terminal_qty += $value['terminal_quantity'];
            }
            $terminal_shortage = number_format($terminal_shortage,3);

            if ($request->vessel_shortage) {
                if ($terminal_qty == $request->vessel_qty && $terminal_shortage < $request->vessel_shortage) {
                    return back()->with('error','Vessel Shortage does not match with Terminal stock shortage!')->withInput(); 
                }

                if ($terminal_shortage > $request->vessel_shortage) {
                    return back()->with('error','Terminal Shortage Qty can not be greater than Vessel Shortage Qty')->withInput();
                }

                if ($terminal_qty > $request->vessel_qty) {
                    return back()->with('error','Terminal Qty can not be greater than Vessel Qty')->withInput();
                }
                
                if(($request->vessel_shortage == $terminal_shortage) && ($request->vessel_qty != $terminal_qty)) {
                    return back()->with('error','Terminal Qty should be equal to Vessel Qty')->withInput();
                }
            }

         }
        
        DB::beginTransaction();
         try {
            $inventory = new Inventory();
            $inventory->voyage_number = $request->voyage_number;
            $inventory->company_id = $request->company_id;
            $inventory->product_id = $request->product_id;
            $inventory->terminal_id = $request->terminal_id;
            $inventory->vessel_id = $request->vessel_id;
            $inventory->buyer_id = $request->buyer_id;
            $inventory->clearing_agent_id = $request->clearing_agent_id;
            $inventory->type = $request->type;
            $inventory->transaction_type = $request->transaction_type;
            $inventory->igm_date = $request->igm_date;
            $inventory->arrival_date = $request->arrival_date;
            $inventory->vessel_shortage = $request->vessel_shortage;
            $inventory->vessel_qty = $request->vessel_qty;
            $inventory->chartered_party = $request->chartered_party;
            $inventory->active_contract = $request->active_contract ?? '0';
            $inventory->surveyor_id = $request->surveyor_id;
            $inventory->save();

        if(!empty($request->input('inventory_stock')))
         {
             $inventory->stocks()->createMany($request->input('inventory_stock'));
         }

        if ($request->hasFile('summary')) {
            $docs_summary  = new Document;
            $docs_summary->documentable_id = $inventory->id;
            $file = $request->summary;
            $filename = time().'_'.$file->getClientOriginalName();

            $location = public_path('documents/summary/');

            $file->move($location,$filename);
            $docs_summary->document = $filename;
            $docs_summary->type = 'summary';
            $docs_summary->documentable_type = "App\Models\Inventory";
            $docs_summary->save();
        }

        if ($request->hasFile('pro_data')) {
            $docs_pro_data = new Document;
            $docs_pro_data->documentable_id = $inventory->id;
            $file = $request->pro_data;
            $filename = time().'_'.$file->getClientOriginalName();

            $location = public_path('documents/pro_data/');

            $file->move($location,$filename);
            $docs_pro_data->document = $filename;
            $docs_pro_data->type = 'pro_data';
            $docs_pro_data->documentable_type = "App\Models\Inventory";
            $docs_pro_data->save();
        }

        
        if ($request->hasFile('survey_report')) {
            foreach($request->survey_report as $file) {
                $docs_survey_report = new Document;
                $docs_survey_report->documentable_id = $inventory->id;
                $filename = time().'_'.$file->getClientOriginalName();
    
                $location = public_path('documents/survey_report/');
    
                $file->move($location,$filename);
                $docs_survey_report->document = $filename;
                $docs_survey_report->type = 'survey_report';
                $docs_survey_report->documentable_type = "App\Models\Inventory";
                $docs_survey_report->save();
            }
        }

         if(!empty($request->input('inventory_bls')))
         {
             $bls = $inventory->bls()->createMany($request->input('inventory_bls'));
             $inventory_quantity = Inventory::find($inventory->id);
             $inventory_quantity->bl_quantity = $bls->sum('bl_quantity');
             $inventory_quantity->update();

        foreach ($request->inventory_bls as $key => $bl) {
            
            if (array_key_exists("bl_document",$bl)) {
                $docs_bl_document  = new Document;
                $docs_bl_document->documentable_id = $bls[$key]['id'];
                $file = $bl['bl_document'];
                $filename = time().'_'.$file->getClientOriginalName();

                $location = public_path('documents/document');

                $file->move($location,$filename);
                $docs_bl_document->document = $filename;
                $docs_bl_document->type = 'document';
                $docs_bl_document->documentable_type = 'App\Models\InventoryBL';
                $docs_bl_document->save();
            }
                

            if (array_key_exists("commercial_invoice",$bl)) {
                $docs_commercial_invoice  = new Document;
                $docs_commercial_invoice->documentable_id = $bls[$key]['id'];            
                $file = $bl['commercial_invoice'];
                $filename = time().'_'.$file->getClientOriginalName();

                $location = public_path('documents/commercial_invoice/');

                $file->move($location,$filename);
                $docs_commercial_invoice->document = $filename;
                $docs_commercial_invoice->type = 'commercial_invoice';
                $docs_commercial_invoice->documentable_type = 'App\Models\InventoryBL';
                $docs_commercial_invoice->save();
            }


            if (array_key_exists("bl",$bl)) {
                $docs_bl  = new Document;
                $docs_bl->documentable_id = $bls[$key]['id'];
                $file = $bl['bl'];
                $filename = time().'_'.$file->getClientOriginalName();

                $location = public_path('documents/BL/');

                $file->move($location,$filename);
                $docs_bl->document = $filename;
                $docs_bl->type = 'BL';
                $docs_bl->documentable_type = 'App\Models\InventoryBL';
                $docs_bl->save();
            }


            if (array_key_exists("shipping_do",$bl)) {
                $docs_shipping_do  = new Document;
                $docs_shipping_do->documentable_id = $bls[$key]['id'];
                $file = $bl['shipping_do'];
                $filename = time().'_'.$file->getClientOriginalName();

                $location = public_path('documents/shipping_do/');

                $file->move($location,$filename);
                $docs_shipping_do->document = $filename;
                $docs_shipping_do->type = 'shipping_do';
                $docs_shipping_do->documentable_type = 'App\Models\InventoryBL';
                $docs_shipping_do->save();
            }
        }

        }

        DB::commit();
        if ($request->redirection_type == 'add-another') {
            return redirect()->back();
        }
        else {
            return redirect('inventories/'.$inventory->id.'/show')->with('status', 'Inventory Added.');
        }
    }    
        catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error',"Entered record could not save!")->withInput();
         }
    }

    public function add_stock(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            
        $inventory = Inventory::findOrFail($id);
        $exists = InventoryStock::where('inventory_id',$id)
                            ->where('product_id',$request->product_id)
                            ->where('terminal_id',$request->terminal_id)
                            ->first();

        $total_shortage = $inventory->stocks()->sum('terminal_shortage') + $request->terminal_shortage;
        $total_qty = $inventory->stocks()->sum('terminal_quantity') + $request->terminal_quantity;
        
        if (!$exists) {
            if ($total_qty == $inventory->vessel_qty && $total_shortage < $inventory->vessel_shortage) {
                return back()->with('warning','You are not entering maximuim shortage!')->withInput(); 
            }
            if ($total_shortage <= $inventory->vessel_shortage && $total_qty <= $inventory->vessel_qty) {
                $inventory->stocks()->create([
                    'product_id' => $request->product_id,
                    'terminal_id' => $request->terminal_id,
                    'terminal_quantity' => $request->terminal_quantity,
                    'terminal_shortage' => $request->terminal_shortage,
                    'remarks' => $request->remarks
                ]);
            }
            else {
                return back()->with('warning','You have exceed the quantity limit from Vessel!');
            }
        }
        else {
            return back()->with('warning','This Stock Already Exist!');
        }
        DB::commit();
    }
        catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('warning','Entered record could not save!');
        }

        return back()->with('success','Terminal Stock Created!');
    }

    public function update_stock(Request $request, $id)
    {
        DB::beginTransaction();
        try {
            
        $stock = InventoryStock::findOrFail($id);

        $stock->update([
            'product_id' => $request->product_id,
            'terminal_id' => $request->terminal_id,
            'terminal_quantity' => $request->terminal_quantity,
            'terminal_shortage' => $request->terminal_shortage,
            'remarks' => $request->remarks
        ]);

        DB::commit();
        return back()->with('success','Terminal Stock Updated!');
    }
        catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('warning','Updated record could not save!');
        }
    }

    public function search_bl(Request $request)
    {
        $this->validate($request,[
            'bl_number' => 'required'
        ]);

        $inventory_bl = InventoryBL::where('bl_number',$request->bl_number)->first();
        if ($inventory_bl) {
            return redirect('inventories/'.$inventory_bl->inventory_id.'/show?bl_id='.$inventory_bl->id);
        }
        else {
            return redirect('inventories')->with('error','No BL Found!');
        }
    }

    public function delete_stock($id)
    {
        $stock = InventoryStock::findOrFail($id);
        $stock->delete();
        return back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        if ($request->ajax()) {
            $inv = Inventory::find($id);
            $data = $inv->bls;
            $bl_qty = $inv->bls->sum('bl_quantity');
            $landed_qty = number_format($inv->bls->sum('landed_quantity'),3);
            $lifted_qty = $inv->bls->sum('lifted');
            $bl_shortage = 0;
            foreach ($data as $key => $bl) {
                $bl_shortage += $bl->shortage_status() ?? 0;    
            }
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->with([
                        'bl_qty' => $bl_qty,
                        'landed_qty' => $landed_qty,
                        'bl_shortage' => $bl_shortage,
                        'lifted_qty' => $lifted_qty
                    ])
                    ->addColumn('action', function($row) {
     
                        $btn = '<div class="dropdown">';
                        $btn.= '<button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">';
                        $btn.= '';
                        $btn.= '</button>';
                        $btn.= '<ul class="dropdown-menu">';
                        $btn.= '<li><a data-info="'.url('get-bl',$row->id).'" data-route="'.route('inventory.bls.update',$row->id).'" class="dropdown-item edit-bl" href="javascript:void(0);">Edit</a></li>';
                        $btn.= '<li><a class="dropdown-item" id="delete-bl" data-route="'.route('inventory.bls.delete',$row->id).'" href="javascript:void(0);">Delete</a></li>';
                        $btn.= '<li><a class="dropdown-item commingle-btn" data-route="'.route('get.bls.commingle',$row->id).'" href="javascript:void(0);">Commingle</a></li>';
                        $btn.= '<li><a class="dropdown-item" href="'.route('bl.view',$row->id).'">View</a></li>';
                        $btn.= '</ul>';
                        $btn.= '</div>';
                        return $btn;
                    })
                    ->addColumn('product_name', function($row) {
                        if (count($row->commingle_bls) > 0) {
                            return $row->product->code.'<sup>[c]</sup>' ?? '--';
                        }
                        else {
                            return $row->product->code ?? '--';
                        }
                    })
                    ->addColumn('terminal_name', function($row) {
                        return $row->terminal->code ?? '--';
                    })
                    ->addColumn('shortage', function($row) {
                        return $row->shortage_status() ?? '--';
                    })
                    ->addColumn('lifted', function($row) {
                        return number_format($row->unlifted_qty(),3) ?? '0';
                    })
                    ->addColumn('balance_qty', function($row) {
                        return number_format($row->unsold_qty(),3) ?? '--';
                    })
                    ->addColumn('checkbox',function($row) {
                        $checkbox = '<input type="checkbox" data-id="'.$row->id.'" class="form-check-input select-bl">';
                        return $checkbox;
                    })
                    ->rawColumns(['action','product_name','terminal_name','checkbox'])
                    ->make(true);
        }


        $inventory = Inventory::find($id);
        $bls = $inventory->bls;
        $stocks = $inventory->stocks;
        $stock_products = $stocks->pluck('product_id')->toArray();
        $stock_terminals = $stocks->pluck('terminal_id')->toArray();
        $terminals = Terminal::whereIn('id',$stock_terminals)->get();
        $products = Product::whereIn('id',$stock_products)->get();
        $banks = BankAccount::all();
        $all_products = Product::all();
        $all_terminals = Terminal::all();
        $doc_summary = $inventory->documents->where('type','summary')->first();
        $doc_pro_data = $inventory->documents->where('type','pro_data')->first();
        $doc_survey_report = $inventory->documents->where('type','survey_report')->first();
        $documents_count = 0;
        if ($doc_summary) {
            $documents_count++;
        }
        if ($doc_pro_data) {
            $documents_count++;
        }
        if ($doc_survey_report) {
            $documents_count++;
        }

        if ($request->has('bl_id')) {
            $bl_id = InventoryBL::find($request->bl_id);
        }
        else {
            $bl_id = false;
        }

        $anEloquentModel = new Inventory;
        activity()
        ->performedOn($anEloquentModel)
        ->causedBy(auth()->user()->id)
        ->inLog('inventory_show')
        ->log('User Viewed the Inventory details');
        return view('pages.inventories.show',compact('inventory','terminals','products','doc_summary','doc_pro_data','doc_survey_report','documents_count','bls','stocks','all_terminals','all_products','banks','bl_id'));
    }

    public function getBL($id)
    {
        $bl = InventoryBL::find($id);
        return response()->json($bl);
    }

    public function getInv($id)
    {
        $inv = Inventory::with('bls')->find($id);
        return response()->json($inv);
    }

    public function get_commingle($id)
    {
        $inv_bl = InventoryBL::find($id);
        $terminals = Terminal::get();
        $commingles = '<form action="'.route('save.bls.commingle',$inv_bl->id).'" id="commingle-save-form" method="POST">';
        $commingles .= csrf_field();
        $commingles .= '<div id="kt_docs_repeater_basic" class="commingle-terminal-col">';
        $commingles .= '<div class="form-group">';
        $commingles .= '<div class="my-5" data-repeater-list="commingle_terminals">';

        foreach ($inv_bl->commingle_bls as $key => $commingle) {
            $commingles .= '<div class="border-1 rounded-3 my-5 border-secondary border p-3 border-secondary commingle-item" data-repeater-item>';
            $commingles .= '<div class="form-group row gy-3	">';
            $commingles .= '<div class="col-md-12 text-end">';
            $commingles .= '<a href="javascript:;" class="btn btn-sm btn-light-danger mt-3 mt-md-8 destroy-commingle" data-route="'.route('commingle.delete',$commingle->id).'">';
            $commingles .= '<i class="ki-duotone ki-trash fs-5"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i>';
            $commingles .= 'Delete';
            $commingles .= '</a>';
            $commingles .= '</div>';
            $commingles .= '<input type="hidden" name="commingle_id[]" value="'.$commingle->id.'">';
            $commingles .= '<div class="col-md-12">';
            $commingles .= '<label class="form-label">Commingle Terminal</label>';
            $commingles .= '<select name="commingle_terminal_id[]" id="commingle_terminal" class="form-select" required>';
            $commingles .= '<option selected disabled value="">-- Select --</option>';
            foreach ($terminals as $key => $terminal) {
                $commingles .= '<option '.($terminal->id == $commingle->terminal_id ? 'selected' : '').' value="'.$terminal->id.'">'.$terminal->code.'</option>';
            }
            $commingles .= '</select>';
            $commingles .= '</div>';
            $commingles .= '<div class="col-md-12">';
            $commingles .= '<label class="form-label">Terminal Quantity:</label>';
            $commingles .= '<input type="number" required name="commingle_quantity[]" value="'.$commingle->quantity.'" class="form-control mb-2 mb-md-0 all-terminal-qty" placeholder="Enter Terminal Quantity" step=".0001" />';
            $commingles .= '</div>';
            $commingles .= '</div>';
            $commingles .= '</div>';
        }

        $commingles .= '</div>';
        $commingles .= '</div>';
        $commingles .= '<div class="form-group mt-5">';
        $commingles .= '<a href="javascript:;" data-repeater-create class="btn btn-light-primary add-commingle-item">';
        $commingles .= '<i class="ki-duotone ki-plus fs-3"></i>';
        $commingles .= 'Add Commingle Terminal';
        $commingles .= '</a>';
        $commingles .= '</div>';
        $commingles .= '</div>';
        $commingles .= '</form>';

        return $commingles;
    }

    public function save_commingle(Request $request,$id)
    {
        $inv_bl = InventoryBL::find($id);
        $terminal_ids = $request->commingle_terminal_id;
        $quantities = $request->commingle_quantity;

        $total_qty = array_sum($quantities) + $inv_bl->terminal_quantity;
        
        if (in_array(null,  $quantities, true) || in_array('', $quantities, true)) {
            return back()->with('warning','Quantity can not be null!');
        }
        if (in_array(null,  $terminal_ids, true) || in_array('', $terminal_ids, true)) {
            return back()->with('warning','Terminal can not be null!');
        }

        if ($total_qty == $inv_bl->landed_quantity) {
            
            foreach ($request->commingle_id as $key => $id) {
                if ($id != 0) {
                    $commingle = CommingleBL::find($id);
                    $commingle->terminal_id = $terminal_ids[$key]; 
                    $commingle->quantity = $quantities[$key];
                    $commingle->update();
                }
                else {
                    $commingle = new CommingleBL();
                    $commingle->bl_id = $inv_bl->id; 
                    $commingle->terminal_id = $terminal_ids[$key]; 
                    $commingle->quantity = $quantities[$key];
                    $commingle->save();
                }
            }

        }
        else {
            return back()->with('warning','Sum of Commingle should cover terminal quantity!');
        }
        

        return back()->with('success','Commingle Saved!');
    }

    public function show_bl($id)
    {
        $inventory = Inventory::find($id);
        return view('pages.inventories.show_bl',compact('inventory'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Inventory $inventory)
    {
        $sellers = Company::where('local','1')->get();
        $terminals = Terminal::all();
        $vessels = Vessel::all();
        $products = Product::all();
        $buyers = Business::all();
        $clearing_agents = ClearingAgent::all();
        $surveyors = Surveyor::get();
        $doc_summary = $inventory->documents->where('type','summary')->first();
        $doc_pro_data = $inventory->documents->where('type','pro_data')->first();
        $doc_survey_report = $inventory->documents->where('type','survey_report')->first();
        $documents_count = 0;
        if ($doc_summary) {
            $documents_count++;
        }
        if ($doc_pro_data) {
            $documents_count++;
        }
        if ($doc_survey_report) {
            $documents_count++;
        }

        $anEloquentModel = new Inventory;
        activity()
        ->performedOn($anEloquentModel)
        ->inLog('inventory_edit')
        ->causedBy(auth()->user()->id)
        ->log('User visited the Edit Inventory window');
        return view('pages.inventories.edit', compact('inventory','sellers','terminals','vessels','products','clearing_agents','buyers','surveyors','doc_summary','doc_pro_data','doc_survey_report','documents_count'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Inventory $inventory)
    {
        if (empty($request->input('inventory_stock'))) {
                $request['inventory_stock'] = [];
        }
            $terminal_shortage = $inventory->stocks->sum('terminal_shortage');
            $terminal_qty = $inventory->stocks->sum('terminal_quantity');
            
            foreach ($request->input('inventory_stock') as $key => $value) {
                $terminal_shortage += $value['terminal_shortage'];
            }

            foreach ($request->input('inventory_stock') as $key => $value) {
                $terminal_qty += $value['terminal_quantity'];
            }
            
            $terminal_shortage = number_format($terminal_shortage,3);
            
            if ($request->vessel_shortage) {
                if ($terminal_qty == $request->vessel_qty && $terminal_shortage < $request->vessel_shortage) {
                    return back()->with('error','Vessel Shortage does not match with Terminal stock shortage!')->withInput(); 
                }

                if ($terminal_shortage > $request->vessel_shortage) {
                    return back()->with('error','Terminal Shortage Qty can not be greater than Vessel Shortage Qty')->withInput();
                }

                if ($terminal_qty > $request->vessel_qty) {
                    return back()->with('error','Terminal Qty can not be greater than Vessel Qty')->withInput();
                }
                
                if(($request->vessel_shortage == $terminal_shortage) && ($request->vessel_qty != $terminal_qty)) {
                    return back()->with('error','Terminal Qty should be equal to Vessel Qty')->withInput();
                }
            }
         
        DB::beginTransaction();
        try {

        $inventory->voyage_number = $request->voyage_number;
        $inventory->company_id = $request->company_id;
        $inventory->product_id = $request->product_id;
        $inventory->terminal_id = $request->terminal_id;
        $inventory->vessel_id = $request->vessel_id;
        $inventory->buyer_id = $request->buyer_id;
        $inventory->clearing_agent_id = $request->clearing_agent_id;
        $inventory->type = $request->type;
        $inventory->transaction_type = $request->transaction_type;
        $inventory->igm_date = $request->igm_date;
        $inventory->arrival_date = $request->arrival_date;
        $inventory->vessel_shortage = $request->vessel_shortage;
        $inventory->vessel_qty = $request->vessel_qty;
        $inventory->chartered_party = $request->chartered_party;
        $inventory->contract_date = $request->contract_date;
        $inventory->active_contract = $request->active_contract ?? '0';
        $inventory->surveyor_id = $request->surveyor_id;
        $inventory->update();

        if(!empty($request->input('inventory_stock')))
         {
            $inventory->stocks()->createMany($request->input('inventory_stock'));
         }

         if ($request->hasFile('summary')) {
            $docs_summary  = new Document;
            $docs_summary->documentable_id = $inventory->id;
            $file = $request->summary;
            $filename = time().'_'.$file->getClientOriginalName();

            $location = public_path('documents/summary/');

            $file->move($location,$filename);
            $docs_summary->document = $filename;
            $docs_summary->type = 'summary';
            $docs_summary->documentable_type = "App\Models\Inventory";
            $docs_summary->save();
        }

        if ($request->hasFile('pro_data')) {
            $docs_pro_data = new Document;
            $docs_pro_data->documentable_id = $inventory->id;
            $file = $request->pro_data;
            $filename = time().'_'.$file->getClientOriginalName();

            $location = public_path('documents/pro_data/');

            $file->move($location,$filename);
            $docs_pro_data->document = $filename;
            $docs_pro_data->type = 'pro_data';
            $docs_pro_data->documentable_type = "App\Models\Inventory";
            $docs_pro_data->save();
        }

        
        if ($request->hasFile('survey_report')) {
            $files = $request->file('survey_report');
            foreach($request->survey_report as $file) {
                $docs_survey_report = new Document;
                $docs_survey_report->documentable_id = $inventory->id;
                $filename = time().'_'.$file->getClientOriginalName();
    
                $location = public_path('documents/survey_report/');
    
                $file->move($location,$filename);
                $docs_survey_report->document = $filename;
                $docs_survey_report->type = 'survey_report';
                $docs_survey_report->documentable_type = "App\Models\Inventory";
                $docs_survey_report->save();
            }
        }

        DB::commit();
        return redirect('inventories/'.$inventory->id.'/edit')->with('status', 'Inventory Updated.');
    }
        catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error','Inventory was unable to update!');
        }
    }

    public function add_bls(Request $request, $id)
    {
        $validated = $request->validate([
            'product_id' => 'required',
            'date' => 'required',
            'bl_number' => 'required|unique:inventory_bls,bl_number',
            'bl_quantity' => 'required',
            'landed_quantity' => 'required',
            'terminal_quantity' => 'required',
            'provisional_price' => 'required'
        ]);
        
        $inventory = Inventory::find($id);

        if ($request->terminal_id != '' || $request->terminal_id != null) {
            $stock = InventoryStock::where('inventory_id',$id)
                        ->where('product_id',$request->product_id)
                        ->where('terminal_id',$request->terminal_id)
                        ->first();
            if(!$stock){
                return response()->json(['error' => 'Terminal Stock does not exist!'], 404);
            }
        }
        else {
            $stock = InventoryStock::where('inventory_id',$id)
                        ->where('product_id',$request->product_id)
                        ->first();
        }
                            
        
        $bls = InventoryBL::where('inventory_id',$id)
                ->where('product_id',$request->product_id)
                ->where('terminal_id',$request->terminal_id)
                ->get();
        
        $bl_quantity = $bls->sum('bl_quantity') + $request->bl_quantity;
        $shortage_bl = 0;
        
        foreach ($bls as $bl) {
            $shortage_bl +=  $bl->shortage_status() ?? 0;
        }
        $shortage_bl += $request->bl_quantity - $request->landed_quantity;
        
        $shortage_bl = round($shortage_bl,3);

        if ($bl_quantity > $stock->terminal_quantity) {
            return response()->json(['error' => 'BL Quantity should not be greater than Terminal Stock Qty.'], 404);
        }

        if ($shortage_bl > $stock->terminal_shortage) {
            return response()->json(['error' => 'BL Shortage should not be greater than Terminal Shortage.'], 404);
        }

        if (($bl_quantity == $stock->terminal_quantity) && ($stock->terminal_shortage != $shortage_bl)) {
            return response()->json(['error' => 'BL Shortage should be equal to Terminal Shortage.'], 404);
        }

        DB::beginTransaction();
        try {
            
            $lastRecord = InventoryBL::where('inventory_id',$id)->first();
            $count = count(InventoryBL::where('inventory_id',$id)->get());
            if ($lastRecord) {
                $lastNumber = (int) substr($count, -3);
                $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $nextNumber = '001';
            }
            $inventory_bl = new InventoryBL();
            $inventory_bl->inventory_id = $id;
            $inventory_bl->serial_number = $nextNumber;
            $inventory_bl->date = $request->date;
            $inventory_bl->bl_number = $request->bl_number;
            $inventory_bl->index_number = $request->index_number;
            $inventory_bl->product_id = $request->product_id;
            $inventory_bl->terminal_id = $request->terminal_id;
            $inventory_bl->status = $request->status;
            $inventory_bl->bl_quantity = $request->bl_quantity;
            $inventory_bl->landed_quantity = $request->landed_quantity;
            $inventory_bl->terminal_quantity = $request->terminal_quantity;
            $inventory_bl->provisional_price = $request->provisional_price;
            $inventory_bl->bl_status = $request->bl_status;
            $inventory_bl->bank_id = $request->bank_id;
            $inventory_bl->payment_method = $request->payment_method;
            $inventory_bl->save();


            if (!empty($request->commingle_terminals)) {
                foreach ($request->commingle_terminals as $key => $commingle) {
                    $commingle_terminal = new CommingleBL();
                    $commingle_terminal->terminal_id = $commingle['commingle_terminal'];
                    $commingle_terminal->quantity = $commingle['commingle_quantity'];
                    $commingle_terminal->bl_id = $inventory_bl->id;
                    $commingle_terminal->save();
                }
            }

            if (isset($request->bl_document)) {
                $docs_bl_document  = new Document;
                $docs_bl_document->documentable_id = $inventory_bl->id;
                $file = $request->bl_document;
                $filename = time().'_'.$file->getClientOriginalName();

                $location = public_path('documents/document');

                $file->move($location,$filename);
                $docs_bl_document->document = $filename;
                $docs_bl_document->type = 'document';
                $docs_bl_document->documentable_type = 'App\Models\InventoryBL';
                $docs_bl_document->save();
            }
                

            if (isset($request->commercial_invoice)) {
                $docs_commercial_invoice  = new Document;
                $docs_commercial_invoice->documentable_id = $inventory_bl->id;            
                $file = $request->commercial_invoice;
                $filename = time().'_'.$file->getClientOriginalName();

                $location = public_path('documents/commercial_invoice/');

                $file->move($location,$filename);
                $docs_commercial_invoice->document = $filename;
                $docs_commercial_invoice->type = 'commercial_invoice';
                $docs_commercial_invoice->documentable_type = 'App\Models\InventoryBL';
                $docs_commercial_invoice->save();
            }


            if (isset($request->bl)) {
                $docs_bl  = new Document;
                $docs_bl->documentable_id = $inventory_bl->id;
                $file = $request->bl;
                $filename = time().'_'.$file->getClientOriginalName();

                $location = public_path('documents/BL/');

                $file->move($location,$filename);
                $docs_bl->document = $filename;
                $docs_bl->type = 'BL';
                $docs_bl->documentable_type = 'App\Models\InventoryBL';
                $docs_bl->save();
            }


            if (isset($request->shipping_do)) {
                $docs_shipping_do  = new Document;
                $docs_shipping_do->documentable_id = $inventory_bl->id;
                $file = $request->shipping_do;
                $filename = time().'_'.$file->getClientOriginalName();

                $location = public_path('documents/shipping_do/');

                $file->move($location,$filename);
                $docs_shipping_do->document = $filename;
                $docs_shipping_do->type = 'shipping_do';
                $docs_shipping_do->documentable_type = 'App\Models\InventoryBL';
                $docs_shipping_do->save();
            }
        DB::commit();
        return response()->json(['success' => 'BL Added Successfully', 'product_name' => $inventory_bl->product->name, 'bl_number' => $inventory_bl->bl_number, 'bl_quantity' => $inventory_bl->bl_quantity]);
    }
        catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Entered record could not save!']);
        }
    }

    public function edit_terminal(Request $request)
    {
        $edit_bls = $request->bls;
        foreach ($edit_bls as $key => $id) {
            $bl = InventoryBL::find($id);


        $stock = InventoryStock::where('inventory_id',$bl->inventory_id)
                    ->where('product_id',$bl->product_id)
                    ->where('terminal_id',$request->terminal_id)
                    ->first();
                            
        
        $bls = InventoryBL::where('inventory_id',$bl->inventory_id)
                ->where('product_id',$bl->product_id)
                ->where('terminal_id',$request->terminal_id)
                ->get();
        $bl_quantity = $bls->sum('bl_quantity') + $bl->bl_quantity;
        $shortage_bl = 0;
        
        foreach ($bls as $bl) {
            $shortage_bl +=  $bl->shortage_status() ?? 0;
        }
        $shortage_bl += $bl->bl_quantity - $bl->landed_quantity;

        if ($bl_quantity > $stock->terminal_quantity) {
            return response()->json(['error' => 'BL Quantity should not be greater than Terminal Stock Qty.'], 404);
        }

        if ($shortage_bl > $stock->terminal_shortage) {
            return response()->json(['error' => 'BL Shortage should not be greater than Terminal Shortage.'], 404);
        }

        if (($bl_quantity == $stock->terminal_quantity) && ($stock->terminal_shortage != $shortage_bl)) {
            return response()->json(['error' => 'BL Shortage should be equal to Terminal Shortage.'], 404);
        }


            $bl->terminal_id = $request->terminal_id;
            $bl->update();
        }
        return response()->json(['success' => 'Terminal Moved !']);
    }

    public function detail($id)
    {
        $inventory = Inventory::find($id);
        $contracts = LocalContract::where('inventory_id',$inventory->id)->get();
        return view('pages.inventories.detail',compact('inventory','contracts'));
    }

    public function view_bl($id)
    {
        $bl = InventoryBL::find($id);
        return view('pages.inventories.view_bl',compact('bl'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Inventory $inventory)
    {
        $contracts = LocalContract::where('inventory_id', $inventory->id)->get();
        if ($contracts->count() > 0) {
            return back()->with('error','This Inventory contain contracts');
        }
        else {
            $inventory->delete();
        }
        $anEloquentModel = new Inventory;
        activity()
        ->performedOn($anEloquentModel)
        ->inLog('inventory_delete')
        ->causedBy(auth()->user()->id)
        ->withProperties(['inventory_id' => $inventory->id])
        ->log('Inventory Deleted by '.auth()->user()->name);
        return back();
    }

    public function update_bl(Request $request, $id)
    {
        $inventory_bl = InventoryBL::findOrFail($id);

        // if ($inventory_bl->serial_number == null) {
        //     $lastRecord = InventoryBL::first();
        //     $count = count(InventoryBL::where('inventory_id',$inventory_bl->inventory_id)->get());
        //     if ($lastRecord) {
        //         $lastNumber = (int) substr($count, -3);
        //         $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        //     } else {
        //         $nextNumber = '001';
        //     }
        // }
        DB::beginTransaction();
        try {
        $inventory_bl->serial_number = $request->serial_number; 
        $inventory_bl->product_id = $request->product_id; 
        $inventory_bl->terminal_id = $request->terminal_id; 
        $inventory_bl->date = $request->date; 
        $inventory_bl->bl_number = $request->bl_number; 
        $inventory_bl->index_number = $request->index_number; 
        $inventory_bl->bl_quantity = $request->bl_quantity; 
        $inventory_bl->landed_quantity = $request->landed_quantity; 
        $inventory_bl->terminal_quantity = $request->terminal_quantity; 
        $inventory_bl->provisional_price = $request->provisional_price; 
        $inventory_bl->status = $request->status ?? 0;
        $inventory_bl->bl_status = $request->bl_status;
        $inventory_bl->bank_id = $request->bank_id;
        $inventory_bl->payment_method = $request->payment_method;
        $inventory_bl->update();
        
        if($request->hasFile('bl_document'))
        {
            $document = Document::where('documentable_id',$inventory_bl->id)->where('type','document')->first();
            $path = 'public/documents/document/'.$document->document;
            if(File::exists($path)){
                File::delete($path);
            }
            
                $file = $request->bl_document;
                $filename = time().'_'.$file->getClientOriginalName();

                $location = public_path('documents/document/');

                $file->move($location,$filename);
                $document->document = $filename;
                $document->update();
        }

        if($request->hasFile('commercial_invoice'))
        {
            $document = Document::where('documentable_id',$inventory_bl->id)->where('type','Commercial Invoice')->first();
            $path = 'public/documents/commercial_invoice/'.$document->document;
            if(File::exists($path)){
                File::delete($path);
            }
            
                $file = $request->commercial_invoice;
                $filename = time().'_'.$file->getClientOriginalName();

                $location = public_path('documents/commercial_invoice/');

                $file->move($location,$filename);
                $document->document = $filename;
                $document->update();
        }

        if($request->hasFile('bl'))
        {
            $document = Document::where('documentable_id',$inventory_bl->id)->where('type','BL')->first();
            $path = 'public/documents/BL/'.$document->document;
            if(File::exists($path)){
                File::delete($path);
            }
            
                $file = $request->bl;
                $filename = time().'_'.$file->getClientOriginalName();

                $location = public_path('documents/BL/');

                $file->move($location,$filename);
                $document->document = $filename;
                $document->update();
        }

        if($request->hasFile('shipping_do'))
        {
            $document = Document::where('documentable_id',$inventory_bl->id)->where('type','Shipping d/o')->first();
            $path = 'public/documents/shipping_do/'.$document->document;
            if(File::exists($path)){
                File::delete($path);
            }
            
                $file = $request->shipping_do;
                $filename = time().'_'.$file->getClientOriginalName();

                $location = public_path('documents/shipping_do/');

                $file->move($location,$filename);
                $document->document = $filename;
                $document->update();
        }
        DB::commit();
        return response()->json(['success' => 'BL Updated successfully !']);
    }
        catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Updated record could not save!']);
        }
    }

    public function delete_doc($id)
    {
        $document = Document::find($id);
        $path = 'public/documents/'.$document->type.'/'.$document->document;
        if(File::exists($path)){
            File::delete($path);
        }
        $document->delete();
        return redirect()->back();
    }

    public function add_doc(Request $request)
    {
        $doc = new Document;
        $doc->type = $request->file_type;
        $doc->documentable_id = $request->inventory_id;
        $doc->documentable_type = "App\Models\Inventory";
        $file = $request->file;
        $filename = time().'_'.$file->getClientOriginalName();

        $location = public_path('documents/'.$request->file_type.'/');

        $file->move($location,$filename);
        $doc->document = $filename;
        $doc->save();
        return redirect()->back();
    }

    public function unsold_qty($id, $product)
    {
        $inventory = Inventory::find($id);
        $contracts = LocalContract::where('product_id',$product)->pluck('id')->toArray();
        $bl_quantity = InventoryBL::where('inventory_id', $inventory->id)->where('product_id',$product)->sum('landed_quantity');
        $sold_qty = VesselAllocation::whereIn('contract_id',$contracts)->where('inventory_id', $inventory->id)->sum('quantity');
        return $bl_quantity - $sold_qty;
    }

    public function delete_bl($id)
    {
        InventoryBL::destroy($id);
        return response()->json(['success' => 'Deleted successfully']);
    }

    public function delete_commingle($id)
    {
        CommingleBL::destroy($id);
        return response()->json(['success' => 'Deleted successfully']);
    }
}
