<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logistik_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getTotalLogistik() {
        return $this->db->count_all('logistik');
    }

}