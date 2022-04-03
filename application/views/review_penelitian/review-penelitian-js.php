<script type="text/javascript">
    var save_method; //for save method string
    var table;

    $(document).ready(function() {

        table = $("#tabelreview").DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "sEmptyTable": "Data Review Penelitian Masih Kosong"
            },
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('reviewpenelitian/ajax_list') ?>",
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
                "targets": [-2], //status lppm
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
                    return "<div class=\"d-inline mx-1\"><a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" title=\"Detail\" onclick=\"edit(" + row[6] + ")\"><i class=\"fas fa-eye\"></i> Detail</a></div>"

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
        $("select").change(function() {
            $(this).parent().parent().removeClass('has-error');
            $(this).next().empty();
            $(this).removeClass('is-invalid');
        });
        $('#berkasreview').change(function(e) {
            var review = e.target.files[0].name;
            $('#label-review').html(review);
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

    function edit(id) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('reviewpenelitian/edit') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {

                $('[name="id_ajuan_penelitian"]').val(data.id_ajuan_penelitian);
                $('[name="priode"]').text(data.judul);
                $('[name="judul"]').text(data.judul_penelitian);
                $('[name="skema"]').text(data.nama_skema);
                $('[name="ketua"]').text(data.ketua);
                $('[name="anggaran"]').text(data.anggaran);
                $('[name="lokasi"]').text(data.lokasi);
                $('[name="jurnal"]').text(data.nama_jurnal);
                $('[name="peringkat"]').text(data.peringkat_jurnal);
                $('[name="link"]').attr("href", data.link_jurnal);
                $('[name="link"]').text(data.link_jurnal);
                $('[name="eissn"]').text(data.e_issn);
                if (data.berkas_laporan != '' || data.berkas_jurnal != '') {
                    var lokasiLaporan = "<?php echo base_url('upload/penelitian/laporan/') ?>"
                    var lokasiJurnal = "<?php echo base_url('upload/penelitian/jurnal/') ?>"
                    $('[name="berkaslaporan"]').attr("href", lokasiLaporan + data.berkas_laporan);
                    $('[name="berkasjurnal"]').attr("href", lokasiJurnal + data.berkas_jurnal);
                } else {
                    $('[name="berkaslaporan"]').attr("href", '');
                    $('[name="berkasjurnal"]').attr("href", '');
                }
                if (data.berkas_review != '') {
                    var lokasiReview = "<?php echo base_url('upload/review/penelitian/') ?>"
                    // $('[name="berkasreview"]').attr("href", lokasiReview + data.berkas_review);
                    $('#view_review').attr("href", lokasiReview + data.berkas_review);
                    $('[name="filereview"]').val(data.berkas_review);
                } else {
                    $('[name="berkasreview"]').attr("href", '');
                }
                $('[name="tgl_pengajuan"]').text(data.tgl_dibuat);
                $('[name="tgl_diubah"]').text(data.tgl_diubah);
                $('[name="tgl_validasi_lppm"]').text(data.tgl_validasi_lppm);
                $('[name="tgl_validasi_reviewer"]').text(data.tgl_validasi_reviewer);
                $('[name="status"]').text(data.status);
                $('[name="komentar_lppm"]').val(data.komentar_lppm);
                $('[name="reviewer"]').text(data.reviewer);
                $('[name="status_reviewer"]').val(data.status_reviewer);
                $('[name="komentar_reviewer"]').val(data.komentar_reviewer);
                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Detail Data Penelitian'); // Set title to Bootstrap modal title

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
            url = "<?php echo site_url('reviewpenelitian/insert') ?>";
        } else {
            url = "<?php echo site_url('reviewpenelitian/update') ?>";
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
                    if (save_method == 'add') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data Review Penelitian Berhasil Disimpan!'
                        });
                    } else if (save_method == 'update') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data Review Penelitian Berhasil Diubah!'
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

    var loadReview = function(event) {
        var review = document.getElementById('view_review');
        review.href = URL.createObjectURL(event.target.files[0]);
    };

    function batal() {
        $('#form')[0].reset();
        reload_table();
        var review = document.getElementById('view_review');
        review.href = "";
    }
</script>