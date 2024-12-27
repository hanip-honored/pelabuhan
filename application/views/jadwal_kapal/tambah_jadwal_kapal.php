<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjadwalan Kapal</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/jadwal_kapal.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php $this->load->view('sidebar'); ?>
    <div class="main-content">
        <div class="container">
            <h1>Penjadwalan Kapal</h1>
    
            <!-- Kalender -->
            <div class="calendar">
                <div class="calendar-header">
                    <button id="prev-month" class="btn-small">&lt;</button>
                    <h2 id="month-year">December 2024</h2>
                    <button id="next-month" class="btn-small">&gt;</button>
                </div>
                <div class="calendar-days">
                    <div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div>
                </div>
                <div class="calendar-dates" id="calendar-dates">
                    <!-- Tanggal akan dihasilkan secara dinamis -->
                </div>
            </div>
    
            <!-- Form Tambah Jadwal -->
            <div class="schedule-form">
                <h2>Tambah Jadwal</h2>
                <form id="schedule-form">
                    <label for="ship-name">Nama Kapal</label>
                    <input type="text" id="ship-name" placeholder="Masukkan nama kapal" required>
    
                    <label for="start-time">Waktu Mulai</label>
                    <input type="datetime-local" id="start-time" required>
    
                    <label for="end-time">Waktu Selesai</label>
                    <input type="datetime-local" id="end-time" required>
    
                    <label for="operation-type">Jenis Operasi</label>
                    <select id="operation-type" required>
                        <option value="bongkar muat">Bongkar Muat</option>
                        <option value="pemeriksaan">Pemeriksaan</option>
                        <option value="perawatan">Perawatan</option>
                    </select>
    
                    <button type="submit" class="btn">Tambah Jadwal</button>
                </form>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/js/jadwal_kapal.js'); ?>"></script>
</body>
</html>