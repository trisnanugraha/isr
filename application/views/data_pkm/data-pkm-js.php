<script type="text/javascript">
    var save_method; //for save method string
    var table;

    $(document).ready(function() {
        // $('.kirim-reviewer').hide();
        table = $("#tabelajuan").DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "sEmptyTable": "Data PKM Masih Kosong"
            },
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('datapkm/ajax_list') ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0, 4, 5, 6, 7],
                "className": 'text-center'
            }, {
                "targets": [-4], //status pengusul
                "render": function(data, type, row) {
                    if (row[7] == "Mengajukan") {
                        return "<div class=\"badge bg-info text-white text-wrap\">" + row[7] + "</div>" + "<br>" + row[8]
                    } else if (row[7] == "Sudah Diperbaiki") {
                        return "<div class=\"badge bg-primary text-white text-wrap\">" + row[7] + "</div>" + "<br>" + row[8]
                    } else if (row[7] == "Pengajuan Diterima") {
                        return "<div class=\"badge bg-success text-white text-wrap\">" + row[7] + "</div>" + "<br>" + row[8]
                    }
                }
            }, {
                "targets": [-3], //status lppm
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
                "targets": [-2], //status reviewer
                "render": function(data, type, row) {
                    if (row[5] == "On Process") {
                        return "<div class=\"badge bg-info text-white text-wrap\">" + row[5] + "</div>" + "<br>" + row[10]
                    } else if (row[5] == "On Review") {
                        return "<div class=\"badge bg-primary text-white text-wrap\">" + row[5] + "</div>" + "<br>" + row[10]
                    } else if (row[5] == "Need Revision") {
                        return "<div class=\"badge bg-warning text-white text-wrap\">" + row[5] + "</div>" + "<br>" + row[10]
                    } else if (row[5] == "Approve") {
                        return "<div class=\"badge bg-success text-white text-wrap\">" + row[5] + "</div>" + "<br>" + row[10]
                    } else if (row[5] == "Decline") {
                        return "<div class=\"badge bg-danger text-white text-wrap\">" + row[5] + "</div>" + "<br>" + row[10]
                    }
                }
            }, {
                "targets": [-1], //last column
                "render": function(data, type, row) {
                    return "<div class=\"d-inline mx-1\"><a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" title=\"Detail\" onclick=\"edit(" + row[6] + ")\"><i class=\"fas fa-eye\"></i> Detail</a></div> <div class=\"d-inline mx-1\"><a class=\"btn btn-xs btn-outline-danger\" href=\"javascript:void(0)\" title=\"Delete\" onclick=\"del(" + row[6] + ")\"><i class=\"fas fa-trash\"></i> Hapus</a></div>"

                },
                "orderable": false, //set not orderable
            }, {
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
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
        $("select").not('.selectpicker').change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
            $(this).removeClass('is-invalid');
        });

        // $('select.status').change(function() {
        //     var val = $(this).val();
        //     if (val === "Approve") {
        //         $('.kirim-reviewer').show();
        //         // $('.subkategori-buku-umum').hide();
        //     } else {
        //         $('.kirim-reviewer').hide();

        //     }
        // });
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
                    url: "<?php echo site_url('datapkm/delete'); ?>",
                    type: "POST",
                    data: "id_ajuan_pkm=" + id,
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
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah Skema Penelitian'); // Set Title to Bootstrap modal title
    }

    function edit(id) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('datapkm/edit') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id_ajuan_pkm"]').val(data.id_ajuan_pkm);
                $('[name="priode"]').text(data.judul);
                $('[name="judul"]').text(data.judul_pkm);
                $('[name="skema"]').text(data.nama_skema);
                $('[name="ketua"]').text(data.ketua);
                $('[name="anggota1"]').text(data.anggota1);
                $('[name="anggota2"]').text(data.anggota2);
                $('[name="anggota3"]').text(data.anggota3);
                $('[name="anggota4"]').text(data.anggota4);
                $('[name="anggota5"]').text(data.anggota5);
                $('[name="anggaran"]').text(data.anggaran);
                $('[name="lokasi"]').text(data.lokasi);
                $('[name="jurnal"]').text(data.nama_jurnal);
                $('[name="peringkat"]').text(data.peringkat_jurnal);
                $('[name="link"]').attr("href", data.link_jurnal);
                $('[name="link"]').text(data.link_jurnal);
                $('[name="eissn"]').text(data.e_issn);
                if (data.berkas_laporan != '' || data.berkas_jurnal != '') {
                    var lokasiLaporan = "<?php echo base_url('upload/pkm/laporan/') ?>"
                    var lokasiJurnal = "<?php echo base_url('upload/pkm/jurnal/') ?>"
                    $('#view_laporan').attr("href", lokasiLaporan + data.berkas_laporan);
                    $('#view_jurnal').attr("href", lokasiJurnal + data.berkas_jurnal);
                    $('[name="filelaporan"]').val(data.berkas_laporan);
                    $('[name="filejurnal"]').val(data.berkas_jurnal);
                } else {
                    $('#view_laporan').attr("href", '');
                    $('#view_jurnal').attr("href", '');
                }
                $('[name="tgl_pengajuan"]').text(data.tgl_dibuat);
                $('[name="tgl_diubah"]').text(data.tgl_diubah);
                $('[name="tgl_validasi_lppm"]').text(data.tgl_validasi_lppm);
                $('[name="tgl_validasi_reviewer"]').text(data.tgl_validasi_reviewer);
                $('[name="status"]').val(data.status);
                $('[name="komentar_lppm"]').val(data.komentar_lppm);
                $('.selectpicker[name="reviewer"]').selectpicker('val', data.reviewer);
                if (!data.nama_reviewer && !data.status_reviewer) {
                    $('[name="nama_reviewer"]').text('Reviewer Belum Dipilih');
                    $('[name="status_reviewer"]').text('Status Reviewer Belum Tersedia');
                } else {
                    $('[name="nama_reviewer"]').text(data.nama_reviewer);
                    $('[name="status_reviewer"]').text(data.status_reviewer);
                }
                $('[name="komentar_reviewer"]').val(data.komentar_reviewer);
                if (data.berkas_review != '') {
                    var lokasiBerkas = "<?php echo base_url('upload/review/pkm/') ?>"
                    $('#berkas_review').attr("href", lokasiBerkas + data.berkas_review);
                } else {
                    $('#berkas_review').attr("href", '');
                }
                $('.selectpicker').selectpicker('refresh');
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Detail Data PKM'); // Set title to Bootstrap modal title

            },
            error: function(jqXHR, textStatus, errorThrown) {
                alert('Error get data from ajax');
            }
        });
    }

    function save() {
        $('#btnSave').text('Menyimpan...'); //change button text
        $('#btnSave').attr('disabled', true); //set button disable 
        var url;

        if (save_method == 'add') {
            url = "<?php echo site_url('datapkm/insert') ?>";
        } else {
            url = "<?php echo site_url('datapkm/update') ?>";
        }

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: $('#form').serialize(),
            dataType: "JSON",
            success: function(data) {

                if (data.status) //if success close modal and reload ajax table
                {
                    $('#modal_form').modal('hide');
                    reload_table();
                    if (save_method == 'add') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data PKM Berhasil Disimpan!'
                        });
                    } else if (save_method == 'update') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data PKM Berhasil Diubah!'
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

    function tutup() {
        $('#form')[0].reset();
        reload_table();
        $('.selectpicker').selectpicker('val', '');
        $('.selectpicker').selectpicker("refresh");
    }
</script>