<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Suporte - Tama Decorações</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net" />
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/fontawesome.min.js') }}"></script>
    <tallstackui:script />
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-100 text-gray-800 font-sans antialiased">
    <div class="max-w-4xl mx-auto px-6 py-6 bg-white shadow-xl rounded-2xl space-y-6 leading-relaxed">
        <div class="flex items-center gap-6 border-b-2 border-black pb-4">
            <h1 class="text-3xl font-bold text-emerald-800 flex items-center gap-3">
                <i class="fas fa-headset text-emerald-600 text-2xl"></i>
                Suporte Técnico
            </h1>
        </div>

        <div
            class="border-l-4 bg-amber-100 border border-amber-300 text-amber-700 text-sm rounded-xl px-4 py-3 shadow-sm">
            <strong>Nota:</strong> Este sistema não está em uso comercial ou operacional pela empresa. Seu
            desenvolvimento é exclusivamente educacional, simulando um ambiente real para aplicar conceitos de
            engenharia de software.
        </div>

        <p class="text-gray-700">
            No momento, não há um suporte real implementado. Esta página serve apenas para simular onde informações
            ou ajuda estariam disponíveis em um sistema comercial.
        </p>

        <div class="mt-6">
            <a href="{{ route('welcome') }}"
                class="inline-block px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg shadow transition">
                Voltar para a página inicial
            </a>
        </div>
    </div>

    @livewireScripts
</body>

</html>
