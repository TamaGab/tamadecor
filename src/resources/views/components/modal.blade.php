@props([
    'title' => '',
    'confirmText' => 'Confirmar',
    'cancelText' => 'Cancelar',
])

<div x-cloak
    {{ $attributes->merge(['class' => 'fixed inset-0 z-50 flex items-center justify-center px-4 py-6 bg-black bg-opacity-50']) }}
    x-on:click.outside="$dispatch('close-modal')" x-on:keydown.escape.window="$dispatch('close-modal')"
    style="display:none;">
    <div class="bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden w-full sm:max-w-lg mx-auto p-6"
        x-on:click.stop x-transition>

        @if ($title)
            <header class="mb-4 border-b border-gray-300 pb-2 text-left">
                <h2 class="text-lg font-bold text-black">{{ $title }}</h2>
            </header>
        @endif

        <section class="text-black">
            {{ $slot }}
        </section>

        <footer class="mt-6 flex justify-end gap-2">
            <x-secondary-button @click="$dispatch('close-modal')" type="button">
                {{ $cancelText }}
            </x-secondary-button>

            <x-primary-button @click="$dispatch('confirm-action')" type="button">
                {{ $confirmText }}
            </x-primary-button>
        </footer>
    </div>
</div>
