<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwal_Kapal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('login');
        }
        $this->load->model('Jadwal_model');
        $this->load->model('Aktivitas_model');
    }

    public function index() {
        $data['jadwal_kapal'] = $this->Jadwal_model->getDataKapal();
        $this->load->view('jadwal_kapal/index', $data);
    }

    public function tambah() {
        $data['kapal'] = $this->Aktivitas_model->getAllKapal();
        $this->load->view('jadwal_kapal/tambah_jadwal_kapal', $data);
    }

    public function tambah_action() {
        $last_id = $this->Jadwal_model->getIdAlur();
        $data = [
            'id_alur' => 'AL' . sprintf("%04s", $last_id + 1),
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
    
}