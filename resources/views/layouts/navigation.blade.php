<nav x-data="{ open: false }" class="sticky top-0 z-50 border-b border-white/10 bg-neutron-950/80 backdrop-blur-xl">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex h-20 items-center justify-between gap-6">
            <div class="flex items-center gap-8">
                <a href="{{ auth()->user()->is_admin ? route('admin.dashboard') : route('dashboard') }}" class="flex items-center gap-3">
                    @if ($settings->get('header_logo'))
                        <img src="{{ $settings->get('header_logo') }}" alt="{{ $settings->get('site_name', config('app.name', 'A1 Legacy Labs')) }}" class="max-h-9 w-auto max-w-40 object-contain">
                    @else
                        <x-application-logo class="h-9 w-9" />
                        <span class="font-mono text-sm font-semibold uppercase tracking-[0.16em] text-white">{{ $settings->get('site_name', config('app.name', 'A1 Legacy Labs')) }}</span>
                    @endif
                </a>
                <div class="hidden items-center gap-1 lg:flex">
                    @if (auth()->user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}" class="rounded-lg px-3 py-2 text-sm text-white/55 transition hover:bg-white/5 hover:text-white">Overview</a><a href="{{ route('admin.pages.index') }}" class="rounded-lg px-3 py-2 text-sm text-white/55 transition hover:bg-white/5 hover:text-white">Content</a><a href="{{ route('admin.messages.index') }}" class="rounded-lg px-3 py-2 text-sm text-white/55 transition hover:bg-white/5 hover:text-white">Inbox</a><a href="{{ route('admin.users.index') }}" class="rounded-lg px-3 py-2 text-sm text-white/55 transition hover:bg-white/5 hover:text-white">Users</a><a href="{{ route('admin.settings.index') }}" class="rounded-lg px-3 py-2 text-sm text-white/55 transition hover:bg-white/5 hover:text-white">Settings</a>
                    @else
                        <a href="{{ route('dashboard') }}" class="rounded-lg bg-white/10 px-3 py-2 text-sm text-white">Dashboard</a>
                    @endif
                    <a href="{{ route('home') }}" class="rounded-lg px-3 py-2 text-sm text-white/55 transition hover:bg-white/5 hover:text-white">View website</a>
                </div>
            </div>
            <div class="hidden items-center gap-3 lg:flex"><div class="text-right"><p class="text-sm font-medium text-white">{{ auth()->user()->name }}</p><p class="font-mono text-[10px] uppercase tracking-wider text-white/35">{{ auth()->user()->is_admin ? 'Administrator' : 'Account' }}</p></div><a href="{{ route('profile.edit') }}" class="rounded-lg border border-white/10 bg-white/[0.04] px-3 py-2 text-sm text-white/65 transition hover:text-white">Profile</a><form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="rounded-lg border border-white/10 px-3 py-2 text-sm text-white/45 transition hover:bg-white/5 hover:text-white">Log out</button></form></div>
            <button type="button" @click="open = ! open" class="rounded-lg border border-white/10 p-2 text-white/70 lg:hidden" aria-label="Toggle navigation" :aria-expanded="open.toString()"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path stroke-linecap="round" d="M4 7h16M4 12h16M4 17h16" /></svg></button>
        </div>
        <div x-show="open" x-cloak @click.outside="open = false" class="flex flex-col gap-1 border-t border-white/10 py-4 lg:hidden">
            @if (auth()->user()->is_admin)
                <a href="{{ route('admin.dashboard') }}" class="rounded-lg px-3 py-2 text-sm text-white/70">Overview</a><a href="{{ route('admin.pages.index') }}" class="rounded-lg px-3 py-2 text-sm text-white/70">Content</a><a href="{{ route('admin.messages.index') }}" class="rounded-lg px-3 py-2 text-sm text-white/70">Inbox</a><a href="{{ route('admin.users.index') }}" class="rounded-lg px-3 py-2 text-sm text-white/70">Users</a><a href="{{ route('admin.settings.index') }}" class="rounded-lg px-3 py-2 text-sm text-white/70">Settings</a>
            @else
                <a href="{{ route('dashboard') }}" class="rounded-lg px-3 py-2 text-sm text-white/70">Dashboard</a>
            @endif
            <a href="{{ route('profile.edit') }}" class="rounded-lg px-3 py-2 text-sm text-white/70">Profile</a><a href="{{ route('home') }}" class="rounded-lg px-3 py-2 text-sm text-white/70">View website</a><form method="POST" action="{{ route('logout') }}">@csrf<button type="submit" class="w-full rounded-lg px-3 py-2 text-left text-sm text-white/70">Log out</button></form>
        </div>
    </div>
</nav>
