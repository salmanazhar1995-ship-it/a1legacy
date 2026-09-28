@switch($section->type)
    @case('business_showcase') @include('site.sections.business-showcase',['section'=>$section,'industries'=>$industries ?? collect()]) @break
    @case('html_section') @include('site.sections.html-section',['section'=>$section]) @break
    @case('hero') @include('site.sections.hero',['section'=>$section,'isHome'=>($isHome ?? false),'settings'=>$settings ?? collect(),'platforms'=>$platforms ?? collect()]) @break
    @case('logo_strip') @include('site.sections.logo-strip',['section'=>$section]) @break
    @case('stats') @include('site.sections.stats',['section'=>$section]) @break
    @case('feature_grid') @include('site.sections.feature-grid',['section'=>$section]) @break
    @case('testimonials') @include('site.sections.testimonials',['section'=>$section]) @break
    @case('pricing') @include('site.sections.pricing',['section'=>$section]) @break
    @case('faq') @include('site.sections.faq',['section'=>$section]) @break
    @case('cta') @include('site.sections.cta',['section'=>$section]) @break
    @case('contact') @include('site.sections.contact',['section'=>$section,'settings'=>$settings ?? collect()]) @break
    @case('changelog') @include('site.sections.changelog',['section'=>$section]) @break
    @case('rich_text') @include('site.sections.rich-text',['section'=>$section]) @break
    @case('standard_content') @include('site.sections.standard-content',['section'=>$section]) @break
    @case('content') @include('site.sections.standard-content',['section'=>$section]) @break
    @case('custom_content') @include('site.sections.standard-content',['section'=>$section]) @break
    @case('split_content') @include('site.sections.split-content',['section'=>$section]) @break
    @case('image_content') @include('site.sections.split-content',['section'=>$section]) @break
    @case('cards_grid') @include('site.sections.cards-grid',['section'=>$section]) @break
    @case('features_grid') @include('site.sections.cards-grid',['section'=>$section]) @break
    @case('gallery_grid') @include('site.sections.gallery-grid',['section'=>$section]) @break
    @case('video') @include('site.sections.video',['section'=>$section]) @break
@endswitch
