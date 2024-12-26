<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktivitas_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getAllData($keyword = null) {
        $this->db->select('logistik.*, kapal.nama_kapal');
        $this->db->from('logistik');
        $this->db->join('kapal', 'logistik.id_kapal = kapal.id_kapal');
        
        if (!empty($keyword)) {
            $this->db->like('logistik.nama_logistik', $keyword);
            $this->db->or_like('kapal.nama_kapal', $keyword);
            $this->db->or_like('logistik.jenis_logistik', $keyword);
            $this->db->or_like('logistik.jenis_logistik', $keyword);
        }
        
        return $this->db->get()->result();
    }
    

    public function getActivityById($id) {
        $this->db->select('logistik.*, kapal.nama_kapal');
        $this->db->from('logistik');
        $this->db->join('kapal', 'logistik.id_kapal = kapal.id_kapal');
        $this->db->where('id_logistik', $id);
        return $this->db->get()->result();
    }
}