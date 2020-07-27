<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ProductModel extends CI_Model {

	function __construct() {
		parent::__construct();
		$this->load->database();

	}

	#column_name or`*` ,#table_name, limit
	public function getData($getColumn, $tblName, $start, $limit) {
		$this->db->select($getColumn);
		$this->db->limit($limit, $start);
		$this->db->where('status', '1');
		$query = $this->db->get($tblName);
		$row = $query->result();
		//$row['price'];
		return $row;
		//print_r($this->db->last_query());
	}
	
	
	             
	             
	///Get Product From proid or coolor
	     public function fetch_details_by_color($color,$id){
         $query = $this->db->query("select size,sellingPrice,stockPrice from  stock where color='$color' and productID ='$id' and status='1'");
		return $query->result();
	     }


           	public function getData_price($getColumn, $tblName, $where, $id,$size,$color) {

		$this->db->select($getColumn);
		$this->db->where($where, $id);
		$this->db->where('color',$color);
	    $this->db->where('size',$size);
		$query = $this->db->get($tblName);
		$row = $query->row_array();
		return $row;

	}
	public function whereInData($id) {

		//$this->db->select($getColumn);
		$this->db->where_in('categoryId', $id);
		//$this->db->group_by('categoryId');
		$this->db->order_by('categoryId', 'desc');
		$query = $this->db->get('product_details');

		//print_r($this->db->last_query());
		$row = $query->result();

		return $row;
	}
	public function stockUpdate($data, $id, $table,$where)
    {
        $this->db->where($where, $id);
        $this->db->update($table, $data);
        return true;
        // print_r($this->db->last_query());
    }
	public function getProducts() {
		$this->db->select('a.id, a.categoryId, a.subcategoryId, a.productCode, a.productName, a.strikePrice, a.price, a.mrp, a.quantity, a.discount, a.color, a.size, a.weight, a.brand, a.smallDiscription, a.features, a.productDescription, a.hotdeal, a.premium, a.inStock, a.latestCollection, a.thumbnail1, a.thumbnail2, a.thumbnail3, a.thumbnail4, a.added_at, a.updated_at, a.added_by, a.updated_by, a.status,b.id as catId, b.typeId, b.categoryName, b.categoryThumbnail, b.status, b.added_at, b.updated_at,c.id as subCatId, c.categoryId, c.subCategoryName, c.added_at, c.updated_at, c.status,d.typeName');
		$this->db->from('product_details a');
		$this->db->join('category b', 'b.id=a.categoryId', 'left');
		$this->db->join('subcategory c', 'c.id=a.subcategoryId', 'left');
		$this->db->join('type d', 'd.id=a.categoryId', 'left');
		$this->db->group_by('a.categoryId');
		$query = $this->db->get();
		return $query->result();
	}
	public function getSpecificData($getColumn, $tblName, $where, $id, $start, $limit) {
		$this->db->select($getColumn);
		$this->db->order_by('id','desc');
		//$this->db->limit($limit,$start);
		$this->db->where_in($where, $id);
		$this->db->where('status', '1');
		$query = $this->db->get($tblName);

		$row = $query->result();
		//print_r($this->db->last_query());
		//$row['price'];
		return $row;

	}

	public function getSpecificDataAll($getColumn, $tblName, $where, $id) {
		//$id;
		$this->db->select($getColumn);
		//$this->db->limit($limit,$start);
		$this->db->where($where, $id);
		$this->db->where('status', '1');
		$query = $this->db->get($tblName);

		$row = $query->result();
		// print_r($this->db->last_query());
		// die;
		//$row['price'];
		return $row;

	}

	public function getOneData($getColumn, $tblName, $where, $id) {
		$this->db->select($getColumn);
		$this->db->where($where, $id);
		//$this->db->where('status','1');
		$query = $this->db->get($tblName);
// 		print_r($this->db->last_query());
// 		die();
		$row = $query->row_array();
		//$row['price'];
		return $row;
	}

	public function whereIN($id) {

		//$this->db->select($getColumn);
		$this->db->where_in('id', $id);
		$query = $this->db->get('product_details');
		//print_r($this->db->last_query());
		$row = $query->result();

		return $row;
	}

	public function allProducts() {
		$query = $this->db->get('product_details');
		return $query->result();
	}
	public function allProductsandStock() {
		$this->db->order_by('id', 'desc');
		$query = $this->db->get('product_details');
		//print_r($this->db->last_query());
		return $query->result();
	}

	public function singleProducts($product) {
		$this->db->select('*');
		$this->db->from('product_details a');
		$this->db->join('category b', 'b.id=a.categoryId', 'left');
		$this->db->join('subcategory c', 'c.id=a.subcategoryId', 'left');
		$this->db->join('stock s', 's.productID=a.id', 'left');
		$this->db->join('brand br','a.brand=br.id','left');
		$this->db->where('a.slug', $product);
	
		$query = $this->db->get();
		// 	print_r($this->db->last_query().'This is the demo');
		// die();
		return $query->result();
	}

	public function singleProductArray($product) {
		// $this->db->select('*');
		$this->db->select('a.id, a.categoryId, a.subcategoryId, a.productCode, a.productName, a.strikePrice, a.price, a.mrp, a.quantity, a.discount, a.color, a.size, a.weight, a.brand, a.smallDiscription, a.features, a.productDescription, a.hotdeal, a.premium, a.inStock, a.latestCollection, a.thumbnail1, a.thumbnail2, a.thumbnail3, a.thumbnail4, a.added_at, a.updated_at, a.added_by, a.updated_by, a.status,b.id as catId, b.typeId, b.categoryName, b.categoryThumbnail, b.status, b.added_at, b.updated_at,c.id as subCatId, c.categoryId, c.subCategoryName, c.added_at, c.updated_at, c.status,br.id as brid,br.brandName as brName,br.status as brStatus');
        $this->db->from('product_details a');
		$this->db->join('category b', 'b.id=a.categoryId', 'left');
		$this->db->join('subcategory c', 'c.id=a.subcategoryId', 'left');
		$this->db->join('brand br','br.id=a.brand','left');
		$this->db->where('a.slug', $product);
		$query = $this->db->get();
		// print_r($this->db->last_query());
		// die();
		return $query->row_array();
	}
	
	public function getProductbyProductId($productCode)
	{
		$this->db->distinct();
		$this->db->select('d.color as stockColor,d.brand as stockBrand,d.size as stockSize,br.brandName as productBrandName,d.productCode as stockProductCode, d.sellingPrice as sellingPrices, d.stockPrice');
		
		$this->db->from('product_details a');
		// $this->db->join('category b', 'b.id=a.categoryId', 'left');
		// $this->db->join('subcategory c', 'c.id=a.subcategoryId', 'left');
		$this->db->join('stock d', 'd.productID=a.id', 'inner');
		$this->db->join('brand br', 'a.brand=br.id', 'left');
		$this->db->where('a.productCode', $productCode);
		$query = $this->db->get();
		// print_r($this->db->last_query());
		// die();
		return $query->result();

	}

	
	public function getProductByCategoryId($productCategory)
	{
//		$this->db->select('d.color as stockColor,d.brand as stockBrand,d.size as stockSize,br.brandName as productBrandName,d.productCode as stockProductCode');
		$this->db->select('*');
		$this->db->distinct();
		$this->db->from('product_details');
		// $this->db->join('category b', 'b.id=a.categoryId', 'left');
		// $this->db->join('subcategory c', 'c.id=a.subcategoryId', 'left');
		// $this->db->or_where('hotdeal','1');
		// $this->db->or_where('premium','1');
		// $this->db->or_where('latestCollection','1');
		$whereCon=['hotdeal ='=> 1, 'premium ='=> 1,'latestCollection =' => 1];
		
		$this->db->where("(hotdeal='1' OR premium='1' OR latestCollection='1')", NULL, FALSE);
		$this->db->limit(12, 1);
		$this->db->where('categoryId', $productCategory);
		$query = $this->db->get();
	// print_r($this->db->last_query());
//		 die();
		return $query->result();

	}
	//order confirm
	public function insertOrder($data, $tableName) {
		$query = $this->db->insert($tableName, $data);
		return $query ? true : false;
	}

	// ||||||||||||||||||| MEGA MENU SECTION ||||||||||||||||||



	

    public function type()
    {  
        $query = $this->db->select("*")
                    ->from('type')
                    ->where('status','1')
                    ->get();
        return $query->result();
	}
	
	public function type_array(){
		       $query = $this->db->select("*")
                    ->from('type')
                    ->where('status','1')
                    ->get();
        return $query;
	}

    public function Catagory_menu()
    {
         $query = $this->db->query("select category.categoryName,category.typeId,category.categoryThumbnail, category.status as catStatus,category.added_at,category.id,type.typeName,type.status as typeStatus FROM category INNER JOIN type on category.typeId = type.id order by category.id asc");
        return $query->result();
	}
    public function getAllCategoryMenuTypeId($type_ids)
    {	
		 $type_ids =  implode(",",$type_ids);

		// $type_idss=array_map('strval', explode(',', $type_ids));
		// $type_idsss = implode("','",$type_idss);
		
		$query = $this->db->query("select category.categoryName,category.typeId,category.categoryThumbnail, category.url_slug,category.status as catStatus,category.added_at,category.id,type.typeName,type.status as typeStatus FROM category INNER JOIN type on category.typeId = type.id where type.id in($type_ids) AND category.status='1' order by category.id desc ");
		 //print_r($this->db->last_query());	
		return $query->result();
	}
	
    public function all_sub_catagory()
    {
         $query = $this->db->select("scat.id subCatId, scat.url_slug,scat.categoryId,scat.subCategoryName,scat.added_at,scat.status,scat.updated_at,cat.id as catId,cat.categoryName")
			->from("subcategory as scat")
			->join("category as cat", "scat.categoryId = cat.id", "inner")	
            ->get();
		// print_r($this->db->last_query());
		// exit;
        return $query->result();
	}
    public function all_sub_categories($categoryId)
    {
         $query = $this->db->select("scat.id subCatId,scat.url_slug,scat.categoryId,scat.subCategoryName,scat.added_at,scat.status,scat.updated_at,cat.id as catId,cat.categoryName")
			->from("subcategory as scat")
			->join("category as cat", "scat.categoryId = cat.id", "inner")	
			->where_in('categoryId', $categoryId)
			->where('scat.status', '1')
            ->get();
		 //print_r($this->db->last_query());
		// exit;
        return $query->result();
	}


    // for the product search
    public function GetCatSearchName($search_name){
    $qry = $this->db->select('*')
    				->from('product_details')
                    ->where("productName LIKE '%$search_name%'")
                    ->get()->result(); // select data like rearch value.
    return $qry;
	} 
	public function GetSearchName($search_name){
    $qry = $this->db->select('*')
    				->from('product_details')
                    ->or_where("productName LIKE '%$search_name%'")
                    ->get()->result(); // select data like rearch value.
    return $qry;
	}

	public function getCategoryIDByProductName($productName){
		$qry = $this->db->select('categoryId')
				->from('product_details')
				->where("productName LIKE '%$productName%'")
				->get(); 
		return $qry->result();
	}

	function getCategoryNameByCategoryId($caID){
		$this->db->select('categoryName');
		$this->db->from('category');
		$this->db->where('id',$caID);
		$query = $this->db->get();
		// print_r($this->db->last_query());
		// die;
		return $query->result();
	}


	public function checkAvaiablityOfProduct($tableName,$productCode,$color,$size)
	{
		$getData = $this->db->select('*,sum(quantity) as qty')
                    ->from($tableName)
                    ->where('status','1')	
                    ->where('productCode',$productCode)
                    ->where('color',$color)
                    ->where('size',$size)
                    ->get();
                     //print_r($this->db->last_query());
                     // die();
        		//return $getData->result_array();
       
        		if($getData->num_rows() > 0) {
			   		return $getData->result_array();
			   		// print_r($this->db->last_query());
				}else { 
					echo "else block execute";
					die;
			     $this->session->set_flashdata('error_msg', ' Sorry!!! Product Out Of Stock.');
			     redirect(base_url());
			}	
			
	}


	#product Filter Start  for the category page

	public function getBrandByCategory($categoryId)
	{
		$this->db->select('*');
		$this->db->distinct();
		$this->db->from('product_details a');
		$this->db->join('brand br', 'a.brand=br.id', 'left');
		$this->db->where('a.categoryId', $categoryId);
		$this->db->where('a.status','1');
		$this->db->group_by('a.brand');
		$query = $this->db->get();
		// print_r($this->db->last_query());
		// die();
		return $query;
	}

	public function getColorByCategory($categoryId)
	{
		$this->db->select('color');
		$this->db->from('product_details');
		$this->db->where('categoryId', $categoryId);
		$this->db->where('status','1');
		$this->db->group_by('color');
		$query = $this->db->get();
		// print_r($this->db->last_query());
		// die();	
		return $query;
	}

	public function getSizeByCategory($categoryId)
	{
		$this->db->select('size');
		$this->db->from('product_details');
		$this->db->where('categoryId', $categoryId);
		$this->db->where('status','1');
		$this->db->group_by('size');
		$query = $this->db->get();
		// print_r($this->db->last_query());
		// die();	
		return $query;
	}

	#product filter for the Subcategory page


	public function getBrandBySubCategory($subcategoryId)
	{
		$this->db->select('*');
		$this->db->distinct();
		$this->db->from('product_details a');
		$this->db->join('brand br', 'a.brand=br.id', 'left');
		$this->db->where('a.subcategoryId', $subcategoryId);
		$this->db->where('a.status','1');
		$this->db->group_by('a.brand');
		$query = $this->db->get();
		// print_r($this->db->last_query());
		// die();
		return $query;
	}


	public function getColorBySubCategory($subcategoryId)
	{
		$this->db->select('color');
		$this->db->from('product_details');
		$this->db->where('subcategoryId', $subcategoryId);
		$this->db->where('status','1');
		$this->db->group_by('color');
		$query = $this->db->get();
		// print_r($this->db->last_query());
		// die();	
		return $query;
	}

	public function getSizeBySubCategory($subcategoryId)
	{
		$this->db->select('size');
		$this->db->from('product_details');
		$this->db->where('subcategoryId', $subcategoryId);
		$this->db->where('status','1');
		$this->db->group_by('size');
		$query = $this->db->get();
		// print_r($this->db->last_query());
		// die();	
		return $query;
	}


#Get all Category  for the product page
	public function getAllCategory()
	{
		# fetch all categroy from category page where status is active i.e
		$this->db->select('*');
		$this->db->from('category');
		$this->db->where('status','1');
		$query = $this->db->get();
		return $query->result();
	}

	public function getRandomCategory()
	{
		# fetch all categroy from category page where status is active i.e
		$this->db->select('*');
		$this->db->from('category');
		$this->db->order_by('rand()');
		$this->db->limit(6, 1);
		$this->db->where('status','1');
		$query = $this->db->get();
		return $query->result();
	}


	#|||||||||||||||||||||||||| RATING AND REVIEW  SECTION |||||||||||||||||||||||||||||||

	public function getAvgRatingReview($productId){

		$this->db->select_avg('ratings');
		$this->db->where('status','1');
		$this->db->where('productId',$productId);
		$query = $this->db->get('productreview');
		// 	print_r($this->db->last_query());
		// die();	
		return $query->result();
	}
	
	public function getRatingReview($productId){

		$this->db->select('*');
		$this->db->join('customer_master b','a.userId=b.id', 'left');
		$this->db->where('a.status','1');
		$this->db->where('productId',$productId);
		$this->db->order_by('a.id','desc');
		$query = $this->db->get('productreview a');
		// 	print_r($this->db->last_query());
		// die();	
		return $query->result();
	}
	
	
	#|||||||||||||||||||||||||| END RATING AND REVIEW  SECTION |||||||||||||||||||||||||||||||

	// autocomplete

	function fetch_data($query)
	{
		$this->db->limit(10);
	 $this->db->like('productName', $query);
	 $query = $this->db->get('product_details');
	 // print_r($this->db->last_query());
	 // die;
	 if($query->num_rows() > 0)
	 {
	  foreach($query->result_array() as $row)
	  {
	   $output[] = array(
		'name'  => $row["productName"],
		'image'  => $row["thumbnail1"]
	   );
	  }
	  echo json_encode($output);
	 }
	}
	
/**
	 * Abishek Soni
	 */
	public function getAllProductIdSubcategory($subcategoryId){
		$this->db->select('id');
		$this->db->from('product_details');
		$this->db->where('subcategoryId', $subcategoryId);
		$query = $this->db->get();
		return $query->result();
	}

	public function getColorBySubCategorytest($productIds)
	{
		$this->db->select('color');
		$this->db->from('stock');
		$this->db->where_in('productID', $productIds);
		$this->db->where('status','1');
		$this->db->group_by('color');
		$query = $this->db->get();
		// print_r($this->db->last_query());
		// die();
		return $query;
	}
	public function getSizeBySubCategorytest($productIds)
	{
		$this->db->select('size');
		$this->db->from('stock');
		$this->db->where_in('productID', $productIds);
		$this->db->where('status','1');
		$this->db->group_by('size');
		$query = $this->db->get();
		// print_r($this->db->last_query());
		// die();
		//return $query;
		return $query;
	}
	
/*
    ajeet yadav
    category filter 
*/

	public function getAllProductIdCategory($categoryId){
		$this->db->select('id');
		$this->db->where('categoryId',$categoryId);
		$query = $this->db->get('product_details');
		return $query->result();
	}
}