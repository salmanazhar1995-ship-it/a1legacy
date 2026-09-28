<?php

namespace App\Http\Requests;

use App\Models\Gallery;
use App\Rules\SafeAnimationHtmlUpload;
use App\Rules\SafeImageUpload;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGalleryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    public function rules(): array
    {
        $g = $this->route('gallery');
        $id = $g instanceof Gallery ? $g->getKey() : $g;
        $hasExistingImage = $g instanceof Gallery && filled($g->image_url);
        $hasExistingAnimation = $g instanceof Gallery && filled($g->animation_html_url);

        return [
            'title' => ['required', 'string', 'max:255'], 'slug' => ['nullable', 'string', 'max:255', Rule::unique('galleries', 'slug')->ignore($id)],
            'eyebrow' => ['nullable', 'string', 'max:255'], 'category' => ['nullable', 'string', 'max:255'], 'client' => ['nullable', 'string', 'max:255'], 'project_date' => ['nullable', 'date'],
            'excerpt' => ['required', 'string', 'max:1500'], 'description' => ['nullable', 'string'], 'seo_title' => ['nullable', 'string', 'max:70'], 'meta_keywords' => ['nullable', 'string', 'max:500'], 'meta_description' => ['nullable', 'string', 'max:2000'], 'tags' => ['nullable', 'array', 'max:20'], 'tags.*' => ['nullable', 'string', 'max:80'], 'tags_text' => ['nullable', 'string', 'max:3000'],
            'media_type' => ['required', Rule::in(['image', 'animation'])], 'image_alt' => [Rule::requiredIf(fn (): bool => $this->input('media_type', 'image') === 'image' && ! $this->boolean('remove_image') && ($this->hasFile('image_file') || $hasExistingImage)), 'nullable', 'string', 'max:255'], 'image_file' => ['nullable', new SafeImageUpload], 'animation_html_file' => [Rule::requiredIf(fn (): bool => $this->input('media_type') === 'animation' && ($this->boolean('remove_animation') || ! $hasExistingAnimation)), 'nullable', new SafeAnimationHtmlUpload], 'remove_image' => ['nullable', 'boolean'], 'remove_animation' => ['nullable', 'boolean'], 'is_featured' => ['required', 'boolean'], 'is_active' => ['required', 'boolean'], 'sort_order' => ['required', 'integer', 'min:0', 'max:65535'],
        ];
    }
}
