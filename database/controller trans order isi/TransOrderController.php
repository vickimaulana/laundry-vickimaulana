<?php

namespace App\Http\Controllers;

use App\Models\Customers;
use App\Models\TransLaundryPickup;
use App\Models\TransOrderDetails;
use App\Models\TransOrders;
use App\Models\TypeOfServices;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use RealRashid\SweetAlert\Facades\Alert;

class TransOrderController extends Controller
{
    public function index()
    {
        $title = "Transaction Order";
        $orders = TransOrders::orderBy('id', 'desc')->get();
        confirmDelete('title', 'text');
        return view('order.index', compact('title', 'orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $today = Carbon::now()->format('dmY');
        $countDay = TransOrders::whereDate('created_at', now())->count() + 1;
        $runningNumber = str_pad($countDay, 3, '0', STR_PAD_LEFT);
        $code = 'TR-' . $today . '-' . $runningNumber;
        $title = "Transaction Order";
        $customers = Customers::orderBy('id', 'desc')->get();
        $services = TypeOfServices::orderBy('id', 'desc')->get();
        $orders = TransOrders::with(['customer', 'details.service'])->orderBy('id', 'desc')->get();
        return view('order.create', compact('title', 'code', 'customers', 'services', 'orders'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $dataValidated = $request->validate([
        //     'id_customer' => 'required|numeric|exists:customers,id',
        //     'order_code' => 'required|string|unique:trans_orders,order_code',
        //     'order_end_date' => 'required|date',
        //     'order_note' => 'nullable|string',
        //     'order_pay' => 'nullable|numeric',
        //     'order_change' => 'nullable|numeric',
        //     'total' => 'required|numeric'
        // ]);

        // $order = TransOrders::create($dataValidated);
        // $id_order = $order->id;
        // foreach ($request->id_service as $key => $idService) {
        //     $dataValidated2 = $request->validate([
        //         'id_service' => 'required|numeric|exists:services,id',
        //         '' => 'nullable|numeric',
        //         'total' => 'required|numeric'
        //     ]);
        // }

        if (empty($request->total)) {
            Alert::error('Oops...', 'Please Add Service Packet');
            return back();
        }

        $order = TransOrders::create([
            'id_customer' => $request->id_customer,
            'order_code' => $request->order_code,
            'order_date' => Carbon::now(),
            'order_end_date' => Carbon::now()->addDays(2),
            'order_note' => $request->order_note,
            'total' => $request->total
        ]);

        $id_order = $order->id;
        foreach ($request->id_service as $index => $idService) {
            try {
                $request->notes[$index];
                TransOrderDetails::create([
                    'id_order' => $id_order,
                    'id_service' => $idService,
                    'qty' => $request->qty[$index]*1000,
                    'subtotal' => $request->subtotal[$index],
                    'notes' => $request->notes[$index]
                ]);
            } catch (\Throwable $th) {
                TransOrderDetails::create([
                    'id_order' => $id_order,
                    'id_service' => $idService,
                    'qty' => $request->qty[$index]*1000,
                    'subtotal' => $request->subtotal[$index],

                ]);
            }
        }

        Alert::success('Excellent', 'Add order data successfully');
        return redirect()->route('order.index')->with('success', 'Add order data successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $title = "Transaction Order";
        $order = TransOrders::with(['customer', 'details.service'])->findOrFail($id);
        // dd($order->details);
        return view('order.show', compact('title', 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $title = "Transaction Order";
        $order = TransOrders::findOrFail($id);
        return view('order.edit', compact('title', 'order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $dataValidated = $request->validate([
            'order_pay' => 'required|numeric',
            'order_change' => 'required|numeric'
        ]);

        $order = Transorders::findOrFail($id);
        $order->update($dataValidated);
        $order->order_status = 1;
        $order->save();

        // $order = Transorders::findOrFail($id);
        TransLaundryPickup::create([
            'id_order' => $order->id,
            'id_customer' => $order->customer->id,
            'pickup_date' => date('Y-m-d H:i:s')
        ]);
        Alert::success('Excellent', 'Update data order successfully');
        return redirect()->route('order.index')->with('success', 'Update data order successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $order = TransOrders::findOrFail($id);
        $order->delete();
        toast('Delete data order successfully', 'success');
        return redirect()->route('order.index')->with('success', 'Delete data order successfully');
    }

    public function printStruk(string $id)
    {
        $details = TransOrders::with(['customer', 'details.service'])->where('id', $id)->first();
        // debuging
        // return $details;
        // dd($details);
        return view('order.print', compact('details'));
    }
}
