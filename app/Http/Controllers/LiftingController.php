<?php

namespace App\Http\Controllers;

use App\Models\LiftingBLCommingle;
use DB;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Company;
use App\Models\SalesRequest;
use App\Models\InventoryBL;
use App\Models\Lifting;
use App\Models\LiftingBL;

class LiftingController extends Controller
{
    public function store(Request $request)
    {
        $sale =  SalesRequest::find($request->sale_id);
        $sale->gate_pass = $request->gate_pass;
       
        if($request->bl_id) {
            DB::beginTransaction();
            try {

                foreach ($request->bl_id as $key => $bl) {
                    $exist = LiftingBL::where('bl_id',$bl['bl_id'])->where('sale_id',$sale->id)->first();
                    $lifted_qty = LiftingBL::where('sale_id',$sale->id)->sum('quantity');
                    $inv_bl = InventoryBL::find($bl['bl_id']);

                    if (!$exist) {
                        
                        if ($bl['bl_quantity'] > 0) {
                            if ($bl['bl_quantity'] <= $inv_bl->unlifted_qty()) {
                                $lifting_bl = new LiftingBL();
                                $lifting_bl->bl_id = $bl['bl_id'];
                                $lifting_bl->quantity = $bl['bl_quantity'];
                                $lifting_bl->sale_id = $request->sale_id;
                                $lifting_bl->save();
                                if ($bl['commingle_qty'] > 0) {
                                    $commingle = new LiftingBLCommingle();
                                    $commingle->lifting_bl_id = $lifting_bl->id;
                                    // $commingle->commingle_id = $bl['commingle_id'];
                                    $commingle->quantity = $bl['commingle_qty'];
                                    $commingle->save();
                                }
                            }
                            else {
                                DB::rollBack();
                                return response()->json(['error' => 'Quantity should be equal to or less than BL Unlifted quantity!'],404);
                            }
                        }
                        else {
                            DB::rollBack();
                            return response()->json(['error' => 'Please enter quantity!'],404);
                        }

                    }
                    else {
                        DB::rollBack();
                        return response()->json(['error' => 'Duplicate Entry!'],404);
                    }
                    

            }
                
            } catch (\Throwable $th) {
                DB::rollBack();
                return response()->json(['error' => 'Unable to proceed!'],404);
            }
            
        }
        
        if ($request->completed == 'yes') {
            $sale->status = 1;
        }
        $sale->update();
        
        DB::commit();
        if ($request->completed == 'yes') {
            return redirect('sales-request/process');
        }
        return response()->json(['success' => 'BL Added in Lifting!']);
    }
}
