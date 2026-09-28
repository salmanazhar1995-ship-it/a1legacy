<x-app-layout>
    <main class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        <a href="{{ route('admin.gallery.index') }}" class="text-sm text-white/35">← Gallery</a>
        <h1 class="mt-3 text-3xl font-medium text-white">{{ $gallery->exists ? 'Edit gallery item' : 'Add gallery item' }}</h1>

        @if($errors->any())
            <div class="mt-6 rounded-xl border border-red-300/20 bg-red-400/10 px-4 py-3 text-sm text-red-100">Please check the highlighted fields and try again.</div>
        @endif

        <form method="POST" enctype="multipart/form-data" action="{{ $gallery->exists ? route('admin.gallery.update',$gallery) : route('admin.gallery.store') }}" class="neutron-panel mt-8 rounded-2xl p-6 sm:p-8">
            @csrf
            @if($gallery->exists) @method('PUT') @endif

            <div class="grid gap-6 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <x-input-label for="title" value="Title"/>
                    <x-text-input id="title" name="title" class="mt-2 block w-full" :value="old('title',$gallery->title)" required/>
                    <x-input-error class="mt-2" :messages="$errors->get('title')"/>
                </div>
                <div>
                    <x-input-label for="slug" value="Slug"/>
                    <x-text-input id="slug" name="slug" class="mt-2 block w-full" :value="old('slug',$gallery->slug)"/>
                    <x-input-error class="mt-2" :messages="$errors->get('slug')"/>
                </div>
                <div>
                    <x-input-label for="category" value="Category"/>
                    <x-text-input id="category" name="category" class="mt-2 block w-full" :value="old('category',$gallery->category)"/>
                </div>
                <div>
                    <x-input-label for="eyebrow" value="Small label"/>
                    <x-text-input id="eyebrow" name="eyebrow" class="mt-2 block w-full" :value="old('eyebrow',$gallery->eyebrow)"/>
                </div>
                <div>
                    <x-input-label for="client" value="Client / business (optional)"/>
                    <x-text-input id="client" name="client" class="mt-2 block w-full" :value="old('client',$gallery->client)"/>
                </div>
                <div>
                    <x-input-label for="project_date" value="Project date"/>
                    <x-text-input id="project_date" type="date" name="project_date" class="mt-2 block w-full" :value="old('project_date',optional($gallery->project_date)->format('Y-m-d'))"/>
                </div>
                <div>
                    <x-input-label for="sort_order" value="Sort order"/>
                    <x-text-input id="sort_order" type="number" name="sort_order" class="mt-2 block w-full" :value="old('sort_order',$gallery->sort_order??0)"/>
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="excerpt" value="Short summary"/>
                    <textarea id="excerpt" name="excerpt" rows="3" class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-white" required>{{ old('excerpt',$gallery->excerpt) }}</textarea>
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="description" value="Full detail content"/>
                    <textarea id="description" name="description" data-rich-editor rows="9" class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-white">{{ old('description',$gallery->description) }}</textarea>
                </div>

                <div class="sm:col-span-2">
                    @include('admin.partials.seo-fields', ['seoModel' => $gallery])
                </div>

                <div class="sm:col-span-2">
                    @include('admin.partials.image-animation-fields', [
                        'title' => 'Gallery visual',
                        'help' => 'Choose an image or HTML animation for gallery cards, homepage showcase and the gallery detail page.',
                        'currentMediaType' => $gallery->media_type ?: 'image',
                        'currentImage' => $gallery->image_url,
                        'currentImageAlt' => $gallery->image_alt,
                        'currentAnimation' => $gallery->animation_html_url,
                    ])
                </div>

                <div class="sm:col-span-2">
                    <x-input-label value="Tags (one per row)"/>
                    <textarea name="tags_text" rows="4" class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-white">{{ old('tags_text',collect($gallery->tags)->filter()->implode("\n")) }}</textarea>
                </div>
                <div class="sm:col-span-2 grid gap-3 sm:grid-cols-2">
                    <label class="rounded-xl border border-white/10 p-4 text-sm text-white/65">
                        <input type="hidden" name="is_featured" value="0">
                        <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured',$gallery->is_featured))> Show on homepage
                    </label>
                    <label class="rounded-xl border border-white/10 p-4 text-sm text-white/65">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" @checked(old('is_active',$gallery->is_active))> Published
                    </label>
                </div>
            </div>

            <div class="mt-8"><x-primary-button>Save gallery item</x-primary-button></div>
        </form>
    </main>
</x-app-layout>
