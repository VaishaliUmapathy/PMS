const calendarDates = document.getElementById('calendarDates');
const currentMonthYear = document.getElementById('currentMonthYear');

let currentDate = new Date();

function renderCalendar() {
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();

    // Set the month and year header
    currentMonthYear.innerText = `${currentDate.toLocaleString('default', { month: 'long' })} ${year}`;

    // Clear previous dates
    calendarDates.innerHTML = '';

    // Get the first day of the month and the last day of the month
    const firstDay = new Date(year, month, 1);
    const lastDay = new Date(year, month + 1, 0); 

    // Fill the calendar with empty divs for days before the first day
    for (let i = 0; i < firstDay.getDay(); i++) {
        calendarDates.innerHTML += '<div class="date"></div>'; // Empty divs for days before the first day
    }

    // Fill the calendar with the correct number of days
    for (let day = 1; day <= lastDay.getDate(); day++) {
        const dateDiv = document.createElement('div');
        dateDiv.classList.add('date');
        dateDiv.innerText = day;

        // Check if the current day matches today's date
        if (day === new Date().getDate() && month === new Date().getMonth() && year === new Date().getFullYear()) {
            dateDiv.classList.add('today');
        }

        calendarDates.appendChild(dateDiv);
    }
}

// Functions to change the month and year
function changeMonth(direction) {
    currentDate.setMonth(currentDate.getMonth() + direction);
    renderCalendar();
}

function changeYear(direction) {
    currentDate.setFullYear(currentDate.getFullYear() + direction);
    renderCalendar();
}

// Initial rendering of the calendar
renderCalendar();
