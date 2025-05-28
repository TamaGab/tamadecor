@section('title', 'Cadastro venda')

<x-app-layout>
    <div x-data="{
        selectedClient: null,
        orderItems: [{ product: null, price: '', quantity: 1 }],
        currentProductIndex: 0,
    
        openProductModal(index) {
            this.currentProductIndex = index;
            $modalOpen('modal-listproduct');
        },
    
        removeProduct(index) {
            this.orderItems.splice(index, 1);
            if (this.orderItems.length === 0) {
                this.orderItems.push({ product: null, price: '', quantity: 1 });
            }
        },
    
        maskCurrency(value) {
            value = value.replace(/\D/g, '');
            if (!value) return '';
            value = (parseInt(value) / 100).toFixed(2).replace('.', ',');
            return 'R$ ' + value;
        },
    
        totalValue() {
            return this.orderItems.reduce((total, item) => {
                if (!item.price || !item.quantity) return total;
                let numericPrice = parseFloat(item.price.replace('R$', '').replace('.', '').replace(',', '.').trim());
                if (isNaN(numericPrice)) return total;
                return total + (numericPrice * item.quantity);
            }, 0);
        }
    }"
        x-on:product-selected.window="
        orderItems[currentProductIndex].product = $event.detail.product;
        $modalClose('modal-listproduct');

        if (currentProductIndex === orderItems.length - 1) {
            orderItems.push({ product: null, price: '', quantity: 1 });
        }
    ">

        <x-custom-card title="Dados da Venda" backUrl="orders.index">
            <form method="POST" action="{{ route('orders.store') }}">
                @csrf

                <!-- Seleção do Cliente -->
                <div class="mb-6">
                    <x-input-label>Cliente</x-input-label>
                    <div class="w-1/4 border border-gray-300 rounded-md p-3 min-h-[3rem] bg-gray-50 text-gray-800 cursor-pointer hover:border-green-400 transition"
                        x-on:click="$modalOpen('modal-listclient')">
                        <template x-if="selectedClient">
                            <span x-text="selectedClient.name"></span>
                        </template>
                        <template x-if="!selectedClient">
                            <span class="text-gray-400">Clique para selecionar um cliente</span>
                        </template>
                    </div>
                    <input type="hidden" name="client_id" :value="selectedClient?.id">
                </div>

                <!-- Produtos -->
                <div>
                    <x-input-label>Produtos</x-input-label>
                    <template x-for="(item, index) in orderItems" :key="index">
                        <div class="flex items-end gap-3 mb-3">
                            <!-- Produto -->
                            <div class="w-1/2 border border-gray-300 rounded-md p-3 min-h-[3rem] bg-gray-50 text-gray-800 cursor-pointer hover:border-green-400 transition"
                                x-on:click="openProductModal(index)">
                                <template x-if="item.product">
                                    <span x-text="item.product.name"></span>
                                </template>
                                <template x-if="!item.product">
                                    <span class="text-gray-400">Clique para selecionar um produto</span>
                                </template>
                            </div>

                            <!-- Quantidade -->
                            <div>
                                <text-input class="block mb-1">Quantidade</text-input>
                                <input type="number" :name="`order_items[${index}][quantity]`" min="1"
                                    step="1"
                                    class="w-20 border border-gray-300 rounded-md p-2 placeholder-gray-400 focus:border-emerald-300 block"
                                    x-model="item.quantity">
                            </div>

                            <!-- Valor -->
                            <div>
                                <text-input class="block mb-1">Valor</text-input>
                                <input type="text" :name="`order_items[${index}][price]`"
                                    class="border border-gray-300 rounded-md p-2 w-28 placeholder-gray-400 focus:border-emerald-300 block"
                                    x-model="item.price" @input="item.price = maskCurrency($event.target.value)">
                            </div>

                            <!-- Hidden product_id -->
                            <input type="hidden" :name="`order_items[${index}][product_id]`"
                                :value="item.product ? item.product.id : ''" required>

                            <!-- Remover item -->
                            <button type="button" class="text-red-600 hover:text-red-900" x-show="item.product"
                                x-on:click="removeProduct(index)">
                                <i class="fa-solid fa-circle-xmark text-xl"></i>
                            </button>
                        </div>
                    </template>
                </div>

                <!-- TOTAL DA VENDA -->
                <div class="mt-6 text-right text-lg font-semibold text-gray-800">
                    Total: <span x-text="'R$ ' + totalValue().toFixed(2).replace('.', ',')"></span>
                </div>

                <div class="mt-6 text-right">
                    <x-primary-button type="submit">Salvar Pedido</x-primary-button>
                </div>
            </form>
        </x-custom-card>

        <!-- MODAL DE CLIENTES -->
        <x-modal id="modal-listclient">
            <x-slot:title>
                <span class="text-xl font-semibold text-black">Selecionar Cliente</span>
            </x-slot:title>

            <div x-data="{ searchClient: '' }">
                <input type="text" x-model="searchClient" placeholder="Buscar cliente..."
                    class="w-full rounded border px-3 py-2 mb-4" />
                <div class="overflow-x-auto mb-4 p-4">
                    <table class="min-w-full bg-white border border-gray-200 rounded-md">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left">Nome</th>
                                <th class="px-4 py-2 text-left">CPF</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($clients as $client)
                                <tr class="border-t hover:bg-gray-50 cursor-pointer"
                                    x-show="{{ json_encode($client->name) }}.toLowerCase().includes(searchClient.toLowerCase())"
                                    @click="selectedClient = {{ $client->toJson() }}; $modalClose('modal-listclient')">
                                    <td class="px-4 py-2 text-left">{{ $client->name }}</td>
                                    <td class="px-4 py-2 text-left">{{ $client->cpf_formatado }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end gap-2">
                    <x-secondary-button x-on:click="$modalClose('modal-listclient')"
                        type="button">Cancelar</x-secondary-button>
                </div>
            </div>
        </x-modal>

        <!-- MODAL DE PRODUTOS -->
        <x-modal id="modal-listproduct" x-cloak>
            <x-slot:title>
                <span class="text-xl font-semibold text-black">Selecionar Produto</span>
            </x-slot:title>

            <div x-data="{ searchProduct: '' }">
                <input type="text" x-model="searchProduct" placeholder="Buscar produto..."
                    class="w-full rounded border px-3 py-2 mb-4" />
                <div class="overflow-x-auto mb-4 p-4">
                    <table class="min-w-full bg-white border border-gray-200 rounded-md">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 text-left">Produto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                                <tr class="border-t hover:bg-gray-50 cursor-pointer"
                                    x-show="{{ json_encode($product->name) }}.toLowerCase().includes(searchProduct.toLowerCase())"
                                    @click="$dispatch('product-selected', { product: {{ $product->toJson() }} })">
                                    <td class="px-4 py-2 text-left">{{ $product->name }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="flex justify-end gap-2">
                    <x-secondary-button x-on:click="$modalClose('modal-listproduct')"
                        type="button">Cancelar</x-secondary-button>
                </div>
            </div>
        </x-modal>
    </div>
</x-app-layout>
