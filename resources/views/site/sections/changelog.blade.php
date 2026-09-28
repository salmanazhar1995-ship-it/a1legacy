<section class="px-4 pb-28 sm:px-6">
    <div class="mx-auto max-w-5xl border-t border-white/10">
        @foreach ($section->items as $item)
            @php
                $itemMediaType=data_get($item->settings,'media_type','image');
                $itemAnimation=data_get($item->settings,'animation_html');
                $hasItemVisual=($itemMediaType==='animation' && filled($itemAnimation)) || filled($item->image_url);
            @endphp
            <article class="grid gap-5 border-b border-white/10 py-10 sm:grid-cols-[180px_1fr]">
                <div>
                    <p class="font-mono text-[10px] uppercase tracking-wider text-white/30">{{ $item->subtitle }}</p>
                    @if ($item->badge)<span class="mt-3 inline-flex rounded-full bg-neutron-500/10 px-3 py-1 font-mono text-[9px] uppercase tracking-wider text-neutron-300">{{ $item->badge }}</span>@endif
                </div>
                <div>
                    @if ($hasItemVisual)
                        <div class="mb-7 aspect-video overflow-hidden rounded-2xl border border-white/10 bg-black">
                            @include('site.partials.cms-visual',['mediaType'=>$itemMediaType,'imageUrl'=>$item->image_url,'animationUrl'=>$itemAnimation,'alt'=>data_get($item->settings, 'image_alt') ?: $item->title,'imageClass'=>'h-full w-full object-cover object-top','animationClass'=>'pointer-events-none h-full w-full border-0'])
                        </div>
                    @endif
                    <h2 class="text-2xl font-medium">{{ $item->title }}</h2>
                    <div class="prose-a1 mt-4 leading-7 text-white/45">{!! \App\Support\RichText::render($item->description) !!}</div>
                </div>
            </article>
        @endforeach
    </div>
</section>
