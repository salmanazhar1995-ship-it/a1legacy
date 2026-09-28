<?php

namespace App\Http\Requests;

use App\Models\BlogPost;
use App\Rules\SafeAnimationHtmlUpload;
use App\Rules\SafeImageUpload;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBlogPostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_admin ?? false;
    }

    /** @return array<string, ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        $routePost = $this->route('blogPost');
        $postId = $routePost instanceof BlogPost ? $routePost->getKey() : $routePost;
        $hasExistingImage = $routePost instanceof BlogPost && filled($routePost->featured_image);
        $hasExistingAnimation = $routePost instanceof BlogPost && filled($routePost->featured_animation_html_url);

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => [
                'nullable',
                'string',
                'max:255',
                'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('blog_posts', 'slug')->ignore($postId),
            ],
            'excerpt' => ['nullable', 'string', 'max:1200'],
            'body' => ['required', 'string', 'max:60000'],
            'seo_title' => ['nullable', 'string', 'max:70'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],
            'meta_description' => ['nullable', 'string', 'max:2000'],
            'featured_image_url' => ['nullable', 'string', 'max:500'],
            'featured_media_type' => ['required', Rule::in(['image', 'animation'])],
            'featured_image_alt' => [Rule::requiredIf(fn (): bool => $this->input('featured_media_type', 'image') === 'image' && ! $this->boolean('remove_featured_image') && ($this->hasFile('featured_image_file') || $this->filled('featured_image_url') || $hasExistingImage)), 'nullable', 'string', 'max:255'],
            'featured_image_file' => ['nullable', new SafeImageUpload],
            'featured_animation_html_file' => [Rule::requiredIf(fn (): bool => $this->input('featured_media_type') === 'animation' && ($this->boolean('remove_featured_animation') || ! $hasExistingAnimation)), 'nullable', new SafeAnimationHtmlUpload],
            'remove_featured_image' => ['nullable', 'boolean'],
            'remove_featured_animation' => ['nullable', 'boolean'],
            'author_name' => ['nullable', 'string', 'max:255'],
            'published_at' => ['nullable', 'date'],
            'is_published' => ['required', 'boolean'],
        ];
    }
}
