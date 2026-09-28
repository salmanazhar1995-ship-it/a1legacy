<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

#[Fillable([
    'title', 'slug', 'eyebrow', 'category', 'client_name', 'project_date',
    'excerpt', 'description', 'challenge', 'solution', 'outcome', 'image_url', 'image_alt', 'media_type', 'animation_html_url',
    'seo_title', 'meta_keywords', 'meta_description',
    'project_url', 'highlights', 'technologies', 'is_featured', 'is_active', 'sort_order',
])]
class Portfolio extends Model
{
    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    #[Scope]
    protected function active(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    #[Scope]
    protected function featured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    protected function casts(): array
    {
        return [
            'project_date' => 'date',
            'highlights' => 'array',
            'technologies' => 'array',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
        ];
    }
}
