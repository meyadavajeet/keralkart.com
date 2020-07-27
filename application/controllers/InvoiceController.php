<?php

defined('BASEPATH') or exit('No direct script access allowed');

class InvoiceController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('InvoiceModel');
    }

    public function view_order_by_order_id($invoiceId)
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }

        #getActiveOrders
        // $data['activeOrders'] = $this->WelcomeModel->getActiveOrders();
        #sum of the  sold  amount from the order master table
        // $data['getSum'] = $this->WelcomeModel->getSalesAmount();
        #count active orders
        // $data['activeOrders'] = $this->WelcomeModel->getActiveOrders();

        $data['getProductByOrderId'] = $this->InvoiceModel->getProductByOrderId($invoiceId);
        $data['page_title'] = $invoiceId.' detail'; //assign dynamically
        $data['pageName'] = 'ordered_details';
        $this->load->view('admin/start', $data);
    }

    public function generate_invoice_by_invoice_id($invoiceId)
    {
        if (!$this->session->userdata('username')) {
            redirect('myadmin');
        }
        $data['getProductByOrderId'] = $this->InvoiceModel->getProductByOrderId($invoiceId);
        $data['page_title'] = $invoiceId.' invoice'; 
        $data['pageName'] = 'create_invoice';
        $this->load->view('admin/start', $data);
    }
}