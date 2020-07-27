<?php

defined('BASEPATH') or exit('No direct script access allowed');

class GstController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('GstModel');
        $this->load->library('form_validation');
    }

    public function gst()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $data['gst_list'] = $this->GstModel->getGstList('tbl_gst');
        $data['page_title'] = 'Manage GST'; //assign dynamically
        $data['pageName'] = 'gst';
        $this->load->view('admin/start', $data);
    }

    public function gstCreate()
    {
      if (isset($_POST['submit'])) {
        echo $this->input->post('gst_name');
        echo $this->input->post('gst_rate');

    			$this->form_validation->set_rules('gst_name', 'gst_name', 'trim|required|htmlspecialchars','required');
    			// $this->form_validation->set_rules('gst_rate ', 'gst_rate', 'trim|required|htmlspecialchars','required');
    			if ($this->form_validation->run() === false) {
    				$this->session->set_flashdata('error_msg', 'Please Fill all the field!!!');
    				return redirect("gst");
    			} else {
    				$data = array(
                'gst_name' => $this->input->post('gst_name'),
                'gst_rate' => $this->input->post('gst_rate'),
                'status' => '1',
                'added_at' => date('Y-m-d H:i:s'),
    			);
    			$res = $this->GstModel->insertModel($data, 'tbl_gst');
    				if ($res == true) {
    					$this->session->set_flashdata('success_msg', ' Success!!! Record Added. ');
    					redirect('gst');
    				} else {
    					$this->session->set_flashdata('error_msg', ' Warninig!!! Sorry Some Error While Inserting!!!!');
    					redirect('gst');
    				}
    			}

      }//isset end
    }

    public function gstStatusUpdate($id)
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $Newstatus = 0;
        $status = "";
        $checkstatus = $this->GstModel->checkStatus($id,'tbl_gst');
        foreach ($checkstatus as $value) {
            $status = $value->status;
        }
        if ($status == 1) {
            $Newstatus = 0;
        } elseif ($status == 0) {
            $Newstatus = 1;
        }
        $data = array(
            'status' => $Newstatus,
            'updated_at' => date('Y-m-d H:i:s'),
        );
        $this->db->set($data);
        $res = $this->GstModel->updateModel($data, $id,'tbl_gst');
        if ($res == true) {
            $this->session->set_flashdata('success_msg', ' Record Updated Successfully. ');
            redirect('gst');
        } else {
            $this->session->set_flashdata('error_msg', ' Sorry Some Error While updating!!!!');
            redirect('gst');
        }
    }

    public function gstUpdate(){
      if (!$this->session->userdata('username')) {
          redirect('myadmin');
        }
        if (isset($_POST['update'])) {
            $gst_id = $this->input->post('gst_id');
            $data = array(
                'gst_name' => $this->input->post('gst_name'),
                'gst_rate' => $this->input->post('gst_rate'),
                'updated_at' => date('Y-m-d H:i:s'),
            );
            //print_r($data);
            $this->db->set($data);
            $res = $this->GstModel->updateModel($data, $gst_id,'tbl_gst');
            if ($res == true) {
                $this->session->set_flashdata('success_msg', ' Record Updated Successfully. ');
                redirect('gst');
            } else {
                $this->session->set_flashdata('error_msg', ' Sorry Some Error While updating!!!!');
                redirect('gst');
            }
        }
    }

    public function gstDelete($gst_id)
    {
      if ($this->session->userdata('username') == null) {
          redirect('myadmin');
      }
      $id = $this->uri->segment(3);
      $res = $this->GstModel->deleteModel($gst_id,'tbl_gst');
      if ($res == true) {
          $this->session->set_flashdata('success_msg', 'Deleted Successfully');
          return redirect('gst');
      } else {
          $this->session->set_flashdata('error_msg', 'Sorry Some Error!!!');
          redirect('gst');
      }
    }
}
