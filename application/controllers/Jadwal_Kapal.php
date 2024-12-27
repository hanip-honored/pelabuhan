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
        $data['jadwal_kapal'] = $this->Jadwal_model->getDataKapal();
        $this->load->view('jadwal_kapal/index', $data);
    }

    public function tambah() {
        $this->load->view('jadwal_kapal/tambah_jadwal_kapal');
    }

    public function tambah_action() {
        $data = [
            'nama_kapal' => $this->input->post('nama_kapal'),
            'status_alur' => $this->input->post('status_alur'),
            'waktu_masuk' => $this->input->post('waktu_masuk'),
            'waktu_keluar' => $this->input->post('waktu_keluar'),
            'jenis_operasi' => $this->input->post('jenis_operasi'),
        ];
    
        $this->db->insert('jadwal_kapal', $data);
    
        redirect('jadwal_kapal');
    }
    
}