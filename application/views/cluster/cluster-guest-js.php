<script type="text/javascript">
    var save_method; //for save method string
    var table;

    $(document).ready(function() {

        table = $("#tabelkegiatan").DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "sEmptyTable": "Data Kegiatan Masih Kosong"
            },
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('kegiatan/ajax_list') ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0, 1, 2, 3],
                "className": 'text-center'
            }, {
                "searchable": false,
                "orderable": false,
                "targets": 0
            }, {
                "targets": [-1], //last column
                "render": function(data, type, row) {
                    return "<a class=\"btn btn-xs btn-outline-success\" href=\"javascript:void(0)\" title=\"Detail\" onclick=\"detail(" + row[3] + ")\"><i class=\"fas fa-eye\"></i> Detail</a>";
                },
                "orderable": false, //set not orderable
            }, ],
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

        $('#foto').change(function(e) {
            var foto = e.target.files[0].name;
            $('#label-foto').html(foto);
        });

        $('#foto2').change(function(e) {
            var foto2 = e.target.files[0].name;
            $('#label-foto2').html(foto2);
        });

        $('#foto3').change(function(e) {
            var foto3 = e.target.files[0].name;
            $('#label-foto3').html(foto3);
        });
    });

    var loadFoto = function(event) {
        var foto = document.getElementById('view_foto');
        foto.href = URL.createObjectURL(event.target.files[0]);
    };

    var loadFoto2 = function(event) {
        var foto2 = document.getElementById('view_foto2');
        foto2.href = URL.createObjectURL(event.target.files[0]);
    };

    var loadFoto3 = function(event) {
        var foto3 = document.getElementById('view_foto3');
        foto3.href = URL.createObjectURL(event.target.files[0]);
    };

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
    }

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000
    });

    //delete
    function del(id) {

        Swal.fire({
            title: 'Konfirmasi Hapus Data',
            text: "Apakah Anda Yakin Ingin Menghapus Data Ini ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus Data Ini!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?php echo site_url('kegiatan/delete'); ?>",
                    type: "POST",
                    data: "id_kegiatan=" + id,
                    cache: false,
                    dataType: 'json',
                    success: function(respone) {
                        if (respone.status == true) {
                            reload_table();
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Berhasil Dihapus!'
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

    function add() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        // var foto = document.getElementById('view_foto');
        // var foto2 = document.getElementById('view_foto2');
        // var foto3 = document.getElementById('view_foto3');
        // foto.href = "";
        // foto2.href = "";
        // foto3.href = "";
        // $('#label-foto').text('Pilih File');
        // $('#label-foto2').text('Pilih File');
        // $('#label-foto3').text('Pilih File');
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Kegiatan'); // Set Title to Bootstrap modal title
    }

    function edit(id) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('kegiatan/edit') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                var url = "<?php echo base_url('upload/kegiatan/') ?>"
                $('[name="id_kegiatan"]').val(data.id_kegiatan);
                $('[name="judul"]').val(data.judul);
                $('[name="tanggal"]').val(data.tanggal);
                $('[name="keterangan"]').val(data.keterangan);
                if (data.foto != null) {
                    $('#view_foto').attr("href", url + data.foto);
                    $('#label-foto').text(data.foto);
                    $('[name="fileFoto1"]').val(data.foto);
                } else {
                    $('#view_foto').attr("href", '');
                }

                if (data.foto2 != null) {
                    $('#view_foto2').attr("href", url + data.foto2);
                    $('#label-foto2').text(data.foto2);
                    $('[name="fileFoto2"]').val(data.foto2);
                } else {
                    $('#view_foto2').attr("href", '');
                }

                if (data.foto3 != null) {
                    $('#view_foto3').attr("href", url + data.foto3);
                    $('#label-foto3').text(data.foto3);
                    $('[name="fileFoto3"]').val(data.foto3);
                } else {
                    $('#view_foto3').attr("href", '');
                }

                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Ubah Kegiatan'); // Set title to Bootstrap modal title

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function detail(id) {
        $.ajax({
                method: "POST",
                url: "<?php echo base_url('kegiatan/detail'); ?>",
                data: "id_kegiatan=" + id,
            })
            .done(function(data) {
                $('#tempat-modal').html(data);
                $('.modal-title').text('Detail Kegiatan');
                $('#modal_form_detail').modal('show');
            })
    }

    function save() {
        $('#btnSave').text('Menyimpan...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('kegiatan/insert') ?>";
        } else {
            url = "<?php echo site_url('kegiatan/update') ?>";
        }
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
                    var foto = document.getElementById('view_foto');
                    var foto2 = document.getElementById('view_foto2');
                    var foto3 = document.getElementById('view_foto3');
                    foto.href = "";
                    foto2.href = "";
                    foto3.href = "";
                    $('#label-foto').text('Pilih File');
                    $('#label-foto2').text('Pilih File');
                    $('#label-foto3').text('Pilih File');
                    $('[name="fileFoto1"]').val('');
                    $('[name="fileFoto2"]').val('');
                    $('[name="fileFoto3"]').val('');
                    if (save_method == 'add') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data Kegiatan Berhasil Disimpan!'
                        });
                    } else if (save_method == 'update') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data Kegiatan Berhasil Diubah!'
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

    function batal() {
        $('#form')[0].reset();
        reload_table();
        var foto = document.getElementById('view_foto');
        var foto2 = document.getElementById('view_foto2');
        var foto3 = document.getElementById('view_foto3');
        foto.href = "";
        foto2.href = "";
        foto3.href = "";
        $('#label-foto').text('Pilih File');
        $('#label-foto2').text('Pilih File');
        $('#label-foto3').text('Pilih File');
        $('[name="fileFoto1"]').val('');
        $('[name="fileFoto2"]').val('');
        $('[name="fileFoto3"]').val('');
    }
</script>