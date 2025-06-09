<x-guest-layout>
    <x-custom-card title="Esqueci a Senha" backUrl="welcome">
        <div class="mb-4 text-sm text-gray-600 dark:text-gray-400">
            Esqueceu sua senha? Sem problemas. Informe seu e-mail e enviaremos um link para redefini-la.
        </div>

        <!-- Status da Sessão -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <x-input-label for="email" value="E-mail" />
                <x-text-input id="email" type="email" name="email" placeholder="Email@exemplo.com"
                    class="block w-full mt-1" :value="old('email')" required autofocus />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="text-right">
                <x-primary-button>
                    Enviar link de redefinição
                </x-primary-button>
            </div>
        </form>
    </x-custom-card>
</x-guest-layout>
