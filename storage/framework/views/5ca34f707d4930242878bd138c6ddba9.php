<?php
    $leadConnector = config('services.leadconnector', []);

    $leadConnectorEnabled = filter_var($leadConnector['enabled'] ?? false, FILTER_VALIDATE_BOOL)
        && filled($leadConnector['widget_id'] ?? null);
?>

<?php if($leadConnectorEnabled): ?>
    
    <script
        id="a1-leadconnector-widget"
        src="https://widgets.leadconnectorhq.com/loader.js"
        data-resources-url="https://widgets.leadconnectorhq.com/chat-widget/loader.js"
        data-widget-id="<?php echo e($leadConnector['widget_id']); ?>"
        async
    ></script>
<?php endif; ?>
<?php /**PATH /home/u668568382/domains/a1legacylabs.com/laravel_app/resources/views/layouts/ai-agent-scripts.blade.php ENDPATH**/ ?>