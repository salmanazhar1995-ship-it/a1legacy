<?php

namespace App\Http\Requests;

use App\Models\PageSection;
use App\Rules\SafeAnimationHtmlUpload;
use App\Rules\SafeImageUpload;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdatePageSectionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    protected function prepareForValidation(): void
    {
        if (! $this->filled('key') && $this->filled('heading')) {
            $this->merge(['key' => Str::slug((string) $this->input('heading'))]);
        }
    }

    public function rules(): array
    {
        $page = $this->route('page');
        $section = $this->route('section');
        $pageId = is_object($page) ? $page->getKey() : $page;
        $sectionId = $section instanceof PageSection ? $section->getKey() : $section;
        $hasExistingImage = $section instanceof PageSection && filled(data_get($section->settings, 'image'));
        $hasExistingAnimation = $section instanceof PageSection && filled(data_get($section->settings, 'animation_html'));
        $hasExistingBackgroundImage = $section instanceof PageSection && filled(data_get($section->settings, 'background_image'));
        $hasExistingBackgroundAnimation = $section instanceof PageSection && filled(data_get($section->settings, 'background_animation_html'));
        $hasExistingSectionHtml = $section instanceof PageSection && filled(data_get($section->settings, 'section_html'));

        return [
            'key' => [
                'required', 'string', 'max:120', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/',
                Rule::unique('page_sections', 'key')
                    ->where(fn ($query) => $query->where('page_id', $pageId))
                    ->ignore($sectionId),
            ],
            'type' => ['required', Rule::in(StorePageSectionRequest::types())],
            'eyebrow' => ['nullable', 'string', 'max:120'],
            'heading' => ['nullable', 'string', 'max:255'],
            'body' => ['nullable', 'string', 'max:60000'],
            'button_label' => ['nullable', 'string', 'max:80'],
            'button_url' => ['nullable', 'string', 'max:500'],
            'secondary_button_label' => ['nullable', 'string', 'max:80'],
            'secondary_button_url' => ['nullable', 'string', 'max:500'],
            'layout' => ['nullable', Rule::in(['default', 'image_left', 'image_right', 'centered', 'wide'])],
            'alignment' => ['nullable', Rule::in(['left', 'center', 'right'])],
            'columns' => ['nullable', 'integer', 'min:1', 'max:4'],
            'theme' => ['nullable', Rule::in(['default', 'panel', 'accent', 'subtle'])],
            'media_type' => ['nullable', Rule::in(['image', 'animation'])],
            'image_alt' => [Rule::requiredIf(fn (): bool => $this->input('media_type', 'image') === 'image' && ! $this->boolean('remove_image') && ($this->hasFile('image_file') || $hasExistingImage)), 'nullable', 'string', 'max:255'],
            'image_file' => ['nullable', new SafeImageUpload],
            'animation_html_file' => [Rule::requiredIf(fn (): bool => $this->input('media_type') === 'animation' && ($this->boolean('remove_animation') || ! $hasExistingAnimation)), 'nullable', new SafeAnimationHtmlUpload],
            'background_media_type' => ['nullable', Rule::in(['image', 'animation'])],
            'background_image_alt' => [Rule::requiredIf(fn (): bool => $this->input('background_media_type', 'image') === 'image' && ! $this->boolean('remove_background_image') && ($this->hasFile('background_image_file') || $hasExistingBackgroundImage)), 'nullable', 'string', 'max:255'],
            'background_image_file' => ['nullable', new SafeImageUpload],
            'background_animation_html_file' => [Rule::requiredIf(fn (): bool => $this->input('background_media_type') === 'animation' && ($this->boolean('remove_background_animation') || ! $hasExistingBackgroundAnimation)), 'nullable', new SafeAnimationHtmlUpload],
            'section_html_file' => [Rule::requiredIf(fn (): bool => $this->input('type') === 'html_section' && ! $hasExistingSectionHtml && ! $this->boolean('remove_section_html')), 'nullable', new SafeAnimationHtmlUpload(10240)],
            'html_min_height' => ['nullable', 'integer', 'min:100', 'max:5000'],
            'remove_image' => ['nullable', 'boolean'],
            'remove_animation' => ['nullable', 'boolean'],
            'remove_background_image' => ['nullable', 'boolean'],
            'remove_background_animation' => ['nullable', 'boolean'],
            'remove_section_html' => ['nullable', 'boolean'],
            'is_enabled' => ['required', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:1000'],
        ];
    }
}
