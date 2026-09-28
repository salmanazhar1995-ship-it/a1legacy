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
<?php ($workflowProofRendered=false); ?> <?php ($coreProductsRendered=false); ?> <?php ($clientStoriesRendered=false); ?> <?php ($galleryRendered=false); ?>
<?php $__currentLoopData = $page->sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php ($legacyPlatformSection = $page->slug === 'home' && (str_contains(strtolower((string) $section->heading), 'everything connected') || in_array($section->key, ['platform','platforms','platform-overview','platform-features'], true))); ?>
    <?php if($legacyPlatformSection): ?> <?php continue; ?> <?php endif; ?>
    <?php if($page->slug==='home' && $section->key==='core-products'): ?> <?php if(!$coreProductsRendered): ?> <?php echo $__env->make('site.sections.core-products',['products'=>$featuredProducts??collect()], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php ($coreProductsRendered=true); ?> <?php endif; ?> <?php continue; ?> <?php endif; ?>
    <?php if($page->slug==='home' && $section->type==='client_stories'): ?>
        <?php if(!$workflowProofRendered): ?> <?php echo $__env->make('site.sections.workflow-proof', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php ($workflowProofRendered=true); ?> <?php endif; ?>
        <?php echo $__env->make('site.sections.client-stories',['section'=>$section,'stories'=>$featuredClientStories??collect()], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php ($clientStoriesRendered=true); ?> <?php continue; ?>
    <?php endif; ?>
    <?php if($page->slug==='home' && $section->type==='gallery_showcase'): ?>
        <?php if(!$workflowProofRendered): ?> <?php echo $__env->make('site.sections.workflow-proof', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php ($workflowProofRendered=true); ?> <?php endif; ?>
        <?php if(!$clientStoriesRendered): ?> <?php echo $__env->make('site.sections.client-stories',['section'=>null,'stories'=>$featuredClientStories??collect()], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php ($clientStoriesRendered=true); ?> <?php endif; ?>
        <?php echo $__env->make('site.sections.gallery-showcase',['section'=>$section,'galleries'=>$featuredGalleries??collect()], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php ($galleryRendered=true); ?> <?php continue; ?>
    <?php endif; ?>
    <?php if($page->slug==='home' && !$coreProductsRendered && in_array($section->type,['testimonials','pricing','faq','cta'],true)): ?> <?php echo $__env->make('site.sections.core-products',['products'=>$featuredProducts??collect()], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php ($coreProductsRendered=true); ?> <?php endif; ?>
    <?php if($page->slug==='home' && in_array($section->type,['testimonials','pricing','faq','cta'],true)): ?>
        <?php if(!$workflowProofRendered): ?> <?php echo $__env->make('site.sections.workflow-proof', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php ($workflowProofRendered=true); ?> <?php endif; ?>
        <?php if(!$clientStoriesRendered): ?> <?php echo $__env->make('site.sections.client-stories',['section'=>null,'stories'=>$featuredClientStories??collect()], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php ($clientStoriesRendered=true); ?> <?php endif; ?>
        <?php if(!$galleryRendered): ?> <?php echo $__env->make('site.sections.gallery-showcase',['section'=>null,'galleries'=>$featuredGalleries??collect()], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php ($galleryRendered=true); ?> <?php endif; ?>
    <?php endif; ?>
    <?php echo $__env->make('site.sections.renderer',['section'=>$section,'isHome'=>$page->slug==='home','settings'=>$settings,'platforms'=>$platforms??collect(),'industries'=>$industries??collect()], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php if($page->slug==='home' && !$coreProductsRendered): ?> <?php echo $__env->make('site.sections.core-products',['products'=>$featuredProducts??collect()], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php endif; ?>
<?php if($page->slug==='home' && !$workflowProofRendered): ?> <?php echo $__env->make('site.sections.workflow-proof', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php endif; ?>
<?php if($page->slug==='home' && !$clientStoriesRendered): ?> <?php echo $__env->make('site.sections.client-stories',['section'=>null,'stories'=>$featuredClientStories??collect()], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php endif; ?>
<?php if($page->slug==='home' && !$galleryRendered): ?> <?php echo $__env->make('site.sections.gallery-showcase',['section'=>null,'galleries'=>$featuredGalleries??collect()], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?> <?php endif; ?>
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
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\site\page.blade.php ENDPATH**/ ?>