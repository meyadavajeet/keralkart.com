<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Carousal extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('CarousalModel');
    }

        /*     * ************* code starts *************************** */

    function clean_title($string) {
        // Replace other special chars
                $specialCharacters = array(
                    '#' => '',
                    '%' => '',
                    '&' => '',
                    '@' => '',
                    '€' => '',
                    '+' => '',
                    '=' => '',
                    '§' => '',
                    '\\' => '',
                    '/' => '',
                    '-' => '',
                    '$' => '',
                    '!' => '',
                    '^' => '',
                    '*' => '',
                    '"' => ''
                );
                while (list($character, $replacement) = each($specialCharacters)) {
                    $string = str_replace($character, '' . $replacement . '', $string);
                }
                $string = strtr($string, "ÀÁÂÃÄÅ�áâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ", "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn"
                );
    // Remove all remaining other unknown characters
        $string = preg_replace('/[^a-zA-Z0-9\-.$"]/', '-', $string);
        return $string;
    }
    
        function get_random_name($chars_min = 6, $chars_max = 6, $use_upper_case = true, $include_numbers = true, $include_special_chars = false) {
            $length = rand($chars_min, $chars_max);
            $selection = 'aeuoyibcdfghjklmnpqrstvwxz';
            if ($include_numbers) {
                $selection .= "1234567890";
            }
            if ($include_special_chars) {
                $selection .= "!@\"#$%&[]{}?|";
            }
            $password = "";
            for ($i = 0; $i < $length; $i++) {
                $current_letter = $use_upper_case ? (rand(0, 1) ? strtoupper($selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))]) : $selection[(rand() % strlen($selection))];
                $password .= $current_letter;
            }
            return $password;
        }


    public function manageCarousal() {
        if (!$this->session->userdata('username')) {
            return redirect('admin');
        }
        $data['projectSliders'] = $this->CarousalModel->slider_list();
        $data['pageName'] = 'manageCarousal'; 
        $this->load->view('admin/start', $data);
    }



    public function update_slider() {
        if (!$this->session->userdata('username')) {
            return redirect('admin');
        }
        if ($this->input->post('update')) {
            $data['projectSliders'] = $this->CarousalModel->slider_list();
            if ($_FILES['slider1']['name'] != '') {
                if ($data['projectSliders']['slider1'] != '') {
                    unlink(FCPATH . 'uploads/admin/sliders/' . $data['projectSliders']['slider1']);
                }
                $filenames1 = stripslashes($_FILES['slider1']['name']);
                $filenames2 = $this->clean_title($filenames1);
                $uploaded_doc = "_" . $this->get_random_name() . "_" . $filenames2;
                $paths ="./uploads/admin/sliders/" . $uploaded_doc;
                move_uploaded_file($_FILES['slider1']['tmp_name'], $paths);
                $slider1 = $uploaded_doc;
            } else {
                $slider1 = $data['projectSliders']['slider1'];
            }
            if ($_FILES['slider2']['name'] != '') {
                if ($data['projectSliders']['slider2'] != '') {
                    unlink(FCPATH . 'uploads/admin/sliders/' . $data['projectSliders']['slider2']);
                }
                $filenames1 = stripslashes($_FILES['slider2']['name']);
                $filenames2 = $this->clean_title($filenames1);
                $uploaded_doc = "_" . $this->get_random_name() . "_" . $filenames2;
                $paths =FCPATH ."./uploads/admin/sliders/" . $uploaded_doc;
                move_uploaded_file($_FILES['slider2']['tmp_name'], $paths);
                $slider2 = $uploaded_doc;
            } else {
                $slider2 = $data['projectSliders']['slider2'];
            }
            if ($_FILES['slider3']['name'] != '') {
                if ($data['projectSliders']['slider3'] != '') {
                    unlink(FCPATH . 'uploads/admin/sliders/' . $data['projectSliders']['slider3']);
                }
                $filenames1 = stripslashes($_FILES['slider3']['name']);
                $filenames2 = $this->clean_title($filenames1);
                $uploaded_doc = "_" . $this->get_random_name() . "_" . $filenames2;
                $paths =FCPATH . "./uploads/admin/sliders/" . $uploaded_doc;
                move_uploaded_file($_FILES['slider3']['tmp_name'], $paths);
                $slider3 = $uploaded_doc;
            } else {
                $slider3 = $data['projectSliders']['slider3'];
            }
            if ($_FILES['slider4']['name'] != '') {
                if ($data['projectSliders']['slider4'] != '') {
                    unlink(FCPATH . 'uploads/admin/sliders/' . $data['projectSliders']['slider4']);
                }
                $filenames1 = stripslashes($_FILES['slider4']['name']);
                $filenames2 = $this->clean_title($filenames1);
                $uploaded_doc = "_" . $this->get_random_name() . "_" . $filenames2;
                $paths =FCPATH . "./uploads/admin/sliders/" . $uploaded_doc;
                move_uploaded_file($_FILES['slider4']['tmp_name'], $paths);
                $slider4 = $uploaded_doc;
            } else {
                $slider4 = $data['projectSliders']['slider4'];
            }
            $update_project_sliders = $this->CarousalModel->update_sliders($slider1, $slider2, $slider3, $slider4);
            if (!$update_project_sliders) {
                $this->session->set_flashdata('message', 'Carousal updated successfully');
                redirect(base_url() . 'manage-carousal');
            } else {
                $this->session->set_flashdata('message', 'Carousal updation error. Try again later.');
                redirect(base_url() . 'manage-carousal');
            }
        }
        $data['pageName'] = 'manageCarousal';
        $this->load->view('start', $data);
    }

}
