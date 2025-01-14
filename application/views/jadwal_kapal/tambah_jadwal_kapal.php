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
    <div class="container">

        <div class="header-wrapper">
            <button class="btn-close" onclick="window.location.href='<?php echo site_url('jadwal_kapal'); ?>'"></button>
            <h2 class="header-title">Tambah Jadwal Kapal</h2>
        </div>

        <form action="<?php echo site_url('jadwal_kapal/tambah_action'); ?>" method="post">
            <div class="form-wrapper">
                <div class="form-item">
                    <label for="nama_kapal">Pilih Kapal</label>
                    <select id="nama_kapal" name="id_kapal" required>
                        <option value="" disabled selected>Pilih Nama Kapal</option>
                        <?php foreach ($kapal as $k): ?>
                            <option value="<?php echo $k->id_kapal; ?>"><?php echo $k->nama_kapal; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-item asal">
                    <label for="pelabuhan_asal">Asal</label>
                    <input type="text" id="pelabuhan_asal" name="pelabuhan_asal" placeholder="Masukkan Pelabuhan Asal" required>
                </div>

                <div class="form-item tujuan">
                    <label for="pelabuhan_tujuan">Tujuan</label>
                    <input type="text" id="pelabuhan_tujuan" name="pelabuhan_tujuan" placeholder="Masukkan Pelabuhan Tujuan" required>
                </div>

                <div class="form-item">
                    <label for="waktu_masuk">Waktu Masuk</label>
                    <input type="datetime-local" id="waktu_masuk" name="waktu_masuk" required>
                </div>

                <div class="form-item">
                    <label for="waktu_keluar">Waktu Keluar</label>
                    <input type="datetime-local" id="waktu_keluar" name="waktu_keluar" required>
                </div>

                <div class="form-item">
                    <label for="status_alur">Status Alur</label>
                    <select id="status_alur" name="status_alur" required>
                        <option value="" disabled selected>Pilih Status</option>
                        <option value="dijadwalkan">Dijadwalkan</option>
                        <option value="proses">Proses</option>
                        <option value="selesai">Selesai</option>
                    </select>
                </div>
            </div>
        </form>

        <div class="calendar-container">
            <div class="month-navigation">
                <button onclick="changeMonth(-1)">&#9664; Sebelumnya</button>
                <span class="month-label"></span>
                <button onclick="changeMonth(1)">Berikutnya &#9654;</button>
            </div>
            <div class="calendar"></div>
        </div>

        <div class="button-wrapper">
            <button type="button" class="btn btn-warning reset-button" onclick="resetSelection()">Reset Kalender</button>
            <button type="submit" class="search-button">Tambah Jadwal</button>
        </div>
    </div>
    <script src="<?php echo base_url('assets/js/tambah_jadwal_kapal.js'); ?>" defer></script>
</body>
</html>