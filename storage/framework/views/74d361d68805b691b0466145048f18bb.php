<?php if(($platforms ?? collect())->isNotEmpty()): ?>
    <div class="border-t border-white/10 bg-neutron-950/92 p-3 sm:p-4">
        <div class="grid grid-cols-1 gap-2 sm:grid-cols-2 xl:grid-cols-4">
            <?php $__currentLoopData = $platforms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $platform): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php ($classes = 'group relative min-w-0 rounded-xl border border-white/[0.07] bg-white/[0.015] px-5 py-5 transition sm:px-6 sm:py-6 '.($platform->link_url ? 'hover:border-neutron-300/20 hover:bg-white/[0.035]' : '')); ?>
                <?php if($platform->link_url): ?>
                    <a href="<?php echo e($platform->link_url); ?>" class="<?php echo e($classes); ?>">
                <?php else: ?>
                    <div class="<?php echo e($classes); ?>">
                <?php endif; ?>
                        <div class="flex items-start gap-4">
                            <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl border border-white/10 bg-white/[0.025] text-white/55 transition group-hover:border-neutron-300/20 group-hover:text-neutron-300">
                                <?php echo $__env->make('site.partials.platform-icon', ['icon' => $platform->icon], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                            </div>
                            <div class="min-w-0 flex-1">
                                <h3 class="text-sm font-medium tracking-tight text-white/90"><?php echo e($platform->title); ?></h3>
                                <?php if($platform->description): ?><p class="mt-2 text-[11px] leading-5 text-white/35"><?php echo e($platform->description); ?></p><?php endif; ?>
                            </div>
                            <?php if($platform->link_url): ?><span class="shrink-0 text-xs text-white/20 transition group-hover:translate-x-0.5 group-hover:text-neutron-300" aria-hidden="true">↗</span><?php endif; ?>
                        </div>
                <?php if($platform->link_url): ?>
                    </a>
                <?php else: ?>
                    </div>
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
<?php endif; ?>
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\site\partials\platform-strip.blade.php ENDPATH**/ ?>