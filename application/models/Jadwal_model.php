<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getDataKapal() {
        $this->db->select('jadwal.id_jadwal, kapal.nama_kapal, alur_kapal.status_alur, alur_kapal.waktu_masuk, alur_kapal.waktu_keluar, jadwal.jenis_operasi');
        $this->db->from('kapal');
        $this->db->join('jadwal', 'kapal.id_kapal = jadwal.id_kapal', 'left'); // LEFT JOIN kapal
        $this->db->join('alur_kapal', 'jadwal.id_kapal = alur_kapal.id_kapal', 'left'); // LEFT JOIN jadwal (tambahan jika dibutuhkan)
        
        return $this->db->get()->result();
    }
}