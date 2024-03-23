<x-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/page/styles.css') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endpush
    <a href="{{ route('dashboard') }}" class="btn btn-primary">Voltar</a>
    <div class="container mt-5">
        <h1 class="display-6 m-3">Gerenciar Notícias</h1>
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    @unless (count($noticias) === 0)
                        <th scope="col">Título</th>
                        <th scope="col">Autor</th>
                        <th>Ações</th>
                    @else
                        <th> </th>
                    @endunless

                </tr>
            </thead>
            <tbody>
                @unless (count($noticias) === 0)
                    @foreach ($noticias as $noticia)
                        <tr class=" cursor-pointer"
                            onclick="window.location='{{ route('noticia.edit', ['noticia' => $noticia->id]) }}';">
                            <td>
                                <p>{{ $noticia->titulo }}</p>
                            </td>
                            <td>{{ $noticia->author->name }}</td>
                            <td>
                                <form action="{{ route('noticia.confirmDelete', ['noticia' => $noticia->id]) }}"
                                    method="GET">
                                    <button type="submit"
                                        class="rounded-3 bg-red-600 text-white p-1 d-flex self-end">Deletar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th> Não há notícias registradas.
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
