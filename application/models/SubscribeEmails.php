<?php

defined('BASEPATH') or exit('No direct script access allowed');

class SubscribeEmails extends CI_Model
{

	public function __construct()
	{
		parent::__construct(); // call parent constructor
		$this->load->database(); //this is the for load database
		$this->load->helper('form');
	}


	public function is_email_available($email)
	{
		$this->db->where('email', $email);
		$query = $this->db->get("tbl_subscribed_email");
//		return $this->db->last_query();
		if ($query->num_rows() > 0) {
			return true;
		} else {
			return false;
		}
	}

	public function subscribe_create()
	{
		$data = array(
			'email' => $this->input->post('subscribe_email'),
			'added_at' => date('Y-m-d H:i:s'),
			'updated_at'=> date('Y-m-d H:i:s'),
			'status' => '1',
		);
		$this->db->insert('tbl_subscribed_email', $data);
		return true;
	}
}
