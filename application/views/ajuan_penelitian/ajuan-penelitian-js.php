<script type="text/javascript">
    var save_method; //for save method string
    var table;

    $(document).ready(function() {
        // $('.select2').select2();

        table = $("#tabelajuan").DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "sEmptyTable": "Data Ajuan Penelitian Masih Kosong"
            },
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('ajuanpenelitian/ajax_list') ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0, 3, 4, 5, 6],
                "className": 'text-center'
            }, {
                "targets": [0],
                "orderable": false
            }, {
                "targets": [-4], //status pengusul
                "render": function(data, type, row) {
                    if (row[6] == "Mengajukan") {
                        return "<div class=\"badge bg-info text-white text-wrap\">" + row[6] + "</div>" + "<br>" + row[7]
                    } else if (row[6] == "Sudah Diperbaiki") {
                        return "<div class=\"badge bg-primary text-white text-wrap\">" + row[6] + "</div>" + "<br>" + row[7]
                    } else if (row[6] == "Pengajuan Diterima") {
                        return "<div class=\"badge bg-success text-white text-wrap\">" + row[6] + "</div>" + "<br>" + row[7]
                    }
                }
            }, {
                "targets": [-3], //status lppm
                "render": function(data, type, row) {
                    if (row[3] == "On Process") {
                        return "<div class=\"badge bg-info text-white text-wrap\">" + row[3] + "</div>" + "<br>" + row[8]
                    } else if (row[3] == "On Review") {
                        return "<div class=\"badge bg-primary text-white text-wrap\">" + row[3] + "</div>" + "<br>" + row[8]
                    } else if (row[3] == "Need Revision") {
                        return "<div class=\"badge bg-warning text-white text-wrap\">" + row[3] + "</div>" + "<br>" + row[8]
                    } else if (row[3] == "Approve") {
                        return "<div class=\"badge bg-success text-white text-wrap\">" + row[3] + "</div>" + "<br>" + row[8]
                    } else if (row[3] == "Decline") {
                        return "<div class=\"badge bg-danger text-white text-wrap\">" + row[3] + "</div>" + "<br>" + row[8]
                    }
                }
            }, {
                "targets": [-2], //status reviewer
                "render": function(data, type, row) {
                    if (row[4] == "On Process") {
                        return "<div class=\"badge bg-info text-white text-wrap\">" + row[4] + "</div>" + "<br>" + row[9]
                    } else if (row[4] == "On Review") {
                        return "<div class=\"badge bg-primary text-white text-wrap\">" + row[4] + "</div>" + "<br>" + row[9]
                    } else if (row[4] == "Need Revision") {
                        return "<div class=\"badge bg-warning text-white text-wrap\">" + row[4] + "</div>" + "<br>" + row[9]
                    } else if (row[4] == "Approve") {
                        return "<div class=\"badge bg-success text-white text-wrap\">" + row[4] + "</div>" + "<br>" + row[9]
                    } else if (row[4] == "Decline") {
                        return "<div class=\"badge bg-danger text-white text-wrap\">" + row[4] + "</div>" + "<br>" + row[9]
                    }
                }
            }, {
                "targets": [-1], //last column
                "render": function(data, type, row) {
                    if (row[3] == "On Process" || row[3] == "Need Revision" || row[3] == "Decline") {
                        return "<a class=\"btn btn-xs btn-outline-success\" href=\"javascript:void(0)\" title=\"Detail\" onclick=\"detail(" + row[5] + ")\"><i class=\"fas fa-eye\"></i> Detail</a><span class=\"mx-1\"></span><a class=\"btn btn-xs btn-outline-primary\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit(" + row[5] + ")\"><i class=\"fas fa-edit\"></i> Ubah</a><span class=\"mx-1\"></span><a class=\"btn btn-xs btn-outline-danger\" href=\"javascript:void(0)\" title=\"Delete\" onclick=\"del(" + row[5] + ")\"><i class=\"fas fa-trash\"></i> Hapus</a>"
                    } else if (row[3] == "On Review" || row[3] == "Approve") {
                        return "<a class=\"btn btn-xs btn-outline-success\" href=\"javascript:void(0)\" title=\"Detail\" onclick=\"detail(" + row[5] + ")\"><i class=\"fas fa-eye\"></i> Detail</a>"
                    }

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
        $("select").not(".select2").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
            $(this).removeClass('is-invalid');
        });
        // $(".selectpicker").change(function() {
        //     $(this).parent().parent().removeClass('has-error');
        //     $(this).next().empty();
        //     $(this).removeClass('is-invalid');
        // });
        $('#berkaslaporan').change(function(e) {
            var laporan = e.target.files[0].name;
            $('#label-laporan').html(laporan);
        });
        $('#berkasjurnal').change(function(e) {
            var jurnal = e.target.files[0].name;
            $('#label-jurnal').html(jurnal);
        });
        // $('select').on('change', function(event) {
        //     var value = $(this).val();
        //     $(this).prop('disabled', false);

        //     $('select').find('option[value="' + value + '"]')
        //         .attr('disabled', 'disabled')
        //         .hide();
        // });
        $("select").on('change', function() {
            var prevValue = $(this).data('previous');
            $("select").not(this).find('option[value="' + prevValue + '"]').show();
            var value = $(this).val();
            $(this).data('previous', value);
            $('select').not(this).find('option[value="' + value + '"]').hide();
            $(".selectpicker").selectpicker("refresh");
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
                    url: "<?php echo site_url('ajuanpenelitian/delete'); ?>",
                    type: "POST",
                    data: "id_ajuan_penelitian=" + id,
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
        var laporan = document.getElementById('view_laporan');
        var jurnal = document.getElementById('view_jurnal');
        laporan.href = "";
        jurnal.href = "";
        $('[name="filelaporan"]').val('');
        $('[name="filejurnal"]').val('');
        $('.selectpicker').selectpicker('val', '');
        $(".selectpicker").selectpicker("refresh");
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Ajuan Penelitian'); // Set Title to Bootstrap modal title
    }

    function edit(id) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('.selectpicker').selectpicker('val', '');

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('ajuanpenelitian/edit') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_ajuan_penelitian"]').val(data.id_ajuan_penelitian);
                $('[name="priode"]').val(data.id_priode);
                $('[name="judul"]').val(data.judul_penelitian);
                $('[name="skema"]').val(data.id_skema);
                // $('[name="anggota1"]').val(data.id_anggota_1);
                // $('[name="anggota2"]').val(data.id_anggota_2);
                // $('[name="anggota3"]').val(data.id_anggota_3);
                // $('[name="anggota4"]').val(data.id_anggota_4);
                // $('[name="anggota5"]').val(data.id_anggota_5);
                $('.selectpicker[name="anggota1"]').selectpicker('val', data.id_anggota_1);
                $('.selectpicker[name="anggota2"]').selectpicker('val', data.id_anggota_2);
                $('.selectpicker[name="anggota3"]').selectpicker('val', data.id_anggota_3);
                $('.selectpicker[name="anggota4"]').selectpicker('val', data.id_anggota_4);
                $('.selectpicker[name="anggota5"]').selectpicker('val', data.id_anggota_5);
                $('[name="anggaran"]').val(data.anggaran);
                $('[name="lokasi"]').val(data.lokasi);
                $('[name="jurnal"]').val(data.nama_jurnal);
                $('[name="peringkat"]').val(data.peringkat_jurnal);
                $('[name="link"]').val(data.link_jurnal);
                $('[name="eissn"]').val(data.e_issn);
                if (data.berkas_laporan != '' && data.berkas_jurnal != '') {
                    var lokasiLaporan = "<?php echo base_url('upload/penelitian/laporan/') ?>"
                    var lokasiJurnal = "<?php echo base_url('upload/penelitian/jurnal/') ?>"
                    $('#view_laporan').attr("href", lokasiLaporan + data.berkas_laporan);
                    $('#view_jurnal').attr("href", lokasiJurnal + data.berkas_jurnal);
                    $('[name="filelaporan"]').val(data.berkas_laporan);
                    $('[name="filejurnal"]').val(data.berkas_jurnal);
                } else {
                    $('#view_laporan').attr("href", '');
                    $('#view_jurnal').attr("href", '');
                }
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Ubah Ajuan Penelitian'); // Set title to Bootstrap modal title

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function detail(id) {
        $.ajax({
                method: "POST",
                url: "<?php echo base_url('ajuanpenelitian/detail'); ?>",
                data: "id=" + id,
            })
            .done(function(data) {
                $('#tempat-modal').html(data);
                $('.modal-title').text('Detail Ajuan Penelitian');
                $('#modal_form_detail').modal('show');
            })
    }

    function save() {
        $('#btnSave').text('Menyimpan...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('ajuanpenelitian/insert') ?>";
        } else {
            url = "<?php echo site_url('ajuanpenelitian/update') ?>";
        }
        var formdata = new FormData($('#form')[0]);
        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: formdata,
            // data: $('#form').serialize(),
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
                            title: 'Data Ajuan Penelitian Berhasil Disimpan!'
                        });
                    } else if (save_method == 'update') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data Ajuan Penelitian Berhasil Diubah!'
                        });
                    }
                } else {
                    for (var i = 0; i < data.inputerror.length; i++) {
                        $('[name="' + data.inputerror[i] + '" ]').addClass('is-invalid');
                        $('[name="' + data.inputerror[i] + '" ]').closest('.kosong').append('<span></span>');
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

    var loadLaporan = function(event) {
        var laporan = document.getElementById('view_laporan');
        laporan.href = URL.createObjectURL(event.target.files[0]);
    };

    var loadJurnal = function(event) {
        var jurnal = document.getElementById('view_jurnal');
        jurnal.href = URL.createObjectURL(event.target.files[0]);
    };

    function batal() {
        $('#form')[0].reset();
        reload_table();
        var laporan = document.getElementById('view_laporan');
        var jurnal = document.getElementById('view_jurnal');
        laporan.href = "";
        jurnal.href = "";
        $('.selectpicker').selectpicker('val', '');
        $('.selectpicker').selectpicker("refresh");
    }
</script>