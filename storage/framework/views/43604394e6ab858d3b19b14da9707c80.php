<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="text-2xl font-medium tracking-tight text-white">
            <?php echo e(__('Dashboard')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="neutron-panel overflow-hidden rounded-2xl p-8">
                <p class="neutron-kicker">Account ready</p>
                <h1 class="mt-4 text-3xl font-medium tracking-tight text-white">Welcome, <?php echo e(auth()->user()->name); ?>.</h1>
                <p class="mt-3 max-w-xl leading-7 text-white/45">Your A1 Legacy Labs account is active. Visit the website or update your profile and security settings.</p>
                <div class="mt-7 flex flex-wrap gap-3"><a href="<?php echo e(route('home')); ?>" class="rounded-lg bg-neutron-300 px-5 py-3 font-mono text-xs font-semibold uppercase tracking-wider text-neutron-950">Explore A1 Legacy Labs</a><a href="<?php echo e(route('profile.edit')); ?>" class="rounded-lg border border-white/10 px-5 py-3 font-mono text-xs font-semibold uppercase tracking-wider text-white/70">Profile settings</a></div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\dashboard.blade.php ENDPATH**/ ?>