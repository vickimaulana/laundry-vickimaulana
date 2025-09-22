<?php

namespace App\Http\Controllers;

use App\Models\Levels;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "Level";
        $levels = Levels::orderBy('id', 'desc')->get();
        confirmDelete('title', 'text');
        return view('level.index', compact('title', 'levels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Level";
        return view('level.create', compact('title'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataValidated = $request->validate([
            'level_name' => 'required|string'
        ]);

        Levels::create($dataValidated);
        Alert::success('Excellent', 'Add level data successfully');
        return redirect()->route('level.index')->with('success', 'Add level data successfully');
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
        $title = "Level";
        $level = Levels::findOrFail($id);
        return view('level.edit', compact('title', 'level'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataValidated = $request->validate([
            'level_name' => 'required|string'
        ]);

        $level = Levels::findOrFail($id);
        $level->update($dataValidated);
        Alert::success('Excellent', 'Update data level successfully');
        return redirect()->route('level.index')->with('success', 'Update data level successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $level = Levels::findOrFail($id);
        $level->delete();
        toast('Delete data level successfully', 'success');
        return redirect()->route('level.index')->with('success', 'Delete data level successfully');
    }
}
