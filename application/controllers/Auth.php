<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_model');
    }

    public function index() {
        if ($this->session->userdata('id_user')) {
            redirect('dashboard');
        }
        $this->load->view('auth/login');
    }

    public function login() {
        $this->form_validation->set_rules('username', 'Username', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');

        if ($this->form_validation->run() == FALSE) {
            $this->load->view('auth/login');
        } else {
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            $user = $this->User_model->getUser($username, $password);

            if ($user) {
                $this->session->set_userdata([
                    'id_user' => $user->id_user,
                    'level' => $user->level
                ]);
                redirect('dashboard');
            } else {
                $data['error'] = "Username atau password salah";
                $this->load->view('auth/login', $data);
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect('auth/login');
    }
}
