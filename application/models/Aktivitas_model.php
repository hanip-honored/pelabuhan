    <?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Aktivitas_model extends CI_Model {

        public function __construct() {
            parent::__construct();
            $this->load->database();
        }

        public function getAllData() {
            $this->db->select('logistik.*, kapal.nama_kapal');
            $this->db->from('logistik');
            $this->db->join('kapal', 'logistik.id_kapal = kapal.id_kapal');
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