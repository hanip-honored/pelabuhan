<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/dashboard.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <button id="menu-toggle" class="menu-toggle">
        <i class="fas fa-bars"></i>
    </button>

    <?php $this->load->view('sidebar'); ?>

    <div class="main-content">
        <header>
            <h2>Dashboard Admin</h2>
            <p>Selamat datang di Sistem Manajemen Pelabuhan</p>
        </header>

        <!-- Visualisasi Data -->
        <div class="container mt-4">
            <div class="row">
                <!-- Card Setengah Halaman -->
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center text-primary">Visualisasi Data Gudang</h5>
                            <div class="charts-container d-flex flex-wrap justify-content-center">
                                <?php foreach ($ketersediaan_gudang as $index => $gudang): ?>
                                    <div class="chart-item m-3">
                                        <!-- Canvas untuk Chart -->
                                        <canvas id="chartGudang<?php echo $index; ?>" style="width: 100%; height: auto;"></canvas>
                                        <p class="text-center mt-2">Gudang <?php echo $gudang->lokasi_gudang ?></p>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            const dataGudang = <?php echo json_encode($ketersediaan_gudang); ?>; // Data PHP dari server

            dataGudang.forEach((gudang, index) => {
                const ctx = document.getElementById(`chartGudang${index}`).getContext('2d');
                new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: ['Ruang Terisi', 'Ruang Kosong'],
                        datasets: [{
                            data: [gudang.total_logistik, gudang.sisa_kapasitas],
                            backgroundColor: ['rgba(255, 99, 132, 0.6)', 'rgba(54, 162, 235, 0.6)'],
                            borderColor: ['rgba(255, 99, 132, 1)', 'rgba(54, 162, 235, 1)'],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top'
                            },
                            tooltip: {
                                callbacks: {
                                    label: function(context) {
                                        const value = context.raw;
                                        return `${context.label}: ${value}`;
                                    }
                                }
                            }
                        }
                    }
                });
            });
        </script>
    </div>

    <script src="<?php echo base_url('assets/js/dashboard.js'); ?>"></script>
</body>
</html>