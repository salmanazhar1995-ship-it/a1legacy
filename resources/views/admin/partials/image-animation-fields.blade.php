@php
    $mediaTypeName = $mediaTypeName ?? 'media_type';
    $imageFileName = $imageFileName ?? 'image_file';
    $imageAltName = $imageAltName ?? 'image_alt';
    $animationFileName = $animationFileName ?? 'animation_html_file';
    $removeImageName = $removeImageName ?? 'remove_image';
    $removeAnimationName = $removeAnimationName ?? 'remove_animation';
    $mediaTypeOldKey = $mediaTypeOldKey ?? $mediaTypeName;
    $imageAltOldKey = $imageAltOldKey ?? $imageAltName;
    $imageErrorKey = $imageErrorKey ?? $imageFileName;
    $imageAltErrorKey = $imageAltErrorKey ?? $imageAltName;
    $animationErrorKey = $animationErrorKey ?? $animationFileName;
    $currentMediaType = old($mediaTypeOldKey, $currentMediaType ?? 'image');
    $currentImage = $currentImage ?? null;
    $currentImageAlt = old($imageAltOldKey, $currentImageAlt ?? '');
    $currentAnimation = $currentAnimation ?? null;
    $title = $title ?? 'Visual media';
    $help = $help ?? 'Choose either a normal image or a self-contained HTML animation for this visual.';
    $idBase = preg_replace('/[^a-z0-9_-]+/i', '-', $mediaTypeName.'-'.$imageFileName);
@endphp

<div class="rounded-2xl border border-white/10 bg-white/[0.025] p-5" data-visual-media-picker data-has-current-image="{{ $currentImage ? '1' : '0' }}" data-has-current-animation="{{ $currentAnimation ? '1' : '0' }}">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <p class="neutron-kicker">Media</p>
            <h3 class="mt-2 text-lg font-medium text-white">{{ $title }}</h3>
            <p class="mt-2 max-w-2xl text-xs leading-5 text-white/35">{{ $help }}</p>
        </div>
        <div class="inline-flex rounded-xl border border-white/10 bg-black/20 p-1" role="group" aria-label="Visual media type">
            <label class="cursor-pointer rounded-lg px-3 py-2 text-xs text-white/60 transition has-[:checked]:bg-neutron-300 has-[:checked]:font-semibold has-[:checked]:text-neutron-950">
                <input type="radio" name="{{ $mediaTypeName }}" value="image" class="sr-only" @checked($currentMediaType !== 'animation') data-media-type-radio>
                Image
            </label>
            <label class="cursor-pointer rounded-lg px-3 py-2 text-xs text-white/60 transition has-[:checked]:bg-neutron-300 has-[:checked]:font-semibold has-[:checked]:text-neutron-950">
                <input type="radio" name="{{ $mediaTypeName }}" value="animation" class="sr-only" @checked($currentMediaType === 'animation') data-media-type-radio>
                HTML animation
            </label>
        </div>
    </div>

    <div class="mt-5 grid gap-5 lg:grid-cols-2">
        <div class="rounded-xl border border-white/10 bg-black/10 p-4" data-media-panel="image">
            <x-input-label :for="$idBase.'-image'" value="Upload image" />
            @if($currentImage)
                <div class="mt-3 flex min-h-32 items-center justify-center overflow-hidden rounded-xl border border-white/10 bg-black/20 p-3">
                    <img src="{{ $currentImage }}" alt="{{ $currentImageAlt ?: 'Current uploaded image' }}" class="max-h-64 w-auto max-w-full object-contain">
                </div>
                <label class="mt-3 flex items-center gap-2 text-xs text-red-200/80">
                    <input type="checkbox" name="{{ $removeImageName }}" value="1" class="rounded border-white/15 bg-white/5 text-red-400">
                    Remove current image
                </label>
            @endif
            <input id="{{ $idBase }}-image" name="{{ $imageFileName }}" type="file" accept="image/jpeg,image/png,image/webp,image/avif" class="mt-3 block w-full" data-media-image-input>
            <p class="mt-2 text-xs text-white/35">JPG, PNG, WebP or AVIF. Maximum 5 MB.</p>
            <x-input-error class="mt-2" :messages="$errors->get($imageErrorKey)" />

            <div class="mt-4 rounded-xl border border-neutron-300/15 bg-neutron-500/[0.05] p-3.5">
                <x-input-label :for="$idBase.'-alt'" value="Image ALT text (required for SEO)" />
                <x-text-input id="{{ $idBase }}-alt" name="{{ $imageAltName }}" class="mt-2 block w-full" :value="$currentImageAlt" maxlength="255" placeholder="Describe the image clearly for search engines and screen readers" data-media-image-alt />
                <p class="mt-2 text-xs leading-5 text-white/35">Required whenever an image is used. Keep it natural, specific and descriptive; do not keyword-stuff.</p>
                <x-input-error class="mt-2" :messages="$errors->get($imageAltErrorKey)" />
            </div>
        </div>

        <div class="rounded-xl border border-white/10 bg-black/10 p-4" data-media-panel="animation">
            <x-input-label :for="$idBase.'-animation'" value="Upload HTML animation (required when HTML animation is selected)" />
            @if($currentAnimation)
                <div class="mt-3 overflow-hidden rounded-xl border border-white/10 bg-neutron-950">
                    <iframe src="{{ $currentAnimation }}" title="Current HTML animation preview" class="pointer-events-none aspect-video w-full border-0" sandbox="allow-scripts" loading="lazy" referrerpolicy="no-referrer"></iframe>
                </div>
                <label class="mt-3 flex items-center gap-2 text-xs text-red-200/80">
                    <input type="checkbox" name="{{ $removeAnimationName }}" value="1" class="rounded border-white/15 bg-white/5 text-red-400">
                    Remove current animation
                </label>
            @endif
            <input id="{{ $idBase }}-animation" name="{{ $animationFileName }}" type="file" accept=".html,.htm,text/html" data-file-kind="animation-html" data-media-animation-input class="mt-3 block w-full">
            <p class="mt-2 text-xs leading-5 text-white/35">Upload a self-contained <strong>.html/.htm</strong> animation up to 5 MB. Inline CSS/JS is supported and rendered in a sandboxed iframe. TXT files are not accepted.</p>
            <x-input-error class="mt-2" :messages="$errors->get($animationErrorKey)" />
        </div>
    </div>
</div>
