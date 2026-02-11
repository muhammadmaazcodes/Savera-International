<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $notes = Note::all();
        return view('pages.notes.index',compact('notes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.notes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $note = new Note();
        $note->title = $request->title;
        $note->description = $request->description;
        $note->save();
        return redirect()->route('notes.index');
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
        $note = Note::find($id);
        return view('pages.notes.edit',compact('note'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $note = Note::find($id);
        $note->title = $request->title;
        $note->description = $request->description;
        $note->update();
        return redirect()->route('notes.index');
    }

    public function status_update(Request $request,$id)
    {
        $active = Note::where('status',1)->update(['status' => 0]);
        $note = Note::find($id);
        $note->status = $request->status;
       
        if($request->status == 0){
            $note->status = 1;  
        }
        elseif($request->status == 1) {
            $note->status = 0;
        }
        $note->update();
        return response()->json($note->status);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
