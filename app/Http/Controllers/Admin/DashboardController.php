<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Page;
use App\Models\PageSection;
use App\Models\User;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function __invoke(): View
    {
        $totalUsers = User::query()->count();
        $newUsersThisWeek = User::query()
            ->where('created_at', '>=', now()->startOfWeek())
            ->count();
        $recentUsers = User::query()
            ->latest()
            ->orderByDesc('id')
            ->limit(5)
            ->get(['id', 'name', 'email', 'created_at']);
        $publishedPages = Page::query()->where('is_published', true)->count();
        $contentSections = PageSection::query()->count();
        $newMessages = ContactMessage::query()->where('status', 'new')->count();
        $recentMessages = ContactMessage::query()
            ->latest()
            ->orderByDesc('id')
            ->limit(5)
            ->get(['id', 'name', 'email', 'status', 'created_at']);

        return view('admin.dashboard', compact(
            'totalUsers',
            'newUsersThisWeek',
            'recentUsers',
            'publishedPages',
            'contentSections',
            'newMessages',
            'recentMessages',
        ));
    }
}
