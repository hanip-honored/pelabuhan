<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pendataan_Kapal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('login');
        }
        $this->load->model('Kapal_model');
    }

    public function index() {
        $data['ships'] = $this->Kapal_model->getDataKapal();
        $this->load->view('pendataan_kapal/index', $data);
    }

}