@props(['messages'])

@if ($messages)
    <ul {{ $attributes->merge(['class' => 'flex flex-col gap-1 text-sm text-red-300']) }}>
        @foreach ((array) $messages as $message)
            <li>{{ $message }}</li>
        @endforeach
    </ul>
@endif
