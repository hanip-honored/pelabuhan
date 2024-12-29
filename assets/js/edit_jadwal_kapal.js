let startDate = null;
let endDate = null;

function selectDate(dayElement) {
    const day = dayElement.getAttribute('data-day'); // Format tanggal 'YYYY-MM-DD'

    if (!startDate) {
        startDate = day;
        endDate = day;
    } else if (day < startDate) {
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

function initializeCalendar(waktuMasuk, waktuKeluar) {
    startDate = waktuMasuk ? waktuMasuk.split('T')[0] : null;
    endDate = waktuKeluar ? waktuKeluar.split('T')[0] : null;
    highlightDates();
}

document.addEventListener("DOMContentLoaded", function () {
    const calendarElement = document.querySelector('.calendar');
    const currentDate = new Date();
    const year = currentDate.getFullYear();
    const month = currentDate.getMonth();
    const daysInMonth = new Date(year, month + 1, 0).getDate();

    for (let day = 1; day <= daysInMonth; day++) {
        const date = `${year}-${String(month + 1).padStart(2, '0')}-${String(day).padStart(2, '0')}`;
        const dayElement = document.createElement('div');
        dayElement.className = 'day';
        dayElement.setAttribute('data-day', date);
        dayElement.textContent = day;
        dayElement.onclick = () => selectDate(dayElement);
        calendarElement.appendChild(dayElement);
    }

    const waktuMasuk = document.getElementById('waktu_masuk').value;
    const waktuKeluar = document.getElementById('waktu_keluar').value;
    initializeCalendar(waktuMasuk, waktuKeluar);
});