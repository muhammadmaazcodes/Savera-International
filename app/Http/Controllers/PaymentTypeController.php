<?php

namespace App\Http\Controllers;

use App\Models\PaymentType;
use Illuminate\Http\Request;

class PaymentTypeController extends Controller
{/**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment_types = PaymentType::orderBy('created_at','ASC')->get();
        return view('pages.paymenttypes.index',compact('payment_types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.paymenttypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255'
        ]);
        
        PaymentType::create($request->all());
        return redirect('payment-types')->with('status', 'Payment Type Added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentType $payment_type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentType $payment_type)
    {
        return view('pages.paymenttypes.edit', compact('payment_type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentType $payment_type)
    {
        $validated = $request->validate([
            'name' => 'required|max:255'
        ]);
        $payment_type->update($request->all());
        return redirect('payment-types')->with('status', 'Payment Type Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PaymentType $payment_type)
    {
        $payment_type->delete();
        return back();
    }
}
