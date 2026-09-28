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
    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <p class="neutron-kicker">Content &amp; navigation</p>
                <h1 class="mt-3 text-3xl font-medium tracking-tight">Pages &amp; Navbar</h1>
                <p class="mt-2 max-w-2xl text-sm text-white/40">Create pages, add navbar tabs, and control whether every page and navigation item is enabled or disabled.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="<?php echo e(route('home')); ?>" target="_blank" class="rounded-lg border border-white/10 px-4 py-2.5 text-sm text-white/65">Open website ↗</a>
                <a href="<?php echo e(route('admin.pages.create')); ?>" class="rounded-lg bg-neutron-300 px-4 py-2.5 text-sm font-semibold text-neutron-950">+ Create Navbar Page</a>
            </div>
        </div>

        <?php if(session('success')): ?><div class="mt-6 rounded-xl border border-emerald-300/20 bg-emerald-300/10 p-4 text-sm text-emerald-200"><?php echo e(session('success')); ?></div><?php endif; ?>

        <div class="mt-6 grid gap-3 sm:grid-cols-3">
            <div class="rounded-xl border border-white/10 bg-white/[0.025] p-4"><p class="font-mono text-[9px] uppercase tracking-[.16em] text-white/30">Page switch</p><p class="mt-2 text-sm text-white/70">Enable or disable any public page.</p></div>
            <div class="rounded-xl border border-white/10 bg-white/[0.025] p-4"><p class="font-mono text-[9px] uppercase tracking-[.16em] text-white/30">Navbar switch</p><p class="mt-2 text-sm text-white/70">Show or hide its navigation tab independently.</p></div>
            <div class="rounded-xl border border-white/10 bg-white/[0.025] p-4"><p class="font-mono text-[9px] uppercase tracking-[.16em] text-white/30">Page builder</p><p class="mt-2 text-sm text-white/70">Create, hide and reorder sections per page.</p></div>
        </div>

        <section class="neutron-panel mt-8 overflow-hidden rounded-2xl p-4 sm:p-5">
            <div class="overflow-x-auto">
                <table class="js-yajra-table min-w-full" data-url="<?php echo e(route('admin.data.pages')); ?>" data-order-column="0" data-order-direction="asc">
                    <thead><tr class="text-left font-mono text-[10px] uppercase tracking-wider text-white/35"><th data-data="page" data-name="title">Page</th><th data-data="template" data-name="template">Template</th><th data-data="sections_count" data-name="sections_count" data-searchable="false">Sections</th><th data-data="status" data-name="is_published" data-searchable="false">Status</th><th data-data="actions" data-orderable="false" data-searchable="false" data-class="text-right">Actions</th></tr></thead>
                </table>
            </div>
        </section>
    </main>
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
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\admin\pages\index.blade.php ENDPATH**/ ?>