<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Kapal</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/jadwal_kapal.css'); ?>">
</head>
<body>
    <div class="main-container">
        <div class="container">
            <h2>Jadwal Kapal</h2>
            <div class="header">
                <button class="btn-close" onclick="window.location.href='<?php echo site_url('dashboard'); ?>'"></button>
                <button class="btn-add" onclick="window.location.href='<?php echo site_url('jadwal_kapal/tambah'); ?>'">Tambah Jadwal</button>
                <form action="jadwal_kapal" method="get">
                <div class="search-container">
                    <input type="text" id="keywordInput" name="keyword" class="form-control" placeholder="Cari Data..." oninput="inputSearch()" value="<?php echo isset($keyword) ? $keyword : ''; ?>">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
            </div>

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
                            <th>Nama Kapal</th>
                            <th>Waktu Masuk</th>
                            <th>Waktu Keluar</th>
                            <th>Pelabuhan Asal</th>
                            <th>Pelabuhan Tujuan</th>
                            <th>Status Alur</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; 
                            if (isset($jadwall) && !empty($jadwall)): ?>
                        <?php foreach ($jadwall as $jadwal): ?>
                        <tr>
                            <td><?php echo $no;?></td>
                            <td><?php echo $jadwal->nama_kapal; ?></td>
                            <td><?php echo date('Y-m-d H:i', strtotime($jadwal->waktu_masuk)); ?></td>
                            <td><?php echo date('Y-m-d H:i', strtotime($jadwal->waktu_masuk));; ?></td>
                            <td><?php echo $jadwal->pelabuhan_asal; ?></td>
                            <td><?php echo $jadwal->pelabuhan_tujuan; ?></td>
                            <td>
                                <?php
                                $statusClass = '';
                                if ($jadwal->status_alur == 'dijadwalkan') {
                                    $statusClass = 'status-dijadwalkan';
                                } elseif ($jadwal->status_alur == 'proses') {
                                    $statusClass = 'status-proses';
                                } elseif ($jadwal->status_alur == 'selesai') {
                                    $statusClass = 'status-selesai';
                                }
                                ?>
                                <span class="<?php echo $statusClass; ?>">
                                    <?php echo $jadwal->status_alur; ?>
                                </span>
                            </td>
                            <td>
                            <a href="<?php echo site_url('jadwal_kapal/edit/' . $jadwal->id_alur); ?>" class="btn btn-warning btn-sm" title="Edit Jadwal">
                                <i class="fas fa-edit"></i>
                            </a>
                            <button data-href="jadwal_kapal/hapus/<?php echo $jadwal->id_alur?>" class="btn btn-danger btn-sm hapusButton">
                                <i class="fas fa-trash"></i>
                            </button>
                            </td>
                        </tr>
                        <?php $no++; endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="8" class="text-center">Tidak ada data Kapal.</td>
                                </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url('assets/js/jadwal_kapal.js'); ?>" defer></script>  
</body>
</html>
