<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('login');
        }
        $this->load->model('Gudang_model');
        $this->load->model('Kapal_model');
    }

    public function index() {
        $data['status_kapal'] = $this->Kapal_model->getStatusKapal();
        $data['ketersediaan_gudang'] = $this->Gudang_model->getKetersediaanGudang();
        $this->load->view('dashboard/index', $data);
    }

}