<section class="px-4 py-24 sm:px-6">
    <div class="mx-auto max-w-7xl">
        <div class="a1-section-heading">
            @if ($section->eyebrow)<p class="neutron-kicker">{{ $section->eyebrow }}</p>@endif
            @if ($section->heading)<h2 class="mt-4 text-4xl font-medium tracking-[-0.05em] sm:text-6xl">{{ $section->heading }}</h2>@endif
        </div>

        <div class="mt-12 grid gap-4 lg:grid-cols-3">
            @foreach ($section->items as $item)
                @php
                    $itemMediaType=data_get($item->settings,'media_type','image');
                    $itemAnimation=data_get($item->settings,'animation_html');
                    $hasItemVisual=($itemMediaType==='animation' && filled($itemAnimation)) || filled($item->image_url);
                @endphp
                <blockquote class="neutron-panel flex min-h-80 flex-col justify-between rounded-2xl p-7">
                    <p class="text-lg leading-8 text-white/75">“{{ $item->description }}”</p>
                    <footer class="mt-8 flex items-center gap-4">
                        @if ($hasItemVisual)
                            <div class="h-12 w-12 shrink-0 overflow-hidden rounded-full border border-white/10 bg-neutron-950">
                                @include('site.partials.cms-visual',['mediaType'=>$itemMediaType,'imageUrl'=>$item->image_url,'animationUrl'=>$itemAnimation,'alt'=>data_get($item->settings, 'image_alt') ?: $item->title,'imageClass'=>'h-full w-full object-cover','animationClass'=>'pointer-events-none h-full w-full border-0'])
                            </div>
                        @endif
                        <div>
                            <p class="font-medium">{{ $item->title }}</p>
                            <p class="mt-1 text-sm text-white/35">{{ $item->subtitle }}</p>
                        </div>
                    </footer>
                </blockquote>
            @endforeach
        </div>
    </div>
</section>
