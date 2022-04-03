<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?php echo $aplikasi->title; ?> | Register</title>

    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-5.5.0/css/all.min.css">
    <!-- Font Awesome -->
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/fontawesome-4.3.0/css/all.min.css"> -->
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/adminlte.min.css">
    <!-- Body style -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/dist/css/stylearyo.css">
    <!-- iCheck -->
    <!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/iCheck/square/blue.css"> -->
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/bootstrap-select/bootstrap-select.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.css">
    <style>
        .register-page {
            min-height: 1100px !important;
        }
    </style>
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="<?php echo base_url(); ?>" class="h1"><b><?php echo $aplikasi->nama_aplikasi; ?></b></a>
            </div>
            <div class="card-body register-card-body">
                <p class="login-box-msg">Daftar Akun Baru</p>

                <form action="" method="post" id="signup-form">
                    <div class="form-group">
                        <label for="judul" class="col-form-label">Nama Lengkap</label>
                        <div class="input-group kosong">
                            <input type="text" class="form-control" name="fullname" placeholder="Misal : John Doe">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="judul" class="col-form-label">Username</label>
                        <div class="input-group kosong">
                            <input type="text" class="form-control" name="username" placeholder="Misal : johndoe">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-user"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="judul" class="col-form-label">Program Studi</label>
                        <div class="kosong">
                            <select class="form-control" name="prodi">
                                <option value="" selected disabled>-- Pilih Program Studi --</option>
                                <?php
                                foreach ($programStudi as $prodi) { ?>
                                    <option value="<?= $prodi->id_prodi; ?>"><?= $prodi->nama_prodi; ?></option>
                                <?php } ?>
                            </select>
                            <div class="input-group-append"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="judul" class="col-form-label">Password</label>
                        <div class="input-group kosong">
                            <input type="password" class="form-control" name="password" placeholder="Misal : Secret@1234">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="judul" class="col-form-label">Verifikasi Password</label>
                        <div class="input-group kosong">
                            <input type="password" class="form-control" name="verifypassword" placeholder="Misal : Secret@1234">
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="judul" class="col-form-label">Hak Akses</label>
                        <div class="kosong">
                            <select class="form-control" name="level">
                                <option value="" selected disabled>-- Pilih Hak Akses --</option>
                                <?php
                                foreach ($user_level as $level) { ?>
                                    <option value="<?= $level->id_level; ?>"><?= $level->nama_level; ?></option>
                                <?php } ?>
                            </select>
                            <div class="input-group-append"></div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary btn-block" id="register">Register</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <br>
                <p class="text-center">
                    <a href="<?php echo base_url(); ?>">Saya Sudah Punya Akun</a>
                </p>
            </div>
            <div class="card-footer" style="text-align: center;">
                <b>
                    <?php
                    // foreach ($aplikasi as $apl) {
                    echo $aplikasi->copy_right . ' ' . $aplikasi->tahun . ' | ' . $aplikasi->nama_owner;
                    // }

                    ?>
                </b>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>
    <!-- /.register-box -->

    <script src="<?php echo base_url(); ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="<?php echo base_url(); ?>assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- jquery-validation -->
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/jquery.validate.min.js"></script>
    <script src="<?php echo base_url(); ?>assets/plugins/jquery-validation/additional-methods.min.js"></script>
    <!-- AdminLTE App -->
    <script src="<?php echo base_url(); ?>assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="<?php echo base_url(); ?>assets/dist/js/demo.js"></script>
    <!-- SweetAlert2 -->
    <script src="<?php echo base_url(); ?>assets/plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- Toastr -->
    <script src="<?php echo base_url(); ?>assets/plugins/toastr/toastr.min.js"></script>


    <script>
        $(document).ready(function() {
            $("input").change(function() {
                $(this).parent().parent().removeClass('has-error');
                $(this).next().next().empty();
                $(this).removeClass('is-invalid');
            });
            $("select").change(function() {
                $(this).parent().parent().removeClass('has-error');
                $(this).next().empty();
                $(this).removeClass('is-invalid');
            });
        });

        $("#register").on('click', function() {
            $.ajax({
                url: '<?php echo base_url('register/signup') ?>',
                type: 'POST',
                data: $('#signup-form').serialize(),
                dataType: 'JSON',
                success: function(data) {
                    if (data.status) {
                        $('#signup-form')[0].reset(); // reset form on modals
                        Swal.fire({
                            icon: 'success',
                            title: 'Pendaftaran Akun Berhasil!',
                            text: 'Hubungi Administrator Untuk Aktivasi Akun Anda',
                        }).then(function() {
                            var url = '<?php echo base_url() ?>';
                            window.location = url;
                        });
                    } else if (data.error) {
                        toastr.error(
                            data.pesan
                        );
                    } else {
                        for (var i = 0; i < data.inputerror.length; i++) {
                            $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
                            $('[name="' + data.inputerror[i] + '"]').closest('.kosong').append('<span></span>');
                            $('[name="' + data.inputerror[i] + '"]').next().next().text(data.error_string[i]).addClass('invalid-feedback');
                        }
                    }

                }
            });
        });
    </script>
</body>

</html>