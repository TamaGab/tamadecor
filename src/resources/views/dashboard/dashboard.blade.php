@section('title', 'Visão Geral')

<x-app-layout>
    <div>
        <x-custom-card title="Dashboard">
            <div class="flex flex-col gap-8 ml-4">
                {{-- Coluna dos Cards --}}
                <div class="w-full">
                    <div class="grid grid-cols-2 gap-6">
                        {{-- Total do Dia --}}
                        <div>
                            <a href="{{ route('orders.index') }}" class="group">
                                <x-card class="group-hover:bg-emerald-200">
                                    <div class="pb-2">
                                        <span class="font-bold text-xl">Total do Dia</span>
                                    </div>
                                    <div class="flex items-center justify-between text-lg font-semibold">
                                        R$ {{ number_format($totalValue, 2, ',', '.') }}
                                        <i class="fa-solid fa-money-bill text-3xl text-emerald-500"></i>
                                    </div>

                                </x-card>
                            </a>
                        </div>

                        {{-- Total de Vendas --}}
                        <div>
                            <a href="{{ route('orders.index') }}" class="group">
                                <x-card class="group-hover:bg-emerald-200">
                                    <div class="pb-2">
                                        <span class="font-bold text-xl">Total Vendas</span>
                                    </div>
                                    <div class="flex items-center justify-between text-lg font-semibold">


                                        {{ $totalOrders }}

                                        <i class="fa-solid fa-handshake text-3xl text-emerald-500"></i>
                                    </div>
                                </x-card>
                            </a>
                        </div>
                    </div>
                </div>

                {{-- Coluna do Gráfico --}}
                <div class="flex">
                    <x-card>
                        <form method="GET" action="{{ route('dashboard') }}" x-data x-ref="form">
                            <x-date label="Selecione a data" name="date" format="DD/MM/YYYY"
                                value="{{ $date }}" x-on:select="setTimeout(() => $refs.form.submit(), 50)" />
                        </form>
                        <x-slot:header><span class="font-bold text-xl">Gráfico de Vendas</span></x-slot:header>
                        <canvas id="salesChart" width="100%" height="25"></canvas>
                    </x-card>
                </div>
            </div>
        </x-custom-card>
    </div>
    {{-- @dd($labels, $totals) --}}

    {{-- Script para Chart.js --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const labels = @json($labels);
            const totals = @json($totals);
            const backgroundColors = @json($backgroundColors);

            const ctx = document.getElementById('salesChart').getContext('2d');
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Total de Vendas (R$)',
                        data: totals,
                        backgroundColor: backgroundColors,
                        borderColor: 'rgba(16, 185, 129, 1)',
                        borderWidth: 2,
                        borderRadius: 24,
                        barThickness: 64
                    }]
                },
                options: {
                    responsive: true,
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: {
                                callback: function(value) {
                                    return 'R$ ' + value.toFixed(2).replace('.', ',');
                                }
                            }
                        }
                    }
                }
            });
        });
    </script>

</x-app-layout>
