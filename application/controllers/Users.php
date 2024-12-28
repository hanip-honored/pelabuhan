<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }
    
    public function index() {
        $keyword = $this->input->get('keyword');
        
        $data['users'] = $this->Kapal_model->getAllUsersData($keyword);
        $data['keyword'] = $keyword;
        
        $this->load->view('users/index', $data);
    }

}