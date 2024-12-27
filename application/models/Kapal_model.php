<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kapal_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getDataKapal() {
        return $this->db->get('kapal')->result();
    }

    public function getTotalKapal() {
        return $this->db->count_all('kapal');
    }
    
    public function insertKapal($data) {
        return $this->db->insert('kapal', $data);
    }

    public function getKapalById($id) {
        return $this->db->get_where('kapal', ['id_kapal' => $id])->row();
    }

    public function updateKapal($id, $data) {
        $this->db->where('id_kapal', $id);
        return $this->db->update('kapal', $data);
    }

    public function deleteKapal($id) {
        $this->db->where('id_kapal', $id);
        return $this->db->delete('kapal');
    }
}
