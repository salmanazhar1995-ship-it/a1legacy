<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center rounded-lg border border-white/10 bg-white/5 px-4 py-2 font-mono text-xs font-semibold uppercase tracking-widest text-white/70 transition hover:bg-white/10 hover:text-white focus:outline-none focus:ring-2 focus:ring-neutron-300 focus:ring-offset-2 focus:ring-offset-neutron-950 disabled:opacity-25']) }}>
    {{ $slot }}
</button>
