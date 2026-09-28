<x-app-layout>
    <main class="mx-auto max-w-4xl px-4 py-10 sm:px-6 lg:px-8">
        <div>
            <a href="{{ route('admin.pages.index') }}" class="text-sm text-white/35 hover:text-white">← Pages &amp; navigation</a>
            <p class="neutron-kicker mt-5">Navbar page builder</p>
            <h1 class="mt-2 text-3xl font-medium tracking-tight text-white">Create a new navbar tab &amp; page</h1>
            <p class="mt-2 max-w-2xl text-sm leading-6 text-white/40">This creates the public page and, when enabled, adds its tab to the main navigation automatically. A starter hero section is created for you.</p>
        </div>

        @if($errors->any())<div class="mt-6 rounded-xl border border-red-300/20 bg-red-500/10 p-4 text-sm text-red-100">Please review the form and try again.</div>@endif

        <form method="POST" action="{{ route('admin.pages.store') }}" class="neutron-panel mt-8 rounded-2xl p-6 sm:p-8" data-unsaved-warning="true">
            @csrf
            <div class="grid gap-5 sm:grid-cols-2">
                <div class="sm:col-span-2"><x-input-label for="title" value="Page title"/><x-text-input id="title" name="title" class="mt-2 block w-full" :value="old('title')" placeholder="Industries" required/><x-input-error class="mt-2" :messages="$errors->get('title')"/></div>
                <div><x-input-label for="navigation_label" value="Navbar tab label"/><x-text-input id="navigation_label" name="navigation_label" class="mt-2 block w-full" :value="old('navigation_label')" placeholder="Industries"/></div>
                <div><x-input-label for="slug" value="URL slug"/><x-text-input id="slug" name="slug" class="mt-2 block w-full" :value="old('slug')" placeholder="industries"/><p class="mt-2 text-xs text-white/30">Leave empty and it will be generated from the title.</p><x-input-error class="mt-2" :messages="$errors->get('slug')"/></div>
                <div><x-input-label for="template" value="Page template"/><select id="template" name="template" class="mt-2 block w-full rounded-lg border-white/10 bg-neutron-900 text-white focus:border-neutron-500 focus:ring-neutron-500"><option value="standard" @selected(old('template','standard')==='standard')>Standard</option><option value="contact" @selected(old('template')==='contact')>Contact</option><option value="legal" @selected(old('template')==='legal')>Legal</option></select></div>
                <div><x-input-label for="sort_order" value="Navbar order"/><x-text-input id="sort_order" type="number" min="0" max="1000" name="sort_order" class="mt-2 block w-full" :value="old('sort_order',$page->sort_order)"/></div>
                <div class="sm:col-span-2"><x-input-label for="seo_title" value="SEO title"/><x-text-input id="seo_title" name="seo_title" class="mt-2 block w-full" :value="old('seo_title')" maxlength="70" placeholder="Search result title"/><x-input-error class="mt-2" :messages="$errors->get('seo_title')"/></div>
                <div class="sm:col-span-2"><x-input-label for="meta_keywords" value="SEO keywords"/><x-text-input id="meta_keywords" name="meta_keywords" class="mt-2 block w-full" :value="old('meta_keywords')" maxlength="500" placeholder="keyword one, keyword two, keyword three"/><x-input-error class="mt-2" :messages="$errors->get('meta_keywords')"/></div>
                <div class="sm:col-span-2"><x-input-label for="meta_description" value="SEO description (CKEditor)"/><textarea id="meta_description" name="meta_description" rows="6" data-rich-editor class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-white focus:border-neutron-500 focus:ring-neutron-500">{{ old('meta_description') }}</textarea><x-input-error class="mt-2" :messages="$errors->get('meta_description')"/></div>
            </div>

            <div class="mt-6 grid gap-3 sm:grid-cols-2">
                <label class="rounded-xl border border-white/10 bg-white/[0.02] p-4 text-sm text-white/65"><input type="hidden" name="is_published" value="0"><input type="checkbox" name="is_published" value="1" @checked(old('is_published',true)) class="mr-2 rounded border-white/15 bg-white/5 text-neutron-500"> Enable public page</label>
                <label class="rounded-xl border border-white/10 bg-white/[0.02] p-4 text-sm text-white/65"><input type="hidden" name="show_in_navigation" value="0"><input type="checkbox" name="show_in_navigation" value="1" @checked(old('show_in_navigation',true)) class="mr-2 rounded border-white/15 bg-white/5 text-neutron-500"> Enable navbar tab</label>
            </div>

            <div class="mt-7 flex flex-wrap gap-3"><x-primary-button>Create Navbar Page</x-primary-button><a href="{{ route('admin.pages.index') }}" class="inline-flex items-center rounded-lg border border-white/10 px-4 py-2 text-sm text-white/50">Cancel</a></div>
        </form>
    </main>
</x-app-layout>
