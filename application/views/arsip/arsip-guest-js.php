<script type="text/javascript">
    var save_method; //for save method string
    var table;

    $(document).ready(function() {

        table = $("#tabelarsip").DataTable({
            "responsive": true,
            "autoWidth": false,
            "language": {
                "sEmptyTable": "Data Arsip Masih Kosong"
            },
            "processing": true, //Feature control the processing indicator.
            "serverSide": true, //Feature control DataTables' server-side processing mode.
            "order": [], //Initial no order.

            // Load data for the table's content from an Ajax source
            "ajax": {
                "url": "<?php echo site_url('arsip/ajax_list') ?>",
                "type": "POST"
            },
            //Set column definition initialisation properties.
            "columnDefs": [{
                "targets": [0, 1, 2],
                "className": 'text-center'
            }, {
                "searchable": false,
                "orderable": false,
                "targets": 0
            }, {
                "targets": [-1], //last column
                "render": function(data, type, row) {
                    return row[2] + " <div class=\"d-inline mx-1\"><a class=\"btn btn-xs btn-outline-success\" href=\"<?php echo site_url('upload/arsip/'); ?>" + row[2] + "\" target=\"_blank\" title=\"Preview\"><i class=\"fas fa-eye\"></i> Preview</a></div>";
                },
                "orderable": false, //set not orderable
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
    });

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
    }
</script>