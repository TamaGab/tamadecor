<button
    {{ $attributes->merge([
        'type' => 'button',
        'class' =>
            'inline-flex items-center px-4 py-2 bg-emerald-100 text-emerald-700 border border-emerald-300 rounded-xl font-semibold text-sm hover:bg-emerald-200 hover:text-emerald-800 transition duration-150 ease-in-out',
    ]) }}>
    {{ $slot }}
</button>
