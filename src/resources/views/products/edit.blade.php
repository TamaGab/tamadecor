@section('title', 'Editar Produto')

<x-app-layout>
    <div>
        <x-card title="Editar Produto" backUrl="products.index">
            <form method="POST" action="{{ route('products.update', $product) }}">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-3 gap-6">
                    <div>
                        <x-input-label for="name" value="Nome" />
                        <x-text-input id="name" name="name" placeholder="Nome do produto" :value="old('name', $product->name)"
                            class="w-full" />
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-3 gap-6">
                        <x-input-label for="description" value="Observações" />
                        <x-textarea id="description" name="description" placeholder="Observações sobre o produto..."
                            class="w-full">{{ old('notes', $product->description) }}</x-textarea>
                    </div>
                </div>

                <div class="mt-6 text-right col-span-3">
                    <x-primary-button>Atualizar</x-primary-button>
                </div>
            </form>
        </x-card>
    </div>
</x-app-layout>
