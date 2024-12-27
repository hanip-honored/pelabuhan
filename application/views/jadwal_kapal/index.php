<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendataan Kapal</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/jadwal_kapal.css'); ?>">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php $this->load->view('sidebar'); ?>
<div class="main-content">
    <div class="container p-2">
        <h1 class="text-center mb-4 mt-2">Jadwal Kapal</h1>
        <a href="jadwal_kapal/tambah" class="btn btn-success mb-4">+ Tambah Jadwal</a>
        <table class="table table-bordered table-hover table-striped">
            <thead class="table-light">
                <tr>
                    <th>Nama Kapal</th>
                    <th>Status Alur</th>
                    <th>Waktu Masuk</th>
                    <th>Waktu Keluar</th>
                    <th>Jenis Operasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jadwal_kapal as $jadwal): ?>
                <tr>
                    <td><?php echo $jadwal->nama_kapal; ?></td>
                    <td><?php echo $jadwal->status_alur; ?></td>
                    <td><?php echo $jadwal->waktu_masuk; ?></td>
                    <td><?php echo $jadwal->waktu_keluar; ?></td>
                    <td><?php echo $jadwal->jenis_operasi; ?></td>
                    <td>
                        <a href="#" class="btn btn-warning btn-sm" 
                           data-bs-toggle="modal" 
                           data-bs-target="#editModal" 
                           onclick="setEditData(<?php echo htmlspecialchars(json_encode($jadwal), ENT_QUOTES, 'UTF-8'); ?>)">
                           Edit
                        </a>
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $jadwal->id_jadwal; ?>">Hapus</button>
                    </td>
                </tr>

                <div class="modal fade" id="deleteModal<?php echo $jadwal->id_jadwal; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Apakah Anda yakin ingin menghapus jadwal kapal <strong><?php echo $jadwal->nama_kapal; ?></strong>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <a href="<?php echo base_url('jadwal_kapal/hapus/' . $jadwal->id_jadwal); ?>" class="btn btn-danger">Hapus</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Jadwal Kapal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?php echo base_url('jadwal_kapal/edit_action'); ?>" method="post">
                    <input type="hidden" id="edit_id_jadwal" name="id_jadwal">
                    <div class="mb-3">
                        <label for="edit_nama_kapal" class="form-label">Nama Kapal</label>
                        <input type="text" class="form-control" id="edit_nama_kapal" name="nama_kapal" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_status_alur" class="form-label">Status Alur</label>
                        <input type="text" class="form-control" id="edit_status_alur" name="status_alur" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_waktu_masuk" class="form-label">Waktu Masuk</label>
                        <input type="datetime-local" class="form-control" id="edit_waktu_masuk" name="waktu_masuk" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_waktu_keluar" class="form-label">Waktu Keluar</label>
                        <input type="datetime-local" class="form-control" id="edit_waktu_keluar" name="waktu_keluar" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_pelabuhan_asal" class="form-label">Pelabuhan Asal</label>
                        <input type="text" class="form-control" id="edit_pelabuhan_asal" name="pelabuhan_asal" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_pelabuhan_tujuan" class="form-label">Pelabuhan Tujuan</label>
                        <input type="text" class="form-control" id="edit_pelabuhan_tujuan" name="pelabuhan_tujuan" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo base_url('assets/js/jadwal_kapal.js'); ?>"></script>
</body>
</html>
