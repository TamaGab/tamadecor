@section('title', 'Lista de Vendas')

<x-app-layout>
    <div>
        <x-card title="Vendas Registradas" backUrl="dashboard">
            <x-searchbox />

            {{-- @if (session('success'))
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

                                                <div x-data="{ showDeleteModal: false }"
                                                    @close-modal.window="showDeleteModal = false">

                                                    <button @click.prevent="showDeleteModal = true"
                                                        class="text-red-600 hover:text-red-800" title="Excluir cliente">
                                                        <i class="fa-solid fa-circle-xmark text-xl"></i>
                                                    </button>

                                                    <x-modal x-show="showDeleteModal"
                                                        x-on:close-modal.window="showDeleteModal = false"
                                                        x-on:confirm-action.window="showDeleteModal = false; $el.closest('form').submit();"
                                                        title="Confirmação de exclusão" confirmText="Excluir"
                                                        cancelText="Cancelar">
                                                        <p class="text-left">
                                                            Tem certeza que deseja excluir este cliente? Essa ação não
                                                            pode ser desfeita.
                                                        </p>
                                                    </x-modal>

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
            </div> --}}
        </x-card>
    </div>
</x-app-layout>
