<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Collection;
use App\Models\Company;
use App\Models\Inventory;
use App\Models\PaymentTerm;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
        $this->middleware('permission:collection-list|collection-create|collection-edit|collection-delete', ['only' => ['index','store']]);
        $this->middleware('permission:collection-create', ['only' => ['create','store']]);
        $this->middleware('permission:collection-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:collection-add-bulk', ['only' => ['bulk','bulk_store']]);
    }

    public function index()
    {
        $collections = Collection::get();
        return view('pages.collections.index',compact('collections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $inventories = Inventory::get();
        $buyers = Company::get();
        $payment_modes = PaymentTerm::get();
        return view('pages.collections.create',compact('inventories','buyers','payment_modes'));
    }

    public function bulk()
    {
        $inventories = Inventory::get();
        $buyers = Company::get();
        $payment_modes = PaymentTerm::get();
        return view('pages.collections.bulk',compact('inventories','buyers','payment_modes'));
    }

    public function bulk_store(Request $request)
    {
        $dates = $request->date;
        $voyages = $request->voyage;
        $buyers = $request->buyer_id;
        $vessels = $request->vessel_id;
        $payment_modes = $request->payment_mode;
        $branches = $request->branch;
        $bank_codes = $request->bank_code;
        $ac_titles = $request->ac_title;
        $amounts = $request->amount;
        $cheques = $request->cheque_number;
        $slips = $request->slip_number;
        $remarks = $request->remarks;
        $statuses = $request->status;
  
    for ($i = 0; $i < count($buyers); $i++) {
        $date = $dates[$i];
        $voyage = $voyages[$i];
        $buyer = $buyers[$i];
        $vessel = $vessels[$i];
        $branch = $branches[$i];
        $payment_mode = $payment_modes[$i];
        $bank_code = $bank_codes[$i];
        $ac_title = $ac_titles[$i];
        $amount = $amounts[$i];
        $cheque = $cheques[$i];
        $slip = $slips[$i];
        $remark = $remarks[$i];
        $status = $statuses[$i];
        
        Collection::create(['date' => $date,
                            'voyage' => $voyage,
                            'buyer_id' => $buyer,
                            'vessel_id' => $vessel,
                            'payment_mode' => $payment_mode,
                            'branch' => $branch,
                            'bank_code' => $bank_code,
                            'ac_title' => $ac_title,
                            'amount' => $amount,
                            'cheque_number' => $cheque,
                            'slip_number' => $slip,
                            'remarks' => $remark,
                            'status' => $status
                        ]);
    }
        return response()->json(['success' => 'Addded In Bulk !']);
       
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $collection = new Collection();
        $collection->buyer_id = $request->buyer_id;
        $collection->voyage = $request->voyage;
        $collection->vessel_id = $request->vessel_id;
        $collection->date = $request->date;
        $collection->bank_code = $request->bank_code;
        $collection->ac_title = $request->ac_title;
        $collection->branch = $request->branch;
        $collection->payment_mode = $request->payment_mode;
        $collection->slip_number = $request->slip_number;
        $collection->cheque_number = $request->cheque_number;
        $collection->amount = $request->amount;
        $collection->status = $request->status;
        $collection->remarks = $request->remarks;
        $collection->save();
        return redirect()->route('collection.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // 
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $collection = Collection::find($id);
        $inventories = Inventory::get();
        $buyers = Company::get();
        $payment_modes = PaymentTerm::get();
        return view('pages.collections.edit',compact('collection','inventories','buyers','payment_modes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $collection = Collection::find($id);
        $collection->buyer_id = $request->buyer_id;
        $collection->voyage = $request->voyage;
        $collection->vessel_id = $request->vessel_id;
        $collection->date = $request->date;
        $collection->bank_code = $request->bank_code;
        $collection->ac_title = $request->ac_title;
        $collection->branch = $request->branch;
        $collection->payment_mode = $request->payment_mode;
        $collection->slip_number = $request->slip_number;
        $collection->cheque_number = $request->cheque_number;
        $collection->amount = $request->amount;
        $collection->status = $request->status;
        $collection->remarks = $request->remarks;
        $collection->update();
        return redirect()->route('collection.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 
    }
}
