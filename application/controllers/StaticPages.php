<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class StaticPages extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('form');
        $this->load->model('BlogModel');
        $this->load->model('ProductModel');
 
    }

	public function contact_us ()
	{
		// #for megamenu
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
		$data['page_title'] = 'KeralKart'; //assign dynamically
		$data['pageName'] = 'contact_us';
		$this->load->view('home/start', $data);
	}
}
    
