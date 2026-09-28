@php
    $settingKey = $settingKey ?? '';
    $fallbackAlt = $fallbackAlt ?? '';
    $mediaType = $settings->get($settingKey.'__media_type', 'image');
    $imageUrl = $settings->get($settingKey);
    $animationUrl = $settings->get($settingKey.'__animation_html_url');
    $alt = $settings->get($settingKey.'__image_alt') ?: $fallbackAlt;
@endphp
@include('site.partials.cms-visual', [
    'mediaType' => $mediaType,
    'imageUrl' => $imageUrl,
    'animationUrl' => $animationUrl,
    'alt' => $alt,
    'imageClass' => $imageClass ?? 'h-full w-full object-contain',
    'animationClass' => $animationClass ?? 'pointer-events-none h-full w-full border-0',
    'loading' => $loading ?? 'lazy',
])
