<x-app-layout>
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

        @if(session('success'))
            <div class="mt-6 rounded-xl border border-emerald-300/20 bg-emerald-300/10 p-4 text-sm text-emerald-200">{{ session('success') }}</div>
        @endif

        <form method="POST" enctype="multipart/form-data" action="{{ route('admin.settings.update') }}" class="mt-8 flex flex-col gap-5">
            @csrf
            @method('PUT')

            @foreach($settingGroups as $group=>$settings)
                <section id="{{ str($group)->slug() }}-settings" class="neutron-panel scroll-mt-6 rounded-2xl p-6">
                    <p class="neutron-kicker">{{ str($group)->title() }}</p>
                    @if($group === 'voice agent')
                        <p class="mt-2 text-sm text-white/40">Update the Retell public key and voice agent ID used by the website voice widget.</p>
                    @elseif($group === 'smtp')
                        <p class="mt-2 text-sm text-white/40">Configure the SMTP server and sender identity used for website email. Leave the password blank to keep the saved password.</p>
                    @endif
                    <div class="mt-6 grid gap-5 sm:grid-cols-2">
                        @foreach($settings as $setting)
                            @php($isImageSetting = $setting->type === 'image' || $setting->group === 'media')
                            <div @class(['sm:col-span-2'=>$setting->type==='textarea' || $isImageSetting])>
                                @unless($isImageSetting)
                                    <x-input-label :for="'setting_'.$setting->id" :value="$setting->label"/>
                                @endunless

                                @if($isImageSetting)
                                    @include('admin.partials.image-animation-fields', [
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
                                    ])
                                @elseif($setting->type==='textarea')
                                    <textarea id="setting_{{ $setting->id }}" name="settings[{{ $setting->key }}]" rows="4" class="mt-2 block w-full rounded-lg border-white/10 bg-white/[0.04] text-white focus:border-neutron-500 focus:ring-neutron-500">{{ old('settings.'.$setting->key,$setting->value) }}</textarea>
                                @elseif($setting->type === 'boolean')
                                    <select id="setting_{{ $setting->id }}" name="settings[{{ $setting->key }}]" class="mt-2 block w-full rounded-lg border-white/10 bg-neutron-950 text-white focus:border-neutron-500 focus:ring-neutron-500">
                                        <option value="0" @selected((string) old('settings.'.$setting->key, $setting->value) === '0')>Disabled</option>
                                        <option value="1" @selected((string) old('settings.'.$setting->key, $setting->value) === '1')>Enabled</option>
                                    </select>
                                @elseif($setting->key === 'smtp_encryption')
                                    <select id="setting_{{ $setting->id }}" name="settings[{{ $setting->key }}]" class="mt-2 block w-full rounded-lg border-white/10 bg-neutron-950 text-white focus:border-neutron-500 focus:ring-neutron-500">
                                        <option value="tls" @selected(old('settings.'.$setting->key, $setting->value) === 'tls')>TLS / STARTTLS</option>
                                        <option value="ssl" @selected(old('settings.'.$setting->key, $setting->value) === 'ssl')>SSL</option>
                                        <option value="none" @selected(old('settings.'.$setting->key, $setting->value) === 'none')>No encryption</option>
                                    </select>
                                @elseif($setting->type === 'password')
                                    <x-text-input :id="'setting_'.$setting->id" type="password" name="settings[{{ $setting->key }}]" class="mt-2 block w-full" autocomplete="new-password" placeholder="Leave blank to keep the saved password" />
                                    @if($setting->value)
                                        <p class="mt-2 text-xs text-emerald-200/70">A password is saved securely.</p>
                                    @endif
                                @else
                                    <x-text-input :id="'setting_'.$setting->id" :type="in_array($setting->type,['email','url','number'],true)?$setting->type:'text'" name="settings[{{ $setting->key }}]" class="mt-2 block w-full" :value="old('settings.'.$setting->key,$setting->value)"/>
                                @endif
                                <x-input-error class="mt-2" :messages="$errors->get('settings.'.$setting->key)"/>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endforeach

            <div><x-primary-button>Save all settings</x-primary-button></div>
        </form>
    </main>
</x-app-layout>
