{{-- resources/views/components/custom-card.blade.php --}}
@props([
    'title' => null,
    'backUrl' => null,
])

@php
    $resolvedBackUrl = $backUrl ? route($backUrl) : url()->previous();
@endphp

<div
    {{ $attributes->merge([
        'class' => 'bg-white border border-gray-200 rounded-lg shadow-sm px-4 sm:px-6 py-6 my-6',
    ]) }}>
    @if ($title)
        <div class="mb-6 pb-6 border-b-2 border-black flex items-center gap-2">
            <a href="{{ $resolvedBackUrl }}"
                class="text-emerald-600 hover:text-emerald-900 text-xl font-semibold underline" title="Página Anterior">
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
</div>
