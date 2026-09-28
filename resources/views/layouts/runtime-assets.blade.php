@php
    /*
     |--------------------------------------------------------------------------
     | Runtime assets without a Vite manifest dependency
     |--------------------------------------------------------------------------
     | The compiled CSS/JS are bundled with the project under resources/runtime.
     | Keeping them inside the HTML prevents stale Vite hashes, missing build
     | files, public/hot leftovers, or a different web root from breaking CSS.
     */
    $runtimeCssPath = resource_path('runtime/app.css');
    $runtimeJsPath = resource_path('runtime/app.js');
@endphp

@if (is_file($runtimeCssPath))
    <style id="a1-runtime-css">{!! file_get_contents($runtimeCssPath) !!}</style>
@else
    <link rel="stylesheet" href="{{ asset('assets/app.css') }}">
@endif

@if (is_file($runtimeJsPath))
    <script type="module" id="a1-runtime-js">{!! file_get_contents($runtimeJsPath) !!}</script>
@else
    <script type="module" src="{{ asset('assets/app.js') }}"></script>
@endif
