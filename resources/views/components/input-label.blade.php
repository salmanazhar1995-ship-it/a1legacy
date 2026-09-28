@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-mono text-[11px] font-medium uppercase tracking-[0.12em] text-white/55']) }}>
    {{ $value ?? $slot }}
</label>
