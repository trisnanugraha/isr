<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header bg-light">
            <div class="text-left">
              <button type="button" class="btn btn-sm btn-outline-primary" onclick="add_user()" title="Add Data"><i class="fas fa-plus"></i> Tambah User</button>
              <button class="btn btn-sm btn-outline-success" title="Import Data" data-toggle="modal" data-target="#import-mahasiswa"><i class="fas fa-file-import"></i> Import Data</button>
              <a href="<?php echo base_url('user/download') ?>" type="button" class="btn btn-sm btn-outline-info" target="_blank" id="dwn_user" title="Download"><i class="fas fa-download"></i> Download</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="tabeluser" class="table table-bordered table-striped table-hover">
              <thead>
                <tr class="bg-info text-center">
                  <th>No</th>
                  <th>Nama Lengkap</th>
                  <th>Username</th>
                  <th>Hak Akses</th>
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

<?php echo $modal_tambah_user; ?>

<?php
$data['judul'] = 'Import Data User';
$data['url'] = 'user/import';
$data['link'] = 'assets/template/User-Template.xlsx';
$data['filename'] = 'User -- Import Template.xlsx';
echo show_my_modal('modals/modal_import', $data);
?>