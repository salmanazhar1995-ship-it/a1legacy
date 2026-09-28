<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePortfolioRequest;
use App\Http\Requests\UpdatePortfolioRequest;
use App\Models\Portfolio;
use App\Support\MediaStorage;
use App\Support\RichText;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use RuntimeException;

class PortfolioController extends Controller
{
    public function index(): View
    {
        return view('admin.portfolio.index');
    }

    public function create(): View
    {
        $portfolio = new Portfolio([
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => (Portfolio::query()->max('sort_order') ?? 0) + 1,
            'project_date' => now()->toDateString(),
            'media_type' => 'image',
        ]);

        return view('admin.portfolio.form', compact('portfolio'));
    }

    public function store(StorePortfolioRequest $request): RedirectResponse
    {
        $data = $this->data($request->validated());
        $data['slug'] = $this->uniqueSlug(($data['slug'] ?? '') ?: $data['title']);

        if ($request->hasFile('image_file')) {
            try {
                $data['image_url'] = MediaStorage::storeImage($request->file('image_file'), 'portfolio');
            } catch (RuntimeException $exception) {
                report($exception);

                return back()->withInput()->withErrors([
                    'image_file' => 'The portfolio image could not be saved. Check storage permissions and try again.',
                ]);
            }
        }

        if ($request->hasFile('animation_html_file')) {
            try {
                $data['animation_html_url'] = MediaStorage::storeAnimationHtml($request->file('animation_html_file'), 'portfolio/animations');
                $data['media_type'] = 'animation';
            } catch (RuntimeException $exception) {
                report($exception);

                return back()->withInput()->withErrors(['animation_html_file' => 'The portfolio HTML animation could not be saved.']);
            }
        }

        Portfolio::query()->create($data);

        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio project created.');
    }

    public function edit(Portfolio $portfolio): View
    {
        return view('admin.portfolio.form', compact('portfolio'));
    }

    public function update(UpdatePortfolioRequest $request, Portfolio $portfolio): RedirectResponse
    {
        $data = $this->data($request->validated());

        if (($data['slug'] ?? '') === '') {
            unset($data['slug']);
        } else {
            $data['slug'] = $this->uniqueSlug($data['slug'], $portfolio->getKey());
        }

        if ($request->boolean('remove_image')) {
            MediaStorage::deleteManaged($portfolio->image_url);
            $data['image_url'] = null;
            $data['image_alt'] = null;
        }

        if ($request->boolean('remove_animation')) {
            MediaStorage::deleteManaged($portfolio->animation_html_url);
            $data['animation_html_url'] = null;
        }

        if ($request->hasFile('image_file')) {
            try {
                $newImage = MediaStorage::storeImage($request->file('image_file'), 'portfolio');
            } catch (RuntimeException $exception) {
                report($exception);

                return back()->withInput()->withErrors([
                    'image_file' => 'The portfolio image could not be saved. Check storage permissions and try again.',
                ]);
            }

            MediaStorage::deleteManaged($portfolio->image_url);
            $data['image_url'] = $newImage;
        }

        if ($request->hasFile('animation_html_file')) {
            try {
                $newAnimation = MediaStorage::storeAnimationHtml($request->file('animation_html_file'), 'portfolio/animations');
            } catch (RuntimeException $exception) {
                report($exception);

                return back()->withInput()->withErrors(['animation_html_file' => 'The portfolio HTML animation could not be saved.']);
            }
            MediaStorage::deleteManaged($portfolio->animation_html_url);
            $data['animation_html_url'] = $newAnimation;
            $data['media_type'] = 'animation';
        }

        $portfolio->update($data);

        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio project updated.');
    }

    public function destroy(Portfolio $portfolio): RedirectResponse
    {
        MediaStorage::deleteManaged($portfolio->image_url);
        MediaStorage::deleteManaged($portfolio->animation_html_url);
        $portfolio->delete();

        return redirect()->route('admin.portfolio.index')->with('success', 'Portfolio project deleted.');
    }

    private function data(array $validated): array
    {
        $validated['highlights'] = $this->lines($validated['highlights_text'] ?? '');
        $validated['technologies'] = $this->lines($validated['technologies_text'] ?? '');
        foreach (['description', 'challenge', 'solution', 'outcome', 'meta_description'] as $field) {
            $validated[$field] = RichText::sanitize($validated[$field] ?? null);
        }

        unset($validated['highlights_text'], $validated['technologies_text'], $validated['image_file'], $validated['animation_html_file'], $validated['remove_image'], $validated['remove_animation']);

        return $validated;
    }

    /** @return array<int, string> */
    private function lines(?string $value): array
    {
        return collect(preg_split('/\r\n|\r|\n/', (string) $value) ?: [])
            ->map(fn ($line) => trim((string) $line))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    private function uniqueSlug(string $value, int|string|null $ignore = null): string
    {
        $base = Str::slug($value) ?: 'portfolio-project';
        $slug = $base;
        $suffix = 2;

        while (
            Portfolio::query()
                ->where('slug', $slug)
                ->when($ignore !== null, fn ($query) => $query->where('id', '!=', $ignore))
                ->exists()
        ) {
            $slug = $base.'-'.$suffix++;
        }

        return $slug;
    }
}
