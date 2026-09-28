<x-app-layout>
    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <a href="{{ route('admin.pages.index') }}" class="text-sm text-white/35 hover:text-white">← All pages</a>
                <h1 class="mt-3 text-3xl font-medium tracking-tight">{{ $page->title }}</h1>
                <p class="mt-2 text-sm text-white/40">Manage page settings and arrange the sections shown on the public page.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ url($page->slug === 'home' ? '/' : '/'.$page->slug) }}" target="_blank" class="rounded-lg border border-white/10 px-4 py-2.5 text-sm text-white/65">Preview page ↗</a>
                <a href="{{ route('admin.sections.create',$page) }}" class="rounded-lg bg-neutron-300 px-4 py-2.5 text-sm font-semibold text-neutron-950">+ Add Section</a>
            </div>
        </div>

        @if(session('success'))<div class="mt-6 rounded-xl border border-emerald-300/20 bg-emerald-300/10 p-4 text-sm text-emerald-200">{{ session('success') }}</div>@endif
        @if($errors->any())<div class="mt-6 rounded-xl border border-red-300/20 bg-red-500/10 p-4 text-sm text-red-100">Please review the form and try again.</div>@endif

        <div class="mt-8 grid gap-5 xl:grid-cols-[.72fr_1.28fr]">
            <form method="POST" action="{{ route('admin.pages.update',$page) }}" data-unsaved-warning="true" class="neutron-panel rounded-2xl p-6">
                @csrf @method('PUT')
                <div><p class="neutron-kicker">Page settings</p><h2 class="mt-2 text-lg font-medium">Navigation & SEO</h2></div>
                <div class="mt-6 flex flex-col gap-5">
                    <div><x-input-label for="title" value="Page title"/><x-text-input id="title" name="title" class="mt-2 block w-full" :value="old('title',$page->title)"/><x-input-error class="mt-2" :messages="$errors->get('title')"/></div>
                    <div><x-input-label for="slug" value="URL slug"/><x-text-input id="slug" name="slug" class="mt-2 block w-full" :value="old('slug',$page->slug)"/><p class="mt-2 text-xs text-white/30">Used in the page URL. Keep it short and readable.</p><x-input-error class="mt-2" :messages="$errors->get('slug')"/></div>
                    <div><x-input-label for="navigation_label" value="Navigation label"/><x-text-input id="navigation_label" name="navigation_label" class="mt-2 block w-full" :value="old('navigation_label',$page->navigation_label)"/></div>
                    <div><x-input-label for="template" value="Template"/><select id="template" name="template" class="mt-2 block w-full rounded-lg border-white/10 bg-neutron-900 text-white focus:border-neutron-500 focus:ring-neutron-500">@foreach(['home','products','blog','standard','contact','legal'] as $template)<option value="{{ $template }}" @selected(old('template',$page->template)===$template)>{{ str($template)->title() }}</option>@endforeach</select></div>
                    <div><x-input-label for="seo_title" value="SEO title"/><x-text-input id="seo_title" name="seo_title" class="mt-2 block w-full" :value="old('seo_title',$page->seo_title)" maxlength="70"/><x-input-error class="mt-2" :messages="$errors->get('seo_title')"/></div>
                    <div><x-input-label for="meta_keywords" value="SEO keywords"/><x-text-input id="meta_keywords" name="meta_keywords" class="mt-2 block w-full" :value="old('meta_keywords',$page->meta_keywords)" maxlength="500" placeholder="keyword one, keyword two"/><x-input-error class="mt-2" :messages="$errors->get('meta_keywords')"/></div>
                    <div><x-input-label for="meta_description" value="SEO description (CKEditor)"/><textarea id="meta_description" name="meta_description" rows="6" data-rich-editor class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-white focus:border-neutron-500 focus:ring-neutron-500">{{ old('meta_description',$page->meta_description) }}</textarea><x-input-error class="mt-2" :messages="$errors->get('meta_description')"/></div>
                    <div><x-input-label for="sort_order" value="Navigation order"/><x-text-input id="sort_order" type="number" name="sort_order" class="mt-2 block w-full" :value="old('sort_order',$page->sort_order)"/></div>
                    <label class="flex items-center gap-3 text-sm text-white/65"><input type="hidden" name="is_published" value="0"><input type="checkbox" name="is_published" value="1" @checked(old('is_published',$page->is_published)) class="rounded border-white/15 bg-white/5 text-neutron-500 focus:ring-neutron-500">Enable public page</label>
                    <label class="flex items-center gap-3 text-sm text-white/65"><input type="hidden" name="show_in_navigation" value="0"><input type="checkbox" name="show_in_navigation" value="1" @checked(old('show_in_navigation',$page->show_in_navigation)) class="rounded border-white/15 bg-white/5 text-neutron-500 focus:ring-neutron-500">Enable navbar tab</label>
                    <x-primary-button>Save page</x-primary-button>
                </div>
            </form>

            <section class="neutron-panel rounded-2xl p-6">
                <div class="flex items-start justify-between gap-4">
                    <div><p class="neutron-kicker">Page builder</p><h2 class="mt-2 text-lg font-medium">Content sections</h2><p class="mt-2 text-xs leading-5 text-white/35">Edit, hide, reorder or delete sections. Add a custom section without touching code.</p></div>
                    <a href="{{ route('admin.sections.create',$page) }}" class="shrink-0 rounded-lg bg-neutron-300 px-4 py-2.5 text-xs font-semibold text-neutron-950">+ Add Section</a>
                </div>

                <div class="mt-6 space-y-3">
                    @forelse($page->sections as $section)
                        @php($protected=(bool)data_get($section->settings,'protected',false))
                        <div class="rounded-xl border border-white/10 bg-white/[0.025] p-4">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                                <div class="min-w-0">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <p class="truncate font-medium">{{ $section->heading ?: str($section->key)->replace('-',' ')->title() }}</p>
                                        <span class="rounded-full bg-neutron-500/10 px-2 py-1 font-mono text-[8px] uppercase tracking-wider text-neutron-200">{{ str($section->type)->replace('_',' ')->title() }}</span>
                                        @unless($section->is_enabled)<span class="rounded-full bg-white/5 px-2 py-1 font-mono text-[8px] uppercase text-white/30">Hidden</span>@endunless
                                        @if($protected)<span class="rounded-full bg-amber-300/10 px-2 py-1 font-mono text-[8px] uppercase text-amber-200">Protected</span>@endif
                                    </div>
                                    <p class="mt-2 font-mono text-[9px] uppercase tracking-wider text-white/25">{{ $section->items_count }} items · order {{ $section->sort_order }}</p>
                                </div>
                                <div class="flex flex-wrap items-center gap-2">
                                    <form method="POST" action="{{ route('admin.sections.move-up',[$page,$section]) }}">@csrf<button class="rounded-lg border border-white/10 px-2.5 py-2 text-xs text-white/55" title="Move up">↑</button></form>
                                    <form method="POST" action="{{ route('admin.sections.move-down',[$page,$section]) }}">@csrf<button class="rounded-lg border border-white/10 px-2.5 py-2 text-xs text-white/55" title="Move down">↓</button></form>
                                    <form method="POST" action="{{ route('admin.sections.toggle',[$page,$section]) }}">@csrf<button class="rounded-lg border border-white/10 px-3 py-2 text-xs {{ $section->is_enabled ? 'text-amber-200' : 'text-emerald-200' }}">{{ $section->is_enabled ? 'Disable' : 'Enable' }}</button></form>
                                    <a href="{{ route('admin.sections.edit',[$page,$section]) }}" class="rounded-lg border border-neutron-300/20 px-3 py-2 text-xs text-neutron-200">Edit</a>
                                    @unless($protected)
                                        <form method="POST" action="{{ route('admin.sections.destroy',[$page,$section]) }}" class="js-delete-form" data-delete-label="this section">@csrf @method('DELETE')<button class="rounded-lg border border-red-300/15 px-3 py-2 text-xs text-red-200">Delete</button></form>
                                    @endunless
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="a1-admin-empty"><p>No sections yet.</p><a href="{{ route('admin.sections.create',$page) }}" class="mt-4 inline-flex rounded-lg bg-neutron-300 px-4 py-2.5 text-sm font-semibold text-neutron-950">Add first section</a></div>
                    @endforelse
                </div>
            </section>
        </div>
    </main>
</x-app-layout>
