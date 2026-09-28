<x-app-layout>
    @php
        $settings = $section->settings ?? [];
        $isEdit = $section->exists;
        $typeOptions = [
            'standard_content' => ['Standard Content', 'A flexible heading, rich text and buttons section.'],
            'content' => ['Standard Content (legacy)', 'Existing flexible content section.'],
            'custom_content' => ['Custom Content', 'Formatted content with optional imagery and buttons.'],
            'html_section' => ['HTML Upload', 'Upload a self-contained HTML file and render it as a page section.'],
            'split_content' => ['Split Content + Image', 'Two-column content with an image on either side.'],
            'image_content' => ['Image + Content', 'Two-column content with the image leading the copy.'],
            'cards_grid' => ['Cards Grid', 'Reusable cards managed through section items.'],
            'features_grid' => ['Features Grid', 'Feature cards with title, description and image.'],
            'stats' => ['Stats', 'Numbers and labels managed as repeating items.'],
            'cta' => ['Call To Action', 'Conversion-focused content with buttons.'],
            'faq' => ['FAQ', 'Questions and answers managed as items.'],
            'logo_strip' => ['Logo Strip', 'Business/client logos managed as items.'],
            'gallery_grid' => ['Gallery Grid', 'Image-led cards managed through section items.'],
            'video' => ['Video Section', 'Rich text with a video/embed URL stored in the primary button URL.'],
            'rich_text' => ['Rich Content', 'Long-form formatted content.'],
            'hero' => ['Hero', 'Large page-opening section.'],
            'feature_grid' => ['Legacy Feature Grid', 'Existing feature grid layout.'],
            'testimonials' => ['Legacy Testimonials', 'Existing testimonial layout.'],
            'pricing' => ['Pricing', 'Pricing cards managed as items.'],
            'contact' => ['Contact', 'Existing contact form section.'],
            'changelog' => ['Changelog', 'Existing changelog section.'],
            'business_showcase' => ['Industry Showcase', 'Industries managed from the dedicated Industries admin module.'],
            'client_stories' => ['Client Stories', 'Featured approved client stories.'],
            'gallery_showcase' => ['Gallery Showcase', 'Featured Gallery records.'],
        ];
    @endphp

    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <a href="{{ route('admin.pages.edit', $page) }}" class="text-sm text-white/35 transition hover:text-white">← {{ $page->title }}</a>
                <p class="neutron-kicker mt-5">Page builder</p>
                <h1 class="mt-3 text-3xl font-medium tracking-tight text-white">{{ $isEdit ? 'Edit section' : 'Add section' }}</h1>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-white/40">Build this section without editing Blade code. Images, rich text, visibility and layout are all managed here.</p>
            </div>
            @if($isEdit)
                <a href="{{ url($page->slug === 'home' ? '/' : '/'.$page->slug) }}" target="_blank" class="rounded-lg border border-white/10 px-4 py-2.5 text-sm text-white/60 transition hover:bg-white/5 hover:text-white">Preview page ↗</a>
            @endif
        </div>

        @if(session('success'))
            <div class="mt-6 rounded-xl border border-emerald-300/20 bg-emerald-300/10 p-4 text-sm text-emerald-100">{{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="mt-6 rounded-xl border border-red-300/20 bg-red-500/10 p-4 text-sm text-red-100">Please review the highlighted fields and try again.</div>
        @endif

        <div class="mt-8 grid gap-6 xl:grid-cols-[1fr_.72fr]">
            <form method="POST" enctype="multipart/form-data" data-unsaved-warning="true" action="{{ $isEdit ? route('admin.sections.update', [$page, $section]) : route('admin.sections.store', $page) }}" class="space-y-6">
                @csrf
                @if($isEdit) @method('PUT') @endif

                <section class="neutron-panel rounded-2xl p-6 sm:p-8">
                    <div>
                        <p class="neutron-kicker">Basic information</p>
                        <h2 class="mt-2 text-lg font-medium">Section identity</h2>
                    </div>
                    <div class="mt-6 grid gap-5 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <x-input-label for="type" value="Section type"/>
                            <select id="type" name="type" class="mt-2 block w-full rounded-lg border-white/10 bg-neutron-900 text-white focus:border-neutron-500 focus:ring-neutron-500">
                                @foreach($typeOptions as $value => [$label, $help])
                                    <option value="{{ $value }}" @selected(old('type', $section->type) === $value)>{{ $label }} — {{ $help }}</option>
                                @endforeach
                            </select>
                            <p class="mt-2 text-xs text-white/30">Choose the layout that best matches the content you want to add. For a ready-made HTML file, select <strong class="text-neutron-300">HTML Upload</strong>; the file input will appear immediately below.</p>
                            <x-input-error class="mt-2" :messages="$errors->get('type')"/>
                        </div>
                        <div>
                            <x-input-label for="heading" value="Heading"/>
                            <x-text-input id="heading" name="heading" class="mt-2 block w-full" :value="old('heading', $section->heading)"/>
                            <x-input-error class="mt-2" :messages="$errors->get('heading')"/>
                        </div>
                        <div>
                            <x-input-label for="key" value="Section key"/>
                            <x-text-input id="key" name="key" class="mt-2 block w-full" :value="old('key', $section->key ?: '')" placeholder="automation-benefits"/>
                            <p class="mt-2 text-xs text-white/30">Used internally and for anchor links. Use lowercase words separated by hyphens.</p>
                            <x-input-error class="mt-2" :messages="$errors->get('key')"/>
                        </div>
                        <div class="sm:col-span-2">
                            <x-input-label for="eyebrow" value="Eyebrow / small label"/>
                            <x-text-input id="eyebrow" name="eyebrow" class="mt-2 block w-full" :value="old('eyebrow', $section->eyebrow)"/>
                        </div>
                    </div>
                </section>

                <section class="neutron-panel rounded-2xl p-6 sm:p-8" data-html-section-upload @if(old('type', $section->type) !== 'html_section') hidden @endif>
                    <div class="flex flex-col gap-2 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <p class="neutron-kicker">HTML section upload</p>
                            <h2 class="mt-2 text-lg font-medium">Create this section from an HTML file</h2>
                            <p class="mt-2 max-w-2xl text-xs leading-5 text-white/35">You selected <strong class="text-white/55">HTML Upload</strong>. Upload a self-contained .html/.htm file here. Its own HTML, CSS and JavaScript stay isolated in a sandboxed iframe and the height adjusts automatically.</p>
                        </div>
                        @if(data_get($settings,'section_html'))
                            <a href="{{ data_get($settings,'section_html') }}" target="_blank" class="text-xs text-neutron-300">Open current HTML ↗</a>
                        @endif
                    </div>
                    <div class="mt-5 grid gap-5 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <x-input-label for="section_html_file" value="HTML file"/>
                            <input id="section_html_file" type="file" name="section_html_file" accept=".html,.htm,text/html" class="mt-2 block w-full rounded-xl border border-white/10 bg-white/[0.04] text-sm text-white/55 file:mr-4 file:border-0 file:bg-neutron-500/15 file:px-4 file:py-3 file:text-xs file:font-semibold file:text-neutron-200">
                            <p class="mt-2 text-xs text-white/30">Maximum 10 MB per HTML section file. Uploading a new file replaces the current one.</p>
                            <x-input-error class="mt-2" :messages="$errors->get('section_html_file')"/>
                        </div>
                        <div>
                            <x-input-label for="html_min_height" value="Minimum section height (px)"/>
                            <x-text-input id="html_min_height" type="number" min="100" max="5000" name="html_min_height" class="mt-2 block w-full" :value="old('html_min_height', data_get($settings,'html_min_height',320))"/>
                            <p class="mt-2 text-xs text-white/30">Used while the HTML loads; the section then auto-resizes to its content.</p>
                        </div>
                        @if(data_get($settings,'section_html'))
                            <label class="flex items-center gap-3 self-end pb-3 text-sm text-red-200/75"><input type="checkbox" name="remove_section_html" value="1" class="rounded border-white/15 bg-white/5 text-red-400"> Remove current HTML file</label>
                        @endif
                    </div>
                </section>


                <section data-standard-section-fields class="neutron-panel rounded-2xl p-6 sm:p-8">
                    <p class="neutron-kicker">Content</p>
                    <h2 class="mt-2 text-lg font-medium">Main copy and actions</h2>
                    <div class="mt-6 space-y-5">
                        <div>
                            <x-input-label for="body" value="Body / description"/>
                            <textarea id="body" name="body" data-rich-editor rows="10" class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-white">{{ old('body', $section->body) }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('body')"/>
                        </div>
                        <div class="grid gap-5 sm:grid-cols-2">
                            <div><x-input-label for="button_label" value="Primary button label"/><x-text-input id="button_label" name="button_label" class="mt-2 block w-full" :value="old('button_label', $section->button_label)"/></div>
                            <div><x-input-label for="button_url" value="Primary button URL / video URL"/><x-text-input id="button_url" name="button_url" class="mt-2 block w-full" :value="old('button_url', $section->button_url)"/></div>
                            <div><x-input-label for="secondary_button_label" value="Secondary button label"/><x-text-input id="secondary_button_label" name="secondary_button_label" class="mt-2 block w-full" :value="old('secondary_button_label', $section->secondary_button_label)"/></div>
                            <div><x-input-label for="secondary_button_url" value="Secondary button URL"/><x-text-input id="secondary_button_url" name="secondary_button_url" class="mt-2 block w-full" :value="old('secondary_button_url', $section->secondary_button_url)"/></div>
                        </div>
                    </div>
                </section>


                <section data-standard-section-fields class="neutron-panel rounded-2xl p-6 sm:p-8">
                    @include('admin.partials.image-animation-fields', [
                        'title' => 'Section visual',
                        'help' => 'Choose an image or HTML animation for this section. Supported section layouts will render the selected visual automatically.',
                        'currentMediaType' => data_get($settings, 'media_type', 'image'),
                        'currentImage' => data_get($settings, 'image'),
                        'currentImageAlt' => data_get($settings, 'image_alt'),
                        'currentAnimation' => data_get($settings, 'animation_html'),
                    ])

                    <div class="mt-6">
                        @include('admin.partials.image-animation-fields', [
                            'title' => 'Section background visual',
                            'help' => 'Use either a normal background image or a self-contained HTML animation. The website renders HTML in a sandboxed iframe behind the section content.',
                            'mediaTypeName' => 'background_media_type',
                            'imageFileName' => 'background_image_file',
                            'imageAltName' => 'background_image_alt',
                            'animationFileName' => 'background_animation_html_file',
                            'removeImageName' => 'remove_background_image',
                            'removeAnimationName' => 'remove_background_animation',
                            'currentMediaType' => data_get($settings, 'background_media_type', 'image'),
                            'currentImage' => data_get($settings, 'background_image'),
                            'currentImageAlt' => data_get($settings, 'background_image_alt'),
                            'currentAnimation' => data_get($settings, 'background_animation_html'),
                        ])
                    </div>
                </section>

                <section class="neutron-panel rounded-2xl p-6 sm:p-8">
                    <p class="neutron-kicker">Display</p>
                    <h2 class="mt-2 text-lg font-medium">Layout and visibility</h2>
                    <div class="mt-6 grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                        <div><x-input-label for="layout" value="Layout"/><select id="layout" name="layout" class="mt-2 block w-full rounded-lg border-white/10 bg-neutron-900 text-white">@foreach(['default','image_left','image_right','centered','wide'] as $v)<option value="{{ $v }}" @selected(old('layout', data_get($settings,'layout','default'))===$v)>{{ str($v)->replace('_',' ')->title() }}</option>@endforeach</select></div>
                        <div><x-input-label for="alignment" value="Alignment"/><select id="alignment" name="alignment" class="mt-2 block w-full rounded-lg border-white/10 bg-neutron-900 text-white">@foreach(['left','center','right'] as $v)<option value="{{ $v }}" @selected(old('alignment', data_get($settings,'alignment','left'))===$v)>{{ ucfirst($v) }}</option>@endforeach</select></div>
                        <div><x-input-label for="columns" value="Columns"/><select id="columns" name="columns" class="mt-2 block w-full rounded-lg border-white/10 bg-neutron-900 text-white">@foreach([1,2,3,4] as $v)<option value="{{ $v }}" @selected((int)old('columns',data_get($settings,'columns',3))===$v)>{{ $v }}</option>@endforeach</select></div>
                        <div><x-input-label for="theme" value="Style"/><select id="theme" name="theme" class="mt-2 block w-full rounded-lg border-white/10 bg-neutron-900 text-white">@foreach(['default','panel','accent','subtle'] as $v)<option value="{{ $v }}" @selected(old('theme',data_get($settings,'theme','default'))===$v)>{{ ucfirst($v) }}</option>@endforeach</select></div>
                        <div><x-input-label for="sort_order" value="Display order"/><x-text-input id="sort_order" type="number" name="sort_order" class="mt-2 block w-full" :value="old('sort_order',$section->sort_order)"/></div>
                        <label class="flex items-center gap-3 self-end pb-3 text-sm text-white/65"><input type="hidden" name="is_enabled" value="0"><input type="checkbox" name="is_enabled" value="1" @checked(old('is_enabled',$section->is_enabled)) class="rounded border-white/15 bg-white/5 text-neutron-500"> Visible on website</label>
                    </div>
                </section>

                <div class="flex flex-wrap items-center gap-3">
                    <x-primary-button>{{ $isEdit ? 'Save changes' : 'Create section' }}</x-primary-button>
                    <a href="{{ route('admin.pages.edit',$page) }}" class="rounded-lg border border-white/10 px-4 py-2.5 text-sm text-white/55">Cancel</a>
                </div>
            </form>

            <aside class="space-y-6">
                @if($isEdit)
                    <section class="neutron-panel rounded-2xl p-6">
                        <div class="flex items-start justify-between gap-4">
                            <div><p class="neutron-kicker">Repeating content</p><h2 class="mt-2 text-lg font-medium">Section items</h2><p class="mt-2 text-xs leading-5 text-white/35">Use items for cards, features, FAQs, stats, logos, pricing and gallery content.</p></div>
                            <a href="{{ route('admin.items.create',[$page,$section]) }}" class="shrink-0 rounded-lg bg-neutron-300 px-3 py-2 font-mono text-[9px] font-semibold uppercase tracking-wider text-neutron-950">+ Add item</a>
                        </div>
                        <div class="mt-5 space-y-3">
                            @forelse($section->items as $item)
                                <div class="rounded-xl border border-white/10 bg-white/[0.02] p-4">
                                    <div class="flex items-start justify-between gap-3">
                                        <div class="min-w-0"><p class="truncate text-sm font-medium">{{ $item->title ?: $item->value ?: 'Untitled item' }}</p><p class="mt-1 text-xs text-white/30">Order {{ $item->sort_order }} · {{ $item->is_enabled ? 'Visible' : 'Hidden' }}</p></div>
                                        <div class="flex items-center gap-2"><a href="{{ route('admin.items.edit',[$page,$section,$item]) }}" class="text-xs text-neutron-300">Edit</a><form method="POST" action="{{ route('admin.items.destroy',[$page,$section,$item]) }}" class="js-delete-form" data-delete-label="this section item">@csrf @method('DELETE')<button class="text-xs text-red-300">Delete</button></form></div>
                                    </div>
                                </div>
                            @empty
                                <div class="a1-admin-empty">No items yet. Add items when this section needs repeating cards/content.</div>
                            @endforelse
                        </div>
                    </section>

                    @unless((bool)data_get($settings,'protected',false))
                        <section class="rounded-2xl border border-red-300/15 bg-red-500/[0.04] p-6">
                            <h2 class="text-sm font-medium text-red-100">Danger zone</h2>
                            <p class="mt-2 text-xs leading-5 text-white/35">Deleting a section permanently removes its repeating items too.</p>
                            <form method="POST" action="{{ route('admin.sections.destroy',[$page,$section]) }}" class="js-delete-form mt-4" data-delete-label="this section">@csrf @method('DELETE')<button class="rounded-lg border border-red-300/20 px-4 py-2 text-xs text-red-200">Delete section</button></form>
                        </section>
                    @endunless
                @else
                    <section class="neutron-panel rounded-2xl p-6 sm:p-7">
                        <p class="neutron-kicker">HTML section</p>
                        <h2 class="mt-2 text-lg font-medium">Create section from HTML file</h2>
                        <p class="mt-3 text-sm leading-6 text-white/40">Upload a complete <span class="text-white/65">.html</span> or <span class="text-white/65">.htm</span> file here. This creates a new page section directly. It is separate from the HTML animation/media option in the normal section form.</p>

                        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.sections.store-html', $page) }}" class="mt-6 space-y-4">
                            @csrf
                            <div>
                                <x-input-label for="quick_section_html_file" value="HTML section file"/>
                                <input id="quick_section_html_file" type="file" name="section_html_file" accept=".html,.htm,text/html" required class="mt-2 block w-full rounded-xl border border-dashed border-neutron-300/25 bg-neutron-300/[0.04] p-3 text-xs text-white/60 file:mr-3 file:rounded-lg file:border-0 file:bg-neutron-300/15 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-neutron-200">
                                <p class="mt-2 text-xs leading-5 text-white/30">Maximum 10 MB. CSS and JavaScript inside the HTML remain isolated in the section iframe.</p>
                                <x-input-error class="mt-2" :messages="$errors->get('section_html_file')"/>
                            </div>
                            <div>
                                <x-input-label for="quick_html_min_height" value="Minimum height while loading (px)"/>
                                <x-text-input id="quick_html_min_height" type="number" min="100" max="5000" name="html_min_height" class="mt-2 block w-full" value="320"/>
                            </div>
                            <button type="submit" class="inline-flex w-full items-center justify-center rounded-lg bg-neutron-300 px-4 py-3 text-xs font-semibold text-neutron-950 transition hover:bg-neutron-200">Upload HTML &amp; Create Section</button>
                        </form>
                    </section>

                    <section class="neutron-panel rounded-2xl p-6">
                        <p class="neutron-kicker">Normal section</p>
                        <h2 class="mt-2 text-lg font-medium">Create first, then add items</h2>
                        <p class="mt-3 text-sm leading-6 text-white/40">For cards, FAQs, stats and other CMS sections, use the normal form on the left. After saving, repeating items can be added from the section editor.</p>
                    </section>
                @endif
            </aside>
        </div>
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const type = document.getElementById('type');
        const htmlPanel = document.querySelector('[data-html-section-upload]');
        const standardPanels = Array.from(document.querySelectorAll('[data-standard-section-fields]'));
        if (!type || !htmlPanel) return;
        const sync = function () {
            const isHtml = type.value === 'html_section';
            htmlPanel.hidden = !isHtml;
            standardPanels.forEach(function (panel) { panel.hidden = isHtml; });
        };
        type.addEventListener('change', sync);
        sync();
    });
    </script>
</x-app-layout>
