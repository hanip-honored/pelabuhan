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

    const selectElement = $('#edit_logistik');
    selectElement.empty();

    $.ajax({
        url: 'manajemen_gudang/getLogistikByGudang/' + gudang.id_gudang,
        method: 'GET',
        dataType: 'json',
        success: function (relatedLogistik) {
            const combinedLogistik = [...relatedLogistik, ...availableLogistik];

            const uniqueLogistik = combinedLogistik.filter(
                (item, index, self) =>
                    index === self.findIndex((t) => t.id_logistik === item.id_logistik)
            );

            uniqueLogistik.forEach(item => {
                const isSelected = relatedLogistik.some(rel => rel.id_logistik === item.id_logistik);
                const option = new Option(
                    `${item.id_logistik} (${item.jumlah_barang})`,
                    item.id_logistik,
                    isSelected,
                    isSelected 
                );
                selectElement.append(option);
            });

            selectElement.trigger('change');
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Tidak dapat memuat data logistik.'
            });
        }
    });
}

document.addEventListener('DOMContentLoaded', function() { 
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
})

//LOGISTIK
function setEditDataLogistik(logistik) {
    document.getElementById('edit_id_logistik').value = logistik.id_logistik;
    document.getElementById('edit_jenis_barang').value = logistik.jenis_barang;
    document.getElementById('edit_jumlah_barang').value = logistik.jumlah_barang;
    document.getElementById('edit_status_logistik').value = logistik.status_logistik;

    $.ajax({
        url: 'manajemen_gudang/getKapalLogistik/' + logistik.id_kapal,
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            document.getElementById('edit_kapal').value = data[0].id_kapal;
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Gagal',
                text: 'Tidak dapat memuat data kapal.'
            });
        }
    })
}