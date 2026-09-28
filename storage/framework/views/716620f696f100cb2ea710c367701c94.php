<?php if (isset($component)) { $__componentOriginalf2a1b2b34b0a376d40858ac9c2a946a5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf2a1b2b34b0a376d40858ac9c2a946a5 = $attributes; } ?>
<?php $component = App\View\Components\SiteLayout::resolve(['page' => $page,'navigationPages' => $navigationPages,'settings' => $settings,'documentTitle' => $product->seo_title ?: $product->title,'documentDescription' => $product->meta_description ?: $product->short_description,'documentKeywords' => $product->meta_keywords,'documentImage' => $product->image_url,'documentImageAlt' => $product->image_alt ?: $product->title] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\SiteLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php
        $highlights = collect($product->highlights ?: [])->filter();
        $benefits = collect($product->benefits ?: [])->filter();
    ?>

    <section class="px-4 pb-16 pt-36 sm:px-6 sm:pt-40">
        <div class="mx-auto max-w-7xl">
            <a href="<?php echo e(route('products')); ?>" class="inline-flex items-center gap-2 font-mono text-[10px] uppercase tracking-[0.14em] text-white/35 transition hover:text-neutron-300">← All products</a>

            <div class="a1-page-heading mt-8">
                <div class="flex flex-wrap items-center justify-center gap-3">
                    <?php if($product->eyebrow): ?>
                        <span class="neutron-kicker"><?php echo e($product->eyebrow); ?></span>
                    <?php endif; ?>
                    <?php if($product->badge): ?>
                        <span class="rounded-full border border-neutron-300/20 bg-neutron-500/10 px-3 py-1 font-mono text-[9px] uppercase tracking-wider text-neutron-200"><?php echo e($product->badge); ?></span>
                    <?php endif; ?>
                </div>
                <h1 class="mt-5 text-5xl font-medium tracking-[-0.055em] text-white sm:text-7xl"><?php echo e($product->title); ?></h1>
                <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-white/55"><?php echo e($product->short_description); ?></p>
                <?php if($highlights->isNotEmpty()): ?>
                    <div class="mt-7 flex flex-wrap justify-center gap-2">
                        <?php $__currentLoopData = $highlights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $highlight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="border border-white/10 bg-white/[0.035] px-3 py-2 font-mono text-[10px] uppercase tracking-[0.09em] text-white/60"><?php echo e($highlight); ?></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
                <div class="mt-9 flex flex-wrap justify-center gap-3">
                    <a href="<?php echo e(route('contact')); ?>" class="inline-flex min-h-12 items-center justify-center rounded-xl bg-neutron-300 px-6 font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-neutron-950 transition hover:bg-white">Talk to our team</a>
                    <a href="<?php echo e(route('products')); ?>" class="inline-flex min-h-12 items-center justify-center rounded-xl border border-white/10 px-6 font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-white/65 transition hover:border-white/20 hover:bg-white/[0.04] hover:text-white">Explore products</a>
                </div>
            </div>

            <div class="mx-auto mt-10 max-w-5xl">
                <div class="neutron-panel overflow-hidden rounded-2xl">
                    <?php if(($product->media_type === 'animation' && $product->animation_html_url) || $product->image_url): ?>
                        <div class="aspect-[1.25] bg-neutron-950">
                            <?php echo $__env->make('site.partials.cms-visual', [
                                'mediaType' => $product->media_type ?: 'image',
                                'imageUrl' => $product->image_url,
                                'animationUrl' => $product->animation_html_url,
                                'alt' => $product->image_alt ?: $product->title,
                                'imageClass' => 'h-full w-full object-cover',
                                'animationClass' => 'pointer-events-none h-full w-full border-0',
                            ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                        </div>
                    <?php else: ?>
                        <div class="flex aspect-[1.25] items-center justify-center bg-[radial-gradient(circle_at_50%_40%,rgba(47,143,255,.20),rgba(2,8,14,.95)_65%)] p-10">
                            <div class="text-center">
                                <div class="mx-auto flex h-20 w-20 items-center justify-center rounded-3xl border border-neutron-300/20 bg-neutron-500/10 text-neutron-300">
                                    <svg class="h-9 w-9" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.4" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 7h14v10H5V7Zm3 3h8m-8 4h5M8 4h8M12 17v3"/></svg>
                                </div>
                                <p class="mt-5 font-mono text-[10px] uppercase tracking-[0.16em] text-white/35">Product visual</p>
                                <p class="mt-2 text-sm text-white/30">Add or replace this image from Admin → Core Products.</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="px-4 py-16 sm:px-6">
        <div class="mx-auto max-w-7xl">
            <div class="a1-section-heading">
                <p class="neutron-kicker">Product overview</p>
                <h2 class="mt-4 text-3xl font-medium tracking-[-0.04em] text-white sm:text-5xl">What <?php echo e($product->title); ?> is built to do.</h2>
            </div>
            <div class="neutron-panel mx-auto mt-10 max-w-5xl rounded-2xl p-6 sm:p-8">
                <?php if($product->description): ?>
                    <div class="space-y-5 leading-8 text-white/55">
                        <?php $__currentLoopData = preg_split('/\r\n|\r|\n/', $product->description); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $paragraph): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if(trim($paragraph) !== ''): ?>
                                <p><?php echo e(trim($paragraph)); ?></p>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <p class="leading-8 text-white/50"><?php echo e($product->short_description); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php if($benefits->isNotEmpty()): ?>
        <section class="px-4 py-16 sm:px-6">
            <div class="mx-auto max-w-7xl">
                <div class="a1-section-heading">
                    <p class="neutron-kicker">Core capabilities</p>
                    <h2 class="mt-4 text-3xl font-medium tracking-[-0.04em] text-white sm:text-5xl">Included in the product workflow.</h2>
                </div>

                <div class="mt-10 grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                    <?php $__currentLoopData = $benefits; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $benefit): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="neutron-panel flex min-h-28 items-start gap-4 rounded-2xl p-5">
                            <span class="mt-1 flex h-7 w-7 shrink-0 items-center justify-center rounded-full border border-neutron-300/20 bg-neutron-500/10 text-neutron-300">✓</span>
                            <p class="text-sm leading-6 text-white/65"><?php echo e($benefit); ?></p>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="px-4 py-20 sm:px-6">
        <div class="mx-auto max-w-7xl rounded-3xl border border-neutron-300/15 bg-neutron-500/[0.07] p-8 text-center sm:p-12">
            <div class="a1-section-heading">
                <p class="neutron-kicker">Next step</p>
                <h2 class="mt-4 text-3xl font-medium tracking-[-0.04em] text-white sm:text-5xl">See how <?php echo e($product->title); ?> fits your customer journey.</h2>
                <p class="mx-auto mt-5 max-w-2xl leading-7 text-white/45">We can map the product around your channels, team, CRM, booking process and escalation rules.</p>
                <a href="<?php echo e(route('contact')); ?>" class="mt-7 inline-flex min-h-12 shrink-0 items-center justify-center rounded-xl bg-neutron-300 px-6 font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-neutron-950 transition hover:bg-white">Contact us</a>
            </div>
        </div>
    </section>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf2a1b2b34b0a376d40858ac9c2a946a5)): ?>
<?php $attributes = $__attributesOriginalf2a1b2b34b0a376d40858ac9c2a946a5; ?>
<?php unset($__attributesOriginalf2a1b2b34b0a376d40858ac9c2a946a5); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf2a1b2b34b0a376d40858ac9c2a946a5)): ?>
<?php $component = $__componentOriginalf2a1b2b34b0a376d40858ac9c2a946a5; ?>
<?php unset($__componentOriginalf2a1b2b34b0a376d40858ac9c2a946a5); ?>
<?php endif; ?>
<?php /**PATH /home/u668568382/domains/a1legacylabs.com/laravel_app/resources/views/pages/product-detail.blade.php ENDPATH**/ ?>