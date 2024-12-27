<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getDataKapal() {
        $this->db->select('jadwal.id_jadwal, kapal.nama_kapal, alur_kapal.waktu_masuk, alur_kapal.waktu_keluar, alur_kapal.pelabuhan_asal, alur_kapal.pelabuhan_tujuan, alur_kapal.status_alur');
        $this->db->from('kapal');
        $this->db->join('jadwal', 'kapal.id_kapal = jadwal.id_kapal', 'left');
        $this->db->join('alur_kapal', 'jadwal.id_kapal = alur_kapal.id_kapal', 'left');
        
        return $this->db->get()->result();
    }

    public function insertDataAlurKapal($data) {
        return $this->db->insert('alur_kapal', $data);
    }

    public function getIdAlur() {
        return $this->db->get('alur_kapal')->num_rows();
    }
}