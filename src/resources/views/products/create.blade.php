@section('title', 'Cadastro Produtos')

<x-app-layout>
    <div>
        <x-card title="Dados do Produto">
            <form method="POST" action="{{ route('products.store') }}">
                @csrf

                <div class="grid grid-cols-3 gap-6">
                    <div>
                        <x-input-label for="name" value="Nome" />
                        <x-text-input id="name" name="name" placeholder="Nome do produto"
                            value="{{ old('name') }}" class="w-full" />
                        @error('name')
                            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="col-span-3 gap-6">
                        <x-input-label for="notes" value="Observações" />
                        <x-textarea id="notes" name="notes" placeholder="Observações sobre o produto..."
                            class="w-full">{{ old('notes') }}</x-textarea>
                    </div>

                    <div class="mt-6 text-right col-span-3">
                        <x-primary-button>Salvar</x-primary-button>
                    </div>
                </div>

            </form>
        </x-card>
    </div>
</x-app-layout>
