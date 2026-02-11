<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TransactionType;

class TransactionTypeController extends Controller
{
    function __construct()
    {
        // $this->middleware('permission:transaction-type-list|transaction-type-create|transaction-type-edit|transaction-type-delete', ['only' => ['index','store']]);
        // $this->middleware('permission:transaction-type-create', ['only' => ['create','store']]);
        // $this->middleware('permission:transaction-type-edit', ['only' => ['edit','update']]);
        // $this->middleware('permission:transaction-type-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $transaction_types = TransactionType::orderBy('created_at','ASC')->get();
        return view('pages.transaction-type.index',compact('transaction_types'));
    }

    public function create()
    {
        // 
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|unique:transaction_type',

        ]);
        
        $transaction_types = TransactionType::create($request->all());
        return back();
    }

    public function edit($id)
    {
        // 
    }


    public function update(Request $request, $id)
    {
        $transaction_type = TransactionType::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|unique:transaction_type,code,'.$transaction_type->id
        ]);
        $transaction_type->update($request->all());
        return back();
    }

    public function destroy($id)
    {
        $transaction_type = TransactionType::findOrFail($id);
        $transaction_type->delete();
        return back();
    }
}
