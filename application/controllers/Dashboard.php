<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load Admin_model
        $this->load->model('Dashboard_model');
        is_logout();
        is_user();
        $this->user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    // Dashboard untuk admin
    public function admin()
    {
        // Hanya role admin yang bisa mengakses
        if ($this->session->userdata('role_id') != 1) {
            redirect('auth');
        }

        $data = [
            'judul' => 'Dashboard Admin',
            'total_user' => $this->Dashboard_model->getTotalUser(),
            'total_langganan' => $this->Dashboard_model->getTotalLangganan(),
            'total_invoice' => $this->Dashboard_model->getTotalInvoice(),
            'total_bayar' => $this->Dashboard_model->getTotalByStatus('Dibayar'),
            'total_belum_bayar' => $this->Dashboard_model->getTotalByStatus('Belum Bayar'),
        ];

        $this->templating->load('dashboard/admin', $data);
    }

    // Dashboard untuk pelanggan
    public function pelanggan()
    {
        // Hanya role pelanggan yang bisa mengakses
        if ($this->session->userdata('role_id') != 2) {
            redirect('auth');
        }

        // Load model yang dibutuhkan
        $this->load->model('Langganan_model');
        $this->load->model('Invoice_model');

        // Ambil ID user dari session
        $user_id = $this->session->userdata('id');

        $data = [
            'judul' => 'Dashboard Pelanggan',
            'total_langganan_aktif' => $this->Langganan_model->getTotalLanggananByUser($user_id, 'Aktif'),
            'total_invoice' => $this->Invoice_model->getTotalInvoiceByUser($user_id),
            'total_bayar' => $this->Invoice_model->getTotalByStatusAndUser($user_id, 'Dibayar'),
            'total_belum_bayar' => $this->Invoice_model->getTotalByStatusAndUser($user_id, 'Belum Bayar'),
        ];

        // Load view dengan template
        $this->templating->load('dashboard/pelanggan', $data);
    }
}
