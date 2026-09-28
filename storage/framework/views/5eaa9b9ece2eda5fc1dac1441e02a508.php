<section class="px-4 py-24 sm:px-6">
    <div class="mx-auto max-w-7xl">
        <div class="a1-section-heading">
            <?php if($section->eyebrow): ?>
                <p class="neutron-kicker justify-center"><?php echo e($section->eyebrow); ?></p>
            <?php endif; ?>

            <?php if($section->heading): ?>
                <h2 class="mt-4 text-4xl font-medium tracking-[-0.05em] sm:text-5xl">
                    <?php echo e($section->heading); ?>

                </h2>
            <?php endif; ?>

            <?php if($section->body): ?>
                <div class="prose-a1 mx-auto mt-5 max-w-2xl text-sm leading-7 text-white/45 sm:text-base">
                    <?php echo \App\Support\RichText::render($section->body); ?>

                </div>
            <?php endif; ?>
        </div>

        <div class="mt-10 grid grid-cols-1 items-start gap-3 md:grid-cols-2 md:gap-4 lg:mt-12">
            <?php $__currentLoopData = $section->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <article x-data="{ open: false }" class="neutron-panel self-start rounded-2xl">
                    <button
                        type="button"
                        @click="open = ! open"
                        :aria-expanded="open.toString()"
                        class="flex w-full items-center justify-between gap-5 p-5 text-left sm:p-6"
                    >
                        <span class="font-medium leading-6"><?php echo e($item->title); ?></span>
                        <span class="shrink-0 font-mono text-neutron-300" x-text="open ? '−' : '+'"></span>
                    </button>
                    <div
                        x-show="open"
                        class="prose-a1 px-5 pb-5 leading-7 text-white/45 sm:px-6 sm:pb-6"
                    >
                        <?php echo \App\Support\RichText::render($item->description); ?>

                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php /**PATH /home/u668568382/domains/a1legacylabs.com/laravel_app/resources/views/site/sections/faq.blade.php ENDPATH**/ ?>