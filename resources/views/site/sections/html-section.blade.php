@php
    $htmlUrl = data_get($section->settings, 'section_html');
    $minHeight = max(100, min(5000, (int) data_get($section->settings, 'html_min_height', 320)));
@endphp
@if($htmlUrl)
<section id="{{ $section->key }}" class="w-full overflow-hidden" data-a1-html-section>
    <iframe
        src="{{ $htmlUrl }}"
        title="{{ $section->heading ?: 'Custom HTML section' }}"
        class="block w-full border-0 bg-transparent"
        style="min-height: {{ $minHeight }}px; height: {{ $minHeight }}px;"
        sandbox="allow-scripts allow-forms allow-popups"
        loading="lazy"
        referrerpolicy="no-referrer"
        data-a1-html-section-frame
    ></iframe>
</section>
@once
<script>
document.addEventListener('DOMContentLoaded', function () {
    var frames = Array.from(document.querySelectorAll('[data-a1-html-section-frame]'));
    window.addEventListener('message', function (event) {
        if (!event.data || event.data.type !== 'a1-html-section-height') return;
        var frame = frames.find(function (candidate) { return candidate.contentWindow === event.source; });
        if (!frame) return;
        var height = Number(event.data.height);
        if (!Number.isFinite(height)) return;
        height = Math.max(100, Math.min(12000, Math.ceil(height)));
        frame.style.height = height + 'px';
    });
});
</script>
@endonce
@endif
