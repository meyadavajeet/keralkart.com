<?php

defined('BASEPATH') or exit('No direct script access allowed');

class WelcomeModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct(); // call parent constructor
        $this->load->database(); //this is the for load database
        $this->load->helper('form'); // this is for load of form helper
    }

    // ||||||||||||||||||||||||| General Section |||||||||||||||||||||||||

    public function selectModelInArraybyId($tableName,$id){
        $this->db->select('*');
        $this->db->from($tableName);
        $this->db->where('id',$id);
        $query = $this->db->get();
        // print_r($this->db->last_query());
        return $query->row_array();

    }

                // Contact us list
                    public function getAllDropMessage()
                    {
                    $res=$this->db->get('contact_us');
                    return $res->result();
                    
                    }

    // |||||||||||||||||||||||||||||| Type Section ||||||||||||||||||||||||||||||||||

    public function is_type_available($data)
    {
        $this->db->where('typeName', $data);
        $query = $this->db->get("type");
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function insertModel($data, $tableName)
    {
        $query = $this->db->insert($tableName, $data);
        return $query ? true : false;
    }

    public function typeCreate($data)
    {
        $query = $this->db->insert('type', $data);
        return $query ? true : false;
    }

    public function typeList()
    {
        // $query =$this->db->where('status','!null');
        // $query = $this->db->order_by('id', 'desc');
        $query = $this->db->get('type');
        return $query->result();
    }

    public function checkTypeStatus($id)
    {
        $query = $this->db->select('status')
            ->where('id', $id)
            ->get('type');
        return $query->result();
    }

    public function typeUpdate($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('type', $data);
        return true;
    }

    public function typeDelete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('type');
        return true;
    }

    // |||||||||||||||||||||||||||||||   change password  |||||||||||||||||||||||||||||||||||
  public function fetch_pass($session_id, $old_pass)
    {
        $query = $this->db->query("select * from adminlogin where username='$session_id' && epassword='$old_pass'");
        return $query->row_array();
    }

    public function change_pass($session_id, $new_pass,$new_pass_n)
    {
        $update_pass = $this->db->query("UPDATE adminlogin set ePassword='$new_pass',nPassword='$new_pass_n'  where username='$session_id'");
    }


    //    ||||||||||||||||||||||||||  Category Section ||||||||||||||||||||||||||||||||||||||||
    public function categoryCreate($data)
    {
        $this->db->insert('category', $data);
        return true;
    }

    public function categoryList()
    {
        // $this->db->select('*');
        //  $query = $this->db->get('category');
        //  return $query->result();
        $query = $this->db->query("SELECT category.categoryName,category.typeId,category.categoryThumbnail, category.status as catStatus,category.added_at,category.id,type.typeName,type.status as typeStatus FROM category INNER JOIN type on category.typeId = type.id order by category.id desc");
        return $query->result();
    }

    public function categoryUpdate($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('category', $data);
        return true;
    }

    public function checkStatus($id)
    {
        $query = $this->db->select('status');
        $query = $this->db->where('id', $id);
        $query = $this->db->get('category');
        return $query->result();
    }

    public function typeListData()
    {
        $query = $this->db->where('status', 1);
        $query = $this->db->get('type');
        return $query->result();
    }

    public function categoryStatusUpdate($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('category', $data);
        return true;
        // print_r($this->db->last_query());
    }

    public function CategoryListData()
    {
        $query = $this->db->select('cat.id as id,cat.categoryName as categoryName,cat.typeId typeId, t.id as tid, t.typeName as typeName')
            ->from('category as cat')
            ->join('type as t','cat.typeId = t.id','right')
            ->where('cat.status', 1)
            ->where('t.status',1)
            ->get();
            // print_r($this->db->last_query());
            // die;
        return $query->result();
    }

    //    |||||||||||||||||||||||||||||||| SubCategory  Section |||||||||||||||||||||||||||||
    public function subCategoryList()
    {
        $query = $this->db->select("scat.id subCatId,scat.categoryId,scat.subCategoryName,scat.added_at,scat.status,scat.updated_at,cat.id as catId,cat.categoryName")
            ->from("subcategory as scat")
            ->join("category as cat", "scat.categoryId = cat.id", "inner")
            ->get();
        // print_r($this->db->last_query());
        return $query->result();
    }

    public function subCategoryCreate($data)
    {
        $this->db->insert('subcategory', $data);
        return true;
    }

    public function checkCategoryStatus($id)
    {
        $query = $this->db->select('status');
        $query = $this->db->where('id', $id);
        $query = $this->db->get('subcategory');
        return $query->result();
    }

    public function subCategoryStatusUpdate($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('subcategory', $data);
        return true;
    }

    // ||||||||||||||||||||||||||Notification Section ||||||||||||||||||||||

    public function notificationCreate($data)
    {
        $this->db->insert('notification', $data);
        return true;
    }

    public function notificationList()
    {
        $query = $this->db->select('*')
            ->from('notification')
            ->get();
        return $query->result();
    }

    public function checkNotificationStatus($id)
    {
        $query = $this->db->select('status')
            ->from('notification')
            ->where('id', $id)
            ->get();
        return $query->result();
    }

    public function notificationUpdate($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('notification', $data);
        return true;
    }

    public function notificationDelete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('notification');
        return true;
    }

    //    ||||||||||||||||||||||||||||||||||||| Administration Section |||||||||||||||||||||||||||||
    public function administrationCreate()
    {
        $data = array(
            'username' => $this->input->post('username'),
            'email' => $this->input->post('email'),
            'ePassword' => md5($this->input->post('ePassword')),
            'added_at' => date('Y-m-d H:i:s'),
            'role' => '1',
            'status' => '1',
        );
        $this->db->insert('adminlogin', $data);
        return true;
    }

    public function is_admin_email_available($email)
    {
        $this->db->where('email', $email);
        $query = $this->db->get("adminlogin");
        // return $this->db->last_query();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function is_admin_username_available($username)
    {
        $this->db->where('username', $username);
        $query = $this->db->get("adminlogin");
        // return $this->db->last_query();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function administrationList()
    {
        $query = $this->db->select('id,username,email,status,role,added_at')
            ->from('adminlogin')
            ->get();
        return $query->result();
    }

    public function checkAdministrationStatus($id)
    {
        $query = $this->db->select('status')
            ->from('adminlogin')
            ->where('id', $id)
            ->get();
        return $query->result();
    }

    public function administrationStatusUpdate($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('adminlogin', $data);
        return true;
    }

    //    |||||||||||||||||||||||||||||||| Coupon Section |||||||||||||||||||||||||||||
    public function couponCreate()
    {
        $data = array(
            'couponCode' => $this->input->post('code'),
            'amount' => $this->input->post('amount'),
            'usageLimit' => $this->input->post('usageLimit'),
            'validFromDate' => ($this->input->post('validFromDate')),
            'validToDate' => ($this->input->post('validToDate')),
            'added_at' => date('Y-m-d H:i:s'),
            'status' => '1',
        );
        $this->db->insert('coupondetail', $data);
        return true;
    }

    public function couponList()
    {
        $query = $this->db->select('id,couponCode,amount,usageLimit,validFromDate,validToDate,added_at,status')
            ->from('coupondetail')
            ->get();
        return $query->result();
    }

    public function checkCouponstatus($id)
    {
        $query = $this->db->select('status')
            ->from('coupondetail')
            ->where('id', $id)
            ->get();
        return $query->result();
    }

    public function couponStatusUpdate($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('coupondetail', $data);
        return true;
    }

    public function couponDelete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('coupondetail');
        return true;
    }

    // |||||||||||||||||||||||||||||| Brand Section ||||||||||||||||||||||||||||||||||||
    public function brandList()
    {
        $query = $this->db->select('id,brandName,added_at,status')
            ->from('brand')
            ->get();
        return $query->result();
    }

    public function is_brand_available($data)
    {
        $this->db->where('brandName', $data);
        $query = $this->db->get("brand");
        // return $this->db->last_query();
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function brandCreate()
    {
        $data = array(
            'brandName' => $this->input->post('brandName'),
            'added_at' => date('Y-m-d H:i:s'),
            'status' => '1',
        );
        $this->db->insert('brand', $data);
        return true;
    }

    public function checkBrandStatus($id)
    {
        $query = $this->db->select('status')
            ->where('id', $id)
            ->get('brand');
        return $query->result();
    }

    public function brandUpdate($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('brand', $data);
        return true;
        // print_r($this->db->last_query());
    }

    public function brandDelete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('brand');
        return true;
    }



    //   |||||||||||||||||||||||||||||||||||| Product Section |||||||||||||||||||||||||||||||||

    public function productList()
    {
        // $query = $this->db->select('*')
        //     ->from('product_details')
        //     ->get();
        // return $query->result();
        $this->db->select('a.id, a.categoryId, a.subcategoryId, a.productCode, a.productName, a.strikePrice, a.price, a.mrp, a.quantity, a.discount, a.color, a.size, a.weight, a.brand, a.smallDiscription, a.features, a.productDescription, a.hotdeal, a.premium, a.inStock, a.latestCollection, a.thumbnail1, a.thumbnail2, a.thumbnail3, a.thumbnail4, a.added_at, a.updated_at, a.added_by, a.updated_by, a.status as prd_status,b.id as catId, b.typeId, b.categoryName, b.categoryThumbnail, b.status, b.added_at, b.updated_at,c.id as subCatId, c.categoryId, c.subCategoryName, c.added_at, c.updated_at, c.status as cat_status, br.id as brid,br.brandName as brName,br.status as brStatus');
        $this->db->from('product_details a');
        $this->db->join('category b', 'b.id=a.categoryId', 'left');
        $this->db->join('subcategory c', 'c.id=a.subcategoryId', 'left');
        $this->db->join('brand br','br.id=a.brand','left');
        $query = $this->db->get();
        return $query->result();
    }
    public function subCategoryListActive()
    {
        $query = $this->db->select("id,subCategoryName")
            ->from("subcategory")
            ->where('status', '1')
            ->get();
        // print_r($this->db->last_query());
        return $query->result();
    }
    public function getProductDetailById($id)
    {
        $this->db->select('a.id, a.categoryId as catID, a.subcategoryId, a.productCode, a.productName, a.strikePrice, a.price, a.mrp, a.quantity, a.discount, a.color, a.size, a.weight, a.brand, a.smallDiscription, a.features, a.productDescription, a.hotdeal, a.premium, a.inStock, a.latestCollection, a.thumbnail1, a.thumbnail2, a.thumbnail3, a.thumbnail4, a.added_at, a.updated_at, a.added_by, a.updated_by, a.status,b.id as catId, b.typeId, b.categoryName, b.categoryThumbnail, b.status, b.added_at, b.updated_at,c.id as subCatId, c.categoryId, c.subCategoryName, c.added_at, c.updated_at, c.status,br.id as brid,br.brandName as brName,br.status as brStatus');
        $this->db->from('product_details a');
        $this->db->join('category b', 'b.id=a.categoryId', 'left');
        $this->db->join('subcategory c', 'c.id=a.subcategoryId', 'left');
        $this->db->join('brand br','br.id=a.brand','left');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        return $query->result();


        // $query = $this->db->select('*')
        //         ->where('id', $id)
        //         ->get('product_details');
        // return $query->result();

        //     $query = $this->db->select("scat.id as subCatId,scat.categoryId,scat.subCategoryName,scat.added_at,scat.status,scat.updated_at,cat.id as catId,cat.categoryName,p.id, p.categoryId, p.subcategoryId, p.productCode, p.productName, p.strikePrice, p.price, p.mrp, p.quantity, p.discount, p.color, p.size, p.weight, p.brand, p.smallDiscription, p.features, p.productDescription, p.hotdeal, p.premium, p.inStock, p.latestCollection, p.thumbnail1, p.thumbnail2, p.thumbnail3, p.thumbnail4, p.added_at, p.updated_at, p.added_by, p.updated_by, p.status")
        //         ->from("category as cat")
        //         ->join("product_details as p", "p.categoryId = cat.id", "inner")
        //         ->join("subcategory as scat  ", "scat.id = p.subcategoryId", "inner")
        //         ->where('p.id', $id)
        //         ->get();
        //     //  print_r($this->db->last_query());
        //     foreach($query->result() as $row):
        //     if($row->subCatId=="" && $row->catID==""){
        //         $query = $this->db->select("p.id, p.categoryId, p.subcategoryId, p.productCode, p.productName, p.strikePrice, p.price, p.mrp, p.quantity, p.discount, p.color, p.size, p.weight, p.brand, p.smallDiscription, p.features, p.productDescription, p.hotdeal, p.premium, p.inStock, p.latestCollection, p.thumbnail1, p.thumbnail2, p.thumbnail3, p.thumbnail4, p.added_at, p.updated_at, p.added_by, p.updated_by, p.status")
        //         ->from("product_details as p")
        //         ->where('p.id', $id)
        //         ->get();
        //         print_r($this->db->last_query());
        //     return $query->result();
        //     }
        //     if($row->subCatId=="" || $row->catId!="" ){
        //         $query = $this->db->select("cat.id as catId,cat.categoryName,p.id, p.categoryId, p.subcategoryId, p.productCode, p.productName, p.strikePrice, p.price, p.mrp, p.quantity, p.discount, p.color, p.size, p.weight, p.brand, p.smallDiscription, p.features, p.productDescription, p.hotdeal, p.premium, p.inStock, p.latestCollection, p.thumbnail1, p.thumbnail2, p.thumbnail3, p.thumbnail4, p.added_at, p.updated_at, p.added_by, p.updated_by, p.status")
        //         ->from("product_details as p")
        //         ->join("category as cat", "p.categoryId = cat.id", "inner")
        //         ->where('p.id', $id)
        //         ->get();
        //         print_r($this->db->last_query());
        //     return $query->result();
        //     }
        //     if($row->subCatId!="" || $row->catID=="" ){
        //         $query = $this->db->select("scat.id as subCatId,scat.categoryId,scat.subCategoryName,scat.added_at,scat.status,scat.updated_at,p.id, p.categoryId, p.subcategoryId, p.productCode, p.productName, p.strikePrice, p.price, p.mrp, p.quantity, p.discount, p.color, p.size, p.weight, p.brand, p.smallDiscription, p.features, p.productDescription, p.hotdeal, p.premium, p.inStock, p.latestCollection, p.thumbnail1, p.thumbnail2, p.thumbnail3, p.thumbnail4, p.added_at, p.updated_at, p.added_by, p.updated_by, p.status")
        //         ->from("product_details as p")
        //         ->join("subcategory as scat  ", "scat.id = p.subcategoryId", "inner")
        //         ->where('p.id', $id)
        //         ->get();
        //         print_r($this->db->last_query());
        //         return $query->result();
        //     }
        //     // print_r($this->db->last_query());
        //     // return $query->result();
        // endforeach;

    }

    public function fetch_subcategory($categoryId)
    {
        $this->db->where('categoryId', $categoryId);
        $this->db->where('status', '1');
        //        $this->db->order_by('sucategoryName', 'ASC');
        $query = $this->db->get('subcategory');
        $output = '<option value="0">----Select SubCategory------</option>';
        foreach ($query->result() as $row) {
            $output .= '<option value="' . $row->id . '">' . $row->subCategoryName . '</option>';
        }
        return $output;
    }

    public function checkProductStatus($id)
    {
        $query = $this->db->select('status')
            ->where('id', $id)
            ->get('product_details');
        return $query->result();
    }
    public function productUpdate($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('product_details', $data);
        return true;
        // print_r($this->db->last_query());
    }
    public function productDelete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('product_details');
        return true;
    }

    public function productOnlyList()
    {
        $this->db->order_by('id','desc');
        $query = $this->db->get('product_details');

        return $query->result();
    }

    // |||||||||||||||||||||| Stock Section ||||||||||||||||||||||||

    public function stockList()
    {
        //      $query = $this->db->select("*")
        //         ->from("stock")
        //         ->get();
        //     return $query->result();
        //

        $query = $this->db->select('s.id as id, s.productCode as productCode , s.brand as brand, s.color as color, s.size as size, s.stockPrice as stockPrice, s.quantity as quantity, s.added_at as added_at, s.updated_at as updated_at, s.status as status, b.id as b_id, b.brandName as b_name, b.status as b_status')
            ->from('stock s')
            ->join('brand b', 'b.id=s.brand', 'left')
            ->get();
        // print_r($this->db->last_query());
        return $query->result();
    }
    public function available_stock()
    {

        // $query =$this->db->select_sum('quantity');
        //       $this->db->select('s.id as id, s.productCode as productCode , s.brand as brand, s.color as color, s.size as size, s.stockPrice as stockPrice, s.quantity as quantity, s.added_at as added_at, s.updated_at as updated_at, s.status as status, b.id as b_id, b.brandName as b_name, b.status as b_status')
        //     ->from('stock s')
        //     ->join('brand b', 'b.id=s.brand', 'left')
        //     ->group_by(array('s.productCode','s.brand','s.color','s.size'))
        //     ->having('s.status',1)
        //     ->get();
            // print_r($this->db->last_query());
            // die;
            $query1 = $this->db->select(' sum(quantity) as qty, s.id as id, s.productCode as productCode , s.brand as brand, s.color as color, s.size as size, s.stockPrice as stockPrice, s.quantity as quantity, s.added_at as added_at, s.updated_at as updated_at, s.status as status, b.id as b_id, b.brandName as b_name, b.status as b_status')
                ->from('stock s')
                ->join('brand b', 'b.id=s.brand', 'left')
                ->group_by(array('s.productCode','s.brand','s.color','s.size'))
                //->having('s.status',2)
                ->get();
            // print_r($this->db->last_query());
            // die;
        return $query1->result();
    }

    public function checkStockStatus($id)
    {
        $query = $this->db->select('status')
            ->where('id', $id)
            ->get('stock');
        return $query->result();
    }

    public function stockUpdate($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('stock', $data);
        return true;
        // print_r($this->db->last_query());
    }

    public function brandListData()
    {
        $query = $this->db->select('b.id as b_id, b.brandName as b_name, b.status as b_status')
            ->from('brand b')
            ->where('b.status', '1')
            ->get();
        // print_r($this->db->last_query());
        return $query->result();
    }

    // ||||||||||||||||||||||||| Customer Section ||||||||||||||||||||||||||

    public function customerList()
    {
        $query = $this->db->select('*')
            ->from('customer_master')
            ->get();
        return $query->result();
    }

    public function checkCustomerStatus($id)
    {
        # checkCustomer Status
        $query = $this->db->select('status')
            ->where('id', $id)
            ->get('customer_master');
        return $query->result();
    }

    public function customerUpdate($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('customer_master', $data);
        return true;
    }


    //get productcode
    public function fetch_productCode($categoryId)
    {
        $this->db->where('id', $categoryId);
        
        $query = $this->db->get('product_details');
        
        foreach ($query->result() as $row) {
             $output = $row->productCode;
        }
        //print_r($this->db->last_query());
        return $output;
    }

    // ||||||||||||||||||||| Reporting Section |||||||||||||||||||||||||||||

    // public function getAllSales()
    // {
    //     $query = $this->db->select('*')
    //         ->from('stockreport')
    //         ->get();
    //     return $query->result();
    // }

    public function getAllStock()
    {

        $query = $this->db->select('*')
            ->from('stockreport')
            ->get();
        return $query->result();
    }



    #getActiveOrders

    public function getActiveOrders()
    {

  /*      $this->db->select('*');
        // $this->db->distinct();
        $this->db->from('order_master');
        $this->db->group_by('orderId');
        $this->db->order_by('id','desc');
        $query = $this->db-get();
        return $query->result();*/

        // $query = $this->db->select('*')
        //     ->from('ordered_items')
        //     ->group_by('orderId')
        //     ->order_by('id','desc')
        //     ->where('status',1)
        //     ->get();
        // return $query->result();


         $query = $this->db->select('c.id as id, c.customerName as customerName, c.mobile as mobile, c.email as email,c.added_at as added_at,o.orderId as orderId, o.id as oid, o. total, o. subtotal, o. deliveryCharge, o. discount, o. shippingAddress, o. customerId, o. paymentMode, o. added_at, o. satus')
            ->from('order_master as o')
            ->join('customer_master as c','c.id = o.customerId','inner')
            ->group_by('orderId')
            ->order_by('o.added_at','desc')
            
            ->get();
            // print_r($this->db->last_query());
            // die;
        return $query->result();
    }


    public function changeOrderStatus($orderId,$data,$data2)
    {
        $this->db->where('orderId', $orderId);
        $this->db->update('order_master', $data);
        $this->db->update('ordered_items', $data2);
        return true;
    }

    public function getAllOrders()
    {
          $query = $this->db->select('c.id as id, c.customerName as customerName, c.mobile as mobile, c.email as email,c.added_at as added_at,o.orderId as orderId, o. total, o. subtotal, o. deliveryCharge, o. discount, o. shippingAddress, o. customerId, o. paymentMode, o. added_at, o. satus')
            ->from('order_master as o')
            ->join('customer_master as c','c.id = o.customerId','inner')
            ->group_by('orderId')
            // ->where('o.satus !=', 5)
            ->get();
            // print_r($this->db->last_query());
            // die;
        return $query->result();
    }

    public function getStockByDate()
    {
        $fromDate = $this->input->post('fromDate');
        $toDate = $this->input->post('toDate');
        $stockType = $this->input->post('stockType');
        $this->db->where('status', $stockType);
        $this->db->where('added_at >=', $fromDate);
        $this->db->where('added_at <=', $toDate);
        $query = $this->db->get('stock');
        // print_r($this->db->last_query());
        // die();
        return $query->result();

    }

    #get orders report by within the daterange
    public function getOrdersByDate()
    {
        $fromDate = $this->input->post('fromDate');
        $toDate = $this->input->post('toDate');
        // $orderStatus = $this->input->post('orderStatus');


        $query = $this->db->select('c.id as id, c.customerName as customerName, c.mobile as mobile, c.email as email,c.added_at as added_at,o.orderId as orderId, o. total, o. subtotal, o. deliveryCharge, o. discount, o. shippingAddress, o. customerId, o. paymentMode, o.added_at, o. satus')
            ->from('order_master as o')
            ->join('customer_master as c','c.id = o.customerId','inner')
            ->group_by('orderId')
            ->where('o.satus ', 5)
            ->where('o.added_at >=', $fromDate)
            ->where('o.added_at <=', $toDate)
            ->get();
            // print_r($this->db->last_query());
            // die;
        return $query->result();
    }
    public function getAllSales()
    {
       $query = $this->db->query("SELECT  o.orderId, o.productId, o.price as itemPrice, o.quantity as itemQuantity, o.size as itemSize, o.brand, o.color as itemColor, o.productImage, o.orderedOn,c.*,b.* FROM  ordered_items o inner join product_details c on o.productId=c.id inner join brand b on  o.brand = b.id  where orderId in( select orderId from order_master a where  a.satus='5')" );
       return $query->result();
    }

    #get sales within a daterange

    public function getsalesByDate()
    {
       $fromDate = $this->input->post('fromDate');
        $toDate = $this->input->post('toDate');

        $query = $this->db->query("SELECT  o.orderId, o.productId, o.price as itemPrice, o.quantity as itemQuantity, o.size as itemSize, o.brand, o.color as itemColor, o.productImage, o.orderedOn,c.*,b.* FROM  ordered_items o inner join product_details c on o.productId=c.id inner join brand b on  o.brand = b.id  where orderId in( select orderId from order_master a   where a.added_at between
          CAST('".$fromDate."' AS DATE)   AND CAST('".$toDate."' AS DATE) and   a.satus='5' )" );
        // print_r($query);

        // print_r($this->db->last_query());
        // die();
       return $query->result();
    }

    public function getAllPayments()
    {
        $query = $this->db->query("SELECT p.* FROM paymentdetail p INNER JOIN customer_master on  p.customerId = customer_master.id");
        return $query->result();
    }

    #get PaymentbyDate
    public function getPaymentsByDate()
    {
        $fromDate = $this->input->post('fromDate');
        $toDate = $this->input->post('toDate');

        $query = $this->db->query("SELECT a.*,b.* FROM paymentdetail a INNER JOIN customer_master b ON a.customerId = b.id where a.added_at  between  CAST('".$fromDate."' AS DATE)   AND CAST('".$toDate."' AS DATE)");
        return $query->result();
    }

    public function getSalesAmount()
    {
        $query = $this->db->select("sum(total) as tAmount")
                        ->get('order_master');

        return $query->result();
    }

//    ||||||||||||||||||||||||||  Subscriber Section |||||||||||||||||

    public  function getAllSubscriber(){
        $query = $this->db->select("*")
            ->get(' tbl_subscribed_email');
        return $query->result();
    }
    public function checkSubscriberStatus($id)
    {
        $query = $this->db->select('status');
        $query = $this->db->where('id', $id);
        $query = $this->db->get('tbl_subscribed_email');
        return $query->result();
    }

    public function subscriberStatusUpdate($data, $id)
    {
        $this->db->where('id', $id);
        $this->db->update('tbl_subscribed_email', $data);
        return true;
    }

    public function subscriberDelete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tbl_subscribed_email');
        return true;
    }

}

//end of main class
