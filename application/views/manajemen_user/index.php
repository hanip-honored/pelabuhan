<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/manajemen_user.css'); ?>">
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
            <h1 class="text-center mb-4">Manajemen User</h1>
            <a href="#" class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#tambahModal">
                <i class="fas fa-plus"></i> Tambah User
            </a>

            <form action="manajemen_user" method="get" class="mb-3">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Cari user..." value="<?php echo isset($keyword) ? $keyword : ''; ?>">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
                </div>
            </form>

            <?php if ($this->session->flashdata('success')): ?>
                <script>
                    Swal.fire({ icon: 'success', title: 'Berhasil', text: '<?php echo $this->session->flashdata('success'); ?>' });
                </script>
            <?php endif; ?>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama User</th>
                        <th>Level</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($users)): ?>
                        <?php $no = 1; foreach ($users as $user): ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $user->nama_user; ?></td>
                                <td><?php echo $user->level; ?></td>
                                <td><?php echo $user->username; ?></td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" onclick="setEditData(<?php echo htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8'); ?>)">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <a href="manajemen_user/hapusUser/<?php echo $user->id_user; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5" class="text-center">Tidak ada data user.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="modal fade" id="tambahModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="manajemen_user/tambahUser" method="post">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah User</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <input type="text" class="form-control mb-3" name="nama_user" placeholder="Nama User" required>
                            <select class="form-select mb-3" name="level" required>
                                <option value="">Pilih Level</option>
                                <option value="admin">Admin</option>
                                <option value="petugas operasional">Petugas Operasional</option>
                            </select>
                            <input type="text" class="form-control mb-3" name="username" placeholder="Username" required>
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary w-100">Tambah User</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url('assets/js/manajemen_user.js'); ?>" defer></script>
</body>
</html>
