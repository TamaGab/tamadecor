@section('title', 'Visão Geral')

<x-app-layout>
    <div>
        <x-custom-card title="Dashboard">
            <div class="w-2/5 ml-4">
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <x-card>
                            <x-slot:header class="font-bold"><span class="font-bold">Selecione a
                                    data</span></x-slot:header>
                            <form method="GET" action="{{ route('dashboard') }}" x-data x-ref="form">
                                <x-date name="date" format="DD/MM/YYYY" value="{{ $date }}"
                                    x-on:select="setTimeout(() => $refs.form.submit(), 50)" />
                            </form>
                        </x-card>
                    </div>
                    <div>
                        <x-card>
                            <x-slot:header><span class="font-bold">Recebimentos</span></x-slot:header>
                            <div class="text-xl font-semibold">
                                R$ {{ number_format($totalValue, 2, ',', '.') }}
                            </div>
                        </x-card>
                    </div>
                    <div>
                        <x-card>
                            <x-slot:header><span class="font-bold">Vendas</span></x-slot:header>
                            2
                        </x-card>
                    </div>
                    <div>
                        <x-card>
                            <x-slot:header><span class="font-bold">Média do dia</span></x-slot:header>
                            3
                        </x-card>
                    </div>

                </div>
            </div>
        </x-custom-card>
    </div>
</x-app-layout>
