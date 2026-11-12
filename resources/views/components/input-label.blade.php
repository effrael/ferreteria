@props(['value'])

<label {{ $attributes->merge(['class' => 'text-slate-700 font-semibold']) }}>
    {{ $value ?? $slot }}
</label>
