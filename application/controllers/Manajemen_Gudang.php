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
        $data['gudang_data'] = $this->Gudang_model->getAllGudangData();
        $this->load->view('manajemen_gudang/index', $data);
    }
}