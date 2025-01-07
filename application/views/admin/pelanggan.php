<div class="container-fluid">
    <div class="row">
        <div class="col-12 d-flex justify-content-between">
            <h3 class="h3 mb-2 mt-1 text-gray-900"><i class="fa fa-fw fa-users"></i> <?= $judul; ?></h3>
            <a href="<?= base_url('tambah-pengguna'); ?>" class="btn btn-primary mb-3">Tambah Pelanggan</a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="table-pelanggan" class="table table-striped display" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>ID Pelanggan</th>
                                    <th>Nama Instansi</th>
                                    <th>Email</th>
                                    <th>Alamat</th>
                                    <th>Username</th>
                                    <th>Role</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pelanggan as $p) : ?>
                                    <tr>
                                        <td><?= $p->id; ?></td>
                                        <td><?= $p->nama_instansi; ?></td>
                                        <td><?= $p->email; ?></td>
                                        <td><?= $p->alamat; ?></td>
                                        <td><?= $p->username; ?></td>
                                        <td><?= $p->role; ?></td>
                                        <td>
                                            <a href="<?= base_url('edit-pelanggan/' . $p->id); ?>" class="btn btn-sm btn-warning">Edit</a>

                                            <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#hapusModal" data-id="<?= $p->id; ?>" data-nama="<?= $p->nama_instansi; ?>">Hapus</button>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Hapus -->
<div class="modal fade" id="hapusModal" tabindex="-1" role="dialog" aria-labelledby="hapusModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header badge-danger">
                <h5 class="modal-title" id="hapusModalLabel">Hapus Data Pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                Apakah Anda yakin ingin menghapus data pelanggan <strong id="namaPelanggan"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a href="#" id="btnHapusPelanggan" class="btn btn-danger">Hapus</a>
            </div>
        </div>
    </div>
</div>

<script>
    $('#hapusModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Tombol Hapus yang ditekan
        var id = button.data('id'); // Mengambil ID pelanggan
        var nama = button.data('nama'); // Mengambil nama pelanggan

        // Set Nama Pelanggan di modal
        var modal = $(this);
        modal.find('#namaPelanggan').text(nama);
        modal.find('#btnHapusPelanggan').attr('href', '<?= base_url('hapus-pelanggan/'); ?>' + id);
    });
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