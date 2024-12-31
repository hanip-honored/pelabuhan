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
        $this->db->select('logistik.*');
        $this->db->from('logistik');
        $this->db->join('penyimpanan_gudang', 'logistik.id_logistik = penyimpanan_gudang.id_logistik', 'left');
        $this->db->where('penyimpanan_gudang.id_logistik IS NULL');
        return $this->db->get()->result();
    }

    public function getLastIdGudang() {
        return $this->db->get('gudang')->num_rows();
    }

    public function insertDataGudang($data) {
        return $this->db->insert('gudang', $data);
    }

    public function insertDataLogistikGudang($id_gudang, $id_logistik) {
        $data = [
            'id_penyimpanan' => 'PG' . sprintf("%04s", $this->db->get('penyimpanan_gudang')->num_rows() + 1),
            'id_gudang' => $id_gudang,
            'id_logistik' => $id_logistik,
            'waktu_masuk_gudang' => date('Y-m-d H:i:s'),
            'waktu_keluar_gudang' => '0000-00-00 00:00:00'
        ];
        return $this->db->insert('penyimpanan_gudang', $data);
    }

    public function getLogistik($id_gudang) {
        $this->db->select('penyimpanan_gudang.*, logistik.jumlah_barang');
        $this->db->from('penyimpanan_gudang');
        $this->db->join('logistik', 'penyimpanan_gudang.id_logistik = logistik.id_logistik');
        $this->db->where('penyimpanan_gudang.id_gudang', $id_gudang);
        return $this->db->get()->result_array();
    }

    public function deleteDataGudang($id_gudang) {
        $this->db->where('id_gudang', $id_gudang);
        return $this->db->delete('gudang');
    }

    public function getLogistikByGudang($id_gudang) {
        $this->db->select('id_logistik');
        $this->db->from('penyimpanan_gudang');
        $this->db->where('id_gudang', $id_gudang);
        $query = $this->db->get();
        return $query->result_array();
    }
    

    public function deleteDataPenyimpananGudang($id_gudang) {
        $this->db->where('id_gudang', $id_gudang);
        return $this->db->delete('penyimpanan_gudang');
    }

    public function deleteLogistikPenyimpanan($id_gudang, $id_logistik) {
        return $this->db->delete('penyimpanan_gudang', [
            'id_gudang' => $id_gudang,
            'id_logistik' => $id_logistik
        ]);
    }
    
    public function insertLogistikPenyimpanan($id_gudang, $id_logistik) {
        return $this->db->insert('penyimpanan_gudang', [
            'id_penyimpanan' => 'PG' . sprintf("%04s", $this->db->get('penyimpanan_gudang')->num_rows() + 1),
            'id_gudang' => $id_gudang,
            'id_logistik' => $id_logistik,
            'waktu_masuk_gudang' => date('Y-m-d H:i:s')
        ]);
    }
    

    //LOGISTIK
    public function getLastIdLogistik() {
        return $this->db->get('logistik')->num_rows();
    }

    public function insertDataLogistik($data) {
        return $this->db->insert('logistik', $data);
    }

    public function getNamaKapal() {
        return $this->db->get('kapal')->result();
    }

    public function getKapalLogistik($id_kapal) {
        return $this->db->get_where('kapal', ['id_kapal' => $id_kapal])->result();
    }

    public function deleteLogistik($id_logistik) {
        $this->db->where('id_logistik', $id_logistik);
        return $this->db->delete('logistik');
    }
}