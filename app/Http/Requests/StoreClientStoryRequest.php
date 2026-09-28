<?php

namespace App\Http\Requests;

use App\Rules\SafeAnimationHtmlUpload;
use App\Rules\SafeImageUpload;
use App\Rules\SafeVideoUpload;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreClientStoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    public function rules(): array
    {
        return [
            'person_name' => ['required', 'string', 'max:255'],
            'business_name' => ['required', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'implementation_label' => ['nullable', 'string', 'max:500'],
            'approved_quote' => ['nullable', 'string', 'max:3000'],
            'video_url' => ['nullable', 'string', 'max:2000', 'regex:#^(https?://|/media/|/storage/)#i', 'required_without:video_file'],
            'video_file' => ['nullable', 'required_without:video_url', new SafeVideoUpload],
            'poster_media_type' => ['nullable', Rule::in(['image', 'animation'])],
            'poster_image_alt' => [Rule::requiredIf(fn (): bool => $this->input('poster_media_type', 'image') === 'image' && $this->hasFile('poster_image_file')), 'nullable', 'string', 'max:255'],
            'poster_image_file' => ['nullable', new SafeImageUpload],
            'poster_animation_html_file' => [Rule::requiredIf(fn (): bool => $this->input('poster_media_type') === 'animation'), 'nullable', new SafeAnimationHtmlUpload],
            'is_featured' => ['required', 'boolean'],
            'is_active' => ['required', 'boolean'],
            'is_approved_for_public_use' => ['required', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:65535'],
        ];
    }
}
