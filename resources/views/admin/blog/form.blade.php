<x-app-layout>
    <main class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <a href="{{ route('admin.blog.index') }}" class="text-sm text-white/35 transition hover:text-white">← Blog posts</a>
                <h1 class="mt-3 text-3xl font-medium tracking-tight text-white">{{ $blogPost->exists ? 'Edit blog post' : 'Create blog post' }}</h1>
            </div>
            @if($blogPost->exists && $blogPost->is_published)
                <a href="{{ route('blog.show', $blogPost->slug) }}" target="_blank" class="rounded-lg border border-white/10 px-4 py-2.5 text-sm text-white/65 transition hover:bg-white/5 hover:text-white">Preview ↗</a>
            @endif
        </div>

        @if(session('success'))
            <div class="mt-6 rounded-xl border border-emerald-300/20 bg-emerald-300/10 p-4 text-sm text-emerald-200">{{ session('success') }}</div>
        @endif

        <form method="POST" enctype="multipart/form-data" action="{{ $blogPost->exists ? route('admin.blog.update', $blogPost) : route('admin.blog.store') }}" class="mt-8 grid gap-6 lg:grid-cols-[1fr_320px]">
            @csrf
            @if($blogPost->exists) @method('PUT') @endif

            <section class="neutron-panel rounded-2xl p-6 sm:p-8">
                <div class="space-y-6">
                    <div>
                        <x-input-label for="title" value="Post title"/>
                        <x-text-input id="title" name="title" class="mt-2 block w-full" :value="old('title', $blogPost->title)" required autofocus/>
                        <x-input-error class="mt-2" :messages="$errors->get('title')"/>
                    </div>

                    <div>
                        <x-input-label for="slug" value="URL slug"/>
                        <x-text-input id="slug" name="slug" class="mt-2 block w-full" :value="old('slug', $blogPost->slug)" placeholder="leave blank to generate from title"/>
                        <p class="mt-2 text-xs text-white/30">Example: ai-receptionist-for-service-businesses</p>
                        <x-input-error class="mt-2" :messages="$errors->get('slug')"/>
                    </div>

                    <div>
                        <x-input-label for="excerpt" value="Short excerpt"/>
                        <textarea id="excerpt" name="excerpt" rows="4" class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-white focus:border-neutron-500 focus:ring-neutron-500" placeholder="Short summary shown on the Blog page">{{ old('excerpt', $blogPost->excerpt) }}</textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('excerpt')"/>
                    </div>

                    <div>
                        <x-input-label for="body" value="Article content"/>
                        <textarea id="body" name="body" rows="20" class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] font-sans text-white focus:border-neutron-500 focus:ring-neutron-500" required>{{ old('body', $blogPost->body) }}</textarea>
                        <p class="mt-2 text-xs text-white/30">Use blank lines between paragraphs. Content is rendered safely as text on the public page.</p>
                        <x-input-error class="mt-2" :messages="$errors->get('body')"/>
                    </div>
                </div>
            </section>

            <aside class="space-y-6">
                <section class="neutron-panel rounded-2xl p-5">
                    <h2 class="font-medium text-white">Publishing</h2>
                    <div class="mt-5 space-y-5">
                        <label class="flex items-center gap-3 text-sm text-white/65">
                            <input type="hidden" name="is_published" value="0">
                            <input type="checkbox" name="is_published" value="1" @checked(old('is_published', $blogPost->is_published)) class="rounded border-white/15 bg-white/5 text-neutron-500 focus:ring-neutron-500">
                            Published
                        </label>

                        <div>
                            <x-input-label for="published_at" value="Publish date / time"/>
                            <input id="published_at" name="published_at" type="datetime-local" value="{{ old('published_at', $blogPost->published_at?->format('Y-m-d\TH:i')) }}" class="mt-2 block w-full rounded-lg border-white/10 bg-neutron-900 text-sm text-white focus:border-neutron-500 focus:ring-neutron-500">
                            <x-input-error class="mt-2" :messages="$errors->get('published_at')"/>
                        </div>

                        <div>
                            <x-input-label for="author_name" value="Author"/>
                            <x-text-input id="author_name" name="author_name" class="mt-2 block w-full" :value="old('author_name', $blogPost->author_name)"/>
                            <x-input-error class="mt-2" :messages="$errors->get('author_name')"/>
                        </div>

                        <x-primary-button class="w-full justify-center">{{ $blogPost->exists ? 'Save post' : 'Create post' }}</x-primary-button>
                    </div>
                </section>

                @include('admin.partials.seo-fields', ['seoModel' => $blogPost])

                <section class="neutron-panel rounded-2xl p-5">
                    @include('admin.partials.image-animation-fields', [
                        'title' => 'Featured visual',
                        'help' => 'Choose a featured image or HTML animation for blog cards and the article page.',
                        'mediaTypeName' => 'featured_media_type',
                        'imageFileName' => 'featured_image_file',
                        'imageAltName' => 'featured_image_alt',
                        'animationFileName' => 'featured_animation_html_file',
                        'removeImageName' => 'remove_featured_image',
                        'removeAnimationName' => 'remove_featured_animation',
                        'currentMediaType' => $blogPost->featured_media_type ?: 'image',
                        'currentImage' => $blogPost->featured_image,
                        'currentImageAlt' => $blogPost->featured_image_alt,
                        'currentAnimation' => $blogPost->featured_animation_html_url,
                    ])

                    <div class="mt-4">
                        <x-input-label for="featured_image_url" value="Existing image URL (optional)"/>
                        <x-text-input id="featured_image_url" name="featured_image_url" class="mt-2 block w-full" :value="old('featured_image_url', $blogPost->featured_image)"/>
                    </div>
                </section>

                @if($blogPost->exists)
                    <section class="rounded-2xl border border-red-300/15 bg-red-400/[0.04] p-5">
                        <h2 class="font-medium text-red-100">Delete post</h2>
                        <p class="mt-2 text-xs leading-5 text-white/35">Deleting a post is permanent.</p>
                        <button type="submit" form="delete-blog-post" class="mt-4 rounded-lg border border-red-300/20 px-4 py-2 text-sm text-red-200 transition hover:bg-red-400/10" onclick="return confirm('Delete this blog post permanently?')">Delete post</button>
                    </section>
                @endif
            </aside>
        </form>

        @if($blogPost->exists)
            <form id="delete-blog-post" method="POST" action="{{ route('admin.blog.destroy', $blogPost) }}" class="hidden">
                @csrf
                @method('DELETE')
            </form>
        @endif
    </main>
</x-app-layout>
