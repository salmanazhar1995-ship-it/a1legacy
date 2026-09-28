<?php

namespace App\Models;

use Database\Factories\SectionItemFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['page_section_id', 'title', 'subtitle', 'description', 'badge', 'value', 'image_url', 'link_label', 'link_url', 'settings', 'is_enabled', 'sort_order'])]
class SectionItem extends Model
{
    /** @use HasFactory<SectionItemFactory> */
    use HasFactory;

    public function section(): BelongsTo
    {
        return $this->belongsTo(PageSection::class, 'page_section_id');
    }

    protected function casts(): array
    {
        return [
            'settings' => 'array',
            'is_enabled' => 'boolean',
        ];
    }
}
