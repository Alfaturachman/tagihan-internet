<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_model', 'model');
        $this->load->model('Laporan_model'); // Load model laporan
        $this->load->library('pdf'); // Load library pdf
        is_logout();
        $this->user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function laporan_pembayaran()
    {
        is_user();
        $data = [
            'judul' => 'Cetak Laporan Pembayaran',
            'user' => $this->user,
            'instansi' => $this->Laporan_model->get_all_instansi()
        ];
        $this->templating->load('laporan/form_laporan', $data);
    }

    public function cetak_laporan_pembayaran()
    {
        is_user();

        if (isset($_POST['btn-cek']) || isset($_POST['cetak-pdf'])) {
            $mulai = $this->input->post('tgl_mulai');
            $selesai = $this->input->post('tgl_selesai');
            $filter = $this->input->post('filter');

            $data = [
                'judul' => 'Laporan Pembayaran',
                'user' => $this->user,
                'laporan' => $this->Laporan_model->get_laporan_pembayaran($mulai, $selesai, $filter),
                'tgl_mulai' => $mulai,
                'tgl_selesai' => $selesai
            ];

            if (isset($_POST['cetak-pdf'])) {
                $this->pdf->setPaper('A4', 'landscape');
                $this->pdf->filename = "Laporan_Pembayaran.pdf";
                $this->pdf->load_view('laporan/laporan_pdf', $data);
            } else {
                $this->templating->load('laporan/laporan_view', $data);
            }
        } else {
            redirect('user/laporan_pembayaran'); // Redirect ke halaman form laporan
        }
    }
}
