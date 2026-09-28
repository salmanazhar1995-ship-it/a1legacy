@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'rounded-lg border-white/10 bg-white/[0.04] text-white placeholder:text-white/25 shadow-sm focus:border-neutron-500 focus:ring-neutron-500']) }}>
