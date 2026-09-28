<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Resend, Postmark, AWS, and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'retell' => [
        'enabled' => env('RETELL_ENABLED', true),
        'voice_public_key' => env('RETELL_VOICE_PUBLIC_KEY'),
        'voice_agent_id' => env('RETELL_VOICE_AGENT_ID'),
        'title' => env('RETELL_WIDGET_TITLE', 'Experience A1 Legacy Voice AI'),
        'bot_name' => env('RETELL_BOT_NAME', 'Ava'),
        'fab_text' => env('RETELL_FAB_TEXT', 'Talk To Our AI'),
        'theme_color' => env('RETELL_THEME_COLOR', '#0A2540'),
        'component_color' => env('RETELL_COMPONENT_COLOR', '#C9A250'),
        'popup_message' => env('RETELL_POPUP_MESSAGE', 'Try our AI receptionist live'),
        'show_ai_popup' => env('RETELL_SHOW_AI_POPUP', true),
        'show_ai_popup_time' => env('RETELL_SHOW_AI_POPUP_TIME', 5),
        'white_label_token' => env('RETELL_WHITE_LABEL_TOKEN'),
    ],

    'leadconnector' => [
        'enabled' => env('LEADCONNECTOR_CHAT_ENABLED', true),
        'widget_id' => env('LEADCONNECTOR_WIDGET_ID'),
    ],

];
