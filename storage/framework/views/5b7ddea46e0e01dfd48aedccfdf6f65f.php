<?php if (isset($component)) { $__componentOriginalf2a1b2b34b0a376d40858ac9c2a946a5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf2a1b2b34b0a376d40858ac9c2a946a5 = $attributes; } ?>
<?php $component = App\View\Components\SiteLayout::resolve(['page' => $page,'navigationPages' => $navigationPages,'settings' => $settings,'documentTitle' => 'Portfolio'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\SiteLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php ($hero = $page->sections()->where('key', 'hero')->first()); ?>

    <section class="relative px-4 pb-14 pt-36 sm:px-6 sm:pt-40">
        <div class="pointer-events-none absolute inset-x-0 top-16 mx-auto h-[420px] max-w-5xl rounded-full bg-neutron-500/10 blur-[110px]"></div>
        <div class="a1-page-heading relative">
            <p class="neutron-kicker"><?php echo e($hero?->eyebrow ?: 'A1 Legacy Labs portfolio'); ?></p>
            <h1 class="mt-5 text-4xl font-semibold tracking-tight text-white sm:text-6xl"><?php echo e($hero?->heading ?: 'Systems built to turn customer intent into action.'); ?></h1>
            <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-white/55"><?php echo e($hero?->body ?: 'Explore selected websites, AI reception, CRM and automation projects built by A1 Legacy Labs.'); ?></p>
        </div>
    </section>

    <section class="px-4 pb-28 sm:px-6">
        <div class="mx-auto max-w-7xl">
            <?php if($categories->isNotEmpty()): ?>
                <div class="mb-7 flex flex-wrap gap-2">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="rounded-full border border-neutron-300/15 bg-neutron-500/[0.06] px-3 py-1.5 font-mono text-[9px] uppercase tracking-[0.12em] text-neutron-200"><?php echo e($category); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <?php if($portfolios->isEmpty()): ?>
                <div class="neutron-panel rounded-2xl p-10 text-center text-white/45">Portfolio projects will appear here when published from the admin panel.</div>
            <?php else: ?>
                <div class="grid gap-6 lg:grid-cols-2">
                    <?php $__currentLoopData = $portfolios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $portfolio): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <article class="group neutron-panel flex h-full flex-col overflow-hidden rounded-2xl border border-white/[0.07] transition duration-300 hover:-translate-y-1 hover:border-neutron-300/25">
                            <a href="<?php echo e(route('portfolio.show', $portfolio)); ?>" class="relative block overflow-hidden bg-[#020912]" style="aspect-ratio: 16 / 10">
                                <?php if(($portfolio->media_type === 'animation' && $portfolio->animation_html_url) || $portfolio->image_url): ?>
                                    <?php echo $__env->make('site.partials.cms-visual',[
                                        'mediaType'=>$portfolio->media_type ?: 'image',
                                        'imageUrl'=>$portfolio->image_url,
                                        'animationUrl'=>$portfolio->animation_html_url,
                                        'alt'=>$portfolio->image_alt ?: $portfolio->title,
                                        'imageClass'=>'h-full w-full object-cover transition duration-500 group-hover:scale-[1.025]',
                                        'animationClass'=>'pointer-events-none h-full w-full border-0',
                                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                <?php else: ?>
                                    <div class="flex h-full items-center justify-center bg-[radial-gradient(circle_at_center,rgba(47,143,255,.18),transparent_55%)]">
                                        <span class="font-mono text-[10px] uppercase tracking-[0.18em] text-white/25">A1 Legacy Labs</span>
                                    </div>
                                <?php endif; ?>
                                <div class="absolute inset-0 bg-gradient-to-t from-neutron-950/65 via-transparent to-transparent"></div>
                                <?php if($portfolio->category): ?>
                                    <span class="absolute left-4 top-4 rounded-full border border-white/10 bg-neutron-950/75 px-3 py-1.5 font-mono text-[9px] uppercase tracking-[0.14em] text-neutron-200 backdrop-blur"><?php echo e($portfolio->category); ?></span>
                                <?php endif; ?>
                            </a>

                            <div class="flex flex-1 flex-col p-6 sm:p-7">
                                <div class="flex items-start justify-between gap-5">
                                    <div>
                                        <p class="font-mono text-[9px] uppercase tracking-[0.16em] text-neutron-300"><?php echo e($portfolio->eyebrow ?: 'Portfolio project'); ?></p>
                                        <h2 class="mt-3 text-2xl font-semibold tracking-tight text-white"><?php echo e($portfolio->title); ?></h2>
                                    </div>
                                    <span class="font-mono text-[10px] text-white/20"><?php echo e(str_pad((string) $loop->iteration, 2, '0', STR_PAD_LEFT)); ?></span>
                                </div>

                                <p class="mt-4 text-sm leading-7 text-white/48"><?php echo e($portfolio->excerpt); ?></p>

                                <?php if(collect($portfolio->highlights)->filter()->isNotEmpty()): ?>
                                    <div class="mt-6 grid grid-cols-1 gap-2 sm:grid-cols-3">
                                        <?php $__currentLoopData = collect($portfolio->highlights)->filter()->take(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $highlight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <div class="rounded-xl border border-white/[0.07] bg-white/[0.025] px-3 py-3 text-xs leading-5 text-white/55"><?php echo e($highlight); ?></div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>

                                <div class="mt-auto pt-7">
                                    <a href="<?php echo e(route('portfolio.show', $portfolio)); ?>" class="inline-flex w-full items-center justify-between rounded-xl border border-neutron-300/20 bg-neutron-500/[0.07] px-4 py-3.5 font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-neutron-200 transition hover:border-neutron-300/45 hover:bg-neutron-500/15 hover:text-white">
                                        View project detail <span aria-hidden="true">→</span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php echo $__env->make('site.sections.custom-page-sections',['page'=>$page,'settings'=>$settings], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
<?php /**PATH /home/u668568382/domains/a1legacylabs.com/laravel_app/resources/views/pages/portfolio.blade.php ENDPATH**/ ?>