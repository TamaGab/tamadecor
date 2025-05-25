@section('title', 'Visão Geral')

<x-app-layout>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
            <h2 class="text-sm font-medium text-gray-500 dark:text-gray-300">A receber</h2>
            <p class="text-2xl font-bold text-red-600 mt-2">R$ 0,00</p>
        </div>
        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
            <h2 class="text-sm font-medium text-gray-500 dark:text-gray-300">A pagar</h2>
            <p class="text-2xl font-bold text-red-600 mt-2">R$ 0,00</p>
        </div>
    </div>
</x-app-layout>
