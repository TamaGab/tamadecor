@section('title', 'Detalhes do Pedido')

<x-app-layout>
    <div>
        <x-custom-card title="Detalhes do Pedido" backUrl="orders.index">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Pedido #{{ $order->id }}</h2>

                <div class="grid grid-cols-3 gap-4">
                    <div>
                        <x-input-label for="client_name" value="Cliente" />
                        <x-text-input id="client_name" type="text" class="w-full"
                            value="{{ $order->client->name ?? 'Cliente não encontrado' }}" disabled />
                    </div>

                    <div>
                        <x-input-label for="order_date" value="Data do Pedido" />
                        <x-text-input id="order_date" type="text" class="w-full"
                            value="{{ \Carbon\Carbon::parse($order->order_date)->format('d/m/Y') }}" disabled />
                    </div>

                    <div>
                        <x-input-label for="total_price" value="Valor Total" />
                        <x-text-input id="total_price" type="text" class="w-full"
                            value="R$ {{ number_format($order->total, 2, ',', '.') }}" disabled />
                    </div>
                </div>
            </div>


            <h3 class="text-md font-semibold text-gray-800 mb-2">Itens do Pedido</h3>
            @if ($order->orderItems->isEmpty())
                <p class="text-black">Nenhum item cadastrado neste pedido.</p>
            @else
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white border border-gray-200 rounded-md">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left">Produto</th>
                                <th class="px-4 py-2 text-left">Quantidade</th>
                                <th class="px-4 py-2 text-left">Preço Unitário</th>
                                <th class="px-4 py-2 text-left">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr class="border-t hover:bg-gray-50">
                                    <td class="px-4 py-2 text-left">
                                        {{ $item->product->name ?? 'Produto não encontrado' }}
                                    </td>
                                    <td class="px-4 py-2 text-left">{{ $item->quantity }}</td>
                                    <td class="px-4 py-2 text-left">R$
                                        {{ number_format($item->price, 2, ',', '.') }}</td>
                                    <td class="px-4 py-2 text-left">R$ {{ number_format(($item->price*$item->quantity), 2, ',', '.') }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

        </x-custom-card>
    </div>
</x-app-layout>
