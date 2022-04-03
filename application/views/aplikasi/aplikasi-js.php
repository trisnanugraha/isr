<script type="text/javascript">
    var save_method; //for save method string
    var table;

    $(document).ready(function() {

        //datatables
        table = $("#tabelaplikasi").DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "sEmptyTable": "Data Aplikasi Belum Ada"
            },
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('aplikasi/ajax_list') ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                    "targets": [0, 1, 2, 3, 4, 5],
                    "className": 'text-center'
                },
                {
                    "targets": [-1], //last column
                    "render": function(data, type, row) {

                        return "<div class=\"d-inline mx-1\"><a class=\"btn btn-xs btn-outline-primary\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit_aplikasi(" + row[5] + ")\"><i class=\"fas fa-edit\"></i> Ubah</a></div>";

                    },

                    "orderable": false, //set not orderable
                },
                // {
                //   "targets": [8],
                //   "render": function(data, type, row) {
                //     if (row[8] != null) {
                //       return "<img class=\"myImgx\"  src='<?php echo base_url("assets/foto/logo/"); ?>" + row[8] + "' width=\"100px\" height=\"100px\">";
                //     } else {
                //       return "<img class=\"myImgx\"  src='<?php echo base_url("assets/foto/logo/Logo.png"); ?>' width=\"100px\" height=\"100px\">";
                //     }
                //   }
                // },
            ],
        });

        //set input/textarea/select event when change value, remove class error and remove text help block 
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
    })

    function edit_aplikasi(id) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('aplikasi/edit_aplikasi') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id"]').val(data.id);
                $('[name="nama_owner"]').val(data.nama_owner);
                $('[name="alamat"]').val(data.alamat);
                $('[name="tlp"]').val(data.tlp);
                $('[name="title"]').val(data.title);
                $('[name="nama_aplikasi"]').val(data.nama_aplikasi);
                $('[name="copy_right"]').val(data.copy_right);
                $('[name="tahun"]').val(data.tahun);
                $('[name="versi"]').val(data.versi);
                if (data.logo == null) {
                    var image = "<?php echo base_url('assets/foto/logo/Logo.png') ?>";
                    $("#v_image").attr("src", image);
                } else {
                    var image = "<?php echo base_url('assets/foto/logo/') ?>";
                    $("#v_image").attr("src", image + data.logo);
                }
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Ubah Informasi Aplikasi'); // Set title to Bootstrap modal title

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function save() {
        $('#btnSave').text('Menyimpan...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url = "<?php echo site_url('aplikasi/update') ?>";
        var formdata = new FormData($('#form')[0]);
        // ajax adding data to database
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
                    Toast.fire({
                        icon: 'success',
                        title: 'Data Informasi Aplikasi Berhasil Diubah!'
                    });
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '"]').addClass('is-invalid');
                        $('[name="' + data.inputerror[i] + '"]').next().text(data.error_string[i]).addClass('invalid-feedback');
                    }
                }
                $('#btnSave').text('Simpan'); //change button text
                $('#btnCancel').text('Batal'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 


            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error adding / update data');
                $('#btnSave').text('Simpan'); //change button text
                $('#btnCancel').text('Batal'); //change button text
                $('#btnSave').attr('disabled', false); //set button enable 

            }
        });
    }
    var loadFile = function(event) {
        var image = document.getElementById('v_image');
        image.src = URL.createObjectURL(event.target.files[0]);
    };
</script>