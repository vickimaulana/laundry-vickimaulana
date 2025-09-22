<?php

namespace App\Http\Controllers;

use App\Models\TransOrders;
use Illuminate\Http\Request;

class ReportController extends Controller
{

    public function report($date_start = null, $date_end = null){
        $title = 'Report';
        $orders = TransOrders::withTrashed()->with(['customer', 'details'])->get();
        return view('report.index', compact('orders', 'title'));
    }

    public function reportFilter(Request $request)
    {
        $title = 'Report';

        if ($request->date_start && $request->date_end) {
            $startDate = $request->date_start;
            $endDate = $request->date_end;

            $orders = TransOrders::withTrashed()->with(['customer', 'details'])
                ->whereDate('order_date', '>=', $startDate)
                ->whereDate('order_date', '<=', $endDate)
                ->get();

            return view('report.index', compact('title', 'orders'));
        }

        $orders = TransOrders::withTrashed()->with(['order.customer', 'service'])->get();
        return view('report.index', compact('orders', 'title'));
    }

    public function printLaporan(){
        $orders = TransOrders::withTrashed()->with(['customer', 'details'])->get();
        return view('report.print', compact('orders'));
    }
}