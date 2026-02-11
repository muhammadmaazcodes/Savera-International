<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\CustomPayment;
use App\Models\Inventory;
use App\Models\PaymentCheque;
use App\Models\Vessel;
use Illuminate\Http\Request;
use App\Models\BankAccount;
use DB;

class CustomPaymentController extends Controller
{
    public function posting_date()
    {
        $banks = BankAccount::get();
        $payments = CustomPayment::orderBy('posting_date','desc')->get()->groupBy('posting_date');
        return view('pages.customs-payments.posting-date-index',compact('banks','payments'));
    }

    public function vessel()
    {
        $payments = CustomPayment::get()->groupBy('inventory_id');
        return view('pages.customs-payments.vessel-index',compact('payments'));
    }

    public function customer()
    {
        $payments = CustomPayment::get()->groupBy('customer_name');
        return view('pages.customs-payments.customer-index',compact('payments'));
    }

    public function transaction()
    {
        $payments = CustomPayment::get();
        $vessels = Vessel::get();
        $banks = BankAccount::get();
        $transaction['total'] = CustomPayment::count(); 
        $transaction['verified'] = CustomPayment::where('status','Verified')->count(); 
        $transaction['unverified'] = CustomPayment::where('status','Unverified')->count();
        return view('pages.customs-payments.transaction-index',compact('payments','transaction','vessels','banks'));
    }

    public function create_cash()
    {
        $inventories = Inventory::all();
        $payments = CustomPayment::where('type','cash')->get();
        $amount['total'] = CustomPayment::where('type','cash')->sum('amount'); 
        $amount['verified'] = CustomPayment::where('type','cash')->where('status','Verified')->sum('amount'); 
        $amount['unverified'] = CustomPayment::where('type','cash')->where('status','Unverified')->sum('amount'); 
        $transaction['total'] = CustomPayment::where('type','cash')->count(); 
        $transaction['verified'] = CustomPayment::where('type','cash')->where('status','Verified')->count(); 
        $transaction['unverified'] = CustomPayment::where('type','cash')->where('status','Unverified')->count(); 
        $customers = Company::get();
        return view('pages.customs-payments.create_cash',compact('inventories','payments','customers','amount','transaction'));
    }

    public function edit_cash($id)
    {
        $custom_payment = CustomPayment::find($id);
        $inventories = Inventory::all();
        $payments = CustomPayment::where('type','cash')->get();
        return view('pages.customs-payments.edit_cash',compact('inventories','payments','custom_payment'));
    }

    public function create_settlement()
    {
        $inventories = Inventory::all();
        $payments = CustomPayment::where('type','settlement')->get();
        $amount['total'] = CustomPayment::where('type','settlement')->sum('amount'); 
        $amount['verified'] = CustomPayment::where('type','settlement')->where('status','Verified')->sum('amount'); 
        $amount['unverified'] = CustomPayment::where('type','settlement')->where('status','Unverified')->sum('amount'); 
        $transaction['total'] = CustomPayment::where('type','settlement')->count(); 
        $transaction['verified'] = CustomPayment::where('type','settlement')->where('status','Verified')->count(); 
        $transaction['unverified'] = CustomPayment::where('type','settlement')->where('status','Unverified')->count();
        return view('pages.customs-payments.create_settlement',compact('inventories','payments','amount','transaction'));
    }

    public function edit_settlement($id)
    {
        $custom_payment = CustomPayment::find($id);
        $inventories = Inventory::all();
        $payments = CustomPayment::where('type','settlement')->get();
        return view('pages.customs-payments.edit_settlement',compact('inventories','payments','custom_payment'));
    }

    public function create_bank_deposit()
    {
        $bank_accounts = BankAccount::all();
        $inventories = Inventory::all();
        $cheques = PaymentCheque::with('payment')->get();
        $buyers = Company::where('local',1)->get();
        $amount['total'] = CustomPayment::where('type','bank_deposit')->sum('amount'); 
        $amount['verified'] = CustomPayment::where('type','bank_deposit')->where('status','Verified')->sum('amount'); 
        $amount['unverified'] = CustomPayment::where('type','bank_deposit')->where('status','Unverified')->sum('amount'); 
        $transaction['total'] = CustomPayment::where('type','bank_deposit')->count(); 
        $transaction['verified'] = CustomPayment::where('type','bank_deposit')->where('status','Verified')->count(); 
        $transaction['unverified'] = CustomPayment::where('type','bank_deposit')->where('status','Unverified')->count();
        return view('pages.customs-payments.create_bank_deposit',compact('bank_accounts','inventories','amount','transaction','cheques','buyers'));
    }

    public function edit_bank_deposit($id)
    {
        $custom_payment = CustomPayment::find($id);
        $bank_accounts = BankAccount::all();
        $inventories = Inventory::all();
        $cheques = PaymentCheque::with('payment')->get();
        $buyers = Company::where('local',1)->get();
        $amount['total'] = CustomPayment::where('type','bank_deposit')->sum('amount'); 
        $amount['verified'] = CustomPayment::where('type','bank_deposit')->where('status','Verified')->sum('amount'); 
        $amount['unverified'] = CustomPayment::where('type','bank_deposit')->where('status','Unverified')->sum('amount'); 
        $transaction['total'] = CustomPayment::where('type','bank_deposit')->count(); 
        $transaction['verified'] = CustomPayment::where('type','bank_deposit')->where('status','Verified')->count(); 
        $transaction['unverified'] = CustomPayment::where('type','bank_deposit')->where('status','Unverified')->count();
        return view('pages.customs-payments.edit_bank_deposit',compact('bank_accounts','buyers','inventories','cheques','custom_payment','amount','transaction'));
    }

    public function view_bank_deposit($id)
    {
        $custom_payment = CustomPayment::find($id);
        return view('pages.customs-payments.view',compact('custom_payment'));
    }

    public function store(Request $request)
    {
        if ($request->attachment_deposit_slip) {
            $file = $request->attachment_deposit_slip;
            $filename = time().'_'.$file->getClientOriginalName();

            $location = public_path('documents/payment-deposit-slip');

            $file->move($location,$filename);
        }

        if ($request->type != 'bank_deposit') {
            $payment = CustomPayment::create($request->all());
        }
        else {
            
                foreach ($request->payment_cheques as $key => $payment_cheque) {
                    $exist = CustomPayment::with('cheques')->where([
                        'bank_id' => $request->bank_id,
                        'deposit_slip_number' => $request->deposit_slip_number,
                        'status' => $request->status
                        ])
                        ->whereHas('cheques',function($q) use ($payment_cheque) {
                            $q->where('cheque_number',$payment_cheque['cheque_number']);
                        })
                        ->first();
                   
                    if ($exist) {
                        return back()->with('error','Duplicate entry!');
                    }
                        $request['amount'] = $payment_cheque['amount'];
                        $payment = CustomPayment::create($request->all());
                        $cheque = new PaymentCheque();
                        $cheque->custom_payment_id = $payment->id;
                        $cheque->cheque_number = $payment_cheque['cheque_number'];
                        if (isset($payment_cheque['ibft'])) {
                            $cheque->ibft = $payment_cheque['ibft'];
                        }
                        $cheque->amount = $payment_cheque['amount'];
                        $cheque->clearing_date = $payment_cheque['clearing_date'];
                        $cheque->remarks = $payment_cheque['remarks'];
                        $cheque->save();
                }
            
            
        }
        
        if ($request->attachment_deposit_slip) {
            $payment->update([
                'attachment_deposit_slip' => $filename
            ]);
        }

        if ($request->save_and_new == 'yes') {
            return back()->withInput();
        }
        else {
            return back()->with('success','Saved Successfully!');
        }

    }

    public function update(Request $request,$id)
    {
        if ($request->attachment_deposit_slip) {
            $file = $request->attachment_deposit_slip;
            $filename = time().'_'.$file->getClientOriginalName();

            $location = public_path('documents/payment-deposit-slip');

            $file->move($location,$filename);
        }

        $payment = CustomPayment::find($id);
        $payment->update($request->all());
        
        if ($request->attachment_deposit_slip) {
            $payment->update([
                'attachment_deposit_slip' => $filename
            ]);
        }

        // if ($request->payment_cheques) {
            // foreach ($request->payment_cheques as $key => $payment_cheque) {
                // $cheque = new PaymentCheque();
                // $cheque->custom_payment_id = $payment->id;
                // $cheque->cheque_number = $payment_cheque['cheque_number'];
                // $cheque->amount = $payment_cheque['amount'];
                // $cheque->clearing_date = $payment_cheque['clearing_date'];
                // $cheque->remarks = $payment_cheque['remarks'];
                // $cheque->save();
            // }
        // }

        return back();
    }

    public function UpdateCheque(Request $request,$id)
    {
        try {
            $cheque = PaymentCheque::find($id);
            $cheque->amount = $request->amount;
            $cheque->cheque_number = $request->cheque_number;
            $cheque->clearing_date = $request->clearing_date;
            $cheque->remarks = $request->remarks;
            $cheque->update();
            
            return response()->json(['success' => 'Cheque Updated!']);
        } catch (\Throwable $th) {
            return response()->json(['error' => 'Unable to update!'],404);
        }
    }

    public function bulk_status(Request $request)
    {
        foreach ($request->payment_ids as $key => $payment_id) {
            $payment = CustomPayment::find($payment_id);
            $payment->status = $request->bulk_status;
            $payment->update();
        }

        return back()->with('success','Status Updated!');
    }

    public function destroy($id)
    {
        $payment = CustomPayment::find($id);
        $payment->delete();
        return back();
    }

    public function destroy_cheque($id)
    {
        $cheque = PaymentCheque::find($id);
        $cheque->delete();
        return back();
    }

    public function verify($id)
    {
        $payment = CustomPayment::find($id);
        $payment->update([
            'status' => 'Verified'
        ]);
        return back();
    }

    public function cancel($id)
    {
        $payment = CustomPayment::find($id);
        $payment->update([
            'status' => 'Cancel'
        ]);
        return back();
    }
}