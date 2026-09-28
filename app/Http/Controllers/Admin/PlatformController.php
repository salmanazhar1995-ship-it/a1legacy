<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePlatformRequest;
use App\Http\Requests\UpdatePlatformRequest;
use App\Models\Platform;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class PlatformController extends Controller
{
    public function index(): View
    {
        return view('admin.platforms.index');
    }

    public function create(): View
    {
        $platform = new Platform([
            'icon' => 'activity',
            'is_active' => true,
            'sort_order' => ((int) Platform::query()->max('sort_order')) + 10,
        ]);

        return view('admin.platforms.form', compact('platform'));
    }

    public function store(StorePlatformRequest $request): RedirectResponse
    {
        Platform::query()->create($request->validated());

        return redirect()->route('admin.platforms.index')->with('success', 'Platform created successfully.');
    }

    public function edit(Platform $platform): View
    {
        return view('admin.platforms.form', compact('platform'));
    }

    public function update(UpdatePlatformRequest $request, Platform $platform): RedirectResponse
    {
        $platform->update($request->validated());

        return redirect()->route('admin.platforms.index')->with('success', 'Platform updated successfully.');
    }

    public function destroy(Platform $platform): RedirectResponse
    {
        $platform->delete();

        return redirect()->route('admin.platforms.index')->with('success', 'Platform deleted successfully.');
    }
}
