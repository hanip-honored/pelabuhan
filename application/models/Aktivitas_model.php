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
            $this->db->like('logistik.jenis_barang', $keyword);
            $this->db->or_like('kapal.nama_kapal', $keyword);
            $this->db->or_like('logistik.jumlah_barang', $keyword);
            $this->db->or_like('logistik.status_logistik', $keyword);
        }
        
        return $this->db->get()->result();
    }

    public function getAllKapal() {
        return $this->db->get('kapal')->result();
    }
    
    public function insertDataAktivitas($data) {
        return $this->db->insert('logistik', $data);
    }

    public function updateDataAktivitas($id, $data) {
        $this->db->where('id_logistik', $id);
        return $this->db->update('logistik', $data);
    }

    public function getIdLogistik() {
        return $this->db->get('logistik')->num_rows();
    }

    public function hapusAktivitas($id) {
        $this->db->where('id_logistik', $id);
        if ($this->db->delete('logistik')) {
            return true;
        } else {
            return false;
        }
    }
}
