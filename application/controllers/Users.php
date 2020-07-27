<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('UserModel');
		$this->load->model('ProductModel');
	}

	public function userLogin()
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
                //Count cart value

		$data['page_title'] = 'KeralKart --User Login';
		$data['pageName'] = 'userLogin';
		$this->load->view('home/start', $data);
	}
		public function send_otp()
	{
		$otpnum=htmlspecialchars($this->input->post('otpnumSendReset'));
		$contactn=htmlspecialchars($this->input->post('contactNumberOTP'));

    	$data=$this->UserModel->user_verify_model('customer_master','mobile',$contactn);
    	if (!empty($data)) {
    		$api_key = '55F05AB2F59E60';
			$contacts = $contactn;
			$from = 'KINEXT';
			$message='KeralKart: OTP is '.$otpnum;
			$sms_text = urlencode($message);

			$api_url = "http://kinextechnologies.in/app/smsapi/index.php?key=".$api_key."&campaign=10028&routeid=24&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text;

			//Submit to server

			$response = file_get_contents($api_url);
    	}
    	else{
    		echo "Not Found";
    	}
	}


	public function userRegister()
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


		$data['page_title'] = 'KeralKart --User Register';
		$data['pageName'] = 'userRegister';
		$this->load->view('home/start', $data);
	}

	function dashboard()
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

		$this->load->view('dashboard');
	}

	public function userCreate()
	{
	    $this->session->unset_userdata('user_mobile');
		$customerName = $this->input->post('customerName');
		$mobile = $this->input->post('mobile');
		$this->session->set_userdata('user_mobile',$mobile);
		$email = $this->input->post('email');
		$password = md5($this->input->post('password'));
		$status = 1;
		$is_activated = 0;
		$this->form_validation->set_rules('customerName', 'customerName', 'trim|required|htmlspecialchars', 'required');
		$this->form_validation->set_rules('mobile', 'mobile', 'trim|required|htmlspecialchars', 'required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|htmlspecialchars', 'required');
		$this->form_validation->set_rules('password', 'password', 'trim|required|htmlspecialchars', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error_msg', 'Please fill all the field');
		} else {
			$data = array(
				'customerName' => $customerName,
				'mobile' => $mobile,
				'email' => $email,
				'password' => $password,
				'status' => $status,
				'is_activated' => $is_activated,
				'added_at' => date('Y-m-d H:i:s')
			);
             if($this->security->xss_clean($data))
	              	{
			$res = $this->UserModel->insertModel($data, 'customer_master');
	              	}
	              
			if ($res == true) {
				 $r_num= rand(10,10000);
		        $this->session->set_userdata('register_otp',$r_num);
				$api_key = '55F05AB2F59E60';
					$contacts = $mobile;
						$login='https://keralkart.com/register-otp';
						$from = 'KINEXT';
						$message='Dear  '.$customerName.'  Verify Your RegisterNumber ,   Your One Time Password  is '.$r_num."     Don't share to any one " .'   click here ->  ' .$login. '   Thank your for registration with KeralKart. Login with your registered Email/Mobile Number and Password';	$sms_text = urlencode($message);

						$api_url = "http://kinextechnologies.in/app/smsapi/index.php?key=".$api_key."&campaign=10028&routeid=24&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text;

						//Submit to server

						$response = file_get_contents($api_url);
				$this->session->set_flashdata('success_msg', ' Data have been added successfully.');
				       redirect('register-otp');
			} else {
				$this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
			}
		}
		redirect('userRegister');
	}


	             //Register Time Otp Verify 

	                    public function register_mobile_otp()
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
							$data['all_product_sub_category'] = $this->ProductModel->all_sub_categories($categoryIds);		// $data['all_product_sub_category'] = $this->ProductModel->all_sub_catagory();
							// end of mega menu
							$data['page_title'] = 'Verify Otp';
							$data['pageName'] = 'register_mobile_verify';
							$this->load->view('home/start', $data);
	                    }


	                      public function register_otp_verify()
	                      {
	                      	$otp=$this->input->post('otpnumber');
	                      	$mobile=$this->session->userdata('user_mobile');
	                        $number_otp=$this->session->userdata('register_otp');
	                        if($otp==$number_otp){
                               $this->UserModel->Update_Active_user($mobile);      
	                        $this->session->set_flashdata("success_msg","<span class='text-primary'>!Otp Match</span>");
	           		        redirect('userLogin');

	                        }
	                        else{
	                    	$this->session->set_flashdata("Not_match","<span class='text-danger'>!Otp Not Match Try With  Correct One </span>");
	       		            redirect('register-otp');
	                        }
	                      	
	                      }


	public function checkUserLogin()
	{
		$this->form_validation->set_rules('emailMobile', 'emailMobile', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|max_length[50]');
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('wrong_pass', 'Please fill all the required fields.!!!');
			return redirect("userLogin");
		} else {
			$emailMobile = $this->input->post('emailMobile');
			$password = md5($this->input->post('password'));
			$res = $this->UserModel->login($emailMobile, $password);
			if ($res == true) {
				$this->session->set_userdata('user', $emailMobile);
				//$this->session->userdata('user');
				//print_r($this->UserModel->getDataBySessionName($this->session->userdata('user')));
				$query = $this->UserModel->getDataBySessionName($this->session->userdata('user'));
				//print_r($query);
				if ($query) {
					foreach ($query as $key) {
						$customerId = $key->id;
						$customerName = $key->customerName;
						$mobile = $key->mobile;
						$email = $key->email;
					}
					$newUserData = array(
						'customerId' => $customerId,
						'customerName' => $customerName,
						'email' => $email,
						'mobile' => $mobile
					);
					//print_r($newUserData);
					// die();
					$this->session->set_userdata($newUserData);
				} 
				$items=  count($this->cart->contents());
				if($items==null)
				{
                  return redirect(base_url());
				}
				else{
					return redirect('checkout');
				}
				
			} else {
				$this->session->set_flashdata('wrong_pass', 'Please use right credential and varify your email and phone number.!!!');
				return redirect('userLogin');
			}
		}
	}

	public function userLogout()
	{
		$this->session->unset_userdata($newUserData);
		$this->session->unset_userdata('user');
		// $this->session->sess_destroy(); //it will destroy all the session
		redirect(base_url());

	}

// ||||||||||||||||||||||||||||||||||||| USER DASHBOARD SECTION ||||||||||||||||||||||||||
	public function userDashboard()
	{
		if (!$this->session->userdata('user')) {
			redirect('userLogin');
		}
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



		$data['page_title'] = 'KeralKart --User Dashboard';
		$data['pageName'] = 'userDashboard';
		$this->load->view('home/start', $data);
	}

	public function myAccount()
	{
		
		if (!$this->session->userdata('user')) {
			redirect('userLogin');
		}
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

		#getallordered product 
		$data['all_ordered_products'] = $this->UserModel->all_ordered_products();
		$data['page_title'] = 'my account';
		$data['pageName'] = 'myAccount';
		$this->load->view('home/start', $data);
	}
	#insert review and rating 
	public function feedback()
	{
		if (!$this->session->userdata('user')) {
			redirect('userLogin');
		}
		$id=$this->session->userdata('customerId');
		$productId = $this->input->post('product_id');
		$rating = $this->input->post('rating');
		$feedback = htmlspecialchars($this->input->post('feedback'));
		$rating_details= array(
			'productId' =>$productId,
			'ratings' =>$rating,
			'reviews' =>$feedback,
			'userId' =>$id,
			'added_at' =>date('Y-m-d H:i:s'), 
			'updated_at' =>date('Y-m-d H:i:s'),
			'status' =>'1'
		);
		if($this->security->xss_clean($rating_details))
		{
		$res = $this->UserModel->rating($rating_details,$id,$productId);
	     }
	     else{
	     	$this->session->set_flashdata('success_msg','Not Allowed This Type Of Character!');
	     	redirect('my-account');
	     }
		if($res){
			$this->session->set_flashdata('success_msg','Already Rated this product!');
			redirect('my-account');
		}else{
			$this->session->set_flashdata('error_msg','Some Problem while rating.!');
			redirect('my-account');	
		}
		
			
	}

	public function orderHistory()
	{
		if (!$this->session->userdata('user')) {
			redirect('userLogin');
		}
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

		#load all orders done by the logged in user
		$data['order_history'] = $this->UserModel->getAllOrders();
		$data['page_title'] = 'order history';
		$data['pageName'] = 'orderHistory';
		$this->load->view('home/start', $data);
	}

	public function activeOrders()
	{
		if (!$this->session->userdata('user')) {
			redirect('userLogin');
		}
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

		#load all orders done by the logged in user
		$data['active_orders'] = $this->UserModel->getAllActiveOrders();
		$data['page_title'] = 'active order';
		$data['pageName'] = 'activeOrders';
		$this->load->view('home/start', $data);
	}



	#Change Order Status of the ActiveOrders of the dashboard page of the admin section
    public function changeOrderStatusUser()
    {
        if (!$this->session->userdata('user')) {
			redirect('userLogin');
		}
		$data=$this->UserModel->getDataBySessionName($this->session->userdata('user'));
		foreach ($data as $key) {
		    $mobile = $key->mobile;
		}
		$data = array();
         $orderId = $this->input->post('orderId');
         $satus = $this->input->post('satus');
         $pid = $this->input->post('pid');
         $color = $this->input->post('color');
         $size = $this->input->post('size');
         $qty = $this->input->post('qty');
        $data1 = array(
            'satus' => $satus,
            'modified_at' => date('Y-m-d H:i:s')
        );
        $data2 = array(
            'status' => $satus
        );
        $this->db->set($data1);
       
        $data = $this->UserModel->changeOrderStatusUser($orderId,$data1);
        $this->db->set($data2);
        $this->UserModel->changeOrderStatusUser2($orderId,$data2);
        if($data == true){
        				# update in the stock table
        				$result3 = $this->db->query("update stock set quantity=`quantity`+$qty WHERE productID='$pid' and `color`='$color' and `size`='$size' ");
            			

						//$this->db->set($stockreport);
            			$result4 = $this->db->query("update stockreport set quantity=`quantity`+$qty WHERE productID='$pid' and `color`='$color' and `size`='$size' ");
            			//send sms
            			$api_key = '55F05AB2F59E60';
						$contacts = $mobile;
						$from = 'KINEXT';
						$message='KeralKart: Request for cancelling order #'.$orderId.' is accepted and will be contact shortly for refund of payment. Check your status here: https://keralkart.com/';
						$sms_text = urlencode($message);

						$api_url = "http://kinextechnologies.in/app/smsapi/index.php?key=".$api_key."&campaign=10028&routeid=24&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text;

						//Submit to server

						$response = file_get_contents($api_url);

        	//echo "success";
            //$data['response'] ='1';
          // redirect(base_url().'active-orders');
       }else{
       	echo "failed";
       // $data['response'] = '2';
        //redirect(base_url().'active-orders');
       }
       // echo json_encode($data);
    }


	public function myAddress()
	{
		if (!$this->session->userdata('user')) {
			redirect('userLogin');
		}
		
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

		$data['page_title'] = 'my address';
		$data['pageName'] = 'myAddress';
		$this->load->view('home/start', $data);
	}

	public function trackOrder()
	{
		if (!$this->session->userdata('user')) {
			redirect('userLogin');
		}
		
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

		#track Order
		$data['getAllActiveOrders']= $this->UserModel->getAllActiveOrders();
		$getOrderId= $this->UserModel->getOrderId();
		foreach($getOrderId as $orderIds){
			  $orderIds = $orderIds['orderId'];
			  $data['getDataByOrderId']= $this->UserModel->getDataByOrderId($orderIds);
		}
		
		$data['page_title'] = 'track order';
		$data['pageName'] = 'trackOrder';
		$this->load->view('home/start', $data);
	}

	public function notifications()
	{
		if (!$this->session->userdata('user')) {
			redirect('userLogin');
		}
		
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


		$data['page_title'] = 'notifications';
		$data['pageName'] = 'notifications';
		$this->load->view('home/start', $data);
	}


	#||||||||||||||||||||||| Customer Dashboard ||||||||||||||||||||||||||

	public function customer_dashboard()
	{
		if (!$this->session->userdata('user')) {
			redirect('userLogin');
		}
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


		$data['page_title'] = 'dashboard';
		$data['pageName'] = 'customer_dashboard';
		$this->load->view('home/start', $data);
	}


	public function	getDataByOrderId($orderIds){
		if (!$this->session->userdata('user')) {
			redirect('userLogin');
		}
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


		$data['getProductByOrderId'] = $this->UserModel->getProductByInvoiceId($orderIds,'5');
		$data['page_title'] = $orderIds.'Details';
		$data['pageName'] = 'ordered_product';
		$this->load->view('home/start', $data);
		
	}
	public function	trackOrderByOrderId($orderIds){
		if (!$this->session->userdata('user')) {
			redirect('userLogin');
		}
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


		$data['getProductByOrderId'] = $this->UserModel->getProductByOrderId($orderIds);
		$data['page_title'] = $orderIds.'Details';
		$data['pageName'] = 'track_ordered_product';
		$this->load->view('home/start', $data);
		
	}
	public function	getDataByOrderIdActiveOrders($orderIds){
		if (!$this->session->userdata('user')) {
			redirect('userLogin');
		}
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


		$data['getProductByOrderId'] = $this->UserModel->getProductByOrderId($orderIds);
		$data['page_title'] = $orderIds.'Details';
		$data['pageName'] = 'active_ordered_product';
		$this->load->view('home/start', $data);
		
	}
	public function	reset_password(){
		if (!$this->session->userdata('user')) {
			redirect('userLogin');
		}
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
		 $customerId = $this->session->userdata('customerId');
		$data['page_title'] = 'reset password';
		$data['pageName'] = 'reset_password';
		$this->load->view('home/start', $data);
		
	}

	public function change_password_process()
    {
        if (!$this->session->userdata('user')) {
			redirect('userLogin');
		}
        if ($this->input->post('change_pass')) {
            $old_pass = md5($this->input->post('old_pass'));
            $new_pass = md5($this->input->post('new_pass'));
			$confirm_pass = md5($this->input->post('confirm_pass'));
			$session_id = $this->session->userdata('customerId');
            $pass = $this->UserModel->fetch_pass($session_id, $old_pass);
            if ($pass) {
                if (!strcmp($new_pass, $confirm_pass)) {
                    $this->UserModel->change_pass($session_id, $new_pass);
                    $this->session->set_flashdata('success_msg', 'Password Changed Successfully!!!!!');
                    redirect('reset-password');
                } else {
                    $this->session->set_flashdata('error_msg', 'Your New Password And Confirm Password Not Matched');
                    redirect('reset-password');
                }
            } else {
                $this->session->set_flashdata('error_msg', 'Invalid Old Password!!!!!');
                redirect('reset-password');
            }
        }
	}
	
	public function address_list(){
		if (!$this->session->userdata('user')) {
			redirect('userLogin');
		}
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

		$customerId = $this->session->userdata('customerId');
		$data['get_user_info'] = $this->UserModel->getUserInformation($customerId);

		$data['page_title'] = 'my address';
		$data['pageName'] = 'defalult_address';
		$this->load->view('home/start', $data);
		
	}
	public function edit_profile(){
		if (!$this->session->userdata('user')) {
			redirect('userLogin');
		}
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

		
		$customerId = $this->session->userdata('customerId');
		$data['get_user_info'] = $this->UserModel->getUserInformation($customerId);
		$data['page_title'] = 'edit profile';
		$data['pageName'] = 'edit_profile';
		$this->load->view('home/start', $data);
		
	}

	public function updateUserProfilePicture()
	{
		
		if (!$this->session->userdata('user')) {
			redirect('userLogin');
		}
		if (isset($_POST['update'])) {
			// $this->input->post('profilePicture');
			$p1 = "no-image.png";
            $config['upload_path'] = './uploads/customers/';
            $config['allowed_types'] = 'jpg|png|jpeg|gif';
            $this->load->library('upload', $config);
            if ($this->upload->do_upload('profilePicture')) {
                $data['uploadata'] = $this->upload->data();
                foreach ($data as $d) {
                    $p1 = $d['file_name'];
                }
            } else {
                echo $errors = $this->upload->display_errors();
            }

             $id = $this->input->post('cusotomerid');
            $data = array(
                'profileImage' =>$p1,
                'modified_at' => date('Y-m-d H:i:s'),
			);
			// print_r($data);
            $this->db->set($data);
            $res = $this->UserModel->updateUserProfile($data, $id);
            if ($res == true) {
                $this->session->set_flashdata('success_msg', ' Success!!! Data Updated. ');
                redirect('edit-profile');
            } else {
                $this->session->set_flashdata('error_msg', ' Sorry Some Error While Updating!!!!');
                redirect('edit-profile');
            }
        }
	}
	public function updateUserProfile()
	{
		
		if (!$this->session->userdata('user')) {
			redirect('userLogin');
		}
		if (isset($_POST['update'])) {
			echo "hellow";
           echo  $id = $this->input->post('cusotomerid');
            $data = array(
                'customerName' => $this->input->post('customerName'),
                'email' => $this->input->post('email'),
                'mobile' => $this->input->post('mobile'),
                'modified_at' => date('Y-m-d H:i:s'),
			);
			// print_r($data);
            $this->db->set($data);
            $res = $this->UserModel->updateUserProfile($data, $id);
            if ($res == true) {
                $this->session->set_flashdata('success_msg', ' Success!!! Data Updated. ');
                redirect('edit-profile');
            } else {
                $this->session->set_flashdata('error_msg', ' Sorry Some Error While Updating!!!!');
                redirect('edit-profile');
            }
        }
	}
	public function UpdateUserAddress()
	{
		
		if (!$this->session->userdata('user')) {
			redirect('userLogin');
		}
		if (isset($_POST['update'])) {
			// echo $this->input->post('landmark');
			// die;
            $id = $this->input->post('cusotomerid');
            $data = array(
                'customerName' => $this->input->post('customerName'),
                'email' => $this->input->post('email'),
				'mobile' => $this->input->post('mobile'),
				'CustomerAddress' => $this->input->post('customerAddress'),
				'alternateContact' => $this->input->post('altContactNumber'),
				'postalCode' => $this->input->post('postalCode'),
				'country' => $this->input->post('coutntry'),
				'state' => $this->input->post('state'),
				'city' => $this->input->post('city'),
				'landmark' => $this->input->post('landmark'),
                'modified_at' => date('Y-m-d H:i:s')
			);
			// print_r($data);
            $this->db->set($data);
            $res = $this->UserModel->updateUserProfile($data, $id);
            if ($res == true) {
                $this->session->set_flashdata('success_msg', ' Success!!! Data Updated. ');
                redirect('address-list');
            } else {
                $this->session->set_flashdata('error_msg', ' Sorry Some Error While Updating!!!!');
                redirect('address-list');
            }
        }
	}


        //contact submit
	   public function contact_post()
	   {
            $firstname=$this->input->post('firstname');
            $lastname=$this->input->post('lastname');
            $email=$this->input->post('email');
            $subject=$this->input->post('subject');
            $message=$this->input->post('message');
            $status ='1';
		    $is_activated ='1';
		$this->form_validation->set_rules('firstname', 'firstname', 'trim|required|htmlspecialchars', 'required');
		$this->form_validation->set_rules('email', 'email', 'trim|required|htmlspecialchars', 'required');
		$this->form_validation->set_rules('subject', 'subject', 'trim|required|htmlspecialchars', 'required');
		$this->form_validation->set_rules('message', 'message', 'trim|required|htmlspecialchars', 'required');
		if ($this->form_validation->run() === FALSE) {
			$this->session->set_flashdata('error_msg', 'Please fill all the field');
		} else {
			$data = array(
				'firstname'=>$firstname,
				'lastname'=>$lastname,
				'email'=>$email,
				'subject'=>$subject,
				'message'=>$message,
                 'status' => $status,
				'is_activated' => $is_activated,
				'added_at' => date('Y-m-d H:i:s')
			   );
		   $res = $this->UserModel->contactus($data, 'contact_us');
			if ($res == true) {
				$this->session->set_flashdata('success_msg', ' Message have been Drop successfully.');
			} else {
				$this->session->set_flashdata('error_msg', 'Some problems occured, please try again.');
			}
		}
		redirect('contact-us');
	}

	    public function  forget_password (){
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
		$data['all_product_sub_category'] = $this->ProductModel->all_sub_categories($categoryIds);		// $data['all_product_sub_category'] = $this->ProductModel->all_sub_catagory();
		// end of mega menu
	    $data['page_title'] = 'Forget Password';
		$data['pageName'] = 'forget_password';
		$this->load->view('home/start', $data);
		    

	    }

                 //Email verify 
	        public function Email_verify()
	        {
	        	$this->form_validation->set_rules('emailMobile', 'emailMobile', 'trim|required|min_length[4]');
				
	        	  $Email=$this->input->post('emailMobile');
	        	  $this->session->set_userdata('email',$Email);
	        	if ($this->form_validation->run() === FALSE) {
			    $this->session->set_flashdata('wrong_pass', 'Please fill all the field');
		        }

		        $res=$this->UserModel->Mail_verify($Email);
		        if($res==true)
		        {
		        	 $r_num= rand(10,10000);
		        	 $this->session->set_userdata('otp',$r_num);
		        	  $r_num= rand(10,10000);
		        	 $this->session->set_userdata('otp',$r_num);
                         $api_key = '55F05AB2F59E60';
			$contacts = $Email;
			$from = 'KINEXT';
			$message='KeralKart: OTP is '.$r_num;
			$sms_text = urlencode($message);

			$api_url = "http://kinextechnologies.in/app/smsapi/index.php?key=".$api_key."&campaign=10028&routeid=24&type=text&contacts=".$contacts."&senderid=".$from."&msg=".$sms_text;

			//Submit to server

			$response = file_get_contents($api_url);
                      redirect('user-otp-verify');
		        }
		        else{
                    
                    $this->session->set_flashdata('wrong_pass', 'Not Match');
		        	redirect('user-password');
		        }
	        }
             // Otp page
	          public function User_Otp()
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
					$data['all_product_sub_category'] = $this->ProductModel->all_sub_categories($categoryIds);		// $data['all_product_sub_category'] = $this->ProductModel->all_sub_catagory();
					// end of mega menu
					$data['page_title'] = 'OTP Details ';
					$data['pageName'] = 'otp_verify';
					$this->load->view('home/start', $data);
	          }

	           public function user_otp_verify()
	           {
	           	$otp=$this->input->post('userotp');
	           	$user_otp=$this->session->userdata('otp');
	           	//$res=$this->UserModel->user_otp_verify($otp);
	           	if($otp==$user_otp){
	           		$this->session->set_flashdata("wrong_pass","<span class='text-primary'>!Otp Match</span>");
	           		redirect('user-new-password');
	           	}
	           	 else{
	           	 	$this->session->set_flashdata("wrong_otp"," !Otp  Not Match");
	           	 	redirect('user-otp-verify');
	           	 }


	           }

	            // Generate New Password //User
	            public function  user_new_password()
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
					$data['all_product_sub_category'] = $this->ProductModel->all_sub_categories($categoryIds);		// $data['all_product_sub_category'] = $this->ProductModel->all_sub_catagory();
					// end of mega menu
					$data['page_title'] = 'Generate New Password';
					$data['pageName'] = 'generate_new_password';
					$this->load->view('home/start', $data);
	            }

	            public function Update_user_password()
	            {
	            	 $this->form_validation->set_rules('password', 'newpassword', 'trim|required|min_length[4]|max_length[50]');
	            	$password=md5($this->input->post('newpassword'));
	            		
	            	$res=$this->UserModel->update_user_password($password);
	            	if($res==True)
	            	{
	            		$this->session->set_flashdata('correct_pass',"<b><span class='text-success'>New Password Generated Successfully</span></b>");
                        redirect('userLogin');
	            	}
	            	else{

                       $this->session->set_flashdata('wrong_pass',"New password Generated Successfully");
	            		redirect('user-new-password');
	            	}

	            }
                         


	//end of main class
}