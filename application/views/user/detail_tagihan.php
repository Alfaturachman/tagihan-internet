<div class="container-fluid mb-4">
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header badge-primary">
                    <h4 class="h4 text-white m-0"></i> <?= $judul; ?></h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <tr>
                                <th style="text-align: left;">Invoice ID</th>
                                <td style="text-align: left;"><?= $invoice['id']; ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Nama Instansi</th>
                                <td style="text-align: left;"><?= $invoice['nama_instansi']; ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Email</th>
                                <td style="text-align: left;"><?= $invoice['email']; ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Alamat</th>
                                <td style="text-align: left;"><?= $invoice['alamat']; ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Paket Layanan</th>
                                <td style="text-align: left;"><?= $invoice['paket_layanan']; ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Harga Paket</th>
                                <td style="text-align: left;">Rp. <?= number_format($invoice['harga_paket'], 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Tanggal Invoice</th>
                                <td style="text-align: left;"><?= date('d-m-Y', strtotime($invoice['tanggal_invoice'])); ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Status</th>
                                <td style="text-align: left;"><?= $invoice['status']; ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Total Harga</th>
                                <td style="text-align: left;">Rp. <?= number_format($invoice['total_harga'], 0, ',', '.'); ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Tanggal Mulai</th>
                                <td style="text-align: left;"><?= date('d-m-Y', strtotime($invoice['tanggal_mulai'])); ?></td>
                            </tr>
                            <tr>
                                <th style="text-align: left;">Tanggal Berakhir</th>
                                <td style="text-align: left;"><?= date('d-m-Y', strtotime($invoice['tanggal_berakhir'])); ?></td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="<?= base_url('data-tagihan'); ?>" class="btn btn-primary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Include JS untuk DataTables -->
<script>
    $(document).ready(function() {
        $('#table-langganan').DataTable();
    });
</script>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus pengguna ini?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a href="#" id="btn-delete" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(deleteUrl) {
        // Set the correct delete URL to the button
        document.getElementById('btn-delete').href = deleteUrl;

        // Show the modal
        var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
        deleteModal.show();
    }
</script>

<!-- Footer -->
<footer class="sticky-footer bg-white">
    <div class="container my-auto">
        <div class="copyright text-center my-auto">
            <span>Copyright &copy; Skuy Ngoding - <?= date('Y'); ?></span>
        </div>
    </div>
</footer>
<!-- End of Footer -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Bootstrap core JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/'); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url('assets/'); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Datatables -->
<script src="<?= base_url('assets/') ?>vendor/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/datatables/dataTables.rowReorder.min.js"></script>
<script src="<?= base_url('assets/') ?>vendor/datatables/dataTables.responsive.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url('assets/'); ?>js/sb-admin-2.min.js"></script>

</body>

</html>