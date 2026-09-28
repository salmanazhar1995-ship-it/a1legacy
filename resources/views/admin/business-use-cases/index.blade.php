<x-app-layout>
    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-5 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <p class="neutron-kicker">Homepage content</p>
                <h1 class="mt-2 text-3xl font-medium tracking-tight text-white">Sub Industries</h1>
                <p class="mt-2 max-w-2xl text-sm leading-6 text-white/40">Manage second-level options and their detailed homepage content. Each item also gets its own detail page.</p>
            </div>
            <a href="{{ route('admin.business-use-cases.create') }}" class="inline-flex items-center justify-center rounded-xl bg-neutron-300 px-5 py-3 text-sm font-semibold text-neutron-950 transition hover:bg-white">+ Add Sub Industry</a>
        </div>

        @if(session('success'))
            <div class="mt-6 rounded-xl border border-emerald-300/20 bg-emerald-300/10 p-4 text-sm text-emerald-100">{{ session('success') }}</div>
        @endif

        <div class="mt-6 grid gap-3 sm:grid-cols-3">
            <div class="rounded-xl border border-white/10 bg-white/[0.025] p-4"><p class="font-mono text-[9px] uppercase tracking-[.16em] text-white/30">Frontend</p><p class="mt-2 text-sm text-white/70">Interactive industry selector</p></div>
            <div class="rounded-xl border border-white/10 bg-white/[0.025] p-4"><p class="font-mono text-[9px] uppercase tracking-[.16em] text-white/30">Images</p><p class="mt-2 text-sm text-white/70">FilePond upload + preview</p></div>
            <div class="rounded-xl border border-white/10 bg-white/[0.025] p-4"><p class="font-mono text-[9px] uppercase tracking-[.16em] text-white/30">Visibility</p><p class="mt-2 text-sm text-white/70">Show or hide each industry</p></div>
        </div>

        <section class="neutron-panel mt-8 overflow-hidden rounded-2xl p-4 sm:p-5">
            <div class="overflow-x-auto">
                <table class="js-yajra-table min-w-full" data-url="{{ route('admin.data.business-use-cases') }}" data-order-column="2" data-order-direction="asc">
                    <thead>
                        <tr class="text-left font-mono text-[10px] uppercase tracking-wider text-white/35">
                            <th data-data="business" data-name="title">Sub Industry</th>
                            <th data-data="status" data-name="is_active" data-searchable="false">Status</th>
                            <th data-data="sort_order" data-name="sort_order">Order</th>
                            <th data-data="actions" data-orderable="false" data-searchable="false" data-class="text-right">Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </section>
    </main>
</x-app-layout>
