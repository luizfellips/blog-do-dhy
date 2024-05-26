

<x-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/page/agenda.css') }}">
        <script src="{{ asset('js/agenda.js') }}"></script>
    @endpush

    <script>
        // Usage example:
        const agendaData = {!! json_encode($agenda->toArray(), JSON_HEX_TAG) !!};
        const monthNames = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro",
            "Outubro", "Novembro", "Dezembro"
        ];
    
        const calendar = new Calendar(agendaData, monthNames);
    </script>

    <div class="container">
        <div class="calendar">
            <h1 class="display-6 text-black text-start">
                Agenda
            </h1>
            <div class="calendar-title bg-primary-color rounded-4 p-3">
                <h1 class="display-6 text-white">
                </h1>
                <button class="bg-transparent border-0 prev-button" type="button" onclick="calendar.previousMonth()">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="bg-transparent border-0 next-button" type="button" onclick="calendar.nextMonth()">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                </button>
            </div>
            <table class="table-responsive" id="calendario">
                <thead>
                    <tr>
                        <th class="d-none d-md-table-cell">Dom</th>
                        <th class="d-none d-md-table-cell">Seg</th>
                        <th class="d-none d-md-table-cell">Ter</th>
                        <th class="d-none d-md-table-cell">Qua</th>
                        <th class="d-none d-md-table-cell">Qui</th>
                        <th class="d-none d-md-table-cell">Sex</th>
                        <th class="d-none d-md-table-cell">Sab</th>
                        <th class="d-table-cell d-md-none">D</th>
                        <th class="d-table-cell d-md-none">S</th>
                        <th class="d-table-cell d-md-none">T</th>
                        <th class="d-table-cell d-md-none">Q</th>
                        <th class="d-table-cell d-md-none">Q</th>
                        <th class="d-table-cell d-md-none">S</th>
                        <th class="d-table-cell d-md-none">S</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Popule os dias dinamicamente com JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <div id="agendaModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="confirmationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="item item-1 d-none">
                    <div class="modal-header border-0 d-flex flex-column">
                        <h5 class="modal-title"></h5>
                        <p class="m-0 data"></p>
                        <p class="horario"></p>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
                <div class="item item-2 d-none">
                    <div class="modal-header border-0 d-flex flex-column">
                        <h5 class="modal-title"></h5>
                        <p class="m-0 data"></p>
                        <p class="horario"></p>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
                <div class="item item-3 d-none">
                    <div class="modal-header border-0 d-flex flex-column">
                        <h5 class="modal-title"></h5>
                        <p class="m-0 data"></p>
                        <p class="horario"></p>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
                <div class="item item-4 d-none">
                    <div class="modal-header border-0 d-flex flex-column">
                        <h5 class="modal-title"></h5>
                        <p class="m-0 data"></p>
                        <p class="horario"></p>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
                <div class="item item-5 d-none">
                    <div class="modal-header border-0 d-flex flex-column">
                        <h5 class="modal-title"></h5>
                        <p class="m-0 data"></p>
                        <p class="horario"></p>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
                <div class="item item-6 d-none">
                    <div class="modal-header border-0 d-flex flex-column">
                        <h5 class="modal-title"></h5>
                        <p class="m-0 data"></p>
                        <p class="horario"></p>
                    </div>
                    <div class="modal-body">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="calendar.hideModal()" class="btn btn-primary"
                        data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</x-layout>
