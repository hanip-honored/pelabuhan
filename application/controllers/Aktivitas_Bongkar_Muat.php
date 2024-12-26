<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Aktivitas_Bongkar_Muat extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('login');
        }
        $this->load->model('Gudang_model');
        $this->load->model('Aktivitas_model');
    }

    public function index() {
        $data['ketersediaan_gudang'] = $this->Gudang_model->getKetersediaanGudang();
        $data['activities'] = $this->Aktivitas_model->getAllData();
        $this->load->view('aktivitas_bongkar_muat/index', $data);
    }

    public function editData() {
        $id = $this->input->get('id');
        $data['aktivitas'] = $this->Aktivitas_model->getActivityById($id);
        $this->load->view('aktivitas_bongkar_muat/edit', $data);
    }
}
