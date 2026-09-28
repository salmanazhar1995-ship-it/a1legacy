<?php
    $htmlUrl = data_get($section->settings, 'section_html');
    $minHeight = max(100, min(5000, (int) data_get($section->settings, 'html_min_height', 320)));
?>
<?php if($htmlUrl): ?>
<section id="<?php echo e($section->key); ?>" class="w-full overflow-hidden" data-a1-html-section>
    <iframe
        src="<?php echo e($htmlUrl); ?>"
        title="<?php echo e($section->heading ?: 'Custom HTML section'); ?>"
        class="block w-full border-0 bg-transparent"
        style="min-height: <?php echo e($minHeight); ?>px; height: <?php echo e($minHeight); ?>px;"
        sandbox="allow-scripts allow-forms allow-popups"
        loading="lazy"
        referrerpolicy="no-referrer"
        data-a1-html-section-frame
    ></iframe>
</section>
<?php if (! $__env->hasRenderedOnce('953cf319-beaa-46ab-a62c-bc5fcead6e48')): $__env->markAsRenderedOnce('953cf319-beaa-46ab-a62c-bc5fcead6e48'); ?>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var frames = Array.from(document.querySelectorAll('[data-a1-html-section-frame]'));
    window.addEventListener('message', function (event) {
        if (!event.data || event.data.type !== 'a1-html-section-height') return;
        var frame = frames.find(function (candidate) { return candidate.contentWindow === event.source; });
        if (!frame) return;
        var height = Number(event.data.height);
        if (!Number.isFinite(height)) return;
        height = Math.max(100, Math.min(12000, Math.ceil(height)));
        frame.style.height = height + 'px';
    });
});
</script>
<?php endif; ?>
<?php endif; ?>
<?php /**PATH /home/u668568382/domains/a1legacylabs.com/laravel_app/resources/views/site/sections/html-section.blade.php ENDPATH**/ ?>