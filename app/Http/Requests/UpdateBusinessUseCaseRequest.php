<?php

namespace App\Http\Requests;

use App\Rules\SafeAnimationHtmlUpload;
use App\Rules\SafeImageUpload;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateBusinessUseCaseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    public function rules(): array
    {
        $businessUseCase = $this->route('businessUseCase');
        $hasExistingImage = is_object($businessUseCase) && filled($businessUseCase->image_url);
        $hasExistingAnimation = is_object($businessUseCase) && filled($businessUseCase->animation_html_url);

        return [
            'industry_id' => ['required', 'integer', 'exists:industries,id'],
            'category' => ['nullable', 'string', 'max:120'],
            'slug' => ['nullable', 'string', 'max:180', 'alpha_dash'],
            'title' => ['required', 'string', 'max:180'],
            'description' => ['nullable', 'string', 'max:12000'],
            'seo_title' => ['nullable', 'string', 'max:70'],
            'meta_keywords' => ['nullable', 'string', 'max:500'],
            'meta_description' => ['nullable', 'string', 'max:2000'],
            'media_type' => ['required', Rule::in(['image', 'animation'])],
            'image_alt' => [Rule::requiredIf(fn (): bool => $this->input('media_type', 'image') === 'image' && ! $this->boolean('remove_image') && ($this->hasFile('image_file') || $hasExistingImage)), 'nullable', 'string', 'max:255'],
            'image_file' => ['nullable', new SafeImageUpload],
            'animation_html_file' => [Rule::requiredIf(fn (): bool => $this->input('media_type') === 'animation' && ($this->boolean('remove_animation') || ! $hasExistingAnimation)), 'nullable', new SafeAnimationHtmlUpload],
            'remove_image' => ['nullable', 'boolean'],
            'remove_animation' => ['nullable', 'boolean'],
            'highlights' => ['nullable', 'array'],
            'highlights.*' => ['nullable', 'string', 'max:255'],
            'system_note' => ['nullable', 'string', 'max:2500'],
            'link_label' => ['nullable', 'string', 'max:120'],
            'link_url' => ['nullable', 'string', 'max:1000', function (string $attribute, mixed $value, \Closure $fail): void {
                if ($value === null || $value === '') {
                    return;
                }
                if (! str_starts_with((string) $value, '/') && ! preg_match('#^https?://#i', (string) $value)) {
                    $fail('Use a website path beginning with / or a full https:// URL.');
                }
            }],
            'is_active' => ['required', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:65535'],
        ];
    }
}
