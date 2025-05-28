<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Order;
use App\Models\Product;
use Carbon\Carbon;
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

            // Tenta converter para data no formato esperado
            $formattedDate = null;
            try {
                $formattedDate = Carbon::createFromFormat('d/m/Y', $search)->format('Y-m-d');
            } catch (\Exception $e) {
                // ignora se não for uma data válida
            }

            $query->where(function ($q) use ($search, $formattedDate) {
                // Busca por nome do cliente
                $q->whereHas('client', function ($q) use ($search) {
                    $q->whereRaw("name LIKE ? COLLATE utf8mb4_unicode_ci", ["%{$search}%"]);
                });

                // Busca por ID do pedido
                $q->orWhere('id', $search);

                // Busca por data formatada (se válida)
                if ($formattedDate) {
                    $q->orWhereDate('order_date', $formattedDate);
                }
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
        $clients = Client::paginate(10);
        $products = Product::paginate(10);
        return view('orders.create', compact('clients', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Filtra e formata os itens
        $orderItems = collect($request->order_items)->filter(function ($item) {
            return !empty($item['product_id']);
        })->map(function ($item) {
            $price = str_replace(['R$', '.', ' '], '', $item['price']);
            $price = str_replace(',', '.', $price);
            return [
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => (float) $price,
            ];
        })->values()->all();

        $request->merge(['order_items' => $orderItems]);

        // Validação
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'order_items' => 'required|array|min:1',
            'order_items.*.product_id' => 'required|exists:products,id',
            'order_items.*.quantity' => 'required|integer|min:1',
            'order_items.*.price' => 'required|numeric|min:0',
        ]);

        $total = collect($orderItems)->reduce(function ($carry, $item) {
            return $carry + ($item['quantity'] * $item['price']);
        }, 0);

        $order = Order::create([
            'client_id' => $request->client_id,
            'total_price' => $total,
        ]);

        // Cria os itens
        foreach ($orderItems as $item) {
            $order->orderItems()->create($item);
        }

        return redirect()->route('orders.index')->with('success', 'Pedido criado com sucesso!');
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
    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('orders.index')->with('success', 'Pedido excluido com sucesso!');
    }
}
