<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSectionItemRequest;
use App\Http\Requests\UpdateSectionItemRequest;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\SectionItem;
use App\Support\MediaStorage;
use App\Support\RichText;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use RuntimeException;

class SectionItemController extends Controller
{
    public function create(Page $page, PageSection $section): View
    {
        $item = new SectionItem([
            'is_enabled' => true,
            'sort_order' => ($section->items()->max('sort_order') ?? -1) + 1,
        ]);

        return view('admin.items.form', compact('page', 'section', 'item'));
    }

    public function store(StoreSectionItemRequest $request, Page $page, PageSection $section): RedirectResponse
    {
        $validated = $request->validated();
        $data = collect($validated)->except(['image_file', 'animation_html_file', 'remove_image', 'remove_animation', 'media_type', 'image_alt'])->all();
        $settings = ['media_type' => $validated['media_type'] ?? 'image'];
        $imageAlt = trim((string) ($validated['image_alt'] ?? ''));
        if ($imageAlt !== '') {
            $settings['image_alt'] = $imageAlt;
        }
        if ($section->type !== 'pricing') {
            $data['description'] = RichText::sanitize($data['description'] ?? null);
        }

        if ($request->hasFile('image_file')) {
            try {
                $data['image_url'] = MediaStorage::storeImage($request->file('image_file'));
            } catch (RuntimeException $exception) {
                report($exception);

                return back()->withInput()->withErrors([
                    'image_file' => 'The image could not be saved. Check the storage/app/public folder permissions and try again.',
                ]);
            }
        }

        if ($request->hasFile('animation_html_file')) {
            try {
                $settings['animation_html'] = MediaStorage::storeAnimationHtml($request->file('animation_html_file'), 'section-items/animations');
                $settings['media_type'] = 'animation';
            } catch (RuntimeException $exception) {
                report($exception);

                return back()->withInput()->withErrors(['animation_html_file' => 'The HTML animation could not be saved. Check storage permissions and try again.']);
            }
        }

        $data['settings'] = $settings;
        $section->items()->create($data);

        return redirect()->route('admin.sections.edit', [$page, $section])->with('success', 'Content item added.');
    }

    public function edit(Page $page, PageSection $section, SectionItem $item): View
    {
        return view('admin.items.form', compact('page', 'section', 'item'));
    }

    public function update(UpdateSectionItemRequest $request, Page $page, PageSection $section, SectionItem $item): RedirectResponse
    {
        $validated = $request->validated();
        $data = collect($validated)->except(['image_file', 'animation_html_file', 'remove_image', 'remove_animation', 'media_type', 'image_alt'])->all();
        $settings = $item->settings ?: [];
        $settings['media_type'] = $validated['media_type'] ?? ($settings['media_type'] ?? 'image');
        $imageAlt = trim((string) ($validated['image_alt'] ?? ($settings['image_alt'] ?? '')));
        if ($imageAlt !== '') {
            $settings['image_alt'] = $imageAlt;
        } else {
            unset($settings['image_alt']);
        }
        if ($section->type !== 'pricing') {
            $data['description'] = RichText::sanitize($data['description'] ?? null);
        }

        if ($request->boolean('remove_image')) {
            MediaStorage::deleteManaged($item->image_url);
            $data['image_url'] = null;
            unset($settings['image_alt']);
        }

        if ($request->boolean('remove_animation')) {
            MediaStorage::deleteManaged($settings['animation_html'] ?? null);
            unset($settings['animation_html']);
        }

        if ($request->hasFile('image_file')) {
            try {
                $newImageUrl = MediaStorage::storeImage($request->file('image_file'));
            } catch (RuntimeException $exception) {
                report($exception);

                return back()->withInput()->withErrors([
                    'image_file' => 'The image could not be saved. Check the storage/app/public folder permissions and try again.',
                ]);
            }

            MediaStorage::deleteManaged($item->image_url);
            $data['image_url'] = $newImageUrl;
        }

        if ($request->hasFile('animation_html_file')) {
            try {
                $newAnimation = MediaStorage::storeAnimationHtml($request->file('animation_html_file'), 'section-items/animations');
            } catch (RuntimeException $exception) {
                report($exception);

                return back()->withInput()->withErrors(['animation_html_file' => 'The HTML animation could not be saved. Check storage permissions and try again.']);
            }
            MediaStorage::deleteManaged($settings['animation_html'] ?? null);
            $settings['animation_html'] = $newAnimation;
            $settings['media_type'] = 'animation';
        }

        $data['settings'] = $settings;
        $item->update($data);

        return redirect()->route('admin.sections.edit', [$page, $section])->with('success', 'Content item updated.');
    }

    public function destroy(Page $page, PageSection $section, SectionItem $item): RedirectResponse
    {
        MediaStorage::deleteManaged($item->image_url);
        MediaStorage::deleteManaged(data_get($item->settings, 'animation_html'));
        $item->delete();

        return redirect()->route('admin.sections.edit', [$page, $section])->with('success', 'Content item deleted.');
    }
}
