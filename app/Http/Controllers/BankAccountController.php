<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
         $this->middleware('permission:bank-account-list|bank-account-create|bank-account-edit|bank-account-delete', ['only' => ['index','store']]);
         $this->middleware('permission:bank-account-create', ['only' => ['create','store']]);
         $this->middleware('permission:bank-account-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:bank-account-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $bank_accounts = BankAccount::orderBy('created_at','ASC')->get();
        return view('pages.bank-accounts.index',compact('bank_accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.bank-accounts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'account_title' => 'required|max:255',
            'bank_name' => 'required|max:255',
        ]);
        
        BankAccount::create($request->all());
        return redirect('bank-accounts')->with('status', 'BankAccount Added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(BankAccount $bank_account)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(BankAccount $bank_account)
    {
        return view('pages.bank-accounts.edit', compact('bank_account'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, BankAccount $bank_account)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'account_title' => 'required|max:255',
            'bank_name' => 'required|max:255',
        ]);
        $bank_account->update($request->all());
        return redirect('bank-accounts')->with('status', 'BankAccount Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(BankAccount $bank_account)
    {
        $bank_account->delete();
        return back();
    }
}
