<?php

namespace App\Http\Requests;

use App\Models\ClientStory;
use App\Rules\SafeAnimationHtmlUpload;
use App\Rules\SafeImageUpload;
use App\Rules\SafeVideoUpload;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateClientStoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return (bool) $this->user()?->is_admin;
    }

    public function rules(): array
    {
        $story = $this->route('clientStory');
        $hasExistingPoster = $story instanceof ClientStory && filled($story->poster_image_url);
        $hasExistingAnimation = $story instanceof ClientStory && filled($story->poster_animation_html_url);

        return [
            'person_name' => ['required', 'string', 'max:255'],
            'business_name' => ['required', 'string', 'max:255'],
            'role' => ['nullable', 'string', 'max:255'],
            'implementation_label' => ['nullable', 'string', 'max:500'],
            'approved_quote' => ['nullable', 'string', 'max:3000'],
            'video_url' => ['nullable', 'string', 'max:2000', 'regex:#^(https?://|/media/|/storage/)#i'],
            'video_file' => ['nullable', new SafeVideoUpload],
            'remove_video' => ['nullable', 'boolean'],
            'poster_media_type' => ['nullable', Rule::in(['image', 'animation'])],
            'poster_image_alt' => [Rule::requiredIf(fn (): bool => $this->input('poster_media_type', 'image') === 'image' && ! $this->boolean('remove_poster_image') && ($this->hasFile('poster_image_file') || $hasExistingPoster)), 'nullable', 'string', 'max:255'],
            'poster_image_file' => ['nullable', new SafeImageUpload],
            'remove_poster_image' => ['nullable', 'boolean'],
            'poster_animation_html_file' => [Rule::requiredIf(fn (): bool => $this->input('poster_media_type') === 'animation' && ($this->boolean('remove_poster_animation') || ! $hasExistingAnimation)), 'nullable', new SafeAnimationHtmlUpload],
            'remove_poster_animation' => ['nullable', 'boolean'],
            'is_featured' => ['required', 'boolean'],
            'is_active' => ['required', 'boolean'],
            'is_approved_for_public_use' => ['required', 'boolean'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:65535'],
        ];
    }
}
