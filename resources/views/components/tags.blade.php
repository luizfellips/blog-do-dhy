@props(['tags'])

<div class="card-tags p-2">
    @foreach ($tags as $tag)
        <div class="tag">{{ $tag->name }}</div>
    @endforeach
</div>
