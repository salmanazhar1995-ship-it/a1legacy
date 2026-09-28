<?php
    $mediaTypeName = $mediaTypeName ?? 'media_type';
    $imageFileName = $imageFileName ?? 'image_file';
    $imageAltName = $imageAltName ?? 'image_alt';
    $animationFileName = $animationFileName ?? 'animation_html_file';
    $removeImageName = $removeImageName ?? 'remove_image';
    $removeAnimationName = $removeAnimationName ?? 'remove_animation';
    $currentMediaType = old($mediaTypeName, $currentMediaType ?? 'image');
    $currentImage = $currentImage ?? null;
    $currentImageAlt = old($imageAltName, $currentImageAlt ?? '');
    $currentAnimation = $currentAnimation ?? null;
    $title = $title ?? 'Visual media';
    $help = $help ?? 'Choose either a normal image or a self-contained HTML animation for this visual.';
    $idBase = preg_replace('/[^a-z0-9_-]+/i', '-', $mediaTypeName.'-'.$imageFileName);
?>

<div class="rounded-2xl border border-white/10 bg-white/[0.025] p-5" data-visual-media-picker data-has-current-image="<?php echo e($currentImage ? '1' : '0'); ?>" data-has-current-animation="<?php echo e($currentAnimation ? '1' : '0'); ?>">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
        <div>
            <p class="neutron-kicker">Media</p>
            <h3 class="mt-2 text-lg font-medium text-white"><?php echo e($title); ?></h3>
            <p class="mt-2 max-w-2xl text-xs leading-5 text-white/35"><?php echo e($help); ?></p>
        </div>
        <div class="inline-flex rounded-xl border border-white/10 bg-black/20 p-1" role="group" aria-label="Visual media type">
            <label class="cursor-pointer rounded-lg px-3 py-2 text-xs text-white/60 transition has-[:checked]:bg-neutron-300 has-[:checked]:font-semibold has-[:checked]:text-neutron-950">
                <input type="radio" name="<?php echo e($mediaTypeName); ?>" value="image" class="sr-only" <?php if($currentMediaType !== 'animation'): echo 'checked'; endif; ?> data-media-type-radio>
                Image
            </label>
            <label class="cursor-pointer rounded-lg px-3 py-2 text-xs text-white/60 transition has-[:checked]:bg-neutron-300 has-[:checked]:font-semibold has-[:checked]:text-neutron-950">
                <input type="radio" name="<?php echo e($mediaTypeName); ?>" value="animation" class="sr-only" <?php if($currentMediaType === 'animation'): echo 'checked'; endif; ?> data-media-type-radio>
                HTML animation
            </label>
        </div>
    </div>

    <div class="mt-5 grid gap-5 lg:grid-cols-2">
        <div class="rounded-xl border border-white/10 bg-black/10 p-4" data-media-panel="image">
            <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['for' => $idBase.'-image','value' => 'Upload image']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($idBase.'-image'),'value' => 'Upload image']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
            <?php if($currentImage): ?>
                <div class="mt-3 flex min-h-32 items-center justify-center overflow-hidden rounded-xl border border-white/10 bg-black/20 p-3">
                    <img src="<?php echo e($currentImage); ?>" alt="<?php echo e($currentImageAlt ?: 'Current uploaded image'); ?>" class="max-h-64 w-auto max-w-full object-contain">
                </div>
                <label class="mt-3 flex items-center gap-2 text-xs text-red-200/80">
                    <input type="checkbox" name="<?php echo e($removeImageName); ?>" value="1" class="rounded border-white/15 bg-white/5 text-red-400">
                    Remove current image
                </label>
            <?php endif; ?>
            <input id="<?php echo e($idBase); ?>-image" name="<?php echo e($imageFileName); ?>" type="file" accept="image/jpeg,image/png,image/webp,image/avif" class="mt-3 block w-full" data-media-image-input>
            <p class="mt-2 text-xs text-white/35">JPG, PNG, WebP or AVIF. Maximum 5 MB.</p>
            <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['class' => 'mt-2','messages' => $errors->get($imageFileName)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-2','messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get($imageFileName))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>

            <div class="mt-4 rounded-xl border border-neutron-300/15 bg-neutron-500/[0.05] p-3.5">
                <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['for' => $idBase.'-alt','value' => 'Image ALT text (required for SEO)']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($idBase.'-alt'),'value' => 'Image ALT text (required for SEO)']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
                <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => ''.e($idBase).'-alt','name' => ''.e($imageAltName).'','class' => 'mt-2 block w-full','value' => $currentImageAlt,'maxlength' => '255','placeholder' => 'Describe the image clearly for search engines and screen readers','dataMediaImageAlt' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => ''.e($idBase).'-alt','name' => ''.e($imageAltName).'','class' => 'mt-2 block w-full','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($currentImageAlt),'maxlength' => '255','placeholder' => 'Describe the image clearly for search engines and screen readers','data-media-image-alt' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
                <p class="mt-2 text-xs leading-5 text-white/35">Required whenever an image is used. Keep it natural, specific and descriptive; do not keyword-stuff.</p>
                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['class' => 'mt-2','messages' => $errors->get($imageAltName)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-2','messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get($imageAltName))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
            </div>
        </div>

        <div class="rounded-xl border border-white/10 bg-black/10 p-4" data-media-panel="animation">
            <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['for' => $idBase.'-animation','value' => 'Upload HTML animation (required when HTML animation is selected)']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($idBase.'-animation'),'value' => 'Upload HTML animation (required when HTML animation is selected)']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
            <?php if($currentAnimation): ?>
                <div class="mt-3 overflow-hidden rounded-xl border border-white/10 bg-neutron-950">
                    <iframe src="<?php echo e($currentAnimation); ?>" title="Current HTML animation preview" class="pointer-events-none aspect-video w-full border-0" sandbox="allow-scripts" loading="lazy" referrerpolicy="no-referrer"></iframe>
                </div>
                <label class="mt-3 flex items-center gap-2 text-xs text-red-200/80">
                    <input type="checkbox" name="<?php echo e($removeAnimationName); ?>" value="1" class="rounded border-white/15 bg-white/5 text-red-400">
                    Remove current animation
                </label>
            <?php endif; ?>
            <input id="<?php echo e($idBase); ?>-animation" name="<?php echo e($animationFileName); ?>" type="file" accept=".html,.htm,text/html" data-file-kind="animation-html" data-media-animation-input class="mt-3 block w-full">
            <p class="mt-2 text-xs leading-5 text-white/35">Upload a self-contained <strong>.html/.htm</strong> animation up to 5 MB. Inline CSS/JS is supported and rendered in a sandboxed iframe. TXT files are not accepted.</p>
            <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['class' => 'mt-2','messages' => $errors->get($animationFileName)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-2','messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get($animationFileName))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
        </div>
    </div>
</div>
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\admin\partials\image-animation-fields.blade.php ENDPATH**/ ?>