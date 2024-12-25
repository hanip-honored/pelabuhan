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
                            <div class="charts-container d-flex flex-wrap justify-content-center mt-2" style="height: 300px;">
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
                <div class="col-lg-6 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center text-primary">Status Kapal</h5>
                            <ul class="list-group col-md-12">
                                <?php foreach ($status_kapal as $index => $kapal): ?>
                                    <?php
                                        $warnaStatus = '';
                                        if ($kapal->status_kapal === 'Sedang bongkar muat') {
                                            $warnaStatus = 'text-warning';
                                        } elseif ($kapal->status_kapal === 'Masuk') {
                                            $warnaStatus = 'text-success';
                                        } elseif ($kapal->status_kapal === 'Keluar') {
                                            $warnaStatus = 'text-danger';
                                        }
                                    ?>
                                    <li class="list-group-item d-flex justify-content-between align-items-center col-md-12">
                                        <div class="d-flex align-items-center">
                                            <div class="ml-3">
                                                <h6 class="mb-0"><?php echo $kapal->nama_kapal; ?></h6>
                                                <small><?php echo $kapal->jenis_kapal; ?></small>
                                            </div>
                                        </div>
                                        <div class="text-end">
                                            <h6 class="mb-0 <?php echo $warnaStatus; ?>"><?php echo $kapal->status_kapal; ?></h6>
                                        </div>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-left text-primary">Ringkasan Operasional</h5>
                            <p class="text-left fs-6 mb-2">Periode <?php echo get_periode(); ?></p>
                            <div class="d-flex justify-content-between">
                                <div class="text-center">
                                    <div class="icon-container" style="background-color: #e0f7fa; border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-user text-info"></i>
                                    </div>
                                    <p class="mt-2 mb-0">User</p>
                                    <h6 class="text-info"><?php echo $operasional['user'] ?></h6>
                                </div>
                                <div class="text-center">
                                    <div class="icon-container" style="background-color: #e3f2fd; border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-ship text-primary"></i>
                                    </div>
                                    <p class="mt-2 mb-0">Kapal</p>
                                    <h6 class="text-primary"><?php echo $operasional['kapal'] ?></h6>
                                </div>
                                <div class="text-center">
                                    <div class="icon-container" style="background-color: #e8f5e9; border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-box text-success"></i>
                                    </div>
                                    <p class="mt-2 mb-0">Logistik</p>
                                    <h6 class="text-success"><?php echo $operasional['logistik'] ?></h6>
                                </div>
                                <div class="text-center">
                                    <div class="icon-container" style="background-color: #fff3e0; border-radius: 50%; width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas fa-warehouse text-warning"></i>
                                    </div>
                                    <p class="mt-2 mb-0">Gudang</p>
                                    <h6 class="text-warning"><?php echo $operasional['gudang'] ?></h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 mt-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-center text-primary">Cuaca</h5>
                            <div class="temp-icon-container">
                                <img id="weather-icon" src="" alt="Weather Icon" style="width: 100px; height: 70px;">
                                <div class="temp-day-container">
                                    <div class="temp-day">
                                        <p id="temperature" class="display-1 text-primary">--°</p>
                                        <p id="day" class="text-secondary">Day</p>
                                    </div>
                                    <p id="location" class="text-muted">City, Country</p>
                                </div>
                            </div>
                            <p id="wind-speed"></p>
                            <p id="pressure"></p>
                            <p id="wind-direction"></p>
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

    <script src="<?php echo base_url('assets/js/dashboard.js'); ?>" defer></script>
</body>
</html>