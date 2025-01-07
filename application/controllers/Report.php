<?php
defined('BASEPATH') or exit('No direct script access allowed');

use Dompdf\Dompdf;
use Dompdf\Options;

class Report extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function generate_pdf()
    {
        // Inisialisasi Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);

        $dompdf = new Dompdf($options);

        // Muat view dan simpan sebagai string HTML
        $html = $this->load->view('cetak_pdf', [], true);

        // Load HTML ke dompdf
        $dompdf->loadHtml($html);

        // Set ukuran kertas (A4 sebagai contoh)
        $dompdf->setPaper('A4', 'portrait');

        // Render PDF
        $dompdf->render();

        // Output PDF ke browser
        $dompdf->stream("generated_pdf.pdf", array("Attachment" => 1));
    }
}
