<section id="{{ $section->key }}" class="px-4 py-24 sm:px-6">
    <div class="mx-auto max-w-7xl">
        <div class="a1-section-heading">
            @if ($section->eyebrow)<p class="neutron-kicker">{{ $section->eyebrow }}</p>@endif
            @if ($section->heading)<h2 class="mt-4 text-4xl font-medium tracking-[-0.05em] sm:text-6xl">{{ $section->heading }}</h2>@endif
        </div>
        <div class="mt-12 grid gap-4 lg:grid-cols-3">@foreach ($section->items as $item)<article @class(['neutron-panel flex flex-col rounded-2xl p-7', 'border-neutron-300/30 bg-neutron-500/[0.07] shadow-glow' => $item->badge === 'Most popular'])><div class="flex items-start justify-between gap-4"><div><h3 class="text-xl font-medium">{{ $item->title }}</h3><p class="mt-2 text-sm text-white/35">{{ $item->subtitle }}</p></div>@if ($item->badge)<span class="rounded-full border border-white/10 px-3 py-1 font-mono text-[9px] uppercase tracking-wider text-neutron-300">{{ $item->badge }}</span>@endif</div><p class="mt-8 text-4xl font-medium tracking-[-0.05em]">{{ $item->value }}</p><ul class="mt-8 flex flex-1 flex-col gap-3">@foreach (preg_split('/\r\n|\r|\n/', $item->description ?? '') as $feature) @if ($feature !== '')<li class="flex gap-3 text-sm text-white/55"><span class="text-neutron-300">✓</span>{{ $feature }}</li>@endif @endforeach</ul>@if ($item->link_label)<a href="{{ $item->link_url ?: '#' }}" class="mt-8 rounded-xl bg-white/10 px-5 py-3 text-center font-mono text-xs font-semibold uppercase tracking-wider transition hover:bg-neutron-300 hover:text-neutron-950">{{ $item->link_label }}</a>@endif</article>@endforeach</div>
    </div>
</section>
