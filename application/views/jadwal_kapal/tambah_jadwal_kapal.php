<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal Kapal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .calendar {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 5px;
            margin-bottom: 20px;
        }
        .calendar .day {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
            cursor: pointer;
            background-color: #f9f9f9;
        }
        .calendar .day:hover {
            background-color: #e0e0e0;
        }
        .calendar .selected {
            background-color: #007bff;
            color: #fff;
        }
    </style>
    <script>
        let startDate = null;
        let endDate = null;

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

            // Mengisi input waktu_masuk dan waktu_keluar dengan startDate dan endDate
            document.getElementById('waktu_masuk').value = startDate + 'T00:00';
            document.getElementById('waktu_keluar').value = endDate + 'T23:59';
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
    </script>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tambah Jadwal Kapal</h1>

        <!-- Kalender -->
        <div class="calendar">
            <script>
                const calendarElement = document.querySelector('.calendar');
                const currentDate = new Date();
                const year = currentDate.getFullYear();
                const month = currentDate.getMonth();
                const daysInMonth = new Date(year, month + 1, 0).getDate();

                for (let day = 1; day <= daysInMonth; day++) {
                    const date = new Date(year, month, day).toISOString().split('T')[0];
                    const dayElement = document.createElement('div');
                    dayElement.className = 'day';
                    dayElement.setAttribute('data-day', date);
                    dayElement.textContent = day;
                    dayElement.onclick = () => selectDate(dayElement);
                    calendarElement.appendChild(dayElement);
                }
            </script>
        </div>

        <!-- Form Tambah Jadwal -->
        <form action="<?php echo site_url('jadwal_kapal/tambah_action'); ?>" method="post">
            <div class="mb-3">
                <label for="nama_kapal" class="form-label">Nama Kapal</label>
                <select class="form-select" id="nama_kapal" name="id_kapal" required>
                    <option value="" disabled selected>Pilih Nama Kapal</option>
                    <?php foreach ($kapal as $k): ?>
                        <option value="<?php echo $k->id_kapal; ?>"><?php echo $k->nama_kapal; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="waktu_masuk" class="form-label">Waktu Masuk</label>
                <input type="datetime-local" class="form-control" id="waktu_masuk" name="waktu_masuk" required>
            </div>
            <div class="mb-3">
                <label for="waktu_keluar" class="form-label">Waktu Keluar</label>
                <input type="datetime-local" class="form-control" id="waktu_keluar" name="waktu_keluar" required>
            </div>

            <div class="mb-3">
                <label for="pelabuhan_asal" class="form-label">Pelabuhan Asal</label>
                <input type="text" class="form-control" id="pelabuhan_asal" name="pelabuhan_asal" required>
            </div>

            <div class="mb-3">
                <label for="pelabuhan_tujuan" class="form-label">Pelabuhan Tujuan</label>
                <input type="text" class="form-control" id="pelabuhan_tujuan" name="pelabuhan_tujuan" required>
            </div>
            
            <div class="mb-3">
                <label for="status_alur" class="form-label">Status Alur</label>
                <select class="form-select" id="status_alur" name="status_alur" required>
                    <option value="" disabled selected>Pilih Status</option>
                    <option value="dijadwalkan">Dijadwalkan</option>
                    <option value="proses">Proses</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" onclick="resetSelection()">Reset Kalender</button>
                <button type="submit" class="btn btn-primary">Tambah Jadwal</button>
            </div>
        </form>
    </div>
</body>
</html>