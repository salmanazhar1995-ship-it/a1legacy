<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class GalleryController extends Controller
{
    public function index(): View
    {
        $page = Page::query()->published()->where('slug', 'gallery')->with(['sections' => fn ($q) => $q->where('is_enabled', true)->orderBy('sort_order')->with(['items' => fn ($i) => $i->where('is_enabled', true)->orderBy('sort_order')])])->firstOrFail();
        $navigationPages = $this->nav();
        $settings = SiteSetting::valuesWithMediaMeta();
        $galleries = Gallery::query()->active()->orderBy('sort_order')->orderByDesc('project_date')->orderBy('id')->get();
        $categories = $galleries->pluck('category')->filter()->unique()->values();

        return view('pages.gallery', compact('page', 'navigationPages', 'settings', 'galleries', 'categories'));
    }

    public function show(Gallery $gallery): View
    {
        abort_unless($gallery->is_active, 404);
        $page = Page::query()->published()->where('slug', 'gallery')->with(['sections' => fn ($q) => $q->where('is_enabled', true)->orderBy('sort_order')->with(['items' => fn ($i) => $i->where('is_enabled', true)->orderBy('sort_order')])])->firstOrFail();
        $navigationPages = $this->nav();
        $settings = SiteSetting::valuesWithMediaMeta();
        $relatedGalleries = Gallery::query()->active()->whereKeyNot($gallery->getKey())->when($gallery->category, fn ($q) => $q->where('category', $gallery->category))->orderBy('sort_order')->limit(3)->get();

        return view('pages.gallery-detail', compact('page', 'gallery', 'navigationPages', 'settings', 'relatedGalleries'));
    }

    private function nav(): Collection
    {
        return Page::query()->published()->where('show_in_navigation', true)->orderBy('sort_order')->orderBy('id')->get(['id', 'title', 'slug', 'navigation_label']);
    }
}
