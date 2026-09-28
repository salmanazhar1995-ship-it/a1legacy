<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogPost;
use App\Models\BusinessUseCase;
use App\Models\ClientStory;
use App\Models\ContactMessage;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Platform;
use App\Models\Portfolio;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class DataTableController extends Controller
{
    public function pages(): JsonResponse
    {
        $query = Page::query()->withCount('sections');

        return DataTables::eloquent($query)
            ->addColumn('page', fn (Page $page) => '<div><p class="font-medium text-white">'.e($page->title).'</p><p class="mt-1 font-mono text-[10px] text-white/30">/'.e($page->slug === 'home' ? '' : $page->slug).'</p></div>')
            ->editColumn('template', fn (Page $page) => '<span class="text-sm text-white/50">'.e(Str::of($page->template)->replace('_', ' ')->title()).'</span>')
            ->addColumn('status', fn (Page $page) => $this->multiStatus([
                [$page->is_published ? 'Page enabled' : 'Page disabled', $page->is_published],
                [$page->show_in_navigation ? 'Navbar on' : 'Navbar off', $page->show_in_navigation],
            ]))
            ->addColumn('actions', fn (Page $page) => view('admin.pages.actions', compact('page'))->render())
            ->rawColumns(['page', 'template', 'status', 'actions'])
            ->toJson();
    }

    public function products(): JsonResponse
    {
        return DataTables::eloquent(Product::query())
            ->addColumn('product', fn (Product $product) => $this->mediaTitle($product->image_url, $product->title, '/products/'.$product->slug))
            ->addColumn('status', fn (Product $product) => $this->multiStatus([
                [$product->is_active ? 'Active' : 'Hidden', $product->is_active],
                [$product->is_featured ? 'Homepage' : 'Page only', $product->is_featured],
            ]))
            ->addColumn('actions', fn (Product $product) => view('admin.partials.table-actions', [
                'viewUrl' => route('products.show', $product), 'viewExternal' => true,
                'editUrl' => route('admin.products.edit', $product),
                'deleteUrl' => route('admin.products.destroy', $product), 'deleteLabel' => 'this product',
            ])->render())
            ->rawColumns(['product', 'status', 'actions'])
            ->toJson();
    }

    public function platforms(): JsonResponse
    {
        return DataTables::eloquent(Platform::query())
            ->addColumn('platform', fn (Platform $platform) => '<div class="min-w-[260px]"><p class="font-medium text-white">'.e($platform->title).'</p><p class="mt-1 max-w-md text-xs leading-5 text-white/40">'.e(Str::limit($platform->description ?: 'No description added.', 120)).'</p></div>')
            ->addColumn('status', fn (Platform $platform) => $this->badge($platform->is_active ? 'Visible' : 'Hidden', $platform->is_active))
            ->addColumn('actions', fn (Platform $platform) => view('admin.partials.table-actions', [
                'editUrl' => route('admin.platforms.edit', $platform),
                'deleteUrl' => route('admin.platforms.destroy', $platform), 'deleteLabel' => 'this platform',
            ])->render())
            ->rawColumns(['platform', 'status', 'actions'])
            ->toJson();
    }

    public function businessUseCases(): JsonResponse
    {
        return DataTables::eloquent(BusinessUseCase::query()->with('industry'))
            ->addColumn('business', function (BusinessUseCase $business): string {
                $image = $business->image_url
                    ? '<img src="'.e($business->image_url).'" alt="" class="h-12 w-16 rounded-lg border border-white/10 object-cover">'
                    : '<div class="h-12 w-16 rounded-lg border border-white/10 bg-white/[0.03]"></div>';

                return '<div class="flex min-w-[300px] items-center gap-3">'.$image.'<div class="min-w-0"><p class="font-medium text-white">'.e($business->title).'</p><p class="mt-1 font-mono text-[9px] uppercase tracking-wider text-neutron-300/70">'.e($business->industry?->name ?: 'Unassigned').'</p><p class="mt-1 max-w-md text-xs text-white/35">'.e(Str::limit(strip_tags((string) $business->description), 90)).'</p></div></div>';
            })
            ->addColumn('status', fn (BusinessUseCase $business) => $this->badge($business->is_active ? 'Visible' : 'Hidden', $business->is_active))
            ->addColumn('actions', fn (BusinessUseCase $business) => view('admin.partials.table-actions', [
                'editUrl' => route('admin.business-use-cases.edit', $business),
                'deleteUrl' => route('admin.business-use-cases.destroy', $business), 'deleteLabel' => 'this sub industry',
            ])->render())
            ->rawColumns(['business', 'status', 'actions'])
            ->toJson();
    }

    public function portfolio(): JsonResponse
    {
        return DataTables::eloquent(Portfolio::query())
            ->addColumn('project', fn (Portfolio $portfolio) => $this->mediaTitle($portfolio->image_url, $portfolio->title, '/portfolio/'.$portfolio->slug))
            ->editColumn('category', fn (Portfolio $portfolio) => e($portfolio->category ?: '—'))
            ->addColumn('status', fn (Portfolio $portfolio) => $this->multiStatus([
                [$portfolio->is_active ? 'Published' : 'Hidden', $portfolio->is_active],
                [$portfolio->is_featured ? 'Featured' : 'Standard', $portfolio->is_featured],
            ]))
            ->editColumn('project_date', fn (Portfolio $portfolio) => $portfolio->project_date?->format('M j, Y') ?: '—')
            ->addColumn('actions', fn (Portfolio $portfolio) => view('admin.partials.table-actions', [
                'viewUrl' => route('portfolio.show', $portfolio), 'viewExternal' => true,
                'editUrl' => route('admin.portfolio.edit', $portfolio),
                'deleteUrl' => route('admin.portfolio.destroy', $portfolio), 'deleteLabel' => 'this portfolio project',
            ])->render())
            ->rawColumns(['project', 'status', 'actions'])
            ->toJson();
    }

    public function gallery(): JsonResponse
    {
        return DataTables::eloquent(Gallery::query())
            ->addColumn('project', fn (Gallery $gallery) => $this->mediaTitle($gallery->image_url, $gallery->title, '/gallery/'.$gallery->slug))
            ->editColumn('category', fn (Gallery $gallery) => e($gallery->category ?: '—'))
            ->addColumn('status', fn (Gallery $gallery) => $this->multiStatus([
                [$gallery->is_active ? 'Active' : 'Hidden', $gallery->is_active],
                [$gallery->is_featured ? 'Homepage' : 'Gallery only', $gallery->is_featured],
            ]))
            ->addColumn('actions', fn (Gallery $gallery) => view('admin.partials.table-actions', [
                'viewUrl' => route('gallery.show', $gallery), 'viewExternal' => true,
                'editUrl' => route('admin.gallery.edit', $gallery),
                'deleteUrl' => route('admin.gallery.destroy', $gallery), 'deleteLabel' => 'this gallery item',
            ])->render())
            ->rawColumns(['project', 'status', 'actions'])
            ->toJson();
    }

    public function clientStories(): JsonResponse
    {
        return DataTables::eloquent(ClientStory::query())
            ->addColumn('client', fn (ClientStory $story) => '<div><p class="font-medium text-white">'.e($story->person_name).'</p><p class="mt-1 text-xs text-white/40">'.e($story->business_name).($story->role ? ' · '.e($story->role) : '').'</p></div>')
            ->editColumn('implementation_label', fn (ClientStory $story) => e($story->implementation_label ?: '—'))
            ->addColumn('status', fn (ClientStory $story) => $this->multiStatus([
                [$story->is_active ? 'Active' : 'Draft', $story->is_active],
                [$story->is_approved_for_public_use ? 'Approved' : 'Approval needed', $story->is_approved_for_public_use],
                [$story->is_featured ? 'Homepage' : 'Page only', $story->is_featured],
            ]))
            ->addColumn('actions', fn (ClientStory $story) => view('admin.partials.table-actions', [
                'editUrl' => route('admin.client-stories.edit', $story),
                'deleteUrl' => route('admin.client-stories.destroy', $story), 'deleteLabel' => 'this client story',
            ])->render())
            ->rawColumns(['client', 'status', 'actions'])
            ->toJson();
    }

    public function blog(): JsonResponse
    {
        return DataTables::eloquent(BlogPost::query())
            ->addColumn('post', fn (BlogPost $post) => $this->mediaTitle($post->featured_image, $post->title, '/blog/'.$post->slug))
            ->addColumn('status', fn (BlogPost $post) => $this->badge($post->is_published ? 'Published' : 'Draft', $post->is_published))
            ->addColumn('published', fn (BlogPost $post) => e(($post->published_at ?? $post->created_at)?->format('M j, Y g:i A') ?: '—'))
            ->addColumn('actions', fn (BlogPost $post) => view('admin.partials.table-actions', [
                'viewUrl' => $post->is_published ? route('blog.show', $post->slug) : null, 'viewExternal' => true,
                'editUrl' => route('admin.blog.edit', $post),
                'deleteUrl' => route('admin.blog.destroy', $post), 'deleteLabel' => 'this blog post',
            ])->render())
            ->rawColumns(['post', 'status', 'actions'])
            ->toJson();
    }

    public function messages(Request $request): JsonResponse
    {
        $allowed = ['new', 'in_progress', 'resolved', 'spam'];
        $status = $request->string('status')->toString();
        $query = ContactMessage::query()->when(in_array($status, $allowed, true), fn ($q) => $q->where('status', $status));

        return DataTables::eloquent($query)
            ->addColumn('sender', fn (ContactMessage $message) => '<div><p class="font-medium text-white">'.e($message->name).'</p><p class="mt-1 text-xs text-white/40">'.e($message->email).'</p>'.($message->company ? '<p class="mt-1 text-[11px] text-white/30">'.e($message->company).'</p>' : '').'</div>')
            ->addColumn('request', function (ContactMessage $message): string {
                $industry = $message->displayIndustry() ?: 'General enquiry';
                $service = $message->displayServiceInterest() ?: Str::limit($message->message, 90);

                return '<div class="min-w-[260px]"><p class="font-medium text-white/75">'.e($industry).'</p><p class="mt-1 max-w-md text-xs text-white/35">'.e(Str::limit((string) $service, 110)).'</p></div>';
            })
            ->addColumn('status_badge', fn (ContactMessage $message) => $this->badge(Str::headline($message->status), $message->status === 'resolved'))
            ->addColumn('received', fn (ContactMessage $message) => e($message->created_at?->format('M j, Y g:i A') ?: '—'))
            ->addColumn('actions', fn (ContactMessage $message) => view('admin.partials.table-actions', [
                'viewUrl' => route('admin.messages.show', $message),
                'editUrl' => null,
                'deleteUrl' => route('admin.messages.destroy', $message), 'deleteLabel' => 'this message',
            ])->render())
            ->rawColumns(['sender', 'status_badge', 'actions'])
            ->toJson();
    }

    public function users(): JsonResponse
    {
        return DataTables::eloquent(User::query())
            ->addColumn('user', fn (User $user) => '<div><p class="font-medium text-white">'.e($user->name).'</p><p class="mt-1 text-xs text-white/40">'.e($user->email).'</p></div>')
            ->addColumn('role', fn (User $user) => $this->badge($user->is_admin ? 'Administrator' : 'User', $user->is_admin))
            ->addColumn('joined', fn (User $user) => e($user->created_at?->format('M j, Y') ?: '—'))
            ->addColumn('actions', fn (User $user) => view('admin.partials.table-actions', ['editUrl' => route('admin.users.edit', $user), 'deleteUrl' => null])->render())
            ->rawColumns(['user', 'role', 'actions'])
            ->toJson();
    }

    private function mediaTitle(?string $image, string $title, string $path): string
    {
        $img = $image ? '<img src="'.e($image).'" alt="" class="h-12 w-16 rounded-lg border border-white/10 object-cover">' : '<div class="h-12 w-16 rounded-lg border border-white/10 bg-white/[0.03]"></div>';

        return '<div class="flex min-w-[250px] items-center gap-3">'.$img.'<div><p class="font-medium text-white">'.e($title).'</p><p class="mt-1 font-mono text-[9px] text-white/30">'.e($path).'</p></div></div>';
    }

    /** @param array<int,array{0:string,1:bool}> $items */
    private function multiStatus(array $items): string
    {
        return '<div class="flex flex-wrap gap-1.5">'.collect($items)->map(fn ($item) => $this->badge($item[0], $item[1]))->implode('').'</div>';
    }

    private function badge(string $label, bool $positive): string
    {
        $class = $positive ? 'border-emerald-300/15 bg-emerald-300/10 text-emerald-100' : 'border-white/10 bg-white/5 text-white/45';

        return '<span class="inline-flex rounded-full border px-2.5 py-1 font-mono text-[8px] uppercase tracking-wider '.$class.'">'.e($label).'</span>';
    }
}
