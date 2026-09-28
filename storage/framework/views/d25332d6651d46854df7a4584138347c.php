<?php if (isset($component)) { $__componentOriginalf2a1b2b34b0a376d40858ac9c2a946a5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf2a1b2b34b0a376d40858ac9c2a946a5 = $attributes; } ?>
<?php $component = App\View\Components\SiteLayout::resolve(['page' => $page,'navigationPages' => $navigationPages,'settings' => $settings,'documentTitle' => $portfolio->seo_title ?: $portfolio->title,'documentDescription' => $portfolio->meta_description ?: $portfolio->excerpt,'documentKeywords' => $portfolio->meta_keywords,'documentImage' => $portfolio->image_url,'documentImageAlt' => $portfolio->image_alt ?: $portfolio->title] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\SiteLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <section class="relative px-4 pb-20 pt-36 sm:px-6 sm:pt-40">
        <div class="pointer-events-none absolute inset-x-0 top-20 mx-auto h-[480px] max-w-5xl rounded-full bg-neutron-500/10 blur-[120px]"></div>
        <div class="relative mx-auto max-w-7xl">
            <a href="<?php echo e(route('portfolio.index')); ?>" class="inline-flex items-center gap-2 text-sm text-white/40 transition hover:text-white">← Back to Portfolio</a>

            <div class="a1-page-heading mt-9">
                <div class="flex flex-wrap items-center justify-center gap-2">
                    <?php if($portfolio->category): ?><span class="rounded-full border border-neutron-300/20 bg-neutron-500/10 px-3 py-1.5 font-mono text-[9px] uppercase tracking-[0.14em] text-neutron-200"><?php echo e($portfolio->category); ?></span><?php endif; ?>
                    <?php if($portfolio->project_date): ?><span class="rounded-full border border-white/10 px-3 py-1.5 font-mono text-[9px] uppercase tracking-[0.14em] text-white/35"><?php echo e($portfolio->project_date->format('M Y')); ?></span><?php endif; ?>
                </div>
                <p class="neutron-kicker mt-7"><?php echo e($portfolio->eyebrow ?: 'A1 Legacy Labs portfolio'); ?></p>
                <h1 class="mt-4 text-4xl font-semibold tracking-tight text-white sm:text-6xl"><?php echo e($portfolio->title); ?></h1>
                <p class="mx-auto mt-6 max-w-2xl text-lg leading-8 text-white/55"><?php echo e($portfolio->excerpt); ?></p>

                <?php if($portfolio->client_name || $portfolio->project_url): ?>
                    <div class="mt-8 flex flex-wrap items-center justify-center gap-4">
                        <?php if($portfolio->client_name): ?>
                            <div class="rounded-xl border border-white/10 bg-white/[0.025] px-4 py-3">
                                <span class="block font-mono text-[8px] uppercase tracking-[0.16em] text-white/30">Client / business</span>
                                <strong class="mt-1 block text-sm font-medium text-white/75"><?php echo e($portfolio->client_name); ?></strong>
                            </div>
                        <?php endif; ?>
                        <?php if($portfolio->project_url): ?>
                            <a href="<?php echo e($portfolio->project_url); ?>" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 rounded-xl bg-neutron-300 px-5 py-3.5 font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-neutron-950 transition hover:brightness-110">Visit live project ↗</a>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>

            <div class="mx-auto mt-10 max-w-5xl overflow-hidden rounded-3xl border border-white/10 bg-[#020912] shadow-2xl shadow-black/30" style="aspect-ratio: 16 / 11">
                <?php if(($portfolio->media_type === 'animation' && $portfolio->animation_html_url) || $portfolio->image_url): ?>
                    <?php echo $__env->make('site.partials.cms-visual',['mediaType'=>$portfolio->media_type ?: 'image','imageUrl'=>$portfolio->image_url,'animationUrl'=>$portfolio->animation_html_url,'alt'=>$portfolio->image_alt ?: $portfolio->title,'imageClass'=>'h-full w-full object-cover','animationClass'=>'pointer-events-none h-full w-full border-0'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                <?php else: ?>
                    <div class="flex h-full items-center justify-center bg-[radial-gradient(circle_at_center,rgba(47,143,255,.22),transparent_56%)]">
                        <span class="font-mono text-[10px] uppercase tracking-[0.18em] text-white/25">A1 Legacy Labs project</span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="border-y border-white/[0.06] bg-white/[0.015] px-4 py-16 sm:px-6">
        <div class="mx-auto max-w-7xl">
            <div class="a1-section-heading">
                <p class="neutron-kicker">Project overview</p>
                <h2 class="mt-4 text-3xl font-semibold tracking-tight text-white">What this project was built to do.</h2>
            </div>
            <div class="mx-auto mt-10 max-w-5xl space-y-8">
                <?php if($portfolio->description): ?>
                    <div class="prose-a1 text-base leading-8 text-white/55"><?php echo \App\Support\RichText::render($portfolio->description); ?></div>
                <?php endif; ?>

                <?php if(collect($portfolio->highlights)->filter()->isNotEmpty()): ?>
                    <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-3">
                        <?php $__currentLoopData = collect($portfolio->highlights)->filter(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $highlight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="rounded-2xl border border-white/[0.07] bg-neutron-950/45 p-4 text-sm leading-6 text-white/60">
                                <span class="mb-3 block h-1.5 w-1.5 rounded-full bg-neutron-300 shadow-[0_0_12px_rgba(158,203,255,.7)]"></span>
                                <?php echo e($highlight); ?>

                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <?php if($portfolio->challenge || $portfolio->solution || $portfolio->outcome): ?>
        <section class="px-4 py-20 sm:px-6">
            <div class="mx-auto max-w-7xl">
                <div class="grid gap-5 lg:grid-cols-3">
                    <?php if($portfolio->challenge): ?>
                        <article class="neutron-panel rounded-2xl p-6 sm:p-7">
                            <p class="font-mono text-[9px] uppercase tracking-[0.16em] text-neutron-300">01 / Challenge</p>
                            <h2 class="mt-4 text-xl font-semibold text-white">The challenge</h2>
                            <div class="prose-a1 mt-4 text-sm leading-7 text-white/48"><?php echo \App\Support\RichText::render($portfolio->challenge); ?></div>
                        </article>
                    <?php endif; ?>
                    <?php if($portfolio->solution): ?>
                        <article class="neutron-panel rounded-2xl p-6 sm:p-7">
                            <p class="font-mono text-[9px] uppercase tracking-[0.16em] text-neutron-300">02 / Build</p>
                            <h2 class="mt-4 text-xl font-semibold text-white">What A1 Legacy Labs built</h2>
                            <div class="prose-a1 mt-4 text-sm leading-7 text-white/48"><?php echo \App\Support\RichText::render($portfolio->solution); ?></div>
                        </article>
                    <?php endif; ?>
                    <?php if($portfolio->outcome): ?>
                        <article class="neutron-panel rounded-2xl p-6 sm:p-7">
                            <p class="font-mono text-[9px] uppercase tracking-[0.16em] text-neutron-300">03 / Outcome</p>
                            <h2 class="mt-4 text-xl font-semibold text-white">Outcome</h2>
                            <div class="prose-a1 mt-4 text-sm leading-7 text-white/48"><?php echo \App\Support\RichText::render($portfolio->outcome); ?></div>
                        </article>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if(collect($portfolio->technologies)->filter()->isNotEmpty()): ?>
        <section class="px-4 pb-20 sm:px-6">
            <div class="mx-auto max-w-7xl rounded-2xl border border-white/[0.07] bg-white/[0.02] p-6 sm:p-8">
                <p class="neutron-kicker">Capabilities</p>
                <div class="mt-5 flex flex-wrap gap-2">
                    <?php $__currentLoopData = collect($portfolio->technologies)->filter(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $technology): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="rounded-full border border-neutron-300/15 bg-neutron-500/[0.06] px-3 py-2 text-xs text-neutron-100"><?php echo e($technology); ?></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <?php if($relatedPortfolios->isNotEmpty()): ?>
        <section class="px-4 pb-24 sm:px-6">
            <div class="mx-auto max-w-7xl">
                <div class="a1-section-heading">
                    <p class="neutron-kicker">More work</p><h2 class="mt-3 text-3xl font-semibold text-white">Related portfolio projects</h2>
                    <a href="<?php echo e(route('portfolio.index')); ?>" class="mt-5 inline-flex text-sm text-neutron-200">View all →</a>
                </div>
                <div class="mt-7 grid gap-5 md:grid-cols-3">
                    <?php $__currentLoopData = $relatedPortfolios; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <a href="<?php echo e(route('portfolio.show', $related)); ?>" class="group neutron-panel overflow-hidden rounded-2xl">
                            <div class="bg-neutron-950" style="aspect-ratio:16/10">
                                <?php if(($related->media_type === 'animation' && $related->animation_html_url) || $related->image_url): ?> <?php echo $__env->make('site.partials.cms-visual',['mediaType'=>$related->media_type ?: 'image','imageUrl'=>$related->image_url,'animationUrl'=>$related->animation_html_url,'alt'=>$related->image_alt ?: $related->title,'imageClass'=>'h-full w-full object-cover transition duration-500 group-hover:scale-[1.03]','animationClass'=>'pointer-events-none h-full w-full border-0'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php endif; ?>
                            </div>
                            <div class="p-5"><p class="font-mono text-[9px] uppercase text-neutron-300"><?php echo e($related->category ?: 'Portfolio'); ?></p><h3 class="mt-3 text-lg font-semibold text-white"><?php echo e($related->title); ?></h3><span class="mt-4 inline-flex text-xs text-neutron-200">View detail →</span></div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    <?php endif; ?>

    <section class="px-4 pb-28 sm:px-6">
        <div class="mx-auto max-w-7xl rounded-3xl border border-neutron-300/15 bg-[linear-gradient(135deg,rgba(47,143,255,.12),rgba(2,9,18,.95))] p-8 text-center sm:p-12">
            <p class="neutron-kicker">Build your next system</p>
            <h2 class="mt-4 text-3xl font-semibold text-white sm:text-4xl">Have a workflow or customer journey you want to improve?</h2>
            <p class="mx-auto mt-4 max-w-2xl text-sm leading-7 text-white/50">A1 Legacy Labs can map the right combination of AI, website, CRM and automation around the result you need.</p>
            <a href="<?php echo e(route('contact')); ?>" class="mt-7 inline-flex rounded-xl bg-neutron-300 px-6 py-3.5 font-mono text-[10px] font-semibold uppercase tracking-[0.12em] text-neutron-950">Start a conversation</a>
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
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\pages\portfolio-detail.blade.php ENDPATH**/ ?>