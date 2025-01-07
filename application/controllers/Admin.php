<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load Admin_model
        $this->load->model('Admin_model', 'model');
        is_logout();
        is_user();
        $this->user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }


    public function tutorial_pembayaran()
    {
        is_user();
        $data = [
            'judul' => 'Tutorial Pembayaran',
            'user' => $this->user
        ];

        $this->templating->load('admin/tutorial_pembayaran', $data);
    }

    public function pelanggan()
    {
        $data = [
            'judul' => 'Data Pelanggan',
            'user' => $this->user,
            'pelanggan' => $this->model->getPelanggan()
        ];

        // load view
        $this->templating->load('admin/pelanggan', $data);
    }

    public function tambah_pelanggan()
    {
        // Validasi form
        $this->form_validation->set_rules('nama_instansi', 'Nama Instansi', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[user.email]');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]');
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[8]');
        $this->form_validation->set_rules('confirm_password', 'Konfirmasi Password', 'required|matches[password]');

        if ($this->form_validation->run() == FALSE) {
            $data = [
                'judul' => 'Tambah Pengguna',
                'user' => $this->user
            ];
            $this->templating->load('admin/tambah_pengguna', $data);
        } else {
            $this->model->tambah_pengguna();
            $this->session->set_flashdata('msg', 'ditambahkan.');
            redirect('data-pelanggan');
        }
    }

    public function edit_pelanggan($id)
    {
        // Ambil data pengguna berdasarkan ID
        $data['pengguna'] = $this->model->getPenggunaById($id);

        // Jika data pengguna tidak ditemukan
        if (!$data['pengguna']) {
            $this->session->set_flashdata('msg', 'Pengguna tidak ditemukan.');
            redirect('data-pelanggan');
        }

        // Validasi form
        $this->form_validation->set_rules('nama_instansi', 'Nama Instansi', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        $this->form_validation->set_rules('alamat', 'Alamat', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('pass1', 'Password', 'min_length[8]');

        // Jika validasi gagal
        if ($this->form_validation->run() == FALSE) {
            $data['judul'] = 'Edit Pengguna';
            $data['user'] = $this->user;

            // Load view edit pengguna
            $this->templating->load('admin/edit_pengguna', $data);
        } else {
            // Proses update data pengguna
            $this->model->updatePengguna($id);
            $this->session->set_flashdata('msg', 'diubah.');
            redirect('data-pelanggan');
        }
    }

    public function hapus_pengguna($id)
    {

        // Debug: Log the received ID
        log_message('debug', 'Received ID for deletion: ' . $id);

        if ($id && is_numeric($id)) {
            try {
                // Hapus data dari tabel `user` 
                $this->db->where('id', $id);
                $result = $this->db->delete('user');

                if ($result) {
                    $this->session->set_flashdata('msg', 'Data pengguna berhasil dihapus.');
                } else {
                    $this->session->set_flashdata('msg', 'Gagal menghapus data pengguna.');
                }
            } catch (Exception $e) {
                $this->session->set_flashdata('msg', 'Error: ' . $e->getMessage());
            }
        } else {
            $this->session->set_flashdata('msg', 'ID tidak valid atau pengguna tidak ditemukan.');
        }

        redirect('data-pelanggan');
    }
}
