<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreIndustryRequest;
use App\Http\Requests\UpdateIndustryRequest;
use App\Models\Industry;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class IndustryController extends Controller
{
    public function index(): View
    {
        $industries = Industry::query()
            ->withCount('subIndustries')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->paginate(25);

        return view('admin.industries.index', compact('industries'));
    }

    public function create(): View
    {
        $industry = new Industry([
            'is_active' => true,
            'sort_order' => ((int) Industry::query()->max('sort_order')) + 10,
        ]);

        return view('admin.industries.form', compact('industry'));
    }

    public function store(StoreIndustryRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['name']);
        $data['description'] = filled($data['description'] ?? null) ? trim($data['description']) : null;

        Industry::query()->create($data);

        return redirect()->route('admin.industries.index')->with('success', 'Main industry created successfully.');
    }

    public function edit(Industry $industry): View
    {
        return view('admin.industries.form', compact('industry'));
    }

    public function update(UpdateIndustryRequest $request, Industry $industry): RedirectResponse
    {
        $data = $request->validated();
        $data['slug'] = $this->uniqueSlug($data['slug'] ?: $data['name'], $industry->getKey());
        $data['description'] = filled($data['description'] ?? null) ? trim($data['description']) : null;
        $industry->update($data);

        return redirect()->route('admin.industries.index')->with('success', 'Main industry updated successfully.');
    }

    public function destroy(Industry $industry): RedirectResponse
    {
        if ($industry->subIndustries()->exists()) {
            return back()->withErrors(['industry' => 'Move or delete this main industry\'s sub industries before deleting it.']);
        }

        $industry->delete();

        return redirect()->route('admin.industries.index')->with('success', 'Main industry deleted.');
    }

    private function uniqueSlug(string $value, ?int $ignoreId = null): string
    {
        $base = Str::slug($value) ?: 'industry';
        $slug = $base;
        $suffix = 2;

        while (Industry::query()->where('slug', $slug)->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base.'-'.$suffix;
            $suffix++;
        }

        return $slug;
    }
}
