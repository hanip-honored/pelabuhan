<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendataan Kapal</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/pendataan_kapal.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
<?php $this->load->view('sidebar'); ?>
<div class="main-content">
    <div class="container">
        <h1 class="text-center mb-4 mt-2">Pendataan Kapal</h1>
        <a href=""><button class="btn btn-success mb-4">+ Tambah Data</button></a>
        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>Nama Kapal</th>
                    <th>Jenis Kapal</th>
                    <th>Gambar Kapal</th>
                    <th>Ukuran Kapal (M)</th>
                    <th>Kapasitas Muatan (TEU)</th>
                    <th>Status Kapal</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ships as $ship): ?>
                <tr>
                    <td><?php echo $ship->nama_kapal; ?></td>
                    <td><?php echo $ship->jenis_kapal; ?></td>
                    <td>
                        <img src="<?php echo base_url('assets/images/ships/kapal.jpg'); ?>" alt="Ship Image" class="ship-image">
                    </td>
                    <td><?php echo $ship->ukuran_kapal; ?></td>
                    <td><?php echo $ship->kapasitas_muatan; ?></td>
                    <td><?php echo $ship->status_kapal; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>
