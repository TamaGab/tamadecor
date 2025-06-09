@section('title', 'Em Desenvolvimento')

<x-app-layout>
    <div class="flex items-center justify-center">
        <x-custom-card class="max-w-xl w-full">
            <div class="flex flex-col items-center text-center p-6 space-y-6">
                <i class="fa-solid fa-person-digging text-7xl text-amber-500 animate-bounce drop-shadow-lg"></i>

                <h1 class="text-3xl font-extrabold text-gray-800 tracking-tight">
                    Esta função está em desenvolvimento
                </h1>

                <p class="text-gray-600 text-md leading-relaxed">
                    O recurso que você tentou acessar ainda está sendo construído.<br>
                    Estamos trabalhando para entregar uma experiência completa o mais breve possível.<br>
                    Obrigado pela compreensão!
                </p>

                {{-- Barra de progresso --}}
                <div class="w-full bg-gray-200 rounded-full h-3 relative overflow-hidden shadow-inner">
                    <div class="bg-gray-600 h-full w-3/5 rounded-full"></div>
                </div>

                <div
                    class="border-l-4 bg-amber-100 border border-amber-300 text-amber-700 text-sm rounded-xl px-4 py-2 shadow-sm">
                    Esta função estará disponível nas próximas atualizações.
                </div>

                <div class="text-xs text-gray-400 italic mt-1">
                    ~ Página temporária exibida para fins acadêmicos ~
                </div>

                <x-primary-button class="mt-4" onclick="window.location='{{ route('dashboard') }}'">
                    <i class="fa-solid fa-arrow-left mr-2"></i> Voltar
                </x-primary-button>
            </div>
        </x-custom-card>
    </div>
</x-app-layout>
