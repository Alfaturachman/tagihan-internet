<div class="container-fluid">
    <div class="row">
        <div class="col">
            <div class="card shadow-sm">
                <div class="card-header badge-primary">
                    <h4 class="mt-2"><?= $judul; ?></h4>
                </div>
                <div class="card-body">
                    <form action="<?= base_url('langganan/tambah_langganan'); ?>" method="post">
                        <div class="form-group">
                            <label for="id_user">Pilih Pengguna</label>
                            <select class="form-control" id="id_user" name="id_user">
                                <option value="">- Pilih Pengguna -</option>
                                <?php foreach ($user as $user): ?>
                                    <option value="<?= $user->id ?>" <?= set_select('id_user', $user->id); ?>>
                                        <?= $user->nama_instansi ?> (<?= $user->username ?>)
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('id_user', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Dropdown untuk memilih paket layanan -->
                        <div class="form-group">
                            <label for="id_paket_layanan">Pilih Paket Layanan</label>
                            <select class="form-control" id="id_paket_layanan" name="id_paket_layanan">
                                <option value="">- Pilih Paket Layanan -</option>
                                <?php foreach ($paket_layanan as $paket): ?>
                                    <option value="<?= $paket->id ?>" <?= set_select('id_paket_layanan', $paket->id); ?>>
                                        <?= $paket->nama_paket ?> - Rp <?= number_format($paket->harga_paket, 0, ',', '.'); ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <?= form_error('id_paket_layanan', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Input tanggal mulai -->
                        <div class="form-group">
                            <label for="tanggal_mulai">Tanggal Mulai</label>
                            <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" value="<?= set_value('tanggal_mulai'); ?>">
                            <?= form_error('tanggal_mulai', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Input tanggal berakhir -->
                        <div class="form-group">
                            <label for="tanggal_berakhir">Tanggal Berakhir</label>
                            <input type="date" class="form-control" id="tanggal_berakhir" name="tanggal_berakhir" value="<?= set_value('tanggal_berakhir'); ?>">
                            <?= form_error('tanggal_berakhir', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <!-- Select untuk status langganan -->
                        <div class="form-group">
                            <label for="status">Status Langganan</label>
                            <select class="form-control" id="status" name="status">
                                <option value="Aktif" <?= set_select('status', 'Aktif'); ?>>Aktif</option>
                                <option value="Tidak Aktif" <?= set_select('status', 'Tidak Aktif'); ?>>Tidak Aktif</option>
                                <option value="Ditangguhkan" <?= set_select('status', 'Ditangguhkan'); ?>>Ditangguhkan</option>
                            </select>
                            <?= form_error('status', '<small class="text-danger">', '</small>'); ?>
                        </div>

                        <a href="<?= base_url('data-langganan'); ?>" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Tambah Langganan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>