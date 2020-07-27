<?php

defined('BASEPATH') or exit('No direct script access allowed');

class UserModel extends CI_Model
{

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

/*Update UserActive */
     public function Update_Active_user($mobile)
     {
        $update_pass = $this->db->query("UPDATE customer_master set is_activated='1'  where mobile='$mobile'"); 
        return true;
     }

	public function user_verify_model($table,$column,$number){
		$this->db->select('*');
		$this->db->from($table);
		$this->db->where($column, $number);
		$data = $this->db->get();
		return $data->row_array();
	}

	public function insertModel($data, $tableName)
	{
		$query = $this->db->insert($tableName, $data);
		return $query ? true : false;
	}

	public function login($emailMobile, $password)
	{
		$this->db->or_where('email', $emailMobile);
		$this->db->or_where('mobile', $emailMobile);
		$this->db->where('password', $password);
		$this->db->where('status', 1);
		$this->db->where('is_activated', 1);
		$res = $this->db->get('customer_master');
		return $res->row_array() ? true : false;
	}
	    //Email Verify For Forget Password 
	  public function  Mail_verify($emailMobile)
	  {
	  	$this->db->or_where('email', $emailMobile);
		$this->db->or_where('mobile', $emailMobile);
		$this->db->where('status', 1);
		$this->db->where('is_activated', 1);
		$res = $this->db->get('customer_master');
		return $res->row_array() ? true : false;

	  }
	   //Otp Verify 
	    public function user_otp_verify($otp)
	    {
	    	$user_otp=$this->session->userdata('otp');
	    	if($otp==$user_otp)
	    	{
            return true;
	    	}	
	    }
            //update password
	    public function update_user_password($password)
	    {    
	    	$email=$this->session->userdata('email');   
$update_pass = $this->db->query("UPDATE customer_master set password='$password'  where mobile='$email' or email='$email'");
	      return true;	    
	    }


	public function getDataBySessionName($user)
	{
		$query = $this->db->select('*')
			->or_where('email', $user)
			->or_where('mobile', $user)
			->get('customer_master');
		//print_r($this->db->last_query());
		return $query->result();
	}


	// |||||||||||||||||||||||||||||||  Start fo the megaMenu  |||||||||||||||||||||||||||||||||||

	public function all_sub_catagory()
	{
		$query = $this->db->select("scat.id subCatId,scat.categoryId,scat.subCategoryName,scat.added_at,scat.status,scat.updated_at,cat.id as catId,cat.categoryName")
			->from("subcategory as scat")
			->join("category as cat", "scat.categoryId = cat.id", "inner")
			->get();
		// print_r($this->db->last_query());
		return $query->result();
	}

	public function type()
	{
		$query = $this->db->get('type');
		return $query->result();
	}

	public function Catagory_menu()
	{
		$query = $this->db->query("SELECT category.categoryName,category.typeId,category.categoryThumbnail, category.status as catStatus,category.added_at,category.id,type.typeName,type.status as typeStatus FROM category INNER JOIN type on category.typeId = type.id order by category.id desc");
		return $query->result();
	}



/*/////Stauts */
public function changeOrderStatusUser($orderId,$data)
    {
        $this->db->where('orderId', $orderId);
        //$this->db->update('ordered_items', $data2);
        $this->db->update('order_master', $data);
        return true;
    }
    public function changeOrderStatusUser2($orderId,$data)
    {
        $this->db->where('orderId', $orderId);
        $this->db->update('ordered_items', $data);
        //$this->db->update('order_master', $data);
        return true;
    }

	public function getAllOrders()
	{
		$customerId = $this->session->userdata('customerId');
		$query = $this->db->query('SELECT o.*,c.*,o.quantity as Iqty,c.id as pid,o.status as ostatus FROM  ordered_items o inner join product_details c on o.productId=c.id where orderId in (select orderId from order_master where customerId="'.$customerId.'" and (o.status="5" or o.status="6") ) group by orderId ');
		 //print_r($this->db->last_query());
		return $query->result();
	}

	public function getAllActiveOrders()
	{
		$customerId = $this->session->userdata('customerId');
		$query = $this->db->query('SELECT o.*,c.*,o.quantity as Iqty,c.id as pid,o.color,o.size FROM  ordered_items o inner join product_details c on o.productId=c.id where orderId in (select orderId from order_master where customerId="'.$customerId.'" and o.status!="5" and o.status="1" and o.status!="6") group by orderId ');
		// $query = $this->db->query('select * from order_master where customerId="'.$customerId.'" and satus!="5" and satus!="1"');
		// print_r($this->db->last_query());
		return $query->result();
	}

	// public function getAllActiveOrders(){
	// 	$customerId = $this->session->userdata('customerId');
	// 	$query = $this->db->query('SELECT o.*,c.*,o.quantity as Iqty,c.id as pid FROM  ordered_items o inner join product_details c on o.productId=c.id where orderId in (select orderId from order_master where customerId="'.$customerId.'" and satus!="1" ) group by orderId ');
	// 	// print_r($this->db->last_query());	
	// 	return $query->result();
	// }

	public function getOrderId(){
		$customerId = $this->session->userdata('customerId');
		$query = $this->db->query('SELECT * from order_master where customerId="'.$customerId.'" ');
		// $query = $this->db->query('SELECT o.*,c.*,o.quantity as Iqty,c.id as pid FROM  ordered_items o inner join product_details c on o.productId=c.id where orderId in (select orderId from order_master where customerId="'.$customerId.'" and satus!="1" ) group by orderId ');
		// print_r($this->db->last_query());	
		return $query->result_array();
	}

	public function getDataByOrderId($orderIds){
		$customerId = $this->session->userdata('customerId');
		// echo $orderIds;
		// echo "<pre>";
		// print_r(explode(" ",$orderIds));
		$query = $this->db->query('SELECT o.*,c.*,o.quantity as Iqty,c.id as pid FROM  ordered_items o inner join product_details c on o.productId=c.id where orderId in ("'.$orderIds.'")');
		print_r($this->db->last_query());	
		return $query->result_array();
	}
	public function all_ordered_products(){
		$customerId = $this->session->userdata('customerId');
		$query = $this->db->query('SELECT o.*,c.*,o.quantity as Iqty,c.id as pid FROM  ordered_items o inner join product_details c on o.productId=c.id inner join order_master ord   where ord.customerId="'.$customerId.'" group by pid ');
		// print_r($this->db->last_query());
		return $query->result();
	}

	#insert rating in the reviewtable
	function rating($rating_details,$id,$productId)
	{	
		// empty array for storing response
		$data = array();
		$this->db->where('userId',$id);
		$this->db->where('productId',$productId);
		$query= $this->db->get('productreview')->result();
		// print_r($this->db->last_query());
		// die;
		if($query)
		{
			$this->db->where('userId',$id);
			$this->db->where('productId',$productId);
			$this->db->update('productreview', $rating_details);
			return true;
			// $data["Response"] = "0";
			// echo json_encode($data);
			// return $data->true;
			// $this->session->set_flashdata('error_msg','Already Rated this product!');
			/*   echo "Already exit";*/
		}
		else
		{
		   return	$res = $this->db->insert('productreview',$rating_details);
			// if($res){
			// $data["Response"] = "1";
			// echo json_encode($data);
			// return $data;	
			// }
			
			
		}
		// echo json_encode($data);
	}


	public function getProductByInvoiceId($orderIds,$satus){
		$customerId = $this->session->userdata('customerId');
		$query = $this->db->select('c.id, c.customerName, c.mobile, c.email, c.profileImage, c.CustomerAddress, c.is_activated, b.id, b.orderId, b.total, b.subtotal, b.deliveryCharge, b.discount, b.shippingAddress as shipping_address, b.customerId, b.paymentMode, b.added_at, b.modified_at, b.satus,e.id,e.orderId,e.productId,e.price,e.quantity,e.size,e.brand,e.color,e.productImage,e.orderedOn,e.status,a.id, a.categoryId, a.subcategoryId, a.productCode, a.productName, a.strikePrice, a.price, a.mrp, a.quantity, a.discount, e.color, e.size, a.weight, a.brand, a.smallDiscription, a.features, a.productDescription, a.hotdeal, a.premium, a.inStock, a.latestCollection, a.thumbnail1, a.thumbnail2, a.thumbnail3, a.thumbnail4, a.added_at, a.updated_at, a.added_by, a.updated_by, a.status');
		$this->db->from('customer_master c');
		$this->db->join('order_master b ', '$customerId=c.id', 'inner');
		$this->db->join('ordered_items e','b.orderId=e.orderId','inner');
		$this->db->join('product_details a ','a.id=e.productId','inner');
		$this->db->where('customerId', $customerId);
		$this->db->where('b.satus', $satus);
		$this->db->where_in('b.orderId', $orderIds);
		// $this->db->group_by('b.orderId');
		$query = $this->db->get();
		// print_r($this->db->last_query());
		// die;
        return $query->result();
	}



	public function getProductByOrderId($orderIds){
		$customerId = $this->session->userdata('customerId');
		$query = $this->db->select('c.id, c.customerName, c.mobile, c.email, c.profileImage, c.CustomerAddress, c.is_activated, b.id, b.orderId, b.total, b.subtotal, b.deliveryCharge, b.discount, b.shippingAddress as shipping_address, b.customerId, b.paymentMode, b.added_at, b.modified_at, b.satus,e.id,e.orderId,e.productId,e.price,e.quantity,e.size,e.brand,e.color,e.productImage,e.orderedOn,e.status,a.id, a.categoryId, a.subcategoryId, a.productCode, a.productName, a.strikePrice, a.price, a.mrp, a.quantity, a.discount, a.color, a.size, a.weight, a.brand, a.smallDiscription, a.features, a.productDescription, a.hotdeal, a.premium, a.inStock, a.latestCollection, a.thumbnail1, a.thumbnail2, a.thumbnail3, a.thumbnail4, a.added_at, a.updated_at, a.added_by, a.updated_by, a.status');
		$this->db->from('customer_master c');
		$this->db->join('order_master b ', '$customerId=c.id', 'inner');
		$this->db->join('ordered_items e','b.orderId=e.orderId','inner');
		$this->db->join('product_details a ','a.id=e.productId','inner');
		$this->db->where('customerId', $customerId);
		$this->db->where_in('b.orderId', $orderIds);
		// $this->db->group_by('b.orderId');
		$query = $this->db->get();
		// print_r($this->db->last_query());
		// die;
        return $query->result();
	}



	// |||||||||||||||||||||||||||||||   change password  |||||||||||||||||||||||||||||||||||
	public function fetch_pass($session_id, $old_pass)
	{
		$query = $this->db->query("select * from customer_master where id='$session_id' && password='$old_pass'");
		return $query->row_array();
	}

	public function change_pass($session_id, $new_pass)
	{
		$update_pass = $this->db->query("UPDATE customer_master set password='$new_pass'  where id='$session_id'");
	}


	public function getUserInformation($customerId)
	{
		$query = $this->db->select('*');
		$query = $this->db->where('id', $customerId);
		$query = $this->db->get('customer_master');
		// print_r($this->db->last_query());
		return $query->result();
	}

	public function updateUserProfile($data, $customerId)
	{
		$this->db->where('id', $customerId);
		$this->db->update('customer_master', $data);
		return true;
	}
          //Conatct us 
	public function contactus($data, $tableName)
	{
       $query = $this->db->insert($tableName, $data);
		return $query ? true : false;
	}

}