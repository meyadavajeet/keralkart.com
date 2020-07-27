<?php

defined('BASEPATH') or exit('No direct script access allowed');

class InvoiceModel extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function getProductByOrderId($invoiceId){
		$query = $this->db->select('c.id, c.customerName, c.mobile, c.email, c.profileImage, c.CustomerAddress, c.is_activated,c.alternateContact,c.postalCode,c.country,c.state,c.city,c.landmark, b.id as bid, b.orderId, b.total as Totals, b.subtotal, b.deliveryCharge, b.discount, b.shippingAddress as shipping_address, b.customerId, b.paymentMode, b.added_at, b.modified_at, b.satus,e.id,e.orderId,e.productId,e.price,e.quantity as orderedQuantity,e.size,e.brand,e.color,e.productImage,e.orderedOn,e.status,a.id, a.categoryId, a.subcategoryId, a.productCode, a.productName, a.strikePrice, a.price, a.mrp, a.quantity, a.discount, a.color, a.size, a.weight, a.brand, a.smallDiscription, a.features, a.productDescription, a.hotdeal, a.premium, a.inStock, a.latestCollection, a.thumbnail1, a.thumbnail2, a.thumbnail3, a.thumbnail4, a.added_at, a.updated_at, a.added_by, a.updated_by, a.status,a.slug,s.color,s.size');
		$this->db->from('customer_master c');
		$this->db->join('order_master b ', '$customerId=c.id', 'inner');
		$this->db->join('ordered_items e','b.orderId=e.orderId','inner');
		$this->db->join('product_details a ','a.id=e.productId','inner');
		$this->db->join('stock s ','s.productID=e.productId','inner');
		$this->db->where_in('b.orderId', $invoiceId);
		// $this->db->group_by('b.orderId');
		$query = $this->db->get();
            // print_r($this->db->last_query());
            // die;
        return $query->result();
	}

}