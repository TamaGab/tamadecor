@section('title', 'Lista de Produtos')

<x-app-layout>
    <div>
        <x-card title="Produtos Cadastrados" backUrl="dashboard">
            <form method="GET" action="{{ route('products.index') }}" class="mb-4 w-full max-w-sm">
                <div class="relative">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Buscar produto..."
                        title="Buscar Produto"
                        class="w-full rounded-md border border-gray-300 shadow focus:border-emerald-300 focus:ring focus:ring-emerald-100 focus:ring-opacity-50 text-md placeholder-gray-400 pr-10" />

                    <span class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-gray-400">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </span>

                    @if (request('search'))
                        <a href="{{ route('products.index') }}"
                            class="absolute inset-y-0 right-10 flex items-center text-gray-500 hover:text-red-600"
                            title="Limpar busca">
                            <i class="fa-solid fa-times-circle"></i>
                        </a>
                    @endif
                </div>
            </form>

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                    {{ session('success') }}
                </div>
            @endif

            @if ($products->isEmpty())
                <p class="text-black">Nenhum produto cadastrado.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-md">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left">Nome</th>
                                <th class="px-4 py-2 text-left">Descrição</th>
                                <th class="px-4 py-2 text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="px-4 py-2 text-left">{{ $product->name }}</td>
                                    <td class="px-4 py-2 text-left">{{ $product->description ?? '-' }}</td>
                                    <td class="px-4 py-2 text-right">
                                        <div class="flex items-center justify-end gap-3">

                                            <a href="{{ route('products.show', $product) }}" title="Visualizar"
                                                class="text-emerald-600 hover:text-emerald-900 flex items-center justify-center w-6 h-6">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>

                                            <a href="{{ route('products.edit', $product) }}" title="Editar"
                                                class="text-blue-600 hover:text-blue-900 flex items-center justify-center w-6 h-6">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>

                                            <form method="POST" action="{{ route('products.destroy', $product->id) }}">
                                                @csrf
                                                @method('DELETE')

                                                <div x-data="{ showDeleteModal: false }"
                                                    @close-modal.window="showDeleteModal = false">

                                                    <button @click.prevent="showDeleteModal = true"
                                                        class="text-red-600 hover:text-red-800" title="Excluir produto">
                                                        <i class="fa-solid fa-circle-xmark text-xl"></i>
                                                    </button>

                                                    <x-modal x-show="showDeleteModal"
                                                        x-on:close-modal.window="showDeleteModal = false"
                                                        x-on:confirm-action.window="showDeleteModal = false; $el.closest('form').submit();"
                                                        title="Confirmação de exclusão" confirmText="Excluir"
                                                        cancelText="Cancelar">
                                                        <p class="text-left">
                                                            Tem certeza que deseja excluir este produto? Essa ação não
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
                <a href="{{ route('products.create') }}">
                    <x-primary-button>Novo Produto</x-primary-button>
                </a>
            </div>

            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </x-card>
    </div>
</x-app-layout>
