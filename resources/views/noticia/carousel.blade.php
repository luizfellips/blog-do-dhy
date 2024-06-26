<x-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/page/styles.css') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endpush
    <a href="{{ route('dashboard') }}" class="btn btn-primary">Voltar</a>
    <div class="container mt-5">
        <h1 class="display-6 m-3">Gerenciar Carrossel de Notícias</h1>
        <div class="carrossel-atual m-5">
            <div class="row g-5">
                <div class="fs-4 text-center">Carrossel atual</div>
                @unless (count($carouselNoticias) === 0)
                    @foreach ($carouselNoticias as $carouselNoticia)
                        <div class="col d-block">
                            <div class="bg-slate-200 p-4 rounded-3">
                                <h5 class="fs-5">{{ $carouselNoticia->titulo }}</h5>
                                <p class="text-muted">{{ $carouselNoticia->subtitulo }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="col">   
                        <p>Não há notícias no carrossel.</p>
                    </div>
                @endunless
            </div>

        </div>
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    @unless (count($noticias) === 0)
                        <th>Título</th>
                        <th>Ações</th>
                    @else
                        <th> </th>
                    @endunless

                </tr>
            </thead>
            <tbody class="text-center">
                @unless (count($noticias) === 0)
                    @foreach ($noticias as $noticia)
                        <tr class=" cursor-pointer">
                            <td>
                                <p>{{ $noticia->titulo }}</p>
                            </td>
                            @if (!$noticia->is_featured)
                                <td class="">
                                    <form action="{{ route('noticia.addToCarousel', ['noticia' => $noticia]) }}"
                                        method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit"
                                            class="rounded-3 bg-blue-600 text-white p-1 d-flex self-end">Adicionar</button>
                                    </form>
                                </td>
                            @endif
                            @if ($noticia->is_featured)
                                <td class="">
                                    <form action="{{ route('noticia.removeFromCarousel', ['noticia' => $noticia]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="rounded-3 bg-red-600 text-white p-1 d-flex self-end">Remover</button>
                                    </form>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th> Não há notícias no carrossel.
                        </th>
                    </tr>
                @endunless
            </tbody>
        </table>
        <div class="links my-3">
            {{ $noticias->links() }}

        </div>
    </div>
</x-layout>
