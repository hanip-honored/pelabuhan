const days = ["sunday", "monday", "tuesday", "wednesday", "thursday", "friday", "saturday"];

    days.forEach(day => {
      const container = document.getElementById(day);
      addDefaultSlot(container);
    });

    function addDefaultSlot(container) {
      const div = document.createElement('div');
      div.className = 'time-slot';

      const timeInput = document.createElement('input');
      timeInput.type = 'time';
      timeInput.value = '04:00'; // Default time
      div.appendChild(timeInput);

      const deleteButton = document.createElement('button');
      deleteButton.textContent = 'Delete';
      deleteButton.onclick = () => container.removeChild(div);
      div.appendChild(deleteButton);

      container.appendChild(div);
    }