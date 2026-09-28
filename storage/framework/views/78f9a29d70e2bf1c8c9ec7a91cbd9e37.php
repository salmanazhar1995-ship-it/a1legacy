<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <main class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8 lg:py-12">
        <section class="flex flex-col justify-between gap-6 lg:flex-row lg:items-end">
            <div>
                <p class="neutron-kicker">Command center / live</p>
                <h1 class="mt-4 max-w-3xl text-3xl font-medium tracking-[-0.04em] text-white sm:text-5xl">Good <?php echo e(now()->hour < 12 ? 'morning' : (now()->hour < 18 ? 'afternoon' : 'evening')); ?>, <?php echo e(str(auth()->user()->name)->before(' ')); ?>.</h1>
                <p class="mt-4 max-w-2xl text-sm leading-6 text-white/45 sm:text-base">Monitor your workspace, customer activity, and autonomous workflows from one control surface.</p>
            </div>

            <div class="flex items-center gap-2 self-start rounded-xl border border-emerald-300/15 bg-emerald-300/[0.06] px-4 py-3 font-mono text-[11px] uppercase tracking-[0.14em] text-emerald-200">
                <span class="h-2 w-2 rounded-full bg-emerald-300 shadow-[0_0_12px_rgba(110,231,183,0.85)]"></span>
                All systems operational
            </div>
        </section>

        <section class="mt-10 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
            <article class="neutron-panel rounded-2xl p-5">
                <div class="flex items-center justify-between gap-4">
                    <p class="font-mono text-[10px] uppercase tracking-[0.14em] text-white/35">Total users</p>
                    <span class="rounded-md bg-neutron-500/10 px-2 py-1 font-mono text-[10px] text-neutron-300">+<?php echo e($newUsersThisWeek); ?> this week</span>
                </div>
                <p class="mt-8 text-4xl font-medium tracking-[-0.05em] text-white"><?php echo e(number_format($totalUsers)); ?></p>
                <div class="mt-5 h-1 overflow-hidden rounded-full bg-white/5">
                    <div class="h-full w-3/4 rounded-full bg-neutron-500 shadow-glow"></div>
                </div>
            </article>

            <article class="neutron-panel rounded-2xl p-5">
                <div class="flex items-center justify-between gap-4">
                    <p class="font-mono text-[10px] uppercase tracking-[0.14em] text-white/35">Published pages</p>
                    <span class="font-mono text-[10px] text-emerald-300">Live</span>
                </div>
                <p class="mt-8 text-4xl font-medium tracking-[-0.05em] text-white"><?php echo e($publishedPages); ?></p>
                <div class="mt-5 h-1 overflow-hidden rounded-full bg-white/5">
                    <div class="h-full w-full rounded-full bg-emerald-300"></div>
                </div>
            </article>

            <article class="neutron-panel rounded-2xl p-5">
                <div class="flex items-center justify-between gap-4">
                    <p class="font-mono text-[10px] uppercase tracking-[0.14em] text-white/35">Content sections</p>
                    <span class="font-mono text-[10px] text-neutron-300">Editable</span>
                </div>
                <p class="mt-8 text-4xl font-medium tracking-[-0.05em] text-white"><?php echo e($contentSections); ?></p>
                <div class="mt-5 flex h-5 items-end gap-1">
                    <?php $__currentLoopData = [30, 55, 42, 74, 52, 68, 88, 65, 92, 78, 100, 86]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $height): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <span class="flex-1 rounded-t-sm bg-neutron-500/50" style="height: <?php echo e($height); ?>%"></span>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </article>

            <article class="neutron-panel rounded-2xl p-5">
                <div class="flex items-center justify-between gap-4">
                    <p class="font-mono text-[10px] uppercase tracking-[0.14em] text-white/35">New inquiries</p>
                    <span class="rounded-md bg-amber-300/10 px-2 py-1 font-mono text-[10px] text-amber-200">Inbox</span>
                </div>
                <p class="mt-8 text-4xl font-medium tracking-[-0.05em] text-white"><?php echo e($newMessages); ?><span class="ml-2 text-sm font-normal tracking-normal text-white/35">unread</span></p>
                <p class="mt-5 text-xs text-white/35">Messages submitted through the website contact form.</p>
            </article>
        </section>

        <section class="mt-4 grid grid-cols-1 gap-4 xl:grid-cols-[1.55fr_1fr]">
            <article class="neutron-panel overflow-hidden rounded-2xl">
                <div class="flex flex-col justify-between gap-4 border-b border-white/10 p-5 sm:flex-row sm:items-center">
                    <div>
                        <p class="neutron-kicker">Execution volume</p>
                        <h2 class="mt-2 text-lg font-medium text-white">Automated operations</h2>
                    </div>
                    <div class="flex gap-1 rounded-lg border border-white/10 bg-white/[0.025] p-1 font-mono text-[10px] uppercase tracking-wider text-white/35">
                        <span class="rounded-md bg-white/10 px-3 py-2 text-white">7D</span>
                        <span class="px-3 py-2">30D</span>
                        <span class="px-3 py-2">90D</span>
                    </div>
                </div>

                <div class="relative h-72 p-5 sm:h-80 sm:p-7">
                    <div class="absolute inset-x-7 inset-y-8 flex flex-col justify-between" aria-hidden="true">
                        <?php $__currentLoopData = range(1, 5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <span class="border-t border-dashed border-white/[0.07]"></span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <svg viewBox="0 0 700 250" class="relative h-full w-full overflow-visible" role="img" aria-label="Execution volume trend rising over seven days">
                        <defs>
                            <linearGradient id="area" x1="0" y1="0" x2="0" y2="1">
                                <stop offset="0" stop-color="#2f8fff" stop-opacity=".3" />
                                <stop offset="1" stop-color="#2f8fff" stop-opacity="0" />
                            </linearGradient>
                            <filter id="glow">
                                <feGaussianBlur stdDeviation="5" result="blur" />
                                <feMerge><feMergeNode in="blur" /><feMergeNode in="SourceGraphic" /></feMerge>
                            </filter>
                        </defs>
                        <path d="M0 210 C70 200 105 155 165 170 S260 115 320 130 S415 70 475 95 S590 35 700 48 V250 H0Z" fill="url(#area)" />
                        <path d="M0 210 C70 200 105 155 165 170 S260 115 320 130 S415 70 475 95 S590 35 700 48" fill="none" stroke="#9ecbff" stroke-width="3" stroke-linecap="round" filter="url(#glow)" />
                    </svg>
                </div>
            </article>

            <article class="neutron-panel overflow-hidden rounded-2xl">
                <div class="border-b border-white/10 p-5">
                    <p class="neutron-kicker">Customer activity</p>
                    <h2 class="mt-2 text-lg font-medium text-white">Recent users</h2>
                </div>

                <div class="divide-y divide-white/[0.07]">
                    <?php $__empty_1 = true; $__currentLoopData = $recentUsers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="flex items-center gap-3 p-4 sm:px-5">
                            <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl border border-white/10 bg-white/[0.04] font-mono text-xs font-semibold uppercase text-neutron-300">
                                <?php echo e(str($user->name)->substr(0, 2)); ?>

                            </div>
                            <div class="min-w-0 flex-1">
                                <p class="truncate text-sm font-medium text-white"><?php echo e($user->name); ?></p>
                                <p class="truncate text-xs text-white/35"><?php echo e($user->email); ?></p>
                            </div>
                            <span class="font-mono text-[10px] uppercase text-white/25"><?php echo e($user->created_at->diffForHumans(short: true)); ?></span>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="p-8 text-center">
                            <p class="text-sm text-white/40">No users have joined yet.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </article>
        </section>
    </main>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /home/u668568382/domains/a1legacylabs.com/laravel_app/resources/views/admin/dashboard.blade.php ENDPATH**/ ?>