<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Gudang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Edit Gudang</h2>
        <form action="<?php echo base_url('manajemengudang/updateGudang/'.$gudang->id_gudang); ?>" method="post">
            <div class="mb-3">
                <label for="lokasi_gudang" class="form-label">Lokasi Gudang</label>
                <input type="text" class="form-control" id="lokasi_gudang" name="lokasi_gudang" value="<?php echo $gudang->lokasi_gudang; ?>" required>
            </div>
            <div class="mb-3">
                <label for="kapasitas_gudang" class="form-label">Kapasitas Gudang</label>
                <input type="number" class="form-control" id="kapasitas_gudang" name="kapasitas_gudang" value="<?php echo $gudang->kapasitas_gudang; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</body>
</html>
