<x-site-layout :page="$page" :navigation-pages="$navigationPages" :settings="$settings" :document-title="$industry->seo_title ?: $industry->title.' Industry AI Solutions'" :document-description="$industry->meta_description ?: strip_tags((string)$industry->description)" :document-keywords="$industry->meta_keywords" :document-image="$industry->image_url" :document-image-alt="$industry->image_alt ?: $industry->title">
    <section class="relative overflow-hidden px-4 pb-20 pt-36 sm:px-6 sm:pt-40">
        <div class="pointer-events-none absolute right-[-10%] top-12 h-[480px] w-[680px] rounded-full bg-neutron-500/10 blur-[150px]"></div>
        <div class="relative mx-auto max-w-7xl">
            <a href="{{ route('industries.index') }}" class="inline-flex items-center gap-2 text-sm text-white/40 transition hover:text-white">← All industries</a>
            <div class="a1-page-heading mt-8">
                <p class="neutron-kicker">{{ $industry->category ?: 'Industry solutions' }}</p>
                <h1 class="mt-5 text-4xl font-semibold tracking-[-0.05em] text-white sm:text-6xl">AI for {{ $industry->title }}</h1>
                @if($industry->description)<div class="prose-a1 mx-auto mt-6 max-w-2xl text-base leading-8 text-white/52">{!! \App\Support\RichText::render($industry->description) !!}</div>@endif
                <div class="mt-8 flex flex-wrap justify-center gap-3">
                    <a href="{{ route('contact') }}" class="rounded-xl bg-neutron-300 px-5 py-3 text-sm font-semibold text-neutron-950 transition hover:bg-white">Discuss your workflow</a>
                    @if($industry->link_url)
                        <a href="{{ $industry->link_url }}" class="rounded-xl border border-white/10 px-5 py-3 text-sm text-white/65 transition hover:bg-white/5 hover:text-white">{{ $industry->link_label ?: 'Explore solution' }}</a>
                    @else
                        <a href="{{ route('products') }}" class="rounded-xl border border-white/10 px-5 py-3 text-sm text-white/65 transition hover:bg-white/5 hover:text-white">Explore products</a>
                    @endif
                </div>
            </div>
            <div class="mx-auto mt-10 max-w-5xl overflow-hidden rounded-3xl border border-white/[0.08] bg-[#07111d] shadow-[0_30px_100px_rgba(0,0,0,.25)]">
                <div class="aspect-[4/3] overflow-hidden">
                    @if(($industry->media_type === 'animation' && $industry->animation_html_url) || $industry->image_url)
                        @include('site.partials.cms-visual',[
                            'mediaType'=>$industry->media_type ?: 'image',
                            'imageUrl'=>$industry->image_url,
                            'animationUrl'=>$industry->animation_html_url,
                            'alt'=>$industry->image_alt ?: $industry->title,
                            'imageClass'=>'h-full w-full object-cover',
                            'animationClass'=>'pointer-events-none h-full w-full border-0',
                        ])
                    @else
                        <div class="flex h-full items-center justify-center text-neutron-300/50"><svg class="h-16 w-16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M4 19V8l8-4 8 4v11M8 19v-5h8v5M8 10h.01M12 10h.01M16 10h.01"/></svg></div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <section class="px-4 pb-28 sm:px-6">
        <div class="mx-auto max-w-7xl">
            <div class="a1-section-heading">
                <p class="neutron-kicker">Where AI fits</p>
                <h2 class="mt-3 text-3xl font-semibold tracking-tight text-white sm:text-5xl">Practical automation opportunities</h2>
            </div>

            <div class="mt-10 grid gap-5 lg:grid-cols-[1.25fr_.75fr]">
                <article class="rounded-3xl border border-white/[0.08] bg-white/[0.025] p-7 sm:p-9">
                    @if(collect($industry->highlights)->filter()->isNotEmpty())
                        <div class="grid gap-3 sm:grid-cols-2">
                            @foreach($industry->highlights as $highlight)
                                <div class="rounded-2xl border border-white/[0.08] bg-[#07111d]/70 p-5"><div class="flex gap-3"><span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-neutron-300 shadow-[0_0_14px_rgba(158,203,255,.75)]"></span><p class="text-sm leading-6 text-white/60">{{ $highlight }}</p></div></div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm leading-7 text-white/45">Add industry highlights from the admin panel to show the most relevant automation opportunities.</p>
                    @endif
                </article>
                <aside class="rounded-3xl border border-neutron-300/15 bg-neutron-500/[0.06] p-7 text-center sm:p-9">
                    <p class="neutron-kicker">Existing systems</p>
                    <h3 class="mt-3 text-2xl font-semibold text-white">Fit around the tools you already use.</h3>
                    <p class="mt-5 text-sm leading-7 text-white/50">{{ $industry->system_note ?: 'A1 Legacy can be designed around your approved CRM, calendar, messaging and operational systems rather than forcing a full replacement.' }}</p>
                    <a href="{{ route('contact') }}" class="mt-7 inline-flex text-sm font-medium text-neutron-200">Plan an integration →</a>
                </aside>
            </div>
        </div>
    </section>
</x-site-layout>
