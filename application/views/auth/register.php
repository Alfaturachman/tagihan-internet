<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?= $judul; ?></title>

    <!-- Custom fonts for this template-->
    <link href="<?= base_url('assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="<?= base_url('assets/'); ?>css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= base_url('assets/'); ?>css/custom.css" rel="stylesheet">

</head>

<body class="bg-gradient-primary">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-10 col-lg-12 col-md-9">
                <div class="card o-hidden border-0 shadow-lg my-5 mx-auto" style="width: 90%;">
                    <div class="card-body p-3">
                        <div class="card o-hidden border-0 shadow-lg">
                            <div class="card-body p-0">
                                <div class="row">
                                    <div class="col-lg-5">
                                        <img src="<?= base_url(); ?>/assets/img/iconplus.jpg" class="m-1" style="width: 122%; height: 100%;" alt="Icon Plus">
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="p-5">
                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900 mb-4">Buat Akun Baru</h1>
                                            </div>
                                            <?= $this->session->flashdata('message') ?>
                                            <?= form_open('auth/register'); ?>
                                            <div class="form-group">
                                                <input type="text" name="nama_instansi" class="form-control form-control-user <?= form_error('nama_instansi') ? 'is-invalid border-left-danger' : 'border-left-primary' ?>" placeholder="Nama Instansi" value="<?= set_value('nama_instansi') ?>">
                                                <div class="invalid-feedback">
                                                    <?= form_error('nama_instansi') ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="email" class="form-control form-control-user <?= form_error('email') ? 'is-invalid border-left-danger' : 'border-left-primary' ?>" placeholder="Email" value="<?= set_value('email') ?>">
                                                <div class="invalid-feedback">
                                                    <?= form_error('email') ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <textarea name="alamat" class="form-control form-control-user <?= form_error('alamat') ? 'is-invalid border-left-danger' : 'border-left-primary' ?>" placeholder="Alamat"><?= set_value('alamat') ?></textarea>
                                                <div class="invalid-feedback">
                                                    <?= form_error('alamat') ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="text" name="username" class="form-control form-control-user <?= form_error('username') ? 'is-invalid border-left-danger' : 'border-left-primary' ?>" placeholder="Username" value="<?= set_value('username') ?>">
                                                <div class="invalid-feedback">
                                                    <?= form_error('username') ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password1" class="form-control form-control-user <?= form_error('password1') ? 'is-invalid border-left-danger' : 'border-left-primary' ?>" placeholder="Password">
                                                <div class="invalid-feedback">
                                                    <?= form_error('password1') ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="password2" class="form-control form-control-user <?= form_error('password2') ? 'is-invalid border-left-danger' : 'border-left-primary' ?>" placeholder="Konfirmasi Password">
                                                <div class="invalid-feedback">
                                                    <?= form_error('password2') ?>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">Daftar</button>
                                            <?= form_close(); ?>
                                            <div class="text-center mt-3">
                                                <a class="small" href="<?= base_url('auth'); ?>">Sudah punya akun? Login!</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>