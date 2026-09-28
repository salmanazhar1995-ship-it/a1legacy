<x-app-layout>
    @php($isEdit = $industry->exists)
    <main class="mx-auto max-w-4xl px-4 py-10 sm:px-6 lg:px-8">
        <div>
            <a href="{{ route('admin.industries.index') }}" class="text-sm text-white/35 transition hover:text-white">&larr; Main Industries</a>
            <p class="neutron-kicker mt-5">Industry structure</p>
            <h1 class="mt-2 text-3xl font-medium tracking-tight text-white">{{ $isEdit ? 'Edit Main Industry' : 'Add Main Industry' }}</h1>
        </div>
        @if($errors->any())<div class="mt-6 rounded-xl border border-red-300/20 bg-red-500/10 p-4 text-sm text-red-100">Please review the highlighted fields.</div>@endif

        <form method="POST" action="{{ $isEdit ? route('admin.industries.update', $industry) : route('admin.industries.store') }}" class="neutron-panel mt-8 space-y-6 rounded-2xl p-6 sm:p-8" data-unsaved-warning="true">
            @csrf
            @if($isEdit) @method('PUT') @endif
            <div class="grid gap-5 sm:grid-cols-2">
                <div><x-input-label for="name" value="Main industry name"/><x-text-input id="name" name="name" class="mt-2 block w-full" :value="old('name', $industry->name)" placeholder="Insurance" required/><x-input-error class="mt-2" :messages="$errors->get('name')"/></div>
                <div><x-input-label for="slug" value="Slug"/><x-text-input id="slug" name="slug" class="mt-2 block w-full" :value="old('slug', $industry->slug)" placeholder="insurance"/><p class="mt-2 text-xs text-white/30">Leave blank to generate it from the name.</p><x-input-error class="mt-2" :messages="$errors->get('slug')"/></div>
                <div class="sm:col-span-2"><x-input-label for="description" value="Short description"/><textarea id="description" name="description" rows="5" class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-sm text-white focus:border-neutron-500 focus:ring-neutron-500">{{ old('description', $industry->description) }}</textarea><x-input-error class="mt-2" :messages="$errors->get('description')"/></div>
                <label class="rounded-xl border border-white/10 p-4 text-sm text-white/65"><input type="hidden" name="is_active" value="0"><input type="checkbox" name="is_active" value="1" @checked(old('is_active', $industry->is_active ?? true)) class="mr-2 rounded border-white/15 bg-white/5 text-neutron-500">Show on the website</label>
                <div><x-input-label for="sort_order" value="Display order"/><x-text-input id="sort_order" type="number" min="0" max="65535" name="sort_order" class="mt-2 block w-full" :value="old('sort_order', $industry->sort_order ?? 0)" required/><x-input-error class="mt-2" :messages="$errors->get('sort_order')"/></div>
            </div>
            <div class="flex flex-wrap gap-3"><x-primary-button>{{ $isEdit ? 'Save Changes' : 'Create Main Industry' }}</x-primary-button><a href="{{ route('admin.industries.index') }}" class="inline-flex items-center rounded-lg border border-white/10 px-4 py-2 text-sm text-white/50 transition hover:bg-white/5 hover:text-white">Cancel</a></div>
        </form>
    </main>
</x-app-layout>
