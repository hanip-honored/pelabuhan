function setEditData(ship) {
  document.getElementById('edit_id_kapal').value = ship.id_kapal;
  document.getElementById('edit_nama_kapal').value = ship.nama_kapal;
  document.getElementById('edit_jenis_kapal').value = ship.jenis_kapal;
  document.getElementById('edit_ukuran_kapal').value = ship.ukuran_kapal;
  document.getElementById('edit_kapasitas_muatan').value = ship.kapasitas_muatan;
  document.getElementById('edit_status_kapal').value = ship.status_kapal;
}