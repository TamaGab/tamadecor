<x-guest-layout>

    <x-custom-card title="Entrar na Conta" backUrl="welcome">
        <!-- Status da Sessão -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="mb-4">
                <x-input-label for="email" value="E-mail" />
                <x-text-input id="email" type="email" name="email" placeholder="Email@exemplo.com"
                    class="block w-full mt-1" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mb-4">
                <x-input-label for="password" value="Senha" />
                <x-text-input id="password" type="password" name="password" placeholder="Sua senha"
                    class="block w-full mt-1" required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="flex items-center justify-between mt-6 mb-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="rounded border-blac-300 text-emerald-600 shadow-sm">
                    <span class="ml-2 text-sm text-gray-600 dark:text-gray-400">Lembrar de mim</span>
                </label>

                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}"
                        class="text-sm text-gray-600 hover:text-emerald-500 dark:hover:text-gray-100 underline">
                        Esqueceu a senha?
                    </a>
                @endif
            </div>

            <div class="text-right">
                <x-primary-button>
                    Entrar
                </x-primary-button>
            </div>
        </form>
    </x-custom-card>

</x-guest-layout>
