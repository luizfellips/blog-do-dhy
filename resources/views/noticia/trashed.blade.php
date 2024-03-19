<x-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/page/styles.css') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endpush
    <a href="{{ route('dashboard') }}" class="btn btn-primary">Voltar</a>
    <div class="container mt-5">
        <h1 class="display-6 m-3">Lixeira</h1>
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    @unless (count($noticias) === 0)
                        <th scope="col">ID</th>
                        <th scope="col">Título</th>
                        <th scope="col">Subtítulo</th>
                        <th scope="col">Autor</th>
                        <th></th>
                    @else
                        <th> </th>
                    @endunless

                </tr>
            </thead>
            <tbody>
                @unless (count($noticias) === 0)
                    @foreach ($noticias as $noticia)
                        <tr class=" cursor-pointer">
                            <th scope="row">{{ $noticia->id }}</th>
                            <td>{{ $noticia->titulo }}</td>
                            <td>{{ $noticia->subtitulo }}</td>
                            <td>{{ $noticia->author->name }}</td>
                            <td>
                                <form action="{{ route('noticia.restore', ['noticia' => $noticia->id]) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit"
                                        class="rounded-3 bg-blue-600 text-white p-1 d-flex self-end">Restaurar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th> Não há nada na lixeira.
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
