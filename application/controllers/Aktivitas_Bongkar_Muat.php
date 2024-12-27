<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktivitas_Bongkar_Muat extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('login');
        }
        $this->load->model('Aktivitas_model');
    }

    public function index() {
        $keyword = $this->input->get('keyword');
        
        $data['activities'] = $this->Aktivitas_model->getAllData($keyword);
        $data['keyword'] = $keyword;
        $data['kapal'] = $this->Aktivitas_model->getAllKapal();
        

        $this->load->view('aktivitas_bongkar_muat/index', $data);
    }

    public function tambahAktivitas() {
        $last_id = $this->Aktivitas_model->getIdLogistik();

        $data = [
            'id_logistik' => 'L' . sprintf("%04s", $last_id + 1),
            'id_kapal' => $this->input->post('id_kapal'),
            'jenis_barang' => $this->input->post('jenis_barang'),
            'jumlah_barang' => $this->input->post('jumlah_barang'),
            'status_logistik' => $this->input->post('status_logistik')
        ];

        if ($this->Aktivitas_model->insertDataAktivitas($data)) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan data.');
        }
        redirect('aktivitas_bongkar_muat');
    }

    public function updateAktivitas() {
        $id = $this->input->post('id_logistik');
        $data = [
            'jenis_barang' => $this->input->post('jenis_barang'),
            'jumlah_barang' => $this->input->post('jumlah_barang'),
            'status_logistik' => $this->input->post('status_logistik')
        ];

        if ($this->Aktivitas_model->updateDataAktivitas($id, $data)) {
            $this->session->set_flashdata('success', 'Data berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui data.');
        }
        redirect('aktivitas_bongkar_muat');
    }

    public function hapusAktivitas($id) {
        if ($this->Aktivitas_model->hapusAktivitas($id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data.');
        }
        redirect('aktivitas_bongkar_muat');
    }
}
