@php
    $retell = config('services.retell', []);
    $leadConnector = config('services.leadconnector', []);
    $voicePublicKey = $settings->get('retell_voice_public_key') ?: ($retell['voice_public_key'] ?? null);
    $voiceAgentId = $settings->get('retell_voice_agent_id') ?: ($retell['voice_agent_id'] ?? null);

    $retellEnabled = filter_var($retell['enabled'] ?? false, FILTER_VALIDATE_BOOL)
        && filled($voicePublicKey)
        && filled($voiceAgentId);

    $leadConnectorEnabled = filter_var($leadConnector['enabled'] ?? false, FILTER_VALIDATE_BOOL)
        && filled($leadConnector['widget_id'] ?? null);

@endphp

@if ($retellEnabled || $leadConnectorEnabled)
    <style>
        /*
        |--------------------------------------------------------------------------
        | Native AI widget layout
        |--------------------------------------------------------------------------
        | LeadConnector chat keeps its provider-configured position.
        | Retell voice stays bottom-left.
        | Website-specific duplicate launch buttons are intentionally not rendered.
        */

        #a1-agent-notice {
            left: 1rem;
            right: auto;
            bottom: calc(7rem + env(safe-area-inset-bottom, 0px));
            max-width: min(360px, calc(100vw - 2rem));
            border: 1px solid rgba(201, 162, 80, .28);
            background: rgba(10, 37, 64, .97);
        }

        /* Retell v2 creates this fixed root after the page loads. */
        #retell-widget-root,
        iframe[src*="retellai.com"] {
            left: 1rem !important;
            right: auto !important;
        }

        @media (min-width: 640px) {
            #a1-agent-notice {
                left: 1.5rem;
                right: auto;
                bottom: calc(7.5rem + env(safe-area-inset-bottom, 0px));
            }

            #retell-widget-root,
            iframe[src*="retellai.com"] {
                left: 1.5rem !important;
                right: auto !important;
            }
        }

        @media (max-width: 639px) {
            #retell-widget-root,
            iframe[src*="retellai.com"] {
                left: 12px !important;
                right: auto !important;
                bottom: calc(12px + env(safe-area-inset-bottom, 0px)) !important;
            }
        }
    </style>

    <div
        id="a1-ai-agents"
        data-chat-enabled="{{ $leadConnectorEnabled ? 'true' : 'false' }}"
        data-voice-enabled="{{ $retellEnabled ? 'true' : 'false' }}"
    >
        {{-- Native provider launchers only; no duplicate website buttons. --}}

        <div
            id="a1-agent-notice"
            hidden
            role="status"
            aria-live="polite"
            class="fixed z-50 rounded-xl px-4 py-3 text-sm leading-5 text-white shadow-2xl backdrop-blur"
        ></div>
    </div>
@endif
