<?php if (!defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php

class Product_filter_subcategory extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->model('Product_filter_subcategory_model', 'product_filter_model');
		$this->load->model('ProductModel');
	}

	public function fetch_data()
	{
	    
	   

		$name = $this->input->post('categoryName');
	
		#category
		$data['SubCategory'] = $this->ProductModel->getData('*', 'subcategory', 0, 10);

		$productName = str_replace('-', '+', $name);
		#allProducts

		$names = (urldecode($productName));
		//$data['product'] = $this->ProductModel->singleProducts(urldecode($productName));

		$idSubCat = $this->ProductModel->getOneData('*', 'subcategory', 'url_slug', $name);
           
		$subcategoryId = $idSubCat['id'];

		// $data['products'] = $this->ProductModel->getSpecificDataAll('*', 'product_details', 'categoryId', $categoryId);

		//set hear pagination and filter
		sleep(1);
		$minimum_price = $this->input->post('minimum_price');
		$maximum_price = $this->input->post('maximum_price');
		$brand = $this->input->post('brand');
		$color = $this->input->post('color');
		$size = $this->input->post('size');
		$this->load->library('pagination');
		$config = array();
		$config['base_url'] = '#';
		$config['total_rows'] = $this->product_filter_model->count_all($minimum_price, $maximum_price, $brand, $color, $size, $subcategoryId);
		$config['per_page'] = 16;
		$config['uri_segment'] = 3;
		$config['use_page_numbers'] = TRUE;
		$config['full_tag_open'] = '<ul class="pagination">';
		$config['full_tag_close'] = '</ul>';
		$config['first_tag_open'] = '<li>';
		$config['first_tag_close'] = '</li>';
		$config['last_tag_open'] = '<li>';
		$config['last_tag_close'] = '</li>';
		$config['next_link'] = '&gt;';
		$config['next_tag_open'] = '<li>';
		$config['next_tag_close'] = '</li>';
		$config['prev_link'] = '&lt;';
		$config['prev_tag_open'] = '<li>';
		$config['prev_tag_close'] = '</li>';
		$config['cur_tag_open'] = "<li class='active'><a href='#'>";
		$config['cur_tag_close'] = '</a></li>';
		$config['num_tag_open'] = '<li>';
		$config['num_tag_close'] = '</li>';
		$config['num_links'] = 3;
		$this->pagination->initialize($config);
		$page = $this->uri->segment(3);
		$start = ($page - 1) * $config['per_page'];
		$output = array(
			'pagination_link' => $this->pagination->create_links(),
			'product_list' => $this->product_filter_model->fetch_data($config["per_page"], $start, $minimum_price, $maximum_price, $brand, $color, $size, $subcategoryId)
		);
		//all value send in json
	   echo json_encode($output);
	}

}

?>
