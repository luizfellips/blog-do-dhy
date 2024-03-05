@props(['tags'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/component/tags.css') }}">
@endpush

<div class="card-tags p-2">
    @foreach ($tags as $tag)
        <div class="tag">{{ $tag->name }}</div>
    @endforeach
</div>
