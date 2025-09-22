<?php

namespace App\Http\Controllers;

use App\Models\Levels;
use App\Models\User;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = "User";
        $users = User::orderBy('id', 'desc')->get();
        confirmDelete('title', 'text');
        return view('user.index', compact('title', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "User";
        $levels = Levels::orderBy('id', 'desc')->get();
        return view('user.create', compact('title', 'levels'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataValidated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|min:8',
            'id_level' => 'required|numeric|exists:levels,id'
        ]);

        User::create($dataValidated);
        Alert::success('Excellent', 'Add data user successfully');
        return redirect()->route('user.index')->with('success', 'Add data user successfully');
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
        $title = "User";
        $user = User::findOrFail($id);
        $levels = Levels::orderBy('id', 'desc')->get();
        return view('user.edit', compact('title', 'user', 'levels'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataValidated = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email',
            'password' => 'nullable|string|min:8',
            'id_level' => 'required|numeric|exists:levels,id'
        ]);

        if (!$request->password) {
            unset($dataValidated['password']);
        }

        $user = User::findOrFail($id);
        $user->update($dataValidated);
        Alert::success('Excellent', 'Update data user successfully');
        return redirect()->route('user.index')->with('success', 'Update data user successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        toast('Delete data user successfully', 'success');
        return redirect()->route('user.index')->with('success', 'Delete data user successfully');
    }
}
