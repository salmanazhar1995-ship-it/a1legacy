<?php
    $settingKey = $settingKey ?? '';
    $fallbackAlt = $fallbackAlt ?? '';
    $mediaType = $settings->get($settingKey.'__media_type', 'image');
    $imageUrl = $settings->get($settingKey);
    $animationUrl = $settings->get($settingKey.'__animation_html_url');
    $alt = $settings->get($settingKey.'__image_alt') ?: $fallbackAlt;
?>
<?php echo $__env->make('site.partials.cms-visual', [
    'mediaType' => $mediaType,
    'imageUrl' => $imageUrl,
    'animationUrl' => $animationUrl,
    'alt' => $alt,
    'imageClass' => $imageClass ?? 'h-full w-full object-contain',
    'animationClass' => $animationClass ?? 'pointer-events-none h-full w-full border-0',
    'loading' => $loading ?? 'lazy',
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php /**PATH /home/u668568382/domains/a1legacylabs.com/laravel_app/resources/views/site/partials/setting-visual.blade.php ENDPATH**/ ?>