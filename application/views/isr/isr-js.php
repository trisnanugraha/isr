<script type="text/javascript">
    var save_method; //for save method string
    var table;
    var i = 1;
    var temp_id = new Array();

    $(document).ready(function() {

        $('#form-filter')[0].reset();

        table = $("#tabelisr").DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "sEmptyTable": "Data ISR Masih Kosong"
            },
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('isr/ajax_list') ?>",
                "type": "POST",
                "data": function(data) {
                    data.cluster = $('#cluster').val();
                }
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
                    return "<a class=\"btn btn-xs btn-outline-success\" href=\"javascript:void(0)\" title=\"Detail\" onclick=\"detail(" + row[3] + ")\"><i class=\"fas fa-eye\"></i> Detail</a><span class=\"mx-1\"></span><div class=\"d-inline mx-1\"><a class=\"btn btn-xs btn-outline-primary\" href=\"javascript:void(0)\" title=\"Edit\" onclick=\"edit(" + row[3] + ")\"><i class=\"fas fa-edit\"></i> Ubah</a></div> <div class=\"d-inline mx-1\"><a class=\"btn btn-xs btn-outline-danger\" href=\"javascript:void(0)\" title=\"Delete\" onclick=\"del(" + row[3] + ")\"><i class=\"fas fa-trash\"></i> Hapus</a></div>";
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
    });

    function tambah_data() {
        var new_id = i++;
        var html = '';
        html += '<tr id="' + new_id + '">';
        // html += '<td class="id_mhs' + new_id + '" hidden>' + $("#nama_mhs").val() + '</td>';
        html += '<td class="site_id' + new_id + '">' + $("#site_id").val() + '</td>';
        html += '<td class="rr' + new_id + '">' + $("#rr").val() + '</td>';
        html += '<td class="apl_id' + new_id + '">' + $("#apl_id").val() + '</td>';
        html += '<td class="isr_tx' + new_id + '">' + $("#isr_tx").val() + '</td>';
        html += '<td class="isr_rx' + new_id + '">' + $("#isr_rx").val() + '</td>';
        html += '<td class="actual_tx' + new_id + '">' + $("#actual_tx").val() + '</td>';
        html += '<td class="actual_rx' + new_id + '">' + $("#actual_rx").val() + '</td>';
        html += '<td class="text-center"><button type="button" onclick="hapus_data(this)" class="btn btn-md btn-danger btn_remove">Hapus</button></td>';
        html += '</tr>'
        $('#dynamic_field').append(html);
        $("#site_id").val('');
        $("#rr").val('');
        $("#apl_id").val('');
        $("#isr_tx").val('');
        $("#isr_rx").val('');
        $("#actual_tx").val('');
        $("#actual_rx").val('');
    }

    function hapus_data(id) {
        id.closest('tr').remove();
    }

    function hapus_edit_data(id) {
        temp_id.push(id.closest('tr').className)
        id.closest('tr').remove();
    }

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
                    url: "<?php echo site_url('isr/delete'); ?>",
                    type: "POST",
                    data: "id_isr=" + id,
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

    $('#btn-filter').click(function() { //button filter event click
        table.ajax.reload(); //just reload table
    });

    $('#btn-reset').click(function() { //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload(); //just reload table
    });

    function add() {
        save_method = 'add';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string
        $('#modal_form').modal('show'); // show bootstrap modal
        $('.modal-title').text('Tambah ISR'); // Set Title to Bootstrap modal title
    }

    function detail(id) {
        $.ajax({
                method: "POST",
                url: "<?php echo base_url('isr/detail'); ?>",
                data: "id_isr=" + id,
            })
            .done(function(data) {
                $('#tempat-modal').html(data);
                $('.modal-title').text('Detail ISR');
                $('#modal_form_detail').modal('show');
            })
    }

    function edit(id) {
        save_method = 'update';
        $('#form')[0].reset(); // reset form on modals
        $('.form-group').removeClass('has-error'); // clear error class
        $('.help-block').empty(); // clear error string

        //Ajax Load data from ajax
        $.ajax({
            url: "<?php echo site_url('isr/edit') ?>/" + id,
            type: "GET",
            dataType: "JSON",
            success: function(data) {
                $('[name="id_isr"]').val(data['isr'].id_isr);
                $('[name="induk_isr"]').val(data['isr'].induk_isr);
                $('[name="cluster"]').val(data['isr'].id_cluster);

                var myObj = data['isrDetail']
                $.each(myObj, function(key, value) {
                    var new_id = i++;
                    var html = '';
                    html += '<tr id="' + new_id + '" class="' + value.id_detail_isr + '">';
                    html += '<td class="delete_id id_detail_isr' + new_id + '" hidden>' + value.id_detail_isr + '</td>';
                    html += '<td class="site_id' + new_id + '">' + value.site_id + '</td>';
                    html += '<td class="rr' + new_id + '">' + value.rr + '</td>';
                    html += '<td class="apl_id' + new_id + '">' + value.apl_id + '</td>';
                    html += '<td class="isr_tx' + new_id + '">' + value.isr_tx + '</td>';
                    html += '<td class="isr_rx' + new_id + '">' + value.isr_rx + '</td>';
                    html += '<td class="actual_tx' + new_id + '">' + value.actual_tx + '</td>';
                    html += '<td class="actual_rx' + new_id + '">' + value.actual_rx + '</td>';
                    // html += '<td class="status' + new_id + '" hidden">' + value.status + '</td>';
                    html += '<td class="text-center"><button type="button" onclick="hapus_edit_data(this,' + new_id + ')" class="btn btn-md btn-danger btn_remove">Hapus</button></td>';
                    html += '</tr>'
                    $('#dynamic_field').append(html);
                });

                $('#modal_form').modal('show'); // show bootstrap modal when complete loaded
                $('.modal-title').text('Ubah ISR'); // Set title to Bootstrap modal title

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
        var formData;

        var lastRowId = $('#dynamic_field tr:last').attr("id");
        var id_detail_isr = new Array();
        var site_id = new Array();
        var rr = new Array();
        var apl_id = new Array();
        var isr_tx = new Array();
        var isr_rx = new Array();
        var actual_tx = new Array();
        var actual_rx = new Array();
        for (var i = 1; i <= lastRowId; i++) {
            id_detail_isr.push($('#' + i + " .id_detail_isr" + i).html());
            site_id.push($('#' + i + " .site_id" + i).html());
            rr.push($('#' + i + " .rr" + i).html());
            apl_id.push($('#' + i + " .apl_id" + i).html());
            isr_tx.push($('#' + i + " .isr_tx" + i).html());
            isr_rx.push($('#' + i + " .isr_rx" + i).html());
            actual_tx.push($('#' + i + " .actual_tx" + i).html());
            actual_rx.push($('#' + i + " .actual_rx" + i).html());
            $('#' + i).remove();
        }

        if (save_method == 'add') {
            url = "<?php echo site_url('isr/insert') ?>";
            formData = {
                id_isr: $("#id_isr").val(),
                induk_isr: $("#induk_isr").val(),
                site_id: site_id,
                rr: rr,
                apl_id: apl_id,
                isr_tx: isr_tx,
                isr_rx: isr_rx,
                actual_tx: actual_tx,
                actual_rx: actual_rx,
                cluster: $("#cluster").val()
            };
        } else {
            url = "<?php echo site_url('isr/update') ?>";
            formData = {
                id_isr: $("#id_isr").val(),
                induk_isr: $("#induk_isr").val(),
                id_detail_isr: id_detail_isr,
                site_id: site_id,
                rr: rr,
                apl_id: apl_id,
                isr_tx: isr_tx,
                isr_rx: isr_rx,
                actual_tx: actual_tx,
                actual_rx: actual_rx,
                delete_data: temp_id,
                cluster: $("#cluster").val()
            };
        }

        // ajax adding data to database
        $.ajax({
            url: url,
            type: "POST",
            data: formData,
            dataType: "JSON",
            success: function(data) {

                if (data.status) //if success close modal and reload ajax table
                {
                    i = 1;
                    $('#modal_form').modal('hide');
                    reload_table();
                    if (save_method == 'add') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data ISR Berhasil Disimpan!'
                        });
                    } else if (save_method == 'update') {
                        Toast.fire({
                            icon: 'success',
                            title: 'Data ISR Berhasil Diubah!'
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
</script>