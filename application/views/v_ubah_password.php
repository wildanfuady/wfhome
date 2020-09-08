<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Ubah Password | PT. Bumi Tirta Graha Cermerlang</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="<?= base_url('assets/template/') ?>plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="<?= base_url('assets/template/') ?>dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <div class="login-logo">
            <a href="<?= base_url('auth/login') ?>"><b>PT. Bumi Tirta</b><br/>Graha Cermerlang</a>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <?php
                $inputs = $this->session->flashdata('inputs');
                $errors = $this->session->flashdata('errors');
                if(!empty($errors)) { ?>
                <div class="row">
                    <div class="col-md-12">
                        <div class="alert alert-danger">
                            <b>Warning!</b> Something it's wrong:
                            <ul>
                            <?php foreach($errors as $key => $error) { ?>
                                <li><?= $error ?></li>
                            <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <p class="login-box-msg">Masukan password baru Anda</p>
                <?= form_open('lupa-password/new') ?>
                            
                <div class="input-group mb-3">
                    <?= form_password('password', '', ['class' => 'form-control', 'placeholder' => 'Password']) ?>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                                        
                <div class="input-group mb-3">
                    <?= form_password('confrim_password', '', ['class' => 'form-control', 'placeholder' => 'Confirmation Password']) ?>
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
            
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Ubah Password</button>
                    </div>
                </div>
                <?= form_close() ?>
                <div class="row mt-3 text-center">
                    <div class="col-md-12">
                        Sudah punya akun? <a href="<?= base_url('/') ?>">Login di sini</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="<?= base_url('assets/template/') ?>plugins/jquery/jquery.min.js"></script>
<script src="<?= base_url('assets/template/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>
