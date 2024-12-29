let startDate = null;
let endDate = null;
let currentYear = new Date().getFullYear();
let currentMonth = new Date().getMonth();

function renderCalendar() {
    const calendarElement = document.querySelector('.calendar');
    const monthLabel = document.querySelector('.month-label');
    calendarElement.innerHTML = '';

    const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();
    monthLabel.textContent = `${new Date(currentYear, currentMonth).toLocaleString('default', { month: 'long' })} ${currentYear}`;

    for (let day = 1; day <= daysInMonth; day++) {
        const date = `${currentYear}-${String(currentMonth + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        const dayElement = document.createElement('div');
        dayElement.className = 'day';
        dayElement.setAttribute('data-day', date);
        dayElement.textContent = day;
        dayElement.onclick = () => selectDate(dayElement);
        calendarElement.appendChild(dayElement);
    }
    highlightDates();
}

function changeMonth(offset) {
    currentMonth += offset;
    if (currentMonth < 0) {
        currentMonth = 11;
        currentYear--;
    } else if (currentMonth > 11) {
        currentMonth = 0;
        currentYear++;
    }
    renderCalendar();
}

function selectDate(dayElement) {
    const day = dayElement.getAttribute('data-day');

    if (!startDate) {
        startDate = day;
        endDate = day;
    } else if (new Date(day) < new Date(startDate)) {
        startDate = day;
    } else {
        endDate = day;
    }

    highlightDates();
    document.getElementById('waktu_masuk').value = `${startDate}T00:00`;
    document.getElementById('waktu_keluar').value = `${endDate}T23:59`;
}

function highlightDates() {
    const days = document.querySelectorAll('.calendar .day');
    days.forEach(day => {
        const currentDay = day.getAttribute('data-day');
        day.classList.remove('selected');
        if (startDate && endDate && currentDay >= startDate && currentDay <= endDate) {
            day.classList.add('selected');
        }
    });
}

function resetSelection() {
    startDate = null;
    endDate = null;
    highlightDates();
    document.getElementById('waktu_masuk').value = '';
    document.getElementById('waktu_keluar').value = '';
}

document.addEventListener("DOMContentLoaded", renderCalendar);