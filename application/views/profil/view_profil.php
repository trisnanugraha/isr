<script>
    $(document).ready(function() {
        $("input").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
            $(this).removeClass('is-invalid');
        });
    });

    function save() {
        $('#btnSave').text('saving...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url;
        if (save_method == 'add') {
            url = "<?php echo site_url('user/insert') ?>";
        } else {
            url = "<?php echo site_url('user/update') ?>";
        }
        var formdata = new FormData($('#form')[0]);
        $.ajax({
            url: url,
            type: "POST",
            data: formdata,
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,
            success: function(data) {

                if (data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    reload_table();
                    if (save_method == 'add') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data User Berhasil Disimpan!'
                        });
                    } else if (save_method == 'update') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data User Berhasil Diubah!'
                        });
                    }
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
                        $('[name="' + data.inputerror[i] + '"]').closest('.kosong').append('<span></span>');
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]).addClass('invalid-feedback');
                    }
                }
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 


            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert(textStatus);
                // alert('Error adding / update data');
                Toast.fire({
                    icon: 'error',
                    title: 'Error!!.'
                });
                $('#btnSave').text('Simpan'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            }
        });
    }
</script>
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header p-2">
                        <ul class="nav nav-pills">
                            <li class="nav-item"><a class="nav-link active" href="#info" data-toggle="tab">Informasi Akun</a></li>
                            <li class="nav-item"><a class="nav-link" href="#password" data-toggle="tab">Keamanan</a></li>
                        </ul>
                    </div><!-- /.card-header -->
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="info">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <div class="col-sm-12 kosong">
                                            <label for="namalengkap">Nama Lengkap</label>
                                            <input type="text" class="form-control" id="namalengkap" placeholder="Nama Lengkap Anda" value="<?php echo $fullname; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-offset-2 col-sm-12 kosong">
                                            <label for="username">Username</label>
                                            <input type="text" class="form-control" id="username" placeholder="Username Anda" value="<?php echo $username; ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-offset-2 col-sm-12">
                                            <label for="prodi">Program Studi</label>
                                            <input type="text" class="form-control" id="prodi" placeholder="Program Studi" value="<?php echo $prodi; ?>" disabled>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" onclick="save()" class="btn btn-success">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="tab-pane" id="password">
                                <form class="form-horizontal">
                                    <div class="form-group">
                                        <div class="col-offset-2 col-sm-12">
                                            <label for="currentpass">Password Lama</label>
                                            <input type="password" class="form-control" id="currentpass" placeholder="Masukkan password lama Anda">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-offset-2 col-sm-12">
                                            <label for="newpass">Password Baru</label>
                                            <input type="password" class="form-control" id="newpass" placeholder="Masukkan password baru Anda">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-offset-2 col-sm-12">
                                            <label for="confpass">Konfirmasi Password</label>
                                            <input type="password" class="form-control" id="confpass" placeholder="Konfirmasi password baru Anda">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button type="submit" class="btn btn-success">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>