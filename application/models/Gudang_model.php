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

    public function getAllGudangData($keyword = null) {
        $this->db->select('g.id_gudang, g.lokasi_gudang, g.kapasitas_gudang, IFNULL(SUM(l.jumlah_barang), 0) AS total_terisi, g.kapasitas_gudang - IFNULL(SUM(l.jumlah_barang), 0) AS sisa_kapasitas, g.status_gudang');
        $this->db->from('gudang g');
        $this->db->join('penyimpanan_gudang pg', 'g.id_gudang = pg.id_gudang', 'left');
        $this->db->join('logistik l', 'pg.id_logistik = l.id_logistik', 'left');
        $this->db->group_by('g.id_gudang');
    
        $result = $this->db->get()->result();
    
        if (!empty($keyword)) {
            $result = array_filter($result, function ($row) use ($keyword) {
                return stripos($row->lokasi_gudang, $keyword) !== false ||
                       stripos($row->kapasitas_gudang, $keyword) !== false ||
                       stripos($row->total_terisi, $keyword) !== false ||
                       stripos($row->sisa_kapasitas, $keyword) !== false ||
                       stripos($row->status_gudang, $keyword) !== false;
            });
        }
    
        return $result;
    }

    public function getLogistikBelumMasukGudang() {
        $this->db->select('logistik.id_logistik, logistik.jumlah_barang');
        $this->db->from('logistik');
        $this->db->join('penyimpanan_gudang', 'logistik.id_logistik = penyimpanan_gudang.id_logistik', 'left');
        $this->db->where('penyimpanan_gudang.id_logistik IS NULL');
        return $this->db->get()->result();
    }
}