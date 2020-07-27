<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->library('cart');
		$this->load->model('ProductModel');
		$this->load->model('UserModel');

	}


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
			'-' =>''

		);
		while (list($character, $replacement) = each($specialCharacters)) {
			$string = str_replace($character, '' . $replacement . '', $string);
		}
		$string = strtr($string, "ÀÁÂÃÄÅ�áâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ", "AAAAAAaaaaaaOOOOOOooooooEEEEeeeeCcIIIIiiiiUUUUuuuuyNn"
		);
		// Remove all remaining other unknown characters
		$string = preg_replace('/[^a-zA-Z0-9\-.$"]/', ' ', $string);
		return $string;
	}


              // Color Filter 
	           public function color_filter()
	           {
	            $color=	$this->input->post('color');
	            $pro_id=	$this->input->post('productId');
	            $res['Response']=$this->ProductModel->fetch_details_by_color($color,$pro_id);
	            echo json_encode($res['Response']);
	          /*   $res['Response'];*/
	          /*   die;*/
	           }
                  
	//view cart viewCart
	public function viewCart()
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
		#megamenu
		// $data['all_product_sub_category'] = $this->ProductModel->all_sub_catagory();
		// $data['type'] = $this->ProductModel->type();
		// $data['catagory'] = $this->ProductModel->Catagory_menu();
		// megamenu end

		//get all detail of products form db
		$cartCount = count($this->cart->contents());
		if ($cartCount > 0) {
			foreach ($this->cart->contents() as $items):
				$idAllCart[] = $items['id'];
			endforeach;
		}


		$productIdCart = implode($idAllCart, ",");
		if (empty($idAllCart)) {
			redirect(base_url());
		}
		// $this->session->userdata('user');
		// $this->session->userdata('customerName');
		// $data['options'][0][0]['productCode'];
		// $data['productDetailNew'] = $this->ProductModel->WhereInNEW($)
		$data['productDetail'] = $this->ProductModel->whereIN($idAllCart); //columnName,tableName,whereColumn,Condition

		#allProducts
		$data['allProducts'] = $this->ProductModel->allProducts();
		$data['page_title'] = 'KeralKart';  //assign dynamically
		$data['pageName'] = 'user_cart';
		$this->load->view('home/start', $data);
	}

	//remove product from cart
	function remove($rowid)
	{

		if ($rowid === "all") {
			// Destroy data which store in  session.
			$this->cart->destroy();
		} else {
			// Destroy selected rowid in session.
			$data = array(
				'rowid' => $rowid,
				'qty' => 0
			);
			// Update cart data, after cancle.
			$this->cart->update($data);
		}

		// This will show cancle data in cart.
		redirect(base_url() . 'cart');
	}

	//add product/products to cart

	public function addToCart()
	{

		$id = $this->input->post('id');
		$product_name = $this->input->post('product_name');
		$productCode = $this->input->post('productCode');
		$qty = $this->input->post('qty');
		$img = $this->input->post('image');
		$size = $this->input->post('size');
		$brand = $this->input->post('brand');
		$color = $this->input->post('color');
		// die();
		// die;
		$checkAvaiablityOfProduct = $this->ProductModel->checkAvaiablityOfProduct('stock', $productCode, $color, $size, $brand);
		// echo $checkAvaiablityOfProduct['quantity'];
		// if(($checkAvaiablityOfProduct['quantity']) < 1){
		//   $this->session->set_flashdata('error_msg', ' Sorry!!! Product Out Of Stock');
		// }

		// print_r( $checkAvaiablityOfProduct);
		// die;
		if (!isset($checkAvaiablityOfProduct[0]["id"])) {
			echo "product stock not avaiable";
			$this->session->set_flashdata('error_msg', ' Sorry!!! Product Out Of Stock');
			redirect(base_url());
		}
// else
// {
//     echo"hello";
// }


		// die;

		// die;
		#$a = 'How are you?';

		// if (strpos($product_name, '&') == true) {
		//     echo $productName=base64_encode($product_name); #product name encoded to base 64 , decode it whereever cart products will displayed
		// }
		// else{
		//     $productName= $product_name;
		// }
		//echo $this->clean_title($product_name);


		//$price=$this->input->post('price');

		$price = $this->ProductModel->getOneData('*', 'product_details', 'id', $id); //columnName,tableName,whereColumn,Condition
		//echo $price['price'];
		$data = array(
			'id' => $id,
			'qty' => $qty,
			'price' => $price['price'],
			'name' => str_replace('&', '_', $product_name),
			'options' => array('color' => $img, 'size' => $size, 'image' => $img, 'productCode' => $productCode)
		);
		// print_r($price);
		// print_r($data);
		// die;
		// $data['options'][0]['productCode'];

		$session_id = $this->session->userdata('id');

		$res = $this->cart->insert($data);
		if ($res == true) {
			//echo "Added";
			redirect(base_url() . 'cart');
		} else {
			redirect(base_url());
		}

		//redirect(base_url());
	}

	//update cart products
	public function updateCart()
	{

		$rowid = $_POST['rowid'];
		$qty = $_POST['qty'];


		$data = array(
			'rowid' => $rowid,
			'qty' => $qty
		);

		$this->cart->update($data);


		//redirect(base_url().'cart');
	}


	//checkout and order place

	public function checkout()
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
		#megamenu
		// $data['all_product_sub_category'] = $this->ProductModel->all_sub_catagory();
		// $data['type'] = $this->ProductModel->type();
		// $data['catagory'] = $this->ProductModel->Catagory_menu();
		// megamenu end

		$cartCount = count($this->cart->contents());
		if ($cartCount > 0) {
			foreach ($this->cart->contents() as $items):
				$idAllCart[] = $items['id'];
			endforeach;
		}

		$productIdCart = implode($idAllCart, ",");
		if (empty($idAllCart)) {
			redirect(base_url());
		}

		$data['productDetail'] = $this->ProductModel->whereIN($idAllCart); //
		// select all information of login user
		// print_r($newUserData);
		// access session data which is in the array format
		$customerSessionId = $this->session->userdata('customerId');
		// echo $customerSessionId;
		// die();
		// $data['getCustomerInformationById'] = $this->UserModel->getCustomerInformationById($customerSessionId);
		$customerId = $this->session->userdata('customerId');
		$data['get_user_info'] = $this->UserModel->getUserInformation($customerId);
		$data['page_title'] = 'KeralKart';  //assign dynamically
		$data['pageName'] = 'checkout';
		$this->load->view('home/start', $data);
	}

public function saveAddress()
	{
		
		$alternateContact = $this->input->post('alternateContact');
		$address = $this->input->post('address');
		$landmark = $this->input->post('landmark');
		$pincode = $this->input->post('pincode');
		$country = $this->input->post('country');
		$state = $this->input->post('state');
		$city = $this->input->post('city');

		$customer_address = array(
			
			'alternateContact' => $alternateContact,
			'postalCode' => $pincode,
			'myAddress' => $address,
			'landmark' => $landmark,
			'country' => $country,
			'state' => $state,
			'city' => $city
			
		);

		$this->session->set_userdata($customer_address);

	}
	
	public function orderConfirm()
	{
		$dateFormat = new DateTime("now", new DateTimeZone('Asia/Kolkata') );
        $FinalDate=$dateFormat->format('Y-m-d h:i:s A');
        
		$postdata = $_POST;
		$msg = '';
		
		// $this->db->trans_begin();
		$cartCount = count($this->cart->contents());
		if ($cartCount > 0) {
			foreach ($this->cart->contents() as $items):
				$idAllCart[] = $items['id'];
			endforeach;
		}

		$productIdCart = implode($idAllCart, ",");
		if (empty($idAllCart)) {
			redirect(base_url());
		}

		$productDetails = $this->ProductModel->whereIN($idAllCart);
		foreach ($productDetails as $products) {
			$priceTotal[] = $products->price;
			$mrpAll[] = $products->mrp;
		}
		$day = date('d');
		$year = date('Y');
		$randomNumber = rand(000000000, 999999999);
		$orderId = $year . $day . $randomNumber;
		// die();
		$customerName = $this->session->userdata('customerName');
		$userMobile = $this->session->userdata('mobile');
		$userId = $this->ProductModel->getOneData('id', 'customer_master', 'mobile', $userMobile); //
		$customerId = $userId['id'];
		$alternateContact = $this->session->userdata('alternateContact');
		$address = $this->session->userdata('myAddress');
		$landmark = $this->session->userdata('landmark');
		$pincode = $this->session->userdata('postalCode');
		$country = $this->session->userdata('country');
		$state = $this->session->userdata('state');
		$city = $this->session->userdata('city');
		$paymentMode = 'Online'; // change to dynamic if needed
		// $subtotalNew = $this->cart->total();
		#calculation for the cart
		$tempTotal = ($this->cart->total());
		$tempDiscount = ((array_sum($mrpAll)) - (array_sum($priceTotal)));
		$subtotalNew = (round($tempTotal) + round($tempDiscount));
		$customer_address = array(
			'customerId' => $customerId,
			'ContactNo' => $userMobile,
			'alternateContact' => $alternateContact,
			'postalCode' => $pincode,
			'myAddress' => $address,
			'landmark' => $landmark,
			'country' => $country,
			'state' => $state,
			'city' => $city,
			'added_at' => date('Y-m-d H:i:s'),
			'statu' => 1
		);
				//insert data to `customer_address` table
		
		#customerAddress array for the customer_address table i.e  shipping address

		//echo "gfd";
		if (isset($postdata ['key'])) {
			//echo "Fds";
				$key				=   'rEO4xfp5';
				$salt				=   'O1D32If9jV';
				$txnid 				= 	$postdata['txnid'];
			    $amount      		= 	$postdata['amount'];
				$productInfo  		= 	$postdata['productinfo'];
				$firstname    		= 	$postdata['firstname'];
				$email        		=	$postdata['email'];
				$udf5				=   $postdata['udf5'];
				$mihpayid			=	$postdata['mihpayid'];
				$status				= 	$postdata['status'];
				$resphash			= 	$postdata['hash'];
				//Calculate response hash to verify	
				$keyString 	  		=  	$key.'|'.$txnid.'|'.$amount.'|'.$productInfo.'|'.$firstname.'|'.$email.'|||||'.$udf5.'|||||';
				$keyArray 	  		= 	explode("|",$keyString);
				$reverseKeyArray 	= 	array_reverse($keyArray);
				$reverseKeyString	=	implode("|",$reverseKeyArray);
				$CalcHashString 	= 	strtolower(hash('sha512', $salt.'|'.$status.'|'.$reverseKeyString));
				
				$insertData = array(
					'paymentId' => $txnid, 
					'OrderId' => $orderId, 
					'customerId' => $customerId, 
					
					'Amount' => $amount, 
					'status' => $status, 
					'added_at' => $FinalDate, 
					'hash_generate' => $resphash, 
					'paymentType' => $paymentMode, 
					'hash_receive' => $CalcHashString 
				);


				 $this->ProductModel->insertOrder($insertData, 'paymentdetail');
		$this->ProductModel->insertOrder($customer_address, 'customer_address');
		
				if ($status == 'success'  && $resphash == $CalcHashString) {
					echo $msg = "Transaction Successful and Hash Verified...";
					//Do success order processing here.
					#foreach is used to get all the data which is in the cart
					foreach ($this->cart->contents() as $items) {
						$OrderProductId = $items['id'];
						$productQuantity = $items['qty'];
						$priceProduct = $items['price'];
						$size = $items['options']['size'];
						//$brand = $items['options']['brand'];
						$productImage = $items['options']['image'];
						$color = $items['options']['color'];
						$productCode = $items['options']['productCode'];

						$ordered_items = array(
							'orderId' => $orderId,
							'productId' => $OrderProductId,
							
							'price' => $priceProduct,
							'quantity' => $productQuantity,
							'size' => $size,
							
							'color' => $color,
							'productImage' => $productImage,
							'orderedOn' => date('Y-m-d H:i:s'),
							'status' => 1
						);
						// var_dump($ordered_items);
						//insert data to `ordered_items` table

						$result2 = $this->ProductModel->insertOrder($ordered_items, 'ordered_items');

						# update in the stock table
						
            			$result3 = $this->db->query("update stock set quantity=`quantity`-$productQuantity WHERE productID='$OrderProductId' and `color`='$color' and `size`='$size' ");
            			

						//$this->db->set($stockreport);
            			$result4 = $this->db->query("update stockreport set quantity=`quantity`-$productQuantity WHERE productID='$OrderProductId' and `color`='$color' and `size`='$size' ");
						
						//$result4 = $this->ProductModel->insertOrder($stock, 'stockreport');//arraydata,tablename
					}
					#end of foreach
					if ($result2 == false) {
						// $this->db->trans_rollback();
						redirect(base_url() . 'failure-order');
					}
					if ($result3 == false) {
						// $this->db->trans_rollback();
						redirect(base_url() . 'failure-order');
					}

					if ($result4 == false) {
						// $this->db->trans_rollback();
						redirect(base_url() . 'failure-order');
					}
					//insert data to `order_master` table
					$order_master = array(
						'orderId' => $orderId,
						'total' => $tempTotal,
						'paymentMode' => $paymentMode,
						'subtotal' => $subtotalNew,
						'deliveryCharge' => 0,
						'discount' => $tempDiscount,
						'shippingAddress' => $landmark,
						'customerId' => $customerId,
						'added_at' => date('Y-m-d H:i:s'),
						// 'modified_at' => '',
						'satus' => 1
					);
					$res = $this->ProductModel->insertOrder($order_master, 'order_master');
					$orderDetailsSession = array();
					if ($res = true) {
						$orderDetailsSession = array(
							'orderId' => $orderId,
							'paymentMode' => $paymentMode,
							'added_at' => date('Y-m-d H:i:s'),
							'subtotal' => $subtotalNew,
							'discount' => $tempDiscount,
							'total' => $tempTotal,
							'landmark' => $landmark,
							'myAddress' => $address,
							'pincode' => $pincode,
							'country' => $state,
							'city' => $city,
							'userMobile' => $userMobile,
							'alternateContact' => $alternateContact,
							'customerName' => $customerName
						);
						$this->session->set_userdata($orderDetailsSession);

						$api_key = '55F05AB2F59E60';
						$contacts = $userMobile;
						$from = 'KINEXT';
						$message='KeralKart: Thanks for shopping with us! Your order #'.$orderId.' is confirmed and will be shipped shortly. Check your status here: https://keralkart.com/';
						$sms_text = urlencode($message);

						$api_url = "http://kinextechnologies.in/app/smsapi/index.php?key=".$api_key."&campaign=10028&routeid=24&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text;

						//Submit to server

						$response = file_get_contents($api_url);

						// var_dump($orderDetailsSession);

						// die();
						#destroy cart data
						redirect(base_url() . 'success');
					} else {
						// $this->db->trans_rollback();
						redirect(base_url() . 'failure-order');
					}
				}
				else {
					echo $msg = "Payment failed for Hasn not verified...";
					redirect(base_url() . 'failure-order');
				}
		}
		
		
		
		
		
		// $this->db->trans_commit();
	}

	public function success()
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
		$data['page_title'] = 'KeralKart';  //assign dynamically
		$data['pageName'] = 'success';
		$this->load->view('home/start', $data);
	}

	public function failure_order()
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

		$data['page_title'] = 'order failed';  //assign dynamically
		$data['pageName'] = 'failure_order';
		$this->load->view('home/start', $data);
	}


// for the serarch box option

	public function category_search_name()
	{
		$search_name = $this->input->post("search_name"); // first get search character
		$data = $this->ProductModel->GetCatSearchName($search_name); // SearchModel is the model class name
		$view = '';
		foreach ($data as $sval) {
			// $view = $view . '<li onclick="addText(\'' . $sval->productName . '\')">' . $sval->productName . '</li>';
			$view = $view .'<li style="padding:10px; cursor:pointer;" onclick="addText(\''.$sval->productName.'\')"><img class="img img-thumbnail img-responsive" style="height:40px; width:40px; padding:0px;" src="'.base_url().'uploads/product/'.$sval->thumbnail1.'"><a>'.$sval->productName.'</a></li>';
		}
		echo $view;
	}
	
	function get_search_result(){
		$data = array();
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
		
		

		$productName = $this->input->get('category_search_name');
		$categoryId = $this->ProductModel->getCategoryIDByProductName($productName);
		$caID = "";
		foreach($categoryId as $cid){
		 $caID = $cid->categoryId;
		}
		if($caID !=""){
			$categoryNames = $this->ProductModel->getCategoryNameByCategoryId($caID);
			#getBrands only associated with this category
			$data['brand_data'] = $this->ProductModel->getBrandByCategory($caID);

			#getColors those who are associated with the choosed category 
			$data['color_data'] = $this->ProductModel->getColorByCategory($caID);

			#getSizes those who are associated with the choosed category 
			$data['size_data'] = $this->ProductModel->getSizeByCategory($caID);

			foreach($categoryNames as $cName){
				$name = $cName->categoryName;
				// echo $name;
				$searchKeyword = strip_tags($name);
				$this->session->set_userdata('searchKeyword',$searchKeyword);
				$data['page_title'] = $name . ' KeralKart';
				$data['pageName'] = 'search_result_page';
				$this->load->view('home/start', $data);
			   }
		}else{
			$data['page_title'] = $this->session->userdata('searchKeyword').' KeralKart';
			$data['pageName'] = 'product_not_found';
			$this->load->view('home/start', $data);
		}
		

	}

// add to cart with the help of ajax
	public function addToCartProduct()
	{
		$id = $this->input->post('id');
		$product_name = $this->input->post('product_name');
		$productCode = $this->input->post('productCode');
		$qty = $this->input->post('qty');
		$img = $this->input->post('image');
		$size = $this->input->post('size');
		//$brand = $this->input->post('brand');
		$color = $this->input->post('color');

		// empty array for storing response
		$data = array();
		$checkAvaiablityOfProduct = $this->ProductModel->checkAvaiablityOfProduct('stock', $productCode, $color, $size);
		// die;
		// if product not avaiable then it show product out of stock
		// if (!isset($checkAvaiablityOfProduct[0]["id"])) {
		// 	$data["Response"] = "1";
		// 	echo json_encode($data);
		// 	return $data;

		// }

		if (!isset($checkAvaiablityOfProduct[0]["id"])) {
			$data["Response"] = "0";
			echo json_encode($data);
			return $data;

		}




		#get product price on the basis of id from the product_details table
		//$price = $this->ProductModel->getOneData('*', 'product_details', 'id', $id); //columnName,tableName,whereColumn,Condition

$priceN = $this->ProductModel->getData_price('*', 'stock', 'productID', $id,$size,$color); //columnName,tableName,whereColumn,Condition
		//echo "Print ". $priceN['sellingPrice'];
		// print_r($price);
		// die();
		$data = array(
			'id' => $id,
			'qty' => $qty,
			'price' => $priceN['sellingPrice'],
			'name' => str_replace('&', '_', $product_name),
			'options' => array('color' => $color, 'size' => $size, 'image' => $img, 'productCode' => $productCode)
		);
		// print_r($price);
		// print_r($data);
		// die;
		// $data['options'][0]['productCode'];
		// $this->session->set_userdata('id',$data['id']);

		$session_id = $this->session->userdata('id');
		// die();
		$res = $this->cart->insert($data);
		if ($res == true) {
			//echo "Added";
			$data["Response"] = "1";

		} else {
			$data["Response"] = "2";

		}


		echo json_encode($data);
		//redirect(base_url());

	}
	public function generateHash()
	{
		if(strcasecmp($_SERVER['REQUEST_METHOD'], 'POST') == 0){
		    //Request hash
		    $contentType = isset($_SERVER["CONTENT_TYPE"]) ? trim($_SERVER["CONTENT_TYPE"]) : '';   
		    if(strcasecmp($contentType, 'application/json') == 0){
		        $data = json_decode(file_get_contents('php://input'));
		        $hash=hash('sha512', $data->key.'|'.$data->txnid.'|'.$data->amount.'|'.$data->pinfo.'|'.$data->fname.'|'.$data->email.'|||||'.$data->udf5.'||||||'.$data->salt);
		        $json=array();
		        $json['success'] = $hash;
		        echo json_encode($json);
		    //echo "fd";
		    }
		    exit(0);
		}
	}
	public function payment_Response(){


		$dateFormat = new DateTime("now", new DateTimeZone('Asia/Kolkata') );
        $FinalDate=$dateFormat->format('Y-m-d h:i:s A');
        $postdata = $_POST;

        $insertDataEarlier = array(
				'transaction_id' => $postdata['txnid'], 
				'user_id' => $postdata['firstname'], 
				'tournament_id' => $postdata['productinfo'], 
				'payable_amount' => $postdata['amount'], 
				'response_status' => 'pending', 
				'transaction_date' => $FinalDate, 
				'hash_generate' => $postdata['hash'], 
				'hash_receive' => '' 
			);
			//$this->UserLogin->register_user('payment_tb',$insertDataEarlier);


		
		$msg = '';
		if (isset($postdata ['key'])) {
			$key				=   'rEO4xfp5';
			$salt				=   'O1D32If9jV';
			$txnid 				= 	$postdata['txnid'];
		    $amount      		= 	$postdata['amount'];
			$productInfo  		= 	$postdata['productinfo'];
			$firstname    		= 	$postdata['firstname'];
			$email        		=	$postdata['email'];
			$udf5				=   $postdata['udf5'];
			$mihpayid			=	$postdata['mihpayid'];
			$status				= 	$postdata['status'];
			$resphash			= 	$postdata['hash'];
			//Calculate response hash to verify	
			$keyString 	  		=  	$key.'|'.$txnid.'|'.$amount.'|'.$productInfo.'|'.$firstname.'|'.$email.'|||||'.$udf5.'|||||';
			$keyArray 	  		= 	explode("|",$keyString);
			$reverseKeyArray 	= 	array_reverse($keyArray);
			$reverseKeyString	=	implode("|",$reverseKeyArray);
			$CalcHashString 	= 	strtolower(hash('sha512', $salt.'|'.$status.'|'.$reverseKeyString));
			
			$insertData = array(
				'transaction_id' => $txnid, 
				'user_id' => $firstname, 
				'tournament_id' => $productInfo, 
				'payable_amount' => $amount, 
				'response_status' => 'pending', 
				'transaction_date' => $FinalDate, 
				'hash_generate' => $resphash, 
				'hash_receive' => $CalcHashString 
			);
			//$this->UserLogin->register_user('payment_tb',$insertData);
			if ($status == 'success'  && $resphash == $CalcHashString) {
				echo $msg = "Transaction Successful and Hash Verified...";
				//Do success order processing here.
			}
			else {
				echo $msg = "Payment failed for Hasn not verified...";
			}
}
}
	// remove all items in the cart

	public function clear()
	{
		$this->cart->destroy();
		redirect(base_url());
	}








}
