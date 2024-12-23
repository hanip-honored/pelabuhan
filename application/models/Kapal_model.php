<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kapal_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getStatusKapal() {
        return $this->db->get('kapal')->result();
    }
    
    public function getDataKapal() {
        return $this->db->get('kapal')->result();
    }
}