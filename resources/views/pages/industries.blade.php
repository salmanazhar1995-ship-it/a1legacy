<x-site-layout :page="$page" :navigation-pages="$navigationPages" :settings="$settings" document-title="Industries">
    @php($hero = $page->sections->firstWhere('key','hero'))
    <section class="relative overflow-hidden px-4 pb-16 pt-36 sm:px-6 sm:pt-40">
        <div class="pointer-events-none absolute left-1/2 top-24 h-80 w-[900px] -translate-x-1/2 rounded-full bg-neutron-500/10 blur-[140px]"></div>
        <div class="a1-page-heading relative">
            <p class="neutron-kicker">{{ $hero?->eyebrow ?: 'Industries' }}</p>
            <h1 class="mt-5 text-4xl font-semibold tracking-[-0.045em] text-white sm:text-6xl lg:text-7xl">{{ $hero?->heading ?: 'AI systems shaped around your industry.' }}</h1>
            <div class="prose-a1 mx-auto mt-6 max-w-2xl text-base leading-8 text-white/50 sm:text-lg">{!! \App\Support\RichText::render($hero?->body ?: 'Explore how A1 Legacy can support customer operations, lead handling and automation across different industries.') !!}</div>
        </div>
    </section>

    <section class="px-4 pb-28 sm:px-6">
        <div class="mx-auto max-w-7xl">
            @if($industries->isEmpty())
                <div class="neutron-panel rounded-3xl p-10 text-white/50">Industry pages will appear here when they are enabled in Admin → Industries.</div>
            @else
                <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                    @foreach($industries as $industry)
                        <a href="{{ route('industries.show', $industry->slug) }}" class="group relative overflow-hidden rounded-3xl border border-white/[0.08] bg-[#050d16] transition duration-300 hover:-translate-y-1 hover:border-neutron-300/30 hover:shadow-[0_28px_80px_rgba(0,0,0,.3)]">
                            <div class="relative aspect-[16/10] overflow-hidden border-b border-white/[0.06] bg-[#07111d]">
                                @if(($industry->media_type === 'animation' && $industry->animation_html_url) || $industry->image_url)
                                    @include('site.partials.cms-visual',[
                                        'mediaType'=>$industry->media_type ?: 'image',
                                        'imageUrl'=>$industry->image_url,
                                        'animationUrl'=>$industry->animation_html_url,
                                        'alt'=>$industry->image_alt ?: $industry->title,
                                        'imageClass'=>'h-full w-full object-cover transition duration-500 group-hover:scale-[1.035]',
                                        'animationClass'=>'pointer-events-none h-full w-full border-0',
                                    ])
                                    <div class="pointer-events-none absolute inset-0 bg-gradient-to-t from-[#050d16]/85 via-transparent to-transparent"></div>
                                @else
                                    <div class="flex h-full items-center justify-center text-neutron-300/50"><svg class="h-12 w-12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M4 19V8l8-4 8 4v11M8 19v-5h8v5M8 10h.01M12 10h.01M16 10h.01"/></svg></div>
                                @endif
                            </div>
                            <div class="p-6 sm:p-7">
                                @if($industry->category)<p class="font-mono text-[9px] font-semibold uppercase tracking-[.18em] text-neutron-300">{{ $industry->category }}</p>@endif
                                <h2 class="mt-3 text-2xl font-semibold tracking-tight text-white">{{ $industry->title }}</h2>
                                <p class="mt-3 line-clamp-3 text-sm leading-6 text-white/45">{{ strip_tags((string)$industry->description) }}</p>
                                <span class="mt-6 inline-flex items-center gap-2 text-xs font-medium text-neutron-200">Explore industry <span class="transition group-hover:translate-x-1">→</span></span>
                            </div>
                        </a>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    @include('site.sections.custom-page-sections',['page'=>$page,'settings'=>$settings])
</x-site-layout>
