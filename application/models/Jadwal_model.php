<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getDataKapal($keyword = null) {
        $this->db->select('alur_kapal.id_alur, kapal.nama_kapal, alur_kapal.waktu_masuk, alur_kapal.waktu_keluar, alur_kapal.pelabuhan_asal, alur_kapal.pelabuhan_tujuan, alur_kapal.status_alur');
        $this->db->from('alur_kapal');
        $this->db->join('kapal', 'alur_kapal.id_kapal = kapal.id_kapal', 'left');
        if (!empty($keyword)) {
            $this->db->like('kapal.nama_kapal', $keyword);
        }
        return $this->db->get()->result();
    }

    public function insertDataAlurKapal($data) {
        return $this->db->insert('alur_kapal', $data);
    }

    public function getIdAlur() {
        $this->db->select_max('id_alur', 'last_id');
        $query = $this->db->get('alur_kapal');
        $result = $query->row();
    
        if ($result && $result->last_id) {
            $lastIdNumber = (int) substr($result->last_id, 2);
            return $lastIdNumber + 1;
        }
    
        return 1;
    }    

    public function getLastIdAlur() {
        return $this->db->get('alur_kapal')->num_rows();
    }       

    public function getAllKapal() {
        $this->db->select('id_kapal, nama_kapal');
        $this->db->from('kapal');
        return $this->db->get()->result();
    }    

    public function getJadwalById($id) {
        $this->db->select('alur_kapal.*, kapal.nama_kapal');
        $this->db->from('alur_kapal');
        $this->db->join('kapal', 'alur_kapal.id_kapal = kapal.id_kapal');
        $this->db->where('alur_kapal.id_alur', $id);
        return $this->db->get()->result();
    }

    public function updateJadwal($id, $data) {
        $this->db->where('id_alur', $id);
        return $this->db->update('alur_kapal', $data);
    }

    public function deleteJadwal($id) {
        return $this->db->delete('alur_kapal', ['id_alur' => $id]);
    }    
}