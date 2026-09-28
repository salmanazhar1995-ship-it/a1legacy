<x-app-layout>
    @php
        $isEdit = $businessUseCase->exists;
        $points = old('highlights', $businessUseCase->highlights ?: ['']);
        if (!is_array($points) || count($points) === 0) $points = [''];
    @endphp
    <main class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <a href="{{ route('admin.business-use-cases.index') }}" class="text-sm text-white/35 transition hover:text-white">← Industries</a>
                <p class="neutron-kicker mt-5">Homepage industry explorer</p>
                <h1 class="mt-2 text-3xl font-medium tracking-tight text-white">{{ $isEdit ? 'Edit Sub Industry' : 'Add Sub Industry' }}</h1>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-white/40">Assign this detailed entry to a main industry. Its description and highlights appear in the third homepage panel.</p>
            </div>
            <a href="{{ route('home') }}#industries" target="_blank" class="rounded-lg border border-white/10 px-4 py-2.5 text-sm text-white/60 transition hover:bg-white/5 hover:text-white">Preview homepage ↗</a>
        </div>

        @if($errors->any())
            <div class="mt-6 rounded-xl border border-red-300/20 bg-red-500/10 p-4 text-sm text-red-100">Please review the highlighted fields below.</div>
        @endif

        <form method="POST" enctype="multipart/form-data" action="{{ $isEdit ? route('admin.business-use-cases.update', $businessUseCase) : route('admin.business-use-cases.store') }}" class="mt-8 space-y-6" data-unsaved-warning="true">
            @csrf
            @if($isEdit) @method('PUT') @endif

            <section class="neutron-panel rounded-2xl p-6 sm:p-8">
                <p class="neutron-kicker">Sub industry identity</p>
                <h2 class="mt-2 text-lg font-medium text-white">What visitors see first</h2>
                <div class="mt-6 grid gap-5 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <x-input-label for="industry_id" value="Main Industry"/>
                        <select id="industry_id" name="industry_id" required class="mt-2 block w-full rounded-lg border-white/10 bg-neutron-900 text-sm text-white focus:border-neutron-500 focus:ring-neutron-500">
                            <option value="">Select a main industry</option>
                            @foreach($industries as $mainIndustry)
                                <option value="{{ $mainIndustry->id }}" @selected((string) old('industry_id', $businessUseCase->industry_id) === (string) $mainIndustry->id)>{{ $mainIndustry->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('industry_id')"/>
                        @if($industries->isEmpty())<p class="mt-2 text-xs text-amber-200/70">Create a Main Industry first.</p>@endif
                    </div>
                    <div>
                        <x-input-label for="category" value="Small category label"/>
                        <x-text-input id="category" name="category" class="mt-2 block w-full" :value="old('category', $businessUseCase->category)" placeholder="Agencies & Brokerages"/>
                        <p class="mt-2 text-xs text-white/30">Shown above the industry title.</p>
                    </div>
                    <div>
                        <x-input-label for="title" value="Sub industry title"/>
                        <x-text-input id="title" name="title" class="mt-2 block w-full" :value="old('title', $businessUseCase->title)" placeholder="Insurance" required/>
                        <x-input-error class="mt-2" :messages="$errors->get('title')"/>
                    </div>
                    <div class="sm:col-span-2">
                        <x-input-label for="slug" value="Detail page URL slug"/>
                        <div class="mt-2 flex items-center rounded-lg border border-white/10 bg-white/[0.04] px-3">
                            <span class="shrink-0 text-xs text-white/25">/industries/</span>
                            <input id="slug" name="slug" value="{{ old('slug', $businessUseCase->slug) }}" class="min-w-0 flex-1 border-0 bg-transparent px-1 py-2.5 text-sm text-white outline-none ring-0 focus:ring-0" placeholder="auto-generated-from-title">
                        </div>
                        <p class="mt-2 text-xs text-white/30">Leave blank on a new industry to generate it automatically. Keep existing slugs stable for SEO.</p>
                        <x-input-error class="mt-2" :messages="$errors->get('slug')"/>
                    </div>
                    <div class="sm:col-span-2">
                        <x-input-label for="description" value="Description"/>
                        <textarea id="description" name="description" data-rich-editor rows="7" class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-white">{{ old('description', $businessUseCase->description) }}</textarea>
                        <p class="mt-2 text-xs text-white/30">Explain the industry workflow and where A1 Legacy fits. Keep it practical and avoid unverified claims.</p>
                        <x-input-error class="mt-2" :messages="$errors->get('description')"/>
                    </div>
                </div>
            </section>

            @include('admin.partials.seo-fields', ['seoModel' => $businessUseCase])

            @include('admin.partials.image-animation-fields', [
                'title' => 'Industry visual',
                'help' => 'Choose an image or HTML animation for the Industries listing, homepage showcase and industry detail page.',
                'currentMediaType' => $businessUseCase->media_type ?: 'image',
                'currentImage' => $businessUseCase->image_url,
                'currentImageAlt' => $businessUseCase->image_alt,
                'currentAnimation' => $businessUseCase->animation_html_url,
            ])

            <section class="neutron-panel rounded-2xl p-6 sm:p-8">
                <div class="flex items-start justify-between gap-4">
                    <div><p class="neutron-kicker">AI fit points</p><h2 class="mt-2 text-lg font-medium text-white">Short automation highlights</h2><p class="mt-2 text-xs text-white/35">Add short points visitors can scan quickly.</p></div>
                    <button type="button" id="add-business-point" class="rounded-lg border border-neutron-300/20 bg-neutron-500/10 px-3 py-2 text-xs font-medium text-neutron-200">+ Add Point</button>
                </div>
                <div id="business-points" class="mt-5 space-y-3">
                    @foreach($points as $point)
                        <div class="business-point flex gap-3">
                            <input type="text" name="highlights[]" value="{{ $point }}" maxlength="255" class="block w-full rounded-lg border-white/10 bg-white/[0.04] text-sm text-white focus:border-neutron-500 focus:ring-neutron-500" placeholder="e.g. Capture and qualify new enquiries">
                            <button type="button" class="remove-business-point rounded-lg border border-red-300/15 px-3 text-sm text-red-200/70 transition hover:bg-red-500/10">Remove</button>
                        </div>
                    @endforeach
                </div>
                <x-input-error class="mt-2" :messages="$errors->get('highlights')"/>
            </section>

            <section class="neutron-panel rounded-2xl p-6 sm:p-8">
                <p class="neutron-kicker">Existing systems</p>
                <h2 class="mt-2 text-lg font-medium text-white">How the system fits</h2>
                <div class="mt-5">
                    <x-input-label for="system_note" value="Integration / CRM note"/>
                    <textarea id="system_note" name="system_note" rows="4" data-no-rich-editor="1" class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-sm text-white focus:border-neutron-500 focus:ring-neutron-500" placeholder="Explain how A1 Legacy can work around the client's current CRM, calendar or industry systems.">{{ old('system_note', $businessUseCase->system_note) }}</textarea>
                </div>
                <div class="mt-5 grid gap-5 sm:grid-cols-2">
                    <div><x-input-label for="link_label" value="Optional button label"/><x-text-input id="link_label" name="link_label" class="mt-2 block w-full" :value="old('link_label', $businessUseCase->link_label)" placeholder="Explore solution"/></div>
                    <div><x-input-label for="link_url" value="Optional button URL"/><x-text-input id="link_url" name="link_url" class="mt-2 block w-full" :value="old('link_url', $businessUseCase->link_url)" placeholder="/products"/></div>
                </div>
            </section>

            <section class="neutron-panel rounded-2xl p-6 sm:p-8">
                <p class="neutron-kicker">Display</p>
                <div class="mt-5 grid gap-4 sm:grid-cols-2">
                    <label class="rounded-xl border border-white/10 p-4 text-sm text-white/65">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $businessUseCase->is_active ?? true)) class="mr-2 rounded border-white/15 bg-white/5 text-neutron-500">
                        Show this sub industry on the website
                    </label>
                    <div>
                        <x-input-label for="sort_order" value="Display order"/>
                        <x-text-input id="sort_order" type="number" min="0" max="65535" name="sort_order" class="mt-2 block w-full" :value="old('sort_order', $businessUseCase->sort_order ?? 0)"/>
                        <p class="mt-2 text-xs text-white/30">Lower numbers appear first.</p>
                    </div>
                </div>
            </section>

            <div class="flex flex-wrap gap-3">
                <x-primary-button>{{ $isEdit ? 'Save Changes' : 'Create Sub Industry' }}</x-primary-button>
                <a href="{{ route('admin.business-use-cases.index') }}" class="inline-flex items-center rounded-lg border border-white/10 px-4 py-2 text-sm text-white/50 transition hover:bg-white/5 hover:text-white">Cancel</a>
            </div>
        </form>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const list = document.getElementById('business-points');
        const add = document.getElementById('add-business-point');
        if (!list || !add) return;
        add.addEventListener('click', function () {
            if (list.querySelectorAll('.business-point').length >= 12) return;
            const row = document.createElement('div');
            row.className = 'business-point flex gap-3';
            row.innerHTML = '<input type="text" name="highlights[]" maxlength="255" class="block w-full rounded-lg border-white/10 bg-white/[0.04] text-sm text-white focus:border-neutron-500 focus:ring-neutron-500" placeholder="Add a short automation point"><button type="button" class="remove-business-point rounded-lg border border-red-300/15 px-3 text-sm text-red-200/70 transition hover:bg-red-500/10">Remove</button>';
            list.appendChild(row);
        });
        list.addEventListener('click', function (event) {
            const button = event.target.closest('.remove-business-point');
            if (!button) return;
            const rows = list.querySelectorAll('.business-point');
            if (rows.length === 1) rows[0].querySelector('input').value = '';
            else button.closest('.business-point').remove();
        });
    });
    </script>
</x-app-layout>
