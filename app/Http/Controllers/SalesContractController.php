<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LocalContract;
use App\Models\Company;
use App\Models\Vessel;
use App\Models\Product;
use App\Models\Inventory;
use App\Models\Business;

class SalesContractController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:normal-contract-list|barter-contract-list|temporary-contract-list', ['only' => ['index','store']]);
         $this->middleware('permission:barter-contract-list', ['only' => ['barter_index']]);
         $this->middleware('permission:temporary-contract-list', ['only' => ['temp_index']]);
    }

    public function normal_index()
    {
        $contracts = LocalContract::where('type','normal')->get();
        $companies = Company::get();
        $vessels = Vessel::get();
        return view('pages.sales_contract.normal',compact('contracts','companies','vessels'));
    }

    public function barter_index()
    {
        $contracts = LocalContract::where('type','barter')->get();
        $companies = Company::get();
        $vessels = Vessel::get();
        return view('pages.sales_contract.barter',compact('contracts','companies','vessels'));
    }

    public function barter_edit($id)
    {
        $businesses = Business::get();
        $buyers = Company::where('local','1')->get();
        $inventories = Inventory::get();
        $products = Product::get();
        $contract = LocalContract::find($id);
        return view('pages.sales_contract.edit_barter',compact('businesses','buyers','inventories','products','contract'));
    }

    public function temp_index()
    {
        $contracts = LocalContract::where('type','temp')->get();
        $companies = Company::get();
        $vessels = Vessel::get();
        return view('pages.sales_contract.temp',compact('contracts','companies','vessels'));
    }

    public function temp_edit($id)
    {
        $businesses = Business::get();
        $buyers = Company::where('local','1')->get();
        $inventories = Inventory::get();
        $products = Product::get();
        $contract = LocalContract::find($id);
        return view('pages.sales_contract.edit_temp',compact('businesses','buyers','inventories','products','contract'));
    }
}
