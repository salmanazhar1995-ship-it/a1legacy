<?php

namespace App\View\Components;

use App\Models\Page;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class SiteLayout extends Component
{
    public function __construct(
        public Page $page,
        public Collection $navigationPages,
        public Collection $settings,
        public ?string $documentTitle = null,
        public ?string $documentDescription = null,
        public ?string $documentKeywords = null,
        public ?string $documentImage = null,
        public ?string $documentImageAlt = null,
        public string $documentType = 'website',
        public ?string $documentPublishedTime = null,
        public ?string $documentModifiedTime = null,
        public ?string $documentRobots = null,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('layouts.site');
    }
}
