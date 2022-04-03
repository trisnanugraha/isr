<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header bg-light">
            <div class="text-left">
              <button type="button" class="btn btn-sm btn-outline-primary" onclick="add_submenu()" title="Add Data"><i class="fas fa-plus"></i> Tambah Sub Menu</button>
              <!-- <a  href="<?php echo base_url('submenu/download'); ?>" type="button" class="btn btn-sm btn-outline-info" id="dwn_submenu" title="Download"><i class="fas fa-download"></i> Download</a> -->
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="tabelsubmenu" class="table table-bordered table-striped table-hover">
              <thead>
                <tr class="bg-info text-center">
                  <th>No.</th>
                  <th>Nama Sub Menu</th>
                  <th>Link</th>
                  <th>Icon</th>
                  <th>Menu</th>
                  <th>Status</th>
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

<?php echo $modal_tambah_sub_menu; ?>