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

            $query->where(function ($q) use ($search) {

                $q->whereHas('client', function ($q) use ($search) {
                    $q->whereRaw("name LIKE ? COLLATE utf8mb4_unicode_ci", ["%{$search}%"]);
                });

                $q->orWhere('id', $search);

                if (is_numeric($search)) {
                    $q->orWhere('total_price', $search);
                }
            });
        } else {
            $query->orderBy('id', 'asc');
        }

        $orders = $query->paginate(10);
        return view('orders.index', compact('orders'));
    }

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
        $request->validate(
            [
                'client_id' => 'required|exists:clients,id',
                'order_items' => 'required|array|min:1',
                'order_items.*.product_id' => 'required|exists:products,id',
                'order_items.*.quantity' => 'required|integer|min:1',
                'order_items.*.price' => 'required|numeric|min:0',
            ],
            [
                'client_id.required' => 'O cliente é obrigatório.',
                'order_items.required' => 'Pelo menos um item é obrigatório.',
                'order_items.*.product_id.required' => 'O produto é obrigatório.',
                'order_items.*.quantity.required' => 'A quantidade é obrigatória.',
                'order_items.*.quantity.integer' => 'A quantidade deve ser um número inteiro.'
            ]
        );

        $total = collect($orderItems)->reduce(function ($carry, $item) {
            return $carry + ($item['quantity'] * $item['price']);
        }, 0);

        $order = Order::create([
            'client_id' => $request->client_id,
            'total_price' => $total,
            'order_date' => now(),
        ]);

        // Cria os itens
        foreach ($orderItems as $item) {
            $order->orderItems()->create($item);
        }

        return redirect()->route('orders.index')->with('success', 'Pedido criado com sucesso!');
    }

    public function create()
    {
        $clients = Client::orderBy('name')->get();
        $products = Product::orderBy('name')->get();

        return view('orders.create', compact('clients', 'products'));
    }
    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        $clients = Client::orderBy('name')->get();
        $products = Product::orderBy('name')->get();

        return view('orders.edit', compact('order', 'clients', 'products'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        // Filtra e formata os itens recebidos no request
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

        // Merge para facilitar a validação
        $request->merge(['order_items' => $orderItems]);

        // Validação
        $request->validate(
            [
                'client_id' => 'required|exists:clients,id',
                'order_items' => 'required|array|min:1',
                'order_items.*.product_id' => 'required|exists:products,id',
                'order_items.*.quantity' => 'required|integer|min:1',
                'order_items.*.price' => 'required|numeric|min:0',
            ],
            [
                'client_id.required' => 'O cliente é obrigatório.',
                'order_items.required' => 'Pelo menos um item é obrigatório.',
                'order_items.*.product_id.required' => 'O produto é obrigatório.',
                'order_items.*.quantity.required' => 'A quantidade é obrigatória.',
                'order_items.*.quantity.integer' => 'A quantidade deve ser um número inteiro.'
            ]
        );

        // Atualiza o total do pedido
        $total = collect($orderItems)->reduce(function ($carry, $item) {
            return $carry + ($item['quantity'] * $item['price']);
        }, 0);

        // Atualiza dados do pedido
        $order->update([
            'client_id' => $request->client_id,
            'total_price' => $total,
        ]);

        // Sincroniza os itens do pedido
        // Vamos deletar os itens antigos e criar os novos, para simplificar
        $order->orderItems()->delete();

        foreach ($orderItems as $item) {
            $order->orderItems()->create($item);
        }

        return redirect()->route('orders.index')->with('success', 'Pedido atualizado com sucesso!');
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
