<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getDataKapal() {
        $this->db->select('alur_kapal.*, kapal.nama_kapal, alur_kapal.status_alur');
        $this->db->from('alur_kapal');
        $this->db->join('kapal', 'alur_kapal.id_kapal = kapal.id_kapal');
        
        return $this->db->get()->result();
    }

}