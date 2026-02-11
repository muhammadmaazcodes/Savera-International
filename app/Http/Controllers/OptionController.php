<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Option;

class OptionController extends Controller
{
    public function index()
    {
        $options = Option::get();
        $values = [];        
        foreach ($options as $option) {
            $values[$option->name] = $option->content;    
        }
        return view('pages.options.index',compact('values'));
    }

    public function update(Request $request)
    {
        if ($request->cc_mm_charges) {
            if(is_float((float)$request->cc_mm_charges)){
                $option = Option::where('name','cc_mm_charges')->first();
                $option->content = $request->cc_mm_charges;
                $option->update();
            }
            else {
                return back()->with('error','M.M.Charges must be type float');
            }
        }

        if ($request->collector_of_customs_palm_oil) {
            if(is_float((float)$request->collector_of_customs_palm_oil)){
                $option = Option::where('name','collector_of_customs_palm_oil')->first();
                $option->content = $request->collector_of_customs_palm_oil;
                $option->update();
            }
            else {
                return back()->with('error','Collector of Customs must be type float');
            }
        }

        if ($request->collector_of_customs_rbd_olein) {
            if(is_float((float)$request->collector_of_customs_rbd_olein)){
                $option = Option::where('name','collector_of_customs_rbd_olein')->first();
                $option->content = $request->collector_of_customs_rbd_olein;
                $option->update();
            }
            else {
                return back()->with('error','Collector of Customs must be type float');
            }
        }

        if ($request->coc_pqa) {
            if(is_float((float)$request->coc_pqa)){
                $option = Option::where('name','coc_pqa')->first();
                $option->content = $request->coc_pqa;
                $option->update();
            }
            else {
                return back()->with('error','COC PQA must be type float');
            }
        }

        if ($request->cc_pqa) {
            if(is_float((float)$request->cc_pqa)){
                $option = Option::where('name','cc_pqa')->first();
                $option->content = $request->cc_pqa;
                $option->update();
            }
            else {
                return back()->with('error','PQA / MT must be type float');
            }
        }

        if ($request->cc_e_and_t) {
            if(is_float((float)$request->cc_e_and_t)){
                $option = Option::where('name','cc_e_and_t')->first();
                $option->content = $request->cc_e_and_t;
                $option->update();
            }
            else {
                return back()->with('error','E&T (PQA) must be type float');
            }
        }

        if ($request->cc_marking) {
            if(is_float((float)$request->cc_marking)){
                $option = Option::where('name','cc_marking')->first();
                $option->content = $request->cc_marking;
                $option->update();
            }
            else {
                return back()->with('error','Marking must be type float');
            }
        }

        if ($request->cc_insurance_charges) {
            if(is_float((float)$request->cc_insurance_charges)){
                $option = Option::where('name','cc_insurance_charges')->first();
                $option->content = $request->cc_insurance_charges;
                $option->update();
            }
            else {
                return back()->with('error','Insurance Charges must be type float');
            }
        }

        if ($request->cc_per_vessel_charges) {
            if(is_numeric($request->cc_per_vessel_charges)){
                $option = Option::where('name','cc_per_vessel_charges')->first();
                $option->content = $request->cc_per_vessel_charges;
                $option->update();
            }
            else {
                return back()->with('error','Per Vessel Charges must be type Numeric');
            }
        }

        if ($request->cc_handling) {
            if(is_numeric($request->cc_handling)) {
                $option = Option::where('name','cc_handling')->first();
                $option->content = $request->cc_handling;
                $option->update();
            }
            else {
                return back()->with('error','Storage/Handling/C.Agent must be type Numeric');
            }
        }

        if ($request->cc_withholding) {
            if(is_numeric($request->cc_withholding)) {
                $option = Option::where('name','cc_withholding')->first();
                $option->content = $request->cc_withholding;
                $option->update();
            }
            else {
                return back()->with('error','WITHHOLDING must be type Numeric');
            }
        }

        return back()->with('success',"Cost Calculator Configuration Updated Successfully");
    }


    // public function update(Request $request, $name)
    // {
    //     if($name == 'cc_mm_charges' || $name == 'collector_of_customs' || $name == 'coc_pqa' || $name == 'cc_pqa' || $name == 'cc_e_and_t' || $name == 'cc_marking' || $name == 'cc_insurance_charges'){
    //         if(is_float($request->value))
    //         {
    //             $option = Option::where('name',$name)->first();
    //             $option->content = $request->value;
    //             $option->update();
    //             return back();
    //         }
    //         else {
    //             return back();
    //         }
    //     }
    //     if($name == 'cc_per_vessel_charges' || $name == 'cc_handling' || $name == 'cc_withholding'){
    //         if (is_numeric($request->value)) {
    //             $option = Option::where('name',$name)->first();
    //             $option->content = $request->value;
    //             $option->update();
    //             return back();
    //         }
    //         else {
    //             return back();
    //         }
    //     }
    // }
}
