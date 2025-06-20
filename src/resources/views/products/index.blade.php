@section('title', 'Lista de Produtos')

<x-app-layout>
    <div>
        <x-custom-card title="Produtos Cadastrados" backUrl="dashboard">
            <x-searchbox />

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

                                                <div x-data>
                                                    <x-modal id="modal-delete{{ $product->id }}">
                                                        <x-slot:title>
                                                            <span class="text-xl font-semibold text-black">
                                                                Confirmar exclusão
                                                            </span>
                                                        </x-slot:title>

                                                        <p class="text-black mb-4">
                                                            Tem certeza que deseja excluir este produto? Essa ação não
                                                            pode ser desfeita.
                                                        </p>

                                                        <div class="flex justify-end gap-2">
                                                            <x-secondary-button
                                                                x-on:click="$modalClose('modal-delete{{ $product->id }}')"
                                                                type="button">
                                                                Cancelar
                                                            </x-secondary-button>

                                                            <x-primary-button
                                                                x-on:click.prevent="$modalClose('modal-delete{{ $product->id }}'); $el.closest('form').submit();"
                                                                type="button">
                                                                Excluir
                                                            </x-primary-button>
                                                        </div>
                                                    </x-modal>

                                                    <button type="button"
                                                        x-on:click="$modalOpen('modal-delete{{ $product->id }}')"
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
                <a href="{{ route('products.create') }}">
                    <x-primary-button>Novo Produto</x-primary-button>
                </a>
            </div>

            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </x-custom-card>
    </div>
</x-app-layout>
