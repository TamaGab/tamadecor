@props([
    'rows' => 4,
    'placeholder' => '',
    'disabled' => false,
])

<textarea rows="{{ $rows }}" placeholder="{{ $placeholder }}" @disabled($disabled)
    {{ $attributes->merge([
        'class' => 'block w-full rounded-md border border-gray-300 shadow 
                                        focus:border-emerald-300 focus:ring focus:ring-emerald-100 
                                        focus:ring-opacity-50 text-md placeholder-gray-400 
                                        disabled:bg-gray-100 disabled:text-gray-500 mt-1',
    ]) }}>
{{ $slot }}
</textarea>
