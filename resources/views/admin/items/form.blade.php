<x-app-layout>
    <main class="mx-auto max-w-3xl px-4 py-10 sm:px-6 lg:px-8">
        <a href="{{ route('admin.sections.edit',[$page,$section]) }}" class="text-sm text-white/35 hover:text-white">← {{ $section->heading ?: 'Section' }}</a>
        <h1 class="mt-3 text-3xl font-medium tracking-tight">{{ $item->exists ? 'Edit content item' : 'Add content item' }}</h1>

        <form method="POST" enctype="multipart/form-data" action="{{ $item->exists ? route('admin.items.update',[$page,$section,$item]) : route('admin.items.store',[$page,$section]) }}" class="neutron-panel mt-8 rounded-2xl p-6 sm:p-8">
            @csrf
            @if($item->exists) @method('PUT') @endif

            <div class="grid gap-5 sm:grid-cols-2">
                @foreach(['title'=>'Title','subtitle'=>'Subtitle / role','badge'=>'Badge','value'=>'Value / price','link_label'=>'Link label','link_url'=>'Link URL'] as $field=>$label)
                    <div @class(['sm:col-span-2'=>$field==='link_url'])>
                        <x-input-label :for="$field" :value="$label"/>
                        <x-text-input :id="$field" :name="$field" class="mt-2 block w-full" :value="old($field,$item->{$field})"/>
                        <x-input-error class="mt-2" :messages="$errors->get($field)"/>
                    </div>
                @endforeach

                <div class="sm:col-span-2">
                    @include('admin.partials.image-animation-fields', [
                        'title' => 'Item visual',
                        'help' => 'Use an image or HTML animation for this card/item. The animation is rendered in a sandboxed iframe.',
                        'currentMediaType' => data_get($item->settings, 'media_type', 'image'),
                        'currentImage' => $item->image_url,
                        'currentImageAlt' => data_get($item->settings, 'image_alt'),
                        'currentAnimation' => data_get($item->settings, 'animation_html'),
                    ])
                    <div class="mt-4">
                        <x-input-label for="image_url" value="Existing image URL / path (optional)"/>
                        <x-text-input id="image_url" name="image_url" class="mt-2 block w-full" :value="old('image_url',$item->image_url)"/>
                        <x-input-error class="mt-2" :messages="$errors->get('image_url')"/>
                    </div>
                </div>

                <div class="sm:col-span-2">
                    <x-input-label for="description" value="Description / feature list"/>
                    <textarea id="description" name="description" rows="7" @if($section->type === 'pricing') data-no-rich-editor="1" @else data-rich-editor @endif class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-white focus:border-neutron-500 focus:ring-neutron-500">{{ old('description',$item->description) }}</textarea>
                    <p class="mt-2 text-xs text-white/30">For pricing cards, put one feature on each line.</p>
                </div>

                <div>
                    <x-input-label for="sort_order" value="Display order"/>
                    <x-text-input id="sort_order" type="number" name="sort_order" class="mt-2 block w-full" :value="old('sort_order',$item->sort_order)"/>
                </div>

                <label class="flex items-center gap-3 self-end pb-3 text-sm text-white/65">
                    <input type="hidden" name="is_enabled" value="0">
                    <input type="checkbox" name="is_enabled" value="1" @checked(old('is_enabled',$item->is_enabled)) class="rounded border-white/15 bg-white/5 text-neutron-500">
                    Visible
                </label>

                <div class="sm:col-span-2">
                    <x-primary-button>{{ $item->exists ? 'Save item' : 'Add item' }}</x-primary-button>
                </div>
            </div>
        </form>
    </main>
</x-app-layout>
