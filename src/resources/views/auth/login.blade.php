<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Login - Tama Decorações</title>

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

<body class="bg-gray-100 text-gray-800 min-h-screen flex items-center justify-center">

    <div
        class="w-full max-w-7xl mx-auto flex flex-col md:flex-row bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
        <!-- Coluna do Formulário -->
        <div class="w-full md:w-1/2 p-8 md:p-12 space-y-6">
            <div>
                <img src="{{ asset('img/tamarossi-decoracoes-logo.png') }}" alt="Logo da empresa Tamarossi Decorações">
                <jj class="text-md text-gray-500 font-semibold">Informe seus dados abaixo</p>
            </div>

            <!-- Mensagem de status da sessão (ex: senha redefinida com sucesso) -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" class="space-y-4">
                @csrf

                <!-- Campo: E-mail -->
                <div>
                    <x-input-label for="email" value="E-mail" />
                    <x-text-input id="email" type="email" name="email" class="block w-full mt-1"
                        :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Campo: Senha -->
                <div>
                    <x-input-label for="password" value="Senha" />
                    <x-text-input id="password" type="password" name="password" class="block w-full mt-1" required
                        autocomplete="current-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Checkbox: Lembrar -->
                <div class="flex items-center justify-between">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" value="1"
                            class="rounded border-gray-300 text-emerald-600 shadow-sm">
                        <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Lembrar de mim</span>
                    </label>

                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-sm text-emerald-600 hover:underline">
                            Esqueci minha senha
                        </a>
                    @endif
                </div>

                <!-- Botão de Login -->
                <x-primary-button class="w-full justify-center py-2 text-lg">
                    Entrar
                </x-primary-button>

                <!-- Link de suporte -->
                <div class="text-center text-sm mt-2 text-gray-500">
                    Precisa de suporte? <a href="{{ route('support') }}" class="underline hover:text-emerald-700">Acesse
                        aqui</a>
                </div>
            </form>

        </div>

        <div
            class="hidden md:flex md:w-1/2 bg-gradient-to-tr from-emerald-100 to-white items-center justify-center p-12">
            <div class="max-w-md text-center space-y-6">
                <div class="text-emerald-600 text-5xl">
                    <i class="fas fa-cubes-stacked"></i>
                </div>

                <h2 class="text-lg font-semibold text-emerald-800">
                    Projeto acadêmico de ERP<br>
                    <span class="text-xl text-emerald-600 font-extrabold">baseado em necessidades reais da
                        empresa</span>
                </h2>

                <p class="text-sm text-gray-700">
                    Este sistema faz parte de um projeto acadêmico do curso de Análise e Desenvolvimento de Sistemas,
                    com o objetivo de simular uma solução real para a gestão interna da empresa <strong>Tama
                        Decorações</strong>.
                </p>

                <p class="text-sm text-gray-700">
                    Todas as funcionalidades foram projetadas com base em entrevistas, observações e necessidades
                    identificadas no ambiente da empresa, como o controle de pedidos, cadastro de clientes e
                    gerenciamento de produtos.
                </p>

                <div
                    class="border-l-4 bg-amber-100 border border-amber-300 text-amber-700 text-sm rounded-xl px-4 py-2 shadow-sm">
                    <strong>Nota:</strong> Este sistema não está em uso comercial ou operacional pela empresa. Seu
                    desenvolvimento tem fins exclusivamente educacionais e visa aplicar os conceitos aprendidos em sala
                    de aula à prática simulada de engenharia de software.
                </div>

                <a href="{{ route('about') }}"
                    class="inline-flex items-center gap-2 mt-4 text-sm font-medium text-emerald-600 hover:text-emerald-800 hover:underline transition-all">
                    <i class="fas fa-circle-info text-base"></i>
                    Sobre o Projeto
                </a>
            </div>
        </div>

    </div>

    @livewireScripts
</body>

</html>
