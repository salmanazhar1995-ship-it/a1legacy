@php
    $settings=$section->settings??[];
    $image=data_get($settings,'image');
    $mediaType=data_get($settings,'media_type','image');
    $animation=data_get($settings,'animation_html');
    $hasVisual=($mediaType === 'animation' && filled($animation)) || filled($image);
    $layout=data_get($settings,'layout','image_right');
@endphp
<section id="{{ $section->key }}" class="px-4 py-20 sm:px-6">
    <div class="mx-auto max-w-7xl">
        <div class="a1-section-heading">
            @if($section->eyebrow)<p class="neutron-kicker">{{ $section->eyebrow }}</p>@endif
            @if($section->heading)<h2 class="mt-4 text-3xl font-medium tracking-[-0.04em] text-white sm:text-5xl">{{ $section->heading }}</h2>@endif
        </div>

        <div class="mt-10 grid gap-8 lg:grid-cols-2 lg:items-center">
            <div @class(['lg:order-2'=>$layout==='image_left'])>
                @if($section->body)<div class="prose-a1 text-base leading-8 text-white/55">{!! \App\Support\RichText::render($section->body) !!}</div>@endif
                @if($section->button_label || $section->secondary_button_label)
                    <div class="mt-8 flex flex-wrap gap-3">
                        @if($section->button_label)<a href="{{ $section->button_url ?: '#' }}" class="rounded-xl bg-neutron-300 px-6 py-3.5 text-sm font-semibold text-neutron-950">{{ $section->button_label }}</a>@endif
                        @if($section->secondary_button_label)<a href="{{ $section->secondary_button_url ?: '#' }}" class="rounded-xl border border-white/10 px-6 py-3.5 text-sm text-white/70">{{ $section->secondary_button_label }}</a>@endif
                    </div>
                @endif
            </div>
            <div @class(['lg:order-1'=>$layout==='image_left'])>
                <div class="neutron-panel aspect-[4/3] overflow-hidden rounded-3xl">
                    @if($hasVisual)
                        @include('site.partials.cms-visual', [
                            'mediaType' => $mediaType,
                            'imageUrl' => $image,
                            'animationUrl' => $animation,
                            'alt' => data_get($section->settings, 'image_alt') ?: ($section->heading ?: 'Section visual'),
                            'imageClass' => 'h-full w-full object-cover',
                            'animationClass' => 'pointer-events-none h-full w-full border-0',
                        ])
                    @else
                        <div class="h-full w-full bg-[radial-gradient(circle_at_center,rgba(47,143,255,.18),transparent_62%)]"></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
