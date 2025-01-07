<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pembayaran extends CI_Model {

    private $table = 'pembayaran'; // Nama tabel di database

    public function __construct() {
        parent::__construct();
        $this->load->database(); // Load library database
    }

    public function get_pembayaran_by_id($id_permohonan) {
        $this->db->where('id_permohonan', $id_permohonan);
        $query = $this->db->get($this->table);
        return $query->row_array(); // Mengembalikan data dalam bentuk array asosiatif
    }

    public function insert_pembayaran($data) {
        return $this->db->insert($this->table, $data);
    }

    public function update_pembayaran($id_permohonan, $data) {
        $this->db->where('id_permohonan', $id_permohonan);
        return $this->db->update($this->table, $data);
    }

    public function delete_pembayaran($id_permohonan) {
        $this->db->where('id_permohonan', $id_permohonan);
        return $this->db->delete($this->table);
    }

    public function get_all_pembayaran() {
        $query = $this->db->get($this->table);
        return $query->result_array(); // Mengembalikan semua data dalam bentuk array asosiatif
    }
}