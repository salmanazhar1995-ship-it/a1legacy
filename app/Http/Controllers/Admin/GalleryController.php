<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGalleryRequest;
use App\Http\Requests\UpdateGalleryRequest;
use App\Models\Gallery;
use App\Support\MediaStorage;
use App\Support\RichText;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use RuntimeException;

class GalleryController extends Controller
{
    public function index(): View
    {
        return view('admin.gallery.index');
    }

    public function create(): View
    {
        $gallery = new Gallery(['is_featured' => true, 'is_active' => true, 'sort_order' => (Gallery::query()->max('sort_order') ?? 0) + 1, 'project_date' => now()->toDateString(), 'media_type' => 'image']);

        return view('admin.gallery.form', compact('gallery'));
    }

    public function store(StoreGalleryRequest $request): RedirectResponse
    {
        $d = $this->data($request->validated());
        $d['slug'] = $this->slug(($d['slug'] ?? '') ?: $d['title']);
        if ($request->hasFile('image_file')) {
            try {
                $d['image_url'] = MediaStorage::storeImage($request->file('image_file'), 'gallery');
            } catch (RuntimeException $e) {
                report($e);

                return back()->withInput()->withErrors(['image_file' => 'The gallery image could not be saved.']);
            }
        } if ($request->hasFile('animation_html_file')) {
            try {
                $d['animation_html_url'] = MediaStorage::storeAnimationHtml($request->file('animation_html_file'), 'gallery/animations');
                $d['media_type'] = 'animation';
            } catch (RuntimeException $e) {
                report($e);

                return back()->withInput()->withErrors(['animation_html_file' => 'The gallery HTML animation could not be saved.']);
            }
        } Gallery::query()->create($d);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item created.');
    }

    public function edit(Gallery $gallery): View
    {
        return view('admin.gallery.form', compact('gallery'));
    }

    public function update(UpdateGalleryRequest $request, Gallery $gallery): RedirectResponse
    {
        $d = $this->data($request->validated());
        if (($d['slug'] ?? '') === '') {
            unset($d['slug']);
        } else {
            $d['slug'] = $this->slug($d['slug'], $gallery->getKey());
        } if ($request->boolean('remove_image')) {
            MediaStorage::deleteManaged($gallery->image_url);
            $d['image_url'] = null;
            $d['image_alt'] = null;
        } if ($request->boolean('remove_animation')) {
            MediaStorage::deleteManaged($gallery->animation_html_url);
            $d['animation_html_url'] = null;
        } if ($request->hasFile('image_file')) {
            try {
                $new = MediaStorage::storeImage($request->file('image_file'), 'gallery');
            } catch (RuntimeException $e) {
                report($e);

                return back()->withInput()->withErrors(['image_file' => 'The gallery image could not be saved.']);
            } MediaStorage::deleteManaged($gallery->image_url);
            $d['image_url'] = $new;
        } if ($request->hasFile('animation_html_file')) {
            try {
                $newAnimation = MediaStorage::storeAnimationHtml($request->file('animation_html_file'), 'gallery/animations');
            } catch (RuntimeException $e) {
                report($e);

                return back()->withInput()->withErrors(['animation_html_file' => 'The gallery HTML animation could not be saved.']);
            } MediaStorage::deleteManaged($gallery->animation_html_url);
            $d['animation_html_url'] = $newAnimation;
            $d['media_type'] = 'animation';
        } $gallery->update($d);

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item updated.');
    }

    public function destroy(Gallery $gallery): RedirectResponse
    {
        MediaStorage::deleteManaged($gallery->image_url);
        MediaStorage::deleteManaged($gallery->animation_html_url);
        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'Gallery item deleted.');
    }

    private function data(array $v): array
    {
        if (isset($v['tags_text']) && is_string($v['tags_text'])) {
            $v['tags'] = preg_split('/\r\n|\r|\n/', $v['tags_text']) ?: [];
        } $v['tags'] = collect($v['tags'] ?? [])->map(fn ($x) => is_string($x) ? trim($x) : '')->filter()->unique()->values()->all();
        $v['description'] = RichText::sanitize($v['description'] ?? null);
        $v['meta_description'] = RichText::sanitize($v['meta_description'] ?? null);
        unset($v['image_file'],$v['animation_html_file'],$v['remove_image'],$v['remove_animation'],$v['tags_text']);

        return $v;
    }

    private function slug(string $value, int|string|null $ignore = null): string
    {
        $base = Str::slug($value) ?: 'gallery-item';
        $slug = $base;
        $n = 2;
        while (Gallery::query()->where('slug', $slug)->when($ignore !== null, fn ($q) => $q->where('id', '!=', $ignore))->exists()) {
            $slug = $base.'-'.$n++;
        }

return $slug;
    }
}
