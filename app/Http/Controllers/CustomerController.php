<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    public function index()
    {
        $title = "customer";
        $customers = Customers::orderBy('id', 'desc')->get();
        confirmDelete('title', 'text');
        return view('customer.index', compact('title', 'customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = "Customer";
        return view('customer.create', compact('title'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $dataValidated = $request->validate([
            'customer_name' => 'required|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string'
        ]);

        Customers::create($dataValidated);
        Alert::success('Excellent', 'Add customer data successfully');
        return redirect()->route('customer.index')->with('success', 'Add customer data successfully');
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
        $title = "Customer";
        $customer = Customers::findOrFail($id);
        return view('customer.edit', compact('title', 'customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataValidated = $request->validate([
            'customer_name' => 'required|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string'
        ]);

        $customer = Customers::findOrFail($id);
        $customer->update($dataValidated);
        Alert::success('Excellent', 'Update data customer successfully');
        return redirect()->route('customer.index')->with('success', 'Update data customer successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customers::findOrFail($id);
        $customer->delete();
        toast('Delete data customer successfully', 'success');
        return redirect()->route('customer.index')->with('success', 'Delete data customer successfully');
    }
}
