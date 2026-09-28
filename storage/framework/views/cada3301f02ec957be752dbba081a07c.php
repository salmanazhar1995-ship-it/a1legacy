<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8"><div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between"><div><p class="neutron-kicker">Core Products</p><h1 class="mt-2 text-3xl font-medium tracking-tight text-white">Core Products</h1><p class="mt-2 text-sm text-white/40">Manage product cards, detail pages, images and homepage visibility.</p></div><a href="<?php echo e(route('admin.products.create')); ?>" class="rounded-lg bg-neutron-300 px-4 py-2.5 text-sm font-semibold text-neutron-950">+ Add Product</a></div><?php if(session('success')): ?><div class="mt-6 rounded-xl border border-emerald-300/20 bg-emerald-300/10 p-4 text-sm text-emerald-100"><?php echo e(session('success')); ?></div><?php endif; ?><section class="neutron-panel mt-8 overflow-hidden rounded-2xl p-4 sm:p-5"><div class="overflow-x-auto"><table class="js-yajra-table min-w-full" data-url="<?php echo e(route('admin.data.products')); ?>" data-order-column="2" data-order-direction="asc"><thead><tr class="text-left font-mono text-[10px] uppercase tracking-wider text-white/35"><th data-data="product" data-name="title">Product</th><th data-data="status" data-name="is_active" data-searchable="false">Status</th><th data-data="sort_order" data-name="sort_order">Order</th><th data-data="actions" data-orderable="false" data-searchable="false" data-class="text-right">Actions</th></tr></thead></table></div></section></main> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\admin\products\index.blade.php ENDPATH**/ ?>