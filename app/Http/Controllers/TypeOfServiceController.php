<?php

namespace App\Http\Controllers;

use App\Models\TypeOfServices;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TypeOfServiceController extends Controller
{
    public function index()
    {
        $title = "Service";
        $services = TypeOfServices::orderBy('id', 'desc')->get();
        confirmDelete('title', 'text');
        return view('service.index', compact('title', 'services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Service";
        return view('service.create', compact('title'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataValidated = $request->validate([
            'service_name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string'
        ]);

        TypeOfServices::create($dataValidated);
        Alert::success('Excellent', 'Add service data successfully');
        return redirect()->route('service.index')->with('success', 'Add service data successfully');
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
        $title = "Service";
        $service = TypeOfServices::findOrFail($id);
        return view('service.edit', compact('title', 'service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataValidated = $request->validate([
            'service_name' => 'required|string',
            'price' => 'required|numeric',
            'description' => 'nullable|string'
        ]);

        $service = TypeOfServices::findOrFail($id);
        $service->update($dataValidated);
        Alert::success('Excellent', 'Update data service successfully');
        return redirect()->route('service.index')->with('success', 'Update data service successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $service = TypeOfServices::findOrFail($id);
        $service->delete();
        toast('Delete data service successfully', 'success');
        return redirect()->route('service.index')->with('success', 'Delete data service successfully');
    }
}
