<section class="px-4 pb-28 sm:px-6">
    <div class="mx-auto max-w-5xl border-t border-white/10">
        <?php $__currentLoopData = $section->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $itemMediaType=data_get($item->settings,'media_type','image');
                $itemAnimation=data_get($item->settings,'animation_html');
                $hasItemVisual=($itemMediaType==='animation' && filled($itemAnimation)) || filled($item->image_url);
            ?>
            <article class="grid gap-5 border-b border-white/10 py-10 sm:grid-cols-[180px_1fr]">
                <div>
                    <p class="font-mono text-[10px] uppercase tracking-wider text-white/30"><?php echo e($item->subtitle); ?></p>
                    <?php if($item->badge): ?><span class="mt-3 inline-flex rounded-full bg-neutron-500/10 px-3 py-1 font-mono text-[9px] uppercase tracking-wider text-neutron-300"><?php echo e($item->badge); ?></span><?php endif; ?>
                </div>
                <div>
                    <?php if($hasItemVisual): ?>
                        <div class="mb-7 aspect-video overflow-hidden rounded-2xl border border-white/10 bg-black">
                            <?php echo $__env->make('site.partials.cms-visual',['mediaType'=>$itemMediaType,'imageUrl'=>$item->image_url,'animationUrl'=>$itemAnimation,'alt'=>data_get($item->settings, 'image_alt') ?: $item->title,'imageClass'=>'h-full w-full object-cover object-top','animationClass'=>'pointer-events-none h-full w-full border-0'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                    <?php endif; ?>
                    <h2 class="text-2xl font-medium"><?php echo e($item->title); ?></h2>
                    <div class="prose-a1 mt-4 leading-7 text-white/45"><?php echo \App\Support\RichText::render($item->description); ?></div>
                </div>
            </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php /**PATH /home/u668568382/domains/a1legacylabs.com/laravel_app/resources/views/site/sections/changelog.blade.php ENDPATH**/ ?>