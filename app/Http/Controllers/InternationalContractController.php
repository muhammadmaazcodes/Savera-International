<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\InternationalContract;
use App\Models\Business;
use App\Models\Product;
use App\Models\Company;
use App\Models\Document;

class InternationalContractController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:international-contract-list|international-contract-create|international-contract-edit|international-contract-split|international-contract-washout', ['only' => ['index','store']]);
         $this->middleware('permission:international-contract-create', ['only' => ['create','store']]);
         $this->middleware('permission:international-contract-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:international-contract-washout', ['only' => ['washout']]);
         $this->middleware('permission:international-contract-split', ['only' => ['contract_split']]);
    }

    public function index()
    {
        $internationals = InternationalContract::get();
        return view('pages.international-contract.index',compact('internationals'));
    }
    
    public function create()
    {
        $businesses = Business::get();
        $products = Product::get();
        $companies = Company::get();
        return view('pages.international-contract.create',compact('businesses','products','companies'));
    }

    public function edit($id)
    {
        $contract = InternationalContract::find($id);
        $businesses = Business::get();
        $products = Product::get();
        $companies = Company::get();
        return view('pages.international-contract.edit',compact('contract','businesses','products','companies'));    
    }

    public function contract_split($id)
    {
        $businesses = Business::get();
        $products = Product::get();
        $companies = Company::get();
        $contract = InternationalContract::find($id);
        return view('pages.international-contract.split',compact('contract','businesses','products','companies'));
    }

    public function washout($id)
    {
        $contract = InternationalContract::find($id);
        $contract->status = 'washout';
        $contract->update();
        return redirect()->back();
    }

    public function store(Request $request)
    {
        $international = new InternationalContract();
        $international->product_id = $request->product_id;
        $international->business_id = $request->business_id;
        $international->seller_id = $request->seller_id;
        $international->buyer_id = $request->buyer_id;
        $international->quantity = $request->quantity;
        $international->status = $request->status;
        $international->save();
        return redirect()->route('international-contract.index');
    }

    public function update(Request $request,$id)
    {
        $international = InternationalContract::find($id);
        $international->product_id = $request->product_id;
        $international->business_id = $request->business_id;
        $international->seller_id = $request->seller_id;
        $international->buyer_id = $request->buyer_id;
        $international->quantity = $request->quantity;
        $international->update();
        return redirect()->route('international-contract.index');
    }

    public function contract_split_store(Request $request)
    {
        $splits = $request->contract_splits;
        $international = InternationalContract::find($request->contract_id);
        $international->update(['status' => 'split']);

        foreach ($splits as $key => $split) {
            $international = new InternationalContract();
            $international->product_id = $split['product_id'];
            $international->business_id = $split['business_id'];
            $international->seller_id = $split['seller_id'];
            $international->buyer_id = $split['buyer_id'];
            $international->quantity = $split['quantity'];
            $international->parent_id = $request->contract_id;
            $international->save();
        }
        return redirect()->route('international-contract.index');
    }

    public function upload_document(Request $request)
    {
        // return $request;
        $document = new Document;
        $document->documentable_id = $request->contract_id;
        $file = $request->file;
        $filename = time().'_'.$file->getClientOriginalName();

        $location = public_path('documents/international-contract/'.$request->type.'/');

        $file->move($location,$filename);
        $document->document = $filename;
        $document->type = $request->type;
        $document->documentable_type = "App\Models\InternationalContract";
        $document->save();
        return redirect()->back();
    }
}