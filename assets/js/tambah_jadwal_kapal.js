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

// Highlight range based on start and end dates
function highlightRange() {
    const startTimeValue = document.getElementById("start-time").value;
    const endTimeValue = document.getElementById("end-time").value;

    // Clear all highlights
    const dayElements = calendarDates.querySelectorAll("div");
    dayElements.forEach((day) => {
        day.classList.remove("selected", "in-range");
    });

    if (!startTimeValue) return;

    const startTime = new Date(startTimeValue);
    const endTime = endTimeValue ? new Date(endTimeValue) : null;

    dayElements.forEach((day) => {
        const dayDate = new Date(day.dataset.date);

        if (dayDate.toDateString() === startTime.toDateString()) {
            // Highlight only the start date
            day.classList.add("selected");
        } else if (endTime && dayDate >= startTime && dayDate <= endTime) {
            // Highlight range if end date is selected
            day.classList.add("in-range");
        }
    });
}

// Event listeners for start and end time inputs
document.getElementById("start-time").addEventListener("change", () => {
    highlightRange();
});

document.getElementById("end-time").addEventListener("change", () => {
    highlightRange();
});

// Initialize calendar
generateCalendar(currentDate);