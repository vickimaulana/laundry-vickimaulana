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
        $code = 'TRLV-' . $today . '-' . $runningNumber;
        $title = "Transaction Order";
        $customers = Customers::orderBy('id', 'desc')->get();
        $services = TypeOfServices::orderBy('id', 'desc')->get();
        $orders = TransOrders::with(['customer', 'details.service'])->orderBy('id', 'desc')->get();
        return view('order.transaction', compact('title', 'code', 'customers', 'services', 'orders'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $order = TransOrders::create([
            'id_customer' => $request->customer['id'],
            'order_code' => $request->id,
            'order_date' => Carbon::now(),
            'order_end_date' => Carbon::now()->addDays(2),
            'order_note' => $request->order_note ?? null,
            'total' => $request->total,
            'order_status' => $request->status
        ]);

        foreach ($request->items as $item) {
            TransOrderDetails::create([
                'id_order' => $order->id,
                'id_service' => $item['id_service'],
                'qty' => $item['weight'],
                'price' => $item['price'],
                'subtotal' => $item['subtotal'],
                'notes' => $item['notes'] ?? null
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Data Transaksi berhasil ditambahkan!!'
        ]);
    }
    //  if (empty($request->total)) {
    //         Alert::error('Oops...', 'Please Add Service Packet');
    //         return back();
    //     }

    //     $order = TransOrders::create([
    //         'id_customer' => $request->id_customer,
    //         'order_code' => $request->order_code,
    //         'order_date' => Carbon::now(),
    //         'order_end_date' => Carbon::now()->addDays(2),
    //         'order_note' => $request->order_note,
    //         'total' => $request->total
    //     ]);

    //     $id_order = $order->id;
    //     foreach ($request->id_service as $index => $idService) {
    //         try {
    //             $request->notes[$index];
    //             TransOrderDetails::create([
    //                 'id_order' => $id_order,
    //                 'id_service' => $idService,
    //                 'qty' => $request->qty[$index] * 1000,
    //                 'subtotal' => $request->subtotal[$index],
    //                 'notes' => $request->notes[$index]
    //             ]);
    //         } catch (\Throwable $th) {
    //             TransOrderDetails::create([
    //                 'id_order' => $id_order,
    //                 'id_service' => $idService,
    //                 'qty' => $request->qty[$index] * 1000,
    //                 'subtotal' => $request->subtotal[$index],

    //             ]);
    //         }
    //     }

    //     Alert::success('Excellent', 'Add order data successfully');
    //     return redirect()->route('order.index')->with('success', 'Add order data successfully');
    // }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $order = TransOrders::with([
                'customer' => fn($q) => $q->withTrashed(),
                'transOrderDetails.typeOfService',
                'transLaundryPickups'
            ])->findOrFail($id);

            return view('order.show', compact('order'));
        } catch (\Throwable $e) {
            return redirect()
                ->route('order.index')
                ->with('error_message', 'Gagal memuat detail order: ' . $e->getMessage());
        }
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

    // public function getLayanan()
    // {
    //     $layanan = TypeOfServiceController::all();
    //     $prices = $layanan->pluck('price', 'service_name');
    //     return response()->json($prices);
    // }

    public function getOrders()
{
    $orders = TransOrders::with(['customer', 'details.service'])
        ->orderBy('id', 'desc')
        ->get();

    return response()->json($orders);
}

 public function getSingleOrder($id)
{
    $order = TransOrders::with(['customer', 'details.service'])->where('id', $id)->first();

    return response()->json($order);
}
public function updateOrderStatus(Request $request, $id)
    {
        $order = TransOrders::findOrFail($id);
        $order->order_status = $request->order_status;
        $order->save();

        return response()->json([
            'status' => true,
            'message' => 'Order status updated successfully!'
        ]);
    }

public function reportsJson()
{
    $orders = TransOrders::with(['details.service'])->get();

    $today = now();
    $thisMonth = $today->month;
    $thisYear = $today->year;

    $monthlyTransactions = $orders->filter(function ($order) use ($thisMonth, $thisYear) {
        $date = \Carbon\Carbon::parse($order->order_date);
        return $date->month == $thisMonth && $date->year == $thisYear;
    });

    $monthlyRevenue = $monthlyTransactions->sum('total');

    $serviceStats = [];
    foreach ($orders as $order) {
        foreach ($order->details as $detail) {
            $serviceName = $detail->service->service_name ?? '-';
            if (!isset($serviceStats[$serviceName])) {
                $serviceStats[$serviceName] = [
                    'count' => 0,
                    'revenue' => 0
                ];
            }
            $serviceStats[$serviceName]['count']++;
            $serviceStats[$serviceName]['revenue'] += $detail->subtotal;
        }
    }

    return response()->json([
        'totalTransactions' => $orders->count(),
        'monthlyTransactions' => $monthlyTransactions->count(),
        'monthlyRevenue' => $monthlyRevenue,
        'serviceStats' => $serviceStats
    ]);
}

}
