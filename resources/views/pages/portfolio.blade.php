<x-site-layout :page="$page" :navigation-pages="$navigationPages" :settings="$settings" document-title="Portfolio">
    @php($hero = $page->sections()->where('key', 'hero')->first())

    <section class="relative px-4 pb-14 pt-36 sm:px-6 sm:pt-40">
        <div class="pointer-events-none absolute inset-x-0 top-16 mx-auto h-[420px] max-w-5xl rounded-full bg-neutron-500/10 blur-[110px]"></div>
        <div class="a1-page-heading relative">
            <p class="neutron-kicker">{{ $hero?->eyebrow ?: 'A1 Legacy Labs portfolio' }}</p>
            <h1 class="mt-5 text-4xl font-semibold tracking-tight text-white sm:text-6xl">{{ $hero?->heading ?: 'Systems built to turn customer intent into action.' }}</h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-white/55">{{ $hero?->body ?: 'Explore selected websites, AI reception, CRM and automation projects built by A1 Legacy Labs.' }}</p>
        </div>
    </section>

    <section class="px-4 pb-28 sm:px-6">
        <div class="mx-auto max-w-7xl">
            @if($categories->isNotEmpty())
                <div class="mb-7 flex flex-wrap gap-2">
                    @foreach($categories as $category)
                        <span class="rounded-full border border-neutron-300/15 bg-neutron-500/[0.06] px-3 py-1.5 font-mono text-[9px] uppercase tracking-[0.12em] text-neutron-200">{{ $category }}</span>
                    @endforeach
                </div>
            @endif

            @if($portfolios->isEmpty())
                <div class="neutron-panel rounded-2xl p-10 text-center text-white/45">Portfolio projects will appear here when published from the admin panel.</div>
            @else
                <div class="grid gap-6 lg:grid-cols-2">
                    @foreach($portfolios as $portfolio)
                        <article class="group neutron-panel flex h-full flex-col overflow-hidden rounded-2xl border border-white/[0.07] transition duration-300 hover:-translate-y-1 hover:border-neutron-300/25">
                            <a href="{{ route('portfolio.show', $portfolio) }}" class="relative block overflow-hidden bg-[#020912]" style="aspect-ratio: 16 / 10">
                                @if(($portfolio->media_type === 'animation' && $portfolio->animation_html_url) || $portfolio->image_url)
                                    @include('site.partials.cms-visual',[
                                        'mediaType'=>$portfolio->media_type ?: 'image',
                                        'imageUrl'=>$portfolio->image_url,
                                        'animationUrl'=>$portfolio->animation_html_url,
                                        'alt'=>$portfolio->image_alt ?: $portfolio->title,
                                        'imageClass'=>'h-full w-full object-cover transition duration-500 group-hover:scale-[1.025]',
                                        'animationClass'=>'pointer-events-none h-full w-full border-0',
                                    ])
                                @else
                                    <div class="flex h-full items-center justify-center bg-[radial-gradient(circle_at_center,rgba(47,143,255,.18),transparent_55%)]">
                                        <span class="font-mono text-[10px] uppercase tracking-[0.18em] text-white/25">A1 Legacy Labs</span>
                                    </div>
                                @endif
                                <div class="absolute inset-0 bg-gradient-to-t from-neutron-950/65 via-transparent to-transparent"></div>
                                @if($portfolio->category)
                                    <span class="absolute left-4 top-4 rounded-full border border-white/10 bg-neutron-950/75 px-3 py-1.5 font-mono text-[9px] uppercase tracking-[0.14em] text-neutron-200 backdrop-blur">{{ $portfolio->category }}</span>
                                @endif
                            </a>

                            <div class="flex flex-1 flex-col p-6 sm:p-7">
                                <div class="flex items-start justify-between gap-5">
                                    <div>
                                        <p class="font-mono text-[9px] uppercase tracking-[0.16em] text-neutron-300">{{ $portfolio->eyebrow ?: 'Portfolio project' }}</p>
                                        <h2 class="mt-3 text-2xl font-semibold tracking-tight text-white">{{ $portfolio->title }}</h2>
                                    </div>
                                    <span class="font-mono text-[10px] text-white/20">{{ str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT) }}</span>
                                </div>

                                <p class="mt-4 text-sm leading-7 text-white/48">{{ $portfolio->excerpt }}</p>

                                @if(collect($portfolio->highlights)->filter()->isNotEmpty())
                                    <div class="mt-6 grid grid-cols-1 gap-2 sm:grid-cols-3">
                                        @foreach(collect($portfolio->highlights)->filter()->take(6) as $highlight)
                                            <div class="rounded-xl border border-white/[0.07] bg-white/[0.025] px-3 py-3 text-xs leading-5 text-white/55">{{ $highlight }}</div>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="mt-auto pt-7">
                                    <a href="{{ route('portfolio.show', $portfolio) }}" class="inline-flex w-full items-center justify-between rounded-xl border border-neutron-300/20 bg-neutron-500/[0.07] px-4 py-3.5 font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-neutron-200 transition hover:border-neutron-300/45 hover:bg-neutron-500/15 hover:text-white">
                                        View project detail <span aria-hidden="true">→</span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            @endif
        </div>
    </section>
    @include('site.sections.custom-page-sections',['page'=>$page,'settings'=>$settings])
</x-site-layout>
