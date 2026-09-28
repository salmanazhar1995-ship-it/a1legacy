<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Page;
use App\Models\Portfolio;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class PortfolioController extends Controller
{
    public function index(): View
    {
        $page = $this->page();
        $navigationPages = $this->navigationPages();
        $settings = SiteSetting::valuesWithMediaMeta();
        $portfolios = Portfolio::query()
            ->active()
            ->orderBy('sort_order')
            ->orderByDesc('project_date')
            ->orderBy('id')
            ->get();

        $categories = $portfolios->pluck('category')->filter()->unique()->values();

        return view('pages.portfolio', compact('page', 'navigationPages', 'settings', 'portfolios', 'categories'));
    }

    public function show(Portfolio $portfolio): View
    {
        abort_unless($portfolio->is_active, 404);

        $page = $this->page();
        $navigationPages = $this->navigationPages();
        $settings = SiteSetting::valuesWithMediaMeta();

        $relatedPortfolios = Portfolio::query()
            ->active()
            ->whereKeyNot($portfolio->getKey())
            ->when($portfolio->category, fn ($query) => $query->where('category', $portfolio->category))
            ->orderBy('sort_order')
            ->orderByDesc('project_date')
            ->limit(3)
            ->get();

        return view('pages.portfolio-detail', compact('page', 'portfolio', 'navigationPages', 'settings', 'relatedPortfolios'));
    }

    private function page(): Page
    {
        return Page::query()
            ->published()
            ->whereIn('slug', ['portfolio', 'project-portfolio'])
            ->with(['sections' => fn ($q) => $q->where('is_enabled', true)->orderBy('sort_order')->orderBy('id')->with(['items' => fn ($i) => $i->where('is_enabled', true)->orderBy('sort_order')->orderBy('id')])])
            ->orderByRaw("CASE WHEN slug = 'portfolio' THEN 0 ELSE 1 END")
            ->firstOrFail();
    }

    private function navigationPages(): Collection
    {
        return Page::query()
            ->published()
            ->where('show_in_navigation', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get(['id', 'title', 'slug', 'navigation_label']);
    }
}
