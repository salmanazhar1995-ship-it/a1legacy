<?php

use App\Http\Controllers\Admin\BlogPostController as AdminBlogPostController;
use App\Http\Controllers\Admin\BusinessUseCaseController as AdminBusinessUseCaseController;
use App\Http\Controllers\Admin\ClientStoryController as AdminClientStoryController;
use App\Http\Controllers\Admin\ContactMessageController as AdminContactMessageController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DataTableController as AdminDataTableController;
use App\Http\Controllers\Admin\GalleryController as AdminGalleryController;
use App\Http\Controllers\Admin\IndustryController as AdminIndustryController;
use App\Http\Controllers\Admin\IndustryImportController as AdminIndustryImportController;
use App\Http\Controllers\Admin\PageController as AdminPageController;
use App\Http\Controllers\Admin\PageSectionController as AdminPageSectionController;
use App\Http\Controllers\Admin\PlatformController as AdminPlatformController;
use App\Http\Controllers\Admin\PortfolioController as AdminPortfolioController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\SectionItemController as AdminSectionItemController;
use App\Http\Controllers\Admin\SiteSettingController as AdminSiteSettingController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicMediaController;
use App\Http\Controllers\Site\BlogController;
use App\Http\Controllers\Site\ChatAgentController;
use App\Http\Controllers\Site\ClientStoryController;
use App\Http\Controllers\Site\ContactMessageController;
use App\Http\Controllers\Site\GalleryController;
use App\Http\Controllers\Site\PageController;
use App\Http\Controllers\Site\PortfolioController;
use App\Http\Controllers\SitemapController;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\PreventRequestForgery;
use Illuminate\Http\RedirectResponse;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Middleware\ShareErrorsFromSession;
use Illuminate\View\View;

Route::get('/sitemap.xml', SitemapController::class)->name('sitemap');
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/products', [PageController::class, 'products'])->name('products');
Route::get('/products/{product:slug}', [PageController::class, 'product'])->name('products.show');
Route::get('/industries', [PageController::class, 'industries'])->name('industries.index');
Route::get('/industries/{industrySlug}', [PageController::class, 'industry'])->where('industrySlug', '[A-Za-z0-9-]+')->name('industries.show');
Route::get('/portfolio', [PortfolioController::class, 'index'])->name('portfolio.index');
Route::get('/portfolio/{portfolio:slug}', [PortfolioController::class, 'show'])->name('portfolio.show');
Route::redirect('/project-portfolio', '/portfolio', 301)->name('portfolio.legacy');
Route::get('/client-stories', [ClientStoryController::class, 'index'])->name('client-stories.index');
Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
Route::get('/gallery/{gallery:slug}', [GalleryController::class, 'show'])->name('gallery.show');
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{blogPost:slug}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', ContactMessageController::class)->middleware('throttle:5,1')->name('contact.store');
Route::post('/chat-agent/messages', ChatAgentController::class)
    ->middleware('throttle:20,1')
    ->name('chat-agent.messages.store');
Route::get('/changelog', [PageController::class, 'changelog'])->name('changelog');
Route::get('/privacy-policy', [PageController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/terms-of-service', [PageController::class, 'termsOfService'])->name('terms-of-service');

// Serves only images stored on the public disk. This works even on hosts where
// public/storage symlinks are unavailable.
$statelessMediaMiddleware = [
    EncryptCookies::class,
    AddQueuedCookiesToResponse::class,
    StartSession::class,
    ShareErrorsFromSession::class,
    PreventRequestForgery::class,
];

Route::get('/media/{path}', PublicMediaController::class)
    ->where('path', '.*')
    ->withoutMiddleware($statelessMediaMiddleware)
    ->name('media.show');

// Backward-compatible image URL for existing database records. This also
// removes any dependency on a public/storage symlink.
Route::get('/storage/{path}', PublicMediaController::class)
    ->where('path', '.*')
    ->withoutMiddleware($statelessMediaMiddleware)
    ->name('media.legacy');

Route::get('/dashboard', function (): RedirectResponse|View {
    if (auth()->user()?->is_admin) {
        return redirect()->route('admin.dashboard');
    }

    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('admin')->name('admin.')->middleware(['auth', 'verified', 'can:access-admin', 'admin.session'])->group(function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::prefix('data')->name('data.')->group(function () {
        Route::get('pages', [AdminDataTableController::class, 'pages'])->name('pages');
        Route::get('products', [AdminDataTableController::class, 'products'])->name('products');
        Route::get('platforms', [AdminDataTableController::class, 'platforms'])->name('platforms');
        Route::get('business-use-cases', [AdminDataTableController::class, 'businessUseCases'])->name('business-use-cases');
        Route::get('portfolio', [AdminDataTableController::class, 'portfolio'])->name('portfolio');
        Route::get('gallery', [AdminDataTableController::class, 'gallery'])->name('gallery');
        Route::get('client-stories', [AdminDataTableController::class, 'clientStories'])->name('client-stories');
        Route::get('blog', [AdminDataTableController::class, 'blog'])->name('blog');
        Route::get('messages', [AdminDataTableController::class, 'messages'])->name('messages');
        Route::get('users', [AdminDataTableController::class, 'users'])->name('users');
    });
    Route::resource('pages', AdminPageController::class)->only(['index', 'create', 'store', 'edit', 'update']);
    Route::post('pages/{page}/toggle-published', [AdminPageController::class, 'togglePublished'])->name('pages.toggle-published');
    Route::post('pages/{page}/toggle-navigation', [AdminPageController::class, 'toggleNavigation'])->name('pages.toggle-navigation');
    Route::resource('blog', AdminBlogPostController::class)
        ->parameters(['blog' => 'blogPost'])
        ->except(['show']);
    Route::resource('products', AdminProductController::class)->except(['show']);
    Route::resource('platforms', AdminPlatformController::class)->except(['show']);
    Route::get('industries/import-template', [AdminIndustryImportController::class, 'template'])->name('industries.import-template');
    Route::post('industries/import', [AdminIndustryImportController::class, 'store'])->name('industries.import');
    Route::resource('industries', AdminIndustryController::class)->except(['show']);
    Route::resource('business-use-cases', AdminBusinessUseCaseController::class)->parameters(['business-use-cases' => 'businessUseCase'])->except(['show']);
    Route::resource('portfolio', AdminPortfolioController::class)->except(['show']);
    Route::resource('client-stories', AdminClientStoryController::class)->parameters(['client-stories' => 'clientStory'])->except(['show']);
    Route::resource('gallery', AdminGalleryController::class)->except(['show']);
    Route::get('pages/{page}/sections/create', [AdminPageSectionController::class, 'create'])->name('sections.create');
    Route::post('pages/{page}/sections', [AdminPageSectionController::class, 'store'])->name('sections.store');
    Route::post('pages/{page}/sections/html-upload', [AdminPageSectionController::class, 'storeHtml'])->name('sections.store-html');
    Route::get('pages/{page}/sections/{section}/edit', [AdminPageSectionController::class, 'edit'])->name('sections.edit')->scopeBindings();
    Route::put('pages/{page}/sections/{section}', [AdminPageSectionController::class, 'update'])->name('sections.update')->scopeBindings();
    Route::delete('pages/{page}/sections/{section}', [AdminPageSectionController::class, 'destroy'])->name('sections.destroy')->scopeBindings();
    Route::post('pages/{page}/sections/{section}/move-up', [AdminPageSectionController::class, 'moveUp'])->name('sections.move-up')->scopeBindings();
    Route::post('pages/{page}/sections/{section}/move-down', [AdminPageSectionController::class, 'moveDown'])->name('sections.move-down')->scopeBindings();
    Route::post('pages/{page}/sections/{section}/toggle', [AdminPageSectionController::class, 'toggle'])->name('sections.toggle')->scopeBindings();
    Route::get('pages/{page}/sections/{section}/items/create', [AdminSectionItemController::class, 'create'])->name('items.create')->scopeBindings();
    Route::post('pages/{page}/sections/{section}/items', [AdminSectionItemController::class, 'store'])->name('items.store')->scopeBindings();
    Route::get('pages/{page}/sections/{section}/items/{item}/edit', [AdminSectionItemController::class, 'edit'])->name('items.edit')->scopeBindings();
    Route::put('pages/{page}/sections/{section}/items/{item}', [AdminSectionItemController::class, 'update'])->name('items.update')->scopeBindings();
    Route::delete('pages/{page}/sections/{section}/items/{item}', [AdminSectionItemController::class, 'destroy'])->name('items.destroy')->scopeBindings();
    Route::get('settings', [AdminSiteSettingController::class, 'index'])->name('settings.index');
    Route::put('settings', [AdminSiteSettingController::class, 'update'])->name('settings.update');
    Route::resource('messages', AdminContactMessageController::class)->only(['index', 'show', 'update', 'destroy']);
    Route::resource('users', AdminUserController::class)->only(['index', 'edit', 'update']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// Fallback for published CMS pages added from the database. Explicit routes above take precedence.
Route::get('/{slug}', [PageController::class, 'show'])
    ->where('slug', '[A-Za-z0-9-]+')
    ->name('page.show');
