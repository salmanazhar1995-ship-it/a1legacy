<?php if (isset($component)) { $__componentOriginalf2a1b2b34b0a376d40858ac9c2a946a5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf2a1b2b34b0a376d40858ac9c2a946a5 = $attributes; } ?>
<?php $component = App\View\Components\SiteLayout::resolve(['page' => $page,'navigationPages' => $navigationPages,'settings' => $settings,'documentTitle' => $gallery->seo_title ?: $gallery->title,'documentDescription' => $gallery->meta_description ?: $gallery->excerpt,'documentKeywords' => $gallery->meta_keywords,'documentImage' => $gallery->image_url,'documentImageAlt' => $gallery->image_alt ?: $gallery->title] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\SiteLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <section class="px-4 pb-24 pt-36 sm:px-6 sm:pt-40">
        <div class="mx-auto max-w-6xl">
            <a href="<?php echo e(route('gallery.index')); ?>" class="text-sm text-white/40">← Back to Gallery</a>
            <div class="a1-page-heading mt-8">
                <p class="neutron-kicker"><?php echo e($gallery->eyebrow?:$gallery->category); ?></p>
                <h1 class="mt-4 text-4xl font-semibold text-white sm:text-6xl"><?php echo e($gallery->title); ?></h1>
                <p class="mx-auto mt-5 max-w-2xl text-lg leading-7 text-white/55"><?php echo e($gallery->excerpt); ?></p>
            </div>
            <div class="mt-10 grid gap-10 lg:grid-cols-[1.2fr_.8fr] lg:items-start">
                <div class="overflow-hidden rounded-2xl border border-white/10 bg-[#07111d]" style="aspect-ratio: 16 / 11">
                    <?php if(($gallery->media_type === 'animation' && $gallery->animation_html_url) || $gallery->image_url): ?>
                        <?php echo $__env->make('site.partials.cms-visual',[
                            'mediaType'=>$gallery->media_type ?: 'image',
                            'imageUrl'=>$gallery->image_url,
                            'animationUrl'=>$gallery->animation_html_url,
                            'alt'=>$gallery->image_alt ?: $gallery->title,
                            'imageClass'=>'h-full w-full object-cover',
                            'animationClass'=>'pointer-events-none h-full w-full border-0',
                        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
                    <?php else: ?>
                        <div class="neutron-panel h-full w-full"></div>
                    <?php endif; ?>
                </div>
                <div>
                    <?php if($gallery->description): ?><div class="prose-a1 text-sm leading-7 text-white/48"><?php echo \App\Support\RichText::render($gallery->description); ?></div><?php endif; ?>
                    <?php if($gallery->client): ?><p class="mt-6 text-sm text-white/45">Client: <span class="text-white/70"><?php echo e($gallery->client); ?></span></p><?php endif; ?>
                    <?php if(collect($gallery->tags)->filter()->isNotEmpty()): ?><div class="mt-6 flex flex-wrap gap-2"><?php $__currentLoopData = $gallery->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><span class="rounded-full border border-white/10 px-3 py-1 text-xs text-white/45"><?php echo e($tag); ?></span><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div><?php endif; ?>
                </div>
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
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\pages\gallery-detail.blade.php ENDPATH**/ ?>