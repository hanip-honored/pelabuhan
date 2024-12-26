<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Aktivitas Bongkar Muat</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/dashboard.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <?php $aktivitas = $aktivitas[0]; ?>
        <h2>Edit Aktivitas Bongkar Muat</h2>
        <form action="aktivitas_bongkar_muat/update/<?php echo $aktivitas->id_logistik ?>" method="post">
            <div class="mb-3">
                <label for="nama_kapal" class="form-label">Nama Kapal</label>
                <input type="text" class="form-control" id="nama_kapal" name="nama_kapal" value="<?php echo $aktivitas->nama_kapal; ?>" readonly>
            </div>
            <div class="mb-3">
                <label for="jenis_logistik" class="form-label">Jenis Logistik</label>
                <input type="text" class="form-control" id="jenis_logistik" name="jenis_logistik" value="<?php echo $aktivitas->jenis_barang; ?>">
            </div>
            <div class="mb-3">
                <label for="jumlah_logistik" class="form-label">Jumlah Logistik</label>
                <input type="number" class="form-control" id="jumlah_logistik" name="jumlah_logistik" value="<?php echo $aktivitas->jumlah_barang; ?>">
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">status</label>
                <input type="text" class="form-control" id="status" name="status" value="<?php echo $aktivitas->status_logistik; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="../aktivitas_bongkar_muat" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>