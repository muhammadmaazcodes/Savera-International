<?php

namespace App\Http\Controllers;

use App\Models\Port;
use Illuminate\Http\Request;

class PortController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
         $this->middleware('permission:port-list|port-create|port-edit|port-delete', ['only' => ['index','store']]);
         $this->middleware('permission:port-create', ['only' => ['create','store']]);
         $this->middleware('permission:port-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:port-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $ports = Port::orderBy('created_at','ASC')->get();
        return view('pages.ports.index',compact('ports'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.ports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255'
        ]);
        
        Port::create($request->all());
        return redirect('ports')->with('status', 'Port Added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Port $port)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Port $port)
    {
        return view('pages.ports.edit', compact('port'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Port $port)
    {
        $validated = $request->validate([
            'name' => 'required|max:255'
        ]);
        $port->name = $request->name;
        $port->load_port = $request->load_port ?? 0;
        $port->discharge_port = $request->discharge_port ?? 0;
        $port->update();
        return redirect('ports')->with('status', 'Port Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $port = Port::find($id);
        $port->delete();
        return back();
    }
}
