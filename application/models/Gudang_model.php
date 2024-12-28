<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getKetersediaanGudang() {
        $this->db->order_by('sisa_kapasitas', 'DESC');
        $this->db->limit(2);
        return $this->db->get('ketersediaan_gudang')->result();
    }
    

    public function getTotalGudang() {
        return $this->db->count_all('gudang');
    }

    public function getAllGudangData() {
        $query = $this->db->query("SELECT g.id_gudang, g.lokasi_gudang, g.kapasitas_gudang, IFNULL(SUM(l.jumlah_barang), 0) AS total_terisi, g.kapasitas_gudang - IFNULL(SUM(l.jumlah_barang), 0) AS sisa_kapasitas, g.status_gudang FROM gudang g LEFT JOIN penyimpanan_gudang pg ON g.id_gudang = pg.id_gudang LEFT JOIN logistik l ON pg.id_logistik = l.id_logistik GROUP BY g.id_gudang");
        return $query->result();
    }
}