<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_Kapal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('login');
        }
        $this->load->model('Jadwal_model');
    }

    public function index() {
        $keyword = $this->input->get('keyword');

        $data['jadwall'] = $this->Jadwal_model->getDataKapal($keyword);
        $data['keyword'] = $keyword;

        $this->load->view('jadwal_kapal/index', $data);
    }

    public function tambah() {
        $data['kapal'] = $this->Jadwal_model->getAllKapal();
        $this->load->view('jadwal_kapal/tambah_jadwal_kapal', $data);
    }

    public function tambah_action() {
        $last_id = $this->Jadwal_model->getLastIdAlur();
        $data = [
            'id_alur' => 'AL' . sprintf("%03d", $last_id + 1),
            'id_kapal' => $this->input->post('id_kapal'),
            'waktu_masuk' => $this->input->post('waktu_masuk'),
            'waktu_keluar' => $this->input->post('waktu_keluar'),
            'pelabuhan_asal' => $this->input->post('pelabuhan_asal'),
            'pelabuhan_tujuan' => $this->input->post('pelabuhan_tujuan'),
            'status_alur' => $this->input->post('status_alur'),
        ];
        if ($this->Jadwal_model->insertDataAlurKapal($data)) {
            $this->session->set_flashdata('success', 'Data berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan data.');
        }
        redirect('jadwal_kapal');
    }        

    public function edit($id) {
        $data['alur_kapal'] = $this->Jadwal_model->getJadwalById($id);
        $data['kapal'] = $this->Jadwal_model->getAllKapal();
    
        if (empty($data['alur_kapal'])) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
            redirect('jadwal_kapal');
        }
    
        $this->load->view('jadwal_kapal/edit_jadwal_kapal', $data);
    }    

    public function edit_action() {
        $id = $this->input->post('id_alur');
    
        $data = [
            'id_kapal' => $this->input->post('id_kapal'),
            'waktu_masuk' => $this->input->post('waktu_masuk'),
            'waktu_keluar' => $this->input->post('waktu_keluar'),
            'pelabuhan_asal' => $this->input->post('pelabuhan_asal'),
            'pelabuhan_tujuan' => $this->input->post('pelabuhan_tujuan'),
            'status_alur' => $this->input->post('status_alur'),
        ];
    
        if ($this->Jadwal_model->updateJadwal($id, $data)) {
            $this->session->set_flashdata('success', 'Data berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui data.');
        }
    
        redirect('jadwal_kapal');
    }    

    public function hapus($id = null) {
        if (empty($id)) {
            $this->session->set_flashdata('error', 'ID tidak ditemukan.');
            redirect('jadwal_kapal');
            return;
        }
    
        $data = $this->Jadwal_model->getJadwalById($id);
        if (empty($data)) {
            $this->session->set_flashdata('error', 'Data tidak ditemukan.');
            redirect('jadwal_kapal');
            return;
        }
    
        if ($this->Jadwal_model->deleteJadwal($id)) {
            $this->session->set_flashdata('success', 'Data berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus data.');
        }
        redirect('jadwal_kapal');
    }    
}