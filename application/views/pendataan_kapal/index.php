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
    <div class="container mt-5">
        <h1 class="text-center mb-4">Pendataan Kapal</h1>
        <a href="#" id="tambahButton" class="btn btn-success mb-3" 
                data-bs-toggle="modal" 
                data-bs-target="#tambahModal">
                <i class="fas fa-plus"></i> Tambah Data
        </a>

        <form action="pendataan_kapal" method="get" class="mb-3">
            <div class="input-group">
                <input type="text" id="keywordInput" name="keyword" class="form-control" placeholder="Cari Data..." value="<?php echo isset($keyword) ? $keyword : ''; ?>">
                <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
            </div>
        </form>

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

        <div class="row">
            <?php $no = 1; if (isset($ships) && !empty($ships)): ?>
                <?php foreach ($ships as $ship): ?>
                    <div class="col-12 mb-4">
                        <div class="card shadow-sm expandable-card" onclick="toggleCard(this)">
                            <div class="card-body d-flex align-items-center">
                                <img src="<?php echo base_url('assets/images/ships/' . $ship->gambar_kapal); ?>" alt="Ship Image" class="ship-image me-3">
                                <div>
                                    <h5 class="card-title mb-1"><?php echo $ship->nama_kapal; ?></h5>
                                    <p class="card-text mb-0">Jenis: <?php echo $ship->jenis_kapal; ?></p>
                                    <p class="card-text mb-0">Status: <span class="status <?php echo strtolower(str_replace(' ', '-', $ship->status_kapal)); ?>">
                                        <?php echo $ship->status_kapal; ?></span></p>
                                </div>
                                <i class="fas fa-chevron-down ms-auto toggle-icon"></i>
                            </div>
                            <div class="card-details d-none">
                                <hr style="margin-top: -2px; margin-right: -60px;">
                                <div class="ps-4">
                                    <p>Nama Kapal: <?php echo $ship->nama_kapal; ?></p>
                                    <p>Jenis: <?php echo $ship->jenis_kapal; ?></p>
                                    <p>Ukuran: <?php echo $ship->ukuran_kapal; ?> M</p>
                                    <p>Kapasitas: <?php echo $ship->kapasitas_muatan; ?> TEU</p>
                                </div>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning btn-sm mb-2" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#editModal" 
                                        onclick="setEditData(<?php echo htmlspecialchars(json_encode($ship), ENT_QUOTES, 'UTF-8'); ?>)">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <button data-href="pendataan_kapal/hapus/<?php echo $ship->id_kapal ?>" class="btn btn-danger btn-sm hapusButton">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="text-center">Tidak ada data Kapal.</p>
            <?php endif; ?>
        </div>
    </div>

    <!-- Modal Edit -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Data Kapal</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="pendataan_kapal/edit_aksi" method="post" enctype="multipart/form-data">
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
                        <div class="mb-3">
                            <label for="edit_gambar_kapal" class="form-label">Gambar Kapal</label>
                            <input type="file" class="form-control" id="edit_gambar_kapal" name="gambar_kapal">
                            <div class="mt-2">
                                <img id="edit_preview_gambar" src="" alt="Preview Gambar Kapal" class="img-thumbnail" style="max-height: 150px;">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function toggleCard(card) {
            const details = card.querySelector('.card-details');
            const icon = card.querySelector('.toggle-icon');
            if (details.classList.contains('d-none')) {
                details.classList.remove('d-none');
                icon.classList.add('fa-chevron-up');
                icon.classList.remove('fa-chevron-down');
            } else {
                details.classList.add('d-none');
                icon.classList.add('fa-chevron-down');
                icon.classList.remove('fa-chevron-up');
            }
        }

        function setEditData(ship) {
            document.getElementById('edit_id_kapal').value = ship.id_kapal;
            document.getElementById('edit_nama_kapal').value = ship.nama_kapal;
            document.getElementById('edit_jenis_kapal').value = ship.jenis_kapal;
            document.getElementById('edit_ukuran_kapal').value = ship.ukuran_kapal;
            document.getElementById('edit_kapasitas_muatan').value = ship.kapasitas_muatan;
            document.getElementById('edit_status_kapal').value = ship.status_kapal;
            document.getElementById('edit_preview_gambar').src = base_url + 'assets/images/ships/' + ship.gambar_kapal;
        }

        document.querySelectorAll('.hapusButton').forEach(function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const href = this.dataset.href;
                Swal.fire({
                    title: "Apakah Anda yakin?",
                    text: "Data akan dihapus",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, hapus!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = href;
                    }
                });
            });
        });
    </script>
</body>
</html>