<?php

namespace App\Http\Controllers;

use App\Models\Surveyor;
use Illuminate\Http\Request;

class SurveyorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    function __construct()
    {
         $this->middleware('permission:surveyor-list|surveyor-create|surveyor-edit|surveyor-delete', ['only' => ['index','store']]);
         $this->middleware('permission:surveyor-create', ['only' => ['create','store']]);
         $this->middleware('permission:surveyor-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:surveyor-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $surveyors = Surveyor::orderBy('created_at','ASC')->get();
        return view('pages.surveyor.index',compact('surveyors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.surveyor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $surveyor = Surveyor::create($request->all());
        return redirect()->route('surveyor.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $surveyor = Surveyor::find($id);
        return view('pages.surveyor.edit',compact('surveyor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $surveyor = Surveyor::find($id)->update($request->all());
        return redirect()->route('surveyor.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $surveyor = Surveyor::find($id);
        $surveyor->delete();
        return back();
    }
}
