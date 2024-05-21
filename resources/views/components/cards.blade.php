@props(['noticias', 'extraClasses', 'titleDisplay'])

@push('styles')
        <link rel="stylesheet" href="{{asset('css/component/cards.css')}}">
@endpush

<div class="container" id="cards">
    <div class="pricing-header col-8 p-3 pb-md-4 mx-auto text-center {{$titleDisplay     ?? ''}}">
        <h1 class="display-4 col-12 fw-normal pb-1">Últimas Notícias</h1>
        <p class="fs-6 text-muted">Confira as notícias mais recentes do mundão</p>
    </div>
</div>

@if (count($noticias) === 0)
<div class="container my-2">
    <div class="row justify-content-center g-2">
        <h1 class="d-flex justify-content-center g-2 mt-5">Não há notícias registradas no momento.</h1>
    </div>
</div>
@else
<div class="container my-2">
    <div class="row justify-content-center g-2">
        @foreach ($noticias as $noticia)
            <x-card :noticia="$noticia" extraClasses="{{$extraClasses ?? ''}}"/>
        @endforeach
        <div class="links d-flex justify-content-center">
            {{ $noticias->links() }}
        </div>
    </div>
</div>
@endif
