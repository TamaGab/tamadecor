<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Tama Decorações</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="{{ asset('js/fontawesome.min.js') }}"></script>
    <tallstackui:script />
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="font-serif antialiased overflow-x-hidden">

    <div class="fixed top-0 left-0 w-full bg-white shadow z-50">
        <x-app-page-header />
    </div>

    <div class="flex">

        <div class="fixed top-[64px] left-0 w-80 h-[calc(100vh-64px)] bg-emerald-600 text-white z-40 overflow-y-auto">
            <x-sidebar />
        </div>

        <div class="flex-1 ml-80 pt-[64px] px-4 sm:px-6 lg:px-8 py-6 overflow-y-auto min-h-screen bg-gray-100">
            {{ $slot }}
        </div>
    </div>

    @livewireScripts
</body>


</html>
