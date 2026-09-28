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
                                <?php if (! ($isImageSetting)): ?>
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
                                <?php endif; ?>

                                <?php if($isImageSetting): ?>
                                    <?php echo $__env->make('admin.partials.image-animation-fields', [
                                        'title' => $setting->label,
                                        'help' => $setting->key === 'favicon'
                                            ? 'Upload an image or HTML animation. Browsers require an image for the actual favicon link, so keep an image fallback when using HTML animation.'
                                            : 'Choose an image or a self-contained HTML animation for this website visual.',
                                        'mediaTypeName' => 'setting_media_types['.$setting->key.']',
                                        'imageFileName' => 'setting_files['.$setting->key.']',
                                        'imageAltName' => 'setting_image_alts['.$setting->key.']',
                                        'animationFileName' => 'setting_animation_files['.$setting->key.']',
                                        'removeImageName' => 'remove_setting_images['.$setting->key.']',
                                        'removeAnimationName' => 'remove_setting_animations['.$setting->key.']',
                                        'mediaTypeOldKey' => 'setting_media_types.'.$setting->key,
                                        'imageAltOldKey' => 'setting_image_alts.'.$setting->key,
                                        'imageErrorKey' => 'setting_files.'.$setting->key,
                                        'imageAltErrorKey' => 'setting_image_alts.'.$setting->key,
                                        'animationErrorKey' => 'setting_animation_files.'.$setting->key,
                                        'currentMediaType' => $setting->media_type ?: 'image',
                                        'currentImage' => $setting->value,
                                        'currentImageAlt' => $setting->image_alt,
                                        'currentAnimation' => $setting->animation_html_url,
                                    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
<?php /**PATH /home/u668568382/domains/a1legacylabs.com/laravel_app/resources/views/admin/settings/index.blade.php ENDPATH**/ ?>