@php($items=collect($galleries??[])->take(4))
@if($items->isNotEmpty())
<section class="px-4 py-20 sm:px-6 sm:py-24" id="gallery">
    <div class="mx-auto max-w-7xl">
        <div class="a1-section-heading">
            <p class="neutron-kicker">{{$section?->eyebrow?:'Selected work'}}</p>
            <h2 class="mt-4 text-3xl font-semibold tracking-tight text-white sm:text-5xl">{{$section?->heading?:'Gallery'}}</h2>
            <p class="mx-auto mt-4 max-w-2xl leading-7 text-white/50">{{$section?->body?:'A visual library of selected A1 Legacy systems and digital work.'}}</p>
            <a href="{{route('gallery.index')}}" class="mt-6 inline-flex rounded-xl border border-white/10 px-5 py-3 font-mono text-[10px] uppercase tracking-wider text-white/65">View Gallery →</a>
        </div>
        <div class="mt-10 grid gap-5 md:grid-cols-2">
            @foreach($items as $g)
                <a href="{{route('gallery.show',$g)}}" class="group neutron-panel overflow-hidden rounded-2xl">
                    <div class="overflow-hidden bg-neutron-950" style="aspect-ratio:16/9">
                        @if(($g->media_type === 'animation' && $g->animation_html_url) || $g->image_url) @include('site.partials.cms-visual',['mediaType'=>$g->media_type ?: 'image','imageUrl'=>$g->image_url,'animationUrl'=>$g->animation_html_url,'alt'=>$g->image_alt ?: $g->title,'imageClass'=>'h-full w-full object-cover transition duration-700 group-hover:scale-[1.025]','animationClass'=>'pointer-events-none h-full w-full border-0'])@else<div class="flex h-full items-center justify-center text-white/25">Add image from admin</div>@endif
                    </div>
                    <div class="p-6">
                        @if($g->category)<p class="font-mono text-[9px] uppercase tracking-wider text-neutron-300">{{$g->category}}</p>@endif
                        <h3 class="mt-3 text-xl font-semibold text-white">{{$g->title}}</h3>
                        <p class="mt-3 text-sm leading-6 text-white/45">{{$g->excerpt}}</p>
                        <span class="mt-5 inline-flex font-mono text-[10px] uppercase tracking-wider text-neutron-200">View details →</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
@endif
