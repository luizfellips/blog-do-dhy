<x-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/page/styles.css') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endpush

    <a href="{{route('dashboard')}}" class="btn btn-primary">Voltar</a>
    <div class="my-4 flex items-center justify-center">
        <div class="p-10 rounded shadow-sm border-2 border-opacity-35 border-blue-700 max-w-lg w-2/3">
            <div class="mb-6 p-10 bg-white -m-10">
                <h1 class="font-bold text-2xl text-gray-700 text-center">Você quer realmente deletar esta notícia? Ela ficará disponível para uma eventual restauração.</h1>
            </div>
            <form action="{{ route('noticia.destroy', ['noticia' => $noticia]) }}" method="POST">
                @csrf
                @method('DELETE')
                <div class="grid grid-cols-1 gap-6">
                    <div class="flex flex-col">
                        <label>Título
                            <span class="block text-xs font-light text-stone-400">O título da notícia</span>
                        </label>
                        <input type="text" name="titulo" class="mt-2 px-4 py-2 shadow rounded" value="{{$noticia->titulo}}" />
                    </div>
                    <div class="flex flex-col mb-4">
                        <label>Subtítulo
                            <span class="block text-xs font-light text-stone-400">O subtítulo da notícia</span>
                        </label>
                        <input type="text" name="subtitulo" class="mt-2 px-4 py-2 shadow rounded" value="{{$noticia->subtitulo}}" />
                    </div>
                </div>
                <div class="mt-6 flex gap-6">
                    <button type="submit"
                        class="rounded-full bg-blue-500 py-4 px-10 font-bold container transition text-white shadow hover:bg-blue-600">Deletar</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
