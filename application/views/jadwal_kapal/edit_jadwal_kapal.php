<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Jadwal Kapal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/edit_jadwal_kapal.css'); ?>">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Jadwal Kapal</h1>

        <div class="calendar"></div>

        <form action="<?php echo site_url('jadwal_kapal/edit_action'); ?>" method="post">
            <input type="hidden" name="id_alur" value="<?php echo $alur_kapal[0]->id_alur; ?>">
            
            <div class="mb-3">
                <label for="nama_kapal" class="form-label">Nama Kapal</label>
                <select class="form-select" id="nama_kapal" name="id_kapal" required>
                    <option value="<?php echo $alur_kapal[0]->id_kapal ?>" selected><?php echo $alur_kapal[0]->nama_kapal ?></option>
                    <?php foreach ($kapal as $k): ?>
                        <?php if ($k->id_kapal != $alur_kapal[0]->id_kapal): ?>
                            <option value="<?php echo $k->id_kapal; ?>"><?php echo $k->nama_kapal; ?></option>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label for="waktu_masuk" class="form-label">Waktu Masuk</label>
                <input type="datetime-local" class="form-control" id="waktu_masuk" name="waktu_masuk" value="<?php echo $alur_kapal[0]->waktu_masuk ?>" required>
            </div>

            <div class="mb-3">
                <label for="waktu_keluar" class="form-label">Waktu Keluar</label>
                <input type="datetime-local" class="form-control" id="waktu_keluar" name="waktu_keluar" value="<?php echo $alur_kapal[0]->waktu_keluar ?>" required>
            </div>

            <div class="mb-3">
                <label for="pelabuhan_asal" class="form-label">Pelabuhan Asal</label>
                <input type="text" class="form-control" id="pelabuhan_asal" name="pelabuhan_asal" value="<?php echo $alur_kapal[0]->pelabuhan_asal ?>" required>
            </div>

            <div class="mb-3">
                <label for="pelabuhan_tujuan" class="form-label">Pelabuhan Tujuan</label>
                <input type="text" class="form-control" id="pelabuhan_tujuan" name="pelabuhan_tujuan" value="<?php echo $alur_kapal[0]->pelabuhan_tujuan ?>" required>
            </div>

            <div class="mb-3">
                <label for="status_alur" class="form-label">Status Alur</label>
                <select class="form-select" id="status_alur" name="status_alur" required>
                    <option value="<?php echo $alur_kapal[0]->status_alur; ?>" selected><?php echo ucfirst($alur_kapal[0]->status_alur); ?></option>
                    <?php if ($alur_kapal[0]->status_alur != 'dijadwalkan'): ?>
                        <option value="dijadwalkan">Dijadwalkan</option>
                    <?php endif; ?>
                    <?php if ($alur_kapal[0]->status_alur != 'proses'): ?>
                        <option value="proses">Proses</option>
                    <?php endif; ?>
                    <?php if ($alur_kapal[0]->status_alur != 'selesai'): ?>
                        <option value="selesai">Selesai</option>
                    <?php endif; ?>
                </select>
            </div>

            <div class="d-flex justify-content-between">
                <button type="button" class="btn btn-secondary" onclick="resetSelection()">Reset Kalender</button>
                <button type="submit" class="btn btn-primary">Simpan Jadwal</button>
            </div>
        </form>
    </div>
    <script src="<?php echo base_url('assets/js/edit_jadwal_kapal.js'); ?>" defer></script>
</body>
</html>