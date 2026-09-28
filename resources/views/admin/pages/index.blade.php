<x-app-layout>
    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="flex flex-col justify-between gap-4 sm:flex-row sm:items-end">
            <div>
                <p class="neutron-kicker">Content &amp; navigation</p>
                <h1 class="mt-3 text-3xl font-medium tracking-tight">Pages &amp; Navbar</h1>
                <p class="mt-2 max-w-2xl text-sm text-white/40">Create pages, add navbar tabs, and control whether every page and navigation item is enabled or disabled.</p>
            </div>
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('home') }}" target="_blank" class="rounded-lg border border-white/10 px-4 py-2.5 text-sm text-white/65">Open website ↗</a>
                <a href="{{ route('admin.pages.create') }}" class="rounded-lg bg-neutron-300 px-4 py-2.5 text-sm font-semibold text-neutron-950">+ Create Navbar Page</a>
            </div>
        </div>

        @if(session('success'))<div class="mt-6 rounded-xl border border-emerald-300/20 bg-emerald-300/10 p-4 text-sm text-emerald-200">{{ session('success') }}</div>@endif

        <div class="mt-6 grid gap-3 sm:grid-cols-3">
            <div class="rounded-xl border border-white/10 bg-white/[0.025] p-4"><p class="font-mono text-[9px] uppercase tracking-[.16em] text-white/30">Page switch</p><p class="mt-2 text-sm text-white/70">Enable or disable any public page.</p></div>
            <div class="rounded-xl border border-white/10 bg-white/[0.025] p-4"><p class="font-mono text-[9px] uppercase tracking-[.16em] text-white/30">Navbar switch</p><p class="mt-2 text-sm text-white/70">Show or hide its navigation tab independently.</p></div>
            <div class="rounded-xl border border-white/10 bg-white/[0.025] p-4"><p class="font-mono text-[9px] uppercase tracking-[.16em] text-white/30">Page builder</p><p class="mt-2 text-sm text-white/70">Create, hide and reorder sections per page.</p></div>
        </div>

        <section class="neutron-panel mt-8 overflow-hidden rounded-2xl p-4 sm:p-5">
            <div class="overflow-x-auto">
                <table class="js-yajra-table min-w-full" data-url="{{ route('admin.data.pages') }}" data-order-column="0" data-order-direction="asc">
                    <thead><tr class="text-left font-mono text-[10px] uppercase tracking-wider text-white/35"><th data-data="page" data-name="title">Page</th><th data-data="template" data-name="template">Template</th><th data-data="sections_count" data-name="sections_count" data-searchable="false">Sections</th><th data-data="status" data-name="is_published" data-searchable="false">Status</th><th data-data="actions" data-orderable="false" data-searchable="false" data-class="text-right">Actions</th></tr></thead>
                </table>
            </div>
        </section>
    </main>
</x-app-layout>
