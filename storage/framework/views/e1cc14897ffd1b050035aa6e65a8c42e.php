<?php ($items=collect($stories??[])->take(4)); ?>
<?php if($items->isNotEmpty()): ?>
<section class="border-y border-white/[0.07] bg-neutron-950/60 px-4 py-20 sm:px-6 sm:py-24" id="client-stories">
    <div class="mx-auto max-w-7xl">
        <div class="a1-section-heading">
            <p class="neutron-kicker"><?php echo e($section?->eyebrow?:'Real client proof'); ?></p>
            <h2 class="mt-4 text-3xl font-semibold tracking-tight text-white sm:text-5xl"><?php echo e($section?->heading?:'Client Stories'); ?></h2>
            <p class="mx-auto mt-4 max-w-2xl leading-7 text-white/50"><?php echo e($section?->body?:'Real businesses sharing their experience with A1 Legacy systems.'); ?></p>
            <a href="<?php echo e(route('client-stories.index')); ?>" class="mt-6 inline-flex rounded-xl border border-neutron-300/20 bg-neutron-500/10 px-5 py-3 font-mono text-[10px] uppercase tracking-wider text-neutron-200">View All Client Stories →</a>
        </div>
        <div class="mt-10 grid gap-5 lg:grid-cols-2">
            <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article class="neutron-panel rounded-2xl p-5 sm:p-6">
                    <h3 class="text-xl font-semibold text-white"><?php echo e($story->person_name); ?></h3>
                    <p class="mt-1 text-sm font-medium text-neutron-200"><?php echo e($story->business_name); ?></p>
                    <?php if($story->role): ?><p class="mt-1 mb-5 text-sm text-white/40"><?php echo e($story->role); ?></p><?php else: ?><div class="mb-5"></div><?php endif; ?>
                    <?php echo $__env->make('site.partials.client-story-video',['story'=>$story], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php if($story->implementation_label): ?><p class="mt-5 border-t border-white/[0.08] pt-4 font-mono text-[10px] uppercase tracking-wider text-white/45"><span class="text-neutron-300">Implemented:</span> <?php echo e($story->implementation_label); ?></p><?php endif; ?>
                    <?php if($story->approved_quote): ?><blockquote class="mt-4 text-sm leading-6 text-white/50">“<?php echo e($story->approved_quote); ?>”</blockquote><?php endif; ?>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH /home/u668568382/domains/a1legacylabs.com/laravel_app/resources/views/site/sections/client-stories.blade.php ENDPATH**/ ?>