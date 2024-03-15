<x-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/page/styles.css') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endpush
    <a href="{{ route('dashboard') }}" class="btn btn-primary">Voltar</a>
    <div class="my-4 items-center justify-center">
        <h1 class="display-6">{{ $author->name }}</h1>
        <p class="text-muted">{{ $author->job }}</p>
    </div>
    <div class="d-flex justify-content-center">
    <h4 class="fs-5 self-center">Notícias associadas</h4>
    </div>
    <div class="my-4 d-flex">
        @foreach ($author->noticias as $noticia)
        <a href="{{route('noticia.show', ['titulo' => $noticia->slug])}}" class="me-5 bg-primary-color text-white rounded-3 p-4 transform hover:scale-105 transition duration-100">
            <p class="fs-3">{{ $noticia->titulo }}</p>
            <p>{{ $noticia->subtitulo }}</p>
        </a>
        @endforeach
    </div>

</x-layout>
