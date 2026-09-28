<x-site-layout :page="$page" :navigation-pages="$navigationPages" :settings="$settings">
@php($workflowProofRendered=false) @php($coreProductsRendered=false) @php($clientStoriesRendered=false) @php($galleryRendered=false)
@foreach($page->sections as $section)
    @php($legacyPlatformSection = $page->slug === 'home' && (str_contains(strtolower((string) $section->heading), 'everything connected') || in_array($section->key, ['platform','platforms','platform-overview','platform-features'], true)))
    @if($legacyPlatformSection) @continue @endif
    @if($page->slug==='home' && $section->key==='core-products') @if(!$coreProductsRendered) @include('site.sections.core-products',['products'=>$featuredProducts??collect()]) @php($coreProductsRendered=true) @endif @continue @endif
    @if($page->slug==='home' && $section->type==='client_stories')
        @if(!$workflowProofRendered) @include('site.sections.workflow-proof') @php($workflowProofRendered=true) @endif
        @include('site.sections.client-stories',['section'=>$section,'stories'=>$featuredClientStories??collect()]) @php($clientStoriesRendered=true) @continue
    @endif
    @if($page->slug==='home' && $section->type==='gallery_showcase')
        @if(!$workflowProofRendered) @include('site.sections.workflow-proof') @php($workflowProofRendered=true) @endif
        @if(!$clientStoriesRendered) @include('site.sections.client-stories',['section'=>null,'stories'=>$featuredClientStories??collect()]) @php($clientStoriesRendered=true) @endif
        @include('site.sections.gallery-showcase',['section'=>$section,'galleries'=>$featuredGalleries??collect()]) @php($galleryRendered=true) @continue
    @endif
    @if($page->slug==='home' && !$coreProductsRendered && in_array($section->type,['testimonials','pricing','faq','cta'],true)) @include('site.sections.core-products',['products'=>$featuredProducts??collect()]) @php($coreProductsRendered=true) @endif
    @if($page->slug==='home' && in_array($section->type,['testimonials','pricing','faq','cta'],true))
        @if(!$workflowProofRendered) @include('site.sections.workflow-proof') @php($workflowProofRendered=true) @endif
        @if(!$clientStoriesRendered) @include('site.sections.client-stories',['section'=>null,'stories'=>$featuredClientStories??collect()]) @php($clientStoriesRendered=true) @endif
        @if(!$galleryRendered) @include('site.sections.gallery-showcase',['section'=>null,'galleries'=>$featuredGalleries??collect()]) @php($galleryRendered=true) @endif
    @endif
    @include('site.sections.renderer',['section'=>$section,'isHome'=>$page->slug==='home','settings'=>$settings,'platforms'=>$platforms??collect(),'industries'=>$industries??collect()])
@endforeach
@if($page->slug==='home' && !$coreProductsRendered) @include('site.sections.core-products',['products'=>$featuredProducts??collect()]) @endif
@if($page->slug==='home' && !$workflowProofRendered) @include('site.sections.workflow-proof') @endif
@if($page->slug==='home' && !$clientStoriesRendered) @include('site.sections.client-stories',['section'=>null,'stories'=>$featuredClientStories??collect()]) @endif
@if($page->slug==='home' && !$galleryRendered) @include('site.sections.gallery-showcase',['section'=>null,'galleries'=>$featuredGalleries??collect()]) @endif
</x-site-layout>
