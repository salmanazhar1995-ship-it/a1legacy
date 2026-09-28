<section class="border-y border-white/[0.07] px-4 py-9 sm:px-6">
    <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-7 lg:flex-row">
        <p class="font-mono text-[10px] uppercase tracking-[0.16em] text-white/30">{{ $section->eyebrow }}</p>
        <div class="flex flex-wrap justify-center gap-x-10 gap-y-5">
            @foreach ($section->items as $item)<span class="text-lg font-medium tracking-tight text-white/55">{{ $item->title }}</span>@endforeach
        </div>
    </div>
</section>
