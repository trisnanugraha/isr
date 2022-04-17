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

    $('#btn-filter').click(function() { //button filter event click
        table.ajax.reload(); //just reload table
    });

    $('#btn-reset').click(function() { //button reset event click
        $('#form-filter')[0].reset();
        table.ajax.reload(); //just reload table
    });

    function reload_table() {
        table.ajax.reload(null, false); //reload datatable ajax 
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
</script>