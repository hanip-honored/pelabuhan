<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen User</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/manajemen_user.css'); ?>">
</head>
<body>
    <div class="main-container">
        <div class="container">
            <h2>Manajemen User</h2>
            <div class="header">
                <button class="btn-close" onclick="window.location.href='<?php echo site_url('dashboard'); ?>'"></button>
                <button class="btn-add" data-bs-toggle="modal" data-bs-target="#tambahModal">Tambah User</button>

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
                            <th>Nama User</th>
                            <th>Level</th>
                            <th>Username</th>
                            <th>Password</th>
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
                                    <div class="password-container">
                                            <input type="password" value="<?php echo $user->password; ?>" class="hidden-input" readonly>
                                            <i class="fas fa-eye" onclick="togglePassword(this)"></i>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="#" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editModal" onclick="setEditData(<?php echo htmlspecialchars(json_encode($user), ENT_QUOTES, 'UTF-8'); ?>)"><i class="fas fa-edit"></i></a>
                                        <a href="manajemen_user/hapusUser/<?php echo $user->id_user; ?>" class="btn btn-danger btn-sm"><i class="fas fa-trash"></i></a>
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
                                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i>
                            </div>
                            <div class="modal-body">
                                <input type="text" class="form-control mb-3" name="nama_user" placeholder="Nama User" required>
                                <select class="form-select mb-3" name="level" id="level" required>
                                    <option value="admin">Admin</option>
                                    <option value="petugas kapal">Petugas Kapal</option>
                                    <option value="petugas gudang">Petugas Gudang</option>
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

            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form action="manajemen_user/updateUser" method="post">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit User</h5>
                                <button type="button" class="btn-close-custom" data-bs-dismiss="modal" aria-label="Close"><i class="fas fa-times"></i></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" class="form-control" name="id_user" id="edit_id_user">
                                <div class="mb-3">
                                    <label for="edit_nama_user" class="form-label">Nama User</label>
                                    <input type="text" class="form-control" name="nama_user" id="edit_nama_user" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_level" class="form-label">Level</label>
                                    <select class="form-select" name="level" id="edit_level" required>
                                        <option value="admin">Admin</option>
                                        <option value="petugas kapal">Petugas Kapal</option>
                                        <option value="petugas gudang">Petugas Gudang</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_username" class="form-label">Username</label>
                                    <input type="text" class="form-control" name="username" id="edit_username" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_password" class="form-label">Password</label>
                                    <input type="password" class="form-control" name="password" id="edit_password">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary w-100">Simpan Perubahan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <script>
            function togglePassword(element) {
                const input = element.previousElementSibling;
                if (input.type === "password") {
                    input.type = "text";
                    element.classList.remove("fa-eye");
                    element.classList.add("fa-eye-slash");
                } else {
                    input.type = "password";
                    element.classList.remove("fa-eye-slash");
                    element.classList.add("fa-eye");
                }
            }
        </script>
    </div>
    <script src="<?php echo base_url('assets/js/manajemen_user.js'); ?>" defer></script>  
</body>
</html>