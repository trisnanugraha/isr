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
                <input type="hidden" value="" name="id" />
                <div class="card-body">
                    <div class="form-group row">
                        <label for="id_menu" class="col-sm-4 col-form-label">Menu</label>
                        <div class="col-sm-8 kosong">
                            <select class="form-control" name="id_menu" id="id_menu">
                                <option value="" selected disabled>Pilih Menu</option>
                                <?php
                                foreach ($menu as $menus) :
                                    echo "<option value='$menus->id_menu' $sel>$menus->nama_menu</option>";
                                endforeach; ?>
                            </select>
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="nama_submenu" class="col-sm-4 col-form-label">Nama Sub Menu</label>
                        <div class="col-sm-8 kosong">
                            <input type="text" class="form-control" name="nama_submenu" id="nama_submenu" placeholder="nama sub menu yang tampil">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="link" class="col-sm-4 col-form-label">Link</label>
                        <div class="col-sm-8 kosong">
                            <input type="text" class="form-control" name="link" id="link" placeholder="nama segmen URL yang tampil">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="icon" class="col-sm-4 col-form-label">Icon</label>
                        <div class="col-sm-8 kosong">
                            <input type="text" class="form-control" name="icon" id="icon" placeholder="sumber : fontawesome.com">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label for="is_active" class="col-sm-4 col-form-label">Status</label>
                        <div class="col-sm-8 kosong">
                            <select class="form-control" name="is_active" id="is_active">
                                <option value="" selected disabled>Pilih Status</option>
                                <option value="Y">Aktif</option>
                                <option value="N">Non-Aktif</option>
                            </select>
                            <span class="help-block"></span>
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