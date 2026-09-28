<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['person_name', 'business_name', 'role', 'implementation_label', 'approved_quote', 'video_url', 'poster_image_url', 'poster_media_type', 'poster_image_alt', 'poster_animation_html_url', 'is_featured', 'is_active', 'is_approved_for_public_use', 'sort_order'])]
class ClientStory extends Model
{
    #[Scope]
    protected function public(Builder $query): Builder
    {
        return $query->where('is_active', true)->where('is_approved_for_public_use', true);
    }

    #[Scope]
    protected function featured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    protected function casts(): array
    {
        return ['is_featured' => 'boolean', 'is_active' => 'boolean', 'is_approved_for_public_use' => 'boolean'];
    }
}
