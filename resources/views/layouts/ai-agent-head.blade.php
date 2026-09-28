@php
    $retell = config('services.retell', []);
    $voicePublicKey = $settings->get('retell_voice_public_key') ?: ($retell['voice_public_key'] ?? null);
    $voiceAgentId = $settings->get('retell_voice_agent_id') ?: ($retell['voice_agent_id'] ?? null);
    $retellEnabled = filter_var($retell['enabled'] ?? false, FILTER_VALIDATE_BOOL)
        && filled($voicePublicKey)
        && filled($voiceAgentId);
@endphp

@if ($retellEnabled)
    {{--
        Official Retell website widget. Voice-only configuration intentionally uses
        data-voice-* credentials so the widget opens directly into the voice flow.
        A Retell-issued white-label token can hide provider branding without relying
        on brittle DOM/CSS overrides.
    --}}
    <script
        id="retell-widget"
        src="https://dashboard.retellai.com/retell-widget-v2.js"
        type="module"
        data-voice-public-key="{{ $voicePublicKey }}"
        data-voice-agent-id="{{ $voiceAgentId }}"
        data-title="{{ $retell['title'] }}"
        data-bot-name="{{ $retell['bot_name'] }}"
        data-fab-text="{{ $retell['fab_text'] }}"
        data-theme-color="{{ $retell['theme_color'] }}"
        data-component-color="{{ $retell['component_color'] }}"
        data-popup-message="{{ $retell['popup_message'] }}"
        data-show-ai-popup="{{ filter_var($retell['show_ai_popup'] ?? true, FILTER_VALIDATE_BOOL) ? 'true' : 'false' }}"
        data-show-ai-popup-time="{{ (int) ($retell['show_ai_popup_time'] ?? 5) }}"
        data-auto-open="false"
        @if (filled($retell['white_label_token'] ?? null))
            data-white-label="{{ $retell['white_label_token'] }}"
        @endif
    ></script>
@endif
