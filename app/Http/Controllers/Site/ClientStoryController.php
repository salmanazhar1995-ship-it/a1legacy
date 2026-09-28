<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\ClientStory;
use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class ClientStoryController extends Controller
{
    public function index(): View
    {
        $page = Page::query()->published()->where('slug', 'client-stories')->with(['sections' => fn ($q) => $q->where('is_enabled', true)->orderBy('sort_order')->with(['items' => fn ($i) => $i->where('is_enabled', true)->orderBy('sort_order')])])->firstOrFail();
        $navigationPages = $this->nav();
        $settings = SiteSetting::valuesWithMediaMeta();
        $stories = ClientStory::query()->public()->orderBy('sort_order')->orderByDesc('id')->get();

        return view('pages.client-stories', compact('page', 'navigationPages', 'settings', 'stories'));
    }

    private function nav(): Collection
    {
        return Page::query()->published()->where('show_in_navigation', true)->orderBy('sort_order')->orderBy('id')->get(['id', 'title', 'slug', 'navigation_label']);
    }
}
