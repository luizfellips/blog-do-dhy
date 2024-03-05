@php
    use Carbon\Carbon;

    $updatedAt = Carbon::parse($noticia->updated_at);
    $createdAt = Carbon::parse($noticia->created_at);
    $timeAgo = $updatedAt->locale('pt_BR')->diffForHumans();
@endphp

<x-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/page/styles.css') }}">
    @endpush



    <x-cards :noticias="$noticias" extraClasses="isShowPage" titleDisplay="d-none" />


    <div class="container noticia border-top mt-3 p-3">
        <div class="heading">
            <h1 class="display-6">
                {{ $noticia->titulo }}
            </h1>
            <p class="px-3 text-muted">{{ $noticia->subtitulo }}</p>
        </div>

        <x-tags :tags="$noticia->tags" />

        <div class="author">
            <div class="author-image">
                <img src="{{ asset($noticia->imagem) ?? asset('img/placeholder.png') }}" alt="Foto do Autor">
            </div>
            <div class="author-details">
                <div class="author-name">Por {{$noticia->author->name}}, {{$noticia->author->job}}</div>
                <div class="post-details">
                    <span>{{ $createdAt }}</span>
                    •
                    <span>{{ $timeAgo }}</span>
                </div>
            </div>
        </div>
        <div class="social-share">
            <a class="btn instagram" href="#!" role="button"><i class="bi bi-instagram fs-2"></i></a>
            <a class="btn facebook" href="#!" role="button"><i class="bi bi-facebook fs-2"></i></a>
            <a class="btn twitter" href="#!" role="button"><i class="bi bi-twitter-x fs-2"></i></a>
        </div>

        <div class="container mt-5">
            @php
                $image = file_exists(asset($noticia->imagem)) ? asset($noticia->imagem) : asset('img/placeholder.png');
            @endphp
            <div class="image">
                <img class="w-100 rounded-2" src="{{ $image }}"
                    alt="{{ $noticia->legenda_imagem ?? 'Sem legenda disponível' }}">
                <p class="text-muted">{{ $noticia->legenda_imagem ?? 'Sem legenda disponível' }}</p>
            </div>

            @foreach (explode("\n", $noticia->corpo) as $paragraph)
                @php
                    // Use regular expression to identify and replace bold and italic content
                    $paragraph = preg_replace('/\*(.*?)\*/', '<strong>$1</strong>', $paragraph);
                    $paragraph = preg_replace('/\_(.*?)\_/', '<i>$1</i>', $paragraph);
                @endphp

                <p class="fs-5">{!! $paragraph !!}</p>
            @endforeach
        </div>
    </div>
</x-layout>
