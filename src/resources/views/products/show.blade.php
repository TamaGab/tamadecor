@section('title', 'Visualizar Produto')

<x-app-layout>
    <div>
        <x-card title="Visualizar Produto" backUrl="products.index">
            <div class="grid grid-cols-3 gap-6">
                <div>
                    <x-input-label value="Nome" />
                    <p class="mt-1 text-gray-900">{{ $product->name }}</p>
                </div>
            </div>

            <div class="mt-6">
                <x-input-label value="Observações" />
                <div class="mt-1 p-3 bg-gray-50 border border-gray-200 rounded text-gray-900 min-h-[80px]">
                    {!! nl2br(e($product->description ?? '-')) !!}
                </div>
            </div>

            <div class="mt-6 text-right">
                <a href="{{ route('products.index') }}">
                    <x-secondary-button>Voltar à lista</x-secondary-button>
                </a>
            </div>
        </x-card>
    </div>
</x-app-layout>
