<!-- Main content -->
<section class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header bg-light">
            <div class="text-left">
              <!-- <a href="<?= base_url('aplikasi/download'); ?>" type="button" class="btn btn-sm btn-outline-info"  title="Download" target="_blank"><i class="fas fa-download"></i> Download</a> -->
              <a href="<?= base_url('backup/backupdb'); ?>" type="button" class="btn btn-sm btn-outline-warning" title="Backup"><i class="fas fa-hdd"></i> Backup Database</a>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="tabelaplikasi" class="table table-bordered table-striped table-hover">
              <thead>
                <tr class="bg-info text-center">
                  <th>Nama Owner</th>
                  <th>Alamat</th>
                  <th>No Telp</th>
                  <th>Judul</th>
                  <th>Nama Aplikasi</th>
                  <!-- <th>Copy Right</th>
                  <th>Versi</th>
                  <th>Tahun</th>
                  <th>Logo</th> -->
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

<?php echo $modal_edit_aplikasi; ?>