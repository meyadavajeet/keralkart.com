<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Login_detailed_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    Public function login($username, $password) {
        $this->load->database();
        $this->db->where('username', $username);
        $this->db->where('ePassword', $password);
        $this->db->where('role', '1');
        $this->db->where('status', '1');
        $res = $this->db->get('adminlogin');
        return $res->row_array();
    }

}
