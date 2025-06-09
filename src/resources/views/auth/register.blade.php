<x-guest-layout>
    <x-custom-card title="Criar Conta (Acesso Restrito)" backUrl="welcome">
        <div
            class="mb-4 p-4 border-l-4 bg-amber-100 border border-amber-300 text-amber-700 text-sm rounded-xl px-4 py-2 shadow-sm">
            Esta tela está disponível apenas para fins de apresentação do sistema.
            <strong>O cadastro de usuários é restrito</strong> e, em um ambiente real, seria feito somente pelo provedor
            do serviço.
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Nome -->
            <div class="mb-4">
                <x-input-label for="name" value="Nome" />
                <x-text-input id="name" class="block w-full mt-1" type="text" name="name" :value="old('name')"
                    placeholder="Seu nome" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- E-mail -->
            <div class="mb-4">
                <x-input-label for="email" value="E-mail" />
                <x-text-input id="email" class="block w-full mt-1" type="email" name="email" :value="old('email')"
                    placeholder="email@exemplo.com" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Senha -->
            <div class="mb-4">
                <x-input-label for="password" value="Senha" />
                <x-text-input id="password" class="block w-full mt-1" type="password" name="password"
                    placeholder="Mínimo 8 caracteres" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirmar Senha -->
            <div class="mb-6">
                <x-input-label for="password_confirmation" value="Confirmar Senha" />
                <x-text-input id="password_confirmation" class="block w-full mt-1" type="password"
                    name="password_confirmation" placeholder="Digite novamente sua senha" required
                    autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="text-right">
                <x-primary-button>
                    Registrar
                </x-primary-button>
            </div>
        </form>
    </x-custom-card>
</x-guest-layout>
