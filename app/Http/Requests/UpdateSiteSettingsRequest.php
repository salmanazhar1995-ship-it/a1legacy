<?php

namespace App\Http\Requests;

use App\Rules\SafeAnimationHtmlUpload;
use App\Rules\SafeImageUpload;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSiteSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return $this->user()?->is_admin ?? false;
    }

    /** @return array<string, ValidationRule|array<mixed>|string> */
    public function rules(): array
    {
        return [
            'settings' => ['nullable', 'array'],
            'settings.*' => ['nullable', 'string', 'max:5000'],
            'settings.smtp_enabled' => ['nullable', 'boolean'],
            'settings.smtp_host' => ['required_if:settings.smtp_enabled,1', 'nullable', 'string', 'max:255'],
            'settings.smtp_port' => ['required_if:settings.smtp_enabled,1', 'nullable', 'integer', 'between:1,65535'],
            'settings.smtp_encryption' => ['required_if:settings.smtp_enabled,1', 'nullable', Rule::in(['tls', 'ssl', 'none'])],
            'settings.smtp_username' => ['nullable', 'string', 'max:255'],
            'settings.smtp_password' => ['nullable', 'string', 'max:1000'],
            'settings.smtp_from_address' => ['required_if:settings.smtp_enabled,1', 'nullable', 'email', 'max:255'],
            'settings.smtp_from_name' => ['required_if:settings.smtp_enabled,1', 'nullable', 'string', 'max:255'],

            'setting_media_types' => ['nullable', 'array'],
            'setting_media_types.*' => ['nullable', Rule::in(['image', 'animation'])],
            'setting_files' => ['nullable', 'array'],
            'setting_files.*' => ['nullable', new SafeImageUpload],
            'setting_image_alts' => ['nullable', 'array'],
            'setting_image_alts.*' => ['nullable', 'string', 'max:255'],
            'setting_animation_files' => ['nullable', 'array'],
            'setting_animation_files.*' => ['nullable', new SafeAnimationHtmlUpload],
            'remove_setting_images' => ['nullable', 'array'],
            'remove_setting_images.*' => ['nullable', 'boolean'],
            'remove_setting_animations' => ['nullable', 'array'],
            'remove_setting_animations.*' => ['nullable', 'boolean'],
        ];
    }
}
