@php $columns=max(1,min(4,(int)data_get($section->settings,'columns',3))); @endphp
<section id="{{ $section->key }}" class="px-4 py-20 sm:px-6">
    <div class="mx-auto max-w-7xl">
        <div class="a1-section-heading">
            @if($section->eyebrow)<p class="neutron-kicker">{{ $section->eyebrow }}</p>@endif
            @if($section->heading)<h2 class="mt-4 text-3xl font-medium tracking-[-0.04em] text-white sm:text-5xl">{{ $section->heading }}</h2>@endif
            @if($section->body)<div class="prose-a1 mt-5 text-white/45">{!! \App\Support\RichText::render($section->body) !!}</div>@endif
        </div>
        <div class="mt-10 grid gap-4 sm:grid-cols-2 @if($columns>=3) lg:grid-cols-3 @endif @if($columns===4) xl:grid-cols-4 @endif">
            @foreach($section->items as $item)
                @php
                    $itemMediaType=data_get($item->settings,'media_type','image');
                    $itemAnimation=data_get($item->settings,'animation_html');
                    $hasItemVisual=($itemMediaType==='animation' && filled($itemAnimation)) || filled($item->image_url);
                @endphp
                <article class="neutron-panel overflow-hidden rounded-2xl">
                    @if($hasItemVisual)
                        <div class="aspect-video overflow-hidden bg-neutron-950">
                            @include('site.partials.cms-visual',['mediaType'=>$itemMediaType,'imageUrl'=>$item->image_url,'animationUrl'=>$itemAnimation,'alt'=>data_get($item->settings, 'image_alt') ?: $item->title,'imageClass'=>'h-full w-full object-cover','animationClass'=>'pointer-events-none h-full w-full border-0'])
                        </div>
                    @endif
                    <div class="p-6">
                        @if($item->badge)<span class="rounded-full border border-white/10 px-2 py-1 font-mono text-[9px] uppercase text-neutron-300">{{ $item->badge }}</span>@endif
                        <h3 class="mt-4 text-xl font-medium text-white">{{ $item->title }}</h3>
                        @if($item->description)<div class="prose-a1 mt-3 text-sm leading-7 text-white/45">{!! \App\Support\RichText::render($item->description) !!}</div>@endif
                        @if($item->link_label)<a href="{{ $item->link_url ?: '#' }}" class="mt-5 inline-flex text-sm text-neutron-200">{{ $item->link_label }} →</a>@endif
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
