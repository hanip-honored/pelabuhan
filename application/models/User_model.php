<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getUser($username, $password) {
        $user = $this->db->get_where('users', ['username' => $username])->row();
        if ($user && $password == $user->password) {
            return $user;
        }
        return false;
    }

    public function getTotalUser() {
        return $this->db->count_all('users');
    }
}