@php
    $url = trim((string) ($story->video_url ?? ''));
    $posterMediaType = $story->poster_media_type ?: 'image';
    $posterImage = $story->poster_image_url ?: null;
    $posterAnimation = $story->poster_animation_html_url ?: null;
    $posterAlt = $story->poster_image_alt ?: ($story->person_name.' client story cover');
    $hasPosterVisual = ($posterMediaType === 'animation' && filled($posterAnimation)) || filled($posterImage);

    $embed = null;
    $direct = $url !== '' && (
        str_starts_with($url, '/media/') ||
        str_starts_with($url, '/storage/') ||
        preg_match('/\.(?:mp4|webm)(?:\?|$)/i', $url)
    );

    if ($url !== '' && ! $direct) {
        $parts = parse_url($url);
        $host = strtolower((string) ($parts['host'] ?? ''));
        $path = trim((string) ($parts['path'] ?? ''), '/');
        parse_str((string) ($parts['query'] ?? ''), $query);

        if (str_contains($host, 'youtube.com')) {
            $id = $query['v'] ?? null;
            if (! $id && str_starts_with($path, 'shorts/')) {
                $id = explode('/', $path)[1] ?? null;
            }
            if ($id) {
                $embed = 'https://www.youtube-nocookie.com/embed/'.rawurlencode((string) $id);
            }
        } elseif ($host === 'youtu.be' || str_ends_with($host, '.youtu.be')) {
            $id = explode('/', $path)[0] ?? null;
            if ($id) {
                $embed = 'https://www.youtube-nocookie.com/embed/'.rawurlencode((string) $id);
            }
        } elseif (str_contains($host, 'vimeo.com')) {
            $segments = array_values(array_filter(explode('/', $path)));
            $id = collect($segments)->first(fn ($segment) => ctype_digit((string) $segment));
            if ($id) {
                $embed = 'https://player.vimeo.com/video/'.$id;
            }
        }
    }
@endphp

<div x-data="{ cover: {{ $hasPosterVisual ? 'true' : 'false' }} }" class="relative overflow-hidden rounded-xl border border-white/10 bg-black" style="aspect-ratio:16/9">
    @if($embed)
        <iframe src="{{ $embed }}" title="{{ $story->person_name }} client story" class="h-full w-full" loading="lazy" allow="autoplay; encrypted-media; picture-in-picture" allowfullscreen></iframe>
    @elseif($direct)
        <video x-ref="playerVideo" class="h-full w-full object-cover" controls preload="metadata" @if($posterMediaType === 'image' && $posterImage) poster="{{ $posterImage }}" @endif>
            <source src="{{ $url }}">
        </video>
    @elseif($url !== '')
        <a href="{{ $url }}" target="_blank" rel="noopener" class="flex h-full items-center justify-center text-neutron-200">Open approved client video ↗</a>
    @else
        <div class="flex h-full items-center justify-center text-white/30">Video unavailable</div>
    @endif

    @if($hasPosterVisual)
        <div x-show="cover" x-transition.opacity class="absolute inset-0 z-10 bg-neutron-950">
            @include('site.partials.cms-visual', [
                'mediaType' => $posterMediaType,
                'imageUrl' => $posterImage,
                'animationUrl' => $posterAnimation,
                'alt' => $posterAlt,
                'imageClass' => 'h-full w-full object-cover',
                'animationClass' => 'pointer-events-none h-full w-full border-0',
                'loading' => 'lazy',
            ])
            <div class="absolute inset-0 flex items-center justify-center bg-black/20">
                <button type="button" @click="cover=false; $nextTick(() => { if ($refs.playerVideo) $refs.playerVideo.play().catch(() => {}) })" class="rounded-full border border-white/20 bg-neutron-950/80 px-5 py-3 font-mono text-[10px] font-semibold uppercase tracking-[.14em] text-white shadow-xl backdrop-blur">
                    Play client story
                </button>
            </div>
        </div>
    @endif
</div>
