<?php
    $mediaType = $mediaType ?? 'image';
    $imageUrl = $imageUrl ?? null;
    $animationUrl = $animationUrl ?? null;
    $alt = $alt ?? '';
    $imageClass = $imageClass ?? 'h-full w-full object-cover';
    $animationClass = $animationClass ?? 'pointer-events-none h-full w-full border-0';
    $loading = $loading ?? 'lazy';
    $showAnimation = $mediaType === 'animation' && filled($animationUrl);
?>

<?php if($showAnimation): ?>
    <iframe
        src="<?php echo e($animationUrl); ?>"
        title="<?php echo e($alt !== '' ? $alt.' animation' : 'Animated visual'); ?>"
        class="<?php echo e($animationClass); ?>"
        sandbox="allow-scripts"
        loading="<?php echo e($loading); ?>"
        referrerpolicy="no-referrer"
        tabindex="-1"
        aria-hidden="true"
    ></iframe>
<?php elseif($imageUrl): ?>
    <img src="<?php echo e($imageUrl); ?>" alt="<?php echo e($alt); ?>" loading="<?php echo e($loading); ?>" class="<?php echo e($imageClass); ?>">
<?php endif; ?>
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\site\partials\cms-visual.blade.php ENDPATH**/ ?>