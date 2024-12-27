<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Gudang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Tambah Gudang</h2>
        <form action="<?php echo base_url('manajemengudang/simpanGudang'); ?>" method="post">
            <div class="mb-3">
                <label for="id_gudang" class="form-label">ID Gudang</label>
                <input type="text" class="form-control" id="id_gudang" name="id_gudang" required>
            </div>
            <div class="mb-3">
                <label for="lokasi_gudang" class="form-label">Lokasi Gudang</label>
                <input type="text" class="form-control" id="lokasi_gudang" name="lokasi_gudang" required>
            </div>
            <div class="mb-3">
                <label for="kapasitas_gudang" class="form-label">Kapasitas Gudang</label>
                <input type="number" class="form-control" id="kapasitas_gudang" name="kapasitas_gudang" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</body>
</html>
