    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-light">
                <div class="text-left">
                  <button type="button" class="btn btn-sm btn-outline-primary" onclick="add_user()" title="Add Data"><i class="fas fa-plus"></i> Tambah User</button>
                  <a href="<?php echo base_url('user/download') ?>" type="button" class="btn btn-sm btn-outline-info" target="_blank" id="dwn_user" title="Download"><i class="fas fa-download"></i> Download</a>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabeluser" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr class="bg-info text-center">
                      <th>No</th>
                      <th>Nama Lengkap</th>
                      <th>Program Studi</th>
                      <th>Username</th>
                      <th>Hak Akses</th>
                      <th>Status</th>
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>

    <script type="text/javascript">
      var save_method; //for save method string
      var table;

      $(document).ready(function() {

        table = $("#tabeluser").DataTable({
          "responsive": true,
          "autoWidth": false,
          "language": {
            "sEmptyTable": "Data User Belum Ada"
          },
          "processing": true, //Feature control the processing indicator.
          "serverSide": true, //Feature control DataTables' server-side processing mode.
          "order": [], //Initial no order.

          // Load data for the table's content from an Ajax source
          "ajax": {
            "url": "<?php echo site_url('user/ajax_list') ?>",
            "type": "POST"
          },
          //Set column definition initialisation properties.
          "columnDefs": [{
              "targets": [0, 1, 2, 3, 4, 5, 6],
              "className": 'text-center'
            }, {
              "targets": [-1], //last column
              "render": function(data, type, row) {
                if (row[5] == "N") {
                  return "<div class=\"d-inline mx-1\"><a class=\"btn btn-xs btn-outline-primary\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit_user(" + row[6] + ")\"><i class=\"fas fa-edit\"></i> Ubah</a></div> <div class=\"d-inline mx-1\"><a class=\"btn btn-xs btn-outline-danger\" href=\"javascript:void(0)\" title=\"Delete\"  onclick=\"deluser(" + row[6] + ")\"><i class=\"fas fa-trash\"></i> Hapus</a></div>"
                } else {
                  return "<div class=\"d-inline mx-1\"><a class=\"btn btn-xs btn-outline-primary\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit_user(" + row[6] + ")\"><i class=\"fas fa-edit\"></i> Ubah</a></div> <div class=\"d-inline mx-1\"><a class=\"btn btn-xs btn-outline-warning\" href=\"javascript:void(0)\" title=\"Reset Password\" onclick=\"riset(" + row[6] + ")\"><i></i> Reset Password</a></div>";
                }
              },
              "orderable": false, //set not orderable
            }, {
              "targets": [-2], //last column
              "render": function(data, type, row) {
                if (row[5] == "N") {
                  return "<div class=\"badge bg-danger text-white text-wrap\">Non-Aktif</div>"
                } else {
                  return "<div class=\"badge bg-success text-white text-wrap\">Aktif</div>";
                }
              }
            }, {
              "searchable": false,
              "orderable": false,
              "targets": 0
            }
            // {
            //   "targets": [0],
            //   "render": function(data , type , row){
            //     if (row[0]!=null) {
            //       return "<img class=\"myImgx\"  src='<?php echo base_url("assets/foto/user/"); ?>"+row[0]+"' width=\"100px\" height=\"100px\">";
            //     }else{
            //       return "<img class=\"myImgx\"  src='<?php echo base_url("assets/foto/default-150x150.png"); ?>' width=\"100px\" height=\"100px\">";
            //     }
            //   }
            // },
          ],

        });
        $("input").change(function() {
          $(this).parent().parent().removeClass('has-error');
          $(this).next().empty();
          $(this).removeClass('is-invalid');
        });
        $("textarea").change(function() {
          $(this).parent().parent().removeClass('has-error');
          $(this).next().empty();
          $(this).removeClass('is-invalid');
        });
        $("select").change(function() {
          $(this).parent().parent().removeClass('has-error');
          $(this).next().empty();
          $(this).removeClass('is-invalid');
        });
      });

      function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
      }

      const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
      });

      // Button Tabel

      function riset(id) {

        Swal.fire({
          title: 'Anda Yakin Ingin Mengatur Ulang Password ?',
          text: "Default Password : password123",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Atur Ulang Password!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url: "<?php echo site_url('user/reset'); ?>",
              type: "POST",
              data: "id=" + id,
              cache: false,
              dataType: 'json',
              success: function(respone) {
                if (respone.status == true) {
                  reload_table();
                  Swal.fire({
                    icon: 'success',
                    title: 'Password Berhasil Diatur Ulang!',
                  });
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: 'Reset password Error!!.'
                  });
                }
              }
            });
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal(
              'Cancelled',
              'Your imaginary file is safe :)',
              'error'
            )
          }
        })
      }

      //delete
      function deluser(id) {
        Swal.fire({
          title: 'Konfirmasi Hapus User',
          text: "Apakah Anda Yakin Ingin Menghapus User Ini ?",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Ya, Hapus User Ini!',
          cancelButtonText: 'Batal'
        }).then((result) => {
          if (result.value) {
            $.ajax({
              url: "<?php echo site_url('user/delete'); ?>",
              type: "POST",
              data: "id=" + id,
              cache: false,
              dataType: 'json',
              success: function(respone) {
                if (respone.status == true) {
                  reload_table();
                  Swal.fire({
                    icon: 'success',
                    title: 'Data User Berhasil Dihapus!'
                  });
                } else {
                  Toast.fire({
                    icon: 'error',
                    title: 'Delete Error!!.'
                  });
                }
              }
            });
          } else if (result.dismiss === Swal.DismissReason.cancel) {
            Swal(
              'Cancelled',
              'Your imaginary file is safe :)',
              'error'
            )
          }
        })
      }

      function add_user() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah User'); // Set Title to Bootstrap modal title
      }

      function edit_user(id) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
          url: "<?php echo site_url('user/edituser') ?>/" + id,
          type: "GET",
          dataType: "JSON",
          success: function(data) {
            $('[name="id_prodi"]').val(data.id_prodi);
            $('[name="id_user"]').val(data.id_user);
            $('[name="username"]').val(data.username);
            $('[name="full_name"]').val(data.full_name);
            $('[name="is_active"]').val(data.is_active);
            $('[name="level"]').val(data.id_level);

            if (data.image == null) {
              var image = "<?php echo base_url('assets/foto/user/default.png') ?>";
              $("#v_image").attr("src", image);
            } else {
              var image = "<?php echo base_url('assets/foto/user/') ?>";
              $("#v_image").attr("src", image + data.image);
            }

            $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
            $('.modal-title').text('Ubah User'); // Set title to Bootstrap modal title

          },
          error: function(jqXHR, textStatus, errorThrown) {
            alert('Error get data from ajax');
          }
        });
      }

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

      var loadFile = function(event) {
        var image = document.getElementById('v_image');
        image.src = URL.createObjectURL(event.target.files[0]);
      };

      function batal() {
        $('#form')[0].reset();
        reload_table();
        var image = document.getElementById('v_image');
        image.src = "";
      }
    </script>


    <!-- Bootstrap modal -->
    <div class="modal fade" id="modal_form" role="dialog" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h3 class="modal-title">User Form</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>

          </div>
          <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
            <!-- <?php echo form_open_multipart('', array('class' => 'form-horizontal', 'id' => 'form')) ?> -->
            <input type="hidden" value="" name="id_user" />
            <div class="card-body">
              <div class="form-group row ">
                <label for="id_prodi" class="col-sm-4 col-form-label">Program Studi</label>
                <div class="col-sm-8 kosong">
                  <select class="form-control" name="id_prodi" id="id_prodi">
                    <option value="" selected disabled>Pilih Program Studi</option>
                    <?php
                    foreach ($programStudi as $prodi) { ?>
                      <option value="<?= $prodi->id_prodi; ?>"><?= $prodi->nama_prodi; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row ">
                <label for="username" class="col-sm-4 col-form-label">Username</label>
                <div class="col-sm-8 kosong">
                  <input type="text" class="form-control" name="username" id="username" placeholder="contoh : johndoe">
                </div>
              </div>
              <div class="form-group row ">
                <label for="full_name" class="col-sm-4 col-form-label">Nama Lengkap</label>
                <div class="col-sm-8 kosong">
                  <input type="text" class="form-control" name="full_name" id="full_name" placeholder="contoh : John Doe">
                </div>
              </div>

              <div class="form-group row ">
                <label for="password" class="col-sm-4 col-form-label">Password</label>
                <div class="col-sm-8 kosong">
                  <input type="password" class="form-control " name="password" id="password">
                </div>
              </div>

              <div class="form-group row ">
                <label for="is_active" class="col-sm-4 col-form-label">Status</label>
                <div class="col-sm-8 kosong">
                  <select class="form-control" name="is_active" id="is_active">
                    <option value="" selected disabled>Pilih Status</option>
                    <option value="Y">Aktif</option>
                    <option value="N">Non-Aktif</option>
                  </select>
                </div>
              </div>
              <div class="form-group row ">
                <label for="level" class="col-sm-4 col-form-label">Hak Akses</label>
                <div class="col-sm-8 kosong">
                  <select class="form-control" name="level" id="level">
                    <option value="" selected disabled>Pilih Hak Akses</option>
                    <?php
                    foreach ($user_level as $level) { ?>
                      <option value="<?= $level->id_level; ?>"><?= $level->nama_level; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row ">
                <label for="imagefile" class="col-sm-4 col-form-label">Foto</label>
                <div class="col-sm-8">
                  <img id="v_image" width="100px" height="100px">
                  <input type="file" class="form-control btn-file" onchange="loadFile(event)" name="imagefile" id="imagefile" placeholder="Image" value="UPLOAD">
                </div>
              </div>
            </div>
            <!-- <?php echo form_close(); ?> -->
          </form>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-danger" onclick="batal()" data-dismiss="modal">Batal</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->