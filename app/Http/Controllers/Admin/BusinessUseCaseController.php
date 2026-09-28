<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBusinessUseCaseRequest;
use App\Http\Requests\UpdateBusinessUseCaseRequest;
use App\Models\BusinessUseCase;
use App\Models\Industry;
use App\Support\MediaStorage;
use App\Support\RichText;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use RuntimeException;

class BusinessUseCaseController extends Controller
{
    public function index(): View
    {
        return view('admin.business-use-cases.index');
    }

    public function create(): View
    {
        $businessUseCase = new BusinessUseCase([
            'is_active' => true,
            'sort_order' => ((int) BusinessUseCase::query()->max('sort_order')) + 10,
            'highlights' => [],
            'media_type' => 'image',
        ]);

        $industries = $this->industries();

        return view('admin.business-use-cases.form', compact('businessUseCase', 'industries'));
    }

    public function store(StoreBusinessUseCaseRequest $request): RedirectResponse
    {
        $data = $this->cleanData($request->validated());
        unset($data['image_file'], $data['animation_html_file'], $data['remove_animation']);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? null, $data['title']);

        if ($request->hasFile('image_file')) {
            try {
                $data['image_url'] = MediaStorage::storeImage($request->file('image_file'), 'industries');
            } catch (RuntimeException $e) {
                report($e);

                return back()->withInput()->withErrors(['image_file' => 'The industry image could not be saved. Please try another JPG, PNG, WebP or AVIF image.']);
            }
        }

        if ($request->hasFile('animation_html_file')) {
            try {
                $data['animation_html_url'] = MediaStorage::storeAnimationHtml($request->file('animation_html_file'), 'industries/animations');
                $data['media_type'] = 'animation';
            } catch (RuntimeException $e) {
                report($e);

                return back()->withInput()->withErrors(['animation_html_file' => 'The industry HTML animation could not be saved.']);
            }
        }

        BusinessUseCase::query()->create($data);

        return redirect()->route('admin.business-use-cases.index')->with('success', 'Industry created successfully.');
    }

    public function edit(BusinessUseCase $businessUseCase): View
    {
        $industries = $this->industries();

        return view('admin.business-use-cases.form', compact('businessUseCase', 'industries'));
    }

    public function update(UpdateBusinessUseCaseRequest $request, BusinessUseCase $businessUseCase): RedirectResponse
    {
        $data = $this->cleanData($request->validated());
        unset($data['image_file'], $data['animation_html_file'], $data['remove_image'], $data['remove_animation']);
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? null, $data['title'], $businessUseCase->getKey());

        if ($request->boolean('remove_image')) {
            MediaStorage::deleteManaged($businessUseCase->image_url);
            $data['image_url'] = null;
            $data['image_alt'] = null;
        }

        if ($request->boolean('remove_animation')) {
            MediaStorage::deleteManaged($businessUseCase->animation_html_url);
            $data['animation_html_url'] = null;
        }

        if ($request->hasFile('image_file')) {
            try {
                $newImage = MediaStorage::storeImage($request->file('image_file'), 'industries');
            } catch (RuntimeException $e) {
                report($e);

                return back()->withInput()->withErrors(['image_file' => 'The industry image could not be saved. Please try another JPG, PNG, WebP or AVIF image.']);
            }

            MediaStorage::deleteManaged($businessUseCase->image_url);
            $data['image_url'] = $newImage;
        }

        if ($request->hasFile('animation_html_file')) {
            try {
                $newAnimation = MediaStorage::storeAnimationHtml($request->file('animation_html_file'), 'industries/animations');
            } catch (RuntimeException $e) {
                report($e);

                return back()->withInput()->withErrors(['animation_html_file' => 'The industry HTML animation could not be saved.']);
            }
            MediaStorage::deleteManaged($businessUseCase->animation_html_url);
            $data['animation_html_url'] = $newAnimation;
            $data['media_type'] = 'animation';
        }

        $businessUseCase->update($data);

        return redirect()->route('admin.business-use-cases.index')->with('success', 'Industry updated successfully.');
    }

    public function destroy(BusinessUseCase $businessUseCase): RedirectResponse
    {
        MediaStorage::deleteManaged($businessUseCase->image_url);
        MediaStorage::deleteManaged($businessUseCase->animation_html_url);
        $businessUseCase->delete();

        return redirect()->route('admin.business-use-cases.index')->with('success', 'Industry deleted.');
    }

    private function cleanData(array $data): array
    {
        $data['meta_description'] = RichText::sanitize($data['meta_description'] ?? null);

        $data['highlights'] = collect($data['highlights'] ?? [])
            ->map(fn ($value) => trim((string) $value))
            ->filter()
            ->values()
            ->all();

        foreach (['category', 'slug', 'description', 'system_note', 'link_label', 'link_url'] as $field) {
            if (array_key_exists($field, $data) && is_string($data[$field])) {
                $data[$field] = trim($data[$field]);
                if ($data[$field] === '') {
                    $data[$field] = null;
                }
            }
        }

        return $data;
    }

    private function industries(): Collection
    {
        return Industry::query()->orderBy('sort_order')->orderBy('id')->get();
    }

    private function uniqueSlug(?string $requested, string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($requested ?: $title) ?: 'industry';
        $slug = $base;
        $suffix = 2;

        while (BusinessUseCase::query()->where('slug', $slug)->when($ignoreId, fn ($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base.'-'.$suffix;
            $suffix++;
        }

        return $slug;
    }
}
