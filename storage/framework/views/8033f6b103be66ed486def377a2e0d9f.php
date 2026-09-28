<?php
    $heroSectionSettings = $section->settings ?? [];
    $heroMediaType = data_get($heroSectionSettings, 'media_type', 'image');
    $heroImage = data_get($heroSectionSettings, 'image');
    $heroAnimation = data_get($heroSectionSettings, 'animation_html');
    $hasHeroSectionVisual = ($heroMediaType === 'animation' && filled($heroAnimation)) || filled($heroImage);
    $homeDashboardImage = $settings->get('home_dashboard_image');
?>
<section id="<?php echo e($section->key); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['relative px-4 sm:px-6', 'min-h-[820px] pt-44 pb-28' => $isHome, 'pt-44 pb-24' => ! $isHome]); ?>">
    <?php if($isHome && $settings->get('home_hero_background_image')): ?>
        <div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">
            <img src="<?php echo e($settings->get('home_hero_background_image')); ?>" alt="" class="h-full w-full object-cover opacity-35 [mask-image:linear-gradient(to_bottom,black_15%,transparent_88%)]">
        </div>
    <?php endif; ?>
    <div class="pointer-events-none absolute left-1/2 top-0 h-[720px] w-[1000px] -translate-x-1/2 rounded-full bg-neutron-500/15 blur-[160px]"></div>
    <div class="relative mx-auto max-w-7xl">
        <div class="a1-page-heading mx-auto max-w-5xl text-center">
            <?php if($section->eyebrow): ?><p class="neutron-kicker"><?php echo e($section->eyebrow); ?></p><?php endif; ?>
            <?php if($section->heading): ?><h1 class="mt-5 text-5xl font-medium leading-[0.98] tracking-[-0.06em] text-white sm:text-7xl lg:text-[92px]"><?php echo e($section->heading); ?></h1><?php endif; ?>
            <?php if($section->body): ?><div class="prose-a1 mx-auto mt-7 max-w-2xl text-base leading-7 text-white/50 sm:text-lg"><?php echo \App\Support\RichText::render($section->body); ?></div><?php endif; ?>
            <?php if($section->button_label || $section->secondary_button_label): ?>
                <div class="mt-9 flex flex-wrap justify-center gap-3">
                    <?php if($section->button_label): ?><a href="<?php echo e($section->button_url ?: '#'); ?>" class="rounded-xl bg-neutron-300 px-6 py-3.5 font-mono text-xs font-semibold uppercase tracking-wider text-neutron-950 shadow-glow transition hover:bg-white"><?php echo e($section->button_label); ?></a><?php endif; ?>
                    <?php if($section->secondary_button_label): ?><a href="<?php echo e($section->secondary_button_url ?: '#'); ?>" class="rounded-xl border border-white/10 bg-white/[0.04] px-6 py-3.5 font-mono text-xs font-semibold uppercase tracking-wider text-white/75 transition hover:bg-white/10 hover:text-white"><?php echo e($section->secondary_button_label); ?></a><?php endif; ?>
                </div>
            <?php endif; ?>
        </div>

        <?php if($hasHeroSectionVisual || ($isHome && $homeDashboardImage)): ?>
            <div class="relative mx-auto mt-16 max-w-6xl overflow-hidden rounded-2xl border border-neutron-300/20 bg-neutron-950/90 shadow-[0_30px_100px_rgba(0,93,255,0.25)] sm:rounded-3xl">
                <div class="relative p-1.5 sm:p-2.5">
                    <div class="pointer-events-none absolute inset-x-1/4 top-0 h-24 bg-neutron-300/20 blur-3xl"></div>
                    <div class="relative aspect-video overflow-hidden rounded-xl sm:rounded-2xl">
                        <?php if($hasHeroSectionVisual): ?>
                            <?php echo $__env->make('site.partials.cms-visual',[
                                'mediaType'=>$heroMediaType,
                                'imageUrl'=>$heroImage,
                                'animationUrl'=>$heroAnimation,
                                'alt'=>data_get($section->settings, 'image_alt') ?: ($section->heading ?: 'Hero visual'),
                                'imageClass'=>'h-full w-full object-cover object-top',
                                'animationClass'=>'pointer-events-none h-full w-full border-0',
                                'loading'=>'eager',
                            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php else: ?>
                            <img src="<?php echo e($homeDashboardImage); ?>" alt="A1 Legacy Labs operations dashboard" fetchpriority="high" class="h-full w-full object-cover object-top">
                        <?php endif; ?>
                    </div>
                </div>
                <?php if($isHome): ?> <?php echo $__env->make('site.partials.platform-strip', ['platforms' => $platforms ?? collect()], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\site\sections\hero.blade.php ENDPATH**/ ?>