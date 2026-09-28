<?php if($products->isNotEmpty()): ?>
<section id="core-products" class="px-4 py-24 sm:px-6">
    <div class="mx-auto max-w-7xl">
        <div class="a1-section-heading">
            <p class="neutron-kicker">Core Products</p>
            <h2 class="mt-4 text-4xl font-medium tracking-[-0.05em] text-white sm:text-6xl">AI systems built for the customer journey.</h2>
            <p class="mx-auto mt-5 max-w-2xl leading-7 text-white/45">Explore the products that connect calls, conversations, websites, booking, CRM and follow-up into one operating flow.</p>
        </div>

        <div class="mt-12 grid grid-cols-1 gap-5 md:grid-cols-2">
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $highlights = collect($product->highlights ?: $product->benefits)->filter()->values();
                ?>

                <article class="neutron-panel group flex min-h-full flex-col overflow-hidden rounded-2xl transition duration-300 hover:-translate-y-0.5 hover:border-neutron-300/25">
                    <a href="<?php echo e(route('products.show', $product)); ?>" class="relative block aspect-[16/9] overflow-hidden border-b border-white/[0.07] bg-neutron-950">
                        <?php if(($product->media_type === 'animation' && $product->animation_html_url) || $product->image_url): ?>
                            <?php echo $__env->make('site.partials.cms-visual', [
                                'mediaType' => $product->media_type ?: 'image',
                                'imageUrl' => $product->image_url,
                                'animationUrl' => $product->animation_html_url,
                                'alt' => $product->image_alt ?: $product->title,
                                'imageClass' => 'h-full w-full object-cover transition duration-700 group-hover:scale-[1.025]',
                                'animationClass' => 'pointer-events-none h-full w-full border-0',
                            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        <?php else: ?>
                            <div class="flex h-full w-full items-center justify-center bg-[radial-gradient(circle_at_50%_35%,rgba(47,143,255,.18),rgba(2,8,14,.96)_68%)]">
                                <div class="text-center">
                                    <div class="mx-auto flex h-14 w-14 items-center justify-center rounded-2xl border border-neutron-300/20 bg-neutron-500/10 text-neutron-300">
                                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16v12H4V6Zm3 3h10m-10 3h7m-7 3h5" />
                                        </svg>
                                    </div>
                                    <p class="mt-3 font-mono text-[9px] uppercase tracking-[0.14em] text-white/30">Add product image from admin</p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <div class="pointer-events-none absolute inset-x-0 bottom-0 h-20 bg-gradient-to-t from-neutron-950/75 to-transparent"></div>
                    </a>

                    <div class="flex flex-1 flex-col p-6 sm:p-7">
                        <div class="flex flex-wrap items-center gap-3">
                            <?php if($product->eyebrow): ?>
                                <span class="font-mono text-[10px] font-semibold uppercase tracking-[0.14em] text-neutron-300"><?php echo e($product->eyebrow); ?></span>
                            <?php endif; ?>
                            <?php if($product->badge): ?>
                                <span class="rounded-full border border-white/10 bg-white/[0.025] px-2.5 py-1 text-[10px] text-white/55"><?php echo e($product->badge); ?></span>
                            <?php endif; ?>
                        </div>

                        <h3 class="mt-4 text-2xl font-medium tracking-tight text-white"><?php echo e($product->title); ?></h3>
                        <p class="mt-3 leading-7 text-white/45"><?php echo e($product->short_description); ?></p>

                        <?php if($highlights->isNotEmpty()): ?>
                            <div class="mt-6 flex flex-wrap gap-3">
                                <?php $__currentLoopData = $highlights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $highlight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="inline-flex min-h-12 items-center gap-3 rounded-full border border-neutron-300/20 bg-white/[0.025] px-4 py-3 text-left transition hover:border-neutron-300/35 hover:bg-neutron-500/[0.16]">
                                        <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-neutron-300 shadow-[0_0_10px_rgba(102,214,255,.35)]"></span>
                                        <span class="text-[11px] leading-5 text-white/60"><?php echo e($highlight); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>

                        <div class="mt-auto pt-7">
                            <a
                                href="<?php echo e(route('products.show', $product)); ?>"
                                class="inline-flex min-h-12 w-full items-center justify-center gap-2 rounded-xl border border-neutron-300/20 bg-gradient-to-r from-neutron-500/[0.16] to-neutron-300/[0.08] px-5 font-mono text-[10px] font-semibold uppercase tracking-[0.13em] text-neutron-200 transition hover:border-neutron-300/35 hover:bg-neutron-500/[0.16] hover:text-white"
                            >
                                View product details
                                <span aria-hidden="true">→</span>
                            </a>
                        </div>
                    </div>
                </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
<?php endif; ?>
<?php /**PATH /home/u668568382/domains/a1legacylabs.com/laravel_app/resources/views/site/sections/core-products.blade.php ENDPATH**/ ?>