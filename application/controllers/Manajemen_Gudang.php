<?php
// Controller: Manajemen_Gudang.php
class Manajemen_Gudang extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('login');
        }
        $this->load->model('Gudang_model');
    }

    public function index() {
        $keyword = $this->input->get('keyword');
        
        $data['keyword'] = $keyword;
        $data['gudang_data'] = $this->Gudang_model->getAllGudangData($keyword);
        $data['logistik'] = $this->Gudang_model->getLogistikBelumMasukGudang();
        $data['kapal'] = $this->Gudang_model->getNamaKapal();
        $this->load->view('manajemen_gudang/index', $data);
    }

    public function tambah_gudang() {
        $last_id = $this->Gudang_model->getLastIdGudang();
        $id = 'G' . sprintf("%02s", $last_id + 1);

        $data = [
            'id_gudang' => $id,
            'lokasi_gudang' => $this->input->post('lokasi_gudang'),
            'lokasi_gudang' => $this->input->post('lokasi_gudang'),
            'kapasitas_gudang' => $this->input->post('kapasitas_gudang'),
            'status_gudang' => "",
        ];

        if ($this->Gudang_model->insertDataGudang($data)) {
            $logistik = $this->input->post('logistik');
            foreach ($logistik as $log) {
                $this->Gudang_model->insertDataLogistikGudang($id, $log);
            }

            $this->session->set_flashdata('success', 'Data berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan data.');
        }
        redirect('manajemen_gudang');
    }

    public function getLogistikByGudang($id_gudang) {
        $logistik = $this->Gudang_model->getLogistik($id_gudang);
        echo json_encode($logistik);
    }

    public function hapus_gudang($id_gudang) {
        if ($this->Gudang_model->deleteDataPenyimpananGudang($id_gudang)) {
            if ($this->Gudang_model->deleteDataGudang($id_gudang)) {
                $this->session->set_flashdata('success', 'Data berhasil dihapus.');
            } else {
                $this->session->set_flashdata('error', 'Gagal menghapus data.');
            }
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data.');
        }
        redirect('manajemen_gudang');
    }

    public function updateGudangLogistik() {
        $id_gudang = $this->input->post('id_gudang');
        $logistik_input = $this->input->post('edit_logistik');
    
        if (!is_array($logistik_input)) {
            $logistik_input = [];
        }
    
        $logistik_db = $this->Gudang_model->getLogistikByGudang($id_gudang);
        $logistik_db_ids = array_column($logistik_db, 'id_logistik');
    
        $added = array_diff($logistik_input, $logistik_db_ids);
        $removed = array_diff($logistik_db_ids, $logistik_input); 
    
        if (!empty($added)) {
            foreach ($added as $id_logistik) {
                $this->Gudang_model->insertLogistikPenyimpanan($id_gudang, $id_logistik);
            }
        }
    
        if (!empty($removed)) {
            foreach ($removed as $id_logistik) {
                $this->Gudang_model->deleteLogistikPenyimpanan($id_gudang, $id_logistik);
            }
        }
    
        $this->session->set_flashdata('success', 'Data gudang berhasil diperbarui.');
        redirect('manajemen_gudang');
    }    

    // LOGSITIK
    public function tambah_logistik() {
        $last_id = $this->Gudang_model->getLastIdLogistik();
        $id = 'L' . sprintf("%04s", $last_id + 1);

        $data = [
            'id_logistik' => $id,
            'id_kapal' => $this->input->post('kapal'),
            'jenis_barang' => $this->input->post('jenis_barang'),
            'jumlah_barang' => $this->input->post('jumlah_barang'),
            'status_logistik' => $this->input->post('status_logistik'),
        ];

        if ($this->Gudang_model->insertDataLogistik($data)) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan data.');
        }

        redirect('manajemen_gudang');
    }

    public function hapusLogistik($id_logistik) {
        if ($this->Gudang_model->deleteLogistik($id_logistik)) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan data.');
        }
        redirect('manajemen_gudang');
    }

    public function getKapalLogistik($id_kapal) {
        $kapal = $this->Gudang_model->getKapalLogistik($id_kapal);
        echo json_encode($kapal);
    }
}