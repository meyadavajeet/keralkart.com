<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * company hubroot solutions
 * author Ajeet Yadav
 */
class GstModel extends CI_Model
{

  function __construct()
  {
    $this->load->database();
  }

   public function getGstList($tableName)
   {
     $query = $this->db->get($tableName);
        return $query->result();
   }

   public function insertModel($data, $tableName)
      {
        $query = $this->db->insert($tableName, $data);
        return $query ? true : false;
    }
    public function deleteModel($gst_id,$tableName){
       $query = $this->db->where('gst_id', $gst_id)
                    ->delete($tableName);
        return $query ? true : false;
    }
    public function checkStatus($id,$tableName)
    {
        $query = $this->db->select('status')
            ->from($tableName)
            ->where('gst_id', $id)
            ->get();
        return $query->result();
    }
    public function updateModel($data,$gst_id,$tableName){
        $query = $this->db->where('gst_id', $gst_id)
                            ->update($tableName, $data);
        return $query ? true : false;
    }

}
