<x-app-layout>
    <main class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        <a href="{{ route('admin.portfolio.index') }}" class="text-sm text-white/35 transition hover:text-white">← Portfolio</a>
        <p class="mt-6 font-mono text-[10px] uppercase tracking-[0.18em] text-neutron-300">Project content</p>
        <h1 class="mt-3 text-3xl font-medium text-white">{{ $portfolio->exists ? 'Edit portfolio project' : 'Add portfolio project' }}</h1>
        <p class="mt-2 max-w-2xl text-sm text-white/40">Everything below is dynamic and appears on the public portfolio card and project detail page.</p>

        @if($errors->any())
            <div class="mt-6 rounded-xl border border-red-300/20 bg-red-400/10 p-4 text-sm text-red-100">
                <ul class="list-disc space-y-1 pl-5">@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <form method="POST" enctype="multipart/form-data" action="{{ $portfolio->exists ? route('admin.portfolio.update', $portfolio) : route('admin.portfolio.store') }}" class="neutron-panel mt-8 rounded-2xl p-6 sm:p-8">
            @csrf
            @if($portfolio->exists) @method('PUT') @endif

            <div class="grid gap-6 sm:grid-cols-2">
                <div class="sm:col-span-2">
                    <x-input-label for="title" value="Project title" />
                    <x-text-input id="title" name="title" class="mt-2 block w-full" :value="old('title', $portfolio->title)" required />
                </div>

                <div>
                    <x-input-label for="slug" value="Slug" />
                    <x-text-input id="slug" name="slug" class="mt-2 block w-full" :value="old('slug', $portfolio->slug)" placeholder="auto-generated-from-title" />
                </div>
                <div>
                    <x-input-label for="category" value="Category" />
                    <x-text-input id="category" name="category" class="mt-2 block w-full" :value="old('category', $portfolio->category)" placeholder="Voice AI, Website, CRM..." />
                </div>
                <div>
                    <x-input-label for="eyebrow" value="Small label" />
                    <x-text-input id="eyebrow" name="eyebrow" class="mt-2 block w-full" :value="old('eyebrow', $portfolio->eyebrow)" placeholder="A1 Legacy Labs build" />
                </div>
                <div>
                    <x-input-label for="client_name" value="Client / business (optional)" />
                    <x-text-input id="client_name" name="client_name" class="mt-2 block w-full" :value="old('client_name', $portfolio->client_name)" />
                </div>
                <div>
                    <x-input-label for="project_date" value="Project date" />
                    <x-text-input id="project_date" type="date" name="project_date" class="mt-2 block w-full" :value="old('project_date', optional($portfolio->project_date)->format('Y-m-d'))" />
                </div>
                <div>
                    <x-input-label for="sort_order" value="Sort order" />
                    <x-text-input id="sort_order" type="number" min="0" name="sort_order" class="mt-2 block w-full" :value="old('sort_order', $portfolio->sort_order ?? 0)" required />
                </div>

                <div class="sm:col-span-2">
                    <x-input-label for="excerpt" value="Card summary" />
                    <textarea id="excerpt" name="excerpt" rows="3" class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-white" required>{{ old('excerpt', $portfolio->excerpt) }}</textarea>
                </div>
                <div class="sm:col-span-2">
                    <x-input-label for="description" value="Project overview" />
                    <textarea id="description" name="description" rows="7" class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-white">{{ old('description', $portfolio->description) }}</textarea>
                </div>

                <div class="sm:col-span-2 grid gap-5 lg:grid-cols-3">
                    <div>
                        <x-input-label for="challenge" value="The challenge" />
                        <textarea id="challenge" name="challenge" rows="7" class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-white">{{ old('challenge', $portfolio->challenge) }}</textarea>
                    </div>
                    <div>
                        <x-input-label for="solution" value="What A1 Legacy Labs built" />
                        <textarea id="solution" name="solution" rows="7" class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-white">{{ old('solution', $portfolio->solution) }}</textarea>
                    </div>
                    <div>
                        <x-input-label for="outcome" value="Outcome / result" />
                        <textarea id="outcome" name="outcome" rows="7" class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-white">{{ old('outcome', $portfolio->outcome) }}</textarea>
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <x-input-label for="highlights_text" value="Project highlights — one per line" />
                    <textarea id="highlights_text" name="highlights_text" rows="6" class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-white" placeholder="24/7 inbound call handling&#10;CRM-connected booking&#10;Automated team handoff">{{ old('highlights_text', collect($portfolio->highlights)->filter()->implode("\n")) }}</textarea>
                </div>

                <div class="sm:col-span-2">
                    <x-input-label for="technologies_text" value="Technology / capabilities — one per line" />
                    <textarea id="technologies_text" name="technologies_text" rows="5" class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-white" placeholder="Retell AI&#10;LeadConnector&#10;Laravel&#10;Automation">{{ old('technologies_text', collect($portfolio->technologies)->filter()->implode("\n")) }}</textarea>
                </div>

                <div class="sm:col-span-2">
                    <x-input-label for="project_url" value="External project URL (optional)" />
                    <x-text-input id="project_url" type="url" name="project_url" class="mt-2 block w-full" :value="old('project_url', $portfolio->project_url)" placeholder="https://..." />
                </div>

                <div class="sm:col-span-2">
                    @include('admin.partials.seo-fields', ['seoModel' => $portfolio])
                </div>

                <div class="sm:col-span-2">
                    @include('admin.partials.image-animation-fields', [
                        'title' => 'Project visual',
                        'help' => 'Choose an image or HTML animation for portfolio cards and the project detail page.',
                        'currentMediaType' => $portfolio->media_type ?: 'image',
                        'currentImage' => $portfolio->image_url,
                        'currentImageAlt' => $portfolio->image_alt,
                        'currentAnimation' => $portfolio->animation_html_url,
                    ])
                </div>

                <div class="sm:col-span-2 grid gap-3 sm:grid-cols-2">
                    <label class="rounded-xl border border-white/10 bg-white/[0.02] p-4 text-sm text-white/65">
                        <input type="hidden" name="is_featured" value="0">
                        <input type="checkbox" name="is_featured" value="1" @checked(old('is_featured', $portfolio->is_featured))>
                        <span class="ml-2">Featured project</span>
                    </label>
                    <label class="rounded-xl border border-white/10 bg-white/[0.02] p-4 text-sm text-white/65">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $portfolio->is_active))>
                        <span class="ml-2">Published</span>
                    </label>
                </div>
            </div>

            <div class="mt-8 flex flex-wrap gap-3">
                <x-primary-button>Save portfolio project</x-primary-button>
                @if($portfolio->exists && $portfolio->is_active)
                    <a href="{{ route('portfolio.show', $portfolio) }}" target="_blank" class="inline-flex items-center rounded-xl border border-white/10 px-5 py-3 text-sm text-white/60 transition hover:bg-white/[0.05] hover:text-white">Preview detail page</a>
                @endif
            </div>
        </form>
    </main>
</x-app-layout>
