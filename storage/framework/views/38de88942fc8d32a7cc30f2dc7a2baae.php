<section id="<?php echo e($section->key); ?>" class="px-4 py-20 sm:px-6">
    <div class="mx-auto max-w-7xl">
        <div class="a1-section-heading">
            <?php if($section->eyebrow): ?><p class="neutron-kicker"><?php echo e($section->eyebrow); ?></p><?php endif; ?>
            <?php if($section->heading): ?><h2 class="mt-4 text-3xl font-medium text-white sm:text-5xl"><?php echo e($section->heading); ?></h2><?php endif; ?>
        </div>
        <div class="mt-10 grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
            <?php $__currentLoopData = $section->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $itemMediaType=data_get($item->settings,'media_type','image');
                    $itemAnimation=data_get($item->settings,'animation_html');
                    $hasItemVisual=($itemMediaType==='animation' && filled($itemAnimation)) || filled($item->image_url);
                ?>
                <a href="<?php echo e($item->link_url ?: '#'); ?>" class="group neutron-panel overflow-hidden rounded-2xl">
                    <?php if($hasItemVisual): ?>
                        <div class="aspect-[4/3] overflow-hidden bg-neutron-950">
                            <?php echo $__env->make('site.partials.cms-visual',['mediaType'=>$itemMediaType,'imageUrl'=>$item->image_url,'animationUrl'=>$itemAnimation,'alt'=>data_get($item->settings, 'image_alt') ?: $item->title,'imageClass'=>'h-full w-full object-cover transition duration-500 group-hover:scale-[1.02]','animationClass'=>'pointer-events-none h-full w-full border-0'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                    <?php endif; ?>
                    <div class="p-5">
                        <h3 class="font-medium text-white"><?php echo e($item->title); ?></h3>
                        <?php if($item->subtitle): ?><p class="mt-1 text-xs text-white/35"><?php echo e($item->subtitle); ?></p><?php endif; ?>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\site\sections\gallery-grid.blade.php ENDPATH**/ ?>