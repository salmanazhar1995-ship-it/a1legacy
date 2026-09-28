<?php
    $settings = $section->settings ?? [];
    $align = data_get($settings,'alignment','left');
    $theme = data_get($settings,'theme','default');
    $image = data_get($settings,'image');
    $mediaType = data_get($settings,'media_type','image');
    $animation = data_get($settings,'animation_html');
    $hasVisual = ($mediaType === 'animation' && filled($animation)) || filled($image);
    $background = data_get($settings,'background_image');
    $backgroundMediaType = data_get($settings,'background_media_type','image');
    $backgroundAnimation = data_get($settings,'background_animation_html');
    $backgroundAlt = data_get($settings,'background_image_alt') ?: ($section->heading ?: 'Section background');
    $hasBackground = ($backgroundMediaType === 'animation' && filled($backgroundAnimation)) || filled($background);
?>
<section id="<?php echo e($section->key); ?>" class="relative overflow-hidden px-4 py-20 sm:px-6">
    <?php if($hasBackground): ?>
        <div class="pointer-events-none absolute inset-0" aria-hidden="true">
            <?php echo $__env->make('site.partials.cms-visual', [
                'mediaType' => $backgroundMediaType,
                'imageUrl' => $background,
                'animationUrl' => $backgroundAnimation,
                'alt' => $backgroundAlt,
                'imageClass' => 'h-full w-full object-cover',
                'animationClass' => 'pointer-events-none h-full w-full border-0',
            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
            <div class="absolute inset-0 bg-[linear-gradient(rgba(2,6,11,.78),rgba(2,6,11,.92))]"></div>
        </div>
    <?php endif; ?>
    <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['relative z-10 mx-auto max-w-7xl rounded-3xl p-6 sm:p-10','neutron-panel'=>$theme==='panel','border border-neutron-300/20 bg-neutron-500/[0.07]'=>$theme==='accent','bg-white/[0.015]'=>$theme==='subtle']); ?>">
        <div class="a1-section-heading mx-auto max-w-4xl text-center">
            <?php if($section->eyebrow): ?><p class="neutron-kicker"><?php echo e($section->eyebrow); ?></p><?php endif; ?>
            <?php if($section->heading): ?><h2 class="mt-4 text-3xl font-medium tracking-[-0.04em] text-white sm:text-5xl"><?php echo e($section->heading); ?></h2><?php endif; ?>
            <?php if($section->body): ?><div class="prose-a1 mt-6 text-base leading-8 text-white/55"><?php echo \App\Support\RichText::render($section->body); ?></div><?php endif; ?>
            <?php if($hasVisual): ?>
                <div class="mt-8 aspect-video overflow-hidden rounded-2xl border border-white/10 bg-neutron-950">
                    <?php echo $__env->make('site.partials.cms-visual', [
                        'mediaType' => $mediaType,
                        'imageUrl' => $image,
                        'animationUrl' => $animation,
                        'alt' => data_get($section->settings, 'image_alt') ?: ($section->heading ?: 'Section visual'),
                        'imageClass' => 'h-full w-full object-cover',
                        'animationClass' => 'pointer-events-none h-full w-full border-0',
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            <?php endif; ?>
            <?php if($section->button_label || $section->secondary_button_label): ?>
                <div class="mt-8 flex flex-wrap justify-center gap-3">
                    <?php if($section->button_label): ?><a href="<?php echo e($section->button_url ?: '#'); ?>" class="rounded-xl bg-neutron-300 px-6 py-3.5 font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-neutron-950"><?php echo e($section->button_label); ?></a><?php endif; ?>
                    <?php if($section->secondary_button_label): ?><a href="<?php echo e($section->secondary_button_url ?: '#'); ?>" class="rounded-xl border border-white/10 px-6 py-3.5 font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-white/70"><?php echo e($section->secondary_button_label); ?></a><?php endif; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
<?php /**PATH /home/u668568382/domains/a1legacylabs.com/laravel_app/resources/views/site/sections/standard-content.blade.php ENDPATH**/ ?>