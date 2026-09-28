@php
    $footerLogoAnimation = $settings->get('footer_logo__animation_html_url');
    $hasFooterLogo = filled($settings->get('footer_logo')) || ($settings->get('footer_logo__media_type') === 'animation' && filled($footerLogoAnimation));
@endphp
<footer class="border-t border-white/10 px-4 py-14 sm:px-6">
    <style>
        .a1-footer-grid{display:grid}.a1-footer-card{min-width:0}.a1-footer-link{min-height:44px}.a1-footer-nav{grid-template-columns:repeat(2,minmax(0,1fr))!important}
        @media(min-width:1024px){.a1-footer-grid{grid-template-columns:minmax(0,1.15fr) minmax(0,1fr) minmax(0,1fr)}}
        @media(max-width:460px){.a1-footer-nav{grid-template-columns:1fr!important}}
    </style>
    <div class="mx-auto max-w-7xl">
        <div class="a1-footer-grid neutron-panel overflow-hidden rounded-2xl border border-white/10 bg-white/[0.025]">
            <section class="a1-footer-card p-6 sm:p-7">
                <div class="flex items-center gap-3">
                    @if ($hasFooterLogo)
                        <span class="block h-10 w-28 overflow-hidden rounded-md">
                            @include('site.partials.setting-visual', [
                                'settingKey' => 'footer_logo',
                                'fallbackAlt' => $settings->get('site_name', 'A1 Legacy Labs').' logo',
                                'imageClass' => 'h-10 w-auto max-w-48 object-contain',
                                'animationClass' => 'pointer-events-none h-10 w-28 border-0',
                            ])
                        </span>
                    @else
                        <x-application-logo class="h-9 w-9" />
                        <span class="font-mono text-sm font-semibold uppercase tracking-[0.16em]">{{ $settings->get('site_name', 'A1 Legacy Labs') }}</span>
                    @endif
                </div>
                <p class="mt-5 max-w-md text-sm leading-7 text-white/45">{{ $settings->get('site_tagline') }}</p>
                @if($settings->get('contact_email'))
                    <a href="mailto:{{ $settings->get('contact_email') }}" class="mt-6 inline-flex items-center rounded-full border border-neutron-300/20 bg-neutron-500/10 px-4 py-2 font-mono text-[10px] uppercase tracking-[.14em] text-neutron-200 transition hover:border-neutron-300/40 hover:bg-neutron-500/15">
                        {{ $settings->get('contact_email') }}
                    </a>
                @endif
            </section>

            <section class="a1-footer-card p-6 sm:p-7">
                <div class="flex items-center gap-4 border-b border-white/[0.08] pb-4">
                    <div>
                        <p class="neutron-kicker">Navigate</p>
                        <h2 class="mt-2 text-base font-medium text-white">Explore A1 Legacy</h2>
                    </div>
                </div>
                <nav class="a1-footer-nav mt-5 grid grid-cols-2 gap-2.5" aria-label="Footer navigation">
                    @foreach ($navigationPages as $navigationPage)
                        <a href="{{ url($navigationPage->slug === 'home' ? '/' : '/'.$navigationPage->slug) }}" class="a1-footer-link group flex items-center justify-between rounded-xl border border-white/[0.07] bg-black/10 px-3.5 py-2.5 text-sm text-white/50 transition hover:-translate-y-0.5 hover:border-neutron-300/25 hover:bg-neutron-500/[0.07] hover:text-white">
                            <span>{{ $navigationPage->navigation_label ?: $navigationPage->title }}</span>
                            <span class="text-white/20 transition group-hover:text-neutron-200">→</span>
                        </a>
                    @endforeach
                </nav>
            </section>

            <section class="a1-footer-card p-6 sm:p-7">
                <div class="border-b border-white/[0.08] pb-4">
                    <p class="neutron-kicker">Legal &amp; social</p>
                    <h2 class="mt-2 text-base font-medium text-white">Policies &amp; channels</h2>
                </div>

                <div class="mt-5 grid gap-2.5">
                    <a href="{{ route('privacy-policy') }}" class="flex items-center justify-between rounded-xl border border-white/[0.07] bg-black/10 px-3.5 py-2.5 text-sm text-white/50 transition hover:border-neutron-300/25 hover:text-white"><span>Privacy policy</span><span class="text-white/20">→</span></a>
                    <a href="{{ route('terms-of-service') }}" class="flex items-center justify-between rounded-xl border border-white/[0.07] bg-black/10 px-3.5 py-2.5 text-sm text-white/50 transition hover:border-neutron-300/25 hover:text-white"><span>Terms of service</span><span class="text-white/20">→</span></a>
                    <a href="{{ route('changelog') }}" class="flex items-center justify-between rounded-xl border border-white/[0.07] bg-black/10 px-3.5 py-2.5 text-sm text-white/50 transition hover:border-neutron-300/25 hover:text-white"><span>Changelog</span><span class="text-white/20">→</span></a>
                </div>

                @php
                    $socialLinks = [
                        ['key' => 'facebook_url', 'label' => 'Facebook', 'svg' => '<path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3.2l.8-4H14V7a1 1 0 0 1 1-1h3V2z"/>'],
                        ['key' => 'linkedin_url', 'label' => 'LinkedIn', 'svg' => '<path d="M16 8a6 6 0 0 1 6 6v8h-4v-8a2 2 0 0 0-4 0v8h-4v-8a6 6 0 0 1 6-6z"/><rect x="2" y="9" width="4" height="13"/><circle cx="4" cy="4" r="2"/>'],
                        ['key' => 'instagram_url', 'label' => 'Instagram', 'svg' => '<rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/>'],
                        ['key' => 'threads_url', 'label' => 'Threads', 'svg' => '<path d="M12.2 2C6.4 2 3 6.1 3 12.1 3 18.3 6.6 22 12.2 22c5.1 0 8.8-2.8 8.8-7.1 0-3.2-2-5.2-5.1-5.7-.5-2.3-2-3.7-4.3-3.7-2.2 0-3.8 1.2-4.4 3.2l2 .6c.3-1.1 1.1-1.8 2.3-1.8 1.1 0 1.9.6 2.2 1.6-4.5.2-6.8 2-6.8 5 0 2.5 2 4.2 4.8 4.2 3 0 5-1.8 5-4.5 0-.8-.1-1.5-.2-2.2 1.6.5 2.4 1.6 2.4 3.3 0 3.1-2.7 5.1-6.7 5.1-4.4 0-7.1-3-7.1-7.9C5.1 7.2 7.6 4 12.2 4c3.8 0 6.1 2.1 6.7 5.6l2.1-.4C20.2 4.7 17 2 12.2 2zm-.4 14.3c-1.6 0-2.7-.8-2.7-2.1 0-1.8 1.6-2.8 4.9-2.9.1.6.2 1.2.2 1.8 0 1.9-.9 3.2-2.4 3.2z"/>'],
                    ];
                @endphp

                <div class="mt-5 flex flex-wrap items-center gap-2.5" aria-label="A1 Legacy social media links">
                    @foreach ($socialLinks as $social)
                        @if ($settings->get($social['key']))
                            <a href="{{ $settings->get($social['key']) }}" target="_blank" rel="noopener noreferrer" aria-label="{{ $social['label'] }}" title="{{ $social['label'] }}" class="group inline-flex h-11 w-11 items-center justify-center rounded-xl border border-white/10 bg-black/10 text-white/45 transition duration-200 hover:-translate-y-0.5 hover:border-neutron-300/45 hover:bg-neutron-500/10 hover:text-neutron-200 focus:outline-none focus:ring-2 focus:ring-neutron-300/50">
                                <svg viewBox="0 0 24 24" class="h-[18px] w-[18px]" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">{!! $social['svg'] !!}</svg>
                            </a>
                        @endif
                    @endforeach
                </div>
            </section>
        </div>

        <div class="mt-6 flex flex-col justify-between gap-3 border-t border-white/10 pt-6 text-xs text-white/30 sm:flex-row sm:items-center">
            <span>{{ $settings->get('footer_text') }}</span>
            <span>Built for practical AI execution.</span>
        </div>
    </div>
</footer>
