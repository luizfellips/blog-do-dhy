<x-layout>
    <div class="error-page d-flex justify-content-center align-items-center mt-5">
        <div class="text-center">
            <h1 class="display-5 text-start mt-5">Oops!
            </h1>
            <i class="bi bi-cone-striped display-1"></i>
            <h1 class="fs-4 mb-4">Não foi possível encontrar a página que você está procurando.</h1>
            <a href="{{route('home')}}">
                <button class="btn btn-primary fs-3 rounded-6">Clique aqui para voltar para página inicial</button>
            </a>
        </div>
    </div>
</x-layout>