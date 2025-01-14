<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Gudang</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/manajemen_gudang.css'); ?>">
</head>
<body>
    <div class="main-container">
        <div class="container">
            <h2>Manajemen Gudang</h2>
            <div class="header">
                <button class="btn-close" onclick="window.location.href='<?php echo site_url('dashboard'); ?>'"></button>
                <button class="btn-add" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah Gudang</button>

                <form action="jadwal_kapal" method="get">
                    <div class="search-container">
                        <input type="text" id="keywordInput" name="keyword" class="form-control" placeholder="Cari Data..." oninput="inputSearch()" value="<?php echo isset($keyword) ? $keyword : ''; ?>">
                        <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                    </div>
                </form>
            </div>

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

            <div class="table-respopnsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Lokasi Gudang</th>
                            <th>Kapasitas Maksimal</th>
                            <th>Total Terisi</th>
                            <th>Sisa Kapasitas</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; 
                            if (!empty($gudang_data)): ?>
                            <?php foreach ($gudang_data as $gudang): ?>
                                <?php if ($gudang->total_terisi == $gudang->kapasitas_gudang) {
                                    $status = 'penuh';
                                } else {
                                    $status = 'tersedia';
                                }?>
                                <tr>
                                    <td><?php echo $no;?></td>
                                    <td><?php echo $gudang->lokasi_gudang; ?></td>
                                    <td><?php echo $gudang->kapasitas_gudang; ?></td>
                                    <td><?php echo $gudang->total_terisi; ?></td>
                                    <td><?php echo $gudang->sisa_kapasitas; ?></td>
                                    <td><?php echo $status; ?></td>
                                    <td>
                                        <a href="#" id="editButton" class="btn btn-warning btn-sm" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editModal" 
                                            onclick="setEditData(<?php echo htmlspecialchars(json_encode($gudang), ENT_QUOTES, 'UTF-8'); ?>)">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button data-href="manajemen_gudang/hapus_gudang/<?php echo $gudang->id_gudang?>" class="btn btn-danger btn-sm hapusButton">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </td>
                                </tr>
                                <?php $no++; ?>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center">Tidak ada data gudang tersedia.</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        <?php  $this->load->view('manajemen_gudang/logistik.php'); ?>
    </div>

    <!-- MODAL TAMBAH-->
    <div class="modal fade" id="tambahModal" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahModalLabel">Tambah Gudang</h5>
                    <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i>
                </div>
                <div class="modal-body">
                    <form id="tambahForm" action="manajemen_gudang/tambah_gudang" method="post">
                        <div class="mb-3">
                            <label for="lokasi_gudang" class="form-label">Lokasi Gudang</label>
                            <input type="text" class="form-control" id="lokasi_gudang" name="lokasi_gudang" required>
                        </div>
                        <div class="mb-3">
                            <label for="kapasitas_gudang" class="form-label">Kapasitas Maksimal</label>
                            <input type="text" class="form-control" id="kapasitas_gudang" name="kapasitas_gudang" required>
                        </div>
                        <div class="mb-3">
                            <label for="logistik" class="form-label">Logistik yang ingin dimuat</label>
                            <select class="form-control logistik" id="logistik" name="logistik[]" multiple>
                                <?php if (!empty($logistik)): ?>
                                    <?php foreach ($logistik as $log): ?>
                                        <option value="<?php echo $log->id_logistik; ?>" data-jumlah="<?php echo $log->jumlah_barang; ?>">
                                            <?php echo $log->id_logistik; ?> (<?php echo $log->jumlah_barang; ?>)
                                        </option>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <option value="" disabled>Data logistik tidak tersedia</option>
                                <?php endif; ?>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Tambah Gudang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL EDIT-->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Gudang</h5>
                    <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i>
                </div>
                <div class="modal-body">
                    <form id="editForm" action="manajemen_gudang/updateGudangLogistik" method="post">
                        <input type="hidden" id="edit_id_gudang" name="id_gudang">
                        <div class="mb-3">
                            <label for="edit_lokasi_gudang" class="form-label">Lokasi Gudang</label>
                            <input type="text" class="form-control" id="edit_lokasi_gudang" name="edit_lokasi_gudang" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_kapasitas_maksimal" class="form-label">Kapasitas Maksimal</label>
                            <input type="text" class="form-control" id="edit_kapasitas_maksimal" name="edit_kapasitas_maksimal" required>
                        </div>
                        <div class="mb-3">
                            <label for="edit_logistik" class="form-label">Logistik yang ingin dimuat</label>
                            <select class="form-control edit_logistik" id="edit_logistik" name="edit_logistik[]" multiple>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="<?php echo base_url('assets/js/manajemen_gudang.js');?>" defer></script>
    <script> const availableLogistik = <?php echo json_encode($logistik); ?>; </script>

    <script>
        $(document).ready(function() {
            $('.logistik').select2({
                placeholder: "Pilih logistik",
                allowClear: true,
                width: '100%',
                dropdownParent: $('#tambahModal'),
                theme: "bootstrap-5"
            });
        });
        
        $(document).ready(function() {
            $('.edit_logistik').select2({
                placeholder: "Pilih logistik",
                allowClear: true,
                width: '100%',
                dropdownParent: $('#editModal'),
                theme: "bootstrap-5"
            });
        });

        $(document).ready(function () {
            let kapasitasGudang = 0;
            
            $('#kapasitas_gudang').on('input', function () {
                kapasitasGudang = parseInt($(this).val()) || 0;
            });

            $('#logistik').on('change', function () {
                let totalLogistik = 0;

                $('#logistik option:selected').each(function () {
                    totalLogistik += parseInt($(this).data('jumlah')) || 0;
                });

                if (totalLogistik > kapasitasGudang) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal',
                        text: 'Total logistik melebihi kapasitas gudang!',
                        confirmButtonText: 'OK',
                        confirmButtonColor: '#d33'
                    }).then(() => {
                        const lastSelected = $(this).find(':selected:last');
                        lastSelected.prop('selected', false);
                        $('#logistik').trigger('change.select2'); 
                    });
                }
            });

            $('.logistik').select2({
                placeholder: "Pilih logistik",
                allowClear: true,
                dropdownParent: $('#tambahModal'),
                width: '100%',
                theme: "bootstrap-5"
            });
        });

    </script>
</body>
</html>
