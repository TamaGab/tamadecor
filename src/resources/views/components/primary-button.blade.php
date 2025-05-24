<button
    {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-emerald-600 text-white rounded-xl hover:text-emerald-300 font-semibold']) }}>
    {{ $slot }}
</button>
