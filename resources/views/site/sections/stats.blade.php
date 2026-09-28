@php($stats = $section->items->values())
<section id="{{ $section->key }}" class="px-4 py-20 sm:px-6 sm:py-24">
    <div class="mx-auto max-w-7xl">
        <div class="a1-section-heading">
            @if($section->eyebrow)<p class="neutron-kicker">{{ $section->eyebrow }}</p>@endif
            @if ($section->heading)<h2 class="mt-3 text-3xl font-medium tracking-[-0.04em] text-white sm:text-5xl">{{ $section->heading }}</h2>@endif
            @if($section->body)<div class="prose-a1 mx-auto mt-4 max-w-2xl text-sm leading-7 text-white/45">{!! \App\Support\RichText::render($section->body) !!}</div>@endif
        </div>

        @if($stats->isNotEmpty())
            <div class="a1-stats-centered mt-9">
                @foreach ($stats as $item)
                    <article class="a1-stats-centered__card min-w-0 rounded-2xl border border-white/[0.09] bg-[#030a12]/90 p-5 transition hover:border-neutron-300/20 hover:bg-white/[0.025] sm:p-6 lg:min-h-[168px]">
                        <p class="break-words text-3xl font-medium tracking-[-0.05em] text-neutron-300 sm:text-4xl xl:text-[42px]">{{ $item->value }}</p>
                        <p class="mt-3 max-w-xs text-xs leading-5 text-white/40 sm:text-sm">{{ $item->title }}</p>
                        @if($item->description)<p class="mt-2 text-xs leading-5 text-white/28">{{ $item->description }}</p>@endif
                    </article>
                @endforeach
            </div>
        @endif
    </div>
</section>

@once
<style>
.a1-stats-centered{display:flex;flex-wrap:wrap;justify-content:center;gap:.75rem}
.a1-stats-centered__card{width:100%}
@media (min-width:640px){.a1-stats-centered__card{width:calc(50% - .375rem)}}
@media (min-width:1024px){.a1-stats-centered__card{width:calc(33.333333% - .5rem)}}
@media (min-width:1280px){.a1-stats-centered__card{width:calc(25% - .5625rem)}}
</style>
@endonce
