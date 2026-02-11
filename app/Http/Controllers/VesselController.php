<?php

namespace App\Http\Controllers;

use App\Models\Vessel;
use Illuminate\Http\Request;

class VesselController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
         $this->middleware('permission:vessel-list|vessel-create|vessel-edit|vessel-delete', ['only' => ['index','store']]);
         $this->middleware('permission:vessel-create', ['only' => ['create','store']]);
         $this->middleware('permission:vessel-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:vessel-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $vessels = Vessel::orderBy('created_at','ASC')->get();
        return view('pages.vessels.index',compact('vessels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.vessels.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|max:255'
        ]);
        
        Vessel::create($request->all());
        return redirect('vessels')->with('status', 'Vessel Added.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Vessel $vessel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vessel $vessel)
    {
        return view('pages.vessels.edit', compact('vessel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vessel $vessel)
    {
        $validated = $request->validate([
            'name' => 'required|max:255'
        ]);
        $vessel->name = $request->name;
        $vessel->local = $request->local ?? 0;
        $vessel->international = $request->international ?? 0;
        $vessel->update();
        return redirect('vessels')->with('status', 'Vessel Updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vessel = Vessel::find($id);
        $vessel->delete();
        return back();
    }
}
