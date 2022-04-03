    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-light">
                <div class="text-left">
                  <button type="button" class="btn btn-sm btn-outline-primary" onclick="add_menu()" title="Add Data"><i class="fas fa-plus"></i> Tambah Menu</button>
                  <!-- <a href="<?php echo base_url('menu/download') ?>" type="button" class="btn btn-sm btn-outline-info" id="dwn_menu" target="_blank" title="Download"><i class="fas fa-download"></i> Download</a> -->
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="tabelmenu" class="table table-bordered table-striped table-hover">
                  <thead>
                    <tr class="bg-info text-center">
                      <th>No.</th>
                      <th>Nama Menu</th>
                      <th>Link</th>
                      <th>Icon</th>
                      <th>Urutan</th>
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

    <!-- Modal Hapus-->
    <div class="modal fade" id="myModal">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Konfirmasi</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="idhapus" id="idhapus">
            <p>Apakah anda yakin ingin menghapus menu <strong class="text-konfirmasi"> </strong> ?</p>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success btn-xs" data-dismiss="modal">Batal</button>
            <button type="button" class="btn btn-danger btn-xs" id="konfirmasi">Hapus</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    
    <!-- Bootstrap modal -->
    <div class="modal fade" id="modal_form" role="dialog" data-backdrop="static">
      <div class="modal-dialog">
        <div class="modal-content">

          <div class="modal-header">
            <h3 class="modal-title">Form</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="#" id="form" class="form-horizontal">
            <input type="hidden" value="" name="id_menu" />
            <div class="card-body">
              <div class="form-group row ">
                <label for="nama_menu" class="col-sm-3 col-form-label">Nama Menu</label>
                <div class="col-sm-9 kosong">
                  <input type="text" class="form-control" name="nama_menu" id="nama_menu" placeholder="nama menu yang tampil">
                </div>
              </div>
              <div class="form-group row ">
                <label for="link" class="col-sm-3 col-form-label">Link</label>
                <div class="col-sm-9 kosong">
                  <input type="text" class="form-control" name="link" id="link" placeholder="nama segmen URL yang tampil">
                </div>
              </div>
              <div class="form-group row ">
                <label for="icon" class="col-sm-3 col-form-label">Icon</label>
                <div class="col-sm-9 kosong">
                  <input type="text" class="form-control" name="icon" id="icon" placeholder="sumber : fontawesome.com">
                </div>
              </div>
              <div class="form-group row ">
                <label for="urutan" class="col-sm-3 col-form-label">Urutan</label>
                <div class="col-sm-9 kosong">
                  <input type="text" class="form-control" name="urutan" id="urutan" placeholder="urutan menu tampil">
                </div>
              </div>
              <div class="form-group row ">
                <label for="is_active" class="col-sm-3 col-form-label">Status</label>
                <div class="col-sm-9 kosong">
                  <select class="form-control" name="is_active" id="is_active">
                    <option value="" selected disabled>Pilih Status</option>
                    <option value="Y">Aktif</option>
                    <option value="N">Non-Aktif</option>
                  </select>
                </div>
              </div>
            </div>
          </form>
          <div class="modal-footer">
            <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
            <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    <!-- End Bootstrap modal -->