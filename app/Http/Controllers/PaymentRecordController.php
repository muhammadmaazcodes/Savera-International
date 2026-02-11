<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GeneralLedger;
use App\Models\Ledger;
use App\Models\Inventory;
use App\Models\LocalContract;

class PaymentRecordController extends Controller
{
    public function index()
    {
        $general_ledgers = GeneralLedger::get();
        return view('pages.general-ledger.index',compact('general_ledgers'));
    }

    public function inventory()
    {
        $inventories = Inventory::get();
        return view('pages.payment_record.inventory',compact('inventories'));
    }
    
    public function payment_invetory(Request $request)
    {
        $inventory = Inventory::find($request->inventory_id);
        $general_ledger = new GeneralLedger();

            $lastRecord = Ledger::where('ledgerable_type','App\Models\Inventory')->first();
            $count = count(Ledger::where('ledgerable_type','App\Models\Inventory')->get());
            if ($lastRecord) {
                $lastNumber = (int) substr($count, -3);
                $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $nextNumber = '001';
            }

        $general_ledger->account = 'VOY-'.$inventory->voyage_number;
        $general_ledger->date = $request->date;
        $general_ledger->description = 'Purchase';
        $general_ledger->debit = $request->amount;
        $general_ledger->reference = 'INV-'.$nextNumber;
        $general_ledger->save();

        $ledger = new Ledger();
        $ledger->gl_id = $general_ledger->id;
        $ledger->ledgerable_id = $request->inventory_id;
        $ledger->ledgerable_type = "App\Models\Inventory";
        $ledger->save();
        return redirect()->back();
    }

    public function local_contract()
    {
        $local_contracts = LocalContract::where('type','normal')->get();
        return view('pages.payment_record.local-contract',compact('local_contracts'));
    }

    public function payment_contract(Request $request)
    {
        $local_contract = LocalContract::find($request->local_contract_id);
        $general_ledger = new GeneralLedger();

            $lastRecord = Ledger::where('ledgerable_type','App\Models\LocalContract')->first();
            $count = count(Ledger::where('ledgerable_type','App\Models\LocalContract')->get());
            if ($lastRecord) {
                $lastNumber = (int) substr($count, -3);
                $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $nextNumber = '001';
            }

        $general_ledger->account = $local_contract->code;
        $general_ledger->date = $request->date;
        $general_ledger->description = 'Purchase';
        $general_ledger->debit = $request->amount;
        $general_ledger->reference = 'LC-'.$nextNumber;
        $general_ledger->save();

        $ledger = new Ledger();
        $ledger->gl_id = $general_ledger->id;
        $ledger->ledgerable_id = $request->local_contract_id;
        $ledger->ledgerable_type = "App\Models\LocalContract";
        $ledger->save();
        return redirect()->back();
    }
}
