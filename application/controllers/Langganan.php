<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Langganan extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // Load Admin_model
        $this->load->model('Langganan_model', 'model');
        is_logout();
        is_user();
        $this->user = $this->db->get_where('user', ['username' => $this->session->userdata('username')])->row_array();
    }

    public function data_langganan()
    {
        $data = [
            'judul' => 'Data Langganan',
            'user' => $this->user,
            'langganan' => $this->model->getLangganan()
        ];

        $this->templating->load('langganan/data_langganan', $data);
    }

    public function tambah_langganan()
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
                'judul' => 'Tambah langganan',
                'user' => $this->user
            ];
            $this->templating->load('langganan/tambah_langganan', $data);
        } else {
            $this->model->tambah_langganan();
            $this->session->set_flashdata('msg', 'ditambahkan.');
            redirect('data-pelanggan');
        }
    }

    public function edit_langganan($id)
    {
        $data['pengguna'] = $this->model->getPenggunaById($id);

        if (!$data['pengguna']) {
            $this->session->set_flashdata('msg', 'Pengguna tidak ditemukan.');
            redirect('data-langganan');
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
            $this->session->set_flashdata('msg', 'Data pengguna berhasil diubah.');
            redirect('data-langganan');
        }
    }

    public function hapus_langganan($id)
    {
        if ($id && is_numeric($id)) {
            try { 
                $this->db->where('id', $id);
                $result = $this->db->delete('user');

                if ($result) {
                    $this->session->set_flashdata('msg', 'Data langganan berhasil dihapus.');
                } else {
                    $this->session->set_flashdata('msg', 'Gagal menghapus data langganan.');
                }
            } catch (Exception $e) {
                $this->session->set_flashdata('msg', 'Error: ' . $e->getMessage());
            }
        } else {
            $this->session->set_flashdata('msg', 'ID tidak valid atau langganan tidak ditemukan.');
        }

        redirect('data-pelanggan');
    }
}
