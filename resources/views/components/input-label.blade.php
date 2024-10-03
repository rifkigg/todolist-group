@props(['value'])

<label {{ $attributes->merge(['class' => 'fw-bold ']) }}>
    {{ $value ?? $slot }}
</label>
