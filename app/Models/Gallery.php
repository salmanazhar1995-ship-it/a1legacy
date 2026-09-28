<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['title', 'slug', 'eyebrow', 'category', 'client', 'project_date', 'excerpt', 'description', 'image_url', 'image_alt', 'media_type', 'animation_html_url', 'seo_title', 'meta_keywords', 'meta_description', 'tags', 'is_featured', 'is_active', 'sort_order'])]
class Gallery extends Model
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
        return ['tags' => 'array', 'project_date' => 'date', 'is_featured' => 'boolean', 'is_active' => 'boolean'];
    }
}
