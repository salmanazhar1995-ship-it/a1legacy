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
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\layouts\ai-agent-scripts.blade.php ENDPATH**/ ?>