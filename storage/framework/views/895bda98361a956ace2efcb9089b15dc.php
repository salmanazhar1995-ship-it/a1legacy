<?php if (isset($component)) { $__componentOriginalf2a1b2b34b0a376d40858ac9c2a946a5 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf2a1b2b34b0a376d40858ac9c2a946a5 = $attributes; } ?>
<?php $component = App\View\Components\SiteLayout::resolve(['page' => $page,'navigationPages' => $navigationPages,'settings' => $settings] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('site-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\SiteLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><?php ($hero=$page->sections()->where('key','hero')->first()); ?><section class="px-4 pb-14 pt-36 sm:px-6 sm:pt-40"><div class="a1-page-heading"><p class="neutron-kicker"><?php echo e($hero?->eyebrow?:'Real client proof'); ?></p><h1 class="mt-5 text-4xl font-semibold tracking-tight text-white sm:text-6xl"><?php echo e($hero?->heading?:'Client Stories'); ?></h1><p class="mx-auto mt-6 max-w-2xl text-lg leading-7 text-white/55"><?php echo e($hero?->body?:'Real businesses using A1 Legacy systems, shared with client approval.'); ?></p></div></section><section class="px-4 pb-24 sm:px-6"><div class="mx-auto max-w-7xl"><?php if($stories->isEmpty()): ?><div class="neutron-panel rounded-2xl p-8 text-white/50">Approved client stories will appear here as they are added.</div><?php else: ?><div class="grid gap-5 lg:grid-cols-2"><?php $__currentLoopData = $stories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $story): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><article class="neutron-panel rounded-2xl p-5 sm:p-6"><h2 class="text-xl font-semibold text-white"><?php echo e($story->person_name); ?></h2><p class="mt-1 text-sm font-medium text-neutron-200"><?php echo e($story->business_name); ?></p><?php if($story->role): ?><p class="mt-1 mb-5 text-sm text-white/40"><?php echo e($story->role); ?></p><?php else: ?><div class="mb-5"></div><?php endif; ?> <?php echo $__env->make('site.partials.client-story-video',['story'=>$story], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php if($story->implementation_label): ?><p class="mt-5 border-t border-white/[0.08] pt-4 font-mono text-[10px] uppercase tracking-wider text-white/45"><span class="text-neutron-300">Implemented:</span> <?php echo e($story->implementation_label); ?></p><?php endif; ?> <?php if($story->approved_quote): ?><blockquote class="mt-4 text-sm leading-6 text-white/50">“<?php echo e($story->approved_quote); ?>”</blockquote><?php endif; ?></article><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div><?php endif; ?></div></section>    <?php echo $__env->make('site.sections.custom-page-sections',['page'=>$page,'settings'=>$settings], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\pages\client-stories.blade.php ENDPATH**/ ?>