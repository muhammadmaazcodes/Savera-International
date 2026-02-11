<?php

namespace App\Http\Controllers;

use App\Models\PaymentTerm;
use Illuminate\Http\Request;

class PaymentTermController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:payment-term-list|payment-term-create|payment-term-edit|payment-term-delete', ['only' => ['index','store']]);
         $this->middleware('permission:payment-term-create', ['only' => ['create','store']]);
         $this->middleware('permission:payment-term-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:payment-term-delete', ['only' => ['destroy']]);
    }

     public function index()
    {
        $payment_terms = PaymentTerm::orderBy('order','ASC')->get();
        return view('pages.paymentterms.index',compact('payment_terms'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.paymentterms.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255'
        ]);
        
        PaymentTerm::create($request->all());
        return redirect('payment-terms')->with('status', 'Payment Term Added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PaymentTerm $payment_term)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PaymentTerm $payment_term)
    {
        return view('pages.paymentterms.edit', compact('payment_term'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PaymentTerm $payment_term)
    {
        $validated = $request->validate([
            'name' => 'required|max:255'
        ]);
        $payment_term->name = $request->name;
        $payment_term->local = $request->local ?? 0;
        $payment_term->international = $request->international ?? 0;
        $payment_term->update();
        return redirect('payment-terms')->with('status', 'Payment Term Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment_term = PaymentTerm::find($id);
        $payment_term->delete();
        return back();
    }
}
