<section class="px-4 py-24 sm:px-6">
    <div class="mx-auto max-w-7xl">
        <div class="a1-section-heading">
            <?php if($section->eyebrow): ?><p class="neutron-kicker"><?php echo e($section->eyebrow); ?></p><?php endif; ?>
            <?php if($section->heading): ?><h2 class="mt-4 text-4xl font-medium tracking-[-0.05em] sm:text-6xl"><?php echo e($section->heading); ?></h2><?php endif; ?>
        </div>

        <div class="mt-12 grid gap-4 lg:grid-cols-3">
            <?php $__currentLoopData = $section->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $itemMediaType=data_get($item->settings,'media_type','image');
                    $itemAnimation=data_get($item->settings,'animation_html');
                    $hasItemVisual=($itemMediaType==='animation' && filled($itemAnimation)) || filled($item->image_url);
                ?>
                <blockquote class="neutron-panel flex min-h-80 flex-col justify-between rounded-2xl p-7">
                    <p class="text-lg leading-8 text-white/75">“<?php echo e($item->description); ?>”</p>
                    <footer class="mt-8 flex items-center gap-4">
                        <?php if($hasItemVisual): ?>
                            <div class="h-12 w-12 shrink-0 overflow-hidden rounded-full border border-white/10 bg-neutron-950">
                                <?php echo $__env->make('site.partials.cms-visual',['mediaType'=>$itemMediaType,'imageUrl'=>$item->image_url,'animationUrl'=>$itemAnimation,'alt'=>data_get($item->settings, 'image_alt') ?: $item->title,'imageClass'=>'h-full w-full object-cover','animationClass'=>'pointer-events-none h-full w-full border-0'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            </div>
                        <?php endif; ?>
                        <div>
                            <p class="font-medium"><?php echo e($item->title); ?></p>
                            <p class="mt-1 text-sm text-white/35"><?php echo e($item->subtitle); ?></p>
                        </div>
                    </footer>
                </blockquote>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\site\sections\testimonials.blade.php ENDPATH**/ ?>