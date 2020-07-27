<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SubscribeEmail extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('SubscribeEmails','SubscribeEmail');
	}
	//    check email avaiablility
	public function check_email_avaibility()
	{
		if (!filter_var($_POST["subscribe_email"], FILTER_VALIDATE_EMAIL)) {
			echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Invalid Email</span></label>';
		} else {
			if ($this->SubscribeEmail->is_email_available($_POST["subscribe_email"])) {
				echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Email Already Registered!</label>';
			} else {
				echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> Email Available</label>';
			}
		}
	}

	public function subscribe_email(){
		if (isset($_POST['submit'])) {
			$this->form_validation->set_rules('subscribe_email', 'subscribe_email', 'trim|required|htmlspecialchars', 'required');
			if ($this->form_validation->run() === false) {
				$this->session->set_flashdata('error_msg', 'Please Fill all the field!!');
				return redirect("home");
			} else {
				$res = $this->SubscribeEmail->subscribe_create();
				if ($res == true) {
					$this->session->set_flashdata('success_msg', ' data have been added successfully.');
				} else {
					$this->session->set_flashdata('error_msg', 'Some problems, please try again.');
				}
				redirect('home');
			}
		}
	}
}
