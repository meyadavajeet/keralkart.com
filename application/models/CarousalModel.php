<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class CarousalModel extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function slider_list() {
        $this->db->select('*');
        $this->db->from('tbl_slider_mstr');
        $query = $this->db->get();
        return $query->row_array();
    }
    public function update_sliders($slider1, $slider2, $slider3, $slider4) {
        $update_sliders = array(
            'slider1' => $slider1,
            'slider2' => $slider2,
            'slider3' => $slider3,
            'slider4' => $slider4
        );
        $this->db->where("slider_id", '1');
        $this->db->update('tbl_slider_mstr', $update_sliders);
    }


}