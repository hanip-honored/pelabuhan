<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kapal_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getDataKapal($keyword = null) {
        if (!empty($keyword)) {
            $this->db->like('nama_kapal', $keyword);
            $this->db->or_like('jenis_kapal', $keyword);
            $this->db->or_like('ukuran_kapal', $keyword);
            $this->db->or_like('kapasitas_muatan', $keyword);
            $this->db->or_like('status_kapal', $keyword);
        }
        return $this->db->get('kapal')->result();
    }
    
    public function getDataKapalTerbaru() {
        $this->db->order_by('id_kapal', 'DESC');
        $this->db->limit(4);
        return $this->db->get('kapal')->result();
    }

    public function getTotalKapal() {
        return $this->db->count_all('kapal');
    }
    
    public function insertKapal($data) {
        return $this->db->insert('kapal', $data);
    }

    public function getKapalId() {
        return $this->db->get('kapal')->num_rows();
    }

    public function updateKapal($id, $data) {
        $this->db->where('id_kapal', $id);
        return $this->db->update('kapal', $data);
    }

    public function deleteKapal($id) {
        $this->db->where('id_kapal', $id);
        if ($this->db->delete('kapal')) {
            return true;
        } else {
            return false;
        }
    }
}
