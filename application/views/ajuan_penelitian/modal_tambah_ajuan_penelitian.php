<div class="modal fade" id="modal_form" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
        <div class=" modal-content">

            <div class="modal-header">
                <h3 class="modal-title">Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal" enctype="multipart/form-data">
                    <input type="hidden" value="" name="id_ajuan_penelitian" />
                    <div class="form-group row ">
                        <label for="priode" class="col-sm-3 col-form-label">Priode</label>
                        <div class="col-sm-9 kosong">
                            <select class="form-control" name="priode" id="priode">
                                <option value="" disabled selected>-- Pilih Priode --</option>
                                <?php
                                foreach ($priode as $pr) {
                                    if (strtotime(date('Y-m-d')) >= strtotime($pr->tgl_mulai) && strtotime(date('Y-m-d')) <= strtotime($pr->tgl_akhir)) {
                                ?>
                                        <option value="<?= $pr->id_priode; ?>"><?= $pr->judul; ?></option>
                                <?php }
                                } ?>
                            </select>
                            <div class="input-group-append"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                        <div class="col-sm-9 kosong">
                            <textarea type="text" class="form-control" name="judul" id="judul" rows="5" style="resize: none;"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="skema" class="col-sm-3 col-form-label">Skema</label>
                        <div class="col-sm-9 kosong">
                            <select class="form-control" name="skema" id="skema">
                                <option value="" disabled selected>-- Pilih Skema --</option>
                                <?php
                                foreach ($skema as $s) { ?>
                                    <option value="<?= $s->id_skema_penelitian; ?>"><?= $s->nama_skema; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="anggota1" class="col-sm-3 col-form-label">Anggota 1 (Opsional)</label>
                        <div class="col-sm-9">
                            <select class="form-control select2 selectpicker anggota" name="anggota1" id="anggota1" style="width: 100%;" data-live-search="true">
                                <option value="0" selected>-- Pilih Anggota --</option>
                                <?php
                                foreach ($user as $u) { ?>
                                    <option value="<?= $u->id_user; ?>"><?= $u->full_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="anggota2" class="col-sm-3 col-form-label">Anggota 2 (Opsional)</label>
                        <div class="col-sm-9">
                            <select class="form-control select2 selectpicker anggota" name="anggota2" id="anggota2" style="width: 100%;" data-live-search="true">
                                <option value="0" selected>-- Pilih Anggota --</option>
                                <?php
                                foreach ($user as $u) { ?>
                                    <option value="<?= $u->id_user; ?>"><?= $u->full_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="anggota3" class="col-sm-3 col-form-label">Anggota 3 (Opsional)</label>
                        <div class="col-sm-9">
                            <select class="form-control select2 selectpicker anggota" name="anggota3" id="anggota3" style="width: 100%;" data-live-search="true">
                                <option value="0" selected>-- Pilih Anggota --</option>
                                <?php
                                foreach ($user as $u) { ?>
                                    <option value="<?= $u->id_user; ?>"><?= $u->full_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="anggota4" class="col-sm-3 col-form-label">Anggota 4 (Opsional)</label>
                        <div class="col-sm-9">
                            <select class="form-control select2 selectpicker anggota" name="anggota4" id="anggota4" style="width: 100%;" data-live-search="true">
                                <option value="0" selected>-- Pilih Anggota --</option>
                                <?php
                                foreach ($user as $u) { ?>
                                    <option value="<?= $u->id_user; ?>"><?= $u->full_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="anggota5" class="col-sm-3 col-form-label">Anggota 5 (Opsional)</label>
                        <div class="col-sm-9">
                            <select class="form-control select2 selectpicker anggota" name="anggota5" id="anggota5" style="width: 100%;" data-live-search="true">
                                <option value="0" selected>-- Pilih Anggota --</option>
                                <?php
                                foreach ($user as $u) { ?>
                                    <option value="<?= $u->id_user; ?>"><?= $u->full_name; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="anggaran" class="col-sm-3 col-form-label">Anggaran Biaya</label>
                        <div class="col-sm-9 kosong">
                            <input type="text" class="form-control" name="anggaran" id="anggaran">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi" class="col-sm-3 col-form-label">Lokasi</label>
                        <div class="col-sm-9 kosong">
                            <input type="text" class="form-control" name="lokasi" id="lokasi">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jurnal" class="col-sm-3 col-form-label">Nama Jurnal</label>
                        <div class="col-sm-9 kosong">
                            <input type="text" class="form-control" name="jurnal" id="jurnal">
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="peringkat" class="col-sm-3 col-form-label">Peringkat Jurnal</label>
                        <div class="col-sm-9 kosong">
                            <select class="form-control" name="peringkat" id="peringkat">
                                <option value="" disabled selected>-- Pilih Peringkat Jurnal --</option>
                                <option value="Internasional">Internasional</option>
                                <option value="Nasional">Nasional</option>
                                <option value="Sinta 1">Sinta 1</option>
                                <option value="Sinta 2">Sinta 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="link" class="col-sm-3 col-form-label">Link Jurnal</label>
                        <div class="col-sm-9 kosong">
                            <input type="text" class="form-control" name="link" id="link">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="eissn" class="col-sm-3 col-form-label">E-ISSN</label>
                        <div class="col-sm-9 kosong">
                            <input type="text" class="form-control" name="eissn" id="eissn">
                        </div>
                    </div>
                    <input type="hidden" value="" name="filelaporan" />
                    <div class="form-group row">
                        <label for="berkaslaporan" class="col-sm-3 col-form-label">Berkas Laporan</label>
                        <div class="col-sm-9 kosong">
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" onchange="loadLaporan(event)" name="berkaslaporan" id="berkaslaporan">
                                    <label class="custom-file-label" id="label-laporan" for="berkaslaporan">Pilih File</label>
                                </div>
                                <div class="input-group-append">
                                    <a class="btn btn-block bg-gradient-info" id="view_laporan" href="" target="_blank">Preview</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" value="" name="filejurnal" />
                    <div class="form-group row">
                        <label for="berkasjurnal" class="col-sm-3 col-form-label">Berkas Jurnal</label>
                        <div class="input-group col-sm-9 kosong">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" onchange="loadJurnal(event)" name="berkasjurnal" id="berkasjurnal">
                                <label class="custom-file-label" id="label-jurnal" for="berkasjurnal">Pilih File</label>
                            </div>
                            <div class="input-group-append">
                                <a class="btn btn-block bg-gradient-info" id="view_jurnal" href="" target="_blank">Preview</a>
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