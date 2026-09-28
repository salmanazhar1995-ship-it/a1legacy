<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogPostRequest;
use App\Http\Requests\UpdateBlogPostRequest;
use App\Models\BlogPost;
use App\Support\MediaStorage;
use App\Support\RichText;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;
use RuntimeException;

class BlogPostController extends Controller
{
    public function index(): View
    {
        return view('admin.blog.index');
    }

    public function create(): View
    {
        $blogPost = new BlogPost([
            'is_published' => false,
            'published_at' => now(),
            'author_name' => auth()->user()?->name,
            'featured_media_type' => 'image',
        ]);

        return view('admin.blog.form', compact('blogPost'));
    }

    public function store(StoreBlogPostRequest $request): RedirectResponse
    {
        $data = $this->prepareData($request->validated());
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? null, $data['title']);
        $data['featured_image'] = $data['featured_image_url'] ?? null;
        unset($data['featured_image_url'], $data['featured_image_file'], $data['featured_animation_html_file'], $data['remove_featured_image'], $data['remove_featured_animation']);

        if ($request->hasFile('featured_image_file')) {
            try {
                $data['featured_image'] = MediaStorage::storeImage($request->file('featured_image_file'), 'blog');
            } catch (RuntimeException $exception) {
                report($exception);

                return back()->withInput()->withErrors([
                    'featured_image_file' => 'The image could not be saved. Check storage/app/public permissions and try again.',
                ]);
            }
        }

        if ($request->hasFile('featured_animation_html_file')) {
            try {
                $data['featured_animation_html_url'] = MediaStorage::storeAnimationHtml($request->file('featured_animation_html_file'), 'blog/animations');
                $data['featured_media_type'] = 'animation';
            } catch (RuntimeException $exception) {
                report($exception);

                return back()->withInput()->withErrors(['featured_animation_html_file' => 'The blog HTML animation could not be saved.']);
            }
        }

        $blogPost = BlogPost::query()->create($data);

        return redirect()->route('admin.blog.edit', $blogPost)->with('success', 'Blog post created.');
    }

    public function edit(BlogPost $blogPost): View
    {
        return view('admin.blog.form', compact('blogPost'));
    }

    public function update(UpdateBlogPostRequest $request, BlogPost $blogPost): RedirectResponse
    {
        $data = $this->prepareData($request->validated());
        $data['slug'] = $this->uniqueSlug($data['slug'] ?? null, $data['title'], $blogPost->id);
        $data['featured_image'] = $data['featured_image_url'] ?? $blogPost->featured_image;
        unset($data['featured_image_url'], $data['featured_image_file'], $data['featured_animation_html_file'], $data['remove_featured_image'], $data['remove_featured_animation']);

        if ($request->boolean('remove_featured_image')) {
            MediaStorage::deleteManaged($blogPost->featured_image);
            $data['featured_image'] = null;
            $data['featured_image_alt'] = null;
        }

        if ($request->boolean('remove_featured_animation')) {
            MediaStorage::deleteManaged($blogPost->featured_animation_html_url);
            $data['featured_animation_html_url'] = null;
        }

        if ($request->hasFile('featured_image_file')) {
            try {
                $newImage = MediaStorage::storeImage($request->file('featured_image_file'), 'blog');
            } catch (RuntimeException $exception) {
                report($exception);

                return back()->withInput()->withErrors([
                    'featured_image_file' => 'The image could not be saved. Check storage/app/public permissions and try again.',
                ]);
            }

            MediaStorage::deleteManaged($blogPost->featured_image);
            $data['featured_image'] = $newImage;
        }

        if ($request->hasFile('featured_animation_html_file')) {
            try {
                $newAnimation = MediaStorage::storeAnimationHtml($request->file('featured_animation_html_file'), 'blog/animations');
            } catch (RuntimeException $exception) {
                report($exception);

                return back()->withInput()->withErrors(['featured_animation_html_file' => 'The blog HTML animation could not be saved.']);
            }
            MediaStorage::deleteManaged($blogPost->featured_animation_html_url);
            $data['featured_animation_html_url'] = $newAnimation;
            $data['featured_media_type'] = 'animation';
        }

        $blogPost->update($data);

        return redirect()->route('admin.blog.edit', $blogPost)->with('success', 'Blog post updated.');
    }

    public function destroy(BlogPost $blogPost): RedirectResponse
    {
        MediaStorage::deleteManaged($blogPost->featured_image);
        MediaStorage::deleteManaged($blogPost->featured_animation_html_url);
        $blogPost->delete();

        return redirect()->route('admin.blog.index')->with('success', 'Blog post deleted.');
    }

    /** @param array<string, mixed> $data */
    private function prepareData(array $data): array
    {
        $data['is_published'] = (bool) ($data['is_published'] ?? false);
        $data['body'] = RichText::sanitize($data['body'] ?? null) ?? '';
        $data['meta_description'] = RichText::sanitize($data['meta_description'] ?? null);

        if ($data['is_published'] && empty($data['published_at'])) {
            $data['published_at'] = now();
        }

        foreach (['excerpt', 'author_name', 'featured_image_url'] as $field) {
            if (array_key_exists($field, $data) && is_string($data[$field])) {
                $data[$field] = trim($data[$field]);
                if ($data[$field] === '') {
                    $data[$field] = null;
                }
            }
        }

        return $data;
    }

    private function uniqueSlug(?string $requestedSlug, string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($requestedSlug ?: $title);
        if ($base === '') {
            $base = 'post';
        }

        $slug = $base;
        $suffix = 2;

        while (
            BlogPost::query()
                ->where('slug', $slug)
                ->when($ignoreId, fn ($query) => $query->whereKeyNot($ignoreId))
                ->exists()
        ) {
            $slug = $base.'-'.$suffix;
            $suffix++;
        }

        return $slug;
    }
}
