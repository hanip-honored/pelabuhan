function checkInput() {
    const keywordInput = document.getElementById('keywordInput');
    if (keywordInput.value.trim() === '') {
        window.location.href = 'aktivitas_bongkar_muat';
    }
}

function setEditData(ship) {
    document.getElementById('edit_id_kapal').value = ship.id_kapal;
    document.getElementById('edit_old_gambar_kapal').value = ship.gambar_kapal;
    document.getElementById('edit_nama_kapal').value = ship.nama_kapal;
    document.getElementById('edit_jenis_kapal').value = ship.jenis_kapal;
    document.getElementById('edit_ukuran_kapal').value = ship.ukuran_kapal;
    document.getElementById('edit_kapasitas_muatan').value = ship.kapasitas_muatan;
    document.getElementById('edit_status_kapal').value = ship.status_kapal;
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('editForm').addEventListener('submit', function(event) {
        event.preventDefault();
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data akan diupdate",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, simpan perubahan!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('editForm').submit();
            }
        });
    });
});
