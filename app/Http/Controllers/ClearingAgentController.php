<?php

namespace App\Http\Controllers;

use App\Models\ClearingAgent;
use Illuminate\Http\Request;

class ClearingAgentController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    function __construct()
    {
        $this->middleware('permission:clearing-agent-list|clearing-agent-create|clearing-agent-edit|clearing-agent-delete', ['only' => ['index','store']]);
        $this->middleware('permission:clearing-agent-create', ['only' => ['create','store']]);
        $this->middleware('permission:clearing-agent-edit', ['only' => ['edit','update']]);
        $this->middleware('permission:clearing-agent-delete', ['only' => ['destroy']]);
    }
 
    public function index()
    {
        $clearing_agents = ClearingAgent::orderBy('created_at','ASC')->get();
        return view('pages.clearing-agents.index',compact('clearing_agents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.clearing-agents.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request->get('business_addresses');
        $validated = $request->validate([
            'name' => 'required|max:255',
            'title' => 'required|max:255',
        ]);
        
        $clearing_agent = ClearingAgent::create($request->all());
        return redirect('clearing-agents')->with('status', 'Clearing Agent Added.');;
    }

    /**
     * Display the specified resource.
     */
    public function show(ClearingAgent $business)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ClearingAgent $clearing_agent)
    {
        return view('pages.clearing-agents.edit', compact('clearing_agent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ClearingAgent $clearing_agent)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'title' => 'required|max:255',
        ]);

        $clearing_agent->update($request->all());

        return redirect('clearing-agents')->with('status', 'Agent Details Updated.');;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $clearing_agent = ClearingAgent::find($id);
        $clearing_agent->delete();
        return back();
    }
}
