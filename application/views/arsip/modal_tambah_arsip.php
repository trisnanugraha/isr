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
                    <input type="hidden" value="" name="id_arsip" />
                    <div class="form-group row ">
                        <label for="nama_arsip" class="col-sm-3 col-form-label">Nama Arsip</label>
                        <div class="col-sm-9 kosong">
                            <input type="text" class="form-control" name="nama_arsip" id="nama_arsip" placeholder="Nama Arsip">
                        </div>
                    </div>
                    <input type="hidden" value="" name="file_arsip" />
                    <div class="form-group row">
                        <label for="berkas_arsip" class="col-sm-3 col-form-label">Upload Arsip</label>
                        <div class="col-sm-9">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" onchange="loadArsip(event)" name="berkas_arsip" id="berkas_arsip">
                                    <label class="custom-file-label" id="label-arsip" for="berkas_arsip">Pilih File</label>
                                </div>
                                <div class="input-group-append">
                                    <a class="btn btn-block bg-gradient-info" id="view_arsip" href="" target="_blank">Preview</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" id="btnSave" onclick="save()" class="btn btn-primary">Simpan</button>
                <button type="button" id="btnCancel" class="btn btn-danger" data-dismiss="modal">Batal</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->