@section('title', 'Lista de Clientes')

<x-app-layout>
    <div>
        <x-custom-card title="Clientes Cadastrados" backUrl="dashboard">
            <x-searchbox />

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($clients->isEmpty())
                <p class="text-black">Nenhum cliente cadastrado.</p>
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
                                    <td class="px-4 py-2 text-left">{{ $client->name }}</td>
                                    <td class="px-4 py-2 text-left">{{ $client->cpf_formatado }}</td>
                                    <td class="px-4 py-2 text-left">{{ $client->phone_formatado }}</td>
                                    <td class="px-4 py-2 text-left">{{ $client->email }}</td>
                                    <td class="px-4 py-2 text-right">
                                        <div class="flex items-center justify-end gap-3">

                                            <a href="{{ route('clients.show', $client) }}" title="Visualizar"
                                                class="text-emerald-600 hover:text-emerald-900 flex items-center justify-center w-6 h-6">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>

                                            <a href="{{ route('clients.edit', $client) }}" title="Editar"
                                                class="text-blue-600 hover:text-blue-900 flex items-center justify-center w-6 h-6">
                                                <i class="fa-solid fa-user-pen"></i>
                                            </a>

                                            <form method="POST" action="{{ route('clients.destroy', $client->id) }}">
                                                @csrf
                                                @method('DELETE')

                                                <div x-data>
                                                    <x-modal id="modal-delete">
                                                        <x-slot:title>
                                                            <span class="text-xl font-semibold text-black">
                                                                Confirmar exclusão
                                                            </span>
                                                        </x-slot:title>

                                                        <p class="text-black mb-4">
                                                            Tem certeza que deseja excluir este cliente? Essa ação não
                                                            pode ser desfeita.
                                                        </p>

                                                        <div class="flex justify-end gap-2">
                                                            <x-secondary-button x-on:click="$modalClose('modal-delete')"
                                                                type="button">
                                                                Cancelar
                                                            </x-secondary-button>

                                                            <x-primary-button
                                                                x-on:click.prevent="$modalClose('modal-delete'); $el.closest('form').submit();"
                                                                type="button">
                                                                Excluir
                                                            </x-primary-button>
                                                        </div>
                                                    </x-modal>

                                                    <button type="button" x-on:click="$modalOpen('modal-delete')"
                                                        class="text-red-600 hover:text-red-800" title="Excluir cliente">
                                                        <i class="fa-solid fa-circle-xmark text-xl"></i>
                                                    </button>
                                                </div>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <div class="mt-6 text-right">
                <a href="{{ route('clients.create') }}">
                    <x-primary-button>Novo Cliente</x-primary-button>
                </a>
            </div>

            <div class="mt-4">
                {{ $clients->links() }}
            </div>
        </x-custom-card>
    </div>
</x-app-layout>
