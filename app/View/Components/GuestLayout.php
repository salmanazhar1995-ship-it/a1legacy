<?php

namespace App\View\Components;

use App\Models\SiteSetting;
use Illuminate\View\Component;
use Illuminate\View\View;
use Throwable;

class GuestLayout extends Component
{
    public function render(): View
    {
        try {
            $settings = SiteSetting::valuesWithMediaMeta(['header_logo', 'favicon', 'site_name']);
        } catch (Throwable) {
            $settings = collect([
                'site_name' => config('app.name', 'A1 Legacy Labs'),
            ]);
        }

        return view('layouts.guest', compact('settings'));
    }
}
