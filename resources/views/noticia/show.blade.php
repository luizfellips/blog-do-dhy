<x-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/page/styles.css') }}">
    @endpush

    <x-carousel />


    <div class="container noticia border-top mt-3 p-3">
        <div class="heading">
            <h1 class="display-6">
                {{$noticia->titulo}}
            </h1>
            <p class="px-3 text-muted">{{$noticia->subtitulo}}</p>
        </div>

        <x-tags :tags="$noticia->tags" />

        <div class="author">
            <div class="author-image">
                <img src="{{asset($noticia->imagem) ?? asset('img/placeholder.png')}}" alt="Foto do Autor">
            </div>
            <div class="author-details">
                <div class="author-name">Por Fellips Souza, Freelancer</div>
                <div class="post-details">
                    <span>01/03/2024 19h25</span>
                    •
                    <span>Atualizado há 2 horas</span>
                </div>
            </div>
        </div>
        <div class="social-share">
            <a class="btn instagram" href="#!" role="button"><i class="bi bi-instagram fs-2"></i></a>
            <a class="btn facebook" href="#!" role="button"><i class="bi bi-facebook fs-2"></i></a>
            <a class="btn twitter" href="#!" role="button"><i class="bi bi-twitter-x fs-2"></i></a>
        </div>

        <div class="container mt-5">
            <div class="image">
                <img class="w-100 rounded-2"
                    src="{{asset($noticia->imagem) ?? asset('img/placeholder.png')}}"
                    alt="">
                <p class="text-muted">O presidente Lula durante discurso na 8ª cúpula da Celac — Foto:
                    Reprodução/Canal
                    Gov</p>
            </div>

            @foreach (explode("\n", $noticia->corpo) as $paragraph)
            @php
            // Use regular expression to identify and replace bold and italic content
            $paragraph = preg_replace('/\*(.*?)\*/', '<strong>$1</strong>', $paragraph);
            $paragraph = preg_replace('/\_(.*?)\_/', '<i>$1</i>', $paragraph);
            @endphp

                <p class="fs-5">{!!$paragraph!!}</p>
            @endforeach
        </div>
    </div>
</x-layout>
