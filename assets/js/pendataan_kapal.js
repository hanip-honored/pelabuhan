function checkInput() {
    const keywordInput = document.getElementById('keywordInput');
    if (keywordInput.value.trim() === '') {
        window.location.href = 'pendataan_kapal';
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
    document.getElementById('edit_kapal_old').src = base_url + "assets/images/ships/" + ship.gambar_kapal;
    document.getElementById('nama_file').textContent = ship.gambar_kapal;
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

    document.querySelectorAll('.hapusButton').forEach(function (button) {
        button.addEventListener('click', function (event) {
            console.log('Hapus');
            event.preventDefault();
            const href = this.dataset.href;
            Swal.fire({
                title: "Apakah Anda yakin?",
                text: "Data akan dihapus",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, hapus!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = href;
                }
            });
        });
    }); 
});
