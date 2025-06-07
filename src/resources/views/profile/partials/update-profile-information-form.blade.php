<section>
    <header class="mb-6">
        <p class="mt-1 text-sm text-gray-600">
            Atualize as informações do seu perfil e endereço de e-mail.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="name" :value="'Nome'" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)"
                required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="'E-mail'" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)"
                required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())
                <div class="mt-2 text-sm text-gray-800">
                    Seu e-mail ainda não foi verificado.

                    <button form="send-verification"
                        class="ml-1 underline text-sm text-amber-700 hover:text-amber-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500">
                        Clique aqui para reenviar o e-mail de verificação.
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-emerald-600">
                            Um novo link de verificação foi enviado para seu e-mail.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center justify-between mt-6">
            <x-primary-button>
                <i class="fa-solid fa-floppy-disk mr-2"></i> Salvar
            </x-primary-button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
                    class="text-sm text-emerald-600 ml-4">
                    <i class="fa-solid fa-check-circle mr-1"></i> Perfil atualizado com sucesso.
                </p>
            @endif
        </div>
    </form>
</section>
