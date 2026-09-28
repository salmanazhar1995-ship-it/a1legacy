<?php if (isset($component)) { $__componentOriginalf2a1b2b34b0a376d40858ac9c2a946a5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf2a1b2b34b0a376d40858ac9c2a946a5 = $attributes; } ?>
<?php $component = App\View\Components\SiteLayout::resolve(['page' => $page,'navigationPages' => $navigationPages,'settings' => $settings] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\SiteLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php ($hero=$page->sections()->where('key','hero')->first()); ?><section class="px-4 pb-14 pt-36 sm:px-6 sm:pt-40"><div class="a1-page-heading"><p class="neutron-kicker"><?php echo e($hero?->eyebrow?:'Selected work'); ?></p><h1 class="mt-5 text-4xl font-semibold text-white sm:text-6xl"><?php echo e($hero?->heading?:'Gallery'); ?></h1><p class="mx-auto mt-6 max-w-2xl text-lg leading-7 text-white/55"><?php echo e($hero?->body?:'Explore selected A1 Legacy work.'); ?></p></div></section><section class="px-4 pb-24 sm:px-6"><div class="mx-auto max-w-7xl"><?php if($galleries->isEmpty()): ?><div class="neutron-panel rounded-2xl p-8 text-white/50">Gallery items will appear here when published.</div><?php else: ?><div class="grid gap-5 md:grid-cols-2 lg:grid-cols-3"><?php $__currentLoopData = $galleries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $g): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><a href="<?php echo e(route('gallery.show',$g)); ?>" class="group neutron-panel overflow-hidden rounded-2xl"><div class="bg-neutron-950" style="aspect-ratio:4/3"><?php if(($g->media_type === 'animation' && $g->animation_html_url) || $g->image_url): ?> <?php echo $__env->make('site.partials.cms-visual',['mediaType'=>$g->media_type ?: 'image','imageUrl'=>$g->image_url,'animationUrl'=>$g->animation_html_url,'alt'=>$g->image_alt ?: $g->title,'imageClass'=>'h-full w-full object-cover','animationClass'=>'pointer-events-none h-full w-full border-0'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php endif; ?></div><div class="p-5"><?php if($g->category): ?><p class="font-mono text-[9px] uppercase text-neutron-300"><?php echo e($g->category); ?></p><?php endif; ?><h2 class="mt-3 text-xl font-semibold text-white"><?php echo e($g->title); ?></h2><p class="mt-3 text-sm leading-6 text-white/45"><?php echo e($g->excerpt); ?></p><span class="mt-5 inline-flex text-xs text-neutron-200">View gallery detail →</span></div></a><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div><?php endif; ?></div></section>    <?php echo $__env->make('site.sections.custom-page-sections',['page'=>$page,'settings'=>$settings], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
<?php /**PATH /home/u668568382/domains/a1legacylabs.com/laravel_app/resources/views/pages/gallery.blade.php ENDPATH**/ ?>