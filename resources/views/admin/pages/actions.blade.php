<div class="flex flex-wrap items-center justify-end gap-2">
    <a href="{{ route('admin.pages.edit',$page) }}" class="rounded-lg border border-neutron-300/20 px-3 py-2 text-xs text-neutron-200">Edit</a>
    <form method="POST" action="{{ route('admin.pages.toggle-published',$page) }}">@csrf<button class="rounded-lg border border-white/10 px-3 py-2 text-xs {{ $page->is_published ? 'text-amber-200' : 'text-emerald-200' }}">{{ $page->is_published ? 'Disable page' : 'Enable page' }}</button></form>
    <form method="POST" action="{{ route('admin.pages.toggle-navigation',$page) }}">@csrf<button class="rounded-lg border border-white/10 px-3 py-2 text-xs {{ $page->show_in_navigation ? 'text-white/50' : 'text-neutron-200' }}">{{ $page->show_in_navigation ? 'Hide tab' : 'Show tab' }}</button></form>
</div>
