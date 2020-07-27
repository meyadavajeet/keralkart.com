<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Product_filter extends CI_Controller {
 
 public function __construct()
 {
  parent::__construct();
  $this->load->model('product_filter_model');
  $this->load->model('ProductModel');
 }

 // function index()
 // {
 //  //fetch all value in database
 //  // $data['brand_data'] = $this->product_filter_model->fetch_filter_type('brand');
 //  // $data['color_data'] = $this->product_filter_model->fetch_filter_type('color');
 //  // $data['size_data'] = $this->product_filter_model->fetch_filter_type('size');
 //  // // $this->load->view('product_filter', $data);
 //  //   $data['page_title'] = $name . ' KeralKart';
 //  //   $data['pageName'] = 'category_page';
 //  //   $this->load->view('home/start', $data);
 // }

 function fetch_data()
 {

   $name = $this->input->post('categoryName');
 
  #category
    $data['Category'] = $this->ProductModel->getData('*', 'category', 0, 10);

    // $productName = str_replace('-', '+', $name);
    #allProducts

    // $names = (urldecode($productName));
    //$data['product'] = $this->ProductModel->singleProducts(urldecode($productName));

    $idCat = $this->ProductModel->getOneData('*', 'category', 'url_slug', $name);
    $categoryId = $idCat['id'];

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
  $config['total_rows'] = $this->product_filter_model->count_all($minimum_price, $maximum_price, $brand, $color, $size,$categoryId);
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
   'pagination_link'  => $this->pagination->create_links(),
   'product_list'   => $this->product_filter_model->fetch_data($config["per_page"], $start, $minimum_price, $maximum_price, $brand, $color, $size, $categoryId)
  );
  //all value send in json 
  echo json_encode($output);
 }
  

 #for getting data with the help of id
 
//  function fetch_data()
//  {

//   $id = $this->input->post('categoryName');
//   #category
//     $data['Category'] = $this->ProductModel->getData('*', 'category', 0, 10);

//     // $productName = str_replace('-', '+', $name);
//     #allProducts

//     // $names = (urldecode($productName));
//     //$data['product'] = $this->ProductModel->singleProducts(urldecode($productName));

//     $idCat = $this->ProductModel->getOneData('*', 'category', 'id', $id);

//     $categoryId = $idCat['id'];

//     // $data['products'] = $this->ProductModel->getSpecificDataAll('*', 'product_details', 'categoryId', $categoryId);

//   //set hear pagination and filter 
//   sleep(1);
//   $minimum_price = $this->input->post('minimum_price');
//   $maximum_price = $this->input->post('maximum_price');
//   $brand = $this->input->post('brand');
//   $color = $this->input->post('color');
//   $size = $this->input->post('size');
//   $this->load->library('pagination');
//   $config = array();
//   $config['base_url'] = '#';
//   $config['total_rows'] = $this->product_filter_model->count_all($minimum_price, $maximum_price, $brand, $color, $size,$categoryId);
//   $config['per_page'] = 16;
//   $config['uri_segment'] = 3;
//   $config['use_page_numbers'] = TRUE;
//   $config['full_tag_open'] = '<ul class="pagination">';
//   $config['full_tag_close'] = '</ul>';
//   $config['first_tag_open'] = '<li>';
//   $config['first_tag_close'] = '</li>';
//   $config['last_tag_open'] = '<li>';
//   $config['last_tag_close'] = '</li>';
//   $config['next_link'] = '&gt;';
//   $config['next_tag_open'] = '<li>';
//   $config['next_tag_close'] = '</li>';
//   $config['prev_link'] = '&lt;';
//   $config['prev_tag_open'] = '<li>';
//   $config['prev_tag_close'] = '</li>';
//   $config['cur_tag_open'] = "<li class='active'><a href='#'>";
//   $config['cur_tag_close'] = '</a></li>';
//   $config['num_tag_open'] = '<li>';
//   $config['num_tag_close'] = '</li>';
//   $config['num_links'] = 3;
//   $this->pagination->initialize($config);
//   $page = $this->uri->segment(3);
//   $start = ($page - 1) * $config['per_page'];
//   $output = array(
//    'pagination_link'  => $this->pagination->create_links(),
//    'product_list'   => $this->product_filter_model->fetch_data($config["per_page"], $start, $minimum_price, $maximum_price, $brand, $color, $size, $categoryId)
//   );
//   //all value send in json 
//   echo json_encode($output);
//  }
  
}
?>
