<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $judul; ?></title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #3f51b5; /* Warna biru seperti di screenshot */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
        }

        .card {
            width: 500px; /* Lebar card disesuaikan */
            padding: 20px;
        }
    </style>
</head>

<body>
    <div class="card">
        <div class="card-body">
            <h2 class="card-title text-center">Register</h2>

            <?= $this->session->flashdata('message'); ?>

            <form method="post">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" name="username" id="username" class="form-control" value="<?= set_value('username'); ?>">
                    <?= form_error('username', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" name="email" id="email" class="form-control" value="<?= set_value('email'); ?>">
                    <?= form_error('email', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <?= form_error('password', '<small class="text-danger">', '</small>'); ?>
                </div>

                <div class="form-group">
                    <label for="password2">Konfirmasi Password:</label>
                    <input type="password" name="password2" id="password2" class="form-control">
                    <?= form_error('password2', '<small class="text-danger">', '</small>'); ?>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Register</button>

                <p class="mt-3 text-center">Sudah punya akun? <a href="<?= base_url('auth'); ?>">Login</a></p>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>