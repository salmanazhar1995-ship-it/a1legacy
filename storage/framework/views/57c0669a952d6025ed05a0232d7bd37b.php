<?php ($stats = $section->items->values()); ?>
<section id="<?php echo e($section->key); ?>" class="px-4 py-20 sm:px-6 sm:py-24">
    <div class="mx-auto max-w-7xl">
        <div class="a1-section-heading">
            <?php if($section->eyebrow): ?><p class="neutron-kicker"><?php echo e($section->eyebrow); ?></p><?php endif; ?>
            <?php if($section->heading): ?><h2 class="mt-3 text-3xl font-medium tracking-[-0.04em] text-white sm:text-5xl"><?php echo e($section->heading); ?></h2><?php endif; ?>
            <?php if($section->body): ?><div class="prose-a1 mx-auto mt-4 max-w-2xl text-sm leading-7 text-white/45"><?php echo \App\Support\RichText::render($section->body); ?></div><?php endif; ?>
        </div>

        <?php if($stats->isNotEmpty()): ?>
            <div class="a1-stats-centered mt-9">
                <?php $__currentLoopData = $stats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <article class="a1-stats-centered__card min-w-0 rounded-2xl border border-white/[0.09] bg-[#030a12]/90 p-5 transition hover:border-neutron-300/20 hover:bg-white/[0.025] sm:p-6 lg:min-h-[168px]">
                        <p class="break-words text-3xl font-medium tracking-[-0.05em] text-neutron-300 sm:text-4xl xl:text-[42px]"><?php echo e($item->value); ?></p>
                        <p class="mt-3 max-w-xs text-xs leading-5 text-white/40 sm:text-sm"><?php echo e($item->title); ?></p>
                        <?php if($item->description): ?><p class="mt-2 text-xs leading-5 text-white/28"><?php echo e($item->description); ?></p><?php endif; ?>
                    </article>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php if (! $__env->hasRenderedOnce('0f878511-015d-4eed-906a-2ae35b5bfd32')): $__env->markAsRenderedOnce('0f878511-015d-4eed-906a-2ae35b5bfd32'); ?>
<style>
.a1-stats-centered{display:flex;flex-wrap:wrap;justify-content:center;gap:.75rem}
.a1-stats-centered__card{width:100%}
@media (min-width:640px){.a1-stats-centered__card{width:calc(50% - .375rem)}}
@media (min-width:1024px){.a1-stats-centered__card{width:calc(33.333333% - .5rem)}}
@media (min-width:1280px){.a1-stats-centered__card{width:calc(25% - .5625rem)}}
</style>
<?php endif; ?>
<?php /**PATH /home/u668568382/domains/a1legacylabs.com/laravel_app/resources/views/site/sections/stats.blade.php ENDPATH**/ ?>