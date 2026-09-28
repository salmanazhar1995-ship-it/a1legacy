<?php

namespace App\Models;

use Database\Factories\SiteSettingFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;

#[Fillable(['key', 'label', 'group', 'type', 'value', 'media_type', 'image_alt', 'animation_html_url', 'sort_order'])]
class SiteSetting extends Model
{
    /** @use HasFactory<SiteSettingFactory> */
    use HasFactory;

    /**
     * Return the regular key => value collection plus media metadata keys.
     * This keeps existing templates compatible while allowing every site-image
     * setting to switch between an image and a sandboxed HTML animation.
     *
     * @param  array<int,string>|null  $keys
     */
    public static function valuesWithMediaMeta(?array $keys = null): Collection
    {
        $query = static::query();
        if ($keys !== null) {
            $query->whereIn('key', $keys);
        }

        if (! Schema::hasColumn('site_settings', 'media_type')) {
            return $query->pluck('value', 'key');
        }

        $values = collect();
        foreach ($query->get(['key', 'value', 'media_type', 'image_alt', 'animation_html_url']) as $setting) {
            $values->put($setting->key, $setting->value);
            $values->put($setting->key.'__media_type', $setting->media_type ?: 'image');
            $values->put($setting->key.'__image_alt', $setting->image_alt);
            $values->put($setting->key.'__animation_html_url', $setting->animation_html_url);
        }

        return $values;
    }
}
