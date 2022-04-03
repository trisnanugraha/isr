<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title">Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>

            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" value="" name="id_ajuan_pkm" />
                    <div class="form-group row">
                        <label for="priode" class="col-sm-3 col-form-label">Priode</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="priode" id="priode" rows="5" style="resize: none; background-color: white;" readonly></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="judul" id="judul" rows="5" style="resize: none; background-color: white;" readonly></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="skema" class="col-sm-3 col-form-label">Skema</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="skema" id="skema"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ketua" class="col-sm-3 col-form-label">Ketua Pengusul</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="ketua" id="ketua"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="anggaran" class="col-sm-3 col-form-label">Anggaran Biaya</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="anggaran" id="anggaran"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi" class="col-sm-3 col-form-label">Lokasi</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="lokasi" id="lokasi"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jurnal" class="col-sm-3 col-form-label">Nama Jurnal</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="jurnal" id="jurnal"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="peringkat" class="col-sm-3 col-form-label">Peringkat Jurnal</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="peringkat" id="peringkat"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="link" class="col-sm-3 col-form-label">Link Jurnal</label>
                        <div class="col-sm-9">
                            <a href="" class="form-control" name="link" id="link" target="_blank"></a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="eissn" class="col-sm-3 col-form-label">E-ISSN</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="eissn" id="eissn"></p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="berkaslaporan" class="col-sm-3 col-form-label">Berkas Laporan</label>
                        <div class="col-sm-2">
                            <a href="" class="text-white btn btn-block bg-gradient-info" name="berkaslaporan" id="berkaslaporan" target="_blank">Preview</a>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="berkasjurnal" class="col-sm-3 col-form-label">Berkas Jurnal</label>
                        <div class="col-sm-2">
                            <a href="" class="text-white btn btn-block bg-gradient-info" name="berkasjurnal" id="berkasjurnal" target="_blank">Preview</a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_pengajuan" class="col-sm-3 col-form-label">Tanggal Pengajuan</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="tgl_pengajuan" id="tgl_pengajuan"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_diubah" class="col-sm-3 col-form-label">Terakhir Diubah</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="tgl_diubah" id="tgl_diubah"></p>
                        </div>
                    </div>
                    <br>
                    <p><strong>LPPM</strong></p>
                    <div class="form-group row">
                        <label for="tgl_diubah" class="col-sm-3 col-form-label">Terakhir Diubah</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="tgl_validasi_lppm" id="tgl_validasi_lppm"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="status" id="status"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="komentar_lppm" class="col-sm-3 col-form-label">Komentar</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="komentar_lppm" id="komentar_lppm" rows="5" readonly style="resize: none;"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="reviewer" class="col-sm-3 col-form-label">Kirim ke Reviewer</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="reviewer" id="reviewer"></p>
                        </div>
                    </div>
                    <br>
                    <p><strong>Reviewer</strong></p>
                    <div class="form-group row">
                        <label for="tgl_validasi_reviewer" class="col-sm-3 col-form-label">Terakhir Diubah</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="tgl_validasi_reviewer" id="tgl_validasi_reviewer"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_reviewer" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9 kosong">
                            <select class="form-control" name="status_reviewer" id="status_reviewer">
                                <option value="" disabled selected>Pilih Status</option>
                                <option value="On Process">On Process</option>
                                <option value="Need Revision">Need Revision</option>
                                <option value="On Review">On Review</option>
                                <option value="Decline">Decline</option>
                                <option value="Approve">Approve</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="komentar_reviewer" class="col-sm-3 col-form-label">Komentar</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="komentar_reviewer" id="komentar_reviewer" rows="5" style="resize: none;"></textarea>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="template" class="col-sm-3 col-form-label">Form Review</label>
                        <div class="col-sm-3">
                            <a href="<?php echo base_url($link); ?>" class="text-white btn btn-block bg-gradient-info" download="<?php echo @$filename; ?>" name="template" id="template" target="_blank">Download Form</a>
                        </div>
                    </div>
                    <input type="hidden" value="" name="filereview" />
                    <div class="form-group row">
                        <label for="berkasreview" class="col-sm-3 col-form-label">Hasil Review</label>
                        <div class="input-group col-sm-9 kosong">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" onchange="loadReview(event)" name="berkasreview" id="berkasreview">
                                <label class="custom-file-label" id="label-review" for="berkasreview">Pilih File</label>
                            </div>
                            <div class="input-group-append">
                                <a class="btn btn-block bg-gradient-info" id="view_review" href="" target="_blank">Preview</a>
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