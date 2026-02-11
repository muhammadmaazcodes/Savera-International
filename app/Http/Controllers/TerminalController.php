<?php

namespace App\Http\Controllers;

use App\Models\Terminal;
use Illuminate\Http\Request;

class TerminalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
         $this->middleware('permission:terminal-list|terminal-create|terminal-edit|terminal-delete', ['only' => ['index','store']]);
         $this->middleware('permission:terminal-create', ['only' => ['create','store']]);
         $this->middleware('permission:terminal-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:terminal-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $terminals = Terminal::orderBy('created_at','ASC')->get();
        return view('pages.terminals.index',compact('terminals'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.terminals.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|unique:terminals',
        ]);
        
        Terminal::create($request->all());
        return redirect('terminals')->with('status', 'Terminal Added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Terminal $terminal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Terminal $terminal)
    {
        return view('pages.terminals.edit', compact('terminal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Terminal $terminal)
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'code' => 'required|unique:terminals,code,'.$terminal->id
        ]);
        $terminal->name = $request->name;
        $terminal->code = $request->code;
        $terminal->incharge = $request->incharge;
        $terminal->contact_number = $request->contact_number;
        $terminal->local = $request->local ?? 0;
        $terminal->international = $request->international ?? 0;
        $terminal->update();
        return redirect('terminals')->with('status', 'Terminal Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $terminal = Terminal::find($id);
        $terminal->delete();
        return back();
    }
}
