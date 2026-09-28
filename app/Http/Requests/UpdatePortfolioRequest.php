<?php

namespace App\Http\Requests;

use App\Models\Portfolio;
use App\Rules\SafeAnimationHtmlUpload;
use App\Rules\SafeImageUpload;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePortfolioRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    public function rules(): array
    {
        $portfolio = $this->route('portfolio');
        $id = $portfolio instanceof Portfolio ? $portfolio->getKey() : $portfolio;
        $hasExistingImage = $portfolio instanceof Portfolio && filled($portfolio->image_url);
        $hasExistingAnimation = $portfolio instanceof Portfolio && filled($portfolio->animation_html_url);

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('portfolios', 'slug')->ignore($id)],
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'category' => ['nullable', 'string', 'max:255'],
            'client_name' => ['nullable', 'string', 'max:255'],
            'project_date' => ['nullable', 'date'],
            'excerpt' => ['required', 'string', 'max:1800'],
            'description' => ['nullable', 'string'],
            'challenge' => ['nullable', 'string'],
            'solution' => ['nullable', 'string'],
            'outcome' => ['nullable', 'string'],
            'seo_title' => ['nullable', 'string', 'max:70'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],
            'meta_description' => ['nullable', 'string', 'max:2000'],
            'project_url' => ['nullable', 'url', 'max:1000'],
            'highlights_text' => ['nullable', 'string', 'max:5000'],
            'technologies_text' => ['nullable', 'string', 'max:5000'],
            'media_type' => ['required', Rule::in(['image', 'animation'])],
            'image_alt' => [Rule::requiredIf(fn (): bool => $this->input('media_type', 'image') === 'image' && ! $this->boolean('remove_image') && ($this->hasFile('image_file') || $hasExistingImage)), 'nullable', 'string', 'max:255'],
            'image_file' => ['nullable', new SafeImageUpload],
            'animation_html_file' => [Rule::requiredIf(fn (): bool => $this->input('media_type') === 'animation' && ($this->boolean('remove_animation') || ! $hasExistingAnimation)), 'nullable', new SafeAnimationHtmlUpload],
            'remove_image' => ['nullable', 'boolean'],
            'remove_animation' => ['nullable', 'boolean'],
            'is_featured' => ['required', 'boolean'],
            'is_active' => ['required', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:65535'],
        ];
    }
}
