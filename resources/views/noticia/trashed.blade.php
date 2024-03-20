<script>
    function openRestaurationModal(id) {
        $('#restoreConfirmationModal').modal('show');
        $('#confirmRestoreBtn').on('click', function() {
            $('#restoreForm' + id).submit();
        });
    }


    function openDeleteModal(id) {
        $('#deleteConfirmationModal').modal('show');
        $('#confirmDeleteBtn').on('click', function() {
            $('#deleteForm' + id).submit();
        });
    }

    function hideModal() {
        $('#restoreConfirmationModal').modal('hide');
        $('#deleteConfirmationModal').modal('hide');
    }
</script>

<x-layout>
    @push('styles')
        @vite(['resources/css/app.css'])
    @endpush
    <a href="{{ route('dashboard') }}" class="btn btn-primary">Voltar</a>
    <div class="container mt-5">
        <h1 class="display-6 m-3">Lixeira</h1>
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
                        <tr class=" cursor-pointer">
                            <td>{{ $noticia->titulo }}</td>
                            <td>{{ $noticia->author->name }}</td>
                            <td>
                                <div class="flex justify-center align-items-center gap-2 flex-column flex-md-row">
                                    <form id="restoreForm{{ $noticia->id }}"
                                        action="{{ route('noticia.restore', ['noticia' => $noticia->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="button" onclick="openRestaurationModal('{{ $noticia->id }}')"
                                            class="rounded-3 bg-blue-600 text-white p-2 d-flex self-end">Restaurar</button>
                                    </form>
                                    <form id="deleteForm{{ $noticia->id }}"
                                        action="{{ route('noticia.disintegrate', ['noticia' => $noticia->id]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')

                                        <button type="button" onclick="openDeleteModal('{{ $noticia->id }}')"
                                            class="rounded-3 bg-red-600 text-white p-2 d-flex self-end">Desintegrar</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <th> Não há nada na lixeira.
                        </th>
                    </tr>
                @endunless
            </tbody>
        </table>
        <div class="links my-3">
            {{ $noticias->links() }}

        </div>
    </div>

    <div id="deleteConfirmationModal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirmar desintegração</h5>
                </div>
                <div class="modal-body">
                    Você tem certeza que deseja deletar essa notícia permanentemente?
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="hideModal()" class="btn text-white bg-blue-500 hover:bg-blue-600"
                        data-dismiss="modal">Cancelar</button>
                    <button type="button" id="confirmDeleteBtn"
                        class="btn text-white bg-red-500 hover:bg-red-600">Desintegrar</button>
                </div>
            </div>
        </div>
    </div>

    <div id="restoreConfirmationModal" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="confirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmationModalLabel">Confirmar restauração</h5>
                </div>
                <div class="modal-body">
                    Você tem certeza que deseja restaurar essa notícia? Ela voltará a aparecer no site.
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="hideModal()" class="btn text-white bg-red-500 hover:bg-red-600"
                        data-dismiss="modal">Cancelar</button>
                    <button type="button" id="confirmRestoreBtn"
                        class="btn text-white bg-blue-500 hover:bg-blue-600">Restaurar</button>
                </div>
            </div>
        </div>
    </div>
</x-layout>
