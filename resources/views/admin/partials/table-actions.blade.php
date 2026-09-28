<div class="flex items-center justify-end gap-2 whitespace-nowrap">
    @isset($viewUrl)
        @if($viewUrl)
            <a href="{{ $viewUrl }}" @if(!empty($viewExternal)) target="_blank" rel="noopener noreferrer" @endif class="rounded-lg border border-white/10 px-3 py-2 text-xs text-white/55 transition hover:bg-white/5 hover:text-white">View</a>
        @endif
    @endisset

    @isset($editUrl)
        @if($editUrl)
            <a href="{{ $editUrl }}" class="rounded-lg border border-neutron-300/20 px-3 py-2 text-xs text-neutron-200 transition hover:bg-neutron-500/10 hover:text-white">Edit</a>
        @endif
    @endisset

    @isset($deleteUrl)
        @if($deleteUrl)
            <form method="POST" action="{{ $deleteUrl }}" class="inline js-delete-form" data-delete-label="{{ $deleteLabel ?? 'this record' }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="rounded-lg border border-red-300/15 px-3 py-2 text-xs text-red-200 transition hover:bg-red-500/10">Delete</button>
            </form>
        @endif
    @endisset
</div>
