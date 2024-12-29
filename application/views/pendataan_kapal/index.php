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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        base_url = '<?php echo base_url(); ?>';
    </script>
</head>
<body>
<?php $this->load->view('sidebar'); ?>
<div class="main-content">
    <div class="container mt-5">
        <h1 class="text-center mb-4">Pendataan Kapal</h1>
        <a href="#" id="tambahButton" class="btn btn-success mb-3" 
                data-bs-toggle="modal" 
                data-bs-target="#tambahModal">
                <i class="fas fa-plus"></i> Tambah Data
            </a>

        <form action="pendataan_kapal" method="get" class="mb-3">
                <div class="input-group">
                    <input type="text" id="keywordInput" name="keyword" class="form-control" placeholder="Cari Data..." oninput="inputSearch()" value="<?php echo isset($keyword) ? $keyword : ''; ?>">
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
                    <th>Jenis Kapal</th>
                    <th>Gambar Kapal</th>
                    <th>Ukuran Kapal (M)</th>
                    <th>Kapasitas Muatan (TEU)</th>
                    <th>Status Kapal</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; 
                    if (isset($ships) && !empty($ships)): ?>
                <?php foreach ($ships as $ship): ?>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $ship->nama_kapal; ?></td>
                    <td><?php echo $ship->jenis_kapal; ?></td>
                    <td><img src="<?php echo base_url('assets/images/ships/' . $ship->gambar_kapal); ?>" alt="Ship Image" class="ship-image"></td>
                    <td><?php echo $ship->ukuran_kapal; ?></td>
                    <td><?php echo $ship->kapasitas_muatan; ?></td>
                    <td><?php echo $ship->status_kapal; ?></td>
                    <td>
                        <a href="#" id="editButton" class="btn btn-warning btn-sm" 
                            data-bs-toggle="modal" 
                            data-bs-target="#editModal" 
                            onclick="setEditData(<?php echo htmlspecialchars(json_encode($ship), ENT_QUOTES, 'UTF-8'); ?>)">
                            <i class="fas fa-edit"></i>
                            Edit
                        </a>
                        <button data-href="pendataan_kapal/hapus/<?php echo $ship->id_kapal?>" class="btn btn-danger btn-sm hapusButton">
                            <i class="fas fa-trash"></i> Hapus
                        </button>
                    </td>
                </tr>
                <?php $no++; endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Tidak ada data Kapal.</td>
                        </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal Edit Data -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Data Kapal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="Pendataan_Kapal/edit_aksi" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="edit_id_kapal" name="id_kapal">
                    <input type="hidden" id="edit_old_gambar_kapal" name="old_gambar_kapal">
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
                        <div class="image-container">
                            <img src="" alt="Ship Image" id="edit_kapal_old" class="ship-image mt-2">
                            <p id="nama_file"></p>
                        </div>
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

<div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Data Kapal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="tambahForm" action="pendataan_kapal/tambah_Aksi" method="post" enctype="multipart/form-data">
                        <input type="hidden" id="id_kapal" name="id_kapal">
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
                            <label for="ukuran_kapal" class="form-label">Ukuran Kapal</label>
                            <input type="number" class="form-control" id="ukuran_kapal" name="ukuran_kapal" required>
                        </div>
                        <div class="mb-3">
                            <label for="kapasitas_muatan" class="form-label">Kapasitas Muatan</label>
                            <input type="number" class="form-control" id="kapasitas_muatan" name="kapasitas_muatan" required>
                        </div>
                        <div class="mb-3">
                            <label for="status_kapal" class="form-label">Status Kapal</label>
                            <select class="form-select" id="status_kapal" name="status_kapal" required>
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="Masuk">Masuk</option>
                                <option value="Keluar">Keluar</option>
                                <option value="Sedang Bongkar Muat">Sedang Bongkar Muat</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Tambah Data</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script src="<?php echo base_url('assets/js/pendataan_kapal.js'); ?>" defer></script>
</body>
</html>
