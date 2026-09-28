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
        <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
            <div>
                <p class="neutron-kicker">Industry structure</p>
                <h1 class="mt-2 text-3xl font-medium tracking-tight text-white">Main Industries</h1>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-white/40">Create the first-level industries shown on the homepage. Add their detailed entries from Sub Industries.</p>
            </div>
            <div class="flex flex-wrap gap-3">
                <a href="<?php echo e(route('admin.industries.import-template')); ?>" class="inline-flex items-center justify-center rounded-xl border border-white/10 px-4 py-3 text-sm text-white/60 transition hover:bg-white/5 hover:text-white">Download CSV template</a>
                <a href="<?php echo e(route('admin.industries.create')); ?>" class="inline-flex items-center justify-center rounded-xl bg-neutron-300 px-5 py-3 text-sm font-semibold text-neutron-950 transition hover:bg-white">+ Add Main Industry</a>
            </div>
        </div>

        <?php if(session('success')): ?>
            <div class="mt-6 rounded-xl border border-emerald-300/20 bg-emerald-300/10 p-4 text-sm text-emerald-100"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if($errors->any()): ?>
            <div class="mt-6 rounded-xl border border-red-300/20 bg-red-500/10 p-4 text-sm text-red-100"><?php echo e($errors->first()); ?></div>
        <?php endif; ?>

        <section class="neutron-panel mt-8 rounded-2xl p-5 sm:p-6">
            <div class="flex flex-col gap-5 lg:flex-row lg:items-end lg:justify-between">
                <div>
                    <p class="neutron-kicker">Bulk import</p>
                    <h2 class="mt-2 text-lg font-medium text-white">Import main industries, sub industries and details</h2>
                    <p class="mt-2 max-w-2xl text-xs leading-5 text-white/35">Use the CSV template exactly as provided. Standard comma CSV, Excel tab-separated CSV and semicolon-separated CSV are accepted. Separate multiple highlights with a vertical bar (|). Existing matching rows are updated safely.</p>
                    <p class="mt-2 inline-flex rounded-full border border-neutron-300/15 bg-neutron-500/[0.06] px-3 py-1 font-mono text-[10px] uppercase tracking-[.12em] text-neutron-200/75">No row limit — import the full CSV in one file</p>
                </div>
                <form method="POST" enctype="multipart/form-data" action="<?php echo e(route('admin.industries.import')); ?>" class="flex w-full flex-col gap-3 sm:flex-row lg:w-auto">
                    <?php echo csrf_field(); ?>
                    <input type="file" name="import_file" accept=".csv,text/csv,text/plain,text/tab-separated-values" data-file-kind="csv" required class="block min-w-0 flex-1 rounded-xl border border-white/10 bg-white/[0.04] text-sm text-white/55 file:mr-4 file:border-0 file:bg-neutron-500/15 file:px-4 file:py-3 file:text-xs file:font-semibold file:text-neutron-200">
                    <button type="submit" class="rounded-xl border border-neutron-300/20 bg-neutron-500/10 px-5 py-3 text-sm font-semibold text-neutron-200 transition hover:bg-neutron-500/20">Import File</button>
                </form>
            </div>
            <div class="mt-5 rounded-xl border border-neutron-300/10 bg-neutron-500/[0.04] p-4">
                <p class="font-mono text-[9px] uppercase tracking-[.16em] text-neutron-300/70">Quick CSV format</p>
                <p class="mt-2 text-xs leading-5 text-white/45">For a simple import, use exactly these three headings. Add one sub industry per row and repeat the main industry name when it has multiple sub industries.</p>
                <code class="mt-3 block overflow-x-auto rounded-lg border border-white/[0.07] bg-black/20 px-4 py-3 text-xs text-neutron-200">main_industry,sub_industry,detail</code>
                <code class="mt-2 block overflow-x-auto rounded-lg border border-white/[0.07] bg-black/20 px-4 py-3 text-xs text-white/45">Insurance,Claims Operations,"Automate claims intake and customer updates."</code>
                <p class="mt-3 text-[11px] leading-5 text-white/30">Use “Download CSV template” when you also need slugs, descriptions, highlights, links, status and sorting.</p>
            </div>
        </section>

        <section class="neutron-panel mt-6 overflow-hidden rounded-2xl">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-white/[0.07]">
                    <thead class="bg-white/[0.025]">
                        <tr class="text-left font-mono text-[10px] uppercase tracking-wider text-white/35">
                            <th class="px-6 py-4">Main Industry</th><th class="px-6 py-4">Sub Industries</th><th class="px-6 py-4">Status</th><th class="px-6 py-4">Order</th><th class="px-6 py-4 text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/[0.06]">
                        <?php $__empty_1 = true; $__currentLoopData = $industries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $industry): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="px-6 py-4"><p class="font-medium text-white"><?php echo e($industry->name); ?></p><p class="mt-1 font-mono text-[10px] text-white/30"><?php echo e($industry->slug); ?></p></td>
                                <td class="px-6 py-4 text-sm text-white/50"><?php echo e($industry->sub_industries_count); ?></td>
                                <td class="px-6 py-4"><span class="<?php echo \Illuminate\Support\Arr::toCssClasses(['inline-flex rounded-full border px-2.5 py-1 font-mono text-[8px] uppercase tracking-wider', 'border-emerald-300/15 bg-emerald-300/10 text-emerald-100' => $industry->is_active, 'border-white/10 bg-white/5 text-white/45' => ! $industry->is_active]); ?>"><?php echo e($industry->is_active ? 'Visible' : 'Hidden'); ?></span></td>
                                <td class="px-6 py-4 text-sm text-white/45"><?php echo e($industry->sort_order); ?></td>
                                <td class="px-6 py-4"><?php echo $__env->make('admin.partials.table-actions', ['editUrl' => route('admin.industries.edit', $industry), 'deleteUrl' => route('admin.industries.destroy', $industry), 'deleteLabel' => 'this main industry'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr><td colspan="5" class="px-6 py-12 text-center text-sm text-white/35">No main industries yet. Add one or import the CSV template.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </section>
        <div class="mt-6"><?php echo e($industries->links()); ?></div>
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
<?php /**PATH /home/u668568382/domains/a1legacylabs.com/laravel_app/resources/views/admin/industries/index.blade.php ENDPATH**/ ?>