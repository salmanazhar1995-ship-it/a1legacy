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
    <main class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
        <a href="<?php echo e(route('admin.messages.index')); ?>" class="text-sm text-white/35 transition hover:text-white">← Consultation inbox</a>

        <?php if(session('success')): ?>
            <div class="mt-6 rounded-xl border border-emerald-300/20 bg-emerald-300/10 p-4 text-sm text-emerald-100"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <div class="mt-6 grid gap-5 lg:grid-cols-[minmax(0,1fr)_280px]">
            <article class="space-y-5">
                <section class="neutron-panel rounded-2xl p-6 sm:p-8">
                    <div class="flex flex-col justify-between gap-4 border-b border-white/10 pb-6 sm:flex-row sm:items-start">
                        <div>
                            <p class="neutron-kicker">AI & Automation Consultation</p>
                            <h1 class="mt-2 text-2xl font-medium text-white"><?php echo e($message->name); ?></h1>
                            <div class="mt-2 flex flex-wrap gap-x-4 gap-y-1 text-sm text-white/45">
                                <a class="hover:text-white" href="mailto:<?php echo e($message->email); ?>"><?php echo e($message->email); ?></a>
                                <?php if($message->phone): ?><a class="hover:text-white" href="tel:<?php echo e($message->phone); ?>"><?php echo e($message->phone); ?></a><?php endif; ?>
                            </div>
                        </div>
                        <p class="font-mono text-[10px] uppercase tracking-wider text-white/30"><?php echo e($message->created_at->format('M j, Y · H:i')); ?></p>
                    </div>

                    <div class="mt-6 grid gap-4 sm:grid-cols-2 xl:grid-cols-3">
                        <?php $__currentLoopData = [
                            ['Company', $message->company],
                            ['Website', $message->website_url],
                            ['Role', $message->displayRole()],
                            ['Decision maker', $message->decision_maker],
                            ['Country', $message->displayCountry()],
                            ['Industry', $message->displayIndustry()],
                        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $value]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($value): ?>
                                <div class="rounded-xl border border-white/10 bg-white/[0.025] p-4">
                                    <p class="font-mono text-[9px] uppercase tracking-[.16em] text-neutron-300/70"><?php echo e($label); ?></p>
                                    <?php if($label === 'Website'): ?>
                                        <a href="<?php echo e($value); ?>" target="_blank" rel="noopener" class="mt-2 block break-all text-sm text-white/65 transition hover:text-neutron-200"><?php echo e($value); ?></a>
                                    <?php else: ?>
                                        <p class="mt-2 text-sm text-white/65"><?php echo e($value); ?></p>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </section>

                <section class="neutron-panel rounded-2xl p-6 sm:p-8">
                    <div class="mb-5">
                        <p class="neutron-kicker">Business profile</p>
                        <h2 class="mt-2 text-xl font-medium text-white">Current setup</h2>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                        <?php $__currentLoopData = [
                            ['Company size', $message->company_size],
                            ['Annual turnover', $message->annual_turnover],
                            ['Monthly leads', $message->monthly_leads],
                            ['Current CRM / platform', $message->displayCrm()],
                        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $value]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="rounded-xl border border-white/10 bg-white/[0.025] p-4">
                                <p class="font-mono text-[9px] uppercase tracking-[.16em] text-white/30"><?php echo e($label); ?></p>
                                <p class="mt-2 text-sm text-white/65"><?php echo e($value ?: 'Not provided'); ?></p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </section>

                <section class="neutron-panel rounded-2xl p-6 sm:p-8">
                    <p class="neutron-kicker">Requirements</p>
                    <div class="mt-5 grid gap-4 md:grid-cols-2">
                        <div class="rounded-xl border border-neutron-300/10 bg-neutron-500/[0.04] p-5">
                            <p class="font-mono text-[9px] uppercase tracking-[.16em] text-neutron-200">What they need help with</p>
                            <p class="mt-3 text-sm leading-6 text-white/70"><?php echo e($message->displayServiceInterest() ?: 'Not provided'); ?></p>
                        </div>
                        <div class="rounded-xl border border-neutron-300/10 bg-neutron-500/[0.04] p-5">
                            <p class="font-mono text-[9px] uppercase tracking-[.16em] text-neutron-200">Main business challenge</p>
                            <p class="mt-3 text-sm leading-6 text-white/70"><?php echo e($message->displayBusinessChallenge() ?: 'Not provided'); ?></p>
                        </div>
                    </div>

                    <?php if($message->message): ?>
                        <div class="mt-4 rounded-xl border border-white/10 bg-white/[0.025] p-5">
                            <p class="font-mono text-[9px] uppercase tracking-[.16em] text-white/30">What they want to automate</p>
                            <div class="mt-3 whitespace-pre-line text-sm leading-7 text-white/65"><?php echo e($message->message); ?></div>
                        </div>
                    <?php endif; ?>
                </section>

                <section class="neutron-panel rounded-2xl p-6 sm:p-8">
                    <p class="neutron-kicker">Contact preferences</p>
                    <div class="mt-5 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
                        <?php $__currentLoopData = [
                            ['Method', $message->preferred_contact_method],
                            ['Time zone', $message->displayTimeZone()],
                            ['Project timeline', $message->project_timeline],
                            ['Consent', $message->contact_consent ? 'Yes' : 'No'],
                        ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as [$label, $value]): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="rounded-xl border border-white/10 bg-white/[0.025] p-4">
                                <p class="font-mono text-[9px] uppercase tracking-[.16em] text-white/30"><?php echo e($label); ?></p>
                                <p class="mt-2 text-sm text-white/65"><?php echo e($value ?: 'Not provided'); ?></p>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </section>
            </article>

            <aside class="flex flex-col gap-4">
                <form method="POST" action="<?php echo e(route('admin.messages.update',$message)); ?>" class="neutron-panel rounded-2xl p-5">
                    <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>
                    <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['for' => 'status','value' => 'Request status']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => 'status','value' => 'Request status']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $attributes = $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
<?php if (isset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581)): ?>
<?php $component = $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581; ?>
<?php unset($__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581); ?>
<?php endif; ?>
                    <select id="status" name="status" class="mt-2 block w-full rounded-lg border-white/10 bg-neutron-900 text-white">
                        <?php $__currentLoopData = ['new','in_progress','resolved','spam']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($option); ?>" <?php if($message->status===$option): echo 'selected'; endif; ?>><?php echo e(str($option)->replace('_',' ')->title()); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => ['class' => 'mt-4']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-4']); ?>Update status <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $attributes = $__attributesOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__attributesOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $component = $__componentOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__componentOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
                </form>

                <div class="neutron-panel rounded-2xl p-5 text-sm leading-6 text-white/45">
                    <p class="font-medium text-white/70">Quick contact</p>
                    <div class="mt-3 flex flex-col gap-2">
                        <a href="mailto:<?php echo e($message->email); ?>" class="transition hover:text-white">Email client →</a>
                        <?php if($message->phone): ?><a href="tel:<?php echo e($message->phone); ?>" class="transition hover:text-white">Call client →</a><?php endif; ?>
                    </div>
                </div>

                <form method="POST" action="<?php echo e(route('admin.messages.destroy',$message)); ?>" onsubmit="return confirm('Delete this consultation request permanently?')">
                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                    <?php if (isset($component)) { $__componentOriginal656e8c5ea4d9a4fa173298297bfe3f11 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal656e8c5ea4d9a4fa173298297bfe3f11 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.danger-button','data' => ['class' => 'w-full justify-center']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('danger-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'w-full justify-center']); ?>Delete request <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal656e8c5ea4d9a4fa173298297bfe3f11)): ?>
<?php $attributes = $__attributesOriginal656e8c5ea4d9a4fa173298297bfe3f11; ?>
<?php unset($__attributesOriginal656e8c5ea4d9a4fa173298297bfe3f11); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal656e8c5ea4d9a4fa173298297bfe3f11)): ?>
<?php $component = $__componentOriginal656e8c5ea4d9a4fa173298297bfe3f11; ?>
<?php unset($__componentOriginal656e8c5ea4d9a4fa173298297bfe3f11); ?>
<?php endif; ?>
                </form>
            </aside>
        </div>
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
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\admin\messages\show.blade.php ENDPATH**/ ?>