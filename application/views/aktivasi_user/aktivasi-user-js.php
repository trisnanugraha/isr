<script type="text/javascript">
    var save_method; //for save method string
    var table;
    var anggaran;

    $(document).ready(function() {

        table = $("#tabelpending").DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "sEmptyTable": "Data Aktivasi User Masih Kosong"
            },
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('aktivasiuser/ajax_list') ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0, 3, 4, 5],
                "className": 'text-center'
            }, {
                "targets": [-1], //last column
                "render": function(data, type, row) {
                    return "<div class=\"d-inline mx-1\"><a class=\"btn btn-xs btn-outline-info\" href=\"javascript:void(0)\" title=\"Aktivasi\" onclick=\"activation(" + row[5] + ")\"><i class=\"fas fa-power-off\"></i> Aktivasi</a></div>"

                },
                "orderable": false, //set not orderable
            }, {
                "searchable": false,
                "orderable": false,
                "targets": 0
            }],
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

    //aktivasi akun
    function activation(id) {

        Swal.fire({
            title: 'Aktivasi Akun',
            text: "Apakah Anda Yakin Ingin Aktivasi Akun Ini ?",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Aktifkan Sekarang!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    url: "<?php echo site_url('aktivasiuser/aktivasi'); ?>",
                    type: "POST",
                    data: "id_pending_user=" + id,
                    cache: false,
                    dataType: 'json',
                    success: function(respone) {
                        if (respone.status == true) {
                            reload_table();
                            Swal.fire({
                                icon: 'success',
                                title: 'Akun Berhasil Diaktivasi!'
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
</script>