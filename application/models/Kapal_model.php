<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kapal_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function getDataKapal() {
        return $this->db->get('kapal')->result();
    }

    public function getTotalKapal() {
        return $this->db->count_all('kapal');
    }
}