<?php

namespace App\Http\Controllers;

use App\Models\BLAllocation;
use App\Models\InventoryStock;
use Illuminate\Http\Request;
use App\Models\LocalContract;
use App\Models\Business;
use App\Models\Company;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\PaymentTerm;
use App\Models\InventoryBL;
use App\Models\Terminal;
use App\Models\Vessel;
use App\Models\ClearingAgent;
use App\Exports\LocalContractExport;
use App\Models\MessageContract;
use App\Models\VesselAllocation;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use DB;
use Spatie\Activitylog\Models\Activity;

class LocalContractController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:local-contract-list|local-contract-create|barter-contract-create|temporary-contract-create|return-temporary-contract|return-temporary-contract-edit|return-barter-contract|return-barter-contract-edit', ['only' => ['index','store']]);
         $this->middleware('permission:local-contract-create', ['only' => ['create','store']]);
         $this->middleware('permission:barter-contract-create', ['only' => ['barter_create']]);
         $this->middleware('permission:temporary-contract-create', ['only' => ['temp_create']]);
         $this->middleware('permission:return-temporary-contract', ['only' => ['return_contract']]);
         $this->middleware('permission:return-temporary-contract-edit', ['only' => ['return_contract_edit']]);
         $this->middleware('permission:return-barter-contract', ['only' => ['return_barter']]);
         $this->middleware('permission:return-barter-contract-edit', ['only' => ['return_barter_edit']]);
    }

    public function index()
    {
        $contracts = LocalContract::get();
        $companies = Company::get();
        $businesses = Business::get();
        $vessels = Vessel::get();
        $products = Product::get();
        // $inv_ids = $contracts->pluck('inventory_id')->toArray();
        // $stocks = InventoryStock::whereIn('inventory_id',$inv_ids)->get();
        return view('pages.local-contract.index',compact('contracts','companies','vessels','products','businesses'));
    }

    public function vessel()
    {
        $contracts = LocalContract::get();
        $companies = Company::get();
        $businesses = Business::get();
        $vessels = Vessel::get();
        $inventories = InventoryStock::with('inventory')->get()->groupBy(['inventory_id','product_id']);
        // foreach ($inventories as $inv_id => $terminal_stocks){
        //     foreach ($terminal_stocks as $stock) {
        //         return $stock;
        //     }

        // }
        // return $inventories;
        $products = Product::get();
        $anEloquentModel = new LocalContract;
        activity()
        ->performedOn($anEloquentModel)
        ->causedBy(auth()->user()->id)
        ->inLog('vessel_contract_list')
        ->log('User Viewed the Vessel Contract List');
        return view('pages.local-contract.vessel-contract',compact('contracts','companies','vessels','products','businesses','inventories'));
    }

    public function buyer()
    {
        $all_contracts = LocalContract::orderBy('date','desc')->get()->groupBy(['buyer_id','product_id']);
        $companies = Company::get();
        $businesses = Business::get();
        $vessels = Vessel::get();
        $products = Product::get();
        $anEloquentModel = new LocalContract;
        activity()
        ->performedOn($anEloquentModel)
        ->causedBy(auth()->user()->id)
        ->inLog('buyer_contract_list')
        ->log('User Viewed the Buyer Contract List');
        return view('pages.local-contract.buyer-contract',compact('all_contracts','companies','vessels','products','businesses'));
    }

    public function seller()
    {
        $contracts = LocalContract::orderBy('date','desc')->get();
        $companies = Company::get();
        $businesses = Business::get();
        $vessels = Vessel::get();
        $products = Product::get();

        $all_contracts = VesselAllocation::with('inventory')->get()->groupBy(['inventory.company_id','inventory_id']);
        // return $all_contracts;
        $anEloquentModel = new LocalContract;
        activity()
        ->performedOn($anEloquentModel)
        ->causedBy(auth()->user()->id)
        ->inLog('seller_contract_list')
        ->log('User Viewed the Seller Contract List');
        return view('pages.local-contract.seller-contract',compact('all_contracts','companies','vessels','products','businesses'));
    }

    public function contracts()
    {
        $contracts = LocalContract::orderBy('date','desc')->get();
        $companies = Company::get();
        $businesses = Business::get();
        $vessels = Vessel::get();
        $products = Product::get();
        $payments = PaymentTerm::orderBy('order','ASC')->where('local','1')->get();
        $anEloquentModel = new LocalContract;
        activity()
        ->performedOn($anEloquentModel)
        ->causedBy(auth()->user()->id)
        ->inLog('contracts_list')
        ->log('User Viewed the Contracts List');
        return view('pages.local-contract.contracts',compact('contracts','companies','vessels','products','payments','businesses'));
    }

    public function export(Request $request)
    {
        $anEloquentModel = new LocalContract;
        activity()
        ->performedOn($anEloquentModel)
        ->causedBy(auth()->user()->id)
        ->inLog('contracts_export')
        ->log('User Export the Contracts List');
        return Excel::download(new LocalContractExport($request->type), 'local-contracts.xlsx');
    }

    public function inventory_contract($id)
    {
        $contracts = LocalContract::where('inventory_id',$id)->get();
        $companies = Company::where('local','1')->get();
        $vessels = Vessel::get();
        return view('pages.local-contract.index',compact('contracts','companies','vessels'));
    }

    public function inventory()
    {
        $inventories = Inventory::get();
        return view('pages.local-contract.inventory',compact('inventories'));
    }

    public function barter_index()
    {
        $contracts = LocalContract::where('type','barter')->get();
        return view('pages.local-contract.barter_index',compact('contracts'));
    }

    public function temp_index()
    {
        $contracts = LocalContract::where('type','temp')->get();
        return view('pages.local-contract.temp_index',compact('contracts'));
    }


    public function create()
    {
        $businesses = Business::where('local','1')->get();
        $buyers = Company::where('local','1')->get();
        $inventories = Inventory::where('active_contract',1)->get();
        $payments = PaymentTerm::orderBy('order','ASC')->where('local','1')->get();
        $products = Product::all();
        return view('pages.local-contract.create',compact('businesses','buyers','inventories','payments','products'));
    }

    public function view_contract($id)
    {
        $contract = LocalContract::find($id);
        $activities = Activity::join('users', 'activity_log.causer_id', '=', 'users.id')
        ->select('activity_log.*', 'users.name as username')
        ->where('subject_type','App\\Models\\LocalContract')->get();
        $anEloquentModel = new LocalContract;
        activity()
        ->performedOn($anEloquentModel)
        ->causedBy(auth()->user()->id)
        ->inLog('contracts_view')
        ->log('User view contract screen');
        return view('pages.local-contract.view-contract',compact('contract','activities'));
    }

    public function edit($id)
    {
        $businesses = Business::get();
        $buyers = Company::where('local','1')->get();
        $inventories = Inventory::get();
        $payments = PaymentTerm::orderBy('order','ASC')->where('local','1')->get();
        $products = Product::all();
        $contract = LocalContract::find($id);
        return view('pages.local-contract.edit',compact('businesses','buyers','inventories','payments','products','contract'));
    }

    public function barter_create()
    {
        $businesses = Business::get();
        $buyers = Company::where('local','1')->get();
        $inventories = Inventory::get();
        $products = Product::get();
        return view('pages.local-contract.barter',compact('businesses','buyers','inventories','products'));
    }

    public function temp_create()
    {
        $businesses = Business::get();
        $buyers = Company::where('local','1')->get();
        $inventories = Inventory::get();
        $products = Product::get();
        return view('pages.local-contract.temp',compact('businesses','buyers','inventories','products'));
    }

    public function return_contract($id)
    {
        $contract = LocalContract::find($id);
        $sellers = Company::where('local','1')->get();
        $terminals = Terminal::all();
        $vessels = Vessel::all();
        $products = Product::all();
        $clearing_agents = ClearingAgent::all();
        $buyers = Business::get();
        return view('pages.local-contract.return_temp', compact('contract','sellers','products','terminals','vessels','clearing_agents','buyers'));
    }

    public function return_barter($id)
    {
        $contract = LocalContract::find($id);
        $sellers = Company::where('local','1')->get();
        $terminals = Terminal::all();
        $vessels = Vessel::all();
        $products = Product::all();
        $clearing_agents = ClearingAgent::all();
        $buyers = Business::get();
        return view('pages.local-contract.return_barter', compact('contract','sellers','products','terminals','vessels','clearing_agents','buyers'));
    }

    public function return_contract_edit($id)
    {
        $inventory = Inventory::find($id);
        $sellers = Company::where('local','1')->get();
        $terminals = Terminal::all();
        $vessels = Vessel::all();
        $products = Product::all();
        $buyers = Business::all();
        $clearing_agents = ClearingAgent::all();
        return view('pages.local-contract.return_temp_edit', compact('inventory','inventory','sellers','terminals','vessels','products','clearing_agents','buyers'));
    }

    public function return_barter_edit($id)
    {
        $inventory = Inventory::find($id);
        $sellers = Company::where('local','1')->get();
        $terminals = Terminal::all();
        $vessels = Vessel::all();
        $products = Product::all();
        $buyers = Business::all();
        $clearing_agents = ClearingAgent::all();
        return view('pages.local-contract.return_barter_edit', compact('inventory','inventory','sellers','terminals','vessels','products','clearing_agents','buyers'));
    }

    public function store(Request $request)
    {
        if ($request->type == 'normal') {
            $validated = $request->validate([
                'type' => 'required',
                'bussiness_id' => 'required',
                'date' => 'required',
                'lifting_date' => 'required',
                'product_id' => 'required',
                'buyer_id' => 'required',
                'quantity' => 'required',
                'selling_price' => 'required'
            ]);
        }
        else {
            $validated = $request->validate([
                'type' => 'required',
                'bussiness_id' => 'required',
                'date' => 'required',
                'lifting_date' => 'required',
                'product_id' => 'required',
                'buyer_id' => 'required',
                'quantity' => 'required'
            ]);
        }

        $buyer = Company::find($request->buyer_id);
        $business = Business::find($request->bussiness_id);
        $product = Product::find($request->product_id);

        $lastRecord = LocalContract::first();
        $count = count(LocalContract::get());
        if ($lastRecord) {
            $lastNumber = (int) substr($count, -3);
            $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
        $nextNumber = '001';
        }

            $contract = new LocalContract();
            $contract->code = $business->code.'-'.date('y').'/'.date('M').'/'.$product->code.'/'.$nextNumber;
            $contract->bussiness_id = $request->bussiness_id;
            $contract->buyer_id = $request->buyer_id;
            $contract->product_id = $request->product_id;
            $contract->quantity = $request->quantity;
            $contract->rate = $request->rate;
            $contract->type = $request->type;
            $contract->return_date = $request->return_date;
            $contract->return_product = $request->return_product;
            $contract->selling_price = $request->selling_price;
            $contract->provisional_price = $request->provisional_price;
            $contract->final_price = $request->final_price;
            $contract->lifting_date = $request->lifting_date;
            $contract->date = $request->date;
            $contract->fx_rate = $request->fx_rate;
            $contract->payment_term = $request->payment_term;
            $contract->contract_status = 'Waiting for Lifting';
            $contract->remarks = $request->remarks;
            $contract->save();

            $msg = Carbon::parse($contract->date)->format('j M Y')."<br><br>";
            $msg .= $contract->code."<br>";
            $msg .= $contract->product->name."<br>";
            $msg .= $contract->quantity.' MT @ '.number_format($contract->selling_price).'<br>';
            if ($request->type == 'normal') {
                $msg .= $contract->payment_terms->name.'<br><br>';
            }
            $msg .= 'Buyer: '.$contract->buyer->name.'<br>';
            if($contract->date == $contract->lifting_date) {
                $msg .= 'Lifting: Immediate';
            }
            else {
                $msg .= 'Lifting from: '.Carbon::parse($contract->lifting_date)->format('j M Y');
            }
            $msg = htmlentities($msg);

        $anEloquentModel = new LocalContract;
        activity()
        ->performedOn($anEloquentModel)
        ->causedBy(auth()->user()->id)
        ->inLog('contracts_create')
        ->log('User created a contract');
        return redirect('local-contracts/vessel')->with('contract-success',$msg);
    }

    public function CheckQuantity(Request $request)
    {
        $inventory = Inventory::where('id',$request->inventory_id)->first();
        return response()->json($inventory->bl_quantity);
    }

    public function SaveMessage(Request $request)
    {
        $message = new MessageContract();
        $message->message = $request->message;
        $message->contract_id = $request->contract_id;
        $message->save();
        return response()->json(['success' => 'Message Saved!']);
    }

    public function update(Request $request,$id)
    {
        $contract = LocalContract::find($id);
        $product = Product::find($request->product_id);
        $code = explode("/",$contract->code);
        $code[2] = $product->code;

        $contract->date = $request->date;
        $contract->code = implode("/",$code);
        $contract->bussiness_id = $request->bussiness_id;
        $contract->inventory_id = $request->inventory_id;
        $contract->buyer_id = $request->buyer_id;
        // $contract->product_id = $request->product_id;
        // $contract->quantity = $request->quantity;
        $contract->rate = $request->rate;
        $contract->fx_rate = $request->fx_rate;
        $contract->selling_price = $request->selling_price;
        $contract->provisional_price = $request->provisional_price;
        $contract->return_date = $request->return_date;
        $contract->return_product = $request->return_product;
        $contract->final_price = $request->final_price;
        $contract->lifting_date = $request->lifting_date;
        $contract->payment_term = $request->payment_term;
        $contract->update();

        $msg = Carbon::parse($contract->date)->format('j M Y')."<br><br>";
        $msg .= $contract->code."<br>";
        $msg .= $contract->product->name."<br>";
        $msg .= $contract->quantity.' MT @ '.number_format($contract->selling_price).'<br>';
        $msg .= $contract->payment_terms->name.'<br><br>';
        $msg .= 'Buyer: '.$contract->buyer->name.'<br>';
        if($contract->date == $contract->lifting_date) {
            $msg .= 'Lifting: Immediate';
        }
        else {
            $msg .= 'Lifting from: '.Carbon::parse($contract->lifting_date)->format('j M Y');
        }
        $msg = htmlentities($msg);

        $anEloquentModel = new LocalContract;
        activity()
        ->performedOn($anEloquentModel)
        ->causedBy(auth()->user()->id)
        ->inLog('contracts_update')
        ->log('User updated a contract');

        if ($request->redirection == 'vessel-allocation') {
            return redirect('local-contracts/vessel-allocation');
        }
        else {
            return back();
        }
    }

    public function split($id)
    {
        $contract = LocalContract::find($id);
        $businesses = Business::where('local','1')->get();
        $buyers = Company::where('local','1')->get();
        $inventories = Inventory::where('active_contract',1)->get();
        $payments = PaymentTerm::where('local','1')->get();
        $products = Product::all();

        $anEloquentModel = new LocalContract;
        activity()
        ->performedOn($anEloquentModel)
        ->causedBy(auth()->user()->id)
        ->inLog('contracts_split')
        ->log('User split a contract');

        return view('pages.local-contract.split',compact('contract','businesses','buyers','inventories','payments','products'));
    }

    public function split_store(Request $request,$id)
    {
        $validated = $request->validate([
            'spit_contracts' => 'required'
        ]);
            $contract = LocalContract::find($id);
            if ($contract->lifting_status() == 'Lifting Completed') {
                return back()->with('error','Contract Split not allowed.');
            }
            else {

                $alphas = range('B', 'Z');
                foreach ($request->spit_contracts as $key => $split) {
                    $product = Product::find($split['product_id']);

                        $split_contract = new LocalContract();

                        $exploded = explode("/",$contract->code);
                            $code_business = $exploded[0];
                            $code_month = $exploded[1];
                            $code_product = $product->code;
                            $code_auto_num = $exploded[3];

                            $split_code = [];
                            $split_code[0] = $code_business;
                            $split_code[1] = $code_month;
                            $split_code[2] = $code_product;
                            $split_code[3] = $code_auto_num.'-'.$alphas[$key];

                        $split_contract->code = implode('/',$split_code);
                        $split_contract->buyer_id = $contract->buyer_id;
                        $split_contract->product_id = $split['product_id'];
                        $split_contract->quantity = $split['quantity'];
                        $split_contract->rate = $contract->rate;
                        $split_contract->type = $contract->type;
                        $split_contract->return_date = $contract->return_date;
                        $split_contract->return_product = $contract->return_product;
                        $split_contract->selling_price = $contract->selling_price;
                        $split_contract->provisional_price = $contract->provisional_price;
                        $split_contract->final_price = $contract->final_price;
                        $split_contract->lifting_date = $contract->lifting_date;
                        $split_contract->date = $split['date'];
                        $split_contract->fx_rate = $contract->fx_rate;
                        $split_contract->payment_term = $contract->payment_term;
                        $split_contract->contract_status = 'Waiting for Lifting';
                        $split_contract->remarks = $split['remarks'];
                        $split_contract->save();

                        $contract->quantity = $contract->quantity - $split['quantity'];
                        $contract->update();
                }

                return redirect('local-contracts/contracts');
            }
    }

    public function washout($id)
    {
        $contract = LocalContract::find($id);
        return view('pages.local-contract.washout',compact('contract'));
    }

    public function washout_store($id, Request $request)
    {
        $this->validate($request,[
            'contract_date' => 'required',
            'washout_qty' => 'required',
            'rate' => 'required',
            'selling_price' => 'required'
        ]);
        $contract = LocalContract::find($id);

        if ($contract->lifting_status() == 'Lifting Completed') {
            return back()->with('error','Product Update not allowed.');
        }
        else {
            $washout = new LocalContract();
            $washout->code = $contract->code.'-WO';
            $washout->bussiness_id = $contract->bussiness_id;
            $washout->buyer_id = $contract->buyer_id;
            $washout->product_id = $contract->product_id;
            $washout->quantity = $contract->quantity - $request->washout_qty;
            $washout->rate = $request->rate;
            $washout->type = 'washout';
            $washout->return_date = $contract->return_date;
            $washout->return_product = $contract->return_product;
            $washout->selling_price = $request->selling_price;
            $washout->provisional_price = $contract->provisional_price;
            $washout->final_price = $contract->final_price;
            $washout->lifting_date = $contract->lifting_date;
            $washout->date = $request->contract_date;
            $washout->fx_rate = $contract->fx_rate;
            $washout->payment_term = $contract->payment_term;
            $washout->contract_status = $contract->contract_status;
            $washout->remarks = $request->remarks;
            $washout->save();

            return redirect('local-contracts/contracts');
        }
    }

    public function price_update()
    {
        $contracts = LocalContract::orderBy('date','desc')->get();
        $products = Product::get();
        $buyers = Company::get();
        return view('pages.local-contract.price-update',compact('contracts','products','buyers'));
    }

    public function getContract($id)
    {
        $contract = LocalContract::find($id);
        $data = array (
            'code' => $contract->code ?? 'N/A',
            'bussiness' => $contract->business->name ?? 'N/A',
            'bussiness_id' => $contract->bussiness_id,
            'date' => $contract->date,
            'lifting_date' => $contract->lifting_date,
            'product' => $contract->product->name ?? 'N/A',
            'product_id' => $contract->product_id,
            'buyer' => $contract->buyer->name ?? 'N/A',
            'buyer_id' => $contract->buyer_id,
            'quantity' => $contract->quantity,
            'selling_price' => $contract->selling_price,
            'payment_terms' => $contract->payment_terms->name ?? 'N/A',
            'payment_term_id' => $contract->payment_term,
            'rate' => $contract->rate,
            'type' => $contract->type,
            'fx_rate' => $contract->fx_rate,
            'final_price' => $contract->final_price,
            'remarks' => $contract->remarks,
            'unsold_qty' => isset($contract->inventory) ? $contract->inventory->unsold_qty() : '',
        );
        $allocations = VesselAllocation::where('contract_id',$contract->id)->get();

        $inventories = Inventory::where('product_id',$contract->product_id)->get();
        $inv_body = '<option disabled selected value="">--</option>';
        foreach ($inventories as $key => $inv) {
                $inv_body .= '<option value="'.$inv->id.'">'.$inv->vessel->name.'</option>';
        }
        $allocations_body = '';
        foreach ($allocations as $key => $allocation) {
            $allocations_body .= '<div class="rounded-3 p-3 border border-secondary mb-2">';
            $allocations_body .= '<div class="form-group row gy-3 justify-content-center">';
            $allocations_body .= '<div class="col-md-4">';
            $allocations_body .= '<input type="text" class="form-control form-control-sm" value="'.$allocation->inventory->vessel->name.'" disabled>';
            $allocations_body .= '</div>';
            $allocations_body .= '<div class="col-md-4">';
            $allocations_body .= '<input type="number" class="form-control form-control-sm" value="'.$allocation->quantity.'" step="0.001" disabled>';
            $allocations_body .= '</div>';
            $allocations_body .= '<div class="col-md-4 d-flex">';
            $allocations_body .= '<a href="'.url('local-contracts/bl-allocation/'.$allocation->id).'"';
            $allocations_body .= 'class="btn btn-sm btn-light-primary me-1">';
            $allocations_body .= '<i class="fa fa-arrow-right"></i>';
            $allocations_body .= '</a>';
            $allocations_body .= '<a href="javascript:void(0);" data-route="'.route('vessel_allocation.delete',$allocation->id).'" class="btn btn-sm btn-light-danger confirm-delete"><i class="fa fa-cancel"></i></a>';
            $allocations_body .= '</div>';
            $allocations_body .= '</div>';
            $allocations_body .= '</div>';
        }

        return response()->json([
           'data' => $data,
           'allocations' => $allocations_body,
           'count_allocation' => count($allocations),
           'contract_product_vessel' => $inv_body
        ]);
    }

    public function UpdatePrice(Request $request, $id)
    {
        $contract = LocalContract::find($id);
        $contract->rate = $request->rate;
        $contract->fx_rate = $request->fx_rate;
        $contract->final_price = $request->final_price;
        $contract->update();

        $anEloquentModel = new LocalContract();
        activity()
        ->performedOn($anEloquentModel)
        ->causedBy(auth()->user()->id)
        ->inLog('contract_price')
        ->log('User Update Contract Price');
        return response()->json(['success' => 'Price Updated Sucessully !']);
    }

    public function UpdateRate(Request $request, $id)
    {
        $contract = LocalContract::find($id);
        $contract->selling_price = $request->selling_price;
        $contract->remarks = $request->remarks;
        $contract->update();

        $anEloquentModel = new LocalContract();
        activity()
        ->performedOn($anEloquentModel)
        ->causedBy(auth()->user()->id)
        ->inLog('contract_rate')
        ->log('User Update Contract Rate');
        return back();
    }

    public function UpdateQuantity(Request $request, $id)
    {
        $contract = LocalContract::find($id);
        $contract_qty = $contract->quantity;
        if ($contract->lifting_status() == 'Lifting Completed') {
            return back()->with('error','Quantity Update not allowed.');
        }

            $NewQty = $contract_qty + $request->quantity;
            if ($NewQty < 0) {
                $anEloquentModel = new LocalContract();
                activity()
                ->performedOn($anEloquentModel)
                ->causedBy(auth()->user()->id)
                ->inLog('contract_qty')
                ->log('User was not allowed to update contract quantity');
                return back()->with('error','Quantity Update not allowed.');
            }

            if ($request->quantity < 0) {
                $ReduceQty = $contract_qty + $request->quantity;
                if ($ReduceQty < $contract->allocated_qty()) {
                    return redirect()
                    ->route('edit.reduce-qty',[$contract->id,$ReduceQty]);
                }
                else {
                    $contract->quantity = $contract_qty + $request->quantity;
                    $contract->remarks = $request->remarks;
                    $contract->update();
                    $anEloquentModel = new LocalContract();
                    activity()
                    ->performedOn($anEloquentModel)
                    ->causedBy(auth()->user()->id)
                    ->inLog('contract_qty')
                    ->log('User Update Contract Quantity');
                    return back();
                }
            }
            else {
                    $contract->quantity = $contract_qty + $request->quantity;
                    $contract->remarks = $request->remarks;
                    $contract->update();
                    $anEloquentModel = new LocalContract();
                    activity()
                    ->performedOn($anEloquentModel)
                    ->causedBy(auth()->user()->id)
                    ->inLog('contract_qty')
                    ->log('User Update Contract Quantity');
                    return back();
            }
    }

    public function EditReduceQty($id, $qty)
    {
        $contract = LocalContract::find($id);
        return view('pages.local-contract.vessel-allocation.reduce-qty',compact('contract','qty'));
    }

    public function UpdateReduceQty(Request $request,$id,$qty)
    {
        $contract = LocalContract::find($id);
        $va_qty = array_sum($request->vessel_qty);
        if ($va_qty > $qty) {
            return back()->with('error','Quantity still not reduce!');
        }
        foreach ($request->vessel_qty as $allocation_id => $allocation_qty) {
            $allocation = VesselAllocation::find($allocation_id);
            $max_qty = $allocation->inventory->unsold_qty_by_pd($allocation->contract->product_id) + $allocation->quantity;
            if ($allocation_qty <= $max_qty) {
                $allocation->quantity = $allocation_qty;
                $allocation->update();
            }
            else {
                return back()->with('error','Vessel Allocation quantity exceed!');
            }
        }

        foreach ($request->bl_allocations as $bl_allocation_id => $bl_allocation_qty) {
            $bl_allocation = BLAllocation::find($bl_allocation_id);
            $bl_allocation->quantity = $bl_allocation_qty;
            $bl_allocation->update();
        }

        $contract->quantity = $qty;
        $contract->update();
        return redirect('local-contracts/contracts');
    }

    public function UpdateProduct(Request $request, $id)
    {
        $contract = LocalContract::find($id);

        $product = Product::find($request->product_id);
            if ($contract->lifting_status() == 'Lifting Completed' || $contract->lifting_status() == 'Lifting in Progress') {
                return back()->with('error','Product Update not allowed.');
            }
            else {
                $redirection = '';
                if (count($contract->allocations) > 0) {
                    if ($contract->product_id != $request->product_id) {
                        $contract->allocations()->delete();
                        $redirection = 'vessel-allocation';
                    }
                }

                $code = explode("/",$contract->code);
                $code[2] = $product->code;
                $contract->code = implode("/",$code);
                $contract->product_id = $request->product_id;
                $contract->update();

                $anEloquentModel = new LocalContract();
                activity()
                ->performedOn($anEloquentModel)
                ->causedBy(auth()->user()->id)
                ->inLog('contract_product')
                ->log('User Update Contract Product');

                if ($redirection == 'vessel-allocation') {
                    return redirect('local-contracts/vessel-allocation')->with('product-update',$contract->id);
                }
                return back()->with('contract-success',$contract->id);
            }
    }

    public function EditQty($id)
    {
        $contract = LocalContract::find($id);
        $businesses = Business::get();
        $products = Product::get();
        $companies = Company::get();
        $payments = PaymentTerm::get();

        $QtyModal = '';
        $QtyModal .= '<div class="modal-dialog modal-dialog-centered">';
        $QtyModal .= '<div class="modal-content">';
        $QtyModal .= '<div class="modal-header">';
        $QtyModal .= '<h1 class="modal-title fs-5" id="QuantityModalLabel">Update Quantity</h1>';
        $QtyModal .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        $QtyModal .= '</div>';
        $QtyModal .= '<div class="modal-body">';
        $QtyModal .= '<form action="'.route('update.quantity',$contract->id).'" method="get" id="QuickQtyForm">';
        $QtyModal .= '<div class="row">';
        $QtyModal .= '<div class="col-md-4">';
        $QtyModal .= '<label for="" class="form-label">Transaction Type</label>';
        $QtyModal .= '<select class="form-select form-select-lg mb-4" id="QuickTransactionType" disabled>';
        $QtyModal .= '<option>-- Select Tran. Type --</option>';
        $QtyModal .= '<option value="normal" ' . ($contract->type == "normal" ? "selected" : "") . '>Normal</option>';
        $QtyModal .= '<option value="barter">Barter</option>';
        $QtyModal .= '<option value="temp">Temporary</option>';
        $QtyModal .= '</select>';
        $QtyModal .= '</div>';
        $QtyModal .= '<div class="col-md-4">';
        $QtyModal .= '<label for="company_id" class="form-label">Business <span class="text-danger">*</span></label>';
        $QtyModal .= '<select class="form-select form-select-lg mb-4" id="QuickBusiness" disabled>';
        $QtyModal .= '<option value="">-- Select Business --</option>';
        foreach ($businesses as $business) {
            $QtyModal .= '<option '.($contract->bussiness_id == $business->id ? 'selected' : '').' value="'.$business->id.'">'.$business->name.'</option>';
        }
        $QtyModal .= '</select>';
        $QtyModal .= '</div>';
        $QtyModal .= '<div class="col-md-4">';
        $QtyModal .= '<label for="voyage_number" class="form-label">Contract Date <span class="text-danger">*</span></label>';
        $QtyModal .= '<input type="date" class="form-control form-control-lg" value="'.$contract->date.'" id="QuickDate" disabled />';
        $QtyModal .= '</div>';
        $QtyModal .= '<div class="col-md-4">';
        $QtyModal .= '<label for="voyage_number" class="form-label">Lifting Date <span class="text-danger">*</span></label>';
        $QtyModal .= '<input type="date" class="form-control form-control-lg" value="'.$contract->lifting_date.'" id="QuickLiftingDate" disabled />';
        $QtyModal .= '</div>';
        $QtyModal .= '<div class="col-md-4">';
        $QtyModal .= '<label for="product" class="form-label">Product</label>';
        $QtyModal .= '<select class="form-select form-select-lg mb-4" id="QuickProduct" disabled>';
        $QtyModal .= '<option value="">-- Select Product --</option>';
        foreach ($products as $product){
            $QtyModal .= '<option '.($contract->product_id == $product->id ? 'selected' : '').' value="'.$product->id.'">'.$product->code.'</option>';
        }
        $QtyModal .= '</select>';
        $QtyModal .= '</div>';
        $QtyModal .= '<div class="col-md-4">';
        $QtyModal .= '<label for="product_id" class="form-label">Buyer <span class="text-danger">*</span></label>';
        $QtyModal .= '<select class="form-select form-select-lg mb-4" id="QuickBuyer" disabled>';
        $QtyModal .= '<option value="">-- Select Buyers  --</option>';
        foreach ($companies as $company) {
            $QtyModal .= '<option '.($contract->buyer_id == $company->id ? 'selected' : '').' value="'.$company->id.'">'.$company->name.'</option>';
        }
        $QtyModal .= '</select>';
        $QtyModal .= '</div>';
        $QtyModal .= '<div class="col-md-6">';
        $QtyModal .= '<label for="voyage_number" class="form-label">Selling Price <span class="text-danger">*</span></label>';
        $QtyModal .= '<div class="input-group" id="selling_price">';
        $QtyModal .= '<span class="input-group-text" id="basic-addon1">PKR</span>';
        $QtyModal .= '<input type="number" class="form-control form-control-lg" value="'.$contract->selling_price.'" id="QuickSellingPrice" disabled />';
        $QtyModal .= '</div>';
        $QtyModal .= '</div>';
        $QtyModal .= '<div class="col-md-6">';
        $QtyModal .= '<label class="form-label">Payment Terms <span class="text-danger">*</span></label>';
        $QtyModal .= '<select id="QuickPayment" class="form-select form-select-lg mb-4" disabled>';
        $QtyModal .= '<option value="">-- Select Payment Term --</option>';
        foreach ($payments as $payment) {
            $QtyModal .= '<option '.($contract->payment_term == $payment->id ? 'selected' : '').' value="'.$payment->id.'">'.$payment->name.'</option>';
        }
        $QtyModal .= '</select>';
        $QtyModal .= '</div>';
        $QtyModal .= '<div class="col-md-4 mb-2">';
        $QtyModal .= '<label class="form-label">Current Quantity</label>';
        $QtyModal .= '<input type="number" class="form-control" id="CurrentQty" value="'.$contract->quantity.'" disabled>';
        $QtyModal .= '</div>';
        $QtyModal .= '<div class="col-md-4">';
        $QtyModal .= '<label class="form-label">Quantity</label>';
        $QtyModal .= '<input type="number" class="form-control" name="quantity" id="QuickQty" required>';
        $QtyModal .= '</div>';
        $QtyModal .= '<div class="col-md-4">';
        $QtyModal .= '<label class="form-label">New Quantity</label>';
        $QtyModal .= '<input type="number" class="form-control" name="quantity" id="NewQty" disabled>';
        $QtyModal .= '</div>';
        $QtyModal .= '<div class="col-md-8">';
        $QtyModal .= '<label class="form-label">Remarks</label>';
        $QtyModal .= '<textarea name="remarks" id="QuickRemarks" cols="30" rows="1" class="form-control">'.$contract->remarks.'</textarea>';
        $QtyModal .= '</div>';
        $QtyModal .= '</div>';
        $QtyModal .= '</form>';
        $QtyModal .= '</div>';
        $QtyModal .= '<div class="modal-footer">';
        $QtyModal .= '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
        $QtyModal .= '<button type="submit" form="QuickQtyForm" class="btn btn-primary">Save</button>';
        $QtyModal .= '</div>';
        $QtyModal .= '</div>';
        $QtyModal .= '</div>';

        return response()->json(['QtyModal' => $QtyModal]);
    }

    public function EditRate($id)
    {
        $contract = LocalContract::find($id);
        $businesses = Business::get();
        $products = Product::get();
        $companies = Company::get();
        $payments = PaymentTerm::get();

        $RateModal = '';
        $RateModal .= '<div class="modal-dialog modal-dialog-centered">';
        $RateModal .= '<div class="modal-content">';
        $RateModal .= '<div class="modal-header">';
        $RateModal .= '<h1 class="modal-title fs-5">Update Rate</h1>';
        $RateModal .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        $RateModal .= '</div>';
        $RateModal .= '<div class="modal-body">';
        $RateModal .= '<form action="'.route('update.rate',$contract->id).'" method="get" id="QuickRateForm">';
        $RateModal .= '<div class="row">';
        $RateModal .= '<div class="col-md-4">';
        $RateModal .= '<label for="" class="form-label">Transaction Type</label>';
        $RateModal .= '<select class="form-select form-select-lg mb-4" disabled>';
        $RateModal .= '<option>-- Select Tran. Type --</option>';
        $RateModal .= '<option value="normal" ' . ($contract->type == "normal" ? "selected" : "") . '>Normal</option>';
        $RateModal .= '<option value="barter">Barter</option>';
        $RateModal .= '<option value="temp">Temporary</option>';
        $RateModal .= '</select>';
        $RateModal .= '</div>';
        $RateModal .= '<div class="col-md-4">';
        $RateModal .= '<label for="company_id" class="form-label">Business <span class="text-danger">*</span></label>';
        $RateModal .= '<select class="form-select form-select-lg mb-4" disabled>';
        $RateModal .= '<option value="">-- Select Business --</option>';
        foreach ($businesses as $business) {
            $RateModal .= '<option '.($contract->bussiness_id == $business->id ? 'selected' : '').' value="'.$business->id.'">'.$business->name.'</option>';
        }
        $RateModal .= '</select>';
        $RateModal .= '</div>';
        $RateModal .= '<div class="col-md-4">';
        $RateModal .= '<label for="voyage_number" class="form-label">Contract Date <span class="text-danger">*</span></label>';
        $RateModal .= '<input type="date" class="form-control form-control-lg" value="'.$contract->date.'" disabled />';
        $RateModal .= '</div>';
        $RateModal .= '<div class="col-md-4">';
        $RateModal .= '<label for="voyage_number" class="form-label">Lifting Date <span class="text-danger">*</span></label>';
        $RateModal .= '<input type="date" class="form-control form-control-lg" value="'.$contract->lifting_date.'" disabled />';
        $RateModal .= '</div>';
        $RateModal .= '<div class="col-md-4">';
        $RateModal .= '<label for="product" class="form-label">Product</label>';
        $RateModal .= '<select class="form-select form-select-lg mb-4" disabled>';
        $RateModal .= '<option value="">-- Select Product --</option>';
        foreach ($products as $product){
            $RateModal .= '<option '.($contract->product_id == $product->id ? 'selected' : '').' value="'.$product->id.'">'.$product->code.'</option>';
        }
        $RateModal .= '</select>';
        $RateModal .= '</div>';
        $RateModal .= '<div class="col-md-4">';
        $RateModal .= '<label for="product_id" class="form-label">Buyer <span class="text-danger">*</span></label>';
        $RateModal .= '<select class="form-select form-select-lg mb-4" disabled>';
        $RateModal .= '<option value="">-- Select Buyers  --</option>';
        foreach ($companies as $company) {
            $RateModal .= '<option '.($contract->buyer_id == $company->id ? 'selected' : '').' value="'.$company->id.'">'.$company->name.'</option>';
        }
        $RateModal .= '</select>';
        $RateModal .= '</div>';
        $RateModal .= '<div class="col-md-4">';
        $RateModal .= '<label class="form-label">Payment Terms <span class="text-danger">*</span></label>';
        $RateModal .= '<select class="form-select form-select-lg mb-4" disabled>';
        $RateModal .= '<option value="">-- Select Payment Term --</option>';
        foreach ($payments as $payment) {
            $RateModal .= '<option '.($contract->payment_term == $payment->id ? 'selected' : '').' value="'.$payment->id.'">'.$payment->name.'</option>';
        }
        $RateModal .= '</select>';
        $RateModal .= '</div>';
        $RateModal .= '<div class="col-md-4 mb-2">';
        $RateModal .= '<label class="form-label">Quantity</label>';
        $RateModal .= '<input type="number" class="form-control" value="'.$contract->quantity.'" disabled>';
        $RateModal .= '</div>';
        $RateModal .= '<div class="col-md-6">';
        $RateModal .= '<label for="voyage_number" class="form-label">Selling Price <span class="text-danger">*</span></label>';
        $RateModal .= '<div class="input-group" id="selling_price">';
        $RateModal .= '<span class="input-group-text" id="basic-addon1">PKR</span>';
        $RateModal .= '<input type="number" class="form-control form-control-lg" value="'.$contract->selling_price.'" name="selling_price" required/>';
        $RateModal .= '</div>';
        $RateModal .= '</div>';
        $RateModal .= '<div class="col-md-6">';
        $RateModal .= '<label class="form-label">Remarks</label>';
        $RateModal .= '<textarea name="remarks" cols="30" rows="1" class="form-control">'.$contract->remarks.'</textarea>';
        $RateModal .= '</div>';
        $RateModal .= '</div>';
        $RateModal .= '</form>';
        $RateModal .= '</div>';
        $RateModal .= '<div class="modal-footer">';
        $RateModal .= '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
        $RateModal .= '<button type="submit" form="QuickRateForm" class="btn btn-primary">Save</button>';
        $RateModal .= '</div>';
        $RateModal .= '</div>';
        $RateModal .= '</div>';

        return response()->json(['RateModal' => $RateModal]);
    }

    public function EditProduct($id)
    {
        $contract = LocalContract::find($id);
        $businesses = Business::get();
        $products = Product::get();
        $companies = Company::get();
        $payments = PaymentTerm::get();

        $ProductModal = '';
        $ProductModal .= '<div class="modal-dialog modal-dialog-centered">';
        $ProductModal .= '<div class="modal-content">';
        $ProductModal .= '<div class="modal-header">';
        $ProductModal .= '<h1 class="modal-title fs-5">Update Product</h1>';
        $ProductModal .= '<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>';
        $ProductModal .= '</div>';
        $ProductModal .= '<div class="modal-body">';
        $ProductModal .= '<form action="'.route('update.product',$contract->id).'" method="get" id="QuickProductForm">';
        $ProductModal .= '<div class="row">';
        $ProductModal .= '<div class="col-md-4">';
        $ProductModal .= '<label for="" class="form-label">Transaction Type</label>';
        $ProductModal .= '<select class="form-select form-select-lg mb-4" disabled>';
        $ProductModal .= '<option>-- Select Tran. Type --</option>';
        $ProductModal .= '<option value="normal" ' . ($contract->type == "normal" ? "selected" : "") . '>Normal</option>';
        $ProductModal .= '<option value="barter">Barter</option>';
        $ProductModal .= '<option value="temp">Temporary</option>';
        $ProductModal .= '</select>';
        $ProductModal .= '</div>';
        $ProductModal .= '<div class="col-md-4">';
        $ProductModal .= '<label for="company_id" class="form-label">Business <span class="text-danger">*</span></label>';
        $ProductModal .= '<select class="form-select form-select-lg mb-4" disabled>';
        $ProductModal .= '<option value="">-- Select Business --</option>';
        foreach ($businesses as $business) {
            $ProductModal .= '<option '.($contract->bussiness_id == $business->id ? 'selected' : '').' value="'.$business->id.'">'.$business->name.'</option>';
        }
        $ProductModal .= '</select>';
        $ProductModal .= '</div>';
        $ProductModal .= '<div class="col-md-4">';
        $ProductModal .= '<label for="voyage_number" class="form-label">Contract Date <span class="text-danger">*</span></label>';
        $ProductModal .= '<input type="date" class="form-control form-control-lg" value="'.$contract->date.'" disabled />';
        $ProductModal .= '</div>';
        $ProductModal .= '<div class="col-md-4">';
        $ProductModal .= '<label for="voyage_number" class="form-label">Lifting Date <span class="text-danger">*</span></label>';
        $ProductModal .= '<input type="date" class="form-control form-control-lg" value="'.$contract->lifting_date.'" disabled />';
        $ProductModal .= '</div>';
        $ProductModal .= '<div class="col-md-4">';
        $ProductModal .= '<label for="product_id" class="form-label">Buyer <span class="text-danger">*</span></label>';
        $ProductModal .= '<select class="form-select form-select-lg mb-4" disabled>';
        $ProductModal .= '<option value="">-- Select Buyers  --</option>';
        foreach ($companies as $company) {
            $ProductModal .= '<option '.($contract->buyer_id == $company->id ? 'selected' : '').' value="'.$company->id.'">'.$company->name.'</option>';
        }
        $ProductModal .= '</select>';
        $ProductModal .= '</div>';
        $ProductModal .= '<div class="col-md-4">';
        $ProductModal .= '<label class="form-label">Payment Terms <span class="text-danger">*</span></label>';
        $ProductModal .= '<select class="form-select form-select-lg mb-4" disabled>';
        $ProductModal .= '<option value="">-- Select Payment Term --</option>';
        foreach ($payments as $payment) {
            $ProductModal .= '<option '.($contract->payment_term == $payment->id ? 'selected' : '').' value="'.$payment->id.'">'.$payment->name.'</option>';
        }
        $ProductModal .= '</select>';
        $ProductModal .= '</div>';
        $ProductModal .= '<div class="col-md-4 mb-2">';
        $ProductModal .= '<label class="form-label">Quantity</label>';
        $ProductModal .= '<input type="number" class="form-control" value="'.$contract->quantity.'" disabled>';
        $ProductModal .= '</div>';
        $ProductModal .= '<div class="col-md-4">';
        $ProductModal .= '<label for="voyage_number" class="form-label">Selling Price</label>';
        $ProductModal .= '<input type="number" class="form-control form-control-lg" value="'.$contract->selling_price.'" disabled/>';
        $ProductModal .= '</div>';
        $ProductModal .= '<div class="col-md-4">';
        $ProductModal .= '<label for="product" class="form-label">Product <span class="text-danger">*</span></label>';
        $ProductModal .= '<select class="form-select form-select-lg mb-4" required name="product_id">';
        $ProductModal .= '<option value="">-- Select Product --</option>';
        foreach ($products as $product){
            $ProductModal .= '<option '.($contract->product_id == $product->id ? 'selected' : '').' value="'.$product->id.'">'.$product->code.'</option>';
        }
        $ProductModal .= '</select>';
        $ProductModal .= '</div>';
        $ProductModal .= '<div class="col-md-6">';
        $ProductModal .= '<label class="form-label">Remarks</label>';
        $ProductModal .= '<textarea name="remarks" cols="30" rows="1" class="form-control">'.$contract->remarks.'</textarea>';
        $ProductModal .= '</div>';
        $ProductModal .= '</div>';
        $ProductModal .= '</form>';
        $ProductModal .= '</div>';
        $ProductModal .= '<div class="modal-footer">';
        $ProductModal .= '<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>';
        $ProductModal .= '<button type="submit" form="QuickProductForm" class="btn btn-primary">Save</button>';
        $ProductModal .= '</div>';
        $ProductModal .= '</div>';
        $ProductModal .= '</div>';

        return response()->json(['ProductModal' => $ProductModal]);
    }

    public function destroy($id)
    {
        $contract = LocalContract::find($id);
        $contract->delete();
        return back();
    }

}
