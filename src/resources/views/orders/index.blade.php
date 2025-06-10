@section('title', 'Lista de Pedidos')

<x-app-layout>
    <div>
        <x-custom-card title="Pedidos Cadastrados" backUrl="dashboard">
            <x-searchbox></x-searchbox>
            @if ($orders->isEmpty())
                <p class="text-black">Nenhum pedido cadastrado.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-md">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left">ID</th>
                                <th class="px-4 py-2 text-left">Cliente</th>
                                <th class="px-4 py-2 text-left">Data do Pedido</th>
                                <th class="px-4 py-2 text-left">Valor Total</th>
                                <th class="px-4 py-2 text-right">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="px-4 py-2 text-left">{{ $order->id }}</td>
                                    <td class="px-4 py-2 text-left">
                                        {{ $order->client->name ?? 'Cliente não encontrado' }}</td>
                                    <td class="px-4 py-2 text-left">
                                        {{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}</td>
                                    <td class="px-4 py-2 text-left">
                                        R$ {{ number_format($order->total, 2, ',', '.') }}
                                    </td>
                                    <td>{{ $order->id }}</td>
                                    <td class="px-4 py-2 text-right">
                                        <div class="flex items-center justify-end gap-3">
                                            <a href="{{ route('orders.show', $order) }}" title="Visualizar"
                                                class="text-emerald-600 hover:text-emerald-900 flex items-center justify-center w-6 h-6">
                                                <i class="fa-solid fa-eye"></i>
                                            </a>
                                            <a href="{{ route('orders.edit', $order) }}" title="Editar"
                                                class="text-blue-600 hover:text-blue-900 flex items-center justify-center w-6 h-6">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                            <form method="POST" action="{{ route('orders.destroy', $order->id) }}">
                                                @csrf
                                                @method('DELETE')

                                                <div x-data>
                                                    <x-modal id="modal-delete{{ $order->id }}">
                                                        <x-slot:title>
                                                            <span class="text-xl font-semibold text-black">
                                                                Confirmar exclusão
                                                            </span>
                                                        </x-slot:title>

                                                        <p class="text-black mb-4">
                                                            Tem certeza que deseja excluir este pedido? Essa ação não
                                                            pode ser desfeita.
                                                        </p>

                                                        <div class="flex justify-end gap-2">
                                                            <x-secondary-button
                                                                x-on:click="$modalClose('modal-delete{{ $order->id }}')"
                                                                type="button">
                                                                Cancelar
                                                            </x-secondary-button>

                                                            <x-primary-button
                                                                x-on:click.prevent="$modalClose('modal-delete{{ $order->id }}'); $el.closest('form').submit();"
                                                                type="button">
                                                                Excluir
                                                            </x-primary-button>
                                                        </div>
                                                    </x-modal>

                                                    <button type="button"
                                                        x-on:click="$modalOpen('modal-delete{{ $order->id }}')"
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
                <a href="{{ route('orders.create') }}">
                    <x-primary-button>Novo Pedido</x-primary-button>
                </a>
            </div>


            <div class="mt-4">
                {{ $orders->links() }}
            </div>
        </x-custom-card>
    </div>
</x-app-layout>
