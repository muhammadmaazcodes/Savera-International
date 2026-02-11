<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LocalContract;
use App\Models\Business;
use App\Models\Product;
use App\Models\Company;
use App\Models\InventoryBL;
use App\Models\Inventory;
use App\Models\ContractBL;
use Session;

class LocalContractController extends Controller
{
    public function index()
    {
        $contracts = LocalContract::get();
        return view('pages.local-contract.index',compact('contracts'));
    }

    public function create()
    {
        $businesses = Business::all();
        $buyers = Company::all();
        $products = Product::all();
        return view('pages.local-contract.create',compact('businesses','buyers','products'));
    }

    public function create_2($id)
    {
        $contract = LocalContract::find($id);
        $bl_contract = ContractBL::where('contract_id',$contract->id)->get();
        return view('pages.local-contract.create-2',compact('contract','bl_contract'));    
    }

    public function quantity_update(Request $request,$id)
    {
        $contract = LocalContract::find($id);
        $contract->quantity = $request->quantity;
        $contract->update();
        return redirect()->route('local-contract.index');
    }


    public function fetchInventory(Request $request)
    {
        $inventories = Inventory::where("product_id", $request->product_id)->get();
        $inventorybl = [];
        foreach ($inventories as $key => $inventory) {
            $return = [];
            foreach($inventory->bls as $bl) {
                $return[] = array(
                    'id' => $bl->id,
                    'bl_number' => $bl->bl_number,
                    'bl_qty' => $bl->bl_quantity,
                    'vessel' => $bl->inventory->vessel->name
                );
            }
        }
        return response()->json($return);
    }

    public function store(Request $request)
    {        
        $business = Business::find($request->business_id);
        $buyer = Company::find($request->buyer_id);
        $product = Product::find($request->product_id);

        $contract = new LocalContract();
        $contract->business_id = $request->business_id;
        $contract->buyer_id = $request->buyer_id;
        $contract->product_id = $request->product_id;
        $contract->reference = $business->code.'/'.$buyer->code.'/'.$product->code.'/'.date('Y-m-d');        
        $bls_inventory = InventoryBL::whereIn("id",$request->inventory_bl)->get();
        $contract->save();
        
        foreach ($request->inventory_bl as $key => $inventory_bl) {
            $bl_contract = new ContractBL();
            $bl_contract->inventorybl_id = $inventory_bl;
            $bl_contract->contract_id = $contract->id;
            $bl_inventory = InventoryBL::where("id",$inventory_bl)->first();
            $bl_contract->quantity = $bl_inventory->bl_quantity;
            $bl_contract->save();
        }
        return redirect()->route('contract.create-2',$contract->id);
    }

    public function edit($id)
    {
        // 
    }

    public function update(Request $request,$id)
    {
        // 
    }

    public function destroy($id)
    {
        // 
    }
}
