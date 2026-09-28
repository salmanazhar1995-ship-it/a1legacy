<?php ($stats = $section->items->values()); ?>
<section id="<?php echo e($section->key); ?>" class="px-4 py-20 sm:px-6 sm:py-24">
    <div class="mx-auto max-w-7xl">
        <div class="a1-section-heading">
            <?php if($section->eyebrow): ?><p class="neutron-kicker"><?php echo e($section->eyebrow); ?></p><?php endif; ?>
            <?php if($section->heading): ?><h2 class="mt-3 text-3xl font-medium tracking-[-0.04em] text-white sm:text-5xl"><?php echo e($section->heading); ?></h2><?php endif; ?>
            <?php if($section->body): ?><div class="prose-a1 mx-auto mt-4 max-w-2xl text-sm leading-7 text-white/45"><?php echo \App\Support\RichText::render($section->body); ?></div><?php endif; ?>
        </div>

        <?php if($stats->isNotEmpty()): ?>
            <div class="mt-9 grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
                <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="min-w-0 rounded-2xl border border-white/[0.09] bg-[#030a12]/90 p-5 transition hover:border-neutron-300/20 hover:bg-white/[0.025] sm:p-6 lg:min-h-[168px]">
                        <p class="break-words text-3xl font-medium tracking-[-0.05em] text-neutron-300 sm:text-4xl xl:text-[42px]"><?php echo e($item->value); ?></p>
                        <p class="mt-3 max-w-xs text-xs leading-5 text-white/40 sm:text-sm"><?php echo e($item->title); ?></p>
                        <?php if($item->description): ?><p class="mt-2 text-xs leading-5 text-white/28"><?php echo e($item->description); ?></p><?php endif; ?>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</section>
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\site\sections\stats.blade.php ENDPATH**/ ?>