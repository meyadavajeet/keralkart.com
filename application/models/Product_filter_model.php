<?php

class Product_filter_model extends CI_Model
{
 function fetch_filter_type($type)
 {
  $this->db->distinct();
  $this->db->select($type);
  $this->db->from('product_details');
  $this->db->where('status', '1');
  $this->db->where('categoryId',$categoryId);
  print_r($this->db->last_query());
  die();
  return $this->db->get();
 }

 function make_query($minimum_price, $maximum_price, $brand, $color, $size, $categoryId)
 {
  $query = " SELECT * FROM product_details left join brand on product_details.brand = brand.id
  WHERE product_details.status = '1' && categoryId = '".$categoryId."'";

  if(isset($minimum_price, $maximum_price) && !empty($minimum_price) &&  !empty($maximum_price))
  {
   $query .= "
    AND price BETWEEN '".$minimum_price."' AND '".$maximum_price."'
   ";
  }

  if(isset($brand))
  {
   $brand_filter = implode("','", $brand);
   $query .= "
    AND brand IN('".$brand_filter."')
   ";
  }

  if(isset($color))
  {
   $color_filter = implode("','", $color);
   $query .= "
    AND color IN('".$color_filter."')
   ";
  }

  if(isset($size))
  {
   $size_filter = implode("','", $size);
   $query .= "
    AND size IN('".$size_filter."')
   ";
  }
  return $query;
 }

 function count_all($minimum_price, $maximum_price, $brand, $color, $size, $categoryId)
 {
  $query = $this->make_query($minimum_price, $maximum_price, $brand, $color, $size,$categoryId);
  $data = $this->db->query($query);
  return $data->num_rows();
 }

 function fetch_data($limit, $start, $minimum_price, $maximum_price, $brand, $color, $size, $categoryId)
 {
  $query = $this->make_query($minimum_price, $maximum_price, $brand, $color, $size,$categoryId);

  $query .= ' LIMIT '.$start.', ' . $limit;

  $data = $this->db->query($query);

  $output = '';
  if($data->num_rows() > 0)
  {
   foreach($data->result_array() as $row)
   {
    $name_pro = $row['productName'];
   

    $output .= '
    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-3" style="">
    <div class="item" style="border:none">
     <a href="'.base_url().'products/'.$row['slug'].'" style="text-decoration:none;"> <div style=" height:440px;">
      <img src="'.base_url().'uploads/product/'. $row['thumbnail1'] .'" alt="" class="img img-responsive " ></a>
      <br>
       <div align="center">
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star checked"></span>
          <span class="fa fa-star"></span>
          <span class="fa fa-star"></span>
      </div>
      <p></p>
      <a href="'.base_url().'products/'.$row['slug'].'" style="text-decoration:none;" > <p align="center"><strong>'.substr($row['productName'], 0, 40)  .'...</strong></p>
      <h4 style="text-align:center"><small class="text-success"><strike>&#8377;'.$row['mrp'].'</strike></small>
      <h4 style="text-align:center;" class="text-danger" ><b>&#8377;'. $row['price'] .'</b></h4></a>
      <p>
     </div>
     </div>
     </a>
    </div>
    
    ';
   }/*
   <div class="text-black">
        Brand : '. $row['brandName'] .' <br />
        Color : '. $row['color'] .' <br />
        Size : '. $row['size'] .'  </p>
     </div>*/
  }
  else
  {
   $output = '<h3>No Data Found</h3>';
  }
  return $output;
 }
}

?>
