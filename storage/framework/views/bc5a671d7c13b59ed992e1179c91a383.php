<?php $columns=max(1,min(4,(int)data_get($section->settings,'columns',3))); ?>
<section id="<?php echo e($section->key); ?>" class="px-4 py-20 sm:px-6">
    <div class="mx-auto max-w-7xl">
        <div class="a1-section-heading">
            <?php if($section->eyebrow): ?><p class="neutron-kicker"><?php echo e($section->eyebrow); ?></p><?php endif; ?>
            <?php if($section->heading): ?><h2 class="mt-4 text-3xl font-medium tracking-[-0.04em] text-white sm:text-5xl"><?php echo e($section->heading); ?></h2><?php endif; ?>
            <?php if($section->body): ?><div class="prose-a1 mt-5 text-white/45"><?php echo \App\Support\RichText::render($section->body); ?></div><?php endif; ?>
        </div>
        <div class="mt-10 grid gap-4 sm:grid-cols-2 <?php if($columns>=3): ?> lg:grid-cols-3 <?php endif; ?> <?php if($columns===4): ?> xl:grid-cols-4 <?php endif; ?>">
            <?php $__currentLoopData = $section->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $itemMediaType=data_get($item->settings,'media_type','image');
                    $itemAnimation=data_get($item->settings,'animation_html');
                    $hasItemVisual=($itemMediaType==='animation' && filled($itemAnimation)) || filled($item->image_url);
                ?>
                <article class="neutron-panel overflow-hidden rounded-2xl">
                    <?php if($hasItemVisual): ?>
                        <div class="aspect-video overflow-hidden bg-neutron-950">
                            <?php echo $__env->make('site.partials.cms-visual',['mediaType'=>$itemMediaType,'imageUrl'=>$item->image_url,'animationUrl'=>$itemAnimation,'alt'=>data_get($item->settings, 'image_alt') ?: $item->title,'imageClass'=>'h-full w-full object-cover','animationClass'=>'pointer-events-none h-full w-full border-0'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                    <?php endif; ?>
                    <div class="p-6">
                        <?php if($item->badge): ?><span class="rounded-full border border-white/10 px-2 py-1 font-mono text-[9px] uppercase text-neutron-300"><?php echo e($item->badge); ?></span><?php endif; ?>
                        <h3 class="mt-4 text-xl font-medium text-white"><?php echo e($item->title); ?></h3>
                        <?php if($item->description): ?><div class="prose-a1 mt-3 text-sm leading-7 text-white/45"><?php echo \App\Support\RichText::render($item->description); ?></div><?php endif; ?>
                        <?php if($item->link_label): ?><a href="<?php echo e($item->link_url ?: '#'); ?>" class="mt-5 inline-flex text-sm text-neutron-200"><?php echo e($item->link_label); ?> →</a><?php endif; ?>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\site\sections\cards-grid.blade.php ENDPATH**/ ?>