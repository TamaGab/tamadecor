@props(['value' => null, 'for' => null])

<label for="{{ $for }}" class="block text-md font-medium text-black">
    {{ $value ?? $slot }}
</label>
