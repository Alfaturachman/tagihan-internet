<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class Report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        // Pastikan model dimuat
        $this->load->model('Invoice_model');
    }

    public function invoiceById($invoice_id)
    {
        // Validasi ID Invoice
        if (!$invoice_id) {
            show_error("ID Invoice tidak ditemukan", 404);
        }

        // Ambil data invoice dan pembayaran
        $invoice = $this->Invoice_model->getInvoiceById($invoice_id);
        $pembayaran = $this->Invoice_model->getPembayaranByInvoiceId($invoice_id);

        // Validasi data
        if (!$invoice) {
            show_error("Data invoice tidak ditemukan", 404);
        }

        $data = [
            'invoice' => $invoice,
            'pembayaran' => $pembayaran
        ];

        // Inisialisasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);

        // Muat view dan simpan sebagai string HTML
        $html = $this->load->view('report/laporan_pdf', $data, true);

        // Load HTML ke Dompdf
        $dompdf->loadHtml($html);

        // Set ukuran kertas (A4 sebagai contoh)
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Output PDF ke browser
        $dompdf->stream("invoice_" . $invoice->invoice . ".pdf", array("Attachment" => 1));
    }
}
