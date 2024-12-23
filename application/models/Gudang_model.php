<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Gudang_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getKetersediaanGudang() {
        return $this->db->get('ketersediaan_gudang')->result();
    }

}