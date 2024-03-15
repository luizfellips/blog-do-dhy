<x-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/page/styles.css') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @endpush
    <a href="{{ route('dashboard') }}" class="btn btn-primary">Voltar</a>
    <div class="my-4 flex items-center justify-center">
        <div class="p-10 rounded shadow-sm border-2 border-opacity-35 border-blue-700 max-w-lg w-2/3">
            <div class="mb-6 p-10 bg-white -m-10">
                <h1 class="font-bold text-2xl text-gray-700 text-center">Registrar um novo autor</h1>
            </div>
            <div class="grid grid-cols-1 gap-6">
                <div class="flex flex-col">
                    <p class="text-lg p-2">Autores registrados</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Profissão</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($authors as $author)
                                <tr>
                                    <td>{{ $author->name }}</td>
                                    <td>{{ $author->job }}</td>
                                    <td>
                                        <form action="{{ route('author.show', ['author' => $author->id]) }}"
                                            method="get">
                                            @csrf
                                            <button type="submit"
                                                class="rounded-3 bg-blue-600 text-white p-1 d-flex self-end">Listar notícias</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <form action="{{ route('author.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 gap-6">
                    <div class="flex flex-col">
                        <label>Nome do autor
                            <span class="block text-xs font-light text-stone-400">O nome do autor</span>
                        </label>
                        <input type="text" name="name" class="mt-2 px-4 py-2 shadow rounded" />
                    </div>
                    <div class="flex flex-col mb-4">
                        <label>Profissão
                            <span class="block text-xs font-light text-stone-400">A profissão do autor</span>
                        </label>
                        <input type="text" name="job" class="mt-2 px-4 py-2 shadow rounded" />
                    </div>
                </div>

                <div class="mt-6 flex gap-6">
                    <button type="submit"
                        class="rounded-full bg-blue-500 py-4 px-10 font-bold container transition text-white shadow hover:bg-blue-600">Registrar</button>
                </div>
            </form>
        </div>
    </div>
</x-layout>
