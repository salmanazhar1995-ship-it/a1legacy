<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?><main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8"><div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between"><div><p class="neutron-kicker">Inbox</p><h1 class="mt-2 text-3xl font-medium text-white">Consultation Requests</h1><p class="mt-2 text-sm text-white/40">Review AI & automation consultation requests submitted from the website.</p></div><div class="flex flex-wrap gap-2"><?php $__currentLoopData = [''=>'All','new'=>'New','in_progress'=>'In progress','resolved'=>'Resolved','spam'=>'Spam']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value=>$label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><a href="<?php echo e(route('admin.messages.index', $value ? ['status'=>$value] : [])); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['rounded-lg border px-3 py-2 text-xs','border-neutron-300/30 bg-neutron-500/10 text-neutron-100'=>($status??'')===$value,'border-white/10 text-white/45'=>($status??'')!==$value]); ?>"><?php echo e($label); ?></a><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></div></div><?php if(session('success')): ?><div class="mt-6 rounded-xl border border-emerald-300/20 bg-emerald-300/10 p-4 text-sm text-emerald-100"><?php echo e(session('success')); ?></div><?php endif; ?><section class="neutron-panel mt-8 overflow-hidden rounded-2xl p-4 sm:p-5"><div class="overflow-x-auto"><table class="js-yajra-table min-w-full" data-url="<?php echo e(route('admin.data.messages', ($status??'') ? ['status'=>$status] : [])); ?>" data-order-column="3" data-order-direction="desc"><thead><tr class="text-left font-mono text-[10px] uppercase tracking-wider text-white/35"><th data-data="sender" data-name="name">Sender</th><th data-data="request" data-name="industry">Industry / Request</th><th data-data="status_badge" data-name="status">Status</th><th data-data="received" data-name="created_at">Received</th><th data-data="actions" data-orderable="false" data-searchable="false" data-class="text-right">Actions</th></tr></thead></table></div></section></main> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\admin\messages\index.blade.php ENDPATH**/ ?>