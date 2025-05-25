@section('title', 'Visualizar Cliente')

<x-app-layout>
    <div>
        <x-flowbite.card title="Visualizar Cliente" backUrl="clients.index">
            <div class="grid grid-cols-3 gap-6">
                <div>
                    <x-input-label value="Nome" />
                    <p class="mt-1 text-gray-900">{{ $client->name }}</p>
                </div>

                <div>
                    <x-input-label value="CPF" />
                    <p class="mt-1 text-gray-900">{{ $client->cpf_formatado ?? '-' }}</p>
                </div>

                <div>
                    <x-input-label value="RG" />
                    <p class="mt-1 text-gray-900">{{ $client->rg ?? '-' }}</p>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-6 mt-6">
                <div>
                    <x-input-label value="Endereço" />
                    <p class="mt-1 text-gray-900">{{ $client->address ?? '-' }}</p>
                </div>

                <div>
                    <x-input-label value="Telefone" />
                    <p class="mt-1 text-gray-900">{{ $client->phone_formatado ?? '-' }}</p>
                </div>

                <div>
                    <x-input-label value="E-mail" />
                    <p class="mt-1 text-gray-900">{{ $client->email ?? '-' }}</p>
                </div>
            </div>

            <div class="mt-6">
                <x-input-label value="Observações" />
                <div class="mt-1 p-3 bg-gray-50 border border-gray-200 rounded text-gray-900 min-h-[80px]">
                    {!! nl2br(e($client->notes ?? '-')) !!}
                </div>
            </div>

            <div class="mt-6 text-right">
                <a href="{{ route('clients.index') }}">
                    <x-secondary-button>Voltar à lista</x-secondary-button>
                </a>
            </div>
        </x-flowbite.card>
    </div>
</x-app-layout>
