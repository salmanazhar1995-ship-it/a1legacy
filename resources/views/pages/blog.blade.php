<x-site-layout :page="$page" :navigation-pages="$navigationPages" :settings="$settings">
    @php $hero = $page->sections->firstWhere('key', 'hero'); @endphp
    <section class="relative overflow-hidden px-4 pb-16 pt-36 sm:px-6 sm:pb-24 sm:pt-44">
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_50%_0%,rgba(47,143,255,0.18),transparent_44%)]"></div>
        <div class="relative mx-auto max-w-7xl">
            <div class="mx-auto max-w-3xl text-center">
                <p class="neutron-kicker">{{ $hero?->eyebrow ?: 'A1 Legacy insights' }}</p>
                <h1 class="mt-5 text-4xl font-medium tracking-[-0.04em] text-white sm:text-6xl">{{ $hero?->heading ?: 'Ideas for better AI, automation, and digital operations.' }}</h1>
                <p class="mx-auto mt-6 max-w-2xl text-base leading-7 text-white/50 sm:text-lg">{{ $hero?->body ?: 'Practical articles on AI reception, customer journeys, websites, CRM workflows, and the systems behind modern service businesses.' }}</p>
            </div>
        </div>
    </section>

    <section class="px-4 pb-24 sm:px-6 sm:pb-32">
        <div class="mx-auto max-w-7xl">
            @if($posts->count())
                <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                    @foreach($posts as $post)
                        <article class="group overflow-hidden rounded-2xl border border-white/10 bg-white/[0.025] transition duration-300 hover:-translate-y-1 hover:border-neutron-300/25 hover:bg-white/[0.04]">
                            <a href="{{ route('blog.show', $post->slug) }}" class="block">
                                @if(($post->featured_media_type === 'animation' && $post->featured_animation_html_url) || $post->featured_image)
                                    <div class="aspect-[16/9] overflow-hidden border-b border-white/10 bg-neutron-900">
                                        @include('site.partials.cms-visual',[
                                            'mediaType'=>$post->featured_media_type ?: 'image',
                                            'imageUrl'=>$post->featured_image,
                                            'animationUrl'=>$post->featured_animation_html_url,
                                            'alt'=>$post->featured_image_alt ?: $post->title,
                                            'imageClass'=>'h-full w-full object-cover transition duration-500 group-hover:scale-[1.03]',
                                            'animationClass'=>'pointer-events-none h-full w-full border-0',
                                        ])
                                    </div>
                                @else
                                    <div class="flex aspect-[16/9] items-center justify-center border-b border-white/10 bg-[radial-gradient(circle_at_50%_35%,rgba(47,143,255,.22),transparent_45%),linear-gradient(135deg,rgba(10,37,64,.75),rgba(3,12,24,.96))]">
                                        <svg class="h-10 w-10 text-neutron-300/60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 4h14v16H5zM8 8h8M8 12h8M8 16h5"/></svg>
                                    </div>
                                @endif

                                <div class="p-6">
                                    <div class="flex flex-wrap items-center gap-x-3 gap-y-2 font-mono text-[10px] uppercase tracking-[0.13em] text-white/30">
                                        <span>{{ ($post->published_at ?? $post->created_at)->format('M j, Y') }}</span>
                                        @if($post->author_name)<span>• {{ $post->author_name }}</span>@endif
                                    </div>
                                    <h2 class="mt-4 text-xl font-medium leading-snug tracking-tight text-white transition group-hover:text-neutron-200">{{ $post->title }}</h2>
                                    @if($post->excerpt)
                                        <p class="mt-3 line-clamp-3 text-sm leading-6 text-white/45">{{ $post->excerpt }}</p>
                                    @endif
                                    <span class="mt-5 inline-flex items-center gap-2 font-mono text-[10px] font-semibold uppercase tracking-wider text-neutron-300">Read article <span class="transition group-hover:translate-x-1">→</span></span>
                                </div>
                            </a>
                        </article>
                    @endforeach
                </div>

                @if($posts->hasPages())
                    <div class="mt-10 rounded-xl border border-white/10 bg-white/[0.02] p-4">{{ $posts->links() }}</div>
                @endif
            @else
                <div class="rounded-2xl border border-white/10 bg-white/[0.025] px-6 py-16 text-center">
                    <p class="neutron-kicker">Blog</p>
                    <h2 class="mt-3 text-2xl font-medium text-white">Articles are coming soon.</h2>
                    <p class="mt-3 text-sm text-white/40">New posts can be created and published from the admin panel.</p>
                </div>
            @endif
        </div>
    </section>
    @include('site.sections.custom-page-sections',['page'=>$page,'settings'=>$settings])
</x-site-layout>
