<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title">Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id_kegiatan" />
                    <div class="form-group row ">
                        <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                        <div class="col-sm-9 kosong">
                            <input type="text" class="form-control" name="judul" id="judul" placeholder="Judul Kegiatan">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal" class="col-sm-3 col-form-label">Tanggal</label>
                        <div class="col-sm-9 kosong">
                            <input type="date" class="form-control" name="tanggal">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-3 col-form-label">Keterangan</label>
                        <div class="col-sm-9">
                            <textarea type="text" class="form-control" name="keterangan" id="keterangan" rows="5" style="resize: none;"></textarea>
                        </div>
                    </div>
                    <input type="hidden" value="" name="fileFoto1" />
                    <div class="form-group row">
                        <label for="foto" class="col-sm-3 col-form-label">Foto</label>
                        <div class="input-group col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" onchange="loadFoto(event)" name="foto" id="foto">
                                <label class="custom-file-label" id="label-foto" for="foto">Pilih File</label>
                            </div>
                            <div class="input-group-append">
                                <a class="btn btn-block bg-gradient-info" id="view_foto" href="" target="_blank">Preview</a>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="" name="fileFoto2" />
                    <div class="form-group row">
                        <label for="foto2" class="col-sm-3 col-form-label">Foto</label>
                        <div class="input-group col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" onchange="loadFoto2(event)" name="foto2" id="foto2">
                                <label class="custom-file-label" id="label-foto2" for="foto2">Pilih File</label>
                            </div>
                            <div class="input-group-append">
                                <a class="btn btn-block bg-gradient-info" id="view_foto2" href="" target="_blank">Preview</a>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="" name="fileFoto3" />
                    <div class="form-group row">
                        <label for="foto3" class="col-sm-3 col-form-label">Foto</label>
                        <div class="input-group col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" onchange="loadFoto3(event)" name="foto3" id="foto3">
                                <label class="custom-file-label" id="label-foto3" for="foto3">Pilih File</label>
                            </div>
                            <div class="input-group-append">
                                <a class="btn btn-block bg-gradient-info" id="view_foto3" href="" target="_blank">Preview</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                <button type="button" id="btnCancel" class="btn btn-danger" onclick="batal()" data-dismiss="modal">Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->