<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Página Não Encontrada - Tama Decorações</title>
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <script src="{{ asset('js/fontawesome.min.js') }}"></script>
</head>

<body class="bg-gray-100 flex items-center justify-center min-h-screen font-sans">
    <div class="bg-white p-8 rounded-2xl shadow-xl max-w-lg text-center space-y-6">
        <h1 class="text-6xl font-extrabold text-red-600">ERROR 404</h1>
        <h2 class="text-2xl font-semibold text-gray-800">Ops! Página não encontrada.</h2>
        <p class="text-gray-600">
            A página que você tentou acessar não existe ou foi removida.
        </p>
        <a href="{{ route('welcome') }}"
            class="inline-block bg-emerald-600 hover:bg-emerald-700 text-white px-6 py-3 rounded-lg shadow transition">
            Voltar para a página inicial
        </a>
    </div>
    <script src="{{ asset('js/fontawesome.min.js') }}"></script>
</body>

</html>
