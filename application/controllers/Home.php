<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('ProductModel');
		#load carousal model
		$this->load->model('CarousalModel');
		$this->load->model('UserModel');
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

	// |||||||||||||| MEGA MENU SECTION START    ||||||||
	#megamenu
	public function megaMenu()
	{
		$data['all_product_sub_category'] = $this->ProductModel->all_sub_catagory();
		$data['type'] = $this->ProductModel->type();
		$data['catagory'] = $this->ProductModel->Catagory_menu();
		// $this->load->view('users/megamenu', $data);
	}

	// public function change_url()
	// {
	// 	$allProducts = $this->ProductModel->allProducts();
	// 	//  $allProducts['productName'];
	// 	foreach ($allProducts as $key) {
	// 		$id=$key->id;
	// 		//echo $key->productName;
	// 		$slug=$this->generate_url_slug($key->productName,'product_details','slug');
	// 		$this->db->query("UPDATE product_details set `slug`='$slug' where `id`='$id' ");
	// 	}
	// }
	public function index()
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
		
		// $data['all_product_sub_category'] = $this->ProductModel->all_sub_catagory();
		// end of mega menu


		#carousals
		$data['projectSliders'] = $this->CarousalModel->slider_list();

		#allProducts
		$data['allProducts'] = $this->ProductModel->allProducts();
		#category
		$data['Category'] = $this->ProductModel->getData('*', 'category', 0, 10);

		$categoryTotal = $this->ProductModel->getData('*', 'category', 0, 10);

		foreach ($categoryTotal as $items):

			$categoryIds[] = $items->id;

		endforeach;

		//$categoryIdAll=implode($categoryIds, ",");
		$data['Products'] = $this->ProductModel->getSpecificData('*', 'product_details p', 'p.categoryId', $categoryIds, 0, 6);

		#SELECT * FROM `product_details` WHERE categoryId IN (1,2,3,4) order by categoryId ASC
		#$data['AllProduct'] = $this->ProductModel->whereInData($categoryIds);
		//$data['AllProducts'] = $this->ProductModel->getProducts();

		//$this->generate_url_slug("t shirt road ranger",'product_details','slug');;
		#get all Category for showing in the home page
		$data['getAllCategory'] = $this->ProductModel->getRandomCategory();
		$data['page_title'] = 'KeralKart'; //assign dynamically
		$data['pageName'] = 'home';
		$this->load->view('home/start', $data);
	}

	#product_details
	public function productDetail($productName)
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
		
		// $data['all_product_sub_category'] = $this->ProductModel->all_sub_catagory();
		// end of mega menu




		//$productName = str_replace('-', '+', $product);
		#allProducts
		$data['product'] = $this->ProductModel->singleProducts($productName);

		# get productCode from product_details table so we can fetch all data from stock and product details table
		$singleProductArray = $this->ProductModel->singleProductArray($productName);

		$productCode = $singleProductArray['productCode'];
		$productId = $singleProductArray['id'];
		$productCategory = $singleProductArray['categoryId'];
		$productNames = $singleProductArray['productName'];

		//setting productcode in session
		$this->session->set_userdata('stockProductCode', $productCode);
		// setting productName in session
		$this->session->set_userdata('productName', urldecode($productNames));
		//setting product id in session
		$this->session->set_userdata('productId', $productId);

		$data['productInformation'] = $this->ProductModel->getProductbyProductId($productCode);

		#get data using categoryId;
		 $data['re_products'] = $this->ProductModel->getProductByCategoryId($productCategory);

		# get All category
		$data['all_category'] = $this->ProductModel->getAllCategory();

		#getProduct Rating and review from database using product Id
		$data['get_avg_rating'] = $this->ProductModel->getAvgRatingReview($productId);
		$data['get_rating_review'] = $this->ProductModel->getRatingReview($productId);
		
		$data['page_title'] = 'product details';
		$data['pageName'] = 'product_details';
		$this->load->view('home/start', $data);
	}

	// public function category($name) {

	//     $productName=str_replace('-', '+', $name);
	//     #allProducts

	//     echo  $name= htmlspecialchars(urldecode($productName));
	//     //$data['product'] = $this->ProductModel->singleProducts(urldecode($productName));

	//     $idCat = $this->ProductModel->getOneData('*','category','categoryName',$name);
	//     //print_r($data);
	//     //echo "ds";

	//     $idCat['id'];

	//     $data['page_title'] = $name.' KeralKart';
	//     $data['pageName'] = 'category_page';
	//     $this->load->view('home/start', $data);

	// }

	public function category($name)
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
				
				// $data['all_product_sub_category'] = $this->ProductModel->all_sub_catagory();
				// end of mega menu
		
		#category
		$data['Category'] = $this->ProductModel->getData('*', 'category', 0, 10);

		$productName = str_replace('-', '+', $name);
		#allProducts

		$names = (urldecode($productName));
		//$data['product'] = $this->ProductModel->singleProducts(urldecode($productName));

		// $idCat = $this->ProductModel->getOneData('*', 'category', 'categoryName', $names);
		$idCat = $this->ProductModel->getOneData('*', 'category', 'url_slug', $names);
         
		/*die;*/
		$categoryId = $idCat['id'];

		$data['products'] = $this->ProductModel->getSpecificDataAll('*', 'product_details', 'categoryId', $categoryId);
		
		
				#get all product id that are associated with this subcategory
		$allProductId = $this->ProductModel->getAllProductIdCategory($categoryId);

		foreach ($allProductId as $prd) {
			$productIds[] =  $prd->id;
		}
		#getColors those who are associated with the choosed subcategory
		$data['color_data'] = $this->ProductModel->getColorBySubCategorytest($productIds);


		#getSizes those who are associated with the choosed subcategory
		$data['size_data'] = $this->ProductModel->getSizeBySubCategorytest($productIds);



		#getBrands only associated with this category
		$data['brand_data'] = $this->ProductModel->getBrandByCategory($categoryId);

		#getColors those who are associated with the choosed category 
		$data['color_data1'] = $this->ProductModel->getColorByCategory($categoryId);

		#getSizes those who are associated with the choosed category 
		$data['size_data1'] = $this->ProductModel->getSizeByCategory($categoryId);

		//echo $allProduct['productName'];

		$data['page_title'] = $name . ' KeralKart';
		$data['pageName'] = 'category_page';
		$this->load->view('home/start', $data);

	}
	public function categoryById($categoryId)
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
		
		// $data['all_product_sub_category'] = $this->ProductModel->all_sub_catagory();
		// end of mega menu
		

		$data['products'] = $this->ProductModel->getSpecificDataAll('*', 'product_details', 'categoryId', $categoryId);

		#getBrands only associated with this category
		$data['brand_data'] = $this->ProductModel->getBrandByCategory($categoryId);

		#getColors those who are associated with the choosed category 
		$data['color_data'] = $this->ProductModel->getColorByCategory($categoryId);

		#getSizes those who are associated with the choosed category 
		$data['size_data'] = $this->ProductModel->getSizeByCategory($categoryId);

		//echo $allProduct['productName'];

		$data['page_title'] =' KeralKart';
		$data['pageName'] = 'cat_page';
		$this->load->view('home/start', $data);

	}

	public function subcategory($name)
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

		// $data['all_product_sub_category'] = $this->ProductModel->all_sub_catagory();
		// end of mega menu


		#category
		$data['SubCategory'] = $this->ProductModel->getData('*', 'subcategory', 0, 10);

		$productName = str_replace('-', '+', $name);
		#allProducts

		$names = (urldecode($productName));
		//$data['product'] = $this->ProductModel->singleProducts(urldecode($productName));

		$idSubCat = $this->ProductModel->getOneData('*', 'subcategory', 'url_slug',$name);
		

		$subcategoryId = $idSubCat['id'];

		$data['products'] = $this->ProductModel->getSpecificDataAll('*', 'product_details', 'subcategoryId', $subcategoryId);

		//echo $allProduct['productName'];
        #get all product id that are associated with this subcategory
		$allProductId = $this->ProductModel->getAllProductIdSubcategory($subcategoryId);

		foreach ($allProductId as $prd) {
			$productIds[] =  $prd->id;
		}
		#getColors those who are associated with the choosed subcategory
		$data['color_data'] = $this->ProductModel->getColorBySubCategorytest($productIds);


		#getSizes those who are associated with the choosed subcategory
		$data['size_data'] = $this->ProductModel->getSizeBySubCategorytest($productIds);


		#getBrands only associated with this subcategory
		$data['brand_data'] = $this->ProductModel->getBrandBySubCategory($subcategoryId);

		#getColors those who are associated with the choosed subcategory
		$data['color_data1'] = $this->ProductModel->getColorBySubCategory($subcategoryId);

		#getSizes those who are associated with the choosed subcategory
		$data['size_data1'] = $this->ProductModel->getSizeBySubCategory($subcategoryId);


		$data['page_title'] = $name . ' KeralKart';
		$data['pageName'] = 'subcategory_page';
		$this->load->view('home/start', $data);

	}

	public function search_category()
	{
		#megamenu
		//  $data['all_product_sub_category']=$this->ProductModel->all_sub_catagory();
		//  $data['type']=$this->ProductModel->type();
		//  $data['catagory']=$this->ProductModel->Catagory_menu();
		//  // megamenu end

		// $search_name = $this->input->post('category_name_search');
		// $data=$this->ProductModel->GetSearchName($search_name);
		// // return $this->productDetail($data);
		// $data['page_title'] = $name . ' KeralKart';
		//  $data['pageName'] = 'productDetail';
		//  $this->load->view('home/start', $data);
	}

	// autocomplete fetch
	function fetch()
	{
	 $this->load->model('ProductModel');
	 echo $this->ProductModel->fetch_data($this->uri->segment(3));
	}

	//contact page
	public function about()
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

		#carousals
		$data['projectSliders'] = $this->CarousalModel->slider_list();

		#allProducts
		$data['allProducts'] = $this->ProductModel->allProducts();
		#category
		$data['Category'] = $this->ProductModel->getData('*', 'category', 0, 10);

		$categoryTotal = $this->ProductModel->getData('*', 'category', 0, 10);

		foreach ($categoryTotal as $items):

			$categoryIds[] = $items->id;

		endforeach;

		//$categoryIdAll=implode($categoryIds, ",");
		$data['Products'] = $this->ProductModel->getSpecificData('*', 'product_details', 'categoryId', $categoryIds, 0, 6);

		$data['getAllCategory'] = $this->ProductModel->getRandomCategory();
		$data['page_title'] = 'About Us - KeralKart'; //assign dynamically
		$data['pageName'] = 'about';
		$this->load->view('home/start', $data);
	}

	//privacy policy page
	public function privacy()
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
		$data['page_title'] = 'Privacy Policy - KeralKart'; //assign dynamically
		$data['pageName'] = 'privacy_policy';
		$this->load->view('home/start', $data);
	}

	//cancellation
	public function cancellation()
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
		$data['page_title'] = 'Cancellation and Returns Policy - KeralKart'; //assign dynamically
		$data['pageName'] = 'cancellation';
		$this->load->view('home/start', $data);
	}

//security 
	public function security ()
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

		$data['page_title'] = 'Security Process Policy - KeralKart'; //assign dynamically
		$data['pageName'] = 'security';
		$this->load->view('home/start', $data);
	}

            //Contact us page 

	public function contact_us ()
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
		$data['page_title'] = 'KeralKart'; //assign dynamically
		$data['pageName'] = 'contact_us';
		$this->load->view('home/start', $data);
	}





	public function shipping()
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
		$data['page_title'] = 'Shipping Policy - KeralKart'; //assign dynamically
		$data['pageName'] = 'shipping';
		$this->load->view('home/start', $data);
	}


    

	//end of main class
}
