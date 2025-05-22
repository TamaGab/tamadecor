<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::paginate(10);
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
        $validated = $request ->validate(
            [
                'name' =>['required', 'string', 'max:255'],
                'cpf' =>['nullable', 'string', 'max:11', 'unique:clients'],
                'rg' => ['nullable', 'string', 'max:20'],
                'phone' => ['nullable','string','max:20'],
                'email' => ['nullable', 'email', 'max:255'],
                'notes' => ['nullable', 'string'],
            ]
            );
        
        Client::create($validated);

        return redirect()->route('clients.index')->with('success', 'Cliente criado com sucesso!');
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
        $validated = $request ->validate(
            [
                'name' =>['required', 'string', 'max:255'],
                'cpf' =>['nullable', 'string', 'max:11', 'unique:clients'],
                'rg' => ['nullable', 'string', 'max:20'],
                'phone' => ['nullable','string','max:20'],
                'email' => ['nullable', 'email', 'max:255'],
                'notes' => ['nullable', 'string'],
            ]
            );
        
        $client->update($validated);
            
        return redirect()->route('clients.index')->with('success', 'Cliente atualizado com sucesso!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Cliente deletado com sucesso!');
    }
}
