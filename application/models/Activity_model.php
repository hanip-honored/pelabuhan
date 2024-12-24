<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Activity_model extends CI_Model {
    public function getAllActivities() {
        $this->db->select('logistik.*, kapal.nama_kapal');
        $this->db->from('logistik');
        $this->db->join('kapal', 'logistik.id_kapal = kapal.id_kapal');
        return $this->db->get()->result();
    }
}
