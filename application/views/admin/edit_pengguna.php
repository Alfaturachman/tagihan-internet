<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow-sm">
                <div class="card-header badge-primary">
                    <h3 class="mt-2"><?= $judul; ?></h3>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('admin/edit_pelanggan/' . $pengguna['id']); ?>" method="post">
                        <div class="form-group">
                            <label for="nama_instansi">Nama Instansi</label>
                            <input type="text" class="form-control" id="nama_instansi" name="nama_instansi" value="<?= set_value('nama_instansi', $pengguna['nama_instansi']); ?>">
                            <?= form_error('nama_instansi', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= set_value('email', $pengguna['email']); ?>">
                            <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea class="form-control" id="alamat" name="alamat"><?= set_value('alamat', $pengguna['alamat']); ?></textarea>
                            <?= form_error('alamat', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= set_value('username', $pengguna['username']); ?>">
                            <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <div class="form-group">
                            <label for="pass1">Password (Kosongkan jika tidak ingin mengubah)</label>
                            <input type="password" class="form-control" id="pass1" name="pass1">
                            <?= form_error('pass1', '<small class="text-danger">', '</small>'); ?>
                        </div>
                        <a href="<?= base_url('data-pelanggan'); ?>" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>