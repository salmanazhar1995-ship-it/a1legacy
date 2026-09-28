<?php if (isset($component)) { $__componentOriginalf2a1b2b34b0a376d40858ac9c2a946a5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf2a1b2b34b0a376d40858ac9c2a946a5 = $attributes; } ?>
<?php $component = App\View\Components\SiteLayout::resolve(['page' => $page,'navigationPages' => $navigationPages,'settings' => $settings,'documentTitle' => $blogPost->seo_title ?: $blogPost->title,'documentDescription' => $blogPost->meta_description ?: ($blogPost->excerpt ?: str($blogPost->body)->squish()->limit(155)),'documentKeywords' => $blogPost->meta_keywords,'documentImage' => $blogPost->featured_image,'documentImageAlt' => $blogPost->featured_image_alt ?: $blogPost->title,'documentType' => 'article','documentPublishedTime' => ($blogPost->published_at ?? $blogPost->created_at)?->toIso8601String(),'documentModifiedTime' => $blogPost->updated_at?->toIso8601String()] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\SiteLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <article class="px-4 pb-24 pt-36 sm:px-6 sm:pb-32 sm:pt-44">
        <div class="mx-auto max-w-4xl">
            <a href="<?php echo e(route('blog.index')); ?>" class="inline-flex items-center gap-2 font-mono text-[10px] font-semibold uppercase tracking-[0.15em] text-neutron-300 transition hover:text-white">← Back to blog</a>

            <header class="mx-auto mt-8 max-w-4xl text-center">
                <div class="flex flex-wrap items-center justify-center gap-x-3 gap-y-2 font-mono text-[10px] uppercase tracking-[0.13em] text-white/30">
                    <span><?php echo e(($blogPost->published_at ?? $blogPost->created_at)->format('F j, Y')); ?></span>
                    <?php if($blogPost->author_name): ?><span>• <?php echo e($blogPost->author_name); ?></span><?php endif; ?>
                </div>
                <h1 class="mt-5 text-4xl font-medium leading-[1.05] tracking-[-0.04em] text-white sm:text-6xl"><?php echo e($blogPost->title); ?></h1>
                <?php if($blogPost->excerpt): ?>
                    <p class="mx-auto mt-6 max-w-3xl text-lg leading-8 text-white/50"><?php echo e($blogPost->excerpt); ?></p>
                <?php endif; ?>
            </header>

            <?php if(($blogPost->featured_media_type === 'animation' && $blogPost->featured_animation_html_url) || $blogPost->featured_image): ?>
                <div class="mt-10 aspect-video overflow-hidden rounded-2xl border border-white/10 bg-neutron-900 shadow-2xl shadow-black/25">
                    <?php echo $__env->make('site.partials.cms-visual',[
                        'mediaType'=>$blogPost->featured_media_type ?: 'image',
                        'imageUrl'=>$blogPost->featured_image,
                        'animationUrl'=>$blogPost->featured_animation_html_url,
                        'alt'=>$blogPost->featured_image_alt ?: $blogPost->title,
                        'imageClass'=>'h-full w-full object-cover',
                        'animationClass'=>'pointer-events-none h-full w-full border-0',
                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                </div>
            <?php endif; ?>

            <div class="prose-a1 mt-12 text-[17px] leading-8 text-white/65">
                <?php echo \App\Support\RichText::render($blogPost->body); ?>

            </div>

            <footer class="mt-14 border-t border-white/10 pt-8">
                <div class="flex flex-col gap-4 rounded-2xl border border-white/10 bg-white/[0.025] p-6 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="neutron-kicker">A1 Legacy</p>
                        <p class="mt-2 text-sm text-white/45">Ready to turn an idea into a working AI or automation system?</p>
                    </div>
                    <a href="<?php echo e(route('contact')); ?>" class="inline-flex justify-center rounded-lg bg-neutron-300 px-5 py-3 font-mono text-[11px] font-semibold uppercase tracking-wider text-neutron-950 transition hover:bg-white">Start a conversation</a>
                </div>
            </footer>
        </div>
    </article>
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
<?php /**PATH /home/u668568382/domains/a1legacylabs.com/laravel_app/resources/views/pages/blog-post.blade.php ENDPATH**/ ?>