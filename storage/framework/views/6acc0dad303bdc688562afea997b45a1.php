<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e($settings->get('site_name', config('app.name', 'A1 Legacy Labs'))); ?> — <?php echo e(__('Account')); ?></title>
        <?php if($settings->get('favicon')): ?>
            <link rel="icon" href="<?php echo e($settings->get('favicon')); ?>">
            <link rel="shortcut icon" href="<?php echo e($settings->get('favicon')); ?>">
        <?php endif; ?>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600&amp;family=Geist+Mono:wght@400;500;600&amp;display=swap" rel="stylesheet">

        <?php echo $__env->make('layouts.runtime-assets', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    </head>
    <body class="font-sans">
        <div class="neutron-grid relative flex min-h-screen flex-col items-center justify-center overflow-hidden px-4 py-10">
            <div class="pointer-events-none absolute left-1/2 top-0 h-[520px] w-[720px] -translate-x-1/2 rounded-full bg-neutron-500/15 blur-[130px]"></div>

            <div class="relative z-10 mb-8">
                <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-3" aria-label="<?php echo e($settings->get('site_name', 'A1 Legacy Labs')); ?> home">
                    <?php if($settings->get('header_logo')): ?>
                        <img src="<?php echo e($settings->get('header_logo')); ?>" alt="<?php echo e($settings->get('site_name', 'A1 Legacy Labs')); ?>" class="max-h-12 w-auto max-w-48 object-contain">
                    <?php else: ?>
                        <?php if (isset($component)) { $__componentOriginal8892e718f3d0d7a916180885c6f012e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8892e718f3d0d7a916180885c6f012e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.application-logo','data' => ['class' => 'h-10 w-10']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('application-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-10 w-10']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $attributes = $__attributesOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $component = $__componentOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__componentOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
                    <?php endif; ?>
                    <span class="font-mono text-sm font-semibold uppercase tracking-[0.16em] text-white"><?php echo e($settings->get('site_name', 'A1 Legacy Labs')); ?></span>
                </a>
            </div>

            <div class="neutron-panel relative z-10 w-full overflow-hidden rounded-2xl p-6 shadow-2xl shadow-black/40 sm:max-w-md sm:p-8">
                <div class="mb-7 border-b border-white/10 pb-6">
                    <p class="neutron-kicker">Secure workspace</p>
                    <h1 class="mt-3 text-2xl font-medium tracking-tight text-white">Welcome to <?php echo e($settings->get('site_name', 'A1 Legacy Labs')); ?></h1>
                    <p class="mt-2 text-sm leading-6 text-white/45">Sign in to access your operations dashboard.</p>
                </div>

                <div class="auth-panel">
                    <?php echo e($slot); ?>

                </div>
            </div>

            <a href="<?php echo e(route('home')); ?>" class="neutron-link relative z-10 mt-7">← Back to website</a>
        </div>
    </body>
</html>
<?php /**PATH /home/u668568382/domains/a1legacylabs.com/laravel_app/resources/views/layouts/guest.blade.php ENDPATH**/ ?>