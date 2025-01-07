<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Invoice_model extends CI_Model
{
    public function getInvoice()
    {
        $this->db->select('invoice.*, langganan.id_user, langganan.tanggal_mulai, langganan.tanggal_berakhir, paket_layanan.nama_paket, paket_layanan.harga_paket');
        $this->db->from('invoice');
        $this->db->join('langganan', 'invoice.id_langganan = langganan.id');
        $this->db->join('paket_layanan', 'langganan.id_paket_layanan = paket_layanan.id');
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return [];
        }
    }

    // Fungsi untuk mengambil nama instansi berdasarkan id_user
    public function get_instansi_name($id_user)
    {
        $this->db->select('nama_instansi');
        $this->db->from('user');
        $this->db->where('id', $id_user);
        $query = $this->db->get();

        if ($query->num_rows() > 0) {
            return $query->row()->nama_instansi;
        } else {
            return 'Nama Instansi Tidak Ditemukan';
        }
    }

    public function get_metode_pembayaran($id_invoice)
    {
        $this->db->select('metode_pembayaran');
        $this->db->from('pembayaran');
        $this->db->where('id_invoice', $id_invoice);
        $query = $this->db->get();
        return $query->row() ? $query->row()->metode_pembayaran : '-';
    }

    public function get_upload_bukti($id_invoice)
    {
        $this->db->select('upload_bukti');
        $this->db->from('pembayaran');
        $this->db->where('id_invoice', $id_invoice);
        $query = $this->db->get();
        $result = $query->row();
        return $result ? '<a href="' . base_url('uploads/' . $result->upload_bukti) . '" target="_blank">Lihat Bukti</a>' : '-';
    }
}
