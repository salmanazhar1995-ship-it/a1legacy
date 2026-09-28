@php
    $heroSectionSettings = $section->settings ?? [];
    $heroMediaType = data_get($heroSectionSettings, 'media_type', 'image');
    $heroImage = data_get($heroSectionSettings, 'image');
    $heroAnimation = data_get($heroSectionSettings, 'animation_html');
    $hasHeroSectionVisual = ($heroMediaType === 'animation' && filled($heroAnimation)) || filled($heroImage);

    $homeBackgroundType = $settings->get('home_hero_background_image__media_type', 'image');
    $homeBackgroundImage = $settings->get('home_hero_background_image');
    $homeBackgroundAnimation = $settings->get('home_hero_background_image__animation_html_url');
    $homeBackgroundAlt = $settings->get('home_hero_background_image__image_alt') ?: 'A1 Legacy Labs hero background';
    $hasHomeBackground = ($homeBackgroundType === 'animation' && filled($homeBackgroundAnimation)) || filled($homeBackgroundImage);

    $homeDashboardType = $settings->get('home_dashboard_image__media_type', 'image');
    $homeDashboardImage = $settings->get('home_dashboard_image');
    $homeDashboardAnimation = $settings->get('home_dashboard_image__animation_html_url');
    $homeDashboardAlt = $settings->get('home_dashboard_image__image_alt') ?: 'A1 Legacy Labs operations dashboard';
    $hasHomeDashboard = ($homeDashboardType === 'animation' && filled($homeDashboardAnimation)) || filled($homeDashboardImage);
@endphp
<section id="{{ $section->key }}" @class(['relative px-4 sm:px-6', 'min-h-[820px] pt-44 pb-28' => $isHome, 'pt-44 pb-24' => ! $isHome])>
    @if ($isHome && $hasHomeBackground)
        <div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">
            @include('site.partials.cms-visual', [
                'mediaType' => $homeBackgroundType,
                'imageUrl' => $homeBackgroundImage,
                'animationUrl' => $homeBackgroundAnimation,
                'alt' => $homeBackgroundAlt,
                'imageClass' => 'h-full w-full object-cover opacity-35 [mask-image:linear-gradient(to_bottom,black_15%,transparent_88%)]',
                'animationClass' => 'pointer-events-none h-full w-full border-0 opacity-35 [mask-image:linear-gradient(to_bottom,black_15%,transparent_88%)]',
                'loading' => 'eager',
            ])
        </div>
    @endif
    <div class="pointer-events-none absolute left-1/2 top-0 h-[720px] w-[1000px] -translate-x-1/2 rounded-full bg-neutron-500/15 blur-[160px]"></div>
    <div class="relative mx-auto max-w-7xl">
        <div class="a1-page-heading mx-auto max-w-5xl text-center">
            @if ($section->eyebrow)<p class="neutron-kicker">{{ $section->eyebrow }}</p>@endif
            @if ($section->heading)<h1 class="mt-5 text-5xl font-medium leading-[0.98] tracking-[-0.06em] text-white sm:text-7xl lg:text-[92px]">{{ $section->heading }}</h1>@endif
            @if ($section->body)<div class="prose-a1 mx-auto mt-7 max-w-2xl text-base leading-7 text-white/50 sm:text-lg">{!! \App\Support\RichText::render($section->body) !!}</div>@endif
            @if ($section->button_label || $section->secondary_button_label)
                <div class="mt-9 flex flex-wrap justify-center gap-3">
                    @if ($section->button_label)<a href="{{ $section->button_url ?: '#' }}" class="rounded-xl bg-neutron-300 px-6 py-3.5 font-mono text-xs font-semibold uppercase tracking-wider text-neutron-950 shadow-glow transition hover:bg-white">{{ $section->button_label }}</a>@endif
                    @if ($section->secondary_button_label)<a href="{{ $section->secondary_button_url ?: '#' }}" class="rounded-xl border border-white/10 bg-white/[0.04] px-6 py-3.5 font-mono text-xs font-semibold uppercase tracking-wider text-white/75 transition hover:bg-white/10 hover:text-white">{{ $section->secondary_button_label }}</a>@endif
                </div>
            @endif
        </div>

        @if ($hasHeroSectionVisual || ($isHome && $hasHomeDashboard))
            <div class="relative mx-auto mt-16 max-w-6xl overflow-hidden rounded-2xl border border-neutron-300/20 bg-neutron-950/90 shadow-[0_30px_100px_rgba(0,93,255,0.25)] sm:rounded-3xl">
                <div class="relative p-1.5 sm:p-2.5">
                    <div class="pointer-events-none absolute inset-x-1/4 top-0 h-24 bg-neutron-300/20 blur-3xl"></div>
                    <div class="relative aspect-video overflow-hidden rounded-xl sm:rounded-2xl">
                        @if($hasHeroSectionVisual)
                            @include('site.partials.cms-visual',[
                                'mediaType'=>$heroMediaType,
                                'imageUrl'=>$heroImage,
                                'animationUrl'=>$heroAnimation,
                                'alt'=>data_get($section->settings, 'image_alt') ?: ($section->heading ?: 'Hero visual'),
                                'imageClass'=>'h-full w-full object-cover object-top',
                                'animationClass'=>'pointer-events-none h-full w-full border-0',
                                'loading'=>'eager',
                            ])
                        @else
                            @include('site.partials.cms-visual', [
                                'mediaType' => $homeDashboardType,
                                'imageUrl' => $homeDashboardImage,
                                'animationUrl' => $homeDashboardAnimation,
                                'alt' => $homeDashboardAlt,
                                'imageClass' => 'h-full w-full object-cover object-top',
                                'animationClass' => 'pointer-events-none h-full w-full border-0',
                                'loading' => 'eager',
                            ])
                        @endif
                    </div>
                </div>
                @if($isHome) @include('site.partials.platform-strip', ['platforms' => $platforms ?? collect()]) @endif
            </div>
        @endif
    </div>
</section>
