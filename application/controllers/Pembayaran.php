<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('M_pembayaran');
    }

    public function detail_pembayaran($id)
    {
        $data['pembayaran'] = $this->M_pembayaran->get_pembayaran_by_id($id);
    }

    public function simpan_pembayaran()
    {
        $data = array(
            'id_permohonan' => $this->input->post('id_permohonan'),
            'nama' => $this->input->post('nama'),
            'email' => $this->input->post('email'),
        );

        $this->M_pembayaran->insert_pembayaran($data);
        redirect('menu/daftar_pembayaran');
    }

    // ... method lainnya untuk update dan delete
}
