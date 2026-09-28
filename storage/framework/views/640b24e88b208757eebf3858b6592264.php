<?php
    $retell = config('services.retell', []);
    $voicePublicKey = $settings->get('retell_voice_public_key') ?: ($retell['voice_public_key'] ?? null);
    $voiceAgentId = $settings->get('retell_voice_agent_id') ?: ($retell['voice_agent_id'] ?? null);
    $retellEnabled = filter_var($retell['enabled'] ?? false, FILTER_VALIDATE_BOOL)
        && filled($voicePublicKey)
        && filled($voiceAgentId);
?>

<?php if($retellEnabled): ?>
    
    <script
        id="retell-widget"
        src="https://dashboard.retellai.com/retell-widget-v2.js"
        type="module"
        data-voice-public-key="<?php echo e($voicePublicKey); ?>"
        data-voice-agent-id="<?php echo e($voiceAgentId); ?>"
        data-title="<?php echo e($retell['title']); ?>"
        data-bot-name="<?php echo e($retell['bot_name']); ?>"
        data-fab-text="<?php echo e($retell['fab_text']); ?>"
        data-theme-color="<?php echo e($retell['theme_color']); ?>"
        data-component-color="<?php echo e($retell['component_color']); ?>"
        data-popup-message="<?php echo e($retell['popup_message']); ?>"
        data-show-ai-popup="<?php echo e(filter_var($retell['show_ai_popup'] ?? true, FILTER_VALIDATE_BOOL) ? 'true' : 'false'); ?>"
        data-show-ai-popup-time="<?php echo e((int) ($retell['show_ai_popup_time'] ?? 5)); ?>"
        data-auto-open="false"
        <?php if(filled($retell['white_label_token'] ?? null)): ?>
            data-white-label="<?php echo e($retell['white_label_token']); ?>"
        <?php endif; ?>
    ></script>
<?php endif; ?>
<?php /**PATH /home/u668568382/domains/a1legacylabs.com/laravel_app/resources/views/layouts/ai-agent-head.blade.php ENDPATH**/ ?>