<!-- Logistik -->
<div class="container mt-5">
    <h2 class="text-center mb-4">Logistik Tersedia</h2>
    <div class="header">
        <button class="btn-close" onclick="window.location.href='<?php echo site_url('dashboard'); ?>'" style="visibility: hidden;"></button>
        <button class="btn-add" data-bs-toggle="modal" data-bs-target="#tambahModalLogistik">Tambah Logistik</button>
        <form action="menajemen_gudang" method="get">
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

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>ID Logistik</th>
                    <th>Jenis Barang</th>
                    <th>Jumlah Barang</th>
                    <th>Status Logistik</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1; 
                    if (!empty($logistik)): ?>
                    <?php foreach ($logistik as $log): ?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><?php echo $log->id_logistik; ?></td>
                            <td><?php echo $log->jenis_barang; ?></td>
                            <td><?php echo $log->jumlah_barang; ?></td>
                            <td><?php echo $log->status_logistik; ?></td>
                            <td>
                                <a href="#" id="editButton" class="btn btn-warning btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editModalLogistik" 
                                    onclick="setEditDataLogistik(<?php echo htmlspecialchars(json_encode($log), ENT_QUOTES, 'UTF-8'); ?>)">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <button data-href="manajemen_gudang/hapusLogistik/<?php echo $log->id_logistik?>" class="btn btn-danger btn-sm hapusButton">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                        <?php $no++; ?>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">Tidak ada data logistik tersedia.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- MODAL TAMBAH-->
<div class="modal fade" id="tambahModalLogistik" tabindex="-1" aria-labelledby="tambahModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahModalLabel">Tambah Logistik</h5>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="tambahForm" action="manajemen_gudang/tambah_logistik" method="post">
                    <div class="mb-3">
                        <label for="kapal" class="form-label">Nama Kapal</label>
                        <select class="form-control" name="kapal" id="kapal" required>
                            <option value="" disabled selected>Pilih Kapal</option>
                            <?php foreach ($kapal as $kap): ?>
                                <option value="<?php echo $kap->id_kapal; ?>"><?php echo $kap->nama_kapal; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="jenis_barang" class="form-label">Jenis Barang</label>
                        <input type="text" class="form-control" id="jenis_barang" name="jenis_barang" required>
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_barang" class="form-label">Jumlah Barang</label>
                        <input type="text" class="form-control" id="jumlah_barang" name="jumlah_barang" required>
                    </div>
                    <div class="mb-3">
                        <label for="status_logistik" class="form-label">Status Logistik</label>
                        <select class="form-control" name="status_logistik" id="status_logistik" required>
                            <option value="" disabled selected>Pilih Status</option>
                            <option value="dimuat">Dimuat</option>
                            <option value="dibongkar">Dibongkar</option>
                            <option value="transit">Transit</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Tambah Logistik</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- MODAL EDIT-->
<div class="modal fade" id="editModalLogistik" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Logistik</h5>
                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" action="manajemen_gudang/updateLogistik" method="post">
                    <input type="hidden" id="edit_id_logistik" name="id_logistik">
                    <div class="mb-3">
                        <label for="edit_kapal" class="form-label">Nama Kapal</label>
                        <select class="form-control" name="kapal" id="edit_kapal" required>
                            <option value="" disabled selected>Pilih Kapal</option>
                            <?php foreach ($kapal as $kap): ?>
                                <option value="<?php echo $kap->id_kapal; ?>"><?php echo $kap->nama_kapal; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="edit_jenis_barang" class="form-label">Jenis Barang</label>
                        <input type="text" class="form-control" id="edit_jenis_barang" name="jenis_barang" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_jumlah_barang" class="form-label">Jumlah Barang</label>
                        <input type="text" class="form-control" id="edit_jumlah_barang" name="jumlah_barang" required>
                    </div>
                    <div class="mb-3">
                        <label for="edit_status_logistik" class="form-label">Status Logistik</label>
                        <select class="form-control" name="status_logistik" id="edit_status_logistik" required>
                            <option value="" disabled selected>Pilih Status</option>
                            <option value="dimuat">Dimuat</option>
                            <option value="dibongkar">Dibongkar</option>
                            <option value="transit">Transit</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                </form>
            </div>
        </div>
    </div>
</div>