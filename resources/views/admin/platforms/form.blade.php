<x-app-layout>
    <main class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="neutron-kicker">Homepage platform strip</p>
                <h1 class="mt-2 text-3xl font-medium tracking-tight text-white">{{ $platform->exists ? 'Edit Platform' : 'Add Platform' }}</h1>
                <p class="mt-2 text-sm leading-6 text-white/40">This content appears in the slim four-column strip directly under the homepage dashboard image.</p>
            </div>
            <a href="{{ route('admin.platforms.index') }}" class="inline-flex items-center rounded-lg border border-white/10 bg-white/[0.03] px-4 py-2.5 text-sm text-white/60 transition hover:bg-white/[0.06] hover:text-white">← Platform list</a>
        </div>

        @if ($errors->any())
            <div class="mt-6 rounded-xl border border-red-300/20 bg-red-400/10 p-4 text-sm text-red-100">
                <p class="font-semibold">Please fix the highlighted fields.</p>
                <ul class="mt-2 list-disc space-y-1 pl-5 text-red-100/80">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form method="POST" action="{{ $platform->exists ? route('admin.platforms.update', $platform) : route('admin.platforms.store') }}" class="mt-8 space-y-6" data-unsaved-warning="true">
            @csrf
            @if($platform->exists) @method('PUT') @endif

            <section class="neutron-panel rounded-2xl p-5 sm:p-7">
                <div class="border-b border-white/[0.07] pb-5">
                    <p class="font-mono text-[10px] uppercase tracking-[.16em] text-neutron-300">Content</p>
                    <h2 class="mt-2 text-xl font-medium text-white">What visitors will see</h2>
                    <p class="mt-2 text-sm text-white/35">Use a short title and one concise sentence. The strip is intentionally compact.</p>
                </div>

                <div class="mt-6 grid gap-6 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <x-input-label for="title" value="Platform title" />
                        <x-text-input id="title" name="title" type="text" maxlength="120" class="mt-2 block w-full" :value="old('title', $platform->title)" required autofocus />
                        <p class="mt-2 text-xs text-white/30">Example: Workflow Automation</p>
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div class="sm:col-span-2">
                        <x-input-label for="description" value="Short description" />
                        <textarea id="description" name="description" rows="3" maxlength="700" data-no-rich-editor="1" class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-sm text-white focus:border-neutron-500 focus:ring-neutron-500" placeholder="Explain the platform benefit in one sentence.">{{ old('description', $platform->description) }}</textarea>
                        <p class="mt-2 text-xs text-white/30">Best length: 80–140 characters.</p>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div>
                        <x-input-label for="icon" value="Icon" />
                        <select id="icon" name="icon" class="mt-2 block w-full rounded-lg border-white/10 bg-[#07111d] text-sm text-white focus:border-neutron-500 focus:ring-neutron-500">
                            @foreach(['activity'=>'Live activity','automation'=>'Automation','integrations'=>'Integrations','crm'=>'CRM / platform'] as $value => $label)
                                <option value="{{ $value }}" @selected(old('icon', $platform->icon ?: 'activity') === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                        <p class="mt-2 text-xs text-white/30">Choose the small icon shown above the title.</p>
                    </div>

                    <div>
                        <x-input-label for="sort_order" value="Display order" />
                        <x-text-input id="sort_order" name="sort_order" type="number" min="0" max="65535" class="mt-2 block w-full" :value="old('sort_order', $platform->sort_order ?? 0)" />
                        <p class="mt-2 text-xs text-white/30">Lower numbers appear first. Add as many platform items as you need; the frontend responds automatically.</p>
                    </div>

                    <div class="sm:col-span-2">
                        <x-input-label for="link_url" value="Optional link" />
                        <x-text-input id="link_url" name="link_url" type="text" maxlength="1000" class="mt-2 block w-full" :value="old('link_url', $platform->link_url)" placeholder="/products or https://example.com" />
                        <p class="mt-2 text-xs text-white/30">Leave blank for a non-clickable platform item.</p>
                        <x-input-error class="mt-2" :messages="$errors->get('link_url')" />
                    </div>
                </div>
            </section>

            <section class="neutron-panel rounded-2xl p-5 sm:p-7">
                <p class="font-mono text-[10px] uppercase tracking-[.16em] text-neutron-300">Display</p>
                <label class="mt-4 flex items-start gap-3 rounded-xl border border-white/10 bg-white/[0.025] p-4">
                    <input type="hidden" name="is_active" value="0">
                    <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $platform->is_active ?? true)) class="mt-0.5 rounded border-white/15 bg-white/5 text-neutron-500">
                    <span><span class="block text-sm font-medium text-white">Show this platform on the homepage</span><span class="mt-1 block text-xs leading-5 text-white/35">Turn this off to hide it without deleting the content.</span></span>
                </label>
            </section>

            <div class="flex flex-wrap gap-3 border-t border-white/10 pt-6">
                <x-primary-button>{{ $platform->exists ? 'Save Changes' : 'Create Platform' }}</x-primary-button>
                <a href="{{ route('admin.platforms.index') }}" class="inline-flex items-center rounded-lg border border-white/10 px-4 py-2 text-sm text-white/50 transition hover:bg-white/5 hover:text-white">Cancel</a>
            </div>
        </form>
    </main>
</x-app-layout>
