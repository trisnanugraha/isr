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
            <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
                <input type="hidden" value="" name="id" />
                <div class="card-body">
                    <div class="form-group row ">
                        <label for="nama_aplikasi" class="col-sm-3 col-form-label">Nama Aplikasi</label>
                        <div class="col-sm-9 kosong">
                            <input type="text" class="form-control" name="nama_aplikasi" id="nama_aplikasi" placeholder="Nama Aplikasi">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="nama_owner" class="col-sm-3 col-form-label">Nama Owner</label>
                        <div class="col-sm-9 kosong">
                            <input type="text" class="form-control" name="nama_owner" id="nama_owner" placeholder="Nama Owner">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="alamat" class="col-sm-3 col-form-label">Alamat</label>
                        <div class="col-sm-9 kosong">
                            <input type="text" class="form-control" name="alamat" id="alamat" placeholder="Alamat">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="tlp" class="col-sm-3 col-form-label">No Telp</label>
                        <div class="col-sm-9 kosong">
                            <input type="text" class="form-control" name="tlp" id="tlp" placeholder="Telpone">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="title" class="col-sm-3 col-form-label">Title</label>
                        <div class="col-sm-9 kosong">
                            <input type="text" class="form-control" name="title" id="title" placeholder="Title">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="versi" class="col-sm-3 col-form-label">Versi</label>
                        <div class="col-sm-9 kosong">
                            <input type="text" class="form-control" name="versi" id="versi" placeholder="Title">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="copy_right" class="col-sm-3 col-form-label">Copy Right</label>
                        <div class="col-sm-9 kosong">
                            <input type="text" class="form-control" name="copy_right" id="copy_right" placeholder="Copy Right">
                            <span class="help-block"></span>
                        </div>
                    </div>

                    <div class="form-group row ">
                        <label for="tahun" class="col-sm-3 col-form-label">Tahun</label>
                        <div class="col-sm-9 kosong">
                            <input type="text" class="form-control" name="tahun" id="tahun" placeholder="Nama Aplikasi">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="logo" class="col-sm-3 col-form-label">Logo</label>
                        <div class="col-sm-9 kosong">
                            <img id="v_image" width="100px" height="100px">
                            <input type="file" class="form-control btn-file" onchange="loadFile(event)" name="imagefile" id="imagefile" placeholder="Image" value="UPLOAD">
                        </div>
                    </div>
                </div>
            </form>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                <button type="button" id="btnCancel" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->