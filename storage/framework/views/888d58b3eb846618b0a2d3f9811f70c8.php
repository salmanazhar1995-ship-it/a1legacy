<?php
    $settings=$section->settings??[];
    $image=data_get($settings,'image');
    $mediaType=data_get($settings,'media_type','image');
    $animation=data_get($settings,'animation_html');
    $hasVisual=($mediaType === 'animation' && filled($animation)) || filled($image);
    $layout=data_get($settings,'layout','image_right');
?>
<section id="<?php echo e($section->key); ?>" class="px-4 py-20 sm:px-6">
    <div class="mx-auto max-w-7xl">
        <div class="a1-section-heading">
            <?php if($section->eyebrow): ?><p class="neutron-kicker"><?php echo e($section->eyebrow); ?></p><?php endif; ?>
            <?php if($section->heading): ?><h2 class="mt-4 text-3xl font-medium tracking-[-0.04em] text-white sm:text-5xl"><?php echo e($section->heading); ?></h2><?php endif; ?>
        </div>

        <div class="mt-10 grid gap-8 lg:grid-cols-2 lg:items-center">
            <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['lg:order-2'=>$layout==='image_left']); ?>">
                <?php if($section->body): ?><div class="prose-a1 text-base leading-8 text-white/55"><?php echo \App\Support\RichText::render($section->body); ?></div><?php endif; ?>
                <?php if($section->button_label || $section->secondary_button_label): ?>
                    <div class="mt-8 flex flex-wrap gap-3">
                        <?php if($section->button_label): ?><a href="<?php echo e($section->button_url ?: '#'); ?>" class="rounded-xl bg-neutron-300 px-6 py-3.5 text-sm font-semibold text-neutron-950"><?php echo e($section->button_label); ?></a><?php endif; ?>
                        <?php if($section->secondary_button_label): ?><a href="<?php echo e($section->secondary_button_url ?: '#'); ?>" class="rounded-xl border border-white/10 px-6 py-3.5 text-sm text-white/70"><?php echo e($section->secondary_button_label); ?></a><?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
            <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['lg:order-1'=>$layout==='image_left']); ?>">
                <div class="neutron-panel aspect-[4/3] overflow-hidden rounded-3xl">
                    <?php if($hasVisual): ?>
                        <?php echo $__env->make('site.partials.cms-visual', [
                            'mediaType' => $mediaType,
                            'imageUrl' => $image,
                            'animationUrl' => $animation,
                            'alt' => data_get($section->settings, 'image_alt') ?: ($section->heading ?: 'Section visual'),
                            'imageClass' => 'h-full w-full object-cover',
                            'animationClass' => 'pointer-events-none h-full w-full border-0',
                        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php else: ?>
                        <div class="h-full w-full bg-[radial-gradient(circle_at_center,rgba(47,143,255,.18),transparent_62%)]"></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\site\sections\split-content.blade.php ENDPATH**/ ?>