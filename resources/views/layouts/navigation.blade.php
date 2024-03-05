<!--navbar-->
<nav class="navbar navbar-expand-lg fixed-top bg-primary-color" id="navbar">
    <div class="container py-2 align-items-center">
        <a href="#" class="navbar-brand primary-color">
            <h1 class="display-5 mb-0">Blog Do Dhy</h1>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-items"
            aria-controls="navbar-items" aria-expanded="false" aria-label="Toggle Navigation">
            <i class="bi bi-list"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbar-items">
            <ul class="navbar-nav justify-content-end mb-3 mb-lg-0">
                <li class="nav-item fs-5">
                    <a href="{{route('home')}}" class="nav-link active" aria-current="page">Início</a>
                </li>
                <li class="nav-item fs-5">
                    <a href="agenda.html" class="nav-link">Agenda</a>
                </li>
                <li class="nav-item fs-5">
                    <a href="redes-sociais.html" class="nav-link">Redes Sociais</a>
                </li>
                <li class="nav-item fs-5">
                    <a href="videos.html" class="nav-link">Vídeos</a>
                </li>
                <li class="nav-item dropdown search-button">
                    <button class="btn rounded-6" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-search fs-5"></i>
                    </button>
                    <form class="dropdown-menu px-2 py-0">
                        <div class="row">
                            <input type="text" class="form-control col m-2" id="search" placeholder="Busca">
                            <button type="submit" class="btn btn-primary rounded-pill m-2 col">Pesquisar</button>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</nav>
