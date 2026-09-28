@switch($icon ?? 'activity')
    @case('automation')
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M13 2 5 13h6l-1 9 8-12h-6l1-8Z"/></svg>
        @break
    @case('integrations')
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M8 8h8v8H8zM4 10V7a3 3 0 0 1 3-3h3m4 0h3a3 3 0 0 1 3 3v3m0 4v3a3 3 0 0 1-3 3h-3m-4 0H7a3 3 0 0 1-3-3v-3"/></svg>
        @break
    @case('crm')
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 5h16v14H4V5Zm4 4h8M8 13h3m3 0h2M8 17h5"/></svg>
        @break
    @default
        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" aria-hidden="true"><path stroke-linecap="round" stroke-linejoin="round" d="M4 14h3l2-7 4 12 2-8 2 3h3"/></svg>
@endswitch
