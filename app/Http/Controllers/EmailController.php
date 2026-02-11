<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webklex\IMAP\Facades\Client;
use App\Models\LocalContract;
use App\Models\Inventory;
use App\Models\MailContract;
use App\Models\MailInventory;

class EmailController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:email-list|email-assign-to|email-show', ['only' => ['receiveEmails','show']]);
         $this->middleware('permission:email-assign-to', ['only' => ['assign_to']]);
         $this->middleware('permission:email-show', ['only' => ['show']]);
    }

    public function receiveEmails()
    {
        $client = Client::account('default');
        $client->connect();

        $inbox = $client->getFolder('INBOX');
        // $messages = $inbox->query()->seen()->get();
        $messages = $inbox->messages()->all()->get();

        foreach ($messages as $message) {
            $subject = $message->getSubject();
            $from = $message->getFrom()[0]->mail;
            $content = $message->getHTMLBody();
        }
        
        $client->disconnect();

        $contracts = LocalContract::get();
        $inventories = Inventory::get();
        return view('pages.emails.index',compact('messages','contracts','inventories'));
    }

    public function show($id)
    {
        $client = Client::account('default');
        $client->connect();

        $inbox = $client->getFolder('INBOX');
        $messages = $inbox->messages()->all()->where('uid',$id)->get();
        $message = $messages->first();
        $client->disconnect();

        return view('pages.emails.show',compact('message'));
    }

    public function assign_to(Request $request)
    {
        if($request->has('inventory_id')){
            $mail_inventory = new MailInventory();
            $mail_inventory->inventory_id = $request->inventory_id;
            $mail_inventory->mail_id = $request->mail_id;
            $mail_inventory->save();
        }
        if ($request->has('contract_id')) {
            $mail_contract = new MailContract();
            $mail_contract->contract_id = $request->contract_id;
            $mail_contract->mail_id = $request->mail_id;
            $mail_contract->save();
        }
        return response()->json(['success'=>'Assigned Mail successfully !']);
    }
}