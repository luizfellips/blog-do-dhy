@props(['tags'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/component/tags.css') }}">
@endpush
<div class="card-tags my-2">

    @foreach ($tags as $tag)
        <a href="{{ route('noticia.searchResults') }}?tag={{ $tag->name }}" class="tag border-0 text-decoration-none">
            {{ $tag->name }}
        </a>
    @endforeach
</div>
