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
                <div>
                    <x-secondary-button>
                        <a href="{{ route('clients.create') }}">
                            Novo Cliente</a>
                    </x-secondary-button>
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
                <div>
                    <x-secondary-button>
                        <a href="{{ route('products.create') }}">
                            Novo Produto</a>
                    </x-secondary-button>
                </div>
                <div class="flex justify-end gap-2">
                    <x-secondary-button x-on:click="$modalClose('modal-listproduct')"
                        type="button">Cancelar</x-secondary-button>
                </div>
            </div>
        </x-modal>