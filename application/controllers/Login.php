<?php

defined('BASEPATH') OR exit('No direct script access allowed');

Class Login extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('Login_detailed_model');
    }

    public function index() {

//        $data['pageName'] = 'admin_login';
//        $this->load->view('start', $data);
        $this->load->view('admin/admin_login');
    }

    public function adminlogin() {
        $this->load->model('Login_detailed_model');
        $this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[50]');
        if ($this->form_validation->run() == FALSE) {
            return redirect("myadmin");
        } else {
            $username = $this->input->post('username');
            $password = md5($this->input->post('password'));
//           echo  $password = $this->input->post('password');
            $res = $this->Login_detailed_model->login($username, $password);
            if ($res) {
                $this->session->set_userdata('username', $username);
                return redirect('dashboard');
            } else {
                $this->session->set_flashdata('wrong_pass', 'Your Username or Password May Be wrong!!!');
                return redirect('myadmin');
            }
        }
    }

    public function logout() {
        $this->session->unset_userdata('username');
        // $this->session->sess_destroy();
        redirect('myadmin');
    }

}
