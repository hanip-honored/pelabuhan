<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/dashboard.css'); ?>">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <div class="container">
        <div class="header">
            <img alt="Profile picture" src="<?php echo base_url('assets/images/users/admin.png'); ?>" />
            <div class="location-weather">
                <div class="location">
                    <h2 id="location" class="text-muted">City, Country</h2>
                    <p id="day" class="text-secondary">Day</p>
                </div>
                <div class="weather-icon">
                    <img id="weather-icon" src="" alt="Weather Icon" />
                </div>
                <div class="weather">
                    <p id="temperature">30°</p>
                    <p id="weather-description">Lembab, berawan</p>
                </div>
            </div>
        </div>
        <div class="menu">
            <?php if ($_SESSION['level'] == 'admin'): ?>
                <a href="<?php echo site_url('manajemen_user'); ?>" class="menu-item">
                    <div class="icon">
                        <i class="fas fa-user"></i>
                    </div>
                    <p>Manajemen User</p>
                </a>
            <?php endif; ?>

            <?php if ($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'petugas kapal'): ?>
                <a href="<?php echo site_url('jadwal_kapal'); ?>" class="menu-item">
                    <div class="icon">
                        <i class="fas fa-ship"></i>
                    </div>
                    <p>Jadwal Kapal</p>
                </a>
                <a href="pendataan_kapal" class="menu-item">
                    <div class="icon">
                        <i class="fas fa-clipboard-list"></i>
                    </div>
                    <p>Pendataan Kapal</p>
                </a>
            <?php endif; ?>

            <?php if ($_SESSION['level'] == 'admin' || $_SESSION['level'] == 'petugas gudang'): ?>
                <a href="aktivitas_bongkar_muat" class="menu-item">
                    <div class="icon">
                        <i class="fas fa-boxes"></i>
                    </div>
                    <p>Aktivitas Bongkar Muat</p>
                </a>
                <a href="manajemen_gudang" class="menu-item">
                    <div class="icon">
                        <i class="fas fa-warehouse"></i>
                    </div>
                    <p>Manajemen Gudang</p>
                </a>
            <?php endif; ?>
        </div>
        <div class="visualization">
            <h2>Visualisasi Data Gudang</h2>
            <div class="chart-container">
                <?php foreach ($ketersediaan_gudang as $index => $gudang): ?>
                    <div class="chart-item">
                        <canvas id="chartGudang<?php echo $index; ?>"></canvas>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="content">
            <div class="summary">
                <div class="summary-item">
                    <div class="summary-text">
                        <h3><?php echo $operasional['kapal']; ?></h3>
                        <p>Kapal Beroperasi</p>
                        <p class="change text-danger">-10% dari bulan lalu</p>
                    </div>
                    <img src="path/to/kapal-icon.png" alt="Icon Kapal">
                </div>
                <div class="summary-item">
                    <div class="summary-text">
                        <h3><?php echo $operasional['gudang']; ?></h3>
                        <p>Gudang Tersedia</p>
                        <p class="change text-success">+2% dari bulan lalu</p>
                    </div>
                    <img src="path/to/gudang-icon.png" alt="Icon Gudang">
                </div>
                <div class="summary-item">
                    <div class="summary-text">
                        <h3><?php echo $operasional['user']; ?></h3>
                        <p>User Beroperasi</p>
                        <p class="change text-danger">-1 dari bulan lalu</p>
                    </div>
                    <img src="path/to/user-icon.png" alt="Icon User">
                </div>
                <div class="summary-item">
                    <div class="summary-text">
                        <h3><?php echo $operasional['logistik']; ?></h3>
                        <p>Barang Tersimpan</p>
                        <p class="change text-success">+20% dari bulan lalu</p>
                    </div>
                    <img src="path/to/logistik-icon.png" alt="Icon Barang">
                </div>
            </div>
            <div class="ship-status">
                <table>
                    <thead>
                        <tr>
                            <th>Nama Kapal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($status_kapal as $kapal): ?>
                            <tr>
                                <td><?php echo $kapal->nama_kapal; ?></td>
                                <td class="status <?php echo strtolower(str_replace(' ', '-', $kapal->status_kapal)); ?>">
                                    <?php echo $kapal->status_kapal; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const dataGudang = <?php echo json_encode($ketersediaan_gudang); ?>;
        dataGudang.forEach((gudang, index) => {
            const ctx = document.getElementById(`chartGudang${index}`).getContext('2d');
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Ruang Terisi', 'Ruang Kosong'],
                    datasets: [{
                        data: [gudang.total_logistik, gudang.sisa_kapasitas],
                        backgroundColor: ['#ff6384', '#36a2eb'],
                        borderColor: ['#ff6384', '#36a2eb'],
                        borderWidth: 1
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        }
                    }
                }
            });
        });
    </script>
    <script src="<?php echo base_url('assets/js/dashboard.js'); ?>" defer></script>
</body>
</html>
