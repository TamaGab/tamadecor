<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Order::with(['client', 'orderItems.product']);

        if ($request->filled('search')) {
            $search = $request->search;

            $query->whereHas('client', function ($q) use ($search) {
                $q->whereRaw("name LIKE ? COLLATE utf8mb4_unicode_ci", ["%{$search}%"]);
            });
        } else {
            $query->orderBy('id', 'asc');
        }

        $orders = $query->paginate(10);
        return view('orders.index', compact('orders'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('orders.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
