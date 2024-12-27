const calendarDates = document.getElementById("calendar-dates");
const monthYear = document.getElementById("month-year");
let currentDate = new Date();

function generateCalendar(date) {
    const firstDay = new Date(date.getFullYear(), date.getMonth(), 1).getDay();
    const daysInMonth = new Date(date.getFullYear(), date.getMonth() + 1, 0).getDate();

    calendarDates.innerHTML = "";

    // Fill empty slots before the first day
    for (let i = 0; i < firstDay; i++) {
        const emptyDiv = document.createElement("div");
        calendarDates.appendChild(emptyDiv);
    }

    // Fill days of the month
    for (let day = 1; day <= daysInMonth; day++) {
        const dayDiv = document.createElement("div");
        dayDiv.textContent = day;
        dayDiv.dataset.date = new Date(date.getFullYear(), date.getMonth(), day).toISOString();
        calendarDates.appendChild(dayDiv);
    }

    monthYear.textContent = date.toLocaleString("default", { month: "long", year: "numeric" });
}

function highlightRange() {
    const startTime = new Date(document.getElementById("start-time").value || null);
    const endTime = new Date(document.getElementById("end-time").value || null);

    const dayElements = calendarDates.querySelectorAll("div");
    dayElements.forEach((day) => {
        const dayDate = new Date(day.dataset.date || null);
        day.classList.remove("selected", "in-range");

        if (dayDate.toDateString() === startTime.toDateString()) {
            day.classList.add("selected");
        } else if (endTime && dayDate >= startTime && dayDate <= endTime) {
            day.classList.add("in-range");
        }
    });
}

// Event listeners
document.getElementById("start-time").addEventListener("change", highlightRange);
document.getElementById("end-time").addEventListener("change", highlightRange);

document.getElementById("prev-month").addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() - 1);
    generateCalendar(currentDate);
    highlightRange();
});

document.getElementById("next-month").addEventListener("click", () => {
    currentDate.setMonth(currentDate.getMonth() + 1);
    generateCalendar(currentDate);
    highlightRange();
});

// Initialize
generateCalendar(currentDate);
