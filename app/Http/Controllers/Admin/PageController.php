<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePageRequest;
use App\Http\Requests\UpdatePageRequest;
use App\Models\Page;
use App\Support\RichText;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index(): View
    {
        return view('admin.pages.index');
    }

    public function create(): View
    {
        $page = new Page([
            'template' => 'standard',
            'is_published' => true,
            'show_in_navigation' => true,
            'sort_order' => ((int) Page::query()->max('sort_order')) + 10,
        ]);

        return view('admin.pages.create', compact('page'));
    }

    public function store(StorePageRequest $request): RedirectResponse
    {
        $page = DB::transaction(function () use ($request): Page {
            $data = $request->validated();
            $data['meta_description'] = RichText::sanitize($data['meta_description'] ?? null);
            $page = Page::query()->create($data);
            $page->sections()->create([
                'key' => 'hero',
                'type' => 'hero',
                'eyebrow' => $page->navigation_label ?: $page->title,
                'heading' => $page->title,
                'body' => 'Add your page introduction here, then build the rest of the page with sections from the admin page builder.',
                'is_enabled' => true,
                'sort_order' => 0,
            ]);

            return $page;
        });

        return redirect()->route('admin.pages.edit', $page)->with('success', 'Navbar page created. Add or edit sections below.');
    }

    public function edit(Page $page): View
    {
        $page->load(['sections' => fn ($query) => $query->withCount('items')]);

        return view('admin.pages.edit', compact('page'));
    }

    public function update(UpdatePageRequest $request, Page $page): RedirectResponse
    {
        $data = $request->validated();
        $data['meta_description'] = RichText::sanitize($data['meta_description'] ?? null);
        $page->update($data);

        return redirect()->route('admin.pages.edit', $page)->with('success', 'Page settings updated.');
    }

    public function togglePublished(Page $page): RedirectResponse
    {
        $page->update(['is_published' => ! $page->is_published]);

        return back()->with('success', $page->is_published ? 'Page enabled.' : 'Page disabled.');
    }

    public function toggleNavigation(Page $page): RedirectResponse
    {
        $page->update(['show_in_navigation' => ! $page->show_in_navigation]);

        return back()->with('success', $page->show_in_navigation ? 'Navbar tab enabled.' : 'Navbar tab disabled.');
    }
}
