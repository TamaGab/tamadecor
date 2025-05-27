@props([
    'placeholder' => 'Buscar...',
    'title' => 'Buscar',
    'clearUrl' => request()->url(),
    'formClass' => 'mb-4 w-full max-w-sm',
])

<form method="GET" action="" class="{{ $formClass }}">
    <div class="relative">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="{{ $placeholder }}"
            title="{{ $title }}"
            class="w-full rounded-md border border-gray-300 shadow focus:border-emerald-300 focus:ring focus:ring-emerald-100 focus:ring-opacity-50 text-md placeholder-gray-400 pr-10" />

        <button type="submit"
            class="absolute inset-y-0 right-3 flex items-center text-gray-400 hover:text-emerald-600">
            <i class="fa-solid fa-magnifying-glass"></i>
        </button>

        @if (request('search'))
            <a href="{{ $clearUrl }}"
                class="absolute inset-y-0 right-10 flex items-center text-gray-500 hover:text-red-600"
                title="Limpar busca">
                <i class="fa-solid fa-times-circle"></i>
            </a>
        @endif
    </div>
</form>
