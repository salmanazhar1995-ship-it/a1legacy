<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable([
    'industry_id',
    'category',
    'slug',
    'title',
    'description',
    'image_url',
    'image_alt',
    'media_type',
    'animation_html_url',
    'highlights',
    'system_note',
    'link_label',
    'link_url',
    'is_active',
    'seo_title',
    'meta_keywords',
    'meta_description',
    'sort_order',
])]
class BusinessUseCase extends Model
{
    public function industry(): BelongsTo
    {
        return $this->belongsTo(Industry::class);
    }

    #[Scope]
    protected function active(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    protected function casts(): array
    {
        return [
            'highlights' => 'array',
            'is_active' => 'boolean',
        ];
    }
}
