<?php
    $customTypes = ['standard_content','content','custom_content','split_content','image_content','cards_grid','features_grid','stats','cta','faq','logo_strip','gallery_grid','video','rich_text'];
?>
<?php if(isset($page) && $page->relationLoaded('sections')): ?>
    <?php $__currentLoopData = $page->sections->whereIn('type', $customTypes); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php echo $__env->make('site.sections.renderer',['section'=>$section,'isHome'=>false,'settings'=>$settings ?? collect()], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\site\sections\custom-page-sections.blade.php ENDPATH**/ ?>