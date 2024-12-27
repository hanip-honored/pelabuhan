<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Gudang</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/manajemen_gudang.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2rem;
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table-bordered {
            border: 1px solid #ddd;
        }

        .table-bordered th,
        .table-bordered td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            vertical-align: middle;
        }

        .table-striped tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .btn {
            margin-right: 5px;
        }
    </style>
</head>
<body>
    <?php $this->load->view('sidebar'); ?>
    <div class="main-content">
        <div class="container mt-5">
            <h1 class="text-center mb-4">Manajemen Gudang</h1>

            <a href="#" class="btn btn-success mb-3"><i class="fas fa-plus"></i> Tambah Gudang</a>

            <form action="#" method="get" class="mb-3">
                <div class="input-group">
                    <input type="text" name="keyword" class="form-control" placeholder="Cari gudang...">
                    <button class="btn btn-primary" type="submit"><i class="fas fa-search"></i> Cari</button>
                </div>
            </form>

            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>ID Gudang</th>
                        <th>Lokasi Gudang</th>
                        <th>Kapasitas Maksimal</th>
                        <th>Total Terisi</th>
                        <th>Sisa Kapasitas</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!empty($gudang_data)): ?>
                        <?php foreach ($gudang_data as $gudang): ?>
                            <tr>
                                <td><?php echo $gudang->id_gudang; ?></td>
                                <td><?php echo $gudang->lokasi_gudang; ?></td>
                                <td><?php echo $gudang->kapasitas_gudang; ?></td>
                                <td><?php echo $gudang->total_terisi; ?></td>
                                <td><?php echo $gudang->sisa_kapasitas; ?></td>
                                <td><?php echo $gudang->status_gudang; ?></td>
                                <td>
                                    <a href="#" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</a>
                                    <a href="#" class="btn btn-danger btn-sm" onclick="return confirm('Hapus gudang ini?')"><i class="fas fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
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
</body>
</html>
