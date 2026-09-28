<x-app-layout>
    <main class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        <a href="{{ route('admin.client-stories.index') }}" class="text-sm text-white/35">← Client Stories</a>
        <h1 class="mt-3 text-3xl font-medium text-white">{{ $story->exists ? 'Edit client story' : 'Add client story' }}</h1>
        <p class="mt-2 text-sm text-white/40">Public visibility requires Active + Client approved public use.</p>

        <form method="POST" enctype="multipart/form-data" action="{{ $story->exists ? route('admin.client-stories.update', $story) : route('admin.client-stories.store') }}" class="neutron-panel mt-8 rounded-2xl p-6 sm:p-8">
            @csrf
            @if($story->exists) @method('PUT') @endif

            <div class="grid gap-6 sm:grid-cols-2">
                <div><x-input-label for="person_name" value="Person Name"/><x-text-input id="person_name" name="person_name" class="mt-2 block w-full" :value="old('person_name',$story->person_name)" required/></div>
                <div><x-input-label for="business_name" value="Business Name"/><x-text-input id="business_name" name="business_name" class="mt-2 block w-full" :value="old('business_name',$story->business_name)" required/></div>
                <div><x-input-label for="role" value="Role / Position"/><x-text-input id="role" name="role" class="mt-2 block w-full" :value="old('role',$story->role)"/></div>
                <div><x-input-label for="sort_order" value="Sort order"/><x-text-input id="sort_order" type="number" name="sort_order" class="mt-2 block w-full" :value="old('sort_order',$story->sort_order??0)"/></div>
                <div class="sm:col-span-2"><x-input-label for="implementation_label" value="Implemented"/><x-text-input id="implementation_label" name="implementation_label" class="mt-2 block w-full" :value="old('implementation_label',$story->implementation_label)" placeholder="Voice AI + Booking & CRM Automation"/></div>
                <div class="sm:col-span-2"><x-input-label for="approved_quote" value="Approved quote (optional)"/><textarea id="approved_quote" name="approved_quote" rows="4" class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-white">{{ old('approved_quote',$story->approved_quote) }}</textarea></div>

                <div class="sm:col-span-2 rounded-xl border border-white/10 p-5">
                    <h2 class="text-white">Client video</h2>
                    <p class="mt-1 text-xs text-white/35">Hosted YouTube/Vimeo/direct URL or upload MP4/WebM up to 80 MB.</p>
                    <div class="mt-4 grid gap-4 sm:grid-cols-2">
                        <div><x-input-label for="video_url" value="Hosted video URL"/><x-text-input id="video_url" name="video_url" class="mt-2 block w-full" :value="old('video_url', (str_starts_with((string) $story->video_url, '/media/') || str_starts_with((string) $story->video_url, '/storage/')) ? '' : $story->video_url)"/></div>
                        <div><x-input-label for="video_file" value="Upload video"/><input id="video_file" name="video_file" type="file" accept=".mp4,.webm" class="mt-2 block w-full rounded-lg border border-white/10 p-3 text-white/60"></div>
                    </div>
                    @if($story->video_url)
                        <p class="mt-3 break-all text-xs text-white/35">Current: {{ $story->video_url }}</p>
                        <label class="mt-2 block text-sm text-white/50"><input type="checkbox" name="remove_video" value="1"> Remove current video</label>
                    @endif
                </div>

                <div class="sm:col-span-2">
                    @include('admin.partials.image-animation-fields', [
                        'title' => 'Video poster / thumbnail visual',
                        'help' => 'Use an SEO-friendly image or a self-contained HTML animation as the visual cover shown before the client video.',
                        'mediaTypeName' => 'poster_media_type',
                        'imageFileName' => 'poster_image_file',
                        'imageAltName' => 'poster_image_alt',
                        'animationFileName' => 'poster_animation_html_file',
                        'removeImageName' => 'remove_poster_image',
                        'removeAnimationName' => 'remove_poster_animation',
                        'currentMediaType' => $story->poster_media_type ?: 'image',
                        'currentImage' => $story->poster_image_url,
                        'currentImageAlt' => $story->poster_image_alt,
                        'currentAnimation' => $story->poster_animation_html_url,
                    ])
                </div>

                <div class="sm:col-span-2 grid gap-3 sm:grid-cols-3">
                    <label class="rounded-xl border border-white/10 p-4 text-sm text-white/65"><input type="hidden" name="is_featured" value="0"><input type="checkbox" name="is_featured" value="1" @checked(old('is_featured',$story->is_featured))> Homepage</label>
                    <label class="rounded-xl border border-white/10 p-4 text-sm text-white/65"><input type="hidden" name="is_active" value="0"><input type="checkbox" name="is_active" value="1" @checked(old('is_active',$story->is_active))> Active</label>
                    <label class="rounded-xl border border-amber-300/20 p-4 text-sm text-amber-100"><input type="hidden" name="is_approved_for_public_use" value="0"><input type="checkbox" name="is_approved_for_public_use" value="1" @checked(old('is_approved_for_public_use',$story->is_approved_for_public_use))> Client approved public use</label>
                </div>
            </div>

            <div class="mt-8"><x-primary-button>Save client story</x-primary-button></div>
        </form>
    </main>
</x-app-layout>
