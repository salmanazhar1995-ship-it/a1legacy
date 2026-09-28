<section class="border-y border-white/[0.07] px-4 py-9 sm:px-6">
    <div class="mx-auto flex max-w-7xl flex-col items-center justify-between gap-7 lg:flex-row">
        <p class="font-mono text-[10px] uppercase tracking-[0.16em] text-white/30"><?php echo e($section->eyebrow); ?></p>
        <div class="flex flex-wrap justify-center gap-x-10 gap-y-5">
            <?php $__currentLoopData = $section->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><span class="text-lg font-medium tracking-tight text-white/55"><?php echo e($item->title); ?></span><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\site\sections\logo-strip.blade.php ENDPATH**/ ?>