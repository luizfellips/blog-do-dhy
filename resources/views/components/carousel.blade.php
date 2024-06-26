@props(['carouselNoticias'])


<div class="container">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            @foreach ($carouselNoticias as $index => $carouselNoticia)
                <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="{{ $index }}"
                    @if ($loop->first) class="active" @endif
                    aria-label="Slide {{ $index + 1 }}"></button>
            @endforeach
        </div>
        <div class="carousel-inner rounded-3" id="slider">
            @foreach ($carouselNoticias as $carouselNoticia)
                @php
                    $path = 'img/noticias/';
                    $fallback = asset('img/placeholder.png');
                    $noticiaImagem = $path . $carouselNoticia->imagem;

                    $image = asset($noticiaImagem);

                    if (is_null($carouselNoticia->imagem)) {
                        $image = $fallback;
                    }
                @endphp
                <div class="carousel-item  @if ($loop->first) active @endif">
                    <a href="{{ route('noticia.show', ['titulo' => $carouselNoticia->slug]) }}">
                        <img src="{{ $image }}" class="carouselImage" alt="...">
                    </a>
                    <div class="carousel-caption mobile-caption shadow-none d-md-block">
                        <h5>{{ $carouselNoticia->titulo }}</h5>
                        <p class="d-none d-md-block">{{ $carouselNoticia->subtitulo }}</p>
                        <a class="btn btn-primary d-none d-md-inline rounded-3"
                            href="{{ route('noticia.show', ['titulo' => $carouselNoticia->slug]) }}">Ver Mais</a>
                    </div>
                </div>
            @endforeach
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
