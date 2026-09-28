@php
    $mediaType = $mediaType ?? 'image';
    $imageUrl = $imageUrl ?? null;
    $animationUrl = $animationUrl ?? null;
    $alt = $alt ?? '';
    $imageClass = $imageClass ?? 'h-full w-full object-cover';
    $animationClass = $animationClass ?? 'pointer-events-none h-full w-full border-0';
    $loading = $loading ?? 'lazy';
    $showAnimation = $mediaType === 'animation' && filled($animationUrl);
@endphp

@if($showAnimation)
    <iframe
        src="{{ $animationUrl }}"
        title="{{ $alt !== '' ? $alt.' animation' : 'Animated visual' }}"
        class="{{ $animationClass }}"
        sandbox="allow-scripts"
        loading="{{ $loading }}"
        referrerpolicy="no-referrer"
        tabindex="-1"
        aria-hidden="true"
    ></iframe>
@elseif($imageUrl)
    <img src="{{ $imageUrl }}" alt="{{ $alt }}" loading="{{ $loading }}" class="{{ $imageClass }}">
@endif
