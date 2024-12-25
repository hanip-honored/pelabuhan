<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('login');
        }
        $this->load->model('User_model');
        $this->load->model('Gudang_model');
        $this->load->model('Logistik_model');
        $this->load->model('Kapal_model');
    }

    public function index() {
        $data['status_kapal'] = $this->Kapal_model->getDataKapal();
        $data['ketersediaan_gudang'] = $this->Gudang_model->getKetersediaanGudang();
        $data['operasional'] = [
            'user' => $this->User_model->getTotalUser(),
            'kapal' => $this->Kapal_model->getTotalKapal(),
            'logistik' => $this->Logistik_model->getTotalLogistik(),
            'gudang' => $this->Gudang_model->getTotalGudang()
        ];
        $this->load->view('dashboard/index', $data);
    }

}