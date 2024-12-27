<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Data Kapal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Tambah Data Kapal</h2>
    <form action="<?php echo base_url('pendataan_kapal/tambah_aksi'); ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama_kapal" class="form-label">Nama Kapal</label>
            <input type="text" class="form-control" id="nama_kapal" name="nama_kapal" required>
        </div>
        <div class="mb-3">
            <label for="jenis_kapal" class="form-label">Jenis Kapal</label>
            <input type="text" class="form-control" id="jenis_kapal" name="jenis_kapal" required>
        </div>
        <div class="mb-3">
            <label for="gambar_kapal" class="form-label">Gambar Kapal</label>
            <input type="file" class="form-control" id="gambar_kapal" name="gambar_kapal" required>
        </div>
        <div class="mb-3">
            <label for="ukuran_kapal" class="form-label">Ukuran Kapal (M)</label>
            <input type="number" class="form-control" id="ukuran_kapal" name="ukuran_kapal" required>
        </div>
        <div class="mb-3">
            <label for="kapasitas_muatan" class="form-label">Kapasitas Muatan (TEU)</label>
            <input type="number" class="form-control" id="kapasitas_muatan" name="kapasitas_muatan" required>
        </div>
        <div class="mb-3">
            <label for="status_kapal" class="form-label">Status Kapal</label>
            <select class="form-select" id="status_kapal" name="status_kapal" required>
                <option value="Masuk">Masuk</option>
                <option value="Keluar">Keluar</option>
                <option value="Sedang bongkar muat">Sedang bongkar muat</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="<?php echo base_url('pendataan_kapal'); ?>" class="btn btn-secondary">Kembali</a>
    </form>
</div>
</body>
</html>
