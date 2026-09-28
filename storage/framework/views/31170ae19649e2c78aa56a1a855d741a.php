<?php
    /*
     |--------------------------------------------------------------------------
     | Runtime assets without a Vite manifest dependency
     |--------------------------------------------------------------------------
     | The compiled CSS/JS are bundled with the project under resources/runtime.
     | Keeping them inside the HTML prevents stale Vite hashes, missing build
     | files, public/hot leftovers, or a different web root from breaking CSS.
     */
    $runtimeCssPath = resource_path('runtime/app.css');
    $runtimeJsPath = resource_path('runtime/app.js');
?>

<?php if(is_file($runtimeCssPath)): ?>
    <style id="a1-runtime-css"><?php echo file_get_contents($runtimeCssPath); ?></style>
<?php else: ?>
    <link rel="stylesheet" href="<?php echo e(asset('assets/app.css')); ?>">
<?php endif; ?>

<?php if(is_file($runtimeJsPath)): ?>
    <script type="module" id="a1-runtime-js"><?php echo file_get_contents($runtimeJsPath); ?></script>
<?php else: ?>
    <script type="module" src="<?php echo e(asset('assets/app.js')); ?>"></script>
<?php endif; ?>
<?php /**PATH /home/u668568382/domains/a1legacylabs.com/laravel_app/resources/views/layouts/runtime-assets.blade.php ENDPATH**/ ?>