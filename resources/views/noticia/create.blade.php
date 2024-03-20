<x-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/page/styles.css') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endpush

    <a href="{{route('dashboard')}}" class="btn btn-primary">Voltar</a>
    <div class="my-4 flex items-center justify-center">
        <div class="p-10 rounded shadow-sm border-2 border-opacity-35 border-blue-700 max-w-lg w-2/3">
            <div class="mb-6 p-10 bg-white -m-10">
                <h1 class="font-bold text-2xl text-gray-700 text-center">Criar nova notícia</h1>
            </div>
            <form action="{{ route('noticia.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="grid grid-cols-1 gap-6">
                    <div class="flex flex-col mb-4">
                        <label>Autor
                            <span class="block text-xs font-light text-stone-400">Escolha um autor</span>
                        </label>
                        <select id="author" name="author_id" required class="mt-2 px-4 py-2 shadow rounded">
                            <option value="">Escolha um autor</option>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                        <a href="{{route('author.create')}}" class="text-sm p-1 text-muted flex self-end underline">Registrar um autor</a>
                    </div>
                </div>
                <div class="grid grid-cols-1 gap-6">
                    <div class="flex flex-col">
                        <label>Título
                            <span class="block text-xs font-light text-stone-400">O título da notícia</span>
                        </label>
                        <input type="text" name="titulo" required class="mt-2 px-4 py-2 shadow rounded" />
                    </div>
                    <div class="flex flex-col mb-4">
                        <label>Subtítulo
                            <span class="block text-xs font-light text-stone-400">O subtítulo da notícia</span>
                        </label>
                        <input type="text" name="subtitulo" required class="mt-2 px-4 py-2 shadow rounded" />
                    </div>
                </div>

                <div class="flex flex-col items-center mb-4">
                    <label>Corpo
                        <span class="block text-xs font-light text-stone-400">Corpo da notícia</span>
                    </label>
                    <textarea required name="corpo" cols="16" class="mt-2 px-4 py-2 shadow rounded"></textarea>
                    <div class="info">
                        <p class="text-sm p-1 mt-2 text-muted">Você pode usar as seguintes marcações para personalizar o
                            texto:</p>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Marcação</th>
                                    <th>Resultado</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>_Frase de teste_</td>
                                    <td><i>Frase de teste</i></td>
                                </tr>
                                <tr>
                                    <td>*Frase de teste*</td>
                                    <td><strong>Frase de teste</strong></td>
                                </tr>
                                <tr>
                                    <td>--Frase de teste--</td>
                                    <td>
                                        <div class="special-block">Frase de teste</div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="flex flex-col mb-4">
                    <label>Imagem
                        <span class="block text-xs font-light text-stone-400">Imagem que acompanhará a notícia</span>
                    </label>
                    <input type="file" name="imagem" class="from-control-file mt-2 px-4 py-2 shadow rounded" />
                </div>
                <div class="flex flex-col mb-4">
                    <label>Legenda da imagem
                        <span class="block text-xs font-light text-stone-400">Texto que aparecerá em baixo da
                            imagem</span>
                    </label>
                    <input type="text" name="legenda_imagem" class="mt-2 px-4 py-2 shadow rounded" />
                </div>

                <div class="tags border-y-2 p-3">
                    <p class="text-sm p-1 mt-2 text-muted">A quais tags pertencerão esta notícia?</p>
                    @foreach ($tags as $tag)
                    <div class="flex items-center mt-3">
                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="form-check-input mr-2">
                        <label>{{ $tag->name }}</label>
                    </div>
                @endforeach
                </div>
                <div class="mt-6 flex gap-6">
                    <button type="submit"
                        class="rounded-full bg-blue-500 py-4 px-10 font-bold container transition text-white shadow hover:bg-blue-600">Criar</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
