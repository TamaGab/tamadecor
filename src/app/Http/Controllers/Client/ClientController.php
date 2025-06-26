<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Client::query();

        if ($request->filled('search')) {
            $search = $request->search;

            $query->where(function ($q) use ($search) {
                $q->whereRaw("name LIKE ? COLLATE utf8mb4_unicode_ci", ["%{$search}%"])
                    ->orWhereRaw("cpf LIKE ? COLLATE utf8mb4_unicode_ci", ["%{$search}%"])
                    ->orWhereRaw("phone LIKE ? COLLATE utf8mb4_unicode_ci", ["%{$search}%"]);
            });
        } else {
            $query->orderBy('id', 'asc');
        }

        $clients = $query->paginate(10);
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'cpf' => $request->filled('cpf') ? preg_replace('/\D/', '', $request->cpf) : null,
            'rg' => $request->filled('rg') ? preg_replace('/\D/', '', $request->rg) : null,
            'phone' => $request->filled('phone') ? preg_replace('/\D/', '', $request->phone) : null,
        ]);


        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['nullable', 'string', 'max:14'],
            'rg' => ['nullable', 'string', 'max:20'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'notes' => ['nullable', 'string'],
            'address' => ['nullable', 'string', 'max:255']
        ];

        if ($request->filled('cpf')) {
            $rules['cpf'][] = Rule::unique('clients');
        }


        $validated = $request->validate($rules, [
            'name.required' => 'O nome do cliente é obrigatório!',
            'cpf.unique' => 'Já existe um cliente com esse CPF.',
        ]);


        $client = Client::create($validated);

        if ($request->input('source') === 'orders') {
            return redirect()
                ->route('orders.create')
                ->with('success', 'Cliente criado e pronto para o pedido!')
                ->with('new_client_id', $client->id);
        }

        return redirect()
            ->route('clients.index')
            ->with('success', 'Cliente criado com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        return view('clients.show', compact('client'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, Client $client)
    {

        $request->merge([
            'cpf' => $request->filled('cpf') ? preg_replace('/\D/', '', $request->cpf) : null,
            'rg' => $request->filled('rg') ? preg_replace('/\D/', '', $request->rg) : null,
            'phone' => $request->filled('phone') ? preg_replace('/\D/', '', $request->phone) : null,
        ]);

        $rules = [
            'name' => ['required', 'string', 'max:255'],
            'cpf' => ['nullable', 'string', 'max:14'],
            'rg' => ['nullable', 'string', 'max:20'],
            'phone' => ['nullable', 'string', 'max:20'],
            'email' => ['nullable', 'email', 'max:255'],
            'notes' => ['nullable', 'string'],
            'address' => ['nullable', 'string', 'max:255']
        ];

        if ($request->filled('cpf')) {
            $rules['cpf'][] = Rule::unique('clients')->ignore($client->id);
        }

        $validated = $request->validate($rules, [
            'name.required' => 'O nome do cliente é obrigatório!',
            'cpf.unique' => 'Já existe um cliente com esse CPF.',
        ]);

        $client->update($validated);

        return redirect()->route('clients.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    public function destroy(int $clientID)
    {
        $client = Client::find($clientID);
        // dd($clientID);
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Cliente excluido com sucesso!');
    }
}
