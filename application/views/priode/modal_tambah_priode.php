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
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id_priode" />
                    <div class="form-group row ">
                        <label for="priode" class="col-sm-3 col-form-label">Priode</label>
                        <div class="col-sm-9 kosong">
                            <input type="text" class="form-control" name="priode" id="priode" placeholder="contoh : 2021-01">
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                        <div class="col-sm-9 kosong">
                            <input type="text" class="form-control" name="judul" id="judul" placeholder="contoh : Laporan Penelitian">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_mulai" class="col-sm-3 col-form-label">Tanggal Mulai</label>
                        <div class="col-sm-9 kosong">
                            <input type="date" class="form-control" name="tgl_mulai">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_akhir" class="col-sm-3 col-form-label">Tanggal Akhir</label>
                        <div class="col-sm-9 kosong">
                            <input type="date" class="form-control" name="tgl_akhir">
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9 kosong">
                            <select class="form-control" name="status" id="status">
                                <option value="" selected disabled>Pilih Status</option>
                                <option value="Aktif">Aktif</option>
                                <option value="Non-Aktif">Non-Aktif</option>
                            </select>
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