<script>
    function getDaysInMonth(year, month) {
        return new Date(year, month + 1, 0).getDate();
    }

    function populateCalendar(monthName, data) {
        var tableBody = document.getElementById("calendario").getElementsByTagName('tbody')[0];
        tableBody.innerHTML = '';

        var today = new Date();
        var year = today.getFullYear();
        var month = today.getMonth();
        var currentDay = today.getDate();

        var daysInMonth = getDaysInMonth(year, month);

        var dayCounter = 1;

        for (var i = 0; i < 6; i++) {
            var row = tableBody.insertRow(i);

            for (var j = 0; j < 7; j++) {
                var cell = row.insertCell(j);

                if (i === 0 && j < new Date(year, month, 1).getDay()) {
                    cell.innerHTML = '';

                } else if (dayCounter <= daysInMonth) {
                    cell.innerHTML = dayCounter;

                    var agendaForDay = data.find(function(item) {
                        var agendaDate = new Date(item.data);
                        return agendaDate.getDate() === dayCounter && agendaDate.getMonth() === month;
                    });

                    if (agendaForDay) {
                        cell.classList.add('active');
                        cell.setAttribute('data-toggle', 'modal');
                        cell.setAttribute('data-target', '#agendaModal');

                        // Set the agenda data as attributes on the cell
                        cell.setAttribute('data-title', agendaForDay.titulo);
                        cell.setAttribute('data-date', agendaForDay.data);
                        cell.setAttribute('data-description', agendaForDay.descricao);
                    }

                    dayCounter++;
                }
            }
        }

        document.querySelector(".calendar-title h1").textContent = monthName;
    }

    function openModal(id) {
        var cell = event.target;
        var title = cell.getAttribute('data-title');
        var date = cell.getAttribute('data-date');
        var description = cell.getAttribute('data-description');
        var agendaDate = new Date(date);
        var day = agendaDate.getDate();
        var month = agendaDate.getMonth() + 1; // Months are zero-based, so add 1
        var year = agendaDate.getFullYear();
        var hours = agendaDate.getHours();
        var minutes = agendaDate.getMinutes();


        // Format  day, month, year, hours and minutes to have leading zeros if necessary
        hours = hours < 10 ? '0' + hours : hours;
        minutes = minutes < 10 ? '0' + minutes : minutes;
        day = day < 10 ? '0' + day : day;
        month = month < 10 ? '0' + month : month;

        // Construct the time and formatted date string
        var time = hours + ':' + minutes;
        var formattedDate = day + '/' + month + '/' + year;

        var modalTitle = document.querySelector(".modal-title");
        var modalDate = document.querySelector(".data");
        var modalDescription = document.querySelector(".modal-body");
        var modalTime = document.querySelector(".horario");

        modalTitle.textContent = title;
        modalDate.textContent = formattedDate;
        modalTime.textContent = time;
        modalDescription.textContent = description;
        $('#agendaModal').modal('show');
    }

    function hideModal() {
        $('#agendaModal').modal('hide');
    }

    document.addEventListener("DOMContentLoaded", function() {
        var monthNames = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto",
            "Setembro", "Outubro", "Novembro", "Dezembro"
        ];

        var today = new Date();
        var currentMonthName = monthNames[today.getMonth()];
        var data = {!! json_encode($agenda->toArray(), JSON_HEX_TAG) !!};

        populateCalendar(currentMonthName, data);

        var activeCells = document.querySelectorAll("td.active");

        activeCells.forEach(function(cell) {
            cell.addEventListener("click", openModal);
        });
    });
</script>

<x-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/page/agenda.css') }}">
    @endpush


    <div class="container">
        <div class="calendar">
            <h1 class="display-6 text-black text-start">
                Agenda
            </h1>
            <div class="calendar-title bg-primary-color rounded-4 p-3">
                <h1 class="display-6 text-white">
                </h1>
            </div>
            <table class="table-responsive" id="calendario">
                <thead>
                    <tr>
                        <th>Dom</th>
                        <th>Seg</th>
                        <th>Ter</th>
                        <th>Qua</th>
                        <th>Qui</th>
                        <th>Sex</th>
                        <th>Sab</th>
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
                <div class="modal-header d-flex flex-column">
                    <h5 class="modal-title" id="confirmationModalLabel">Reunião com Lula</h5>
                    <p class="m-0 data">12/05/2024</p>
                    <p class="horario">15:00</p>
                </div>
                <div class="modal-body">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Lorem ipsum dolor sit amet consectetur
                    adipisicing elit.
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="hideModal()" class="btn text-white bg-red-500 hover:bg-red-600"
                        data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</x-layout>
