<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Manajemen_User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if (!$this->session->userdata('id_user')) {
            redirect('login');
        }
        $this->load->model('User_model');
    }

    public function index() {
        $keyword = $this->input->get('keyword');
        
        $data['users'] = $this->User_model->getAllUsers($keyword);
        $data['keyword'] = $keyword;

        $this->load->view('manajemen_user/index', $data);
    }

    public function tambahUser() {
        $last_id = $this->User_model->getLastUserId();

        $data = [
            'id_user' => 'U' . sprintf("%03s", $last_id + 1),
            'nama_user' => $this->input->post('nama_user'),
            'level' => $this->input->post('level'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
        ];

        if ($this->User_model->insertUser($data)) {
            $this->session->set_flashdata('success', 'User berhasil ditambahkan.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menambahkan user.');
        }
        redirect('manajemen_user');
    }

    public function updateUser() {
        $id = $this->input->post('id_user');
        $data = [
            'nama_user' => $this->input->post('nama_user'),
            'level' => $this->input->post('level'),
            'username' => $this->input->post('username'),
            'password' => $this->input->post('password')
        ];

        if ($this->User_model->updateUser($id, $data)) {
            $this->session->set_flashdata('success', 'User berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('error', 'Gagal memperbarui user.');
        }
        redirect('manajemen_user');
    }

    public function hapusUser($id) {
        if ($this->User_model->deleteUser($id)) {
            $this->session->set_flashdata('success', 'User berhasil dihapus.');
        } else {
            $this->session->set_flashdata('error', 'Gagal menghapus user.');
        }
        redirect('manajemen_user');
    }
}