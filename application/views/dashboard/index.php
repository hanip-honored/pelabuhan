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
            <img alt="Profile picture" src="https://placehold.co/80x80"/>
            <div class="location">
                <h1>Jogja, ID</h1>
                <p>Sabtu, 28 Desember</p>
            </div>
            <div class="weather">
                <h1>30&deg;</h1>
                <p>Lembab, berawan</p>
            </div>
        </div>
        <div class="menu">
            <div class="menu-item">
                <div class="icon">
                    <i class="fas fa-ship"></i>
                </div>
                <p>Jadwal Kapal</p>
            </div>
            <div class="menu-item">
                <div class="icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <p>Pendataan Kapal</p>
            </div>
            <div class="menu-item">
                <div class="icon">
                    <i class="fas fa-boxes"></i>
                </div>
                <p>Aktivitas Bongkar Muat</p>
            </div>
            <div class="menu-item">
                <div class="icon">
                    <i class="fas fa-warehouse"></i>
                </div>
                <p>Manajemen Gudang</p>
            </div>
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
                    <h3><?php echo $operasional['kapal']; ?></h3>
                    <p>Kapal Beroperasi</p>
                </div>
                <div class="summary-item">
                    <h3><?php echo $operasional['gudang']; ?></h3>
                    <p>Gudang Tersedia</p>
                </div>
                <div class="summary-item">
                    <h3><?php echo $operasional['user']; ?></h3>
                    <p>User Beroperasi</p>
                </div>
                <div class="summary-item">
                    <h3><?php echo $operasional['logistik']; ?></h3>
                    <p>Barang Tersimpan</p>
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
</body>
</html>
