<x-layout>
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/page/dashboard.css') }}">
    @endpush
    <h1 class="display-6 m-5">Dashboard do administrador</h1>
    <div class="container my-5">
        <div class="row gx-5">
            <div class="col-lg">
                <div class="accordion" id="newsAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="newsHeading">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#newsCollapse" aria-expanded="false" aria-controls="newsCollapse">
                                Gerenciamento de Notícias
                            </button>
                        </h2>
                        <div id="newsCollapse" class="accordion-collapse collapse" aria-labelledby="newsHeading" data-bs-parent="#newsAccordion">
                            <div class="accordion-body d-flex flex-column flex-md-row justify-content-center">
                                <a href="{{ route('noticia.create') }}" class="btn btn-primary fs-5 my-2 mx-md-2">Criar notícia</a>
                                <a href="{{ route('noticia.list') }}" class="btn btn-primary fs-5 my-2 mx-md-2">Editar notícia</a>
                                <a href="{{ route('noticia.carousel') }}" class="btn btn-primary fs-5 my-2 mx-md-2">Editar carrossel de notícias</a>
                                <a href="{{ route('noticia.trashed') }}" class="btn btn-primary fs-5 my-2 mx-md-2">Lixeira</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion my-3" id="authorsTagsAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="authorsTagsHeading">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#authorsTagsCollapse" aria-expanded="false" aria-controls="authorsTagsCollapse">
                                Autores e Tags
                            </button>
                        </h2>
                        <div id="authorsTagsCollapse" class="accordion-collapse collapse" aria-labelledby="authorsTagsHeading" data-bs-parent="#authorsTagsAccordion">
                            <div class="accordion-body d-flex flex-column flex-md-row justify-content-center">
                                <a href="{{ route('author.create') }}" class="btn btn-primary fs-5 my-2 mx-md-2">Registrar autor</a>
                                <a href="{{ route('tags.create') }}" class="btn btn-primary fs-5 my-2 mx-md-2">Administrar tags</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg">
                <div class="accordion mb-3" id="agendaAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="agendaHeading">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#agendaCollapse" aria-expanded="false" aria-controls="agendaCollapse">
                                Agenda
                            </button>
                        </h2>
                        <div id="agendaCollapse" class="accordion-collapse collapse" aria-labelledby="agendaHeading" data-bs-parent="#agendaAccordion">
                            <div class="accordion-body d-flex flex-column flex-md-row justify-content-center">
                                <a href="{{ route('agenda.create') }}" class="btn btn-primary fs-5 my-2 mx-md-2">Agendar evento</a>
                                <a href="{{ route('agenda.delete') }}" class="btn btn-primary fs-5 my-2 mx-md-2">Desmarcar evento</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion" id="profileAccordion">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="profileHeading">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#profileCollapse" aria-expanded="false" aria-controls="profileCollapse">
                                Meu Perfil
                            </button>
                        </h2>
                        <div id="profileCollapse" class="accordion-collapse collapse" aria-labelledby="profileHeading" data-bs-parent="#profileAccordion">
                            <div class="accordion-body d-flex flex-column flex-md-row justify-content-center align-items-center">
                                <a href="#" class="btn btn-primary fs-5 my-2 mx-md-2">Atualizar senha</a>
                                <a href="#" class="btn btn-primary fs-5 my-2 mx-md-2">Ver contatos de suporte</a>
                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button class="btn btn-primary fs-5">{{ __('Sair') }}</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layout>