<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePageSectionRequest;
use App\Http\Requests\UpdatePageSectionRequest;
use App\Models\Page;
use App\Models\PageSection;
use App\Rules\SafeAnimationHtmlUpload;
use App\Support\MediaStorage;
use App\Support\RichText;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use RuntimeException;

class PageSectionController extends Controller
{
    public function create(Page $page): View
    {
        $section = new PageSection([
            'page_id' => $page->getKey(),
            'type' => 'standard_content',
            'is_enabled' => true,
            'sort_order' => ($page->sections()->max('sort_order') ?? -1) + 1,
            'settings' => [
                'layout' => 'default',
                'alignment' => 'left',
                'columns' => 3,
                'theme' => 'default',
            ],
        ]);

        return view('admin.sections.form', compact('page', 'section'));
    }

    public function store(StorePageSectionRequest $request, Page $page): RedirectResponse
    {
        try {
            $data = $this->payload($request->validated(), $request, null);
        } catch (RuntimeException $e) {
            report($e);
            $field = $request->hasFile('section_html_file') ? 'section_html_file' : ($request->hasFile('background_animation_html_file') ? 'background_animation_html_file' : ($request->hasFile('animation_html_file') ? 'animation_html_file' : ($request->hasFile('background_image_file') ? 'background_image_file' : 'image_file')));
            $message = in_array($field, ['animation_html_file', 'background_animation_html_file', 'section_html_file'], true)
                ? 'The section HTML file could not be saved. Please check the file and storage permissions.'
                : 'The section image could not be saved. Please try another image or check storage permissions.';

            return back()->withInput()->withErrors([$field => $message]);
        }
        $data['page_id'] = $page->getKey();
        $data['key'] = $this->normalizeKey($data['key'] ?? '', $data['heading'] ?? 'section');

        $section = $page->sections()->create($data);

        return redirect()->route('admin.sections.edit', [$page, $section])->with('success', 'Section created successfully.');
    }

    public function storeHtml(Request $request, Page $page): RedirectResponse
    {
        abort_unless((bool) $request->user()?->is_admin, 403);

        $validated = $request->validate([
            'section_html_file' => ['required', new SafeAnimationHtmlUpload(10240)],
            'html_min_height' => ['nullable', 'integer', 'min:100', 'max:5000'],
        ]);

        try {
            $htmlUrl = MediaStorage::storeSectionHtml($request->file('section_html_file'), 'sections/html');
        } catch (RuntimeException $e) {
            report($e);

            return back()->withErrors([
                'section_html_file' => 'The HTML section file could not be saved. Please check the file and storage permissions.',
            ]);
        }

        $originalName = pathinfo((string) $request->file('section_html_file')->getClientOriginalName(), PATHINFO_FILENAME);
        $baseKey = Str::slug($originalName) ?: 'html-section';
        $key = $this->uniqueSectionKey($page, $baseKey);
        $heading = (string) Str::of($originalName)->replace(['-', '_'], ' ')->squish()->limit(255);

        $section = $page->sections()->create([
            'key' => $key,
            'type' => 'html_section',
            'heading' => $heading !== '' ? $heading : 'HTML section',
            'is_enabled' => true,
            'sort_order' => ($page->sections()->max('sort_order') ?? -1) + 1,
            'settings' => [
                'layout' => 'wide',
                'alignment' => 'center',
                'columns' => 1,
                'theme' => 'default',
                'section_html' => $htmlUrl,
                'html_min_height' => (int) ($validated['html_min_height'] ?? 320),
            ],
        ]);

        return redirect()->route('admin.sections.edit', [$page, $section])
            ->with('success', 'HTML file uploaded and section created successfully.');
    }

    public function edit(Page $page, PageSection $section): View
    {
        abort_unless($section->page_id === $page->getKey(), 404);
        $section->load('items');

        return view('admin.sections.form', compact('page', 'section'));
    }

    public function update(UpdatePageSectionRequest $request, Page $page, PageSection $section): RedirectResponse
    {
        abort_unless($section->page_id === $page->getKey(), 404);

        try {
            $data = $this->payload($request->validated(), $request, $section);
        } catch (RuntimeException $e) {
            report($e);
            $field = $request->hasFile('section_html_file') ? 'section_html_file' : ($request->hasFile('background_animation_html_file') ? 'background_animation_html_file' : ($request->hasFile('animation_html_file') ? 'animation_html_file' : ($request->hasFile('background_image_file') ? 'background_image_file' : 'image_file')));
            $message = in_array($field, ['animation_html_file', 'background_animation_html_file', 'section_html_file'], true)
                ? 'The section HTML file could not be saved. Please check the file and storage permissions.'
                : 'The section image could not be saved. Please try another image or check storage permissions.';

            return back()->withInput()->withErrors([$field => $message]);
        }
        $data['key'] = $this->normalizeKey($data['key'] ?? '', $data['heading'] ?? 'section');
        $section->update($data);

        return redirect()->route('admin.sections.edit', [$page, $section])->with('success', 'Section updated successfully.');
    }

    public function destroy(Page $page, PageSection $section): RedirectResponse
    {
        abort_unless($section->page_id === $page->getKey(), 404);

        if ((bool) data_get($section->settings, 'protected', false)) {
            return back()->withErrors(['section' => 'This system section is protected and cannot be deleted.']);
        }

        foreach ($section->items as $item) {
            MediaStorage::deleteManaged($item->image_url);
        }

        MediaStorage::deleteManaged(data_get($section->settings, 'image'));
        MediaStorage::deleteManaged(data_get($section->settings, 'animation_html'));
        MediaStorage::deleteManaged(data_get($section->settings, 'background_image'));
        MediaStorage::deleteManaged(data_get($section->settings, 'background_animation_html'));
        MediaStorage::deleteManaged(data_get($section->settings, 'section_html'));
        $section->delete();
        $this->normalizeOrder($page);

        return redirect()->route('admin.pages.edit', $page)->with('success', 'Section deleted.');
    }

    public function moveUp(Page $page, PageSection $section): RedirectResponse
    {
        return $this->move($page, $section, -1);
    }

    public function moveDown(Page $page, PageSection $section): RedirectResponse
    {
        return $this->move($page, $section, 1);
    }

    public function toggle(Page $page, PageSection $section): RedirectResponse
    {
        abort_unless($section->page_id === $page->getKey(), 404);
        $section->update(['is_enabled' => ! $section->is_enabled]);

        return back()->with('success', $section->is_enabled ? 'Section enabled.' : 'Section disabled.');
    }

    private function move(Page $page, PageSection $section, int $delta): RedirectResponse
    {
        abort_unless($section->page_id === $page->getKey(), 404);

        DB::transaction(function () use ($page, $section, $delta): void {
            $sections = $page->sections()->orderBy('sort_order')->orderBy('id')->get();
            $ids = $sections->pluck('id')->values()->all();
            $index = array_search($section->getKey(), $ids, true);

            if ($index === false) {
                return;
            }

            $target = $index + $delta;
            if ($target < 0 || $target >= count($ids)) {
                return;
            }

            [$ids[$index], $ids[$target]] = [$ids[$target], $ids[$index]];
            foreach ($ids as $order => $id) {
                PageSection::query()->whereKey($id)->update(['sort_order' => $order]);
            }
        });

        return back()->with('success', 'Section order updated.');
    }

    private function normalizeOrder(Page $page): void
    {
        foreach ($page->sections()->orderBy('sort_order')->orderBy('id')->get() as $order => $section) {
            if ($section->sort_order !== $order) {
                $section->update(['sort_order' => $order]);
            }
        }
    }

    private function normalizeKey(string $key, string $fallback): string
    {
        return Str::slug($key !== '' ? $key : $fallback) ?: 'section';
    }

    private function uniqueSectionKey(Page $page, string $base): string
    {
        $base = Str::slug($base) ?: 'html-section';
        $key = $base;
        $suffix = 2;

        while ($page->sections()->where('key', $key)->exists()) {
            $key = $base.'-'.$suffix;
            $suffix++;
        }

        return $key;
    }

    /** @param array<string,mixed> $validated */
    private function payload(array $validated, $request, ?PageSection $section): array
    {
        $settings = $section?->settings ?: [];
        $settings['layout'] = $validated['layout'] ?? ($settings['layout'] ?? 'default');
        $settings['alignment'] = $validated['alignment'] ?? ($settings['alignment'] ?? 'left');
        $settings['columns'] = (int) ($validated['columns'] ?? ($settings['columns'] ?? 3));
        $settings['theme'] = $validated['theme'] ?? ($settings['theme'] ?? 'default');
        $settings['media_type'] = $validated['media_type'] ?? ($settings['media_type'] ?? 'image');
        $settings['image_alt'] = trim((string) ($validated['image_alt'] ?? ($settings['image_alt'] ?? '')));
        if ($settings['image_alt'] === '') {
            unset($settings['image_alt']);
        }

        $settings['background_media_type'] = $validated['background_media_type'] ?? ($settings['background_media_type'] ?? 'image');
        $settings['html_min_height'] = (int) ($validated['html_min_height'] ?? ($settings['html_min_height'] ?? 320));
        $settings['background_image_alt'] = trim((string) ($validated['background_image_alt'] ?? ($settings['background_image_alt'] ?? '')));
        if ($settings['background_image_alt'] === '') {
            unset($settings['background_image_alt']);
        }

        if ($request->boolean('remove_image')) {
            MediaStorage::deleteManaged($settings['image'] ?? null);
            unset($settings['image'], $settings['image_alt']);
        }

        if ($request->boolean('remove_animation')) {
            MediaStorage::deleteManaged($settings['animation_html'] ?? null);
            unset($settings['animation_html']);
        }

        if ($request->boolean('remove_background_image')) {
            MediaStorage::deleteManaged($settings['background_image'] ?? null);
            unset($settings['background_image'], $settings['background_image_alt']);
        }

        if ($request->boolean('remove_background_animation')) {
            MediaStorage::deleteManaged($settings['background_animation_html'] ?? null);
            unset($settings['background_animation_html']);
        }

        if ($request->boolean('remove_section_html')) {
            MediaStorage::deleteManaged($settings['section_html'] ?? null);
            unset($settings['section_html']);
        }

        if ($request->hasFile('image_file')) {
            try {
                $new = MediaStorage::storeImage($request->file('image_file'), 'sections');
            } catch (RuntimeException $e) {
                report($e);
                throw $e;
            }
            MediaStorage::deleteManaged($settings['image'] ?? null);
            $settings['image'] = $new;
        }

        if ($request->hasFile('animation_html_file')) {
            try {
                $new = MediaStorage::storeAnimationHtml($request->file('animation_html_file'), 'sections/animations');
            } catch (RuntimeException $e) {
                report($e);
                throw $e;
            }
            MediaStorage::deleteManaged($settings['animation_html'] ?? null);
            $settings['animation_html'] = $new;
            $settings['media_type'] = 'animation';
        }

        if ($request->hasFile('background_image_file')) {
            try {
                $new = MediaStorage::storeImage($request->file('background_image_file'), 'sections/backgrounds');
            } catch (RuntimeException $e) {
                report($e);
                throw $e;
            }
            MediaStorage::deleteManaged($settings['background_image'] ?? null);
            $settings['background_image'] = $new;
        }

        if ($request->hasFile('background_animation_html_file')) {
            try {
                $new = MediaStorage::storeAnimationHtml($request->file('background_animation_html_file'), 'sections/background-animations');
            } catch (RuntimeException $e) {
                report($e);
                throw $e;
            }
            MediaStorage::deleteManaged($settings['background_animation_html'] ?? null);
            $settings['background_animation_html'] = $new;
            $settings['background_media_type'] = 'animation';
        }

        if ($request->hasFile('section_html_file')) {
            try {
                $new = MediaStorage::storeSectionHtml($request->file('section_html_file'), 'sections/html');
            } catch (RuntimeException $e) {
                report($e);
                throw $e;
            }
            MediaStorage::deleteManaged($settings['section_html'] ?? null);
            $settings['section_html'] = $new;
        }

        $data = collect($validated)->except([
            'layout', 'alignment', 'columns', 'theme', 'media_type', 'image_alt', 'image_file', 'animation_html_file',
            'background_media_type', 'background_image_alt', 'background_image_file', 'background_animation_html_file',
            'section_html_file', 'html_min_height',
            'remove_image', 'remove_animation', 'remove_background_image', 'remove_background_animation', 'remove_section_html',
        ])->all();

        $data['body'] = RichText::sanitize($data['body'] ?? null);
        $data['settings'] = $settings;

        return $data;
    }
}
