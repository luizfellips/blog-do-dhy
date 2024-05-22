<script>
    let today = new Date();
    let currentMonth = today.getMonth();
    const monthNames = ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto",
        "Setembro", "Outubro", "Novembro", "Dezembro"
    ];
    const agendaData = {!! json_encode($agenda->toArray(), JSON_HEX_TAG) !!};

    function getDaysInMonth(year, month) {
        return new Date(year, month + 1, 0).getDate();
    }

    function processCellsAndRows(year, month, daysInMonth) {
        const tableBody = document.getElementById("calendario").getElementsByTagName('tbody')[0];
        tableBody.innerHTML = '';

        let dayCounter = 1;

        for (let i = 0; i < 6; i++) {
            const row = createRow(tableBody, i);

            for (let j = 0; j < 7; j++) {
                const cell = createCell(row, j);

                if (shouldClearCell(i, j, year, month)) {
                    clearCellContent(cell);
                } else if (dayCounter <= daysInMonth) {
                    renderCellContent(cell, dayCounter);

                    const agendaForDay = findAgendaForDay(dayCounter);

                    if (agendaForDay.length > 0) {
                        setCellAttributes(cell, agendaForDay);
                    }
                    dayCounter++;
                }
            }
        }
    }

    function createRow(tableBody, index) {
        return tableBody.insertRow(index);
    }

    function createCell(row, index) {
        return row.insertCell(index);
    }

    function shouldClearCell(row, column, year, month) {
        return row === 0 && column < new Date(year, month, 1).getDay();
    }

    function clearCellContent(cell) {
        cell.innerHTML = '';
    }

    function renderCellContent(cell, day) {
        cell.innerHTML = day;
    }

    function findAgendaForDay(day) {
        return agendaData.filter(item => {
            const agendaDate = new Date(item.data);
            return agendaDate.getDate() === day && agendaDate.getMonth() === currentMonth;
        });
    }

    function setCellAttributes(cell, agendaForDay) {
        cell.classList.add('active');
        cell.classList.add('isDelete');
        cell.setAttribute('data-toggle', 'modal');
        cell.setAttribute('data-target', '#agendaModal');

        // Create an array to store unique attribute values
        let ids = [];
        let titles = [];
        let dates = [];
        let descriptions = [];

        agendaForDay.forEach(element => {
            // Store unique attribute values in arrays
            ids.push(element.id);
            titles.push(element.titulo);
            dates.push(element.data);
            descriptions.push(element.descricao);
        });

        // Set attribute values using the unique values from arrays
        cell.setAttribute('data-id', ids.join(', '));
        cell.setAttribute('data-title', titles.join(', '));
        cell.setAttribute('data-date', dates.join(', '));
        cell.setAttribute('data-description', descriptions.join(', '));
    }

    function populateCalendar(monthName) {
        var today = new Date();
        var year = today.getFullYear();
        var daysInMonth = getDaysInMonth(year, currentMonth);

        processCellsAndRows(year, currentMonth, daysInMonth);

        document.querySelector(".calendar-title h1").textContent = monthName;
        document.querySelector(".calendar-title").classList.add("isDelete");
    }


    function openModal(event) {
        const cell = event.target;
        const ids = cell.getAttribute('data-id').split(", ");
        const titles = cell.getAttribute('data-title').split(", ");
        const dates = cell.getAttribute('data-date').split(", ");
        const descriptions = cell.getAttribute('data-description').split(", ");

        updateModalContent(ids, titles, dates, descriptions);
        showAgendaModal();
    }

    function formatDate(date) {
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();
        return `${day}/${month}/${year}`;
    }

    function formatTime(date) {
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        return `${hours}:${minutes}`;
    }

    function updateModalContent(ids, titles, dates, descriptions) {
        for (let index = 0; index < titles.length; index++) {
            const itemClass = `item-${index + 1}`;
            const item = document.querySelector(`.${itemClass}`);

            item.classList.remove('d-none');
            item.classList.add('d-flex');
            item.classList.add('border-bottom');

            // Update attributes for modal title, date, and description
            item.querySelector('.modal-title').textContent = titles[index];
            item.querySelector('.data').textContent = formatDate(new Date(dates[index]));
            item.querySelector('.horario').textContent = formatTime(new Date(dates[index]));
            item.querySelector('.modal-body').textContent = descriptions[index];

            let form = document.getElementById(`deleteForm-${ids[index]}`);
            if (!form) {
                // Create form element
                form = document.createElement('form');
                form.setAttribute('method', 'POST');
                form.setAttribute('id', `deleteForm-${ids[index]}`);
                item.classList.add('d-flex', 'align-items-center');


                // Add CSRF token
                const csrfTokenInput = document.createElement('input');
                csrfTokenInput.setAttribute('type', 'hidden');
                csrfTokenInput.setAttribute('name', '_token');
                csrfTokenInput.setAttribute('value', '{{ csrf_token() }}');
                form.appendChild(csrfTokenInput);
                // You can set actionUrl here if it's available in the scope of this function

                // Add method spoofing for DELETE request
                const methodInput = document.createElement('input');
                methodInput.setAttribute('type', 'hidden');
                methodInput.setAttribute('name', '_method');
                methodInput.setAttribute('value', 'DELETE');
                form.appendChild(methodInput);

                var actionUrl = '{{ route('agenda.destroy', ['id' => ':id']) }}';
                actionUrl = actionUrl.replace(':id', ids[index]);
                form.setAttribute('action', actionUrl);

                // Create delete button
                const deleteButton = document.createElement('button');
                deleteButton.textContent = 'Delete';
                deleteButton.classList.add('btn', 'btn-danger', 'delete-button', 'm-2', 'd-flex');
                // Add event listener to delete button
                deleteButton.addEventListener('click', () => {
                    // Submit the form when delete button is clicked
                    form.submit();
                });

                // Append delete button to form
                form.appendChild(deleteButton);

                // Append form to item
                item.appendChild(form);
            }
        }
    }

    function showAgendaModal() {
        $('#agendaModal').modal('show');
    }

    function hideModal() {
        $('#agendaModal').modal('hide');
    }

    function previousMonth() {
        if (currentMonth > 0) {
            currentMonth--;
            prepareData(monthNames[currentMonth]);
        }
    }

    function nextMonth() {
        if (currentMonth < 11) {
            currentMonth++;
            prepareData(monthNames[currentMonth]);
        }
    }

    document.addEventListener("DOMContentLoaded", function() {
        prepareData(monthNames[currentMonth]);

        $('#agendaModal').on('hidden.bs.modal', function() {
            const items = document.querySelectorAll('.item');
            items.forEach(item => {
                item.classList.remove('d-flex');
                item.classList.add('d-none');
            });
        });
    });

    function prepareData(currentMonth) {
        populateCalendar(currentMonth);
        addModalToActiveCells();
    }

    function addModalToActiveCells() {
        var activeCells = document.querySelectorAll("td.active");

        activeCells.forEach(function(cell) {
            cell.addEventListener("click", openModal);
        });
    }
</script>

<x-layout>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/page/agenda.css') }}">
    @endpush


    <div class="container">
        <div class="calendar">
            <h1 class="display-6 text-black text-start">
                Clique em um evento para desmarcá-lo.
            </h1>
            <div class="calendar-title bg-primary-color rounded-4 p-3">
                <h1 class="display-6 text-white">
                </h1>
                <button class="bg-transparent border-0 prev-button" type="button" onclick="previousMonth()">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                </button>
                <button class="bg-transparent border-0 next-button" type="button" onclick="nextMonth()">
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
                    <button type="button" onclick="hideModal()" class="btn btn-primary"
                        data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
</x-layout>
