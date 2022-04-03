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
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id_ajuan_penelitian" />
                    <div class="form-group row ">
                        <label for="priode" class="col-sm-3 col-form-label">Priode</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="priode" id="priode" rows="5" style="resize: none; background-color: white;" readonly></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                        <div class="col-sm-9">
                            <!-- <p class="form-control my-0" name="judul" id="judul"></p> -->
                            <textarea class="form-control" name="judul" id="judul" rows="5" style="resize: none; background-color: white;" readonly></textarea>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="skema" class="col-sm-3 col-form-label">Skema</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="skema" id="skema"></p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="skema" class="col-sm-3 col-form-label">Ketua Pengusul</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="ketua" id="ketua"></p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="skema" class="col-sm-3 col-form-label">Anggota 1 (Opsional)</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="anggota1" id="anggota1"></p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="skema" class="col-sm-3 col-form-label">Anggota 3 (Opsional)</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="anggota2" id="anggota2"></p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="skema" class="col-sm-3 col-form-label">Anggota 3 (Opsional)</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="anggota3" id="anggota3"></p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="skema" class="col-sm-3 col-form-label">Anggota 4 (Opsional)</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="anggota4" id="anggota4"></p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="skema" class="col-sm-3 col-form-label">Anggota 5 (Opsional)</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="anggota5" id="anggota5"></p>
                        </div>
                    </div>
                    <div class="form-group row ">
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
                    <div class="form-group row ">
                        <label for="jurnal" class="col-sm-3 col-form-label">Nama Jurnal</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="jurnal" id="jurnal"></p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="peringkat" class="col-sm-3 col-form-label">Peringkat Jurnal</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="peringkat" id="peringkat"></p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="link" class="col-sm-3 col-form-label">Link Jurnal</label>
                        <div class="col-sm-9">
                            <a href="" class="form-control" name="link" id="link" target="_blank"></a>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="eissn" class="col-sm-3 col-form-label">E-ISSN</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="eissn" id="eissn"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="berkaslaporan" class="col-sm-3 col-form-label">Berkas Laporan</label>
                        <div class="col-sm-3">
                            <a class="btn btn-block bg-gradient-info" id="view_laporan" href="" target="_blank">Preview</a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="berkasjurnal" class="col-sm-3 col-form-label">Berkas Jurnal</label>
                        <div class="col-sm-3">
                            <a class="btn btn-block bg-gradient-info" id="view_jurnal" href="" target="_blank">Preview</a>
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
                    <div class="form-group row ">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9 kosong">
                            <select class="form-control status" name="status" id="status">
                                <option value="" selected disabled>Pilih Peringkat Jurnal</option>
                                <option value="On Process">On Process</option>
                                <option value="Need Revision">Need Revision</option>
                                <option value="On Review">On Review</option>
                                <option value="Decline">Decline</option>
                                <option value="Approve">Approve</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label">Komentar</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="komentar_lppm" id="komentar_lppm" rows="5" style="resize: none;"></textarea>
                        </div>
                    </div>
                    <div class="form-group row kirim-reviewer">
                        <label for="status" class="col-sm-3 col-form-label">Kirim ke Reviewer</label>
                        <div class="col-sm-9">
                            <select class="form-control selectpicker" name="reviewer" id="reviewer" data-live-search="true">
                                <option value="" selected disabled>Pilih Reviewer</option>
                                <?php
                                foreach ($reviewer as $r) { ?>
                                    <option value="<?= $r->id_user; ?>"><?= $r->full_name; ?></option>
                                <?php } ?>
                            </select>
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
                        <label for="nama_reviewer" class="col-sm-3 col-form-label">Nama Reviewer</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="nama_reviewer" id="nama_reviewer"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_reviewer" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="status_reviewer" id="status_reviewer"></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="komentar_reviewer" class="col-sm-3 col-form-label">Komentar</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="komentar_reviewer" id="komentar_reviewer" rows="5" readonly style="resize: none; background-color: white;"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="berkas_review" class="col-sm-3 col-form-label">Hasil Review</label>
                        <div class="col-sm-3">
                            <a class="btn btn-block bg-gradient-info" id="berkas_review" href="" target="_blank">Preview</a>
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