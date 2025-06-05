<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $date = $request->query('date');
        // dd($date);
        $orders = collect();
        $totalValue = 0;

        $orders = collect();

        if ($date) {
            try {
                $orders = Order::whereDate('order_date', $date)->get();
                $totalValue = $orders->sum('total_price');
            } catch (\Exception $e) {
                report($e);
            }
        }

        return view('dashboard', compact('orders', 'date', 'totalValue'));
    }
}
