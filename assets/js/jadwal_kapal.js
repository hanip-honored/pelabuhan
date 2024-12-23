const calendarDates = document.getElementById('calendar-dates');
const monthYear = document.getElementById('month-year');
const prevMonth = document.getElementById('prev-month');
const nextMonth = document.getElementById('next-month');
const scheduleForm = document.getElementById('schedule-form');

let currentDate = new Date();
let schedules = [];

function renderCalendar(date) {
    calendarDates.innerHTML = '';
    const year = date.getFullYear();
    const month = date.getMonth();

    monthYear.textContent = `${date.toLocaleString('default', { month: 'long' })} ${year}`;

    const firstDay = new Date(year, month, 1).getDay();
    const lastDate = new Date(year, month + 1, 0).getDate();

    for (let i = 0; i < firstDay; i++) {
        calendarDates.innerHTML += '<div></div>';
    }

    for (let day = 1; day <= lastDate; day++) {
        const div = document.createElement('div');
        div.textContent = day;

        const scheduleDate = schedules.find(
            (schedule) => new Date(schedule.startTime).toDateString() === new Date(year, month, day).toDateString()
        );

        if (scheduleDate) {
            div.classList.add('has-schedule');
        }

        calendarDates.appendChild(div);
    }
}

scheduleForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const shipName = document.getElementById('ship-name').value;
    const startTime = document.getElementById('start-time').value;
    const endTime = document.getElementById('end-time').value;
    const operationType = document.getElementById('operation-type').value;

    schedules.push({
        shipName,
        startTime,
        endTime,
        operationType,
    });

    renderCalendar(currentDate);
    alert('Jadwal berhasil ditambahkan!');
});

prevMonth.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    renderCalendar(currentDate);
});

nextMonth.addEventListener('click', () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    renderCalendar(currentDate);
});

renderCalendar(currentDate);