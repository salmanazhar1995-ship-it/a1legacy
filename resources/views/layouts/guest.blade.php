<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $settings->get('site_name', config('app.name', 'A1 Legacy Labs')) }} — {{ __('Account') }}</title>
        @if($settings->get('favicon'))
            <link rel="icon" href="{{ $settings->get('favicon') }}">
            <link rel="shortcut icon" href="{{ $settings->get('favicon') }}">
        @endif

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600&amp;family=Geist+Mono:wght@400;500;600&amp;display=swap" rel="stylesheet">

        @include('layouts.runtime-assets')
    </head>
    <body class="font-sans">
        <div class="neutron-grid relative flex min-h-screen flex-col items-center justify-center overflow-hidden px-4 py-10">
            <div class="pointer-events-none absolute left-1/2 top-0 h-[520px] w-[720px] -translate-x-1/2 rounded-full bg-neutron-500/15 blur-[130px]"></div>

            <div class="relative z-10 mb-8">
                <a href="{{ route('home') }}" class="flex items-center gap-3" aria-label="{{ $settings->get('site_name', 'A1 Legacy Labs') }} home">
                    @if($settings->get('header_logo'))
                        <img src="{{ $settings->get('header_logo') }}" alt="{{ $settings->get('site_name', 'A1 Legacy Labs') }}" class="max-h-12 w-auto max-w-48 object-contain">
                    @else
                        <x-application-logo class="h-10 w-10" />
                    @endif
                    <span class="font-mono text-sm font-semibold uppercase tracking-[0.16em] text-white">{{ $settings->get('site_name', 'A1 Legacy Labs') }}</span>
                </a>
            </div>

            <div class="neutron-panel relative z-10 w-full overflow-hidden rounded-2xl p-6 shadow-2xl shadow-black/40 sm:max-w-md sm:p-8">
                <div class="mb-7 border-b border-white/10 pb-6">
                    <p class="neutron-kicker">Secure workspace</p>
                    <h1 class="mt-3 text-2xl font-medium tracking-tight text-white">Welcome to {{ $settings->get('site_name', 'A1 Legacy Labs') }}</h1>
                    <p class="mt-2 text-sm leading-6 text-white/45">Sign in to access your operations dashboard.</p>
                </div>

                <div class="auth-panel">
                    {{ $slot }}
                </div>
            </div>

            <a href="{{ route('home') }}" class="neutron-link relative z-10 mt-7">← Back to website</a>
        </div>
    </body>
</html>
