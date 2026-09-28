@php
    $headerLogoAnimation = $settings->get('header_logo__animation_html_url');
    $hasHeaderLogo = filled($settings->get('header_logo')) || ($settings->get('header_logo__media_type') === 'animation' && filled($headerLogoAnimation));
@endphp
<header x-data="{ open: false }" class="fixed inset-x-0 top-0 z-50 px-4 pt-4 sm:px-6">
    <nav class="mx-auto flex max-w-7xl items-center justify-between rounded-2xl border border-white/10 bg-neutron-950/75 px-4 py-3 shadow-2xl shadow-black/20 backdrop-blur-xl sm:px-5" aria-label="Main navigation">
        <a href="{{ route('home') }}" class="flex items-center gap-3">
            @if ($hasHeaderLogo)
                <span class="block h-9 w-24 overflow-hidden rounded-md">
                    @include('site.partials.setting-visual', [
                        'settingKey' => 'header_logo',
                        'fallbackAlt' => $settings->get('site_name', 'A1 Legacy Labs').' logo',
                        'imageClass' => 'h-9 w-auto max-w-48 object-contain',
                        'animationClass' => 'pointer-events-none h-9 w-24 border-0',
                        'loading' => 'eager',
                    ])
                </span>
                <strong class="hidden text-sm font-semibold tracking-tight text-white sm:inline">{{ $settings->get('site_name', 'A1 Legacy Labs') }}</strong>
                @else
                <x-application-logo class="h-9 w-9" />
                <span class="font-mono text-sm font-semibold uppercase tracking-[0.16em] text-white">{{ $settings->get('site_name', 'A1 Legacy Labs') }}</span>
            @endif
        </a>

        <div class="hidden items-center gap-1 lg:flex">
            @foreach ($navigationPages as $navigationPage)
                <a href="{{ url($navigationPage->slug === 'home' ? '/' : '/'.$navigationPage->slug) }}" @class([
                    'rounded-lg px-3 py-2 text-sm transition',
                    'bg-white/10 text-white' => $page->is($navigationPage),
                    'text-white/55 hover:bg-white/5 hover:text-white' => ! $page->is($navigationPage),
                ])>{{ $navigationPage->navigation_label ?: $navigationPage->title }}</a>
            @endforeach
        </div>

        <div class="hidden items-center gap-2 lg:flex">
            @auth
                <a href="{{ auth()->user()->is_admin ? route('admin.dashboard') : route('dashboard') }}" class="rounded-lg border border-white/10 px-4 py-2.5 font-mono text-[11px] font-semibold uppercase tracking-wider text-white/70 transition hover:bg-white/5 hover:text-white">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="rounded-lg px-4 py-2.5 font-mono text-[11px] font-semibold uppercase tracking-wider text-white/55 transition hover:text-white">Sign in</a>
            @endauth
        </div>

        <button type="button" @click="open = ! open" class="rounded-lg border border-white/10 p-2 text-white/70 lg:hidden" aria-label="Toggle navigation" :aria-expanded="open.toString()">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16" /></svg>
        </button>

        <div x-show="open" x-cloak @click.outside="open = false" class="absolute inset-x-4 top-[76px] flex flex-col gap-1 rounded-2xl border border-white/10 bg-neutron-900 p-3 shadow-2xl lg:hidden">
            @foreach ($navigationPages as $navigationPage)
                <a href="{{ url($navigationPage->slug === 'home' ? '/' : '/'.$navigationPage->slug) }}" class="rounded-lg px-3 py-3 text-sm text-white/70">{{ $navigationPage->navigation_label ?: $navigationPage->title }}</a>
            @endforeach
            <div class="mt-2 border-t border-white/10 pt-2">
                @auth
                    <a href="{{ auth()->user()->is_admin ? route('admin.dashboard') : route('dashboard') }}" class="block rounded-lg bg-neutron-300 px-3 py-3 text-center text-sm font-medium text-neutron-950">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="block rounded-lg px-3 py-3 text-sm text-white/70">Sign in</a>
                @endauth
            </div>
        </div>
    </nav>
</header>
