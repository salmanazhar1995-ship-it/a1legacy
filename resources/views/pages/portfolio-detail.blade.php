<x-site-layout :page="$page" :navigation-pages="$navigationPages" :settings="$settings" :document-title="$portfolio->seo_title ?: $portfolio->title" :document-description="$portfolio->meta_description ?: $portfolio->excerpt" :document-keywords="$portfolio->meta_keywords" :document-image="$portfolio->image_url" :document-image-alt="$portfolio->image_alt ?: $portfolio->title">
    <section class="relative px-4 pb-20 pt-36 sm:px-6 sm:pt-40">
        <div class="pointer-events-none absolute inset-x-0 top-20 mx-auto h-[480px] max-w-5xl rounded-full bg-neutron-500/10 blur-[120px]"></div>
        <div class="relative mx-auto max-w-7xl">
            <a href="{{ route('portfolio.index') }}" class="inline-flex items-center gap-2 text-sm text-white/40 transition hover:text-white">← Back to Portfolio</a>

            <div class="a1-page-heading mt-9">
                <div class="flex flex-wrap items-center justify-center gap-2">
                    @if($portfolio->category)<span class="rounded-full border border-neutron-300/20 bg-neutron-500/10 px-3 py-1.5 font-mono text-[9px] uppercase tracking-[0.14em] text-neutron-200">{{ $portfolio->category }}</span>@endif
                    @if($portfolio->project_date)<span class="rounded-full border border-white/10 px-3 py-1.5 font-mono text-[9px] uppercase tracking-[0.14em] text-white/35">{{ $portfolio->project_date->format('M Y') }}</span>@endif
                </div>
                <p class="neutron-kicker mt-7">{{ $portfolio->eyebrow ?: 'A1 Legacy Labs portfolio' }}</p>
                <h1 class="mt-4 text-4xl font-semibold tracking-tight text-white sm:text-6xl">{{ $portfolio->title }}</h1>
                <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-white/55">{{ $portfolio->excerpt }}</p>

                @if($portfolio->client_name || $portfolio->project_url)
                    <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                        @if($portfolio->client_name)
                            <div class="rounded-xl border border-white/10 bg-white/[0.025] px-4 py-3">
                                <span class="block font-mono text-[8px] uppercase tracking-[0.16em] text-white/30">Client / business</span>
                                <strong class="mt-1 block text-sm font-medium text-white/75">{{ $portfolio->client_name }}</strong>
                            </div>
                        @endif
                        @if($portfolio->project_url)
                            <a href="{{ $portfolio->project_url }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 rounded-xl bg-neutron-300 px-5 py-3.5 font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-neutron-950 transition hover:brightness-110">Visit live project ↗</a>
                        @endif
                    </div>
                @endif
            </div>

            <div class="mx-auto mt-10 max-w-5xl overflow-hidden rounded-3xl border border-white/10 bg-[#020912] shadow-2xl shadow-black/30" style="aspect-ratio: 16 / 11">
                @if(($portfolio->media_type === 'animation' && $portfolio->animation_html_url) || $portfolio->image_url)
                    @include('site.partials.cms-visual',['mediaType'=>$portfolio->media_type ?: 'image','imageUrl'=>$portfolio->image_url,'animationUrl'=>$portfolio->animation_html_url,'alt'=>$portfolio->image_alt ?: $portfolio->title,'imageClass'=>'h-full w-full object-cover','animationClass'=>'pointer-events-none h-full w-full border-0'])
                @else
                    <div class="flex h-full items-center justify-center bg-[radial-gradient(circle_at_center,rgba(47,143,255,.22),transparent_56%)]">
                        <span class="font-mono text-[10px] uppercase tracking-[0.18em] text-white/25">A1 Legacy Labs project</span>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <section class="border-y border-white/[0.06] bg-white/[0.015] px-4 py-16 sm:px-6">
        <div class="mx-auto max-w-7xl">
            <div class="a1-section-heading">
                <p class="neutron-kicker">Project overview</p>
                <h2 class="mt-4 text-3xl font-semibold tracking-tight text-white">What this project was built to do.</h2>
            </div>
            <div class="mx-auto mt-10 max-w-5xl space-y-8">
                @if($portfolio->description)
                    <div class="prose-a1 text-base leading-8 text-white/55">{!! \App\Support\RichText::render($portfolio->description) !!}</div>
                @endif

                @if(collect($portfolio->highlights)->filter()->isNotEmpty())
                    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach(collect($portfolio->highlights)->filter() as $highlight)
                            <div class="rounded-2xl border border-white/[0.07] bg-neutron-950/45 p-4 text-sm leading-6 text-white/60">
                                <span class="mb-3 block h-1.5 w-1.5 rounded-full bg-neutron-300 shadow-[0_0_12px_rgba(158,203,255,.7)]"></span>
                                {{ $highlight }}
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>

    @if($portfolio->challenge || $portfolio->solution || $portfolio->outcome)
        <section class="px-4 py-20 sm:px-6">
            <div class="mx-auto max-w-7xl">
                <div class="grid gap-5 lg:grid-cols-3">
                    @if($portfolio->challenge)
                        <article class="neutron-panel rounded-2xl p-6 sm:p-7">
                            <p class="font-mono text-[9px] uppercase tracking-[0.16em] text-neutron-300">01 / Challenge</p>
                            <h2 class="mt-4 text-xl font-semibold text-white">The challenge</h2>
                            <div class="prose-a1 mt-4 text-sm leading-7 text-white/48">{!! \App\Support\RichText::render($portfolio->challenge) !!}</div>
                        </article>
                    @endif
                    @if($portfolio->solution)
                        <article class="neutron-panel rounded-2xl p-6 sm:p-7">
                            <p class="font-mono text-[9px] uppercase tracking-[0.16em] text-neutron-300">02 / Build</p>
                            <h2 class="mt-4 text-xl font-semibold text-white">What A1 Legacy Labs built</h2>
                            <div class="prose-a1 mt-4 text-sm leading-7 text-white/48">{!! \App\Support\RichText::render($portfolio->solution) !!}</div>
                        </article>
                    @endif
                    @if($portfolio->outcome)
                        <article class="neutron-panel rounded-2xl p-6 sm:p-7">
                            <p class="font-mono text-[9px] uppercase tracking-[0.16em] text-neutron-300">03 / Outcome</p>
                            <h2 class="mt-4 text-xl font-semibold text-white">Outcome</h2>
                            <div class="prose-a1 mt-4 text-sm leading-7 text-white/48">{!! \App\Support\RichText::render($portfolio->outcome) !!}</div>
                        </article>
                    @endif
                </div>
            </div>
        </section>
    @endif

    @if(collect($portfolio->technologies)->filter()->isNotEmpty())
        <section class="px-4 pb-20 sm:px-6">
            <div class="mx-auto max-w-7xl rounded-2xl border border-white/[0.07] bg-white/[0.02] p-6 sm:p-8">
                <p class="neutron-kicker">Capabilities</p>
                <div class="mt-5 flex flex-wrap gap-2">
                    @foreach(collect($portfolio->technologies)->filter() as $technology)
                        <span class="rounded-full border border-neutron-300/15 bg-neutron-500/[0.06] px-3 py-2 text-xs text-neutron-100">{{ $technology }}</span>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if($relatedPortfolios->isNotEmpty())
        <section class="px-4 pb-24 sm:px-6">
            <div class="mx-auto max-w-7xl">
                <div class="a1-section-heading">
                    <p class="neutron-kicker">More work</p><h2 class="mt-3 text-3xl font-semibold text-white">Related portfolio projects</h2>
                    <a href="{{ route('portfolio.index') }}" class="mt-5 inline-flex text-sm text-neutron-200">View all →</a>
                </div>
                <div class="mt-7 grid gap-5 md:grid-cols-3">
                    @foreach($relatedPortfolios as $related)
                        <a href="{{ route('portfolio.show', $related) }}" class="group neutron-panel overflow-hidden rounded-2xl">
                            <div class="bg-neutron-950" style="aspect-ratio:16/10">
                                @if(($related->media_type === 'animation' && $related->animation_html_url) || $related->image_url) @include('site.partials.cms-visual',['mediaType'=>$related->media_type ?: 'image','imageUrl'=>$related->image_url,'animationUrl'=>$related->animation_html_url,'alt'=>$related->image_alt ?: $related->title,'imageClass'=>'h-full w-full object-cover transition duration-500 group-hover:scale-[1.03]','animationClass'=>'pointer-events-none h-full w-full border-0']) @endif
                            </div>
                            <div class="p-5"><p class="font-mono text-[9px] uppercase text-neutron-300">{{ $related->category ?: 'Portfolio' }}</p><h3 class="mt-3 text-lg font-semibold text-white">{{ $related->title }}</h3><span class="mt-4 inline-flex text-xs text-neutron-200">View detail →</span></div>
                        </a>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <section class="px-4 pb-28 sm:px-6">
        <div class="mx-auto max-w-7xl rounded-3xl border border-neutron-300/15 bg-[linear-gradient(135deg,rgba(47,143,255,.12),rgba(2,9,18,.95))] p-8 text-center sm:p-12">
            <p class="neutron-kicker">Build your next system</p>
            <h2 class="mt-4 text-3xl font-semibold text-white sm:text-4xl">Have a workflow or customer journey you want to improve?</h2>
            <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-white/50">A1 Legacy Labs can map the right combination of AI, website, CRM and automation around the result you need.</p>
            <a href="{{ route('contact') }}" class="mt-7 inline-flex rounded-xl bg-neutron-300 px-6 py-3.5 font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-neutron-950">Start a conversation</a>
        </div>
    </section>
</x-site-layout>
