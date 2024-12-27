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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
    <?php $this->load->view('sidebar'); ?>
    <div class="main-content">
        <div class="container mt-5">
            <h1 class="text-center mb-4">Aktivitas Bongkar Muat</h1>
            <a href="#" id="tambahButton" class="btn btn-success mb-3" 
                data-bs-toggle="modal" 
                data-bs-target="#tambahModal">
                <i class="fas fa-plus"></i> Tambah Aktivitas
            </a>

            <form action="aktivitas_bongkar_muat" method="get" class="mb-3">
                <div class="input-group">
                    <input type="text" id="keywordInput" name="keyword" class="form-control" placeholder="Cari aktivitas..." oninput="checkInput()" value="<?php echo isset($keyword) ? $keyword : ''; ?>">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
                </div>
            </form>

             <!-- Pesan Sukses atau Error -->
             <?php if ($this->session->flashdata('success')): ?>
                <script>
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil',
                        text: '<?php echo $this->session->flashdata('success'); ?>'
                    });
                </script>
            <?php endif; ?>
            <?php if ($this->session->flashdata('error')): ?>
                <script>
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: '<?php echo $this->session->flashdata('error'); ?>'
                    });
                </script>
            <?php endif; ?>

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
                                    <a href="#" id="editButton" class="btn btn-warning btn-sm" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal" 
                                        onclick="setEditData(<?php echo htmlspecialchars(json_encode($activity), ENT_QUOTES, 'UTF-8'); ?>)">
                                        <i class="fas fa-edit"></i>
                                        Edit
                                    </a>
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

    <!-- MODAL EDIT-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Aktivitas Bongkar Muat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="aktivitas_bongkar_muat/updateAktivitas" method="post">
                        <input type="hidden" id="edit_id_logistik" name="id_logistik">
                        <div class="mb-3">
                            <label for="edit_nama_kapal" class="form-label">Nama Kapal</label>
                            <input type="text" class="form-control" id="edit_nama_kapal" name="nama_kapal" readonly disabled>
                        </div>
                        <div class="mb-3">
                            <label for="edit_jenis_barang" class="form-label">Jenis barang</label>
                            <input type="text" class="form-control" id="edit_jenis_barang" name="jenis_barang" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_jumlah_barang" class="form-label">Jumlah Barang</label>
                            <input type="number" class="form-control" id="edit_jumlah_barang" name="jumlah_barang" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_status_logistik" class="form-label">Status Logistik</label>
                            <select class="form-select" id="edit_status_logistik" name="status_logistik" required>
                                <option value="dimuat">dimuat</option>
                                <option value="dibongkar">dibongkar</option>
                                <option value="transit">transit</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL TAMBAH-->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Aktivitas Bongkar Muat</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="tambahForm" action="aktivitas_bongkar_muat/tambahAktivitas" method="post">
                        <input type="hidden" id="id_logistik" name="id_logistik">
                        <div class="mb-3">
                            <label for="nama_kapal" class="form-label">Nama Kapal</label>
                            <select class="form-select" id="nama_kapal" name="nama_kapal" required>
                            <option value="" disabled selected>Pilih Kapal</option>
                            <?php foreach ($kapal as $k): ?>
                                    <option value="<?php echo $k->id_kapal; ?>"><?php echo $k->nama_kapal; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="jenis_barang" class="form-label">Jenis barang</label>
                            <input type="text" class="form-control" id="jenis_barang" name="jenis_barang" required>
                        </div>
                        <div class="mb-3">
                            <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                            <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" required>
                        </div>
                        <div class="mb-3">
                            <label for="status_logistik" class="form-label">Status Logistik</label>
                            <select class="form-select" id="status_logistik" name="status_logistik" required>
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="dimuat">dimuat</option>
                                <option value="dibongkar">dibongkar</option>
                                <option value="transit">transit</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Tambah Aktivitas</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/js/aktivitas_bongkar_muat.js'); ?>" defer></script>
</body>
</html>
