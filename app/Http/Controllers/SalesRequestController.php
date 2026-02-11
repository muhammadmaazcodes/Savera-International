<?php

namespace App\Http\Controllers;

use App\Models\InventoryStock;
use App\Models\Terminal;
use DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Models\SalesRequest;
use App\Models\InventoryBL;
use App\Models\Inventory;
use App\Models\LocalContract;
use App\Models\SaleContract;
use Yajra\DataTables\DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\SaleRequestExport;


class SalesRequestController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:sales-request-pending-list|sales-request-processing-list|sales-request-successful-list|sales-request-add-lifting|sales-request-add-contract|sales-request-edit', ['only' => ['index','store']]);
         $this->middleware('permission:sales-request-process-list', ['only' => ['process_index']]);
         $this->middleware('permission:sales-request-successful-list', ['only' => ['success_index']]);
         $this->middleware('permission:sales-request-add-lifting', ['only' => ['add_lifting']]);
         $this->middleware('permission:sales-request-add-contract', ['only' => ['contract_sale','contract_store']]);
         $this->middleware('permission:sales-request-edit', ['only' => ['edit','update']]);
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = SalesRequest::orderBy('created_at','desc')->where('status',0)->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        $showBtn = 'Lifting';
                        $btn = '<div class="dropdown sale-'.$row['id'].'">';
                        $btn.= '<button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">';
                        $btn.= '';
                        $btn.= '</button>';
                        $btn.= '<ul class="dropdown-menu">';
                        $btn.= '<li><a data-info="'.url('get-sale',$row->id).'" data-route="'.route('sales.update',$row->id).'" class="dropdown-item edit-bl" href="javascript:void(0);">Edit</a></li>';
                        $btn.= '<li><a class="dropdown-item" href="'.route('sales.delete',$row['id']).'">Delete</a></li>';
                        $btn.= '</ul>';
                        $btn.= '</div>';
                        return $btn;
                    })
                    ->addColumn('buyer_name', function($row){
                        $buyer = '<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#BuyerDashboard-'.$row->buyer_id.'">'.$row->buyer->name ?? '--'.'</a>';
                        return $buyer;
                    })
                    ->addColumn('vessel_name', function($row){
                        return $row->inventory->vessel->name ?? '--';
                    })
                    ->addColumn('product_name', function($row){
                        return $row->product->code ?? '--';
                    })
                    ->addColumn('terminal_name', function($row){
                        return $row->terminal->code ?? '--';
                    })
                    ->addColumn('quantity', function($row){
                        return number_format($row->quantity,3);
                    })
                    ->rawColumns(['action','buyer_name','vessel_name','product_name','terminal_name','quantity'])
                    ->make(true);
        }
        $products = Product::get();
        $buyers = Company::where('local',1)->get();
        $sales = SalesRequest::where('status',0)->get();
        $vessels = Inventory::get();
        $terminals = Terminal::get();
        return view('pages.sales-request.index',compact('products','buyers','sales','vessels','terminals'));
    }

    public function process_index(Request $request)
    {
        if ($request->ajax()) {
            $sales = SalesRequest::where('status',0)->get();
            if (count($sales) > 0) {
                foreach ($sales as $key => $sale) {
                    if (count($sale->lifting_bls) == 0) {
                        $data[] = array(
                            'id' => $sale->id,
                            'requested_sale_qty' => $sale->quantity,
                            'sale_lifted_qty' => $sale->lifting_bls->sum('quantity'),
                            'inventory_id' => $sale->inventory_id,
                            'product_code' => $sale->product->code,
                            'quantity' => $sale->quantity,
                            'vehicle_number' => $sale->vehicle_number,
                            'bl_number' => '--',
                            'bl_qty' => '--'
                        );
                    }
                    else {
                        foreach ($sale->lifting_bls as $bl_lifting) {
                            $data[] = array(
                                'id' => $sale->id,
                                'requested_sale_qty' => $sale->quantity,
                                'sale_lifted_qty' => $sale->lifting_bls->sum('quantity'),
                                'inventory_id' => $sale->inventory_id,
                                'product_code' => $sale->product->code,
                                'quantity' => $bl_lifting->quantity,
                                'vehicle_number' => $sale->vehicle_number,
                                'bl_number' => $bl_lifting->bl->bl_number,
                                'bl_qty' => number_format($bl_lifting->bl->unlifted_qty(),3) ?? '--'
                            );
                        }
                    }
                }
            }
            else {
                $data = [];
            }
            
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        $btn = '<div class="dropdown sale-'.$row['id'].'">';
                        $btn.= '<button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">';
                        $btn.= '';
                        $btn.= '</button>';
                        $btn.= '<ul class="dropdown-menu">';
                        $btn.= '<li><a data-info="'.url('get-sale',$row['id']).'" data-inv="'.url('get-inv/'.$row['inventory_id']).'" class="dropdown-item edit-lifting" href="'.route('sales.edit',$row['id']).'">Edit</a></li>';
                        // if ($row['sale_lifted_qty'] < $row['requested_sale_qty']) {
                            // if ($row['sale_lifted_qty'] < $row['requested_sale_qty']) {
                            $btn.= '<li><a class="dropdown-item" href="'.url('sales-request/process/'.$row['id'].'/edit').'">Lifting</a></li>';
                        // }
                        $btn.= '<li><a class="dropdown-item" href="'.route('sales.delete',$row['id']).'">Delete</a></li>';
                        $btn.= '</ul>';
                        $btn.= '</div>';
                        return $btn;
                    })
                    ->addColumn('bl_number', function($row){
                        return  $row['bl_number'];
                    })
                    ->addColumn('product_name', function($row){
                        return $row['product_code'] ?? '--';
                    })
                    ->addColumn('bl_qty', function($row){
                        return $row['bl_qty'];
                    })
                    ->addColumn('quantity', function($row){
                        return number_format($row['quantity'],3);
                    })
                    ->rawColumns(['action','number','product_name','bl_qty','quantity'])
                    ->make(true);
        }
        $products = Product::get();
        $buyers = Company::where('local',1)->get();
        $sales = SalesRequest::where('status',0)->get();
        $vessels = Inventory::get();
        $terminals = Terminal::get();
        return view('pages.sales-request.process',compact('products','buyers','sales','vessels','terminals'));
    }

    public function process_edit($id)
    {
        $products = Product::get();
        $buyers = Company::where('local',1)->get();
        $sales = SalesRequest::where('status',0)->get();
        $vessels = Inventory::get();
        $lifting = SalesRequest::find($id);
        $inventory = Inventory::with('bls')->find($lifting->inventory_id);
        $bls = $inventory->bls->where('product_id',$lifting->product_id);
        $terminals = Terminal::get();
        return view('pages.sales-request.process_edit',compact('products','buyers','sales','vessels','terminals','inventory','lifting','bls'));
    }

    public function success_index(Request $request)
    {
        if ($request->ajax()) {
            $data = SalesRequest::where('status',2)->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('buyer_name', function($row){
                        return $row->buyer->name  ?? '--';
                    })
                    ->addColumn('vehicle_number', function($row){
                        return $row->vehicle_number;
                    })
                    ->addColumn('lifting_date', function($row){
                        return date_format($row->lifting_bls[0]->created_at,'Y-m-d');
                    })
                    ->addColumn('product_name', function($row){
                        return $row->product->code;
                    })
                    ->addColumn('vessel_name', function($row){
                        return $row->inventory->vessel->name ?? '---';
                    })
                    ->addColumn('action', function($row){
                        $action = '<a href="'.route('view.lifting',$row->id).'" class="btn btn-light-success btn-sm border border-success">View</a>';
                        return $action;
                    })
                    ->rawColumns(['action','vehicle_number','lifting_date','buyer_name','product_name','vessel_name'])
                    ->make(true);
        }
        $sales = SalesRequest::where('status',2)->get();
        $products = Product::get();
        $buyers = Company::where('local',1)->get();
        $vessels = Inventory::get();
        $terminals = Terminal::get();
        return view('pages.sales-request.success',compact('sales','products','buyers','vessels','terminals'));
    }

    public function allocation_index(Request $request)
    {
        if ($request->ajax()) {
            $data = SalesRequest::where('status',1)->get();
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
     
                        $btn = '<div class="dropdown sale-'.$row['id'].'">';
                        $btn.= '<button class="btn btn-sm btn-light dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">';
                        $btn.= '';
                        $btn.= '</button>';
                        $btn.= '<ul class="dropdown-menu">';
                        if ($row->sales_contracts->sum('quantity') < $row->quantity) {
                            $btn.= '<li><a class="dropdown-item edit-bl" href="'.route('sale.success.edit',$row->id).'">Allocate</a></li>';
                        }
                        else {
                            $btn.= '<li><a class="dropdown-item fully-allocated" href="javascript:void(0);">Allocate</a></li>';
                        }
                        $btn.= '<li><a class="dropdown-item" href="'.route('sales.delete',$row->id).'">Delete</a></li>';
                        $btn.= '</ul>';
                        $btn.= '</div>';
                        return $btn;
                    })
                    ->addColumn('buyer_name', function($row){
                        return $row->buyer->name  ?? '--';
                    })
                    ->addColumn('vehicle_number', function($row){
                        return $row->vehicle_number;
                    })
                    ->addColumn('product_name', function($row){
                        return $row->product->code;
                    })
                    ->addColumn('vessel_name', function($row){
                        return $row->inventory->vessel->name ?? '---';
                    })
                    ->rawColumns(['action','vehicle_number','buyer_name','product_name','vessel_name'])
                    ->make(true);
        }
        $sales = SalesRequest::where('status',1)->get();
        $products = Product::get();
        $buyers = Company::where('local',1)->get();
        $vessels = Inventory::get();
        $terminals = Terminal::get();
        return view('pages.sales-request.allocation',compact('sales','products','buyers','vessels','terminals'));
    }

    public function success_edit($id)
    {
        $products = Product::get();
        $buyers = Company::where('local',1)->get();
        $vessels = Inventory::get();
        $terminals = Terminal::get();
        $sale = SalesRequest::find($id);
        $contracts = LocalContract::where('type','!=','washout')->get();
        return view('pages.sales-request.success_edit',compact('sale','products','buyers','vessels','terminals','contracts'));
    }

    public function store(Request $request)
    {
        $total_terminal_qty = array_sum(array_column($request->terminals,'quantity')); 
        if($total_terminal_qty > $request->contract_qty) {
            return response()->json(['error' => 'Requested Quantity is more than Contracts Quantity!']);
        }
        DB::beginTransaction();
            try {
                foreach ($request->terminals as $key => $terminal) {
                        if ($terminal['quantity'] > 0) {
                            $sales = new SalesRequest();
                            $sales->product_id  = $request->product_id;
                            $sales->buyer_id  = $request->buyer_id;
                            $sales->terminal_id  = $terminal['terminal_id'];   
                            $sales->quantity  = $terminal['quantity'];
                            $sales->vehicle_number  = $request->vehicle_number;
                            $sales->inventory_id  = $request->inventory_id;
                            $sales->save();
                        }
                        else {
                            DB::rollBack();
                            return response()->json(['error' => 'Please enter quantity!']);
                        }
                }
            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json(['error' => 'Unable to proceed!']);
            }
        $p_code = Product::find($request->product_id);
        $v_name = Inventory::find($request->inventory_id);
        $whatsapp_msg = [
            'product' => $p_code->code, 
            'vessel' => $v_name->vessel->name ?? '',
            'vehicle' => $request->vehicle_number,
            'quantity' => $total_terminal_qty
        ];
        if ($request->ajax()) {
            DB::commit();
            return response()->json(['success' => 'Sale Requested Successfully!', 'whatsapp_msg' => $whatsapp_msg]);
        }
        else {
            DB::commit();
            return redirect()->back();
        }
    }

    public function getSale($id)
    {
        $sale = SalesRequest::with('inventory')->find($id);
        return response()->json($sale);
    }

    public function getInv($product)
    {
        $ids = InventoryStock::where('product_id',$product)->pluck('inventory_id')->toArray();
        $inventories = Inventory::whereIn('id',$ids)->get();
        $option = '<option value="">-- Select Vessel --</option>';
        foreach ($inventories as $inventory) {
            $option .= '<option data-unlifted-qty="'.$inventory->unlifted_qty().'" value="'.$inventory->id.'">'.$inventory->vessel->name.' '.($inventory->vessel->local == 1 ? '(Local)' : '').'</option>';
        }

        $terminal_ids = InventoryStock::where('product_id',$product)->whereIn('inventory_id',$ids)->pluck('terminal_id')->toArray(); 
        $terminals = Terminal::whereIn('id',$terminal_ids)->get();
        $t_option = '<option value="">---</option>';
        foreach ($terminals as $terminal) {
            $t_option .= '<option value="'.$terminal->id.'">'.$terminal->code.'</option>';
        }
        return response()->json(['vessels' => $option, 'terminals' => $t_option]);
    }

    public function check_qty(Request $request)
    {
        $contracts = LocalContract::where('buyer_id',$request->buyer_id)
                    ->where('product_id',$request->product_id)->get();
        if (count($contracts) == 0) {
            return response()->json(['message' => 'No contract found of your selected Buyer & Product!']);
        }
        $sale_request = SalesRequest::where('buyer_id',$request->buyer_id)
        ->where('product_id',$request->product_id)->get();
        $lifted_qty = 0;
        foreach ($sale_request as $key => $sale) {
            $lifted_qty += $sale->sales_contracts->sum('quantity');
        }
        $total_qty = $contracts->sum('quantity') - $lifted_qty;
        return response()->json(['quantity' => number_format($total_qty,3)]);
    }

    public function export(Request $request)
    {
        return Excel::download(new SaleRequestExport($request->status), 'sale-request.xlsx');
    }

    public function contract_sale($id) 
    {
        $sale = SalesRequest::find($id);
        $contracts = LocalContract::where('type','!=','washout')->get();
        return view('pages.sales-request.contract',compact('sale','contracts'));
    }

    public function sale_contract_delete($id) 
    {
        $sale_contract = SaleContract::find($id);
        $sale_contract->delete();
        return back();
    }

    public function contract_store(Request $request)
    {
        $sale =  SalesRequest::find($request->sale_id);
        DB::beginTransaction();
        try {

            foreach ($request->contract_ids as $key => $contract) {
                $exist = SaleContract::where('sale_id',$sale->id)->where('contract_id',$contract['contract_id'])->count();
                $contracts_qty = SaleContract::where('sale_id',$sale->id)->sum('quantity');
                
                $local_contract = LocalContract::find($contract['contract_id']);
                if ($exist == 0) {
                    if ($contract['quantity'] > 0) {
                        if($contract['quantity'] <= $local_contract->balance_qty())
                        {
                            if ($contracts_qty + $contract['quantity'] <= $sale->loaded_qty()) {
                                $sale_contract = new SaleContract();
                                $sale_contract->contract_id = $contract['contract_id'];
                                $sale_contract->vessel_allocation_id  = $contract['vessel_allocation_id'];
                                $sale_contract->quantity = $contract['quantity'];
                                $sale_contract->sale_id = $request->sale_id;
                                $sale_contract->save();
                            }
                            else {
                                DB::rollBack();
                                return response()->json(['error' => 'Quantity Exceed!'],404);    
                            }

                        }
                        else {
                            DB::rollBack();
                            return response()->json(['error' => 'Allocated quantity can not be greater than Balance Quantity!'],404);
                        }
                    }
                    else {
                        DB::rollBack();
                        return response()->json(['error' => 'Please Enter quantity!'],404);
                        }
                }
                else {
                    return response()->json(['error' => 'Contract Already Allocated!'],404);
                }
            }
            
            $sale_contracts_qty = SaleContract::where('sale_id',$sale->id)->sum('quantity');
            if ($sale_contracts_qty == $sale->loaded_qty()) {
                $sale->status = 2;
            }
            $sale->update();
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Unable to Process!'],404);
        }

        DB::commit();
        return response()->json(['success' => 'Contract Added in Lifting!']);
    }

    public function update_lifting_status($id)
    {
        $sale = SalesRequest::find($id);
        $sale->status = 1;
        $sale->update();
        return redirect('sales-request/process/'.$sale->id.'/edit');
    }

    public function view_lifting($id)
    {
        $sale = SalesRequest::find($id);
        return view('pages.sales-request.view-lifting',compact('sale'));
    }

    public function add_lifting($id) 
    {
        $sale = SalesRequest::find($id);
        $bls = InventoryBL::where('inventory_id',$sale->inventory_id)->get();
        return view('pages.sales-request.add_lifting',compact('sale','bls'));
    }

    public function getTerminals($id)
    {
        $inventory = Inventory::find($id);
        $terminalIDS = $inventory->stocks->pluck('terminal_id')->toArray();
        $terminals = Terminal::whereIn('id',$terminalIDS)->get();
        $options = '<option>---</option>';
        foreach ($terminals as $terminal) {
            $options .= '<option value="'.$terminal->id.'">'.$terminal->code.'</option>'; 
        }
        return $options;
    }

    public function edit($id) 
    {
        $sale = SalesRequest::find($id);
        $products = Product::get();
        $buyers = Company::where('local',1)->get();
        $vessels = Inventory::get();
        $terminals = Terminal::get();
        return view('pages.sales-request.edit',compact('sale','products','buyers','vessels','terminals'));
    }

    public function update(Request $request, $id) 
    {
        $sale = SalesRequest::find($id);
        $sale->product_id  = $request->product_id;   
        $sale->buyer_id  = $request->buyer_id;   
        $sale->terminal_id  = $request->terminal_id;   
        $sale->quantity  = $request->quantity;
        $sale->vehicle_number  = $request->vehicle_number;
        $sale->inventory_id  = $request->inventory_id;
        $sale->save();
        if ($request->ajax()) {
            return response()->json(['success' => 'Sale Request Updated!']);
        }
        else {
            return redirect('sales-request');
        }
    }

    public function delete($id)
    {
        $sale = SalesRequest::find($id);
        $sale->delete();
        return redirect('sales-request/process');
    }
}