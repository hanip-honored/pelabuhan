function checkInput() {
    const keywordInput = document.getElementById('keywordInput');
    if (keywordInput.value.trim() === '') {
        window.location.href = 'aktivitas_bongkar_muat';
    }
}

function setEditData(aktivitas) {
    document.getElementById('edit_id_logistik').value = aktivitas.id_logistik;
    document.getElementById('edit_nama_kapal').value = aktivitas.nama_kapal;
    document.getElementById('edit_jenis_barang').value = aktivitas.jenis_barang;
    document.getElementById('edit_jumlah_barang').value = aktivitas.jumlah_barang;
    document.getElementById('edit_status_logistik').value = aktivitas.status_logistik;
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
