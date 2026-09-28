<section id="{{ $section->key }}" class="px-4 py-20 sm:px-6">
    <div class="mx-auto max-w-7xl">
        <div class="a1-section-heading">
            @if($section->eyebrow)<p class="neutron-kicker">{{ $section->eyebrow }}</p>@endif
            @if($section->heading)<h2 class="mt-4 text-3xl font-medium text-white sm:text-5xl">{{ $section->heading }}</h2>@endif
        </div>
        <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($section->items as $item)
                @php
                    $itemMediaType=data_get($item->settings,'media_type','image');
                    $itemAnimation=data_get($item->settings,'animation_html');
                    $hasItemVisual=($itemMediaType==='animation' && filled($itemAnimation)) || filled($item->image_url);
                @endphp
                <a href="{{ $item->link_url ?: '#' }}" class="group neutron-panel overflow-hidden rounded-2xl">
                    @if($hasItemVisual)
                        <div class="aspect-[4/3] overflow-hidden bg-neutron-950">
                            @include('site.partials.cms-visual',['mediaType'=>$itemMediaType,'imageUrl'=>$item->image_url,'animationUrl'=>$itemAnimation,'alt'=>data_get($item->settings, 'image_alt') ?: $item->title,'imageClass'=>'h-full w-full object-cover transition duration-500 group-hover:scale-[1.02]','animationClass'=>'pointer-events-none h-full w-full border-0'])
                        </div>
                    @endif
                    <div class="p-5">
                        <h3 class="font-medium text-white">{{ $item->title }}</h3>
                        @if($item->subtitle)<p class="mt-1 text-xs text-white/35">{{ $item->subtitle }}</p>@endif
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</section>
