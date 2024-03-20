<x-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/page/styles.css') }}">
        <link rel="stylesheet" href="{{asset('css/component/cards.css')}}">
    @endpush
    
    <div class="container" id="cards">
        <div class="pricing-header p-3 pb-md-4 mx-auto text-start {{$titleDisplay     ?? ''}}">
            <h1 class="display-4 col-12 fw-normal pb-1">Resultados da pesquisa</h1>
        </div>
    </div>
    <div class="container my-2">
        <div class="row justify-content-start g-2">
            @foreach ($noticias as $noticia)
                <x-card :noticia="$noticia"/>
            @endforeach
            <div class="links d-flex justify-content-center">
                {{ $noticias->links() }}
            </div>
        </div>
    
    </div>
    </x-layout>
