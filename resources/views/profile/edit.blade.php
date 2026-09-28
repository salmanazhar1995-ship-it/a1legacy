<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-medium tracking-tight text-white">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="px-4 py-10 sm:px-6 lg:px-8">
        <div class="mx-auto flex max-w-7xl flex-col gap-5">
            <div class="profile-panel neutron-panel rounded-2xl p-5 sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="profile-panel neutron-panel rounded-2xl p-5 sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="profile-panel neutron-panel rounded-2xl p-5 sm:p-8">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
