<!--navbar-->
<nav class="navbar navbar-expand-lg fixed-top bg-primary-color" id="navbar">
    <div class="container py-2 align-items-center">
        <a href="{{route('home')}}" class="navbar-brand primary-color">
            <h1 class="display-5 mb-0">Portal de Notícias</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-items"
            aria-controls="navbar-items" aria-expanded="false" aria-label="Toggle Navigation">
            <i class="bi bi-list"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbar-items">
            <ul class="navbar-nav justify-content-end mb-3 mb-lg-0">
                <li class="nav-item fs-5">
                    <a href="{{route('home')}}" class="nav-link {{ Request::route() && Request::route()->getName() === 'home' ? 'active' : '' }}" aria-current="page">Início</a>
                </li>
                <li class="nav-item fs-5">
                    <a href="{{route('agenda.index')}}" class="nav-link {{ Request::route() && Request::route()->getName() === 'agenda.index' ? 'active' : '' }}" class="nav-link">Agenda</a>
                </li>
                <li class="nav-item fs-5">
                    <a href="redes-sociais.html" class="nav-link">Redes Sociais</a>
                </li>
                <li class="nav-item fs-5">
                    <a href="videos.html" class="nav-link">Vídeos</a>
                </li>
                @auth
                <li class="nav-item fs-5">
                    <a href="{{route('dashboard')}}" class="nav-link {{ Request::route() && Request::route()->getName() === 'dashboard' ? 'active' : '' }}">Dashboard</a>
                </li>
                @endauth
                <li class="nav-item dropdown search-button">
                    <button class="btn rounded-6" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-search fs-5"></i>
                    </button>
                    <form action="{{route('noticia.searchResults')}}" class="dropdown-menu px-2 py-0" method="GET">
                        <div class="row">
                            <input type="text" name="search" class="form-control col m-2" id="search" placeholder="Busca">
                            <button type="submit" class="btn btn-primary rounded-pill m-2 col">Pesquisar</button>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
