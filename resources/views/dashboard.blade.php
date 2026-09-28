<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-medium tracking-tight text-white">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="px-4 py-12 sm:px-6 lg:px-8">
        <div class="mx-auto max-w-7xl">
            <div class="neutron-panel overflow-hidden rounded-2xl p-8">
                <p class="neutron-kicker">Account ready</p>
                <h1 class="mt-4 text-3xl font-medium tracking-tight text-white">Welcome, {{ auth()->user()->name }}.</h1>
                <p class="mt-3 max-w-xl leading-7 text-white/45">Your A1 Legacy Labs account is active. Visit the website or update your profile and security settings.</p>
                <div class="mt-7 flex flex-wrap gap-3"><a href="{{ route('home') }}" class="rounded-lg bg-neutron-300 px-5 py-3 font-mono text-xs font-semibold uppercase tracking-wider text-neutron-950">Explore A1 Legacy Labs</a><a href="{{ route('profile.edit') }}" class="rounded-lg border border-white/10 px-5 py-3 font-mono text-xs font-semibold uppercase tracking-wider text-white/70">Profile settings</a></div>
            </div>
        </div>
    </div>
</x-app-layout>
