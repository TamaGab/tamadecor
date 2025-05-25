@props([
    'title' => null,
    'backUrl' => url()->previous(),
])

<div
    {{ $attributes->merge([
        'class' => trim('bg-white border border-gray-200 rounded-lg shadow-sm p-6 mx-6 my-6'),
    ]) }}>
    @if ($title)
        <div class="mb-6 pb-6 border-b-2 border-black flex items-center">
            <a href="{{ $backUrl }}"
                class="text-emerald-600 hover:text-emerald-900 text-xl font-semibold underline mr-3"
                title="Página Anterior">
                <i class="fa-solid fa-arrow-left"></i>
            </a>
            <h2 class="text-xl font-bold">
                {{ $title }}
            </h2>
        </div>
    @endif


    <div class="text-black">
        {{ $slot }}
    </div>



    {{-- @isset($footer)
        <div class="mt-6 pt-4 border-t border-gray-200 text-right">
            {{ $footer }}
        </div>
    @endisset --}}
</div>
