<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <form id="form-filter" class="form-horizontal">
                    <div class="form-group">
                        <label for="cluster" class="col-form-label mr-2">Filter Cluster</label>
                        <select class="form-control select2 col-sm-2 mr-2" name="cluster" id="cluster" style="width: 20%;">
                            <option value="0" selected disabled>-- Pilih Cluster --</option>
                            <?php
                            foreach ($cluster as $c) { ?>
                                <option value="<?= $c->id_cluster; ?>"><?= $c->nama_cluster; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="button" id="btn-filter" class="btn btn-sm btn-outline-success mr-2" title="Filter Data"><i class="fas fa-filter"></i> Filter</button>
                        <button type="button" id="btn-reset" class="btn btn-sm btn-outline-secondary" title="Reset Filter">Reset</button>
                    </div>
                </form>
                <br>
                <div class="card">
                    <div class="card-header bg-light">
                        <div class="text-left">
                            <button type="button" class="btn btn-sm btn-outline-primary" onclick="add()" title="Add Data"><i class="fas fa-plus"></i> Tambah ISR</button>
                        </div>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="tabelisr" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr class="bg-info text-center">
                                    <th>No.</th>
                                    <th>ID Induk ISR</th>
                                    <th>Cluster</th>
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

<?php echo $modal_tambah_isr; ?>
<div id="tempat-modal"></div>