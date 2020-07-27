<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Import extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Import_model', 'import');

        $this->load->model('WelcomeModel');
        // load library
        $this->load->library('Excel');
        $this->load->library('upload');
    }

    function generate_url_slug($string,$table,$field,$key=NULL,$value=NULL){
        $t =& get_instance();
        $slug = url_title($string);
        $slug = strtolower($slug);
        $i = 0;
        $params = array ();
        $params[$field] = $slug;
     
        if($key)$params["$key !="] = $value; 
     
        while ($t->db->where($params)->get($table)->num_rows())
        {   
            if (!preg_match ('/-{1}[0-9]+$/', $slug ))
                $slug .= '-' . ++$i;
            else
                $slug = preg_replace ('/[0-9]+$/', ++$i, $slug );
             
            $params [$field] = $slug;
        }   
        return $slug;   
    }
    // import excel data
    public function save() {
        $this->load->library('excel');

        if ($this->input->post('importfile')) {
            // $path = ROOT_UPLOAD_IMPORT_PATH;
            $path = 'uploads/';

            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls|jpg|png';
            $config['remove_spaces'] = TRUE;
            $this->upload->initialize($config);
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('userfile')) {
                $error = array('error' => $this->upload->display_errors());
            } else {
                $data = array('upload_data' => $this->upload->data());
            }

            if (!empty($data['upload_data']['file_name'])) {
                $import_xls_file = $data['upload_data']['file_name'];
            } else {
                $import_xls_file = 0;
            }
            $inputFileName = $path . $import_xls_file;
            try {
                $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
                $objReader = PHPExcel_IOFactory::createReader($inputFileType);
                $objPHPExcel = $objReader->load($inputFileName);
            } catch (Exception $e) {
                die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
                        . '": ' . $e->getMessage());
            }
            $allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);


            $arrayCount = count($allDataInSheet);
            $flag = 0;
            $createArray = array('productCode', 'productName', 'strikePrice', 'price', 'mrp', 'quantity', 'discount', 'color', 'size', 'weight', 'brand', 'smallDiscription', 'features', 'productDescription', 'hotdeal', 'premium', 'inStock', 'latestCollection', 'thumbnail1', 'thumbnail2', 'thumbnail3', 'thumbnail4', 'added_by', 'updated_by', 'status');
            $makeArray = array('productCode' => 'productCode', 'productName' => 'productName', 'strikePrice' => 'strikePrice', 'price' => 'price', 'mrp' => 'mrp', 'quantity' => 'quantity', 'discount' => 'discount', 'color' => 'color', 'size' => 'size', 'weight' => 'weight', 'brand' => 'brand', 'smallDiscription' => 'smallDiscription', 'features' => 'features', 'productDescription' => 'productDescription', 'hotdeal' => 'hotdeal', 'premium' => 'premium', 'inStock' => 'inStock', 'latestCollection' => 'latestCollection', 'thumbnail1' => 'thumbnail1', 'thumbnail2' => 'thumbnail2', 'thumbnail3' => 'thumbnail3', 'thumbnail4' => 'thumbnail4', 'added_by' => 'added_by', 'updated_by' => 'updated_by', 'status' => 'status');
            $SheetDataKey = array();
            foreach ($allDataInSheet as $dataInSheet) {
                foreach ($dataInSheet as $key => $value) {
                    if (in_array(trim($value), $createArray)) {
                        $value = preg_replace('/\s+/', '', $value);
                        $SheetDataKey[trim($value)] = $key;
                    } else {
                        
                    }
                }
            }
            $data = array_diff_key($makeArray, $SheetDataKey);

            if (empty($data)) {
                $flag = 1;
            }
            if ($flag == 1) {
                for ($i = 2; $i <= $arrayCount; $i++) {
                    
                    $addresses = array();

                    // $firstName = $SheetDataKey['First_Name'];
                    // $lastName = $SheetDataKey['Last_Name'];
                    // $email = $SheetDataKey['Email'];
                    // $dob = $SheetDataKey['DOB'];
                    // $contactNo = $SheetDataKey['Contact_NO'];

                   // $slug = $SheetDataKey['slug'];
                    $productCode = $SheetDataKey['productCode'];
                    $productName = $SheetDataKey['productName'];
                    $strikePrice = $SheetDataKey['strikePrice'];
                    $price = $SheetDataKey['price'];
                    $mrp = $SheetDataKey['mrp'];
                    $quantity = $SheetDataKey['quantity'];
                    $discount = $SheetDataKey['discount'];
                    $color = $SheetDataKey['color'];
                    $size = $SheetDataKey['size'];
                    $weight = $SheetDataKey['weight'];
                    $brand = $SheetDataKey['brand'];
                    $smallDiscription = $SheetDataKey['smallDiscription'];
                    $features = $SheetDataKey['features'];
                    $productDescription = $SheetDataKey['productDescription'];
                    $hotdeal = $SheetDataKey['hotdeal'];
                    $premium = $SheetDataKey['premium'];
                    $inStock = $SheetDataKey['inStock'];
                    $latestCollection = $SheetDataKey['latestCollection'];
                    $thumbnail1 = $SheetDataKey['thumbnail1'];
                    $thumbnail2 = $SheetDataKey['thumbnail2'];
                    $thumbnail3 = $SheetDataKey['thumbnail3'];
                    $thumbnail4 = $SheetDataKey['thumbnail4'];
                    $added_by = $SheetDataKey['added_by'];
                    $updated_by = $SheetDataKey['added_by'];
                    $status = $SheetDataKey['status'];

                    // $firstName = filter_var(trim($allDataInSheet[$i][$firstName]), FILTER_SANITIZE_STRING);
                    // $lastName = filter_var(trim($allDataInSheet[$i][$lastName]), FILTER_SANITIZE_STRING);
                    // $email = filter_var(trim($allDataInSheet[$i][$email]), FILTER_SANITIZE_EMAIL);
                    // $dob = filter_var(trim($allDataInSheet[$i][$dob]), FILTER_SANITIZE_STRING);
                    // $contactNo = filter_var(trim($allDataInSheet[$i][$contactNo]), FILTER_SANITIZE_STRING);
                    //$slug = filter_var(trim($allDataInSheet[$i][$slug]), FILTER_SANITIZE_STRING);
                    $productCode = filter_var(trim($allDataInSheet[$i][$productCode]), FILTER_SANITIZE_STRING);
                    $productName = filter_var(trim($allDataInSheet[$i][$productName]), FILTER_SANITIZE_STRING);
                    $strikePrice = filter_var(trim($allDataInSheet[$i][$strikePrice]), FILTER_SANITIZE_STRING);
                    $price = filter_var(trim($allDataInSheet[$i][$price]), FILTER_SANITIZE_STRING);
                    $mrp = filter_var(trim($allDataInSheet[$i][$mrp]), FILTER_SANITIZE_STRING);
                    $quantity = filter_var(trim($allDataInSheet[$i][$quantity]), FILTER_SANITIZE_STRING);
                    $discount = filter_var(trim($allDataInSheet[$i][$discount]), FILTER_SANITIZE_STRING);
                    $color = filter_var(trim($allDataInSheet[$i][$color]), FILTER_SANITIZE_STRING);
                    $size = filter_var(trim($allDataInSheet[$i][$size]), FILTER_SANITIZE_STRING);
                    $weight = filter_var(trim($allDataInSheet[$i][$weight]), FILTER_SANITIZE_STRING);
                    $brand = filter_var(trim($allDataInSheet[$i][$brand]), FILTER_SANITIZE_STRING);
                    $smallDiscription = filter_var(trim($allDataInSheet[$i][$smallDiscription]), FILTER_SANITIZE_STRING);
                    $features = filter_var(trim($allDataInSheet[$i][$features]), FILTER_SANITIZE_STRING);
                    $productDescription = filter_var(trim($allDataInSheet[$i][$productDescription]), FILTER_SANITIZE_STRING);
                    $hotdeal = filter_var(trim($allDataInSheet[$i][$hotdeal]), FILTER_SANITIZE_STRING);
                    $premium = filter_var(trim($allDataInSheet[$i][$premium]), FILTER_SANITIZE_STRING);
                    $inStock = filter_var(trim($allDataInSheet[$i][$inStock]), FILTER_SANITIZE_STRING);
                    $latestCollection = filter_var(trim($allDataInSheet[$i][$latestCollection]), FILTER_SANITIZE_STRING);
                    $thumbnail1 = filter_var(trim($allDataInSheet[$i][$thumbnail1]), FILTER_SANITIZE_STRING);
                    $thumbnail2 = filter_var(trim($allDataInSheet[$i][$thumbnail2]), FILTER_SANITIZE_STRING);
                    $thumbnail3 = filter_var(trim($allDataInSheet[$i][$thumbnail3]), FILTER_SANITIZE_STRING);
                    $thumbnail4 = filter_var(trim($allDataInSheet[$i][$thumbnail4]), FILTER_SANITIZE_STRING);
                    $added_by = filter_var(trim($allDataInSheet[$i][$added_by]), FILTER_SANITIZE_STRING);
                    $updated_by = filter_var(trim($allDataInSheet[$i][$added_by]), FILTER_SANITIZE_STRING);
                    $status = filter_var(trim($allDataInSheet[$i][$status]), FILTER_SANITIZE_STRING);

                    // $fetchData[] = array('first_name' => $firstName, 'last_name' => $lastName, 'email' => $email, 'dob' => $dob, 'contact_no' => $contactNo);
                    $fetchData[] = array('slug' => $this->generate_url_slug($productName,'product_details','slug'), 'productCode' => $productCode, 'productName' => $productName, 'strikePrice' => $strikePrice, 'price' => $price, 'mrp' => $mrp, 'quantity' => $quantity, 'discount' => $discount, 'color' => $color, 'size' => $size, 'weight' => $weight, 'brand' => $brand, 'smallDiscription' => $smallDiscription, 'features' => $features, 'productDescription' => $productDescription, 'hotdeal' => $hotdeal, 'premium' => $premium, 'inStock' => $inStock, 'latestCollection' => $latestCollection, 'thumbnail1' => $thumbnail1, 'thumbnail2' => $thumbnail2, 'thumbnail3' => $thumbnail3, 'thumbnail4' => $thumbnail4, 'added_by' => $added_by, 'updated_by' => $added_by, 'status' => $status);
                }

                $data['employeeInfo'] = $fetchData;
                $this->import->setBatchImport($fetchData);
                $this->import->importData();
                unlink($inputFileName);
                $this->session->set_flashdata('success_msg', ' Data imported  successfully.');
                redirect('Welcome/productList');
            } else {
                echo "";  
                 $this->session->set_flashdata('error_msg','Please import correct file');
                 redirect('Welcome/productList');
            }
        }


    }


}

?>