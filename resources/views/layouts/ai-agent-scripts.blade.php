@php
    $leadConnector = config('services.leadconnector', []);

    $leadConnectorEnabled = filter_var($leadConnector['enabled'] ?? false, FILTER_VALIDATE_BOOL)
        && filled($leadConnector['widget_id'] ?? null);
@endphp

@if ($leadConnectorEnabled)
    {{-- Official LeadConnector / HighLevel chat widget loader. --}}
    <script
        id="a1-leadconnector-widget"
        src="https://widgets.leadconnectorhq.com/loader.js"
        data-resources-url="https://widgets.leadconnectorhq.com/chat-widget/loader.js"
        data-widget-id="{{ $leadConnector['widget_id'] }}"
        async
    ></script>
@endif
