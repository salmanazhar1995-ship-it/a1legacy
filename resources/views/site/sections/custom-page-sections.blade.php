@php
    $customTypes = ['standard_content','content','custom_content','split_content','image_content','cards_grid','features_grid','stats','cta','faq','logo_strip','gallery_grid','video','rich_text','html_section'];
@endphp
@if(isset($page) && $page->relationLoaded('sections'))
    @foreach($page->sections->whereIn('type', $customTypes) as $section)
        @include('site.sections.renderer',['section'=>$section,'isHome'=>false,'settings'=>$settings ?? collect()])
    @endforeach
@endif
