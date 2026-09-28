<?php if (isset($component)) { $__componentOriginalf2a1b2b34b0a376d40858ac9c2a946a5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf2a1b2b34b0a376d40858ac9c2a946a5 = $attributes; } ?>
<?php $component = App\View\Components\SiteLayout::resolve(['page' => $page,'navigationPages' => $navigationPages,'settings' => $settings] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\SiteLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <?php $hero = $page->sections->firstWhere('key', 'hero'); ?>
    <section class="relative overflow-hidden px-4 pb-16 pt-36 sm:px-6 sm:pb-24 sm:pt-44">
        <div class="pointer-events-none absolute inset-0 bg-[radial-gradient(circle_at_50%_0%,rgba(47,143,255,0.18),transparent_44%)]"></div>
        <div class="relative mx-auto max-w-7xl">
            <div class="mx-auto max-w-3xl text-center">
                <p class="neutron-kicker"><?php echo e($hero?->eyebrow ?: 'A1 Legacy insights'); ?></p>
                <h1 class="mt-5 text-4xl font-medium tracking-[-0.04em] text-white sm:text-6xl"><?php echo e($hero?->heading ?: 'Ideas for better AI, automation, and digital operations.'); ?></h1>
                <p class="mx-auto mt-6 max-w-2xl text-base leading-7 text-white/50 sm:text-lg"><?php echo e($hero?->body ?: 'Practical articles on AI reception, customer journeys, websites, CRM workflows, and the systems behind modern service businesses.'); ?></p>
            </div>
        </div>
    </section>

    <section class="px-4 pb-24 sm:px-6 sm:pb-32">
        <div class="mx-auto max-w-7xl">
            <?php if($posts->count()): ?>
                <div class="grid gap-5 md:grid-cols-2 xl:grid-cols-3">
                    <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <article class="group overflow-hidden rounded-2xl border border-white/10 bg-white/[0.025] transition duration-300 hover:-translate-y-1 hover:border-neutron-300/25 hover:bg-white/[0.04]">
                            <a href="<?php echo e(route('blog.show', $post->slug)); ?>" class="block">
                                <?php if(($post->featured_media_type === 'animation' && $post->featured_animation_html_url) || $post->featured_image): ?>
                                    <div class="aspect-[16/9] overflow-hidden border-b border-white/10 bg-neutron-900">
                                        <?php echo $__env->make('site.partials.cms-visual',[
                                            'mediaType'=>$post->featured_media_type ?: 'image',
                                            'imageUrl'=>$post->featured_image,
                                            'animationUrl'=>$post->featured_animation_html_url,
                                            'alt'=>$post->featured_image_alt ?: $post->title,
                                            'imageClass'=>'h-full w-full object-cover transition duration-500 group-hover:scale-[1.03]',
                                            'animationClass'=>'pointer-events-none h-full w-full border-0',
                                        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                                    </div>
                                <?php else: ?>
                                    <div class="flex aspect-[16/9] items-center justify-center border-b border-white/10 bg-[radial-gradient(circle_at_50%_35%,rgba(47,143,255,.22),transparent_45%),linear-gradient(135deg,rgba(10,37,64,.75),rgba(3,12,24,.96))]">
                                        <svg class="h-10 w-10 text-neutron-300/60" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.3" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M5 4h14v16H5zM8 8h8M8 12h8M8 16h5"/></svg>
                                    </div>
                                <?php endif; ?>

                                <div class="p-6">
                                    <div class="flex flex-wrap items-center gap-x-3 gap-y-2 font-mono text-[10px] uppercase tracking-[0.13em] text-white/30">
                                        <span><?php echo e(($post->published_at ?? $post->created_at)->format('M j, Y')); ?></span>
                                        <?php if($post->author_name): ?><span>• <?php echo e($post->author_name); ?></span><?php endif; ?>
                                    </div>
                                    <h2 class="mt-4 text-xl font-medium leading-snug tracking-tight text-white transition group-hover:text-neutron-200"><?php echo e($post->title); ?></h2>
                                    <?php if($post->excerpt): ?>
                                        <p class="mt-3 line-clamp-3 text-sm leading-6 text-white/45"><?php echo e($post->excerpt); ?></p>
                                    <?php endif; ?>
                                    <span class="mt-5 inline-flex items-center gap-2 font-mono text-[10px] font-semibold uppercase tracking-wider text-neutron-300">Read article <span class="transition group-hover:translate-x-1">→</span></span>
                                </div>
                            </a>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <?php if($posts->hasPages()): ?>
                    <div class="mt-10 rounded-xl border border-white/10 bg-white/[0.02] p-4"><?php echo e($posts->links()); ?></div>
                <?php endif; ?>
            <?php else: ?>
                <div class="rounded-2xl border border-white/10 bg-white/[0.025] px-6 py-16 text-center">
                    <p class="neutron-kicker">Blog</p>
                    <h2 class="mt-3 text-2xl font-medium text-white">Articles are coming soon.</h2>
                    <p class="mt-3 text-sm text-white/40">New posts can be created and published from the admin panel.</p>
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
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\pages\blog.blade.php ENDPATH**/ ?>