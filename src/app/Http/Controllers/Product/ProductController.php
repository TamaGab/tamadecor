<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->whereRaw("name LIKE ? COLLATE utf8mb4_unicode_ci", ["%{$search}%"]);
            });
        } else {
            $query->orderBy('id', 'asc');
        }

        $products = $query->paginate(10);
        return view('products.index', compact('products'));
    }


    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'description' => ['nullable', 'string'],
            ],
            ['name.required' => 'O nome do produto é obrigatório!']
        );

        Product::create($validated);
        return redirect()->route('products.index')->with('success', 'Produto criado com sucesso!');
    }


    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }


    public function update(Request $request, Product $product)
    {
        $validated = $request->validate(
            [
                'name' => ['required', 'string', 'max:255'],
                'description' => ['nullable', 'string'],
            ],
            [
                'name.required' => 'O nome do produto é obrigatório!'
            ]
        );

        $product->update($validated);
        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso!');
    }


    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Produto removido com sucesso!');
    }
}
