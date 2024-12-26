<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendataan Kapal</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/pendataan_kapal.css'); ?>">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php $this->load->view('sidebar'); ?>
<div class="main-content">
    <div class="container p-2">
        <h1 class="text-center mb-4 mt-2">Pendataan Kapal</h1>
        <button class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#addModal">+ Tambah Data</button>
        <table class="table table-bordered table-hover table-striped">
            <thead class="table-light">
                <tr>
                    <th>Nama Kapal</th>
                    <th>Jenis Kapal</th>
                    <th>Gambar Kapal</th>
                    <th>Ukuran Kapal (M)</th>
                    <th>Kapasitas Muatan (TEU)</th>
                    <th>Status Kapal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ships as $ship): ?>
                <tr>
                    <td><?php echo $ship->nama_kapal; ?></td>
                    <td><?php echo $ship->jenis_kapal; ?></td>
                    <td>
                        <img src="<?php echo base_url('assets/images/ships/kapal.jpg'); ?>" alt="Ship Image" class="ship-image">
                    </td>
                    <td><?php echo $ship->ukuran_kapal; ?></td>
                    <td><?php echo $ship->kapasitas_muatan; ?></td>
                    <td><?php echo $ship->status_kapal; ?></td>
                    <td>
                        <a href="#" class="btn btn-warning btn-sm" 
                           data-bs-toggle="modal" 
                           data-bs-target="#editModal" 
                           onclick="setEditData(<?php echo htmlspecialchars(json_encode($ship), ENT_QUOTES, 'UTF-8'); ?>)">
                           Edit
                        </a>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $ship->id_kapal; ?>">Hapus</button>
                    </td>
                </tr>

                <div class="modal fade" id="deleteModal<?php echo $ship->id_kapal; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus data kapal <strong><?php echo $ship->nama_kapal; ?></strong>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <a href="<?php echo base_url('pendataan_kapal/hapus/' . $ship->id_kapal); ?>" class="btn btn-danger">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModalLabel">Tambah Data Kapal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('pendataan_kapal/tambah'); ?>" method="post" enctype="multipart/form-data">
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
                        <input type="file" class="form-control" id="gambar_kapal" name="gambar_kapal">
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
                    <button type="submit" class="btn btn-primary w-100">Simpan Data</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Kapal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('pendataan_kapal/edit_action'); ?>" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="edit_id_kapal" name="id_kapal">
                    <div class="mb-3">
                        <label for="edit_nama_kapal" class="form-label">Nama Kapal</label>
                        <input type="text" class="form-control" id="edit_nama_kapal" name="nama_kapal" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_jenis_kapal" class="form-label">Jenis Kapal</label>
                        <input type="text" class="form-control" id="edit_jenis_kapal" name="jenis_kapal" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_gambar_kapal" class="form-label">Gambar Kapal</label>
                        <input type="file" class="form-control" id="edit_gambar_kapal" name="gambar_kapal">
                    </div>
                    <div class="mb-3">
                        <label for="edit_ukuran_kapal" class="form-label">Ukuran Kapal (M)</label>
                        <input type="number" class="form-control" id="edit_ukuran_kapal" name="ukuran_kapal" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_kapasitas_muatan" class="form-label">Kapasitas Muatan (TEU)</label>
                        <input type="number" class="form-control" id="edit_kapasitas_muatan" name="kapasitas_muatan" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_status_kapal" class="form-label">Status Kapal</label>
                        <select class="form-select" id="edit_status_kapal" name="status_kapal" required>
                            <option value="Masuk">Masuk</option>
                            <option value="Keluar">Keluar</option>
                            <option value="Sedang bongkar muat">Sedang bongkar muat</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
function setEditData(ship) {
    document.getElementById('edit_id_kapal').value = ship.id_kapal;
    document.getElementById('edit_nama_kapal').value = ship.nama_kapal;
    document.getElementById('edit_jenis_kapal').value = ship.jenis_kapal;
    document.getElementById('edit_ukuran_kapal').value = ship.ukuran_kapal;
    document.getElementById('edit_kapasitas_muatan').value = ship.kapasitas_muatan;
    document.getElementById('edit_status_kapal').value = ship.status_kapal;
}
</script>
</body>
</html>
