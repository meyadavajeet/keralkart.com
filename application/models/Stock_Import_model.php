<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stock_Import_model extends CI_Model
{

    private $_batchImport;

    public function setBatchImport($batchImport)
    {
        $this->_batchImport = $batchImport;
    }

    // save data
    public function importData()
    {
        $data = $this->_batchImport;
        $this->db->insert_batch('stock', $data);
        print_r($this->db->last_query());
        $this->db->insert_batch('stockreport', $data);
        print_r($this->db->last_query());
    }
}