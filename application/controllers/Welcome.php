<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('WelcomeModel');
        $this->load->model('ProductModel');
        //        load excel library
        $this->load->library('excel');
    }

    /*     * ************* code starts *************************** */

    public function clean_title($string)
    {
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
            '"' => '',
        );
        while (list($character, $replacement) = each($specialCharacters)) {
            $string = str_replace($character, '' . $replacement . '', $string);
        }
        $string = strtr(
            $string,
            "ÀÁÂÃÄÅ�áâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ",
            "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn"
        );
        // Remove all remaining other unknown characters
        $string = preg_replace('/[^a-zA-Z0-9\-.$"]/', '-', $string);
        return $string;
    }

    public function get_random_name($chars_min = 6, $chars_max = 6, $use_upper_case = true, $include_numbers = true, $include_special_chars = false)
    {
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

    function generate_url_slug($string,$table,$field,$key=NULL,$value=NULL){
        $t =& get_instance();
        $slug = url_title($string);
        $slug = strtolower($slug);
        $i = 0;
        $params = array ();
        $params[$field] = $slug;
     
        if($key)$params["$key !="] = $value; 
     
        while ($t->db->where($params)->get($table)->num_rows())
        {   
            if (!preg_match ('/-{1}[0-9]+$/', $slug ))
                $slug .= '-' . ++$i;
            else
                $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
             
            $params [$field] = $slug;
        }   
        return $slug;   
    }

    public function index()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        #getActiveOrders
        $data['activeOrders'] = $this->WelcomeModel->getActiveOrders();
        #sum of the  sold  amount from the order master table
        $data['getSum'] = $this->WelcomeModel->getSalesAmount();
        #count active orders
        // $data['activeOrders'] = $this->WelcomeModel->getActiveOrders();
        $data['page_title'] = 'KeralKart --Dashboard'; //assign dynamically
        $data['pageName'] = 'dashboard';
        $this->load->view('admin/start', $data);
    }

    public function change_password()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $data['pageName'] = 'change_password';
        $this->load->view('admin/start', $data);
    }

    public function change_password_process()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        if ($this->input->post('change_pass')) {
            $old_pass = md5($this->input->post('old_pass'));
            $new_pass = md5($this->input->post('new_pass'));
              $new_pass_n = $this->input->post('new_pass');
            $confirm_pass = md5($this->input->post('confirm_pass'));
            $session_id = $this->session->userdata('username');
            $pass = $this->WelcomeModel->fetch_pass($session_id, $old_pass);
            if ($pass) {
                if (!strcmp($new_pass, $confirm_pass)) {
                    $this->WelcomeModel->change_pass($session_id, $new_pass,$new_pass_n);
                    $this->session->set_flashdata('msg', 'Password Changed Successfully!!!!!');
                    redirect('change-password');
                } else {
                    $this->session->set_flashdata('error_msg', 'Your New Password And Confirm Password Not Matched');
                    redirect('change-password');
                }
            } else {
                $this->session->set_flashdata('error_msg', 'Invalid Old Password!!!!!');
                redirect('change-password');
            }
        }
    }

    //  |||||||||||||||||||||||||||||||||||||  Type Section ||||||||||||||||||||||||||||||||||
    public function type()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $data['typeList'] = $this->WelcomeModel->typeList();
        $data['page_title'] = 'KeralKart --ManageType';
        $data['pageName'] = 'type';
        $this->load->view('admin/start', $data);
    }

    public function typeList()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $data['typeList'] = $this->WelcomeModel->typeList();
        echo json_encode($data['typeList']);
    }

    //    check_type_avalibility
    public function check_type_avalibility()
    {
        $data = $this->input->post('typeName');
        if ($this->WelcomeModel->is_type_available($data)) {
            echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Type Name Already Taken!</label>';
        } else {
            echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> Type Name Available.</label>';
        }
    }

    public function typeCreate()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $this->form_validation->set_rules(
            'typeName', 'typeName', 'trim|required|htmlspecialchars|is_unique[type.typeName]', 
            array(
                'required' => 'You have not provided %s',
                'is_unique'     => 'This %s already exists.'
            )
        );
        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('error_msg', 'Please Fill all the field');
            return redirect("type");
        } else {
            $data = array(
                'typeName' => $this->input->post('typeName'),
                'added_at' => date('Y-m-d H:i:s'),
                'status' => 1,
            );
            $res = $this->WelcomeModel->typeCreate($data);
            if ($res == true) {
                $this->session->set_flashdata('success_msg', ' Record Submitted Successfully.');
            } else {
                $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
            }
            redirect('type');
        }
    }

    public function typeUpdate()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        if (isset($_POST['update'])) {
            $id = $this->input->post('id');
            $data = array(
                'typeName' => $this->input->post('typeNameEdit'),
                'updated_at' => date('Y-m-d H:i:s'),
            );
            //print_r($data);
            $this->db->set($data);
            $res = $this->WelcomeModel->typeUpdate($data, $id);
            if ($res == true) {
                $this->session->set_flashdata('success_msg', ' Record Updated Successfully. ');
                redirect('type');
            } else {
                $this->session->set_flashdata('error_msg', ' Sorry Some Error While updating!!!!');
                redirect('type');
            }
        }
    }

    public function typeStatusUpdate($id)
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $Newstatus = 0;
        $status = "";
        $checkstatus = $this->WelcomeModel->checkTypeStatus($id);
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
        $res = $this->WelcomeModel->typeUpdate($data, $id);
        if ($res == true) {
            $this->session->set_flashdata('success_msg', ' Record Updated Successfully. ');
            redirect('type');
        } else {
            $this->session->set_flashdata('error_msg', ' Sorry Some Error While updating!!!!');
            redirect('type');
        }
    }

    public function typeDelete($id)
    {
        if ($this->session->userdata('username') == null) {
            redirect('myadmin');
        }
        $id = $this->uri->segment(3);
        $res = $this->WelcomeModel->typeDelete($id);
        if ($res == true) {
            $this->session->set_flashdata('success_msg', 'Deleted Successfully');
            return redirect('type');
        } else {
            $this->session->set_flashdata('error_msg', 'Sorry Some Error!!!');
            redirect('type');
        }
    }

    // ||||||||||||||||||||||||||Category Section ||||||||||||||||||||||||||||||||

    public function category()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $data['typeList'] = $this->WelcomeModel->typeListData();
        $data['categoryList'] = $this->WelcomeModel->categoryList();
        $data['page_title'] = 'KeralKart --Manage Category'; //assign dynamically
        $data['pageName'] = 'category';
        $this->load->view('admin/start', $data);
    }

    public function categoryCreate()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $this->form_validation->set_rules('typeId', 'typeId', 'trim|required|htmlspecialchars', 'required');
        $this->form_validation->set_rules('categoryName', 'categoryName', 'trim|required|htmlspecialchars|is_unique[category.categoryName]', 
            array(
                'required' => 'You have not provided %s',
                'is_unique'     => 'This %s already exists.'
            )
        );

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('error_msg', 'Error: '.validation_errors());
            return redirect("category");
        } else {
            $p1 = "noimage.png";
            $config['upload_path'] = './uploads/admin/category/';
            $config['allowed_types'] = 'jpg|png|jpeg|gif';
            $this->load->library('upload', $config);
            $config['encrypt_name']           = TRUE;
            if ($this->upload->do_upload('categoryTumbnail')) {
                $data['uploadata'] = $this->upload->data();
                foreach ($data as $d) {
                    $p1 = $d['file_name'];
                }
            } else {
                echo $errors = $this->upload->display_errors();
            }
            echo $p1;
            $data = array(
                'typeId' => $this->input->post('typeId'),
                'url_slug'=>$this->generate_url_slug($this->input->post('categoryName'),'category','url_slug'),
                'categoryName' => $this->input->post('categoryName'),
                'categoryThumbnail' => $p1,
                'added_at' => date('Y-m-d H:i:s'),
                'status' => '1',
            );
            $res = $this->WelcomeModel->categoryCreate($data);
            if ($res == true) {
                $this->session->set_flashdata('success_msg', ' Record Submitted Successfully.');
            } else {
                $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
            }
            redirect('category');
        }
    }

    public function categoryUpdate()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }

        if (isset($_POST['update'])) {
            $this->form_validation->set_rules('typeId', 'typeId', 'trim|required|htmlspecialchars', 'required');
            $this->form_validation->set_rules('categoryName', 'categoryName', 'trim|required|htmlspecialchars', 'required');
            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error_msg', 'Please Fill all the field');
                return redirect("category");
            } else {
                $id = $this->input->post('categoryId');
                $data['ListData']=$this->WelcomeModel->selectModelInArraybyId('category',$id);



                // $p1 = "";
                // $config['upload_path'] = './uploads/admin/category/';
                // $config['allowed_types'] = 'jpg|png|jpeg|gif';
                // $this->load->library('upload', $config);
                // if ($this->upload->do_upload('categoryTumbnail') != "") {
                //     $data['uploadata'] = $this->upload->data();
                //     foreach ($data as $d) {
                //         $p1 = $d['file_name'];
                //     }
                // } else {
                //     $this->upload->do_upload('categoryThumbnailAlt');
                //     $data['uploadata'] = $this->upload->data();
                //     foreach ($data as $d) {
                //         $p1 = $d['file_name'];
                //     }
                // }
                // echo $p1;
                if ($_FILES['categoryThumbnail']['name'] != '') {
                    if ($data['ListData']['categoryThumbnail'] != '') {
                        unlink(FCPATH . 'uploads/admin/category/' . $data['ListData']['categoryThumbnail']);
                    }
                    $p1 = "noimage.png";
                    $config['upload_path'] = './uploads/admin/category/';
                    $config['allowed_types'] = 'jpg|png|jpeg|gif';
                    $config['encrypt_name']           = TRUE;
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('categoryThumbnail')) {
                        $data['uploadata'] = $this->upload->data();
                        foreach ($data as $d) {
                            $p1 = $d['file_name'];
                        }
                    } else {
                         $errors = $this->upload->display_errors();
                    }
                } else {
                    echo  $p1 = $data['ListData']['categoryThumbnail'];
                    // die;
                }


                $data = array(
                    'typeId' => $this->input->post('typeId'),
                       'url_slug'=>$this->generate_url_slug($this->input->post('categoryName'),'category','url_slug'),
                    'categoryName' => $this->input->post('categoryName'),
                    'categoryThumbnail' => $p1,
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                // print_r($data);
                // die;
                $this->db->set($data);
                $res = $this->WelcomeModel->categoryUpdate($data, $id);
                if ($res == true) {
                    $this->session->set_flashdata('success_msg', ' Record Updated Successfully. ');
                    redirect('category');
                } else {
                    $this->session->set_flashdata('error_msg', ' Sorry Some Error While updating!!!!');
                    redirect('category');
                }
            }
        }
    }

    public function categoryStatusUpdate($id)
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $Newstatus = 0;
        $status = "";
        $checkstatus = $this->WelcomeModel->checkStatus($id);
        // print_r($checkstatus);
        foreach ($checkstatus as $value) {
            $status = $value->status;
        }
        // echo $status;
        // die;
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
        $res = $this->WelcomeModel->categoryStatusUpdate($data, $id);
        if ($res == true) {
            $this->session->set_flashdata('success_msg', ' Record Updated Successfully. ');
            redirect('category');
        } else {
            $this->session->set_flashdata('error_msg', ' Sorry Some Error While updating!!!!');
            redirect('category');
        }
    }

    /* |||||||||||||||||||| SubCategory Section ||||||||||||||||||| */

    public function subCategory()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $data['subCategoryList'] = $this->WelcomeModel->subCategoryList();
        $data['categoryListData'] = $this->WelcomeModel->CategoryListData();
        $data['page_title'] = 'KeralKart --Manage SubCategory'; //assign dynamically
        $data['pageName'] = 'subCategory';
        $this->load->view('admin/start', $data);
    }

    public function subCategoryCreate()
    {

        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('categoryId', 'categoryId', 'trim|required|htmlspecialchars', 'required');
            $this->form_validation->set_rules('subCategoryName', 'subCategoryName', 'trim|required|htmlspecialchars|is_unique[subcategory.subCategoryName]', 
            array(
                'required' => 'You have not provided %s',
                'is_unique'     => 'This %s already exists.'
            )
        );

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('error_msg', 'Error: '.validation_errors());
                return redirect("sub-category");
            } else {
                $data = array(
                    'categoryId' => $this->input->post('categoryId'),
                    'url_slug'=>$this->generate_url_slug($this->input->post('subCategoryName'),'subcategory','url_slug'),
                    'subCategoryName' => $this->input->post('subCategoryName'),
                    'added_at' => date('Y-m-d H:i:s'),
                    'status' => '1',
                );
                $res = $this->WelcomeModel->subCategoryCreate($data);
                if ($res == true) {
                    $this->session->set_flashdata('success_msg', ' Record Submitted Successfully.');
                } else {
                    $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
                }
                redirect('sub-category');
            }
        }
    }

    public function subCategoryStatusUpdate($id)
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $Newstatus = "";
        $status = "";
        $checkstatus = $this->WelcomeModel->checkCategoryStatus($id);
        // print_r($checkstatus);
        foreach ($checkstatus as $value) {
            $status = $value->status;
        }
        // echo $status;
        // die;
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
        $res = $this->WelcomeModel->subCategoryStatusUpdate($data, $id);
        if ($res == true) {
            $this->session->set_flashdata('success_msg', ' Record Updated Successfully. ');
            redirect('sub-category');
        } else {
            $this->session->set_flashdata('error_msg', ' Sorry Some Error While updating!!!!');
            redirect('sub-category');
        }
    }

    public function subCategoryUpdate()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }

        if (isset($_POST['update'])) {
            $this->form_validation->set_rules('categoryId', 'categoryId', 'trim|required|htmlspecialchars', 'required');
            $this->form_validation->set_rules('subCategoryName', 'subCategoryName', 'trim|required|htmlspecialchars', 'required');
            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error_msg', 'Please Fill all the field');
                return redirect("sub-category");
            } else {
                $id = $this->input->post('id');
                $data = array(
                    'categoryId' => $this->input->post('categoryId'),
                      'url_slug'=>$this->generate_url_slug($this->input->post('subCategoryName'),'subcategory','url_slug'),
                    'subCategoryName' => $this->input->post('subCategoryName'),
                    'updated_at' => date('Y-m-d H:i:s'),
                );
                //print_r($data);
                $this->db->set($data);
                $res = $this->WelcomeModel->subCategoryStatusUpdate($data, $id);
                if ($res == true) {
                    $this->session->set_flashdata('success_msg', ' Record Updated Successfully. ');
                    redirect('sub-category');
                } else {
                    $this->session->set_flashdata('error_msg', ' Sorry Some Error While updating!!!!');
                    redirect('sub-category');
                }
            }
        }
    }

    // ||||||||||||||||||||||||||||| Notification Section |||||||||||||||||||||||||
    public function notification()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $data['notificationList'] = $this->WelcomeModel->notificationList();
        $data['page_title'] = 'KeralKart --Manage Notification';
        $data['pageName'] = 'notification';
        $this->load->view('admin/start', $data);
    }

    public function notificationCreate()
    {

        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('notificationText', 'notificationText', 'trim|required|htmlspecialchars', 'required');
            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error_msg', 'Please Fill all the field');
                return redirect("notification");
            } else {
                $data = array(
                    'notificationText' => $this->input->post('notificationText'),
                    'added_at' => date('Y-m-d H:i:s'),
                    'status' => '1',
                );
                $res = $this->WelcomeModel->notificationCreate($data);
                if ($res == true) {
                    $this->session->set_flashdata('success_msg', ' Record Submitted Successfully.');
                } else {
                    $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
                }
                redirect('notification');
            }
        }
    }

    public function notificationStatusUpdate($id)
    {

        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $Newstatus = "";
        $status = "";
        $checkstatus = $this->WelcomeModel->checkNotificationStatus($id);
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
        $res = $this->WelcomeModel->notificationUpdate($data, $id);
        if ($res == true) {
            $this->session->set_flashdata('success_msg', ' Record Updated Successfully. ');
            redirect('notification');
        } else {
            $this->session->set_flashdata('error_msg', ' Sorry Some Error While updating!!!!');
            redirect('notification');
        }
    }

    public function notificationUpdate()
    {

        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        if (isset($_POST['update'])) {
            $this->form_validation->set_rules('notificationText', 'notificationText', 'trim|required|htmlspecialchars', 'required');
            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error_msg', 'Please Fill all the field');
                return redirect("notification");
            } else {
                $id = $this->input->post('id');
                $data = array(
                    'notificationText' => $this->input->post('notificationText'),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'status' => '1',
                );
                $this->db->set($data);
                $res = $this->WelcomeModel->notificationUpdate($data, $id);
                if ($res == true) {
                    $this->session->set_flashdata('success_msg', ' Record Updated Successfully. ');
                    redirect('notification');
                } else {
                    $this->session->set_flashdata('error_msg', ' Sorry Some Error While updating!!!!');
                    redirect('notification');
                }
            }
        }
    }

    public function notificationDelete($id)
    {
        if ($this->session->userdata('username') == null) {
            redirect('myadmin');
        }
        $id = $this->uri->segment(3);
        $res = $this->WelcomeModel->notificationDelete($id);
        if ($res == true) {
            $this->session->set_flashdata('success_msg', 'Deleted Successfully');
            return redirect('notification');
        } else {
            $this->session->set_flashdata('error_msg', 'Sorry Some Error!!!');
            redirect('notification');
        }
    }

    //||||||||||||||||||||||||||||||||| Administration Section |||||||||||||||||||||||
    public function administration()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $data['administrationList'] = $this->WelcomeModel->administrationList();
        $data['page_title'] = 'KeralKart --Administration'; //assign dynamically
        $data['pageName'] = 'administration';
        $this->load->view('admin/start', $data);
    }

    public function administrationCreate()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('username', 'username', 'trim|required|htmlspecialchars', 'required');
            $this->form_validation->set_rules('email', 'email', 'trim|required|htmlspecialchars', 'required');
            $this->form_validation->set_rules('ePassword', 'ePassword', 'trim|required|htmlspecialchars', 'required');
            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error_msg', 'Please Fill all the field!!');
                return redirect("administration");
            } else {
                $res = $this->WelcomeModel->administrationCreate();
                if ($res == true) {
                    $this->session->set_flashdata('success_msg', ' Record Submitted Successfully.');
                } else {
                    $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
                }
                redirect('administration');
            }
        }
    }

    //    check email avaiablility
  /*  public function change_password_process()
    {
        if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Invalid Email</span></label>';
        } else {
            if ($this->WelcomeModel->is_admin_email_available($_POST["email"])) {
                echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Email Already Registered!</label>';
            } else {
                echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> Email Available</label>';
            }
        }
    }
*/
    //    check username avaiablility
    public function check_admin_username_avalibility()
    {
        $arr = array();
        $arr['response'] = "1";
        if ($this->WelcomeModel->is_admin_username_available($_POST["username"])) {
            $arr['response'] = "0";
            //            return 0;
            //            echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Username Already Registered!</label>';
        }
        echo json_encode($arr);
    }

    public function administrationStatusUpdate($id)
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $Newstatus = "";
        $status = "";
        $checkstatus = $this->WelcomeModel->checkAdministrationStatus($id);
        // print_r($checkstatus);
        foreach ($checkstatus as $value) {
            $status = $value->status;
        }
        // echo $status;
        // die;
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
        $res = $this->WelcomeModel->administrationStatusUpdate($data, $id);
        if ($res == true) {
            $this->session->set_flashdata('success_msg', ' Record Updated Successfully. ');
            redirect('administration');
        } else {
            $this->session->set_flashdata('error_msg', ' Sorry Some Error While updating!!!!');
            redirect('administration');
        }
    }

    //   |||||||||||||||||||||||||||||||||||||| Coupon Code Section ||||||||||||||||||||||||||||||

    public function coupon()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $data['couponList'] = $this->WelcomeModel->couponList();
        $data['page_title'] = 'KeralKart --Coupon&Discount';
        $data['pageName'] = 'coupon';
        $this->load->view('admin/start', $data);
    }

    public function couponCreate()
    {

        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('code', 'code', 'trim|required|htmlspecialchars', 'required');
            $this->form_validation->set_rules('amount', 'amount', 'trim|required|htmlspecialchars', 'required');
            $this->form_validation->set_rules('usageLimit', 'usageLimit', 'trim|required|htmlspecialchars', 'required');
            $this->form_validation->set_rules('validFromDate', 'validFromDate', 'trim|required|htmlspecialchars', 'required');
            $this->form_validation->set_rules('validToDate', 'validToDate', 'trim|required|htmlspecialchars', 'required');
            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error_msg', 'Please Fill all the field!!');
                return redirect("coupon");
            } else {
                $res = $this->WelcomeModel->couponCreate();
                if ($res == true) {
                    $this->session->set_flashdata('success_msg', ' Record Submitted Successfully.');
                } else {
                    $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
                }
                redirect('coupon');
            }
        }
    }

    public function coupon_manager()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $data['couponList'] = $this->WelcomeModel->couponList();
        $data['page_title'] = 'KeralKart --Coupon&Discount';
        $data['pageName'] = 'coupon_list';
        $this->load->view('admin/start', $data);
    }

    public function couponStatusUpdate($id)
    {

        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $Newstatus = "";
        $status = "";
        $checkstatus = $this->WelcomeModel->checkCouponstatus($id);
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
        $res = $this->WelcomeModel->couponStatusUpdate($data, $id);
        if ($res == true) {
            $this->session->set_flashdata('success_msg', 'Record Updated Successfully.');
            redirect('coupon-manager');
        } else {
            $this->session->set_flashdata('error_msg', ' Sorry Some Error While updating!!!!');
            redirect('coupon-manager');
        }
    }

    public function couponDelete($id)
    {
        if ($this->session->userdata('username') == null) {
            redirect('myadmin');
        }
        $id = $this->uri->segment(3);
        $res = $this->WelcomeModel->couponDelete($id);
        if ($res == true) {
            $this->session->set_flashdata('success_msg', 'Deleted Successfully');
            return redirect('coupon-manager');
        } else {
            $this->session->set_flashdata('error_msg', 'Sorry Some Error!!!');
            redirect('coupon-manager');
        }
    }

    public function couponUpdate()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        if (isset($_POST['update'])) {
            $this->form_validation->set_rules('code', 'code', 'trim|required|htmlspecialchars', 'required');
            $this->form_validation->set_rules('amount', 'amount', 'trim|required|htmlspecialchars', 'required');
            $this->form_validation->set_rules('usageLimit', 'usageLimit', 'trim|required|htmlspecialchars', 'required');
            $this->form_validation->set_rules('validFromDate', 'validFromDate', 'trim|required|htmlspecialchars', 'required');
            $this->form_validation->set_rules('validToDate', 'validToDate', 'trim|required|htmlspecialchars', 'required');
            if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error_msg', 'Please Fill all the field');
                return redirect("sub-category");
            } else {
                $id = $this->input->post('id');
                $data = array(
                    'couponCode' => $this->input->post('code'),
                    'amount' => $this->input->post('amount'),
                    'usageLimit' => $this->input->post('usageLimit'),
                    'validFromDate' => ($this->input->post('validFromDate')),
                    'validToDate' => ($this->input->post('validToDate')),
                    'updated_at' => date('Y-m-d H:i:s'),
                    'status' => '1',
                );
                //print_r($data);
                $this->db->set($data);
                $res = $this->WelcomeModel->couponStatusUpdate($data, $id);
                if ($res == true) {
                    $this->session->set_flashdata('success_msg', ' Record Updated Successfully. ');
                    redirect('coupon-manager');
                } else {
                    $this->session->set_flashdata('error_msg', ' Sorry Some Error While updating!!!!');
                    redirect('coupon-manager');
                }
            }
        }
    }

    //    |||||||||||||||||||||||||| Brand Section |||||||||||||||||||||||||||||||

    public function brand()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $data['brandList'] = $this->WelcomeModel->brandList();
        $data['page_title'] = 'KeralKart --Brand';
        $data['pageName'] = 'brand';
        $this->load->view('admin/start', $data);
    }

    public function check_brand_avalibility()
    {
        $data = $this->input->post('brandName');
        if ($this->WelcomeModel->is_brand_available($data)) {
            echo '<label class="text-danger"><span class="glyphicon glyphicon-remove"></span> Brand Name Already Taken!</label>';
        } else {
            echo '<label class="text-success"><span class="glyphicon glyphicon-ok"></span> Brand Name Available.</label>';
        }
    }

    public function brandCreate()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('brandName', 'brandName', 'trim|required|htmlspecialchars|is_unique[brand.brandName]', 
            array(
                'required' => 'You have not provided %s',
                'is_unique'     => 'This %s already exists.'
            )
        );

        if ($this->form_validation->run() === false) {
            $this->session->set_flashdata('error_msg', 'Error: '.validation_errors());
                return redirect("brand");
            } else {
                $res = $this->WelcomeModel->brandCreate();
                if ($res == true) {
                    $this->session->set_flashdata('success_msg', ' Record Submitted Successfully.');
                } else {
                    $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
                }
                redirect('brand');
            }
        }
    }

    public function brandStatusUpdate($id)
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $Newstatus = 0;
        $status = "";
        $checkstatus = $this->WelcomeModel->checkBrandStatus($id);
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
        $res = $this->WelcomeModel->brandUpdate($data, $id);
        if ($res == true) {
            $this->session->set_flashdata('success_msg', ' Record Updated Successfully. ');
            redirect('brand');
        } else {
            $this->session->set_flashdata('error_msg', ' Sorry Some Error While updating!!!!');
            redirect('brand');
        }
    }

    public function brandUpdate()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        if (isset($_POST['update'])) {
            $id = $this->input->post('id');
            $data = array(
                'brandName' => $this->input->post('brandNameEdit'),
                'updated_at' => date('Y-m-d H:i:s'),
            );
            //print_r($data);
            $this->db->set($data);
            $res = $this->WelcomeModel->brandUpdate($data, $id);
            if ($res == true) {
                $this->session->set_flashdata('success_msg', ' Record Updated Successfully. ');
                redirect('brand');
            } else {
                $this->session->set_flashdata('error_msg', ' Sorry Some Error While updating!!!!');
                redirect('brand');
            }
        }
    }

    public function brandDelete($id)
    {
        if ($this->session->userdata('username') == null) {
            redirect('myadmin');
        }
        $id = $this->uri->segment(3);
        $res = $this->WelcomeModel->brandDelete($id);
        if ($res == true) {
            $this->session->set_flashdata('success_msg', 'Deleted Successfully');
            return redirect('brand');
        } else {
            $this->session->set_flashdata('error_msg', 'Sorry Some Error!!!');
            redirect('brand');
        }
    }

    // |||||||||||||||||||||||||| product Section |||||||||||||||||||||||||||||||||||||
    public function productDelete($id)
    {
        if ($this->session->userdata('username') == null) {
            redirect('myadmin');
        }
        $id = $this->uri->segment(3);
        $res = $this->WelcomeModel->productDelete($id);
        if ($res == true) {
            $this->session->set_flashdata('success_msg', 'Deleted Successfully');
            return redirect('product-list');
        } else {
            $this->session->set_flashdata('error_msg', 'Sorry Some Error!!!');
            redirect('product-list');
        }
    }
    public function product()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }

        $data['brandList'] = $this->WelcomeModel->brandList();
        $data['categoryListData'] = $this->WelcomeModel->CategoryListData();
        $data['page_title'] = 'KeralKart --Create Product'; //assign dynamically
        $data['pageName'] = 'product';
        $this->load->view('admin/start', $data);
    }

    public function productList()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $data['productList'] = $this->WelcomeModel->productList();
        $data['page_title'] = 'KeralKart --Product List';
        $data['pageName'] = 'product_list';
        $this->load->view('admin/start', $data);
    }

    public function editProduct($id)
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }

        $data['brandList'] = $this->WelcomeModel->brandList();
        $data['products'] = $this->WelcomeModel->getProductDetailById($id);
        $data['categoryListData'] = $this->WelcomeModel->CategoryListData();
        $data['subCategoryListActive'] = $this->WelcomeModel->subCategoryListActive();
        $data['page_title'] = 'KeralKart -- Edit Product'; //assign dynamically
        $data['pageName'] = 'editProduct';
        $this->load->view('admin/start', $data);
    }
    public function viewProduct($id)
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $data['products'] = $this->WelcomeModel->getProductDetailById($id);
        $data['page_title'] = 'KeralKart -- View Product'; //assign dynamically
        $data['pageName'] = 'viewProduct';
        $this->load->view('admin/start', $data);
    }

    public function updatedProduct()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        if (isset($_POST['update'])) {
             $id = $this->input->post('id');
            $data['products'] = $this->WelcomeModel->selectModelInArraybyId('product_details',$id);

            // echo $data['products']['thumbnail1'];
            // for thumbnail1
            if ($_FILES['thumbnail1']['name'] != '') {
                if ($data['products']['thumbnail1'] != '') {
                    unlink(FCPATH . 'uploads/product/' . $data['products']['thumbnail1']);
                }
                $uploaded_doc = $_FILES['thumbnail1']['name'];
                 $paths = FCPATH . "./uploads/product/" . $uploaded_doc;
                move_uploaded_file($_FILES['thumbnail1']['tmp_name'], $paths);
                 $p1 = $uploaded_doc;
            } else {
                  $p1 = $data['products']['thumbnail1'];
            }

            // for thumbnail2
            if ($_FILES['thumbnail2']['name'] != '') {
                if ($data['products']['thumbnail2'] != '') {
                    unlink(FCPATH . 'uploads/product/' . $data['products']['thumbnail2']);
                }
                $uploaded_doc = $_FILES['thumbnail2']['name'];
                 $paths = FCPATH . "./uploads/product/" . $uploaded_doc;
                move_uploaded_file($_FILES['thumbnail2']['tmp_name'], $paths);
                 $p2 = $uploaded_doc;
            } else {
                echo  $p2 = $data['products']['thumbnail2'];
            }

            // for thumbnail
            if ($_FILES['thumbnail3']['name'] != '') {
                if ($data['products']['thumbnail3'] != '') {
                    unlink(FCPATH . 'uploads/product/' . $data['products']['thumbnail3']);
                }
                $uploaded_doc = $_FILES['thumbnail3']['name'];
                 $paths = FCPATH . "./uploads/product/" . $uploaded_doc;
                move_uploaded_file($_FILES['thumbnail3']['tmp_name'], $paths);
                 $p3 = $uploaded_doc;
            } else {
                  $p3 = $data['products']['thumbnail3'];
            }

            // for thumbnail4
            if ($_FILES['thumbnail4']['name'] != '') {
                if ($data['products']['thumbnail4'] != '') {
                    unlink(FCPATH . 'uploads/product/' . $data['products']['thumbnail4']);
                }
                $uploaded_doc = $_FILES['thumbnail4']['name'];
                 $paths = FCPATH . "./uploads/product/" . $uploaded_doc;
                move_uploaded_file($_FILES['thumbnail4']['tmp_name'], $paths);
                 $p4 = $uploaded_doc;
            } else {
                $p4 = $data['products']['thumbnail4'];
            }

            $data = array(
                'categoryId' => $this->input->post('categoryId'),
                'subcategoryId' => $this->input->post('subcategory'),
                'productCode' => $this->input->post('productCode'),
                'productName' => $this->input->post('productName'),
                /*'price' => $this->input->post('price'),
                'mrp' => $this->input->post('mrp'),
                'quantity' => $this->input->post('quantity'),
                'discount' => $this->input->post('discount'),
                'color' => $this->input->post('color'),
                'size' => $this->input->post('size'),*/
                'weight' => $this->input->post('weight'),
                'smallDiscription' => $this->input->post('smallDescription'),
                'features' => $this->input->post('features'),
                'productDescription' => $this->input->post('description'),
                'hotdeal' => $this->input->post('hotdeal'),
                'premium' => $this->input->post('premium'),
                'inStock' => $this->input->post('inStock'),
                'latestCollection' => $this->input->post('latestCollection'),
                'thumbnail1' => $p1,
                'thumbnail2' => $p2,
                'thumbnail3' => $p3,
                'thumbnail4' => $p4,
                'added_by' => '',
                'updated_at' => date('Y-m-d H:i:s'),
                'updated_by' => '',
                'status' => '1',
                'updated_at' => date('Y-m-d H:i:s'),
            );
            // print_r($data);
            // die;
            $res = $this->WelcomeModel->productUpdate($data, $id);
            if ($res == true) {
                $this->session->set_flashdata('success_msg', ' Record Updated Successfully. ');
                redirect('product-list');
            } else {
                $this->session->set_flashdata('error_msg', ' Sorry Some Error While updating!!!!');
                redirect('product-list');
            }
        }
        // redirect('product-list');
    }

    public function compressImage($source_image, $compress_image)
    {
        $image_info = getimagesize($source_image);
        if ($image_info['mime'] == 'image/jpeg') {
            $source_image = imagecreatefromjpeg($source_image);
            imagejpeg($source_image, $compress_image, 75);
        } elseif ($image_info['mime'] == 'image/gif') {
            $source_image = imagecreatefromgif($source_image);
            imagegif($source_image, $compress_image, 75);
        } elseif ($image_info['mime'] == 'image/png') {
            $source_image = imagecreatefrompng($source_image);
            imagepng($source_image, $compress_image, 6);
        }
        return $compress_image;
    }

    public function addProduct()
    {

        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $p1 = "no-image.png";
        $p2  = "no-image.png";
        $p3  = "no-image.png";
        $p4  = "no-image.png";


        $config['upload_path'] = './uploads/product/';
        $config['allowed_types'] = 'gif|png|jpg|jpeg';
        $this->load->library('upload', $config);

        if ($this->upload->do_upload('images1')) {
            $data['uploadata'] = $this->upload->data();
            foreach ($data as $d) {
                $p1 = $d['file_name'];
            }
        }

        if ($this->upload->do_upload('images2')) {
            $data['uploadata'] = $this->upload->data();
            foreach ($data as $d) {
                $p2 = $d['file_name'];
            }
        }

        if ($this->upload->do_upload('images3')) {
            $data['uploadata'] = $this->upload->data();
            foreach ($data as $d) {
                $p3 = $d['file_name'];
            }
        }
        if ($this->upload->do_upload('images4')) {
            $data['uploadata'] = $this->upload->data();
            foreach ($data as $d) {
                $p4 = $d['file_name'];
            }
        }
         $p1;
         $p2;
         $p3;
         $p4;

        

        $arrayName = array(
            'slug' => $this->generate_url_slug($this->input->post('productName'),'product_details','slug'),
            'categoryId' => $this->input->post('categoryId'),
            'subcategoryId' => $this->input->post('subcategory'),
            'productCode' => $this->input->post('productCode'),
            'productName' => $this->input->post('productName'),
            // 'price' => $this->input->post('price'),
            // 'mrp' => $this->input->post('mrp'),
            // 'quantity' => $this->input->post('quantity'),
            // 'discount' => $this->input->post('discount'),
            // 'color' => $this->input->post('color'),
            // 'size' => $this->input->post('size'),
            'weight' => $this->input->post('weight'),
            'brand' => $this->input->post('brand'),
            'smallDiscription' => $this->input->post('smallDescription'),
            'features' => $this->input->post('features'),
            'productDescription' => $this->input->post('description'),
            'hotdeal' => $this->input->post('hotdeal'),
            'premium' => $this->input->post('premium'),
            'inStock' => $this->input->post('inStock'),
            'latestCollection' => $this->input->post('latestCollection'),
            'thumbnail1' => $p1,
            'thumbnail2' => $p2,
            'thumbnail3' => $p3,
            'thumbnail4' => $p4,
            'added_at' => date('Y-m-d H:i:s'),
            'added_by' => '',
            'updated_at' => date('Y-m-d H:i:s'),
            'updated_by' => '',
            'status' => '0',
        );

        $res = $this->WelcomeModel->insertModel($arrayName, 'product_details');
        if ($res == true) {

          

            $this->session->set_flashdata('success_msg', ' Record Submitted Successfully.Click here to add stock');
        } else {
            $this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
        }
        redirect('product');
    }

    // public function fetch_subcategory()
    // {
    //     $categoryId = $this->input->post('categoryId');
    //     if ($categoryId) {
    //         echo $this->WelcomeModel->fetch_productCode($categoryId);
    //     }
    // }
        public function fetch_subcategory()
    {
        $categoryId = $this->input->post('categoryId');
        if ($categoryId) {
            echo $this->WelcomeModel->fetch_subcategory($categoryId);
        }
    }
    
    public function productStatusUpdate($id)
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $Newstatus = "";
        $status = "";
        $checkstatus = $this->WelcomeModel->checkProductStatus($id);
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
        $res = $this->WelcomeModel->productUpdate($data, $id);
        if ($res == true) {
            $this->session->set_flashdata('success_msg', ' Record Updated Successfully. ');
            redirect('product-list');
        } else {
            $this->session->set_flashdata('error_msg', ' Sorry Some Error While updating!!!!');
            redirect('product-list');
        }
    }

    // |||||||||||||||||||||||||||||||||||||||| Stock Section |||||||||||||||||||||||||||

    public function stock()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }

        $data['stockList'] = $this->WelcomeModel->stockList();
        $data['brandListData'] = $this->WelcomeModel->brandListData();
        // $data['categoryListData'] = $this->WelcomeModel->CategoryListData();
        $data['page_title'] = 'KeralKart --stock'; //assign dynamically
        $data['pageName'] = 'stock';
        $this->load->view('admin/start', $data);
    }


    public function stockStatusUpdate($id)
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }

        $Newstatus = "";
        $status = "";
        $checkstatus = $this->WelcomeModel->checkStockStatus($id);
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
        $res = $this->WelcomeModel->stockUpdate($data, $id);
        if ($res == true) {
            $this->session->set_flashdata('success_msg', ' Record Updated Successfully. ');
            redirect('stock');
        } else {
            $this->session->set_flashdata('error_msg', ' Warning!! Sorry Some Error While updating!!!!');
            redirect('stock');
        }
    }

    public function stockUpdate()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        if (isset($_POST['update'])) {
            $id = $this->input->post('id');
            $data = array(
                'productCode' => $this->input->post('productCode'),
                
                'color' => $this->input->post('color'),
                'size' => $this->input->post('size'),
                'stockPrice' => $this->input->post('stockPrice'),
                'quantity' => $this->input->post('quantity'),
                'status' => $this->input->post('status'),
                'updated_at' => date('Y-m-d H:i:s'),
            );
            //print_r($data);
            $this->db->set($data);
            $res = $this->WelcomeModel->stockUpdate($data, $id);
            if ($res == true) {
                $this->session->set_flashdata('success_msg', ' Record Updated Successfully. ');
                redirect('stock');
            } else {
                $this->session->set_flashdata('error_msg', ' Warninig!!! Sorry Some Error While updating!!!!');
                redirect('stock');
            }
        }
    }

    public function addStock()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $data['brandListData'] = $this->WelcomeModel->brandListData();
        $data['productList'] = $this->WelcomeModel->productOnlyList();
        $data['page_title'] = 'Add Stock'; //assign dynamically
        $data['pageName'] = 'addStock';
        $this->load->view('admin/start', $data);
    }

    //fetch product code for products
    public function fetch_productCode()
    {
        $categoryId = $this->input->post('categoryId');
        if ($categoryId) {
            echo $this->WelcomeModel->fetch_productCode($categoryId);
        }
    }

    public function available_stock()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $data['available_stock'] = $this->WelcomeModel->available_stock();
        $data['page_title'] = 'Available Stock'; //assign dynamically
        $data['pageName'] = 'available_stock';
        $this->load->view('admin/start', $data);
    }

    public function stockCreate()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        if (isset($_POST['submit'])) {
            $data = array(
                'productCode' => $this->input->post('productCode'),
                'productID' => $this->input->post('productId'),
                'stockPrice' => $this->input->post('mrp'),
                'discount' => $this->input->post('discount'),
                'color' => $this->input->post('color'),
                'size' => $this->input->post('size'),
                'sellingPrice' => $this->input->post('price'),
                'quantity' => $this->input->post('quantity'),
                'status' => $this->input->post('status'),
                'added_at' => date('Y-m-d H:i:s'),
            );
            // print_r($data);
            // die();
            $proID=$this->input->post('productId');
            $mrp=$this->input->post('mrp');
            $price=$this->input->post('price');
            $quantity=$this->input->post('quantity');
            $data1 = array(
                'productCode' => $this->input->post('productCode'),
                'productID' => $this->input->post('productId'),
                'stockPrice' => $this->input->post('mrp'),
                'discount' => $this->input->post('discount'),
                'color' => $this->input->post('color'),
                'size' => $this->input->post('size'),
                'sellingPrice' => $this->input->post('price'),
                'quantity' => $this->input->post('quantity'),
                'status' => $this->input->post('status'),
                'added_at' => date('Y-m-d H:i:s'),
            );
            $res = $this->WelcomeModel->insertModel($data, 'stock');
            $res1 = $this->WelcomeModel->insertModel($data1, 'stockreport');

            if ($res == true && $res1 == true) {
                $this->db->query("update product_details set quantity='$quantity', price='$price',strikePrice='$price', mrp='$mrp' WHERE id='$proID'  ");
                        
                $this->session->set_flashdata('success_msg', ' Success!!! Data Inserted. ');
                redirect('add-stock');
            } else {
                $this->session->set_flashdata('error_msg', ' Warninig!!! Sorry Some Error While Inserting!!!!');
                redirect('add-stock');
            }
        }
    }


    //  |||||||||||||||||||||||||||||||| Customer List ||||||||||||||||||||||||||||||||||||||||||

    public function customerList()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $data['customerList'] = $this->WelcomeModel->customerList();
        $data['page_title'] = 'customers'; //assign dynamically
        $data['pageName'] = 'customerList';
        $this->load->view('admin/start', $data);
    }

    public function customerStatusUpdate($id)
    {

        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }

        $Newstatus = "";
        $status = "";
        $checkstatus = $this->WelcomeModel->checkCustomerStatus($id);
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
            'modified_at' => date('Y-m-d H:i:s'),
        );
        $this->db->set($data);
        $res = $this->WelcomeModel->customerUpdate($data, $id);
        if ($res == true) {
            $this->session->set_flashdata('success_msg', ' Record Updated Successfully. ');
            redirect('customer-list');
        } else {
            $this->session->set_flashdata('error_msg', ' Warning!! Sorry Some Error While updating!!!!');
            redirect('customer-list');
        }
    }
    // ||||||||||||||||| Reporting Section |||||||||||||||||||||||||||||
    #stock Report
    public function getAllStock()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $data['getAllStock'] = $this->WelcomeModel->getAllStock();
        $data['page_title'] = 'stock report';
        $data['pageName'] = 'all_stock';
        $this->load->view('admin/start', $data);
    }
    #stock Report by date

    public function getStockByDate()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $this->form_validation->set_rules('fromDate', 'fromDate', 'trim|required');
        $this->form_validation->set_rules('toDate', 'toDate', 'trim|required');
        $this->form_validation->set_rules('stockType', 'stockType', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error_msg', 'Please Fill all the field');
            return redirect("get-all-stock");
        }
        // $data['stockList'] = $this->WelcomeModel->getAllStock();
        #get stock within date range
        // if(isset($_POST['submit'])){

        // $data['page_title'] = 'stock report';
        // $data['pageName'] = 'getStockReportbyDate';
        // $this->load->view('admin/start', $data);
        // }
        $data['stockList'] = $this->WelcomeModel->getStockByDate();
        $data['page_title'] = 'stock report';
        $data['pageName'] = 'getStockReportbyDate';
        $this->load->view('admin/start', $data);
    }

    public function getAllSales()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $data['getAllSales'] = $this->WelcomeModel->getAllSales();
        $data['page_title'] = ' sales report';
        $data['pageName'] = 'all_sales';
        $this->load->view('admin/start', $data);
    }
    public function getSalesByDate()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $this->form_validation->set_rules('fromDate', 'fromDate', 'trim|required');
        $this->form_validation->set_rules('toDate', 'toDate', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error_msg', 'Please Fill all the field');
            return redirect("get-all-sales");
        }
            #get sales within the date range
        $data['getAllSales'] = $this->WelcomeModel->getsalesByDate();
        $data['page_title'] = 'Order Report';
        $data['pageName'] = 'getSalesByDate';
        $this->load->view('admin/start', $data);


    }
    public function getAllOrders()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $data['getAllOrders'] = $this->WelcomeModel->getAllOrders();
        $data['page_title'] = 'orders list';
        $data['pageName'] = 'all_orders';
        $this->load->view('admin/start', $data);
    }

    #getOrdersBydate
    public function getOrdersByDate()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $this->form_validation->set_rules('fromDate', 'fromDate', 'trim|required');
        $this->form_validation->set_rules('toDate', 'toDate', 'trim|required');
        // $this->form_validation->set_rules('orderStatus', 'orderStatus', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error_msg', 'Please Fill all the field');
            return redirect("get-all-orders");
        }
        $data['getAllOrders'] = $this->WelcomeModel->getOrdersByDate();
        $data['page_title'] = 'Order Report';
        $data['pageName'] = 'getOrdersReportByDate';
        $this->load->view('admin/start', $data);
    }


    public function getAllPayments()
    {

        $data['getAllPayments'] = $this->WelcomeModel->getAllPayments();
        $data['page_title'] = 'payment list';
        $data['pageName'] = 'all_payments';
        $this->load->view('admin/start', $data);
    }
    public function getPaymentsByDate()
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $this->form_validation->set_rules('fromDate', 'fromDate', 'trim|required');
        $this->form_validation->set_rules('toDate', 'toDate', 'trim|required');
        if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('error_msg', 'Please Fill all the field');
            return redirect("get-all-payments");
        }
        $data['getAllPayments'] = $this->WelcomeModel->getPaymentsByDate();
        $data['page_title'] = 'payment list';
        $data['pageName'] = 'getPaymentsReportsByDate';
        $this->load->view('admin/start', $data);
    }


    #Change Order Status of the ActiveOrders of the dashboard page of the admin section
    public function changeOrderStatus()
    {
         if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $data=array();
        $orderId = $this->input->post('orderId');
        $status = $this->input->post('status');
        $data = array(
            'satus' => $status,
            'modified_at' => date('Y-m-d H:i:s'),
        );
        $data2 = array(
            'status' => $status,
            'orderedOn' => date('Y-m-d H:i:s'),
        );
        $this->db->set($data);
        $data = $this->WelcomeModel->changeOrderStatus($orderId,$data,$data2);
        if($data == true){
            $data['response'] ='1';
           redirect(base_url().'dashboard');
       }else{
        $data['response'] = '2';
        redirect(base_url().'dashboard');
       }
        echo json_encode($data);
    }


//    |||||||||||||||||||||||||||||||  Subscriber Section |||||||||||||||||||||||||||||\

	public  function subscriber_list(){
		if (!$this->session->userdata('username')) {
			redirect('myadmin');
		}
		$data['subscriber_list'] = $this->WelcomeModel->getAllSubscriber();
		$data['page_title'] = ' subscriber list';
		$data['pageName'] = 'subscriber_list';
		$this->load->view('admin/start', $data);
	}
	public function subscriberStatusUpdate($id)
	{
		if (!$this->session->userdata('username')) {
			redirect('myadmin');
		}
		$Newstatus = "";
		$status = "";
		$checkstatus = $this->WelcomeModel->checkSubscriberStatus($id);
		// print_r($checkstatus);
		foreach ($checkstatus as $value) {
			$status = $value->status;
		}
		// echo $status;
		// die;
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
		$res = $this->WelcomeModel->subscriberStatusUpdate($data, $id);
		if ($res == true) {
			$this->session->set_flashdata('success_msg', ' Record Updated Successfully. ');
			redirect('subscriber-list');
		} else {
			$this->session->set_flashdata('error_msg', ' Sorry Some Error While updating!!!!');
			redirect('subscriber-list');
		}
	}

	public function subscriberDelete($id)
	{
		if ($this->session->userdata('username') == null) {
			redirect('myadmin');
		}
		$id = $this->uri->segment(3);
		$res = $this->WelcomeModel->subscriberDelete($id);
		if ($res == true) {
			$this->session->set_flashdata('success_msg', 'Deleted Successfully');
			return redirect('subscriber-list');
		} else {
			$this->session->set_flashdata('error_msg', 'Sorry Some Error!!!');
			redirect('subscriber-list');
		}
	}
                 //Contact Message 
        public function contact_message()
        {
            if (!$this->session->userdata('username')) {
            redirect('myadmin');
            }
        $data['Contact_message'] =$this->WelcomeModel->getAllDropMessage();
        $data['page_title'] = 'Contact Message ';
        $data['pageName'] = 'contact_message';
        $this->load->view('admin/start', $data);

        }


    //end of main class
}
