@section('title', 'Lista de Clientes')

<x-app-layout>
    <div>
        <x-flowbite.card title="Clientes Cadastrados">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($clients->isEmpty())
                <p class="text-gray-600">Nenhum cliente cadastrado ainda.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-md">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left">Nome</th>
                                <th class="px-4 py-2 text-left">CPF</th>
                                <th class="px-4 py-2 text-left">Telefone</th>
                                <th class="px-4 py-2 text-left">E-mail</th>
                                <th class="px-4 py-2 text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="px-4 py-2">{{ $client->name }}</td>
                                    <td class="px-4 py-2">{{ $client->cpf }}</td>
                                    <td class="px-4 py-2">{{ $client->phone }}</td>
                                    <td class="px-4 py-2">{{ $client->email }}</td>
                                    <td class="px-4 py-2 text-right">
                                        <a href="{{ route('clients.edit', $client) }}"
                                            class="text-blue-600 hover:underline mr-2">Editar</a>
                                        <form action="{{ route('clients.destroy', $client) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline"
                                                onclick="return confirm('Tem certeza que deseja excluir este cliente?')">Excluir</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <div class="mt-6 text-right">
                <a href="{{ route('clients.create') }}">
                    <x-primary-button>+ Novo Cliente</x-primary-button>
                </a>
            </div>
        </x-flowbite.card>
    </div>
</x-app-layout>
