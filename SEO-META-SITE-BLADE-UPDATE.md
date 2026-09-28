# SEO meta/link update

Updated `resources/views/layouts/site.blade.php` so every frontend page receives dynamic SEO metadata from the existing admin SEO fields.

Included: title, description, keywords, robots, canonical, sitemap link, favicon links, Open Graph, Twitter Card, optional Google/Bing verification, JSON-LD schema, page-specific social images on product/blog/portfolio/gallery/industry detail pages, and article timestamps for blog posts.

Optional Site Settings keys supported automatically if present: `seo_robots`, `theme_color`, `site_author`, `seo_social_image`, `twitter_handle`, `google_site_verification`, `bing_site_verification`.
