<div x-show="sidebarOpen" x-cloak x-transition.opacity class="fixed inset-0 z-40 bg-black/70 backdrop-blur-sm lg:hidden" @click="sidebarOpen = false" aria-hidden="true"></div>

<aside
    :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
    class="fixed inset-y-0 left-0 z-50 flex w-72 flex-col border-r border-white/10 bg-neutron-950/95 shadow-2xl shadow-black/30 backdrop-blur-xl transition-transform duration-300 lg:translate-x-0"
    aria-label="Admin sidebar"
>
    <div class="flex h-20 items-center justify-between border-b border-white/10 px-5">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-3">
            <?php if($settings->get('header_logo')): ?>
                <img src="<?php echo e($settings->get('header_logo')); ?>" alt="<?php echo e($settings->get('site_name', config('app.name', 'A1 Legacy Labs'))); ?>" class="max-h-10 w-auto max-w-32 shrink-0 object-contain">
            <?php else: ?>
                <?php if (isset($component)) { $__componentOriginal8892e718f3d0d7a916180885c6f012e7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8892e718f3d0d7a916180885c6f012e7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.application-logo','data' => ['class' => 'h-10 w-10 shrink-0']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('application-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'h-10 w-10 shrink-0']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $attributes = $__attributesOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__attributesOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8892e718f3d0d7a916180885c6f012e7)): ?>
<?php $component = $__componentOriginal8892e718f3d0d7a916180885c6f012e7; ?>
<?php unset($__componentOriginal8892e718f3d0d7a916180885c6f012e7); ?>
<?php endif; ?>
            <?php endif; ?>
            <div>
                <p class="max-w-28 truncate font-mono text-sm font-semibold uppercase tracking-[0.16em] text-white"><?php echo e($settings->get('site_name', config('app.name', 'A1 Legacy Labs'))); ?></p>
                <p class="mt-0.5 font-mono text-[9px] uppercase tracking-[0.2em] text-neutron-300">Admin panel</p>
            </div>
        </a>

        <button type="button" @click="sidebarOpen = false" class="rounded-lg p-2 text-white/45 transition hover:bg-white/5 hover:text-white lg:hidden" aria-label="Close admin sidebar">
            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true">
                <path stroke-linecap="round" d="m6 6 12 12M18 6 6 18" />
            </svg>
        </button>
    </div>

    <div class="flex-1 overflow-y-auto px-4 py-6">
        <p class="px-3 font-mono text-[9px] font-medium uppercase tracking-[0.2em] text-white/25">Workspace</p>

        <nav class="mt-3 space-y-1" aria-label="Admin navigation">
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'group flex items-center gap-3 rounded-xl px-3 py-3 text-sm transition',
                'bg-neutron-500/15 text-white shadow-[inset_0_0_0_1px_rgba(158,203,255,0.12)]' => request()->routeIs('admin.dashboard'),
                'text-white/50 hover:bg-white/[0.05] hover:text-white' => ! request()->routeIs('admin.dashboard'),
            ]); ?>">
                <svg class="h-5 w-5 shrink-0 text-neutron-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 4h6v6H4V4Zm10 0h6v6h-6V4ZM4 14h6v6H4v-6Zm10 0h6v6h-6v-6Z" />
                </svg>
                <span>Overview</span>
            </a>

            <a href="<?php echo e(route('admin.pages.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'group flex items-center gap-3 rounded-xl px-3 py-3 text-sm transition',
                'bg-neutron-500/15 text-white shadow-[inset_0_0_0_1px_rgba(158,203,255,0.12)]' => request()->routeIs('admin.pages.*', 'admin.sections.*', 'admin.items.*'),
                'text-white/50 hover:bg-white/[0.05] hover:text-white' => ! request()->routeIs('admin.pages.*', 'admin.sections.*', 'admin.items.*'),
            ]); ?>">
                <svg class="h-5 w-5 shrink-0 text-neutron-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 3h9l4 4v14H6V3Zm9 0v5h4M9 12h7M9 16h7" />
                </svg>
                <span>Pages &amp; content</span>
            </a>

            <a href="<?php echo e(route('admin.products.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'group flex items-center gap-3 rounded-xl px-3 py-3 text-sm transition',
                'bg-neutron-500/15 text-white shadow-[inset_0_0_0_1px_rgba(158,203,255,0.12)]' => request()->routeIs('admin.products.*'),
                'text-white/50 hover:bg-white/[0.05] hover:text-white' => ! request()->routeIs('admin.products.*'),
            ]); ?>">
                <svg class="h-5 w-5 shrink-0 text-neutron-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 7.5 12 3l8 4.5v9L12 21l-8-4.5v-9Zm0 0 8 4.5m8-4.5L12 12m0 9v-9" />
                </svg>
                <span>Core Products</span>
            </a>

            <a href="<?php echo e(route('admin.platforms.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'group flex items-center gap-3 rounded-xl px-3 py-3 text-sm transition',
                'bg-neutron-500/15 text-white shadow-[inset_0_0_0_1px_rgba(158,203,255,0.12)]' => request()->routeIs('admin.platforms.*'),
                'text-white/50 hover:bg-white/[0.05] hover:text-white' => ! request()->routeIs('admin.platforms.*'),
            ]); ?>">
                <svg class="h-5 w-5 shrink-0 text-neutron-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h3v12H4V6Zm6 4h3v8h-3v-8Zm6-5h3v13h-3V5Z" />
                </svg>
                <span>Platform Strip</span>
            </a>

            <div x-data="{ open: <?php echo e(request()->routeIs('admin.industries.*', 'admin.business-use-cases.*') ? 'true' : 'false'); ?> }">
                <button type="button" @click="open = !open" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                    'group flex w-full items-center gap-3 rounded-xl px-3 py-3 text-sm transition',
                    'bg-neutron-500/15 text-white shadow-[inset_0_0_0_1px_rgba(158,203,255,0.12)]' => request()->routeIs('admin.industries.*', 'admin.business-use-cases.*'),
                    'text-white/50 hover:bg-white/[0.05] hover:text-white' => ! request()->routeIs('admin.industries.*', 'admin.business-use-cases.*'),
                ]); ?>" aria-controls="admin-industry-menu" :aria-expanded="open.toString()">
                    <svg class="h-5 w-5 shrink-0 text-neutron-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 19V8l8-4 8 4v11M8 19v-5h8v5M8 10h.01M12 10h.01M16 10h.01" /></svg>
                    <span class="flex-1 text-left">Industries</span>
                    <svg class="h-4 w-4 transition" :class="open ? 'rotate-180' : ''" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.7" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="m5 7.5 5 5 5-5" /></svg>
                </button>
                <div id="admin-industry-menu" x-show="open" class="mt-1 space-y-1 pl-8">
                    <a href="<?php echo e(route('admin.industries.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['block rounded-lg px-3 py-2 text-xs transition', 'bg-white/[0.06] text-white' => request()->routeIs('admin.industries.*'), 'text-white/40 hover:bg-white/[0.04] hover:text-white' => ! request()->routeIs('admin.industries.*')]); ?>">Main Industry</a>
                    <a href="<?php echo e(route('admin.business-use-cases.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses(['block rounded-lg px-3 py-2 text-xs transition', 'bg-white/[0.06] text-white' => request()->routeIs('admin.business-use-cases.*'), 'text-white/40 hover:bg-white/[0.04] hover:text-white' => ! request()->routeIs('admin.business-use-cases.*')]); ?>">Sub Industry</a>
                </div>
            </div>

            <a href="<?php echo e(route('admin.portfolio.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'group flex items-center gap-3 rounded-xl px-3 py-3 text-sm transition',
                'bg-neutron-500/15 text-white shadow-[inset_0_0_0_1px_rgba(158,203,255,0.12)]' => request()->routeIs('admin.portfolio.*'),
                'text-white/50 hover:bg-white/[0.05] hover:text-white' => ! request()->routeIs('admin.portfolio.*'),
            ]); ?>">
                <svg class="h-5 w-5 shrink-0 text-neutron-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16v12H4V6Zm4-3h8l2 3H6l2-3Zm1 8h6m-6 4h4" />
                </svg>
                <span>Portfolio</span>
            </a>

            <a href="<?php echo e(route('admin.gallery.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'group flex items-center gap-3 rounded-xl px-3 py-3 text-sm transition',
                'bg-neutron-500/15 text-white shadow-[inset_0_0_0_1px_rgba(158,203,255,0.12)]' => request()->routeIs('admin.gallery.*'),
                'text-white/50 hover:bg-white/[0.05] hover:text-white' => ! request()->routeIs('admin.gallery.*'),
            ]); ?>"><svg class="h-5 w-5 shrink-0 text-neutron-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 5h16v14H4zM7 15l3-3 3 3 2-2 2 2M8 9h.01"/></svg><span>Gallery</span></a>

            <a href="<?php echo e(route('admin.client-stories.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'group flex items-center gap-3 rounded-xl px-3 py-3 text-sm transition',
                'bg-neutron-500/15 text-white shadow-[inset_0_0_0_1px_rgba(158,203,255,0.12)]' => request()->routeIs('admin.client-stories.*'),
                'text-white/50 hover:bg-white/[0.05] hover:text-white' => ! request()->routeIs('admin.client-stories.*'),
            ]); ?>"><svg class="h-5 w-5 shrink-0 text-neutron-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"><path d="M4 6h16v12H4zM10 9l5 3-5 3V9z"/></svg><span>Client Stories</span></a>

            <a href="<?php echo e(route('admin.blog.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'group flex items-center gap-3 rounded-xl px-3 py-3 text-sm transition',
                'bg-neutron-500/15 text-white shadow-[inset_0_0_0_1px_rgba(158,203,255,0.12)]' => request()->routeIs('admin.blog.*'),
                'text-white/50 hover:bg-white/[0.05] hover:text-white' => ! request()->routeIs('admin.blog.*'),
            ]); ?>">
                <svg class="h-5 w-5 shrink-0 text-neutron-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 4h14v16H5V4Zm3 4h8M8 12h8M8 16h5" />
                </svg>
                <span>Blog</span>
            </a>

            <a href="<?php echo e(route('admin.messages.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'group flex items-center gap-3 rounded-xl px-3 py-3 text-sm transition',
                'bg-neutron-500/15 text-white shadow-[inset_0_0_0_1px_rgba(158,203,255,0.12)]' => request()->routeIs('admin.messages.*'),
                'text-white/50 hover:bg-white/[0.05] hover:text-white' => ! request()->routeIs('admin.messages.*'),
            ]); ?>">
                <svg class="h-5 w-5 shrink-0 text-neutron-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 5h16v12H8l-4 4V5Zm4 4h8m-8 4h5" />
                </svg>
                <span>Inbox</span>
            </a>

            <a href="<?php echo e(route('admin.users.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'group flex items-center gap-3 rounded-xl px-3 py-3 text-sm transition',
                'bg-neutron-500/15 text-white shadow-[inset_0_0_0_1px_rgba(158,203,255,0.12)]' => request()->routeIs('admin.users.*'),
                'text-white/50 hover:bg-white/[0.05] hover:text-white' => ! request()->routeIs('admin.users.*'),
            ]); ?>">
                <svg class="h-5 w-5 shrink-0 text-neutron-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M16 20v-1.5a4.5 4.5 0 0 0-4.5-4.5h-3A4.5 4.5 0 0 0 4 18.5V20m7-10a3.5 3.5 0 1 1-7 0 3.5 3.5 0 0 1 7 0Zm5.5 4a4 4 0 0 1 3.5 4v2m-5-16a3.5 3.5 0 0 1 0 6.5" />
                </svg>
                <span>Users</span>
            </a>

            <a href="<?php echo e(route('admin.settings.index')); ?>" class="<?php echo \Illuminate\Support\Arr::toCssClasses([
                'group flex items-center gap-3 rounded-xl px-3 py-3 text-sm transition',
                'bg-neutron-500/15 text-white shadow-[inset_0_0_0_1px_rgba(158,203,255,0.12)]' => request()->routeIs('admin.settings.*'),
                'text-white/50 hover:bg-white/[0.05] hover:text-white' => ! request()->routeIs('admin.settings.*'),
            ]); ?>">
                <svg class="h-5 w-5 shrink-0 text-neutron-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.5a3.5 3.5 0 1 1 0 7 3.5 3.5 0 0 1 0-7Zm7.3 3.5c0-.5-.1-1-.2-1.5l2-1.5-2-3.4-2.4 1a8 8 0 0 0-2.6-1.5L13.8 2H10l-.4 3.1A8 8 0 0 0 7 6.6l-2.4-1-2 3.4 2 1.5a8 8 0 0 0 0 3l-2 1.5 2 3.4 2.4-1a8 8 0 0 0 2.6 1.5l.4 3.1h3.9l.4-3.1a8 8 0 0 0 2.6-1.5l2.4 1 2-3.4-2-1.5c.1-.5.2-1 .2-1.5Z" />
                </svg>
                <span>Site settings</span>
            </a>
        </nav>

        <div class="my-6 border-t border-white/[0.07]"></div>

        <p class="px-3 font-mono text-[9px] font-medium uppercase tracking-[0.2em] text-white/25">Quick access</p>
        <div class="mt-3 space-y-1">
            <a href="<?php echo e(route('home')); ?>" target="_blank" class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm text-white/50 transition hover:bg-white/[0.05] hover:text-white">
                <svg class="h-5 w-5 shrink-0 text-white/35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14 5h5v5m0-5-8 8M19 13v5a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h5" />
                </svg>
                <span>View website</span>
            </a>
            <a href="<?php echo e(route('profile.edit')); ?>" class="flex items-center gap-3 rounded-xl px-3 py-3 text-sm text-white/50 transition hover:bg-white/[0.05] hover:text-white">
                <svg class="h-5 w-5 shrink-0 text-white/35" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                    <circle cx="12" cy="8" r="4" />
                    <path stroke-linecap="round" d="M5 21a7 7 0 0 1 14 0" />
                </svg>
                <span>My profile</span>
            </a>
        </div>
    </div>

    <div class="border-t border-white/10 p-4">
        <div class="flex items-center gap-3 rounded-xl bg-white/[0.035] p-3">
            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-neutron-300/15 bg-neutron-500/10 font-mono text-xs font-semibold uppercase text-neutron-300">
                <?php echo e(str(auth()->user()->name)->substr(0, 2)); ?>

            </div>
            <div class="min-w-0 flex-1">
                <p class="truncate text-sm font-medium text-white"><?php echo e(auth()->user()->name); ?></p>
                <p class="mt-0.5 font-mono text-[9px] uppercase tracking-wider text-white/30">Administrator</p>
            </div>
            <form method="POST" action="<?php echo e(route('logout')); ?>">
                <?php echo csrf_field(); ?>
                <button type="submit" class="rounded-lg p-2 text-white/35 transition hover:bg-white/[0.06] hover:text-white" aria-label="Log out">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M10 5H5v14h5m4-4 4-3-4-3m4 3H9" />
                    </svg>
                </button>
            </form>
        </div>
    </div>
</aside>
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\layouts\admin-sidebar.blade.php ENDPATH**/ ?>