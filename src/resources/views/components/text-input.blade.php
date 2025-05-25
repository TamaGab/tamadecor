@props([
    'disabled' => false,
    'type' => 'text',
    'placeholder' => '',
])

<input type="{{ $type }}" placeholder="{{ $placeholder }}" @disabled($disabled)
    {{ $attributes->merge([
        'class' => 'block w-full rounded-md border border-gray-300 shadow focus:border-emerald-300 focus:ring focus:ring-emerald-100 focus:ring-opacity-50 text-md 
                                placeholder-gray-400 disabled:bg-gray-100 disabled:text-gray-500',
    ]) }} />
