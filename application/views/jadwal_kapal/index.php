<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jadwal Kapal</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/jadwal_kapal.css'); ?>">
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
        <h1 class="text-center mb-4">Jadwal Kapal</h1>
        <a href="<?php echo site_url('jadwal_kapal/tambah'); ?>" class="btn btn-success mb-3">
            <i class="fas fa-plus"></i> Tambah Data
        </a>

        <form action="jadwal_kapal" method="get" class="mb-3">
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
                <td><?php echo $no++;?></td>
                    <td><?php echo $jadwal->nama_kapal; ?></td>
                    <td><?php echo $jadwal->waktu_masuk; ?></td>
                    <td><?php echo $jadwal->waktu_keluar; ?></td>
                    <td><?php echo $jadwal->pelabuhan_asal; ?></td>
                    <td><?php echo $jadwal->pelabuhan_tujuan; ?></td>
                    <td><?php echo $jadwal->status_alur; ?></td>
                    <td>
                    <a href="<?php echo site_url('jadwal_kapal/edit/' . $jadwal->id_alur); ?>" class="btn btn-warning btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a>
                    <a href="jadwal_kapal/hapus/<?php echo $jadwal->id_alur; ?>" class="btn btn-danger btn-sm hapusButton">
                        <i class="fas fa-trash"></i> Hapus
                    </a>
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

<script src="<?php echo base_url('assets/js/jadwal_kapal.js'); ?>" defer></script>
</body>
</html>