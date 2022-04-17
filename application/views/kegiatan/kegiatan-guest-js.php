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
    });

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
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