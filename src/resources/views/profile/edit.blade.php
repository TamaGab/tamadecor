{{-- resources/views/profile/show.blade.php --}}
@section('title', 'Perfil do Vendedor')

<x-app-layout>
    <div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <x-custom-card>
                <div class="flex items-center justify-between pb-4 border-b border-gray-300">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <i class="fa-solid fa-user text-emerald-600"></i>
                        Informações de {{ Auth::user()->name }}
                    </h2>
                </div>

                <div class="mt-6">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </x-custom-card>

            <x-custom-card>
                <div class="flex items-center justify-between pb-4 border-b border-gray-300">
                    <h2 class="text-xl font-bold text-gray-800 flex items-center gap-2">
                        <i class="fa-solid fa-lock text-emerald-600"></i>
                        Atualizar Senha
                    </h2>
                </div>

                <div class="mt-6">
                    @include('profile.partials.update-password-form')
                </div>
            </x-custom-card>
        </div>
    </div>
</x-app-layout>
