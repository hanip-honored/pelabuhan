<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Data Kapal</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/dashboard.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <?php $ship = $ship[0]; ?>
        <h2>Edit Data Kapal</h2>
        <form action="pendataan_kapal/edit_aksi/<?php echo $ship->id_kapal ?>" method="post">
            <div class="mb-3">
                <label for="nama_kapal" class="form-label">Nama Kapal</label>
                <input type="text" class="form-control" id="nama_kapal" name="nama_kapal" value="<?php echo $ship->nama_kapal; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="jenis_kapal" class="form-label">Jenis Kapal</label>
                <input type="text" class="form-control" id="jenis_kapal" name="jenis_kapal" value="<?php echo $ship->jenis_barang; ?>">
            </div>
            <div class="mb-3">
                <label for="gambar_kapal" class="form-label">Gambar Kapal</label>
                <input type="file" class="form-control" id="gambar_kapal" name="gambar_kapal" value="<?php echo $ship->gambar_kapal; ?>">
            </div>
            <div class="mb-3">
                <label for="ukuran_kapal" class="form-label">Ukuran Kapal</label>
                <input type="text" class="form-control" id="ukuran_kapal" name="ukuran_kapal" value="<?php echo $ship->ukuran_kapal; ?>">
            </div>
            <div class="mb-3">
                <label for="kapasitas_muatan" class="form-label">Kapasitas Muatan</label>
                <input type="text" class="form-control" id="kapasitas_muatan" name="kapasitas_muatan" value="<?php echo $ship->kapasitas_muatan; ?>">
            </div>
            <div class="mb-3">
                <label for="status_kapal" class="form-label">Status Kapal</label>
                    <select class="form-select" id="status_kapal" name="status_kapal" required>
                        <option value="Masuk" <?php echo $kapal->status_kapal == 'Masuk' ? 'selected' : ''; ?>>Masuk</option>
                        <option value="Keluar" <?php echo $kapal->status_kapal == 'Keluar' ? 'selected' : ''; ?>>Keluar</option>
                        <option value="Sedang bongkar muat" <?php echo $kapal->status_kapal == 'Sedang bongkar muat' ? 'selected' : ''; ?>>Sedang bongkar muat</option>
                    </select>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="../pendataan_kapal" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>