<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajemen_Gudang extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('login');
        }
        $this->load->model('Gudang_model');
    }

    public function index() {
        $data['ketersediaan_gudang'] = $this->Gudang_model->getKetersediaanGudang();
        $this->load->view('manajemen_gudang/index', $data);
    }

}