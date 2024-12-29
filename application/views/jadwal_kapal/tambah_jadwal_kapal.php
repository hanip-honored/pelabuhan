<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Jadwal Kapal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/tambah_jadwal_kapal.css'); ?>">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tambah Jadwal Kapal</h1>
        <a href="<?php echo site_url('jadwal_kapal'); ?>" class="btn btn-secondary mb-3">Kembali ke Halaman Index</a>

        <!-- Kalender -->
        <div class="calendar-container">
            <div class="month-navigation">
                <button onclick="changeMonth(-1)">&#9664; Sebelumnya</button>
                <span class="month-label"></span>
                <button onclick="changeMonth(1)">Berikutnya &#9654;</button>
            </div>
            <div class="calendar"></div>
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
    <script src="<?php echo base_url('assets/js/tambah_jadwal_kapal.js'); ?>" defer></script>
</body>
</html>