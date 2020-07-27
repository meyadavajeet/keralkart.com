<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Import_model extends CI_Model {

    private $_batchImport;

    public function setBatchImport($batchImport) {
        $this->_batchImport = $batchImport;
    }

    // save data
    public function importData() {
        $data = $this->_batchImport;
        $this->db->insert_batch('product_details', $data);
    }   
    public function importData1() {
        $data = $this->_batchImport;
        $this->db->insert_batch('stock', $data);
    }

}

?>