<section id="<?php echo e($section->key); ?>" class="px-4 py-24 sm:px-6">
    <div class="mx-auto max-w-7xl">
        <div class="a1-section-heading">
            <?php if($section->eyebrow): ?><p class="neutron-kicker"><?php echo e($section->eyebrow); ?></p><?php endif; ?>
            <?php if($section->heading): ?><h2 class="mt-4 text-4xl font-medium tracking-[-0.05em] sm:text-6xl"><?php echo e($section->heading); ?></h2><?php endif; ?>
            <?php if($section->body): ?><div class="prose-a1 mx-auto mt-5 max-w-2xl leading-7 text-white/45"><?php echo \App\Support\RichText::render($section->body); ?></div><?php endif; ?>
        </div>
        <div class="mt-12 grid grid-cols-1 gap-4 md:grid-cols-2">
            <?php $__currentLoopData = $section->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $itemMediaType = data_get($item->settings, 'media_type', 'image');
                    $itemAnimation = data_get($item->settings, 'animation_html');
                    $hasItemVisual = ($itemMediaType === 'animation' && filled($itemAnimation)) || filled($item->image_url);
                ?>
                <article class="neutron-panel group overflow-hidden rounded-2xl transition hover:border-neutron-300/25">
                    <?php if($hasItemVisual): ?>
                        <div class="aspect-[1.55] overflow-hidden border-b border-white/[0.07] bg-neutron-950">
                            <?php echo $__env->make('site.partials.cms-visual',[
                                'mediaType'=>$itemMediaType,
                                'imageUrl'=>$item->image_url,
                                'animationUrl'=>$itemAnimation,
                                'alt'=>data_get($item->settings, 'image_alt') ?: $item->title,
                                'imageClass'=>'h-full w-full object-cover transition duration-700 group-hover:scale-[1.025]',
                                'animationClass'=>'pointer-events-none h-full w-full border-0',
                            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                    <?php endif; ?>
                    <div class="p-6 sm:p-8">
                        <div class="flex items-start justify-between gap-4">
                            <div class="flex flex-wrap items-center gap-2">
                                <?php if($item->subtitle): ?><span class="font-mono text-[10px] uppercase tracking-[0.14em] text-neutron-300"><?php echo e($item->subtitle); ?></span><?php endif; ?>
                                <?php if($item->badge): ?><span class="rounded-full border border-white/10 bg-white/5 px-2 py-1 font-mono text-[9px] uppercase tracking-wider text-white/45"><?php echo e($item->badge); ?></span><?php endif; ?>
                            </div>
                            <span class="h-2 w-2 shrink-0 rounded-full bg-white/15 transition group-hover:bg-neutron-300"></span>
                        </div>
                        <h3 class="<?php echo \Illuminate\Support\Arr::toCssClasses(['text-2xl font-medium tracking-tight', 'mt-8' => $hasItemVisual, 'mt-16' => ! $hasItemVisual]); ?>"><?php echo e($item->title); ?></h3>
                        <div class="prose-a1 mt-4 max-w-lg leading-7 text-white/40"><?php echo \App\Support\RichText::render($item->description); ?></div>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\site\sections\feature-grid.blade.php ENDPATH**/ ?>