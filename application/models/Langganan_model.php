<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Langganan_model extends CI_Model
{
    public function getData()
    {
        return $this->db->get_where('pengaduan', ['instansi_id' => $this->user['id']])->result_array();
    }

    public function getLangganan()
    {
        $this->db->select('
        langganan.id, 
        langganan.id_user, 
        langganan.tanggal_mulai, 
        langganan.tanggal_berakhir, 
        langganan.status, 
        paket_layanan.nama_paket, 
        paket_layanan.harga_paket, 
        user.nama_instansi, 
        user.email, 
        user.username
    ');
        $this->db->from('langganan');
        $this->db->join('paket_layanan', 'langganan.id_paket_layanan = paket_layanan.id');
        $this->db->join('user', 'langganan.id_user = user.id'); // Menambahkan JOIN dengan tabel user

        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return [];
        }
    }

    public function getLanggananById($id)
    {
        $this->db->select('langganan.*, paket_layanan.nama_paket, paket_layanan.harga_paket, user.username');
        $this->db->from('langganan');
        $this->db->join('paket_layanan', 'langganan.id_paket_layanan = paket_layanan.id');
        $this->db->join('user', 'langganan.id_user = user.id');
        $this->db->where('langganan.id', $id);

        return $this->db->get()->row_array();
    }
}
