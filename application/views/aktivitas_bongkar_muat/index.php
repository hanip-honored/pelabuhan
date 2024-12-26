<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aktivitas Bongkar Muat</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/aktivitas_bongkar_muat.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php $this->load->view('sidebar'); ?>
    <div class="main-content">
        <div class="container mt-5">
            <h1 class="text-center mb-4">Aktivitas Bongkar Muat</h1>
            <a href="<?php echo base_url('activity/add'); ?>" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Tambah Aktivitas</a>

            <form action="aktivitas_bongkar_muat/search" method="get" class="mb-3">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Cari aktivitas..." value="<?php echo isset($keyword) ? $keyword : ''; ?>">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
                </div>
            </form>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kapal</th>
                        <th>Jenis Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1; 
                        if (isset($activities) && !empty($activities)): ?>
                        <?php foreach ($activities as $activity): ?>
                            <tr>
                                <td><?php echo $no ?></td>
                                <td><?php echo $activity->nama_kapal; ?></td>
                                <td><?php echo $activity->jenis_barang; ?></td>
                                <td><?php echo $activity->jumlah_barang; ?></td>
                                <td><?php echo $activity->status_logistik; ?></td>
                                <td>
                                    <a href="Aktivitas_Bongkar_muat/editData?id=<?php echo $activity->id_logistik ?>" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="<?php echo base_url('activity/delete/' . $activity->id_logistik); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Hapus aktivitas ini?')"><i class="fas fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php $no++; endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data aktivitas bongkar muat.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
