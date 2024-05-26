class Calendar {
    constructor(agendaData, monthNames) {
        this.today = new Date();
        this.currentMonth = this.today.getMonth();
        this.agendaData = agendaData;
        this.monthNames = monthNames;
        this.init();
    }

    init() {
        document.addEventListener("DOMContentLoaded", () => {
            this.prepareData(this.monthNames[this.currentMonth]);

            $('#agendaModal').on('hidden.bs.modal', () => {
                const items = document.querySelectorAll('.item');
                items.forEach(item => {
                    item.classList.remove('d-flex');
                    item.classList.add('d-none');
                });
            });
        });
    }

    getDaysInMonth(year, month) {
        return new Date(year, month + 1, 0).getDate();
    }

    processCellsAndRows(year, month, daysInMonth) {
        const tableBody = document.getElementById("calendario").getElementsByTagName('tbody')[0];
        tableBody.innerHTML = '';

        let dayCounter = 1;

        for (let i = 0; i < 6; i++) {
            const row = this.createRow(tableBody, i);

            for (let j = 0; j < 7; j++) {
                const cell = this.createCell(row, j);

                if (this.shouldClearCell(i, j, year, month)) {
                    this.clearCellContent(cell);
                } else if (dayCounter <= daysInMonth) {
                    this.renderCellContent(cell, dayCounter);

                    const agendaForDay = this.findAgendaForDay(dayCounter);

                    if (agendaForDay.length > 0) {
                        this.setCellAttributes(cell, agendaForDay);
                    }
                    dayCounter++;
                }
            }
        }
    }

    createRow(tableBody, index) {
        return tableBody.insertRow(index);
    }

    createCell(row, index) {
        return row.insertCell(index);
    }

    shouldClearCell(row, column, year, month) {
        return row === 0 && column < new Date(year, month, 1).getDay();
    }

    clearCellContent(cell) {
        cell.innerHTML = '';
    }

    renderCellContent(cell, day) {
        cell.innerHTML = day;
    }

    findAgendaForDay(day) {
        return this.agendaData.filter(item => {
            const agendaDate = new Date(item.data);
            return agendaDate.getDate() === day && agendaDate.getMonth() === this.currentMonth;
        });
    }

    setCellAttributes(cell, agendaForDay) {
        cell.classList.add('active');
        cell.setAttribute('data-toggle', 'modal');
        cell.setAttribute('data-target', '#agendaModal');

        let titles = [];
        let dates = [];
        let descriptions = [];

        agendaForDay.forEach(element => {
            titles.push(element.titulo);
            dates.push(element.data);
            descriptions.push(element.descricao);
        });

        cell.setAttribute('data-title', titles.join(', '));
        cell.setAttribute('data-date', dates.join(', '));
        cell.setAttribute('data-description', descriptions.join(', '));
    }

    populateCalendar(monthName) {
        var today = new Date();
        var year = today.getFullYear();
        var daysInMonth = this.getDaysInMonth(year, this.currentMonth);

        this.processCellsAndRows(year, this.currentMonth, daysInMonth);

        document.querySelector(".calendar-title h1").textContent = monthName;
    }

    openModal(event) {
        const cell = event.target;
        const titles = cell.getAttribute('data-title').split(", ");
        const dates = cell.getAttribute('data-date').split(", ");
        const descriptions = cell.getAttribute('data-description').split(", ");

        this.updateModalContent(titles, dates, descriptions);
        this.showAgendaModal();
    }

    formatDate(date) {
        const day = String(date.getDate()).padStart(2, '0');
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const year = date.getFullYear();
        return `${day}/${month}/${year}`;
    }

    formatTime(date) {
        const hours = String(date.getHours()).padStart(2, '0');
        const minutes = String(date.getMinutes()).padStart(2, '0');
        return `${hours}:${minutes}`;
    }

    updateModalContent(titles, dates, descriptions) {
        for (let index = 0; index < titles.length; index++) {
            const itemClass = `item-${index + 1}`;
            const item = document.querySelector(`.${itemClass}`);

            item.classList.remove('d-none');
            item.classList.add('d-flex');
            item.classList.add('border-bottom');

            item.querySelector('.modal-title').textContent = titles[index];
            item.querySelector('.data').textContent = this.formatDate(new Date(dates[index]));
            item.querySelector('.horario').textContent = this.formatTime(new Date(dates[index]));
            item.querySelector('.modal-body').textContent = descriptions[index];
        }
    }

    showAgendaModal() {
        $('#agendaModal').modal('show');
    }

    hideModal() {
        $('#agendaModal').modal('hide');
    }

    previousMonth() {
        if (this.currentMonth > 0) {
            this.currentMonth--;
            this.prepareData(this.monthNames[this.currentMonth]);
        }
    }

    nextMonth() {
        if (this.currentMonth < 11) {
            this.currentMonth++;
            this.prepareData(this.monthNames[this.currentMonth]);
        }
    }

    prepareData(currentMonth) {
        this.populateCalendar(currentMonth);
        this.addModalToActiveCells();
    }

    addModalToActiveCells() {
        var activeCells = document.querySelectorAll("td.active");

        activeCells.forEach(cell => {
            cell.addEventListener("click", this.openModal.bind(this));
        });
    }
}