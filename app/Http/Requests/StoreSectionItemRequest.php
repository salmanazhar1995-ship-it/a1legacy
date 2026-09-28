<?php

namespace App\Http\Requests;

use App\Rules\SafeAnimationHtmlUpload;
use App\Rules\SafeImageUpload;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSectionItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_admin ?? false;
    }

    /** @return array<string, ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        return [
            'title' => ['nullable', 'required_without:value', 'string', 'max:255'],
            'subtitle' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:10000'],
            'badge' => ['nullable', 'string', 'max:80'],
            'value' => ['nullable', 'string', 'max:120'],
            'image_url' => ['nullable', 'string', 'max:500'],
            'media_type' => ['required', Rule::in(['image', 'animation'])],
            'image_alt' => [Rule::requiredIf(fn (): bool => $this->input('media_type', 'image') === 'image' && ($this->hasFile('image_file') || $this->filled('image_url'))), 'nullable', 'string', 'max:255'],
            'image_file' => ['nullable', new SafeImageUpload],
            'animation_html_file' => [Rule::requiredIf(fn (): bool => $this->input('media_type') === 'animation'), 'nullable', new SafeAnimationHtmlUpload],
            'remove_image' => ['nullable', 'boolean'],
            'remove_animation' => ['nullable', 'boolean'],
            'link_label' => ['nullable', 'string', 'max:80'],
            'link_url' => ['nullable', 'string', 'max:500'],
            'is_enabled' => ['required', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:1000'],
        ];
    }
}
