<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class StockImport extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Stock_Import_model', 'import');
        // load library
        $this->load->library('Excel');
        $this->load->library('upload');
    }


    public function save()
    {
        $this->load->library('excel');

        if ($this->input->post('importfile')) {
            // $path = ROOT_UPLOAD_IMPORT_PATH;
            $path = 'uploads/admin/stocks/';

            $config['upload_path'] = $path;
            $config['allowed_types'] = 'xlsx|xls';
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
            // `id`, `productCode`, `brand`, `color`, `size`, `stockPrice`, `quantity`, `added_at`, `updated_at`, `status`
            $createArray = array(
                'productCode',
                'color',
                'size',
                'stockPrice',
                'quantity',
                'status'
            );
            $makeArray = array(
                'productCode' => 'productCode',
                'color' => 'color',
                'size' => 'size',
                'stockPrice' => 'stockPrice',
                'quantity' => 'quantity',
                'status' => 'status'
            );

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

                    $productCode = $SheetDataKey['productCode'];
                    $color = $SheetDataKey['color'];
                    $size = $SheetDataKey['size'];
                    $stockPrice = $SheetDataKey['stockPrice'];
                    $quantity = $SheetDataKey['quantity'];
                    $status = $SheetDataKey['status'];
                    $added_at = date('Y-m-d H:i:s');


                    // $firstName = filter_var(trim($allDataInSheet[$i][$firstName]), FILTER_SANITIZE_STRING);
                    // $lastName = filter_var(trim($allDataInSheet[$i][$lastName]), FILTER_SANITIZE_STRING);
                    // $email = filter_var(trim($allDataInSheet[$i][$email]), FILTER_SANITIZE_EMAIL);
                    // $dob = filter_var(trim($allDataInSheet[$i][$dob]), FILTER_SANITIZE_STRING);
                    // $contactNo = filter_var(trim($allDataInSheet[$i][$contactNo]), FILTER_SANITIZE_STRING);

                    $productCode = filter_var(trim($allDataInSheet[$i][$productCode]), FILTER_SANITIZE_STRING);
                    $color = filter_var(trim($allDataInSheet[$i][$color]), FILTER_SANITIZE_STRING);
                    $size = filter_var(trim($allDataInSheet[$i][$size]), FILTER_SANITIZE_STRING);
                    $stockPrice = filter_var(trim($allDataInSheet[$i][$stockPrice]), FILTER_SANITIZE_STRING);
                    $quantity = filter_var(trim($allDataInSheet[$i][$quantity]), FILTER_SANITIZE_STRING);
                    $status = filter_var(trim($allDataInSheet[$i][$status]), FILTER_SANITIZE_STRING);
                    $added_at = date('Y-m-d H:i:s');
                    // $fetchData[] = array('first_name' => $firstName, 'last_name' => $lastName, 'email' => $email, 'dob' => $dob, 'contact_no' => $contactNo);
                    $fetchData[] = array(
                        'productCode' => $productCode,
                        'color' => $color,
                        'size' => $size,
                        'stockPrice' => $stockPrice,
                        'quantity' => $quantity,
                        'status' => $status
                    );
                }


                for ($i = 0; $i < count($fetchData); $i++) {
                    $fetchData[$i]['added_at'] = date('Y-m-d H:i:s');
                }
                $data['employeeInfo'] = $fetchData;
                $this->session->set_flashdata('success_msg', 'Success!!!. Excel import.');
                print_r($fetchData);
                $this->import->setBatchImport($fetchData);
                $this->import->importData();
                // unlink($inputFileName);
            } else {
                echo "Please import correct file";
            }
        }



        redirect(base_url() . 'stock');
    }
}