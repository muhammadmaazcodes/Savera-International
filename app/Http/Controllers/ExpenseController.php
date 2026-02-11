<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\GeneralLedger;
use App\Models\Ledger;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
         $this->middleware('permission:expense-list|expense-create', ['only' => ['index','store']]);
         $this->middleware('permission:expense-create', ['only' => ['create','store']]);
    }

    public function index()
    {
        $expenses = Expense::get();
        return view('pages.expense.index',compact('expenses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.expense.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request;
        $expense = new Expense();
        $expense->date = $request->date;
        $expense->description = $request->description;
        $expense->amount = $request->amount;
        $expense->save();


            $general_ledger = new GeneralLedger();

            $lastRecord = Ledger::where('ledgerable_type','App\Models\Expense')->first();
            $count = count(Ledger::where('ledgerable_type','App\Models\Expense')->get());
            if ($lastRecord) {
                $lastNumber = (int) substr($count, -3);
                $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $nextNumber = '001';
            }

            $general_ledger->account = $expense->description;
            $general_ledger->date = $expense->date;
            $general_ledger->description = $expense->description;
            $general_ledger->debit = $expense->amount;
            $general_ledger->reference = 'EXP-'.$nextNumber;
            $general_ledger->save();

        $ledger = new Ledger();
        $ledger->gl_id = $general_ledger->id;
        $ledger->ledgerable_id = $expense->id;
        $ledger->ledgerable_type = "App\Models\Expense";
        $ledger->save();

        return redirect()->route('expense.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(Ledger $ledger)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Ledger $ledger)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Ledger $ledger)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ledger $ledger)
    {
        //
    }
}
