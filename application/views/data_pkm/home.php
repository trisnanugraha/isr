<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light">
                        <div class="text-left">
                            <!-- <a href="<?php echo base_url('datapkm/export') ?>" type="button" class="btn btn-sm btn-outline-info" target="_blank" id="export_datapkm" title="Export Data"><i class="fas fa-download"></i> Export Data</a>
                            <a href="<?php echo base_url('datapkm/print') ?>" type="button" class="btn btn-sm btn-outline-info" target="_blank" id="print_datapkm" title="Export Data"><i class="fas fa-print"></i> Print Data</a> -->
                            <button class="btn btn-sm btn-outline-info" data-toggle="modal" data-target="#print-report"><i class="fas fa-print"></i> Print Report</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabelajuan" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-info text-center">
                                    <th>No.</th>
                                    <th>Ketua Peneliti</th>
                                    <th>Judul</th>
                                    <th>Skema</th>
                                    <th>Status Pengusul</th>
                                    <th>Status LPPM</th>
                                    <th>Status Reviewer</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</section>

<?php echo $modal_detail_data_pkm; ?>
<?php echo $modal_print_data_pkm; ?>