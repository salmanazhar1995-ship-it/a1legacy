<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use App\Support\MediaStorage;
use App\Support\RichText;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use RuntimeException;

class ProductController extends Controller
{
    public function index(): View
    {
        return view('admin.products.index');
    }

    public function create(): View
    {
        $product = new Product([
            'is_featured' => true,
            'is_active' => true,
            'sort_order' => (Product::query()->max('sort_order') ?? 0) + 1,
            'visual_type' => 'product',
            'media_type' => 'image',
        ]);

        return view('admin.products.form', compact('product'));
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        $data = $this->productData($request->validated());
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['title']);

        if ($request->hasFile('image_file')) {
            try {
                $data['image_url'] = MediaStorage::storeImage($request->file('image_file'), 'products');
            } catch (RuntimeException $exception) {
                report($exception);

                return back()->withInput()->withErrors([
                    'image_file' => 'The product image could not be saved. Check storage/app/public permissions and try again.',
                ]);
            }
        }

        if ($request->hasFile('animation_html_file')) {
            try {
                $data['animation_html_url'] = MediaStorage::storeAnimationHtml($request->file('animation_html_file'), 'products/animations');
                $data['media_type'] = 'animation';
            } catch (RuntimeException $exception) {
                report($exception);

                return back()->withInput()->withErrors(['animation_html_file' => 'The product HTML animation could not be saved.']);
            }
        }

        Product::query()->create($data);

        return redirect()->route('admin.products.index')->with('success', 'Core product created.');
    }

    public function edit(Product $product): View
    {
        return view('admin.products.form', compact('product'));
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $data = $this->productData($request->validated());

        if (($data['slug'] ?? '') === '') {
            unset($data['slug']);
        } else {
            $data['slug'] = $this->uniqueSlug($data['slug'], $product->getKey());
        }

        if ($request->boolean('remove_image')) {
            MediaStorage::deleteManaged($product->image_url);
            $data['image_url'] = null;
            $data['image_alt'] = null;
        }

        if ($request->boolean('remove_animation')) {
            MediaStorage::deleteManaged($product->animation_html_url);
            $data['animation_html_url'] = null;
        }

        if ($request->hasFile('image_file')) {
            try {
                $newImageUrl = MediaStorage::storeImage($request->file('image_file'), 'products');
            } catch (RuntimeException $exception) {
                report($exception);

                return back()->withInput()->withErrors([
                    'image_file' => 'The product image could not be saved. Check storage/app/public permissions and try again.',
                ]);
            }

            MediaStorage::deleteManaged($product->image_url);
            $data['image_url'] = $newImageUrl;
        }

        if ($request->hasFile('animation_html_file')) {
            try {
                $newAnimation = MediaStorage::storeAnimationHtml($request->file('animation_html_file'), 'products/animations');
            } catch (RuntimeException $exception) {
                report($exception);

                return back()->withInput()->withErrors(['animation_html_file' => 'The product HTML animation could not be saved.']);
            }
            MediaStorage::deleteManaged($product->animation_html_url);
            $data['animation_html_url'] = $newAnimation;
            $data['media_type'] = 'animation';
        }

        $product->update($data);

        return redirect()->route('admin.products.index')->with('success', 'Core product updated.');
    }

    public function destroy(Product $product): RedirectResponse
    {
        MediaStorage::deleteManaged($product->image_url);
        MediaStorage::deleteManaged($product->animation_html_url);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Core product deleted.');
    }

    /** @param array<string, mixed> $validated */
    private function productData(array $validated): array
    {
        $validated['highlights'] = $this->items(
            $validated['highlights'] ?? null,
            $validated['highlights_text'] ?? null,
        );
        $validated['benefits'] = $this->lines($validated['benefits_text'] ?? null);
        $validated['description'] = RichText::sanitize($validated['description'] ?? null);
        $validated['meta_description'] = RichText::sanitize($validated['meta_description'] ?? null);

        unset(
            $validated['highlights_text'],
            $validated['benefits_text'],
            $validated['image_file'],
            $validated['animation_html_file'],
            $validated['remove_image'],
            $validated['remove_animation'],
        );

        return $validated;
    }

    /** @return array<int, string> */
    private function items(mixed $items, mixed $legacyText = null): array
    {
        if (is_array($items)) {
            return collect($items)
                ->map(fn ($item) => is_string($item) ? trim($item) : '')
                ->filter()
                ->unique()
                ->values()
                ->all();
        }

        return $this->lines($legacyText);
    }

    /** @return array<int, string> */
    private function lines(mixed $value): array
    {
        if (! is_string($value)) {
            return [];
        }

        return collect(preg_split('/\r\n|\r|\n/', $value) ?: [])
            ->map(fn (string $line) => trim($line))
            ->filter()
            ->unique()
            ->values()
            ->all();
    }

    private function uniqueSlug(string $value, int|string|null $ignoreId = null): string
    {
        $base = Str::slug($value) ?: 'product';
        $slug = $base;
        $suffix = 2;

        while (
            Product::query()
                ->where('slug', $slug)
                ->when($ignoreId !== null, fn ($query) => $query->where('id', '!=', $ignoreId))
                ->exists()
        ) {
            $slug = $base.'-'.$suffix++;
        }

        return $slug;
    }
}
