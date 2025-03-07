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
                                    <div class="col-lg-5 d-block d-lg-block">
                                        <img src="<?= base_url(); ?>/assets/img/iconplus.jpg" class="m-1" style="width: 122%; height: 100%;" alt="Icon Plus">
                                    </div>
                                    <div class="col-lg-7">
                                        <div class="p-5">
                                            <div class="text-center">
                                                <h1 class="h4 text-gray-900 my-2">Hi NetICON, Silahkan login ke akun anda</h1>
                                            </div>
                                            <!-- Show Flash_msg -->
                                            <?= $this->session->flashdata('message') ?>

                                            <!-- Form login -->
                                            <?= form_open('', ['class' => 'user']); ?>
                                            <div class="form-group">
                                                <input type="text" name="username" class="form-control form-control-user <?= form_error('username') ? 'is-invalid border-left-danger' : 'border-left-primary' ?>" value="<?= set_value('username') ?>" placeholder="Username">
                                                <div class="invalid-feedback">
                                                    <?= form_error('username') ?>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <input type="password" name="pass" class="form-control form-control-user <?= form_error('pass') ? 'is-invalid border-left-danger' : 'border-left-primary' ?>" placeholder="Password">
                                                <div class="invalid-feedback">
                                                    <?= form_error('pass') ?>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Login
                                            </button>
                                            <div class="text-center mt-3">
                                                <a class="small" href="<?= base_url('auth/register') ?>">Belum punya akun? Register!</a>
                                            </div>
                                            <?= form_close(); ?>
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