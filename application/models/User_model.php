<?php
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

    public function getAllUsersData() {
        $this->db->order_by('id_user', 'DESC');
        return $this->db->get('users')->result();
    }

    public function getAllUsers($keyword = null) {
        if (!empty($keyword)) {
            $this->db->like('nama_user', $keyword);
            $this->db->or_like('level', $keyword);
            $this->db->or_like('username', $keyword);
        }
        return $this->db->get('users')->result();
    }

    public function insertUser($data) {
        return $this->db->insert('users', $data);
    }

    public function updateUser($id, $data) {
        $this->db->where('id_user', $id);
        return $this->db->update('users', $data);
    }

    public function deleteUser($id) {
        $this->db->where('id_user', $id);
        return $this->db->delete('users');
    }

    public function getLastUserId() {
        $this->db->select_max('id_user', 'last_id');
        $query = $this->db->get('users');
        $result = $query->row();
        return substr($result->last_id, 1);
    }
}
