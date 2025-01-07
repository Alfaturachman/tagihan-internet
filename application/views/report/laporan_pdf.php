<!DOCTYPE html>
<html>

<head>
    <title>Cetak Invoice</title>
    <style>
        body {
            font-family: arial, sans-serif;
            margin: 1cm 1cm 1cm 1cm;
        }

        h2 {
            margin-top: auto;
            text-align: center;
            left: 0px;
            right: 0px;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            padding: 4px;
            text-align: center;
        }

        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>
</head>

<body>

    <h2>Invoice #<?= $invoice->invoice; ?></h2>

    <div class="cetak">
        Tanggal di cetak: <?= date('d/m/Y'); ?>
    </div>

    <table>
        <tr>
            <th style="width: 6%">No.</th>
            <th style="width: 20%">Nama Paket</th>
            <th style="width: 20%">Tanggal Invoice</th>
            <th style="width: 20%">Total Harga</th>
            <th style="width: 20%">Status</th>
        </tr>

        <tr>
            <td style="width: 6%">1</td>
            <td style="width: 20%"><?= $invoice->nama_paket; ?></td>
            <td style="width: 20%"><?= $invoice->tanggal_invoice; ?></td>
            <td style="width: 20%">Rp. <?= number_format($invoice->total_harga, 0, ',', '.'); ?></td>
            <td style="width: 20%"><?= $invoice->status; ?></td>
        </tr>
    </table>

    <h3>Detail Pembayaran</h3>

    <table>
        <tr>
            <th style="width: 10%">No.</th>
            <th style="width: 30%">Metode Pembayaran</th>
            <th style="width: 20%">Total Bayar</th>
            <th style="width: 20%">Tanggal Bayar</th>
            <th style="width: 20%">Bukti Pembayaran</th>
        </tr>

        <?php if (!empty($pembayaran)) : ?>
            <?php foreach ($pembayaran as $num => $payment) : ?>
                <tr>
                    <td style="width: 10%"><?= $num + 1 ?></td>
                    <td style="width: 30%"><?= $payment->metode_pembayaran; ?></td>
                    <td style="width: 20%">Rp. <?= number_format($payment->total_bayar, 0, ',', '.'); ?></td>
                    <td style="width: 20%"><?= $payment->tanggal_bayar; ?></td>
                    <td style="width: 20%"><a href="<?= base_url('uploads/' . $payment->upload_bukti); ?>" target="_blank">Lihat Bukti</a></td>
                </tr>
            <?php endforeach; ?>
        <?php else : ?>
            <tr>
                <td colspan="5">Belum ada pembayaran untuk invoice ini.</td>
            </tr>
        <?php endif; ?>
    </table>

</body>

</html>