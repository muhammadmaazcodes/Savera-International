<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Business;
use App\Models\Company;
use App\Models\InventoryBL;
use App\Models\InventoryStock;
use App\Models\Product;
use App\Models\Vessel;
use App\Models\Inventory;
use App\Models\LocalContract;
use App\Models\VesselAllocation;
use App\Models\BLAllocation;
use Illuminate\Http\Request;
use DB;

class VesselAllocationController extends Controller
{
    public function index()
    {
        $contracts = LocalContract::orderBy('date','desc')->get();
        $companies = Company::where('local',1)->get();
        $businesses = Business::get();
        $vessels = Inventory::get();
        $products = Product::get();
        return view("pages.local-contract.vessel-allocation.index", compact("contracts","companies","businesses","vessels","products"));
    }

    public function allocate(Request $request, $id)
    {
        $contract = LocalContract::find($id);
        $total_qty = 0;
        foreach ($request->vessel_allocations as $key => $value) {
            $total_qty += $value['quantity'];
        }
        $total_qty += $contract->allocations->sum('quantity');
        
        if ($total_qty <= $contract->quantity) {
            DB::beginTransaction();
            try {

                foreach ($request->vessel_allocations as $key => $allocation) {
                    $inv = Inventory::find($allocation['inventory_id']);
                    if (!empty($inv->voyage_number)) {
                        if ($allocation['quantity'] <= $inv->unsold_qty_by_pd($contract->product_id)) {
                            
                                $allocate = new VesselAllocation();
                                $allocate->inventory_id = $allocation['inventory_id'];
                                $allocate->contract_id = $contract->id;
                                $allocate->quantity = $allocation['quantity'];
                                $allocate->contract_number = $allocation['quantity'];
            
                                $lastRecord = VesselAllocation::where('inventory_id',$allocation['inventory_id'])->first();
                                $count = count(VesselAllocation::where('inventory_id',$allocation['inventory_id'])->get());
                                if ($lastRecord) {
                                    $lastNumber = (int) substr($count, -3);
                                    $nextNumber = str_pad($lastNumber + 1, 1, '0', STR_PAD_LEFT);
                                }
            
                                $voyage_number = $inv->voyage_number;
                                $exploded = explode("/",$contract->code);
                                $code_business = $exploded[0];
                                $code_month = $exploded[1];
                                $code_product = $exploded[2];
                                $code_auto_num = $exploded[3];
                                
                                $allocation_code = [];
                                $allocation_code[0] = $code_business;
                                $allocation_code[1] = $code_month;
                                $allocation_code[2] = $code_product;
                                $allocation_code[3] = $voyage_number;
                                if (isset($nextNumber)) {
                                    $allocation_code[4] = $code_auto_num.'-'.$nextNumber;
                                }
                                else {
                                    $allocation_code[4] = $code_auto_num;
                                }
            
                                $allocate->contract_number = implode('/',$allocation_code);
            
                                $allocate->save();
                        }
                        else {
                            DB::rollBack();
                            return redirect('local-contracts/vessel-allocation')->with('warning','Entered quantity is more than Unsold Qty!')->with('contract-id',$contract->id);
                        }
                    }
                    else {
                        DB::rollBack();
                        return redirect('local-contracts/vessel-allocation')->with('warning','Voyage number not found in the inventory!')->with('contract-id',$contract->id);
                    }
                }
                
            } catch (\Throwable $th) {
                DB::rollBack();
                return redirect('local-contracts/vessel-allocation')->with('warning','Something went wrong!')->with('contract-id',$contract->id);
            }
            
        }
        else {
            return  redirect('local-contracts/vessel-allocation')->with('warning','Quantity exceeded!')->with('contract-id',$contract->id);
        }
        DB::commit();
        return redirect('local-contracts/vessel-allocation')->with('success','Vessel Allocated!')->with('contract-id',$contract->id);
    }

    public function bl_index($id)
    {
        $vessel_allocation = VesselAllocation::find($id); 
        $bls = $vessel_allocation->inventory->bls->where('product_id',$vessel_allocation->contract->product_id)->where('bl_status','!=','Lifting Completed')->groupBy('provisional_price');
        $bl_allocations = BLAllocation::where('vessel_allocation_id',$vessel_allocation->id)->get();
        return view('pages.local-contract.vessel-allocation.bl-allocation',compact('bls','vessel_allocation','bl_allocations'));
    }

    public function bl_allocate(Request $request, $id)
    {
        $vessel_allocation = VesselAllocation::find($id);

        DB::beginTransaction();
        try {

            foreach ($request->allocations as $key => $allocation) {
                $exists = BLAllocation::where('bl_id',$allocation['bl_id'])
                        ->where('vessel_allocation_id',$vessel_allocation->id)
                        ->first();
                $bl_allocations = BLAllocation::where('vessel_allocation_id',$vessel_allocation->id)->get();
                $total_allocation_qty = $bl_allocations->sum('quantity') + $allocation['quantity'];
                $single_bl = InventoryBL::find($allocation['bl_id']);
                if ($total_allocation_qty <= $vessel_allocation->quantity && $allocation['quantity'] <= $single_bl->landed_quantity) {
                        if (!$exists) {
                            $bl_allocate = new BLAllocation();
                            $bl_allocate->vessel_allocation_id = $vessel_allocation->id;
                            $bl_allocate->bl_id = $allocation['bl_id'];
                            $bl_allocate->quantity = $allocation['quantity'];
                            $bl_allocate->save();
                        }
                        else {
                            DB::rollBack();
                            return response()->json(['error' => 'BL Already Exist!']);
                        }
                }
                else {
                    DB::rollBack();
                    return response()->json(['error' => 'Quantity Exceed!']);
                }

            }
            
        } catch (\Throwable $th) {
            DB::rollBack();
            return response()->json(['error' => 'Unable to proceed!']);
        }

        DB::commit();
        return response()->json(['success' => 'BL Allocated!']);
    }

    public function delete($id)
    {
        $vessel_allocation = VesselAllocation::find($id);
        $contract_id = $vessel_allocation->contract_id;
        $vessel_allocation->delete();
        return back()->with('contract-id',$contract_id);
    }

    public function bl_delete($id)
    {
        $bl_allocation = BLAllocation::find($id);
        $bl_allocation->delete();
        return back();
    }
}
