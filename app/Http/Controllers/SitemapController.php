<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\BusinessUseCase;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Portfolio;
use App\Models\Product;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Schema;

class SitemapController extends Controller
{
    public function __invoke(): Response
    {
        $urls = collect();

        if (Schema::hasTable('pages')) {
            Page::query()
                ->published()
                ->orderBy('id')
                ->get(['slug', 'updated_at'])
                ->each(function (Page $page) use ($urls): void {
                    $path = $page->slug === 'home' ? '/' : '/'.$page->slug;
                    $urls->push($this->entry(url($path), $page->updated_at?->toAtomString(), $page->slug === 'home' ? 'weekly' : 'monthly', $page->slug === 'home' ? '1.0' : '0.8'));
                });
        }

        if (Schema::hasTable('products')) {
            Product::query()->active()->orderBy('id')->get(['slug', 'updated_at'])->each(
                fn (Product $item) => $urls->push($this->entry(route('products.show', $item), $item->updated_at?->toAtomString(), 'monthly', '0.7'))
            );
        }

        if (Schema::hasTable('business_use_cases')) {
            BusinessUseCase::query()->active()->orderBy('id')->get(['slug', 'updated_at'])->each(
                fn (BusinessUseCase $item) => $urls->push($this->entry(route('industries.show', $item->slug), $item->updated_at?->toAtomString(), 'monthly', '0.7'))
            );
        }

        if (Schema::hasTable('portfolios')) {
            Portfolio::query()->active()->orderBy('id')->get(['slug', 'updated_at'])->each(
                fn (Portfolio $item) => $urls->push($this->entry(route('portfolio.show', $item), $item->updated_at?->toAtomString(), 'monthly', '0.6'))
            );
        }

        if (Schema::hasTable('galleries')) {
            Gallery::query()->active()->orderBy('id')->get(['slug', 'updated_at'])->each(
                fn (Gallery $item) => $urls->push($this->entry(route('gallery.show', $item), $item->updated_at?->toAtomString(), 'monthly', '0.6'))
            );
        }

        if (Schema::hasTable('blog_posts')) {
            BlogPost::query()->published()->orderBy('id')->get(['slug', 'updated_at'])->each(
                fn (BlogPost $item) => $urls->push($this->entry(route('blog.show', ['blogPost' => $item->slug]), $item->updated_at?->toAtomString(), 'weekly', '0.7'))
            );
        }

        $xml = view('seo.sitemap', ['urls' => $urls->unique('loc')->values()])->render();

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=UTF-8',
            'Cache-Control' => 'public, max-age=3600',
        ]);
    }

    private function entry(string $loc, ?string $lastmod, string $changefreq, string $priority): array
    {
        return compact('loc', 'lastmod', 'changefreq', 'priority');
    }
}
