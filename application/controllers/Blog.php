<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library("pagination"); 
        $this->load->helper('form');
        $this->load->model('BlogModel');
        $this->load->model('ProductModel');
 
    }
    
    // generate url slug for the codeigniter blog

    function generate_url_slug($string,$table,$field='url_slug',$key=NULL,$value=NULL){
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
	
	public function index(){
		if (!$this->session->userdata('username')) {
            redirect('myadmin');
		}
		$data['page_title'] = 'write blog';  
		$data['pageName'] = 'blog';
        $this->load->view('admin/start', $data);
	}

	public function createBlog(){
		if (!$this->session->userdata('username')) {
            redirect('myadmin');
		}
		if (isset($_POST['submit'])) {
			$p1 = "noimage.png";
			$this->form_validation->set_rules('blogHeading', 'blogHeading', 'trim|required|htmlspecialchars','required');
			$this->form_validation->set_rules('blogContent', 'blogContent', 'trim|required|htmlspecialchars','required');
			if ($this->form_validation->run() === false) {
				$this->session->set_flashdata('error_msg', 'Please Fill all the field');
				return redirect("blog");
			} else {
				$p1 = "noimage.png";
				$config['upload_path'] = './uploads/admin/blog/';
				$config['allowed_types'] = 'jpg|png|jpeg|gif';
				$this->load->library('upload', $config);
				if ($this->upload->do_upload('blogImage')) {
					$data['uploadata'] = $this->upload->data();
					foreach ($data as $d) {
						$p1 = $d['file_name'];
					}
				} else {
					echo $errors = $this->upload->display_errors();
				}
				echo $p1;
                // die;
                $url_slug=$this->generate_url_slug($this->input->post('blogHeading'),'tbl_blog');
				$data = array(
                'blogHeading' => $this->input->post('blogHeading'),
                'blogContent' => $this->input->post('blogContent'),
                'url_slug' => $url_slug,
                'blog_image' => $p1,
                'createdBy' => $this->session->userdata('username'),
                'status' => '1',
                'added_at' => date('Y-m-d H:i:s'),
			);
			$res = $this->BlogModel->insertModel($data, 'tbl_blog');
				if ($res == true) {
					$this->session->set_flashdata('success_msg', ' Success!!! Data Inserted. ');
					redirect('blog-list');
				} else {
					$this->session->set_flashdata('error_msg', ' Warninig!!! Sorry Some Error While Inserting!!!!');
					redirect('blog-list');
				}
			}
           
		}
	}

	public function blogList(){
		if (!$this->session->userdata('username')) {
            redirect('myadmin');
		}
		$data['blogList']=$this->BlogModel->selectModel('tbl_blog');
		$data['page_title'] = 'blog list';  
		$data['pageName'] = 'blogList';
        $this->load->view('admin/start', $data);
	}

	public function blogDelete($id){
		if (!$this->session->userdata('username')) {
            redirect('myadmin');
		}
		$id = $this->uri->segment(3);
        $res = $this->BlogModel->deleteModel($id,'tbl_blog');
        if ($res == true) {
            $this->session->set_flashdata('success_msg', 'Deleted Successfully');
            return redirect('blog-list');
        } else {
            $this->session->set_flashdata('error_msg', 'Sorry Some Error!!!');
            redirect('blog-list');
        }
	}

	public function blogChangeStatus($id){
		if (!$this->session->userdata('username')) {
            redirect('myadmin');
		}
		$Newstatus = "";
        $status = "";
        $checkstatus = $this->BlogModel->checkStatus($id,'tbl_blog');
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
        $res = $this->BlogModel->updateModel($data, $id,'tbl_blog');
        if ($res == true) {
            $this->session->set_flashdata('success_msg', ' Success!!! Data updated. ');
            redirect('blog-list');
        } else {
            $this->session->set_flashdata('error_msg', ' ERROR!!! Sorry Some Error While updating!!!!');
            redirect('blog-list');
        }
	}

	public function updateBlog(){
		if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }

        if (isset($_POST['update'])) {
            
			$this->form_validation->set_rules('blogHeading', 'blogHeading', 'trim|required|htmlspecialchars','required');
			$this->form_validation->set_rules('blogContent', 'blogContent', 'trim|required|htmlspecialchars','required');
			if ($this->form_validation->run() === false) {
                $this->session->set_flashdata('error_msg', 'Please Fill all the field');
                return redirect("blog-list");
            } else {
                $blogId = $this->input->post('blogId');
                $data['blogList']=$this->BlogModel->selectModelInArraybyId('tbl_blog',$blogId);
                 
              
                // echo $p1 = "";
                
                // $config['upload_path'] = './uploads/admin/blog/';
                // $config['allowed_types'] = 'jpg|png|jpeg|gif';
                // $this->load->library('upload', $config);
                // if ($this->upload->do_upload('blogImage') != "") {
                //     $data['uploadata'] = $this->upload->data();
                //     foreach ($data as $d) {
                //         $p1 = $d['file_name'];
                //     }
                // } else {
                //     // $this->upload->do_upload('categoryThumbnailAlt');
                //     // $data['uploadata'] = $this->upload->data();
                //     foreach ($data as $d) {
                //         $p1 = $d['file_name'];
                //     }
                // }
                // echo  $p1;
                // die;  
                if ($_FILES['blog_image']['name'] != '') {
                    if ($data['blogList']['blog_image'] != '') {
                        unlink(FCPATH . 'uploads/admin/blog/' . $data['blogList']['blog_image']);
                    }
                    $uploaded_doc = $_FILES['blog_image']['name'];
                    echo $paths = FCPATH . "./uploads/admin/blog/" . $uploaded_doc;
                    move_uploaded_file($_FILES['blog_image']['tmp_name'], $paths);
                   echo  $blog_image = $uploaded_doc;
                } else {
                    echo  $blog_image = $data['blogList']['blog_image'];
                    // die;
                }

                $url_slug=$this->generate_url_slug($this->input->post('blogHeading'),'tbl_blog');
				$data = array(
                    'blogHeading' => $this->input->post('blogHeading'),
                    'url_slug' => $url_slug,
					'blogContent' => $this->input->post('blogContent'),
					'blog_image' => $blog_image,
					'createdBy' => $this->session->userdata('username'),
					'status' => '1',
					'modified_at' => date('Y-m-d H:i:s'),
				);
			
                print_r($data);
                $this->db->set($data);
                // die;
                $res = $this->BlogModel->updateModel($data, $blogId,'tbl_blog');
                if ($res == true) {
                    $this->session->set_flashdata('success_msg', ' Success!!! Data updated. ');
                    redirect('blog-list');
                } else {
                    $this->session->set_flashdata('error_msg', ' Warning!!! Sorry Some Error While updating!!!!');
                    redirect('blog-list');
                }
            }
        }
    

	}

/*
    public function blogs_list()
    {
      #for megamenu
        $data['type'] = $this->ProductModel->type();
        $type  = $this->ProductModel->type_array();
        foreach ($type->result_array()  as $type ) {
            $type_ids[] = $type['id'];
            
        }
        // $data['catagory'] = $this->ProductModel->Catagory_menu($type_ids);
        $category  = $this->ProductModel->getAllCategoryMenuTypeId($type_ids);
        foreach ($category as $categories) {
            $categoryIds[] =  $categories->id;
        }
        $data['category_list'] = $this->ProductModel->getAllCategoryMenuTypeId($type_ids);

        $data['all_product_sub_category'] = $this->ProductModel->all_sub_categories($categoryIds);
        
        // end of mega menu

        //Pagination Content
     
        $config = array();
        $config["base_url"] = base_url()."blogList";
        $config["total_rows"] = $this->BlogModel->get_count('tbl_blog');
        $config["per_page"] = 3;
        $config["uri_segment"] = 3;
        $config['full_tag_open'] = '<ul class="pagination pull-right">';
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li class="page-item">';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="page-item active"><a class="page-link" href="#">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_tag_open'] = '<li class="page-item">';
        $config['next_tagl_close'] = '</a></li>';
        $config['prev_tag_open'] = '<li class="page-item">';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li class="page-item disabled">';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li class="page-item">';
        $config['last_tagl_close'] = '</a></li>';
              
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $data["links"] = $this->pagination->create_links(); 
        //End Pagination 
        $data['blogList']=$this->BlogModel->selectOrderByModel('tbl_blog','desc',$config["per_page"], $page);

        $data['recentPost']=$this->BlogModel->getRecentPost('*','tbl_blog','1','30');
        //Side Heading 
        $data['Heading_name']=$this->BlogModel->getHeading('tbl_blog');
        $data['Popular_Heading']=$this->BlogModel->getPopularHeading('tbl_blog');
        //Product List
        $data['allProducts'] = $this->BlogModel->allProducts();
        $data['page_title'] = 'keralkart blog';  
        $data['pageName'] = 'blogs_list';
        $this->load->view('home/start', $data);
    }*/
    public function blogs_list()
    {
        #for megamenu
        $data['type'] = $this->ProductModel->type();
        $type = $this->ProductModel->type_array();
        foreach ($type->result_array() as $type) {
            $type_ids[] = $type['id'];

        }
        // $data['catagory'] = $this->ProductModel->Catagory_menu($type_ids);
        $category = $this->ProductModel->getAllCategoryMenuTypeId($type_ids);
        foreach ($category as $categories) {
            $categoryIds[] = $categories->id;
        }
        $data['category_list'] = $this->ProductModel->getAllCategoryMenuTypeId($type_ids);

        $data['all_product_sub_category'] = $this->ProductModel->all_sub_categories($categoryIds);

        // end of mega menu

        //Pagination Content

        $config = array();
        $config['base_url'] =base_url().'Blog/blogs_list';
        $config["total_rows"] = $this->BlogModel->get_count('tbl_blog');
        $config["per_page"] = 3;
        $config["uri_segment"] = 3;
        // Pagination link format
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = '<li class="active"><a href="javascript:void(0);">';
        $config['cur_tag_close'] = '</a></li>';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['next_tag_open'] = '<li class="pg-next">';
        $config['next_tag_close'] = '</li>';
        $config['prev_tag_open'] = '<li class="pg-prev">';
        $config['prev_tag_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        //end of pagination link format
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data["links"] = $this->pagination->create_links();
        //End Pagination
        $data['blogList'] = $this->BlogModel->selectOrderByModel('tbl_blog', 'desc', $config["per_page"], $page);

        $data['recentPost'] = $this->BlogModel->getRecentPost('*', 'tbl_blog', '1', '30');
        //Side Heading
        $data['Heading_name'] = $this->BlogModel->getHeading('tbl_blog');
        $data['Popular_Heading'] = $this->BlogModel->getPopularHeading('tbl_blog');
        //Product List
        $data['allProducts'] = $this->BlogModel->allProducts();
        $data['page_title'] = 'keralkart blog';
        $data['pageName'] = 'blogs_list';
        $this->load->view('home/start', $data);
    }
     public function get_one_blog($url_slug)
     {
      #for megamenu
        $data['type'] = $this->ProductModel->type();
        $type  = $this->ProductModel->type_array();
        foreach ($type->result_array()  as $type ) {
            $type_ids[] = $type['id'];
            
        }
        // $data['catagory'] = $this->ProductModel->Catagory_menu($type_ids);
        $category  = $this->ProductModel->getAllCategoryMenuTypeId($type_ids);
        foreach ($category as $categories) {
            $categoryIds[] =  $categories->id;
        }
        $data['category_list'] = $this->ProductModel->getAllCategoryMenuTypeId($type_ids);

        $data['all_product_sub_category'] = $this->ProductModel->all_sub_categories($categoryIds);
        

        //end megamenu 
        
        $data['blogList']=$this->BlogModel->selectOneDataModel('tbl_blog',$url_slug);
        $data['recentPost']=$this->BlogModel->getRecentPost('*','tbl_blog','1','10');
        $data['Heading_name']=$this->BlogModel->getHeading('tbl_blog');
        $data['Popular_Heading']=$this->BlogModel->getPopularHeading('tbl_blog');
         //Product List
        $data['allProducts'] = $this->BlogModel->allProducts();
        $data['page_title'] = 'keralkart '.$url_slug;  
        $data['pageName'] = 'blog_details';
        $this->load->view('home/start', $data);
     }



}