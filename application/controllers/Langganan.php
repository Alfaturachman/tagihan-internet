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
        $data['judul'] = 'Tambah Langganan';
        $this->db->where('role_id', 2);
        $data['user'] = $this->db->get('user')->result();

        // Ambil data paket layanan
        $data['paket_layanan'] = $this->db->get('paket_layanan')->result();

        $this->form_validation->set_rules('id_user', 'Pilih Pengguna', 'required');
        $this->form_validation->set_rules('id_paket_layanan', 'Pilih Paket Layanan', 'required');
        $this->form_validation->set_rules('tanggal_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('tanggal_berakhir', 'Tanggal Berakhir', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->templating->load('langganan/tambah_langganan', $data);
        } else {
            // Simpan langganan ke dalam database
            $data_insert = [
                'id_user' => $this->input->post('id_user'),
                'id_paket_layanan' => $this->input->post('id_paket_layanan'),
                'tanggal_mulai' => $this->input->post('tanggal_mulai'),
                'tanggal_berakhir' => $this->input->post('tanggal_berakhir'),
                'status' => $this->input->post('status')
            ];

            // Insert langganan
            $this->db->insert('langganan', $data_insert);
            $langganan_id = $this->db->insert_id();

            // Ambil harga paket
            $paket = $this->db->get_where('paket_layanan', ['id' => $this->input->post('id_paket_layanan')])->row();
            $total_harga = $paket->harga_paket;

            // Data invoice
            $invoice_data = [
                'id_langganan' => $langganan_id,
                'invoice' => 'INV-' . strtoupper(uniqid()),  // Generate invoice code
                'tanggal_invoice' => date('Y-m-d'),
                'total_harga' => $total_harga,
                'status' => 'Belum Bayar',
                'tanggal_bayar' => NULL
            ];

            // Insert invoice
            $this->db->insert('invoice', $invoice_data);

            // Set flash message and redirect
            $this->session->set_flashdata('message', 'Langganan dan Invoice berhasil ditambahkan!');
            redirect('data-langganan');
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
        // Mulai transaksi untuk memastikan konsistensi data
        $this->db->trans_start();

        // Hapus data invoice terkait dengan langganan
        $this->db->delete('invoice', ['id_langganan' => $id]);

        // Hapus langganan
        $this->db->delete('langganan', ['id' => $id]);

        // Commit transaksi
        $this->db->trans_complete();

        // Cek apakah transaksi berhasil
        if ($this->db->trans_status() === FALSE) {
            // Jika transaksi gagal, beri flash message error
            $this->session->set_flashdata('message', 'Gagal menghapus langganan!');
        } else {
            // Jika transaksi berhasil, beri flash message sukses
            $this->session->set_flashdata('message', 'Langganan berhasil dihapus!');
        }

        // Redirect ke halaman data langganan
        redirect('data-langganan');
    }
}
