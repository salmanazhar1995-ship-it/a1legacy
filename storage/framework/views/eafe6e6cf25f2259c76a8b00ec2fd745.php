<?php if (isset($component)) { $__componentOriginalf2a1b2b34b0a376d40858ac9c2a946a5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf2a1b2b34b0a376d40858ac9c2a946a5 = $attributes; } ?>
<?php $component = App\View\Components\SiteLayout::resolve(['page' => $page,'navigationPages' => $navigationPages,'settings' => $settings,'documentTitle' => $industry->seo_title ?: $industry->title.' Industry AI Solutions','documentDescription' => $industry->meta_description ?: strip_tags((string)$industry->description),'documentKeywords' => $industry->meta_keywords,'documentImage' => $industry->image_url,'documentImageAlt' => $industry->image_alt ?: $industry->title] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\SiteLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <section class="relative overflow-hidden px-4 pb-20 pt-36 sm:px-6 sm:pt-40">
        <div class="pointer-events-none absolute right-[-10%] top-12 h-[480px] w-[680px] rounded-full bg-neutron-500/10 blur-[150px]"></div>
        <div class="relative mx-auto max-w-7xl">
            <a href="<?php echo e(route('industries.index')); ?>" class="inline-flex items-center gap-2 text-sm text-white/40 transition hover:text-white">← All industries</a>
            <div class="a1-page-heading mt-8">
                <p class="neutron-kicker"><?php echo e($industry->category ?: 'Industry solutions'); ?></p>
                <h1 class="mt-5 text-4xl font-semibold tracking-[-0.05em] text-white sm:text-6xl">AI for <?php echo e($industry->title); ?></h1>
                <?php if($industry->description): ?><div class="prose-a1 mx-auto mt-6 max-w-2xl text-base leading-8 text-white/52"><?php echo \App\Support\RichText::render($industry->description); ?></div><?php endif; ?>
                <div class="mt-8 flex flex-wrap justify-center gap-3">
                    <a href="<?php echo e(route('contact')); ?>" class="rounded-xl bg-neutron-300 px-5 py-3 text-sm font-semibold text-neutron-950 transition hover:bg-white">Discuss your workflow</a>
                    <?php if($industry->link_url): ?>
                        <a href="<?php echo e($industry->link_url); ?>" class="rounded-xl border border-white/10 px-5 py-3 text-sm text-white/65 transition hover:bg-white/5 hover:text-white"><?php echo e($industry->link_label ?: 'Explore solution'); ?></a>
                    <?php else: ?>
                        <a href="<?php echo e(route('products')); ?>" class="rounded-xl border border-white/10 px-5 py-3 text-sm text-white/65 transition hover:bg-white/5 hover:text-white">Explore products</a>
                    <?php endif; ?>
                </div>
            </div>
            <div class="mx-auto mt-10 max-w-5xl overflow-hidden rounded-3xl border border-white/[0.08] bg-[#07111d] shadow-[0_30px_100px_rgba(0,0,0,.25)]">
                <div class="aspect-[4/3] overflow-hidden">
                    <?php if(($industry->media_type === 'animation' && $industry->animation_html_url) || $industry->image_url): ?>
                        <?php echo $__env->make('site.partials.cms-visual',[
                            'mediaType'=>$industry->media_type ?: 'image',
                            'imageUrl'=>$industry->image_url,
                            'animationUrl'=>$industry->animation_html_url,
                            'alt'=>$industry->image_alt ?: $industry->title,
                            'imageClass'=>'h-full w-full object-cover',
                            'animationClass'=>'pointer-events-none h-full w-full border-0',
                        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php else: ?>
                        <div class="flex h-full items-center justify-center text-neutron-300/50"><svg class="h-16 w-16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2"><path d="M4 19V8l8-4 8 4v11M8 19v-5h8v5M8 10h.01M12 10h.01M16 10h.01"/></svg></div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section class="px-4 pb-28 sm:px-6">
        <div class="mx-auto max-w-7xl">
            <div class="a1-section-heading">
                <p class="neutron-kicker">Where AI fits</p>
                <h2 class="mt-3 text-3xl font-semibold tracking-tight text-white sm:text-5xl">Practical automation opportunities</h2>
            </div>

            <div class="mt-10 grid gap-5 lg:grid-cols-[1.25fr_.75fr]">
                <article class="rounded-3xl border border-white/[0.08] bg-white/[0.025] p-7 sm:p-9">
                    <?php if(collect($industry->highlights)->filter()->isNotEmpty()): ?>
                        <div class="grid gap-3 sm:grid-cols-2">
                            <?php $__currentLoopData = $industry->highlights; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $highlight): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="rounded-2xl border border-white/[0.08] bg-[#07111d]/70 p-5"><div class="flex gap-3"><span class="mt-2 h-2 w-2 shrink-0 rounded-full bg-neutron-300 shadow-[0_0_14px_rgba(158,203,255,.75)]"></span><p class="text-sm leading-6 text-white/60"><?php echo e($highlight); ?></p></div></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <p class="text-sm leading-7 text-white/45">Add industry highlights from the admin panel to show the most relevant automation opportunities.</p>
                    <?php endif; ?>
                </article>
                <aside class="rounded-3xl border border-neutron-300/15 bg-neutron-500/[0.06] p-7 text-center sm:p-9">
                    <p class="neutron-kicker">Existing systems</p>
                    <h3 class="mt-3 text-2xl font-semibold text-white">Fit around the tools you already use.</h3>
                    <p class="mt-5 text-sm leading-7 text-white/50"><?php echo e($industry->system_note ?: 'A1 Legacy can be designed around your approved CRM, calendar, messaging and operational systems rather than forcing a full replacement.'); ?></p>
                    <a href="<?php echo e(route('contact')); ?>" class="mt-7 inline-flex text-sm font-medium text-neutron-200">Plan an integration →</a>
                </aside>
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
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\pages\industry-detail.blade.php ENDPATH**/ ?>