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
            redirect('user/laporan_pembayaran');
        }
    }

    public function read_data()
    {
        is_admin();
        $data = [
            'judul' => 'Daftar Pengaduan',
            'user' => $this->user,
            'data' => $this->model->getData()
        ];
        $this->templating->load('user/pengaduan', $data);
    }

    public function ubah_data()
    {
        if (isset($_POST['ubah-data'])) {
            $this->model->ubah_data();
        } else {
            redirect('auth/notfound');
        }
    }

    public function tambah_data()
    {
        is_admin();
        $data = [
            'judul' => 'Tambah Pengaduan',
            'user' => $this->user
        ];

        $this->templating->load('user/tambah', $data);
    }

    public function tambah_data_aksi()
    {
        if ($this->input->is_ajax_request() == true) {
            $this->form_validation->set_rules('judul_pengaduan', 'Judul pengaduan', 'required|max_length[255]');
            $this->form_validation->set_rules('isi_pengaduan', 'Isi pengaduan', 'required');
            $this->form_validation->set_rules('alamat', 'Alamat', 'required|max_length[255]');
            $this->form_validation->set_rules('no_hp', 'Nomor Telepon', 'required|numeric|max_length[20]');

            $this->form_validation->set_error_delimiters('', '');

            if ($this->form_validation->run() == false) {
                $errors = [
                    'judul_pengaduan' => form_error('judul_pengaduan'),
                    'isi_pengaduan' => form_error('isi_pengaduan'),
                    'alamat' => form_error('alamat'),
                    'no_hp' => form_error('no_hp'),
                ];

                $data = [
                    'status' => false,
                    'errors' => $errors
                ];

                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            } else {
                $this->model->tambah_data();
                $data['status'] = true;
                $this->output->set_content_type('application/json')->set_output(json_encode($data));
            }
        } else {
            redirect('tambah-pengaduan');
        }
    }

    public function ubah_password()
    {
        $data = [
            'user' => $this->user,
            'judul' => 'Ubah Password'
        ];

        $this->form_validation->set_rules('password', 'Password Lama', 'required');
        $this->form_validation->set_rules('newpass', 'Password Baru', 'required|min_length[8]');
        $this->form_validation->set_rules('newpass2', 'Konfirmasi Password', 'required|matches[newpass]');

        if ($this->form_validation->run() == false) {
            $this->templating->load('user/ubah-password', $data);
        } else {
            $this->model->ubah_password();
        }
    }
}
