<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header bg-light">
            <div class="text-left">
              <button type="button" class="btn btn-sm btn-outline-primary" onclick="add_level()" title="Add Data"><i class="fas fa-plus"></i> Tambah Hak Akses</button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="tabellevel" class="table table-bordered table-striped table-hover">
              <thead>
                <tr class="bg-info text-center">
                  <th>No.</th>
                  <th>Level</th>
                  <th>Akses</th>
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

<?php echo $modal_tambah_hak_akses; ?>

<div class="modal fade" id="modal-default">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title ">View Level</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close" id="batal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center" id="md_def">
      </div>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->