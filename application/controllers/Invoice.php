<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load Admin_model
        $this->load->model('Invoice_model', 'model');
        is_logout();
        is_user();
        $this->user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function data_invoice()
    {
        $data = [
            'judul' => 'Data Invoice',
            'user' => $this->user,
            'invoice' => $this->model->getInvoice()
        ];

        $this->templating->load('invoice/data_invoice', $data);
    }
}
