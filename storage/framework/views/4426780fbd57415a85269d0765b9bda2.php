<div class="flex items-center justify-end gap-2 whitespace-nowrap">
    <?php if(isset($viewUrl)): ?>
        <?php if($viewUrl): ?>
            <a href="<?php echo e($viewUrl); ?>" <?php if(!empty($viewExternal)): ?> target="_blank" rel="noopener noreferrer" <?php endif; ?> class="rounded-lg border border-white/10 px-3 py-2 text-xs text-white/55 transition hover:bg-white/5 hover:text-white">View</a>
        <?php endif; ?>
    <?php endif; ?>

    <?php if(isset($editUrl)): ?>
        <?php if($editUrl): ?>
            <a href="<?php echo e($editUrl); ?>" class="rounded-lg border border-neutron-300/20 px-3 py-2 text-xs text-neutron-200 transition hover:bg-neutron-500/10 hover:text-white">Edit</a>
        <?php endif; ?>
    <?php endif; ?>

    <?php if(isset($deleteUrl)): ?>
        <?php if($deleteUrl): ?>
            <form method="POST" action="<?php echo e($deleteUrl); ?>" class="inline js-delete-form" data-delete-label="<?php echo e($deleteLabel ?? 'this record'); ?>">
                <?php echo csrf_field(); ?>
                <?php echo method_field('DELETE'); ?>
                <button type="submit" class="rounded-lg border border-red-300/15 px-3 py-2 text-xs text-red-200 transition hover:bg-red-500/10">Delete</button>
            </form>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?php /**PATH /home/u668568382/domains/a1legacylabs.com/laravel_app/resources/views/admin/partials/table-actions.blade.php ENDPATH**/ ?>