<x-app-layout>
    <div class="max-w-4xl mx-auto p-6 bg-white rounded shadow">

        <h1 class="text-2xl font-semibold mb-6">Lista de Clientes</h1>

        @if($clients->count())
            <table class="w-full border-collapse border border-gray-200">
                <thead>
                    <tr>
                        <th class="border border-gray-300 px-4 py-2 text-left">Nome</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">CPF</th>
                        <th class="border border-gray-300 px-4 py-2 text-left">Email</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($clients as $client)
                        <tr>
                            <td class="border border-gray-300 px-4 py-2">{{ $client->name }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $client->cpf ?? '-' }}</td>
                            <td class="border border-gray-300 px-4 py-2">{{ $client->email ?? '-' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="mt-4">
                {{ $clients->links() }}  {{-- Paginação automática --}}
            </div>
        @else
            <p>Nenhum cliente cadastrado ainda.</p>
        @endif

    </div>
</x-app-layout>
