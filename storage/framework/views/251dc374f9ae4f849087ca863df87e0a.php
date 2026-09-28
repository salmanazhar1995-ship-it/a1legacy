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
    <main class="mx-auto max-w-5xl px-4 py-10 sm:px-6 lg:px-8">
        <p class="neutron-kicker">Global content</p>
        <h1 class="mt-3 text-3xl font-medium tracking-tight">Site settings</h1>
        <p class="mt-2 text-sm text-white/40">Manage brand, contact, footer, social, email delivery, and site images used across the website.</p>
        <div class="mt-4 flex flex-wrap gap-3">
        <a href="#voice-agent-settings" class="inline-flex items-center gap-2 rounded-lg border border-neutron-300/20 bg-neutron-500/10 px-4 py-2 font-mono text-[10px] font-semibold uppercase tracking-wider text-neutron-300 transition hover:border-neutron-300/40 hover:text-white">
            Voice agent keys <span aria-hidden="true">↓</span>
        </a>
        <a href="#smtp-settings" class="inline-flex items-center gap-2 rounded-lg border border-neutron-300/20 bg-neutron-500/10 px-4 py-2 font-mono text-[10px] font-semibold uppercase tracking-wider text-neutron-300 transition hover:border-neutron-300/40 hover:text-white">
            SMTP settings <span aria-hidden="true">&darr;</span>
        </a>
        </div>

        <?php if(session('success')): ?>
            <div class="mt-6 rounded-xl border border-emerald-300/20 bg-emerald-300/10 p-4 text-sm text-emerald-200"><?php echo e(session('success')); ?></div>
        <?php endif; ?>

        <form method="POST" enctype="multipart/form-data" action="<?php echo e(route('admin.settings.update')); ?>" class="mt-8 flex flex-col gap-5">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            <?php $__currentLoopData = $settingGroups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group=>$settings): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <section id="<?php echo e(str($group)->slug()); ?>-settings" class="neutron-panel scroll-mt-6 rounded-2xl p-6">
                    <p class="neutron-kicker"><?php echo e(str($group)->title()); ?></p>
                    <?php if($group === 'voice agent'): ?>
                        <p class="mt-2 text-sm text-white/40">Update the Retell public key and voice agent ID used by the website voice widget.</p>
                    <?php elseif($group === 'smtp'): ?>
                        <p class="mt-2 text-sm text-white/40">Configure the SMTP server and sender identity used for website email. Leave the password blank to keep the saved password.</p>
                    <?php endif; ?>
                    <div class="mt-6 grid gap-5 sm:grid-cols-2">
                        <?php $__currentLoopData = $settings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $setting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php ($isImageSetting = $setting->type === 'image' || $setting->group === 'media'); ?>
                            <div class="<?php echo \Illuminate\Support\Arr::toCssClasses(['sm:col-span-2'=>$setting->type==='textarea' || $isImageSetting]); ?>">
                                <?php if (isset($component)) { $__componentOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginale3da9d84bb64e4bc2eeebaafabfb2581 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-label','data' => ['for' => 'setting_'.$setting->id,'value' => $setting->label]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-label'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['for' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('setting_'.$setting->id),'value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($setting->label)]); ?>
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

                                <?php if($isImageSetting): ?>
                                    <?php if($setting->value): ?>
                                        <div class="mt-3 flex min-h-28 items-center justify-center overflow-hidden rounded-xl border border-white/10 bg-black/20 p-4">
                                            <img src="<?php echo e($setting->value); ?>" alt="<?php echo e($setting->label); ?>" class="max-h-72 w-auto max-w-full object-contain">
                                        </div>
                                    <?php endif; ?>
                                    <input id="setting_<?php echo e($setting->id); ?>" name="setting_files[<?php echo e($setting->key); ?>]" type="file" accept="image/jpeg,image/png,image/webp,image/avif" class="mt-3 block w-full rounded-lg border border-white/10 bg-white/[0.04] p-3 text-sm text-white/70 file:mr-4 file:rounded-md file:border-0 file:bg-neutron-300 file:px-4 file:py-2 file:font-medium file:text-neutron-950">
                                    <p class="mt-2 text-xs text-white/35">JPG, PNG, WebP or AVIF. Maximum 5 MB.</p>
                                    <?php if($setting->key === 'favicon'): ?>
                                        <p class="mt-1 text-xs text-white/35">A square PNG or WebP of at least 32 × 32 pixels is recommended.</p>
                                    <?php elseif(in_array($setting->key, ['header_logo', 'footer_logo'], true)): ?>
                                        <p class="mt-1 text-xs text-white/35">A transparent, wide logo works best.</p>
                                    <?php endif; ?>
                                    <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['class' => 'mt-2','messages' => $errors->get('setting_files.'.$setting->key)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-2','messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('setting_files.'.$setting->key))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                                    <?php if($setting->value): ?>
                                        <label class="mt-3 flex items-center gap-3 text-sm text-red-200/80">
                                            <input type="checkbox" name="remove_setting_images[<?php echo e($setting->key); ?>]" value="1" class="rounded border-white/15 bg-white/5 text-red-400">
                                            Remove current image
                                        </label>
                                    <?php endif; ?>
                                <?php elseif($setting->type==='textarea'): ?>
                                    <textarea id="setting_<?php echo e($setting->id); ?>" name="settings[<?php echo e($setting->key); ?>]" rows="4" class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-white focus:border-neutron-500 focus:ring-neutron-500"><?php echo e(old('settings.'.$setting->key,$setting->value)); ?></textarea>
                                <?php elseif($setting->type === 'boolean'): ?>
                                    <select id="setting_<?php echo e($setting->id); ?>" name="settings[<?php echo e($setting->key); ?>]" class="mt-2 block w-full rounded-lg border-white/10 bg-neutron-950 text-white focus:border-neutron-500 focus:ring-neutron-500">
                                        <option value="0" <?php if((string) old('settings.'.$setting->key, $setting->value) === '0'): echo 'selected'; endif; ?>>Disabled</option>
                                        <option value="1" <?php if((string) old('settings.'.$setting->key, $setting->value) === '1'): echo 'selected'; endif; ?>>Enabled</option>
                                    </select>
                                <?php elseif($setting->key === 'smtp_encryption'): ?>
                                    <select id="setting_<?php echo e($setting->id); ?>" name="settings[<?php echo e($setting->key); ?>]" class="mt-2 block w-full rounded-lg border-white/10 bg-neutron-950 text-white focus:border-neutron-500 focus:ring-neutron-500">
                                        <option value="tls" <?php if(old('settings.'.$setting->key, $setting->value) === 'tls'): echo 'selected'; endif; ?>>TLS / STARTTLS</option>
                                        <option value="ssl" <?php if(old('settings.'.$setting->key, $setting->value) === 'ssl'): echo 'selected'; endif; ?>>SSL</option>
                                        <option value="none" <?php if(old('settings.'.$setting->key, $setting->value) === 'none'): echo 'selected'; endif; ?>>No encryption</option>
                                    </select>
                                <?php elseif($setting->type === 'password'): ?>
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'setting_'.$setting->id,'type' => 'password','name' => 'settings['.e($setting->key).']','class' => 'mt-2 block w-full','autocomplete' => 'new-password','placeholder' => 'Leave blank to keep the saved password']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('setting_'.$setting->id),'type' => 'password','name' => 'settings['.e($setting->key).']','class' => 'mt-2 block w-full','autocomplete' => 'new-password','placeholder' => 'Leave blank to keep the saved password']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
                                    <?php if($setting->value): ?>
                                        <p class="mt-2 text-xs text-emerald-200/70">A password is saved securely.</p>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php if (isset($component)) { $__componentOriginal18c21970322f9e5c938bc954620c12bb = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal18c21970322f9e5c938bc954620c12bb = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.text-input','data' => ['id' => 'setting_'.$setting->id,'type' => in_array($setting->type,['email','url','number'],true)?$setting->type:'text','name' => 'settings['.e($setting->key).']','class' => 'mt-2 block w-full','value' => old('settings.'.$setting->key,$setting->value)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('text-input'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute('setting_'.$setting->id),'type' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(in_array($setting->type,['email','url','number'],true)?$setting->type:'text'),'name' => 'settings['.e($setting->key).']','class' => 'mt-2 block w-full','value' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(old('settings.'.$setting->key,$setting->value))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $attributes = $__attributesOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__attributesOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal18c21970322f9e5c938bc954620c12bb)): ?>
<?php $component = $__componentOriginal18c21970322f9e5c938bc954620c12bb; ?>
<?php unset($__componentOriginal18c21970322f9e5c938bc954620c12bb); ?>
<?php endif; ?>
                                <?php endif; ?>
                                <?php if (isset($component)) { $__componentOriginalf94ed9c5393ef72725d159fe01139746 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf94ed9c5393ef72725d159fe01139746 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.input-error','data' => ['class' => 'mt-2','messages' => $errors->get('settings.'.$setting->key)]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('input-error'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'mt-2','messages' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($errors->get('settings.'.$setting->key))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $attributes = $__attributesOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__attributesOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf94ed9c5393ef72725d159fe01139746)): ?>
<?php $component = $__componentOriginalf94ed9c5393ef72725d159fe01139746; ?>
<?php unset($__componentOriginalf94ed9c5393ef72725d159fe01139746); ?>
<?php endif; ?>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </section>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <div><?php if (isset($component)) { $__componentOriginald411d1792bd6cc877d687758b753742c = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald411d1792bd6cc877d687758b753742c = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.primary-button','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('primary-button'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>Save all settings <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $attributes = $__attributesOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__attributesOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald411d1792bd6cc877d687758b753742c)): ?>
<?php $component = $__componentOriginald411d1792bd6cc877d687758b753742c; ?>
<?php unset($__componentOriginald411d1792bd6cc877d687758b753742c); ?>
<?php endif; ?></div>
        </form>
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
<?php /**PATH E:\httracks\a1legacy\a1 complete\A1Legacy-Navigation-Industries-Headings-Responsive-Final\resources\views\admin\settings\index.blade.php ENDPATH**/ ?>