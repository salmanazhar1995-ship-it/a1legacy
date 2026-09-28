<x-site-layout :page="$page" :navigation-pages="$navigationPages" :settings="$settings" :document-title="$gallery->seo_title ?: $gallery->title" :document-description="$gallery->meta_description ?: $gallery->excerpt" :document-keywords="$gallery->meta_keywords" :document-image="$gallery->image_url" :document-image-alt="$gallery->image_alt ?: $gallery->title">
    <section class="px-4 pb-24 pt-36 sm:px-6 sm:pt-40">
        <div class="mx-auto max-w-6xl">
            <a href="{{route('gallery.index')}}" class="text-sm text-white/40">← Back to Gallery</a>
            <div class="a1-page-heading mt-8">
                <p class="neutron-kicker">{{$gallery->eyebrow?:$gallery->category}}</p>
                <h1 class="mt-4 text-4xl font-semibold text-white sm:text-6xl">{{$gallery->title}}</h1>
                <p class="mx-auto mt-5 max-w-2xl text-lg leading-7 text-white/55">{{$gallery->excerpt}}</p>
            </div>
            <div class="mt-10 grid gap-10 lg:grid-cols-[1.2fr_.8fr] lg:items-start">
                <div class="overflow-hidden rounded-2xl border border-white/10 bg-[#07111d]" style="aspect-ratio: 16 / 11">
                    @if(($gallery->media_type === 'animation' && $gallery->animation_html_url) || $gallery->image_url)
                        @include('site.partials.cms-visual',[
                            'mediaType'=>$gallery->media_type ?: 'image',
                            'imageUrl'=>$gallery->image_url,
                            'animationUrl'=>$gallery->animation_html_url,
                            'alt'=>$gallery->image_alt ?: $gallery->title,
                            'imageClass'=>'h-full w-full object-cover',
                            'animationClass'=>'pointer-events-none h-full w-full border-0',
                        ])
                    @else
                        <div class="neutron-panel h-full w-full"></div>
                    @endif
                </div>
                <div>
                    @if($gallery->description)<div class="prose-a1 text-sm leading-7 text-white/48">{!! \App\Support\RichText::render($gallery->description) !!}</div>@endif
                    @if($gallery->client)<p class="mt-6 text-sm text-white/45">Client: <span class="text-white/70">{{$gallery->client}}</span></p>@endif
                    @if(collect($gallery->tags)->filter()->isNotEmpty())<div class="mt-6 flex flex-wrap gap-2">@foreach($gallery->tags as $tag)<span class="rounded-full border border-white/10 px-3 py-1 text-xs text-white/45">{{$tag}}</span>@endforeach</div>@endif
                </div>
            </div>
        </div>
    </section>
</x-site-layout>
