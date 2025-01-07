<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Controller {

    // ... (kode lain di controller Anda)

    public function read_data_pelanggan() {
        $this->load->model('Pelanggan_model'); // Load model

        $list = $this->Pelanggan_model->get_datatables();
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $pelanggan) {
            $no++;
            $row = array();
            $row[] = $pelanggan->nama_pelanggan;
            $row[] = $pelanggan->alamat;
            $row[] = $pelanggan->id_pelanggan; // Pastikan ini ada di database
            $row[] = $pelanggan->tanggal_pembayaran;
            $row[] = $pelanggan->paket_layanan;
            $row[] = $pelanggan->jumlah_tagihan;

            // Tombol Detail dan Hapus (penting!)
            $row[] = '<a href="#" class="btn btn-sm btn-info btn-detail" 
                        data-id="' . $pelanggan->id_pelanggan . '"
                        data-nama="' . $pelanggan->nama_pelanggan . '"
                        data-alamat="' . $pelanggan->alamat . '"
                        data-id_pelanggan="' . $pelanggan->id_pelanggan . '"
                        data-tanggal_pembayaran="' . $pelanggan->tanggal_pembayaran . '"
                        data-paket_layanan="' . $pelanggan->paket_layanan . '"
                        data-jumlah_tagihan="' . $pelanggan->jumlah_tagihan . '"
                        data-toggle="modal" data-target="#detail-pelanggan">Detail</a>
                      <a href="#" class="btn btn-sm btn-danger btn-hapus" data-id="' . $pelanggan->id_pelanggan . '" data-toggle="modal" data-target="#hapus-pelanggan">Hapus</a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->Pelanggan_model->count_all(),
            "recordsFiltered" => $this->Pelanggan_model->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    // ... (fungsi lain di controller Anda)
}