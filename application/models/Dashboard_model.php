<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard_model extends CI_Model
{
    public function getTotalUser()
    {
        return $this->db->count_all('user');
    }

    public function getTotalLangganan()
    {
        return $this->db->count_all('langganan');
    }

    public function getLanggananByUserId($user_id)
    {
        $this->db->select('langganan.*, paket_layanan.nama_paket, paket_layanan.harga_paket');
        $this->db->from('langganan');
        $this->db->join('paket_layanan', 'langganan.id_paket_layanan = paket_layanan.id');
        $this->db->where('langganan.id_user', $user_id);
        $query = $this->db->get();
        return $query->result();
    }

    public function getTotalInvoice()
    {
        return $this->db->count_all('invoice');
    }

    public function getTotalByStatus($status)
    {
        $this->db->where('status', $status);
        return $this->db->count_all_results('invoice');
    }

    public function getTotalLanggananByUser($user_id, $status = null)
    {
        $this->db->where('id_user', $user_id);
        if ($status) {
            $this->db->where('status', $status);
        }
        return $this->db->count_all_results('langganan');
    }

    public function getTotalInvoiceByUser($user_id)
    {
        $this->db->join('langganan', 'langganan.id = invoice.id_langganan');
        $this->db->where('langganan.id_user', $user_id);
        return $this->db->count_all_results('invoice');
    }

    public function getTotalByStatusAndUser($user_id, $status)
    {
        $this->db->join('langganan', 'langganan.id = invoice.id_langganan');
        $this->db->where('langganan.id_user', $user_id);
        $this->db->where('invoice.status', $status);
        return $this->db->count_all_results('invoice');
    }
}
