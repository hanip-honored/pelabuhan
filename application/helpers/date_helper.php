<?php
if (!function_exists('get_periode')) {
    function get_periode() {
        $tanggal_awal = date('Y-m-01'); // Tanggal 1 bulan ini
        $tanggal_akhir = date('Y-m-t'); // Tanggal terakhir bulan ini
        return date('d M Y', strtotime($tanggal_awal)) . " - " . date('d M Y', strtotime($tanggal_akhir));
    }
}
