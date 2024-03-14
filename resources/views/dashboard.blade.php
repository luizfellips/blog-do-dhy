<x-layout>
    @push('styles')
        <link rel="stylesheet" href="{{asset('css/page/styles.css')}}">
    @endpush
    <div class="container my-5">
        <h1 class="display-5">Gerenciamento de Notícias</h1>
        <div class="opcoes d-flex flex-lg-row flex-column gap-4">
            <a href="{{route('noticia.create')}}" class="btn btn-primary fs-4">Criar notícia</a>
            <a href="#" class="btn btn-primary fs-4">Editar notícia</a>
            <a href="#" class="btn btn-primary fs-4">Editar carrossel de notícias</a>
            <a href="{{route('author.create')}}" class="btn btn-primary fs-4">Registrar autor</a>
            <a href="{{route('tags.create')}}" class="btn btn-primary fs-4">Administrar tags</a>
        </div>
    </div>
    <div class="container my-5">
        <h1 class="display-5">Meu Perfil</h1>
        <div class="opcoes d-flex flex-lg-row flex-column gap-4">
            <a href="#" class="btn btn-primary fs-4">Atualizar senha</a>
            <a href="#" class="btn btn-primary fs-4">Ver contatos de suporte</a>
        </div>
    </div>
</x-layout>
