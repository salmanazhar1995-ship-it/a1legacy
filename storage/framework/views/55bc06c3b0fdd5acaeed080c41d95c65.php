<header x-data="{ open: false }" class="fixed inset-x-0 top-0 z-50 px-4 pt-4 sm:px-6">
    <nav class="mx-auto flex max-w-7xl items-center justify-between rounded-2xl border border-white/10 bg-neutron-950/75 px-4 py-3 shadow-2xl shadow-black/20 backdrop-blur-xl sm:px-5" aria-label="Main navigation">
        <a href="<?php echo e(route('home')); ?>" class="flex items-center gap-3">
            <?php if($settings->get('header_logo')): ?>
                <img src="<?php echo e($settings->get('header_logo')); ?>" alt="<?php echo e($settings->get('site_name', 'A1 Legacy Labs')); ?>" class="h-9 w-auto max-w-48 object-contain">
                <strong class="hidden text-sm font-semibold tracking-tight text-white sm:inline"><?php echo e($settings->get('site_name', 'A1 Legacy Labs')); ?></strong>
                <?php else: ?>
                <?php if (isset($component)) { $__componentOriginal8892e718f3d0d7a916180885c6f012e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8892e718f3d0d7a916180885c6f012e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.application-logo','data' => ['class' => 'h-9 w-9']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('application-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-9 w-9']); ?>
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
                <span class="font-mono text-sm font-semibold uppercase tracking-[0.16em] text-white"><?php echo e($settings->get('site_name', 'A1 Legacy Labs')); ?></span>
            <?php endif; ?>
        </a>

        <div class="hidden items-center gap-1 lg:flex">
            <?php $__currentLoopData = $navigationPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $navigationPage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(url($navigationPage->slug === 'home' ? '/' : '/'.$navigationPage->slug)); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'rounded-lg px-3 py-2 text-sm transition',
                    'bg-white/10 text-white' => $page->is($navigationPage),
                    'text-white/55 hover:bg-white/5 hover:text-white' => ! $page->is($navigationPage),
                ]); ?>"><?php echo e($navigationPage->navigation_label ?: $navigationPage->title); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <div class="hidden items-center gap-2 lg:flex">
            <?php if(auth()->guard()->check()): ?>
                <a href="<?php echo e(auth()->user()->is_admin ? route('admin.dashboard') : route('dashboard')); ?>" class="rounded-lg border border-white/10 px-4 py-2.5 font-mono text-[11px] font-semibold uppercase tracking-wider text-white/70 transition hover:bg-white/5 hover:text-white">Dashboard</a>
            <?php else: ?>
                <a href="<?php echo e(route('login')); ?>" class="rounded-lg px-4 py-2.5 font-mono text-[11px] font-semibold uppercase tracking-wider text-white/55 transition hover:text-white">Sign in</a>
            <?php endif; ?>
        </div>

        <button type="button" @click="open = ! open" class="rounded-lg border border-white/10 p-2 text-white/70 lg:hidden" aria-label="Toggle navigation" :aria-expanded="open.toString()">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16" /></svg>
        </button>

        <div x-show="open" x-cloak @click.outside="open = false" class="absolute inset-x-4 top-[76px] flex flex-col gap-1 rounded-2xl border border-white/10 bg-neutron-900 p-3 shadow-2xl lg:hidden">
            <?php $__currentLoopData = $navigationPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $navigationPage): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(url($navigationPage->slug === 'home' ? '/' : '/'.$navigationPage->slug)); ?>" class="rounded-lg px-3 py-3 text-sm text-white/70"><?php echo e($navigationPage->navigation_label ?: $navigationPage->title); ?></a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <div class="mt-2 border-t border-white/10 pt-2">
                <?php if(auth()->guard()->check()): ?>
                    <a href="<?php echo e(auth()->user()->is_admin ? route('admin.dashboard') : route('dashboard')); ?>" class="block rounded-lg bg-neutron-300 px-3 py-3 text-center text-sm font-medium text-neutron-950">Dashboard</a>
                <?php else: ?>
                    <a href="<?php echo e(route('login')); ?>" class="block rounded-lg px-3 py-3 text-sm text-white/70">Sign in</a>
                <?php endif; ?>
            </div>
        </div>
    </nav>
</header>
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\layouts\site-header.blade.php ENDPATH**/ ?>