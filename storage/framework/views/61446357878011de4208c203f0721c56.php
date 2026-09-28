<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

        <title><?php echo e($settings->get('site_name', config('app.name', 'A1 Legacy Labs'))); ?> — <?php echo e(__('Dashboard')); ?></title>
        <?php if($settings->get('favicon')): ?>
            <link rel="icon" href="<?php echo e($settings->get('favicon')); ?>">
            <link rel="shortcut icon" href="<?php echo e($settings->get('favicon')); ?>">
        <?php endif; ?>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600&amp;family=Geist+Mono:wght@400;500;600&amp;display=swap" rel="stylesheet">

        <!-- Scripts -->
        <?php echo $__env->make('layouts.runtime-assets', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php if(request()->routeIs('admin.*')): ?>
            <?php echo $__env->make('layouts.admin-enhancements', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
        <?php endif; ?>
    </head>
    <body class="font-sans">
        <?php if(request()->routeIs('admin.*')): ?>
            <div x-data="{ sidebarOpen: false }" class="neutron-grid min-h-screen bg-neutron-950">
                <?php echo $__env->make('layouts.admin-sidebar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <div class="min-h-screen lg:pl-72">
                    <header class="sticky top-0 z-30 flex h-16 items-center justify-between border-b border-white/10 bg-neutron-950/90 px-4 backdrop-blur-xl lg:hidden">
                        <button type="button" @click="sidebarOpen = true" class="rounded-lg border border-white/10 bg-white/[0.04] p-2.5 text-white/70 transition hover:bg-white/[0.08] hover:text-white" aria-label="Open admin sidebar">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                <path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16" />
                            </svg>
                        </button>
                        <div class="flex items-center gap-2.5">
                            <?php if($settings->get('header_logo')): ?>
                                <img src="<?php echo e($settings->get('header_logo')); ?>" alt="<?php echo e($settings->get('site_name', config('app.name', 'A1 Legacy Labs'))); ?>" class="max-h-8 w-auto max-w-28 object-contain">
                            <?php else: ?>
                                <?php if (isset($component)) { $__componentOriginal8892e718f3d0d7a916180885c6f012e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8892e718f3d0d7a916180885c6f012e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.application-logo','data' => ['class' => 'h-8 w-8']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('application-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-8 w-8']); ?>
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
                            <span class="font-mono text-xs font-semibold uppercase tracking-[0.16em] text-white">Admin panel</span>
                        </div>
                        <a href="<?php echo e(route('home')); ?>" target="_blank" class="rounded-lg border border-white/10 bg-white/[0.04] p-2.5 text-white/60 transition hover:text-white" aria-label="View website">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M14 5h5v5m0-5-8 8M19 13v5a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h5" />
                            </svg>
                        </a>
                    </header>

                    <?php if(isset($header)): ?>
                        <header class="border-b border-white/5 bg-neutron-950/70">
                            <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                                <?php echo e($header); ?>

                            </div>
                        </header>
                    <?php endif; ?>

                    <?php if (! (request()->routeIs('admin.dashboard'))): ?>
                        <?php
                            $previousUrl = url()->previous();
                            $adminRoot = rtrim(url('/admin'), '/');
                            $backUrl = str_starts_with($previousUrl, $adminRoot) && $previousUrl !== url()->current()
                                ? $previousUrl
                                : route('admin.dashboard');
                        ?>
                        <div class="border-b border-white/[0.06] bg-neutron-950/60 px-4 py-3 sm:px-6 lg:px-8">
                            <div class="mx-auto flex max-w-7xl items-center justify-between gap-4">
                                <a href="<?php echo e($backUrl); ?>" class="inline-flex items-center gap-2 rounded-lg border border-white/10 bg-white/[0.03] px-3 py-2 text-sm text-white/60 transition hover:bg-white/[0.06] hover:text-white">
                                    <span aria-hidden="true">←</span> Back
                                </a>
                                <a href="<?php echo e(route('admin.dashboard')); ?>" class="font-mono text-[10px] uppercase tracking-[0.14em] text-white/30 transition hover:text-white/60">Admin home</a>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div>
                        <?php echo e($slot); ?>

                    </div>
                </div>
            </div>
        <?php else: ?>
            <div class="neutron-grid min-h-screen bg-neutron-950">
                <?php echo $__env->make('layouts.navigation', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

                <?php if(isset($header)): ?>
                    <header class="border-b border-white/5 bg-neutron-950/70">
                        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
                            <?php echo e($header); ?>

                        </div>
                    </header>
                <?php endif; ?>

                <main>
                    <?php echo e($slot); ?>

                </main>
            </div>
        <?php endif; ?>
    </body>
</html>
<?php /**PATH /home/u668568382/domains/a1legacylabs.com/laravel_app/resources/views/layouts/app.blade.php ENDPATH**/ ?>