<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\BusinessUseCase;
use App\Models\ClientStory;
use App\Models\Gallery;
use App\Models\Industry;
use App\Models\Page;
use App\Models\Platform;
use App\Models\Product;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View as ViewFacade;

class PageController extends Controller
{
    public function home(): View
    {
        return $this->renderPage('home');
    }

    public function products(): View
    {
        $page = $this->pageQuery('products')->firstOrFail();
        $navigationPages = $this->navigationPages();
        $settings = SiteSetting::valuesWithMediaMeta();
        $products = Product::query()
            ->active()
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('pages.products', compact('page', 'navigationPages', 'settings', 'products'));
    }

    public function product(Product $product): View
    {
        abort_unless($product->is_active, 404);

        $page = $this->pageQuery('products')->firstOrFail();
        $navigationPages = $this->navigationPages();
        $settings = SiteSetting::valuesWithMediaMeta();

        return view('pages.product-detail', compact('page', 'product', 'navigationPages', 'settings'));
    }

    public function industries(): View
    {
        $page = $this->pageQuery('industries')->firstOrFail();
        $navigationPages = $this->navigationPages();
        $settings = SiteSetting::valuesWithMediaMeta();
        $industries = Schema::hasTable('business_use_cases')
            ? BusinessUseCase::query()->with('industry')->active()->orderBy('sort_order')->orderBy('id')->get()
            : collect();

        return view('pages.industries', compact('page', 'navigationPages', 'settings', 'industries'));
    }

    public function industry(string $industrySlug): View
    {
        $page = $this->pageQuery('industries')->firstOrFail();
        $navigationPages = $this->navigationPages();
        $settings = SiteSetting::valuesWithMediaMeta();
        $industry = BusinessUseCase::query()
            ->with('industry')
            ->active()
            ->where('slug', $industrySlug)
            ->firstOrFail();

        return view('pages.industry-detail', compact('page', 'industry', 'navigationPages', 'settings'));
    }

    public function contact(): View
    {
        return $this->renderPage('contact');
    }

    public function changelog(): View
    {
        return $this->renderPage('changelog');
    }

    public function privacyPolicy(): View
    {
        return $this->renderPage('privacy-policy');
    }

    public function termsOfService(): View
    {
        return $this->renderPage('terms-of-service');
    }

    /**
     * Render any published CMS page added from the database.
     * Explicit routes (products/contact/etc.) take precedence in routes/web.php.
     */
    public function show(string $slug): View
    {
        if ($slug === 'products') {
            return $this->products();
        }

        if ($slug === 'industries') {
            return $this->industries();
        }

        return $this->renderPage($slug);
    }

    private function renderPage(string $slug): View
    {
        $page = $this->pageQuery($slug)->firstOrFail();
        $navigationPages = $this->navigationPages();
        $settings = SiteSetting::valuesWithMediaMeta();
        $featuredProducts = collect();
        $featuredGalleries = collect();
        $featuredClientStories = collect();
        $platforms = collect();
        $industries = collect();

        if ($slug === 'home') {
            if (Schema::hasTable('platforms')) {
                $platforms = Platform::query()->active()->orderBy('sort_order')->orderBy('id')->get();
            }
            if (Schema::hasTable('industries') && Schema::hasColumn('business_use_cases', 'industry_id')) {
                $industries = Industry::query()
                    ->active()
                    ->whereHas('subIndustries', fn (Builder $query) => $query->active())
                    ->with(['subIndustries' => fn ($query) => $query->active()->orderBy('sort_order')->orderBy('id')])
                    ->orderBy('sort_order')
                    ->orderBy('id')
                    ->get();
            }

            $featuredProducts = Product::query()
                ->active()
                ->featured()
                ->orderBy('sort_order')
                ->orderBy('id')
                ->get();

            $featuredClientStories = ClientStory::query()->public()->featured()->orderBy('sort_order')->orderByDesc('id')->limit(4)->get();
            $featuredGalleries = Gallery::query()->active()->featured()->orderBy('sort_order')->orderByDesc('project_date')->orderBy('id')->limit(4)->get();
        }

        // Keep dedicated page views where they exist. Any new CMS page falls
        // back to the generic section renderer instead of causing a 500 error.
        $view = "pages.{$slug}";
        if (! ViewFacade::exists($view)) {
            $view = 'site.page';
        }

        return view($view, compact('page', 'navigationPages', 'settings', 'featuredProducts', 'featuredGalleries', 'featuredClientStories', 'platforms', 'industries'));
    }

    private function pageQuery(string $slug): Builder
    {
        return Page::query()
            ->published()
            ->where('slug', $slug)
            ->with([
                'sections' => fn (HasMany $query) => $query
                    ->where('is_enabled', true)
                    ->orderBy('sort_order')
                    ->orderBy('id')
                    ->with([
                        'items' => fn (HasMany $items) => $items
                            ->where('is_enabled', true)
                            ->orderBy('sort_order')
                            ->orderBy('id'),
                    ]),
            ]);
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
