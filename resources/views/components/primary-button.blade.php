<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center rounded-lg border border-neutron-300/30 bg-neutron-300 px-4 py-2.5 font-mono text-xs font-semibold uppercase tracking-widest text-neutron-950 shadow-glow transition hover:bg-white focus:outline-none focus:ring-2 focus:ring-neutron-300 focus:ring-offset-2 focus:ring-offset-neutron-950']) }}>
    {{ $slot }}
</button>
