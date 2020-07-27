<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class BlogModel extends CI_Model {

    function __construct() {
        parent::__construct(); 
        $this->load->database();         
	}
	
	public function insertModel($data, $tableName)
    {
        $query = $this->db->insert($tableName, $data);
        return $query ? true : false;
    }

    public function selectModel($tableName)
    {
    	$query = $this->db->get($tableName);
        return $query->result();
    }

    public function deleteModel($id,$tableName){
       $query = $this->db->where('blogId', $id)
                    ->delete($tableName);
        return $query ? true : false;
    }
    public function checkStatus($id,$tableName)
    {
        $query = $this->db->select('status')
            ->from($tableName)
            ->where('blogId', $id)
            ->get();
        return $query->result();
    }

    public function updateModel($data,$id,$tableName){
        $query = $this->db->where('blogId', $id)
                            ->update($tableName, $data);
        return $query ? true : false; 
    }

    public function selectModelInArraybyId($tableName,$blogId){
        $this->db->select('*');
        $this->db->from($tableName);
        $this->db->where('blogId',$blogId);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function selectOrderByModel($tableName,$desc,$limit,$start)
    {
        $this->db->select('*');
        $this->db->from($tableName);
        $this->db->limit($limit,$start);
        $this->db->order_by('blogId',$desc);
        $query = $this->db->get();
        return $query->result();
    }

    public function getHeading($tableName)
    { 
        $this->db->select('*');
        $this->db->order_by('rand()');
        $this->db->limit(5);
        $this->db->from($tableName);
        $query = $this->db->get();
        return $query->result();
    }
        public function getPopularHeading($tableName)
        { 
            $this->db->select('*');
            $this->db->order_by('rand()');
            $this->db->limit(10);
            $this->db->from($tableName);
            $query = $this->db->get();
            return $query->result();
        }
           //Pagination count     
        public function get_count($tableName)
        {
            return $this->db->count_all($tableName);
        }       
    public function selectOneDataModel($tableName,$slug)
    {
        $this->db->select('*');
        $this->db->from($tableName);
        $this->db->where('url_slug',$slug);
        $query = $this->db->get();
        // print_r($this->db->last_query());
        return $query->result();
    }

     public function getRecentPost($getColumn, $tblName, $start, $limit)
     {
        $this->db->select($getColumn);
        $this->db->limit($limit, $start);
        $this->db->where('status', '1');
        $query = $this->db->get($tblName);
        $row = $query->result();
        return $row;
        //print_r($this->db->last_query());
    }

     public function allProducts()
     {
        $this->db->select('*');
        $this->db->order_by('rand()');
        $this->db->limit(4);
        $this->db->from('product_details');
        $query = $this->db->get();
        return $query->result();
     }

}