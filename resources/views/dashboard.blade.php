<x-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/page/styles.css') }}">
    @endpush
    <div class="container my-5">
        <div class="row gx-5">
            <div class="col-lg">
                <h1 class="display-5 my-3">Gerenciamento de Notícias</h1>
                <div class="opcoes d-flex flex-column gap-4">
                    <a href="{{ route('noticia.create') }}" class="btn btn-primary fs-4">Criar notícia</a>
                    <a href="{{ route('noticia.list') }}" class="btn btn-primary fs-4">Editar notícia</a>
                    <a href="{{ route('noticia.carousel') }}" class="btn btn-primary fs-4">Editar carrossel de notícias</a>
                    <a href="{{ route('noticia.trashed') }}" class="btn btn-primary fs-4">Lixeira</a>
                </div>
                <h1 class="display-5 my-3">Autores e Tags</h1>
                <div class="opcoes d-flex flex-column gap-4">
                    <a href="{{ route('author.create') }}" class="btn btn-primary fs-4">Registrar autor</a>
                    <a href="{{ route('tags.create') }}" class="btn btn-primary fs-4">Administrar tags</a>
                </div>
            </div>
            <div class="col-lg">
                <h1 class="display-5 my-3">Meu Perfil</h1>
                <div class="opcoes d-flex flex-lg-row flex-column gap-4">
                    <a href="#" class="btn btn-primary fs-4">Atualizar senha</a>
                    <a href="#" class="btn btn-primary fs-4">Ver contatos de suporte</a>
                    <!-- Authentication -->
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a class="btn btn-primary fs-4 my-5" href="{{route('logout')}}"
                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                        {{ __('Sair') }}
                    </a>
                </form>
            </div>
        </div>
    </div>

</x-layout>
