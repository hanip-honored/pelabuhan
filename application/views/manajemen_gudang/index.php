<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Warehouse Management Dashboard</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/manajemen_gudang.css'); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>

    <?php $this->load->view('sidebar'); ?>
    <div class="main-content">
        <div class="navbar">
            <div class="title">Warehouse Management</div>
        </div>

        <div class="container">
            <!-- Summary Cards -->
            <div class="summary">
                <div class="card summary-card">
                    <h3>Total Terbayar</h3>
                    <div class="amount">Rp 50,000</div>
                </div>
                <div class="card summary-card">
                    <h3>Total Belum Dibayar</h3>
                    <div class="amount">Rp 248,000</div>
                </div>
                <div class="card summary-card">
                    <h3>Total Bulan Ini</h3>
                    <div class="amount">Rp 298,000</div>
                </div>
                <div class="card summary-card">
                    <h3>Total Hari Ini</h3>
                    <div class="amount">Rp 248,000</div>
                </div>
            </div>

            <!-- Filter Section -->
            <div class="filter-section">
                <label for="start-date">Dari:</label>
                <input type="date" id="start-date">
                <label for="end-date">Sampai:</label>
                <input type="date" id="end-date">
                <button class="filter-button">Filter</button>
            </div>

            <!-- Data Table -->
            <div class="data-table">
                <h3>Data Laporan Invoice Penjualan</h3>
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>No Nota</th>
                            <th>Tanggal</th>
                            <th>Total Tagihan</th>
                            <th>Diskon</th>
                            <th>Pembeli</th>
                            <th>Status</th>
                            <th>CC</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <!-- Data will be populated here using JavaScript -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script src="<?php echo base_url('assets/js/manajemen_gudang.js'); ?>"></script>
</body>
</html>