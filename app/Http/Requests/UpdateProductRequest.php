<?php

namespace App\Http\Requests;

use App\Models\Product;
use App\Rules\SafeAnimationHtmlUpload;
use App\Rules\SafeImageUpload;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    public function rules(): array
    {
        $product = $this->route('product');
        $productId = $product instanceof Product ? $product->getKey() : $product;
        $hasExistingImage = $product instanceof Product && filled($product->image_url);
        $hasExistingAnimation = $product instanceof Product && filled($product->animation_html_url);

        return [
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:255', Rule::unique('products', 'slug')->ignore($productId)],
            'eyebrow' => ['nullable', 'string', 'max:255'],
            'badge' => ['nullable', 'string', 'max:255'],
            'short_description' => ['required', 'string', 'max:1500'],
            'description' => ['nullable', 'string'],
            'seo_title' => ['nullable', 'string', 'max:70'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],
            'meta_description' => ['nullable', 'string', 'max:2000'],
            'highlights' => ['nullable', 'array', 'max:30'],
            'highlights.*' => ['nullable', 'string', 'max:255'],
            // Kept for backwards compatibility with older saved forms.
            'highlights_text' => ['nullable', 'string', 'max:5000'],
            'benefits_text' => ['nullable', 'string', 'max:12000'],
            'visual_type' => ['nullable', 'string', 'max:60'],
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
