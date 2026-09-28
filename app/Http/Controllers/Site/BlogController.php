<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\Page;
use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;

class BlogController extends Controller
{
    public function index(): View
    {
        $page = $this->blogPage();
        $navigationPages = $this->navigationPages();
        $settings = SiteSetting::valuesWithMediaMeta();
        $posts = BlogPost::query()
            ->published()
            ->orderByDesc('published_at')
            ->orderByDesc('id')
            ->paginate(9);

        return view('pages.blog', compact('page', 'navigationPages', 'settings', 'posts'));
    }

    public function show(BlogPost $blogPost): View
    {
        abort_unless(
            $blogPost->is_published
            && ($blogPost->published_at === null || $blogPost->published_at->lte(now())),
            404
        );

        $page = $this->blogPage();
        $navigationPages = $this->navigationPages();
        $settings = SiteSetting::valuesWithMediaMeta();

        return view('pages.blog-post', compact('page', 'navigationPages', 'settings', 'blogPost'));
    }

    private function blogPage(): Page
    {
        return Page::query()
            ->published()
            ->where('slug', 'blog')
            ->with(['sections' => fn ($query) => $query->where('is_enabled', true)->orderBy('sort_order')->orderBy('id')])
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
