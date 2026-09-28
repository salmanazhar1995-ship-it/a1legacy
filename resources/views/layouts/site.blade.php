<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @php
            $siteName = trim((string) $settings->get('site_name', 'A1 Legacy Labs')) ?: 'A1 Legacy Labs';
            $siteLocale = app()->getLocale() === 'en' ? 'en_US' : str_replace('-', '_', app()->getLocale());

            $seoTitle = trim((string) ($documentTitle ?: ($page->seo_title ?: $page->title)));
            $seoTitle = $seoTitle !== '' ? $seoTitle : $siteName;
            $fullTitle = str_contains(strtolower($seoTitle), strtolower($siteName))
                ? $seoTitle
                : $seoTitle.' — '.$siteName;

            $rawDescription = (string) ($documentDescription ?: $page->meta_description);
            $seoDescription = trim((string) preg_replace('/\\s+/u', ' ', strip_tags($rawDescription)));
            $seoDescription = \Illuminate\Support\Str::limit($seoDescription, 160, '');

            $seoKeywords = trim((string) ($documentKeywords ?: $page->meta_keywords));
            $canonicalUrl = url()->current();
            $robotsValue = trim((string) ($documentRobots ?: $settings->get('seo_robots', 'index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1')));
            $themeColor = trim((string) $settings->get('theme_color', '#02050A')) ?: '#02050A';
            $authorName = trim((string) $settings->get('site_author', $siteName)) ?: $siteName;

            $absoluteUrl = static function (?string $value): ?string {
                $value = trim((string) $value);
                if ($value === '') {
                    return null;
                }
                if (\Illuminate\Support\Str::startsWith($value, ['http://', 'https://', '//', 'data:'])) {
                    return $value;
                }
                return url('/'.ltrim($value, '/'));
            };

            $faviconUrl = $absoluteUrl($settings->get('favicon'));
            $socialImageUrl = $absoluteUrl(
                $documentImage
                    ?: $settings->get('seo_social_image')
                    ?: $settings->get('header_logo')
                    ?: $settings->get('footer_logo')
                    ?: $settings->get('favicon')
            );
            $socialImageAlt = trim((string) ($documentImageAlt ?: $page->title ?: $siteName));
            $twitterHandle = trim((string) $settings->get('twitter_handle', ''));
            if ($twitterHandle !== '' && ! str_starts_with($twitterHandle, '@')) {
                $twitterHandle = '@'.$twitterHandle;
            }

            $schemaGraph = [
                [
                    '@type' => 'Organization',
                    '@id' => url('/').'#organization',
                    'name' => $siteName,
                    'url' => url('/'),
                    'logo' => $socialImageUrl,
                ],
                [
                    '@type' => 'WebSite',
                    '@id' => url('/').'#website',
                    'url' => url('/'),
                    'name' => $siteName,
                    'publisher' => ['@id' => url('/').'#organization'],
                    'inLanguage' => str_replace('_', '-', app()->getLocale()),
                ],
                [
                    '@type' => $documentType === 'article' ? 'Article' : 'WebPage',
                    '@id' => $canonicalUrl.'#webpage',
                    'url' => $canonicalUrl,
                    'name' => $fullTitle,
                    'description' => $seoDescription !== '' ? $seoDescription : null,
                    'isPartOf' => ['@id' => url('/').'#website'],
                    'about' => ['@id' => url('/').'#organization'],
                    'primaryImageOfPage' => $socialImageUrl ? ['@id' => $canonicalUrl.'#primaryimage'] : null,
                    'image' => $socialImageUrl,
                    'datePublished' => $documentPublishedTime,
                    'dateModified' => $documentModifiedTime,
                    'inLanguage' => str_replace('_', '-', app()->getLocale()),
                ],
            ];

            if ($socialImageUrl) {
                $schemaGraph[] = [
                    '@type' => 'ImageObject',
                    '@id' => $canonicalUrl.'#primaryimage',
                    'url' => $socialImageUrl,
                    'contentUrl' => $socialImageUrl,
                    'caption' => $socialImageAlt,
                ];
            }

            $schemaGraph = collect($schemaGraph)->map(function (array $node): array {
                return array_filter($node, static fn ($value) => $value !== null && $value !== '');
            })->values()->all();
        @endphp

        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $fullTitle }}</title>
        @if($seoDescription !== '')
            <meta name="description" content="{{ $seoDescription }}">
        @endif
        @if($seoKeywords !== '')
            <meta name="keywords" content="{{ $seoKeywords }}">
        @endif
        <meta name="author" content="{{ $authorName }}">
        <meta name="application-name" content="{{ $siteName }}">
        <meta name="robots" content="{{ $robotsValue }}">
        <meta name="googlebot" content="{{ $robotsValue }}">
        <meta name="bingbot" content="{{ $robotsValue }}">
        <meta name="referrer" content="strict-origin-when-cross-origin">
        <meta name="theme-color" content="{{ $themeColor }}">
        <meta name="color-scheme" content="dark">

        @if($settings->get('google_site_verification'))
            <meta name="google-site-verification" content="{{ $settings->get('google_site_verification') }}">
        @endif
        @if($settings->get('bing_site_verification'))
            <meta name="msvalidate.01" content="{{ $settings->get('bing_site_verification') }}">
        @endif

        <link rel="canonical" href="{{ $canonicalUrl }}">
        <link rel="sitemap" type="application/xml" title="Sitemap" href="{{ url('/sitemap.xml') }}">
        @if($faviconUrl)
            <link rel="icon" href="{{ $faviconUrl }}">
            <link rel="shortcut icon" href="{{ $faviconUrl }}">
            <link rel="apple-touch-icon" href="{{ $faviconUrl }}">
        @endif

        <meta property="og:locale" content="{{ $siteLocale }}">
        <meta property="og:type" content="{{ $documentType === 'article' ? 'article' : 'website' }}">
        <meta property="og:site_name" content="{{ $siteName }}">
        <meta property="og:title" content="{{ $fullTitle }}">
        @if($seoDescription !== '')
            <meta property="og:description" content="{{ $seoDescription }}">
        @endif
        <meta property="og:url" content="{{ $canonicalUrl }}">
        @if($socialImageUrl)
            <meta property="og:image" content="{{ $socialImageUrl }}">
            <meta property="og:image:alt" content="{{ $socialImageAlt }}">
        @endif
        @if($documentType === 'article' && $documentPublishedTime)
            <meta property="article:published_time" content="{{ $documentPublishedTime }}">
        @endif
        @if($documentType === 'article' && $documentModifiedTime)
            <meta property="article:modified_time" content="{{ $documentModifiedTime }}">
        @endif

        <meta name="twitter:card" content="{{ $socialImageUrl ? 'summary_large_image' : 'summary' }}">
        <meta name="twitter:title" content="{{ $fullTitle }}">
        @if($seoDescription !== '')
            <meta name="twitter:description" content="{{ $seoDescription }}">
        @endif
        @if($socialImageUrl)
            <meta name="twitter:image" content="{{ $socialImageUrl }}">
            <meta name="twitter:image:alt" content="{{ $socialImageAlt }}">
        @endif
        @if($twitterHandle !== '')
            <meta name="twitter:site" content="{{ $twitterHandle }}">
        @endif

        <script type="application/ld+json">{!! json_encode(['@context' => 'https://schema.org', '@graph' => $schemaGraph], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>

        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Geist:wght@400;500;600&amp;family=Geist+Mono:wght@400;500;600&amp;display=swap" rel="stylesheet">
        @include('layouts.runtime-assets')
        <style id="a1-public-heading-system">
            /* Public website heading system: centered and kept on one line by the fitter below. */
            main h1,
            main .a1-page-heading,
            main .a1-section-heading,
            main .workflow-section-head,
            main .a1-industry-head {
                text-align: center !important;
            }

            main h1,
            main .a1-section-heading > h2,
            main .workflow-section-head > h2,
            main .a1-industry-title,
            main .a1-industry-panel-title {
                margin-left: auto !important;
                margin-right: auto !important;
                max-width: 100%;
                text-align: center !important;
            }

            .a1-responsive-single-heading {
                width: max-content;
                max-width: 100%;
                white-space: nowrap !important;
                text-align: center !important;
                transform-origin: center center;
            }

            @media (max-width: 640px) {
                .a1-responsive-single-heading {
                    letter-spacing: -0.035em !important;
                }
            }
        </style>
        <style id="a1-theme-scrollbars">
            html,
            #a1WorkflowEmbed .console,
            #a1WorkflowEmbed .architecture,
            #a1WorkflowEmbed .niche-track {
                scrollbar-color: #2f8fff #050d18;
                scrollbar-width: thin;
            }

            html::-webkit-scrollbar,
            #a1WorkflowEmbed .console::-webkit-scrollbar,
            #a1WorkflowEmbed .architecture::-webkit-scrollbar,
            #a1WorkflowEmbed .niche-track::-webkit-scrollbar {
                width: 10px;
                height: 10px;
            }

            html::-webkit-scrollbar-track,
            #a1WorkflowEmbed .console::-webkit-scrollbar-track,
            #a1WorkflowEmbed .architecture::-webkit-scrollbar-track,
            #a1WorkflowEmbed .niche-track::-webkit-scrollbar-track {
                background: #050d18;
                border-left: 1px solid rgba(158, 203, 255, .08);
            }

            html::-webkit-scrollbar-thumb,
            #a1WorkflowEmbed .console::-webkit-scrollbar-thumb,
            #a1WorkflowEmbed .architecture::-webkit-scrollbar-thumb,
            #a1WorkflowEmbed .niche-track::-webkit-scrollbar-thumb {
                border: 2px solid #050d18;
                border-radius: 9999px;
                background: linear-gradient(180deg, #2f8fff, #1458a8);
                box-shadow: 0 0 12px rgba(47, 143, 255, .35);
            }

            html::-webkit-scrollbar-thumb:hover,
            #a1WorkflowEmbed .console::-webkit-scrollbar-thumb:hover,
            #a1WorkflowEmbed .architecture::-webkit-scrollbar-thumb:hover,
            #a1WorkflowEmbed .niche-track::-webkit-scrollbar-thumb:hover {
                background: linear-gradient(180deg, #66b0ff, #2f8fff);
            }
        </style>
        @include('layouts.ai-agent-head')
    </head>
    <body class="font-sans">
        <div class="neutron-grid min-h-screen overflow-hidden bg-neutron-950">
            @include('layouts.site-header')

            <main>
                {{ $slot }}
            </main>

            @include('layouts.site-footer')
        </div>

        @include('layouts.floating-actions')
        <script id="a1-responsive-heading-fitter">
            (() => {
                const selector = [
                    'main h1',
                    'main .a1-section-heading > h2',
                    'main .workflow-section-head > h2',
                    'main .a1-industry-title',
                    'main .a1-industry-panel-title'
                ].join(',');

                const fitHeading = (heading) => {
                    if (!heading || heading.offsetParent === null) return;
                    heading.classList.add('a1-responsive-single-heading');
                    heading.style.fontSize = '';
                    heading.style.transform = '';

                    const parent = heading.parentElement;
                    if (!parent) return;

                    const available = Math.max(1, parent.clientWidth - 4);
                    let size = parseFloat(window.getComputedStyle(heading).fontSize) || 32;
                    const minSize = window.innerWidth <= 420 ? 13 : (window.innerWidth <= 640 ? 15 : 18);

                    while (heading.scrollWidth > available && size > minSize) {
                        size -= 0.5;
                        heading.style.fontSize = `${size}px`;
                    }

                    if (heading.scrollWidth > available) {
                        const scale = Math.max(0.82, available / heading.scrollWidth);
                        heading.style.transform = `scaleX(${scale})`;
                    }
                };

                const fitAllHeadings = () => document.querySelectorAll(selector).forEach(fitHeading);
                let frame = null;
                const scheduleFit = () => {
                    if (frame) cancelAnimationFrame(frame);
                    frame = requestAnimationFrame(fitAllHeadings);
                };

                if (document.readyState === 'loading') {
                    document.addEventListener('DOMContentLoaded', scheduleFit, { once: true });
                } else {
                    scheduleFit();
                }
                window.addEventListener('load', scheduleFit, { once: true });
                window.addEventListener('resize', scheduleFit, { passive: true });
                if ('ResizeObserver' in window) {
                    const observer = new ResizeObserver(scheduleFit);
                    document.querySelectorAll('main').forEach((node) => observer.observe(node));
                }
            })();
        </script>
        @include('layouts.ai-agent-scripts')
        <script src="{{ asset('assets/ai-agents.js') }}?v={{ filemtime(public_path('assets/ai-agents.js')) }}" defer></script>
    </body>
</html>
