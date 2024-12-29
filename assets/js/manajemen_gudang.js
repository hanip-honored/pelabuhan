function checkInput() {
    const keywordInput = document.getElementById('keywordInput');
    if (keywordInput.value.trim() === '') {
        window.location.href = 'manajemen_gudang';
    }
}

function setEditData(gudang) {
    document.getElementById('edit_id_gudang').value = gudang.id_gudang;
    document.getElementById('edit_lokasi_gudang').value = gudang.lokasi_gudang;
    document.getElementById('edit_kapasitas_maksimal').value = gudang.kapasitas_gudang;
}