<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjadwalan Kapal</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/dashboard.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/tambah_jadwal_kapal.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<div class="sidebar">
    <div class="profile">
        <img src="<?php echo base_url('assets/images/user.png'); ?>" alt="User Image">
        <h3><?php echo ucwords($_SESSION['level']) ?></h3>
    </div>
    <ul>
        <li class="<?php echo ($this->uri->segment(1) == 'dashboard') ? 'active' : ''; ?>">
            <a href="../dashboard"><i class="fas fa-home"></i> Dashboard</a>
        </li>
        <li class="<?php echo ($this->uri->segment(1) == 'pendataan_kapal') ? 'active' : ''; ?>">
            <a href="../pendataan_kapal"><i class="fas fa-ship"></i> Pendataan Kapal</a>
        </li>
        <li class="<?php echo ($this->uri->segment(1) == 'jadwal_kapal') ? 'active' : ''; ?>">
            <a href="../jadwal_kapal"><i class="fas fa-calendar-alt"></i> Jadwal Kapal</a>
        </li>
        <li class="<?php echo ($this->uri->segment(1) == 'aktivitas_bongkar_muat') ? 'active' : ''; ?>">
            <a href="../aktivitas_bongkar_muat"><i class="fas fa-box"></i> Bongkar Muat</a>
        </li>
        <li class="<?php echo ($this->uri->segment(1) == 'manajemen_gudang') ? 'active' : ''; ?>">
            <a href=".//manajemen_gudang"><i class="fas fa-warehouse"></i> Manajemen Gudang</a>
        </li>
        <li>
            <a href="logout" style="color: red; text-decoration: none;">
                <i class="fas fa-sign-out-alt"></i> Logout
            </a>
        </li>
    </ul>
</div>
    <div class="main-content">
        <div class="container">
            <h1 class="text-center mb-4">Penjadwalan Kapal</h1>

            <!-- Kalender -->
            <div class="calendar mb-4">
                <div class="calendar-header">
                    <button id="prev-month" class="btn-small">&lt;</button>
                    <h2 id="month-year"></h2>
                    <button id="next-month" class="btn-small">&gt;</button>
                </div>
                <div class="calendar-days">
                    <div>Sun</div><div>Mon</div><div>Tue</div><div>Wed</div><div>Thu</div><div>Fri</div><div>Sat</div>
                </div>
                <div class="calendar-dates" id="calendar-dates"></div>
            </div>

            <!-- Form Tambah Jadwal -->
            <form action="<?php echo base_url('jadwal_kapal/tambah_action'); ?>" method="post">
                <label for="ship-name">Nama Kapal</label>
                <input type="text" id="ship-name" name="nama_kapal" class="form-control" placeholder="Masukkan nama kapal" required>

                <label for="operation-status" class="mt-3">Status Alur</label>
                <select id="operation-status" name="status_alur" class="form-control" required>
                    <option value="dijadwalkan">Dijadwalkan</option>
                    <option value="masuk">Masuk</option>
                    <option value="keluar">Keluar</option>
                </select>

                <label for="start-time" class="mt-3">Waktu Mulai</label>
                <input type="datetime-local" id="start-time" name="waktu_masuk" class="form-control" required>

                <label for="end-time" class="mt-3">Waktu Selesai</label>
                <input type="datetime-local" id="end-time" name="waktu_keluar" class="form-control" required>

                <label for="operation-type" class="mt-3">Jenis Operasi</label>
                <select id="operation-type" name="jenis_operasi" class="form-control" required>
                    <option value="bongkar muat">Bongkar Muat</option>
                    <option value="pemeriksaan">Pemeriksaan</option>
                    <option value="perawatan">Perawatan</option>
                </select>

                <button type="submit" class="btn btn-primary mt-4 w-100">Tambah Jadwal</button>
            </form>
        </div>
    </div>
    <script src="<?php echo base_url('assets/js/tambah_jadwal_kapal.js'); ?>"></script>
</body>
</html>