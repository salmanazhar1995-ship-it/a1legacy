<x-app-layout>
    <main class="mx-auto max-w-4xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="flex flex-wrap items-center justify-between gap-3">
            <div>
                <a href="{{ route('admin.products.index') }}" class="text-sm text-white/35 transition hover:text-white">← Core Products</a>
                <h1 class="mt-3 text-3xl font-medium tracking-tight text-white">{{ $product->exists ? 'Edit core product' : 'Add core product' }}</h1>
            </div>
            @if ($product->exists && $product->is_active)
                <a href="{{ route('products.show', $product) }}" target="_blank" class="rounded-lg border border-white/10 px-4 py-2.5 text-sm text-white/55 transition hover:bg-white/5 hover:text-white">View detail page</a>
            @endif
        </div>

        @if ($errors->any())
            <div class="mt-6 rounded-xl border border-red-300/20 bg-red-400/10 px-4 py-3 text-sm text-red-100">
                Please check the highlighted fields and try again.
            </div>
        @endif

        <form method="POST" enctype="multipart/form-data" action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}" class="neutron-panel mt-8 rounded-2xl p-6 sm:p-8">
            @csrf
            @if ($product->exists) @method('PUT') @endif

            <div class="grid gap-6 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <x-input-label for="title" value="Product title" />
                    <x-text-input id="title" name="title" class="mt-2 block w-full" :value="old('title', $product->title)" required />
                    <x-input-error class="mt-2" :messages="$errors->get('title')" />
                </div>

                <div>
                    <x-input-label for="slug" value="Slug" />
                    <x-text-input id="slug" name="slug" class="mt-2 block w-full" :value="old('slug', $product->slug)" placeholder="auto-generated-if-empty" />
                    <p class="mt-2 text-xs text-white/30">Used in /products/product-slug. Leave empty on new products to generate automatically.</p>
                    <x-input-error class="mt-2" :messages="$errors->get('slug')" />
                </div>

                <div>
                    <x-input-label for="visual_type" value="Internal visual type" />
                    <x-text-input id="visual_type" name="visual_type" class="mt-2 block w-full" :value="old('visual_type', $product->visual_type ?: 'product')" />
                    <x-input-error class="mt-2" :messages="$errors->get('visual_type')" />
                </div>

                <div>
                    <x-input-label for="eyebrow" value="Eyebrow / number" />
                    <x-text-input id="eyebrow" name="eyebrow" class="mt-2 block w-full" :value="old('eyebrow', $product->eyebrow)" placeholder="04 / Core Product" />
                    <x-input-error class="mt-2" :messages="$errors->get('eyebrow')" />
                </div>

                <div>
                    <x-input-label for="badge" value="Badge (optional)" />
                    <x-text-input id="badge" name="badge" class="mt-2 block w-full" :value="old('badge', $product->badge)" placeholder="Most Popular" />
                    <x-input-error class="mt-2" :messages="$errors->get('badge')" />
                </div>

                <div class="sm:col-span-2">
                    <x-input-label for="short_description" value="Short description" />
                    <textarea id="short_description" name="short_description" rows="3" class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-white focus:border-neutron-500 focus:ring-neutron-500" required>{{ old('short_description', $product->short_description) }}</textarea>
                    <p class="mt-2 text-xs text-white/30">Shown on the home-page product card and Products listing.</p>
                    <x-input-error class="mt-2" :messages="$errors->get('short_description')" />
                </div>

                <div class="sm:col-span-2">
                    <x-input-label for="description" value="Full product detail" />
                    <textarea id="description" name="description" rows="8" class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-white focus:border-neutron-500 focus:ring-neutron-500">{{ old('description', $product->description) }}</textarea>
                    <p class="mt-2 text-xs text-white/30">Displayed on the individual product detail page.</p>
                    <x-input-error class="mt-2" :messages="$errors->get('description')" />
                </div>

                <div class="sm:col-span-2">
                    @include('admin.partials.seo-fields', ['seoModel' => $product])
                </div>

                <div class="sm:col-span-2">
                    @include('admin.partials.image-animation-fields', [
                        'title' => 'Product visual',
                        'help' => 'Choose an image or a self-contained HTML animation. The selected visual is used on Home, Products and the product detail page.',
                        'currentMediaType' => $product->media_type ?: 'image',
                        'currentImage' => $product->image_url,
                        'currentImageAlt' => $product->image_alt,
                        'currentAnimation' => $product->animation_html_url,
                    ])
                </div>

                @php
                    $highlightRows = old('highlights', $product->highlights ?: []);
                    if (! is_array($highlightRows) || count($highlightRows) === 0) {
                        $highlightRows = [''];
                    }
                @endphp

                <div class="sm:col-span-2 rounded-2xl border border-white/10 bg-white/[0.025] p-5" data-product-highlights>
                    <div class="flex flex-wrap items-start justify-between gap-3">
                        <div>
                            <x-input-label value="Card bullet points" />
                            <p class="mt-2 text-xs leading-5 text-white/30">Add, edit, delete and reorder the product bullet points. Frontend cards show three points per row on desktop.</p>
                        </div>
                        <button type="button" data-add-highlight class="inline-flex items-center rounded-lg border border-neutron-300/20 bg-neutron-500/10 px-3 py-2 font-mono text-[10px] font-semibold uppercase tracking-[0.1em] text-neutron-200 transition hover:bg-neutron-500/20">+ Add point</button>
                    </div>

                    <div class="mt-4 space-y-3" data-highlight-list>
                        @foreach ($highlightRows as $highlight)
                            <div class="flex items-center gap-3" data-highlight-row>
                                <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg border border-neutron-300/15 bg-neutron-500/[0.08] text-neutron-300" aria-hidden="true">•</span>
                                <input
                                    type="text"
                                    name="highlights[]"
                                    value="{{ $highlight }}"
                                    maxlength="255"
                                    placeholder="e.g. Pipelines"
                                    class="block min-w-0 flex-1 rounded-lg border-white/10 bg-white/[0.04] text-sm text-white focus:border-neutron-500 focus:ring-neutron-500"
                                >
                                <button type="button" data-remove-highlight class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-lg border border-red-300/15 bg-red-400/[0.06] text-red-200/70 transition hover:bg-red-400/10 hover:text-red-100" aria-label="Delete bullet point">×</button>
                            </div>
                        @endforeach
                    </div>

                    <x-input-error class="mt-3" :messages="$errors->get('highlights')" />
                    @foreach ($errors->get('highlights.*') as $highlightErrors)
                        <x-input-error class="mt-2" :messages="$highlightErrors" />
                    @endforeach

                    <template data-highlight-template>
                        <div class="flex items-center gap-3" data-highlight-row>
                            <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-lg border border-neutron-300/15 bg-neutron-500/[0.08] text-neutron-300" aria-hidden="true">•</span>
                            <input
                                type="text"
                                name="highlights[]"
                                value=""
                                maxlength="255"
                                placeholder="New bullet point"
                                class="block min-w-0 flex-1 rounded-lg border-white/10 bg-white/[0.04] text-sm text-white focus:border-neutron-500 focus:ring-neutron-500"
                            >
                            <button type="button" data-remove-highlight class="inline-flex h-9 w-9 shrink-0 items-center justify-center rounded-lg border border-red-300/15 bg-red-400/[0.06] text-red-200/70 transition hover:bg-red-400/10 hover:text-red-100" aria-label="Delete bullet point">×</button>
                        </div>
                    </template>
                </div>

                <div class="sm:col-span-2">
                    <x-input-label for="benefits_text" value="Detail page capabilities" />
                    <textarea id="benefits_text" name="benefits_text" rows="8" class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-white focus:border-neutron-500 focus:ring-neutron-500" placeholder="Lead and opportunity pipelines&#10;Calendars and appointment management&#10;Workflow automation">{{ old('benefits_text', implode("\n", $product->benefits ?: [])) }}</textarea>
                    <p class="mt-2 text-xs text-white/30">One capability per line. Displayed on the detail page.</p>
                    <x-input-error class="mt-2" :messages="$errors->get('benefits_text')" />
                </div>

                <div>
                    <x-input-label for="sort_order" value="Display order" />
                    <x-text-input id="sort_order" type="number" min="0" name="sort_order" class="mt-2 block w-full" :value="old('sort_order', $product->sort_order ?? 0)" required />
                    <x-input-error class="mt-2" :messages="$errors->get('sort_order')" />
                </div>

                <div class="space-y-3 self-end pb-2">
                    <label class="flex items-center gap-3 text-sm text-white/65">
                        <input type="hidden" name="is_featured" value="0">
                        <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $product->is_featured)) class="rounded border-white/15 bg-white/5 text-neutron-500">
                        Show in Home → Core Products
                    </label>
                    <label class="flex items-center gap-3 text-sm text-white/65">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $product->is_active)) class="rounded border-white/15 bg-white/5 text-neutron-500">
                        Product is active/public
                    </label>
                </div>

                <div class="sm:col-span-2 flex flex-wrap gap-3 border-t border-white/10 pt-6">
                    <x-primary-button>{{ $product->exists ? 'Save product' : 'Create product' }}</x-primary-button>
                    <a href="{{ route('admin.products.index') }}" class="inline-flex items-center rounded-lg border border-white/10 px-4 py-2 text-sm text-white/50 transition hover:bg-white/5 hover:text-white">Cancel</a>
                </div>
            </div>
        </form>
    </main>

    <script>
        (() => {
            const root = document.querySelector('[data-product-highlights]');
            if (!root || root.dataset.ready === '1') return;
            root.dataset.ready = '1';

            const list = root.querySelector('[data-highlight-list]');
            const template = root.querySelector('[data-highlight-template]');
            const addButton = root.querySelector('[data-add-highlight]');

            const bindRow = (row) => {
                const removeButton = row.querySelector('[data-remove-highlight]');
                removeButton?.addEventListener('click', () => {
                    const rows = list.querySelectorAll('[data-highlight-row]');
                    if (rows.length === 1) {
                        const input = row.querySelector('input[name="highlights[]"]');
                        if (input) input.value = '';
                        input?.focus();
                        return;
                    }
                    row.remove();
                });
            };

            list.querySelectorAll('[data-highlight-row]').forEach(bindRow);

            addButton?.addEventListener('click', () => {
                if (list.querySelectorAll('[data-highlight-row]').length >= 30) return;
                const fragment = template.content.cloneNode(true);
                const row = fragment.querySelector('[data-highlight-row]');
                bindRow(row);
                list.appendChild(fragment);
                row.querySelector('input[name="highlights[]"]')?.focus();
            });
        })();
    </script>
</x-app-layout>
