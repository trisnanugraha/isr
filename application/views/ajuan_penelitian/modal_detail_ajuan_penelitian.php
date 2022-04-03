<div class="modal fade" id="modal_form_detail" role="dialog" data-backdrop="static">
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
                    <!-- <input type="hidden" value="<?php echo $dataPenelitian->id_ajuan_penelitian; ?>" name="id_ajuan_penelitian" /> -->
                    <div class="form-group row ">
                        <label for="priode" class="col-sm-3 col-form-label">Priode</label>
                        <div class="col-sm-9">
                            <textarea type="text" class="form-control" name="priode" id="priode" rows="5" style="resize: none; background-color: white;" readonly><?php echo $dataPenelitian->judul; ?></textarea>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="judul" class="col-sm-3 col-form-label">Judul</label>
                        <div class="col-sm-9">
                            <textarea type="text" class="form-control" name="judul" id="judul" rows="5" style="resize: none; background-color: white;" readonly><?php echo $dataPenelitian->judul_penelitian; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="skema" class="col-sm-3 col-form-label">Skema</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="skema" id="skema"><?php echo $dataPenelitian->nama_skema; ?></p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="skema" class="col-sm-3 col-form-label">Ketua Pengusul</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="ketua" id="ketua"><?php echo $dataPenelitian->ketua; ?></p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="skema" class="col-sm-3 col-form-label">Anggota 1 (Opsional)</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="anggota1" id="anggota1"><?php echo $anggota['anggota1']; ?></p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="skema" class="col-sm-3 col-form-label">Anggota 2 (Opsional)</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="anggota2" id="anggota2"><?php echo $anggota['anggota2']; ?></p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="skema" class="col-sm-3 col-form-label">Anggota 3 (Opsional)</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="anggota3" id="anggota3"><?php echo $anggota['anggota3']; ?></p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="skema" class="col-sm-3 col-form-label">Anggota 4 (Opsional)</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="anggota4" id="anggota4"><?php echo $anggota['anggota4']; ?></p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="skema" class="col-sm-3 col-form-label">Anggota 5 (Opsional)</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="anggota5" id="anggota5"><?php echo $anggota['anggota5']; ?></p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="anggaran" class="col-sm-3 col-form-label">Anggaran Biaya</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="anggaran" id="anggaran"><?php echo 'Rp ' . rupiah($dataPenelitian->anggaran); ?></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi" class="col-sm-3 col-form-label">Lokasi</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="lokasi" id="lokasi"><?php echo $dataPenelitian->lokasi; ?></p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="jurnal" class="col-sm-3 col-form-label">Nama Jurnal</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="jurnal" id="jurnal"><?php echo $dataPenelitian->nama_jurnal; ?></p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="peringkat" class="col-sm-3 col-form-label">Peringkat Jurnal</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="peringkat" id="peringkat"><?php echo $dataPenelitian->peringkat_jurnal; ?></p>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="link" class="col-sm-3 col-form-label">Link Jurnal</label>
                        <div class="col-sm-9">
                            <a href="<?php echo $dataPenelitian->link_jurnal; ?>" class="form-control" name="link" id="link" target="_blank"><?php echo $dataPenelitian->link_jurnal; ?></a>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="eissn" class="col-sm-3 col-form-label">E-ISSN</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="eissn" id="eissn"><?php echo $dataPenelitian->e_issn; ?></p>
                        </div>
                    </div>
                    <?php
                    if ($dataPenelitian->berkas_laporan == '' || $dataPenelitian->berkas_laporan == null) {
                        $berkasLaporan = '';
                    } else {
                        $berkasLaporan = 'upload/penelitian/laporan/' . $dataPenelitian->berkas_laporan;
                    }
                    if ($dataPenelitian->berkas_jurnal == '' || $dataPenelitian->berkas_jurnal == null) {
                        $berkasJurnal = '';
                    } else {
                        $berkasJurnal = 'upload/penelitian/jurnal/' . $dataPenelitian->berkas_jurnal;
                    }
                    if ($dataPenelitian->berkas_review == '' || $dataPenelitian->berkas_review == null) {
                        $berkasReview = '';
                    } else {
                        $berkasReview = 'upload/review/penelitian/' . $dataPenelitian->berkas_review;
                    }
                    ?>
                    <div class="form-group row">
                        <label for="berkaslaporan" class="col-sm-3 col-form-label">Berkas Laporan</label>
                        <div class="col-sm-2">
                            <a class="btn btn-block bg-gradient-info" id="view_laporan" href="<?php echo $berkasLaporan; ?>" target="_blank">Preview</a>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="berkasjurnal" class="col-sm-3 col-form-label">Berkas Jurnal</label>
                        <div class="col-sm-2">
                            <a class="btn btn-block bg-gradient-info" id="view_jurnal" href="<?php echo $berkasJurnal; ?>" target="_blank">Preview</a>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_pengajuan" class="col-sm-3 col-form-label">Tanggal Pengajuan</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="tgl_pengajuan" id="tgl_pengajuan"><?php echo tgl_indonesia($dataPenelitian->tgl_dibuat); ?></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_diubah" class="col-sm-3 col-form-label">Terakhir Diubah</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="tgl_diubah" id="tgl_diubah"><?php if ($dataPenelitian->tgl_diubah == NULL) {
                                                                                                echo "-";
                                                                                            } else {
                                                                                                echo tgl_indonesia($dataPenelitian->tgl_diubah);
                                                                                            }
                                                                                            ?></p>
                        </div>
                    </div>
                    <br>
                    <br>
                    <p><strong>LPPM</strong></p>
                    <div class="form-group row ">
                        <label for="status" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="status" id="status"><?php echo $dataPenelitian->status; ?></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-sm-3 col-form-label">Komentar</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="komentar_lppm" id="komentar_lppm" rows="5" style="resize: none; background-color: white;" readonly><?php echo $dataPenelitian->komentar_lppm; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_validasi_lppm" class="col-sm-3 col-form-label">Terakhir Diubah</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="tgl_validasi_lppm" id="tgl_validasi_lppm">
                                <?php if ($dataPenelitian->tgl_validasi_lppm == NULL) {
                                    echo "-";
                                } else {
                                    echo tgl_indonesia($dataPenelitian->tgl_validasi_lppm);
                                }
                                ?></p>
                        </div>
                    </div>
                    <br>
                    <p><strong>Reviewer</strong></p>
                    <div class="form-group row">
                        <label for="nama_reviewer" class="col-sm-3 col-form-label">Nama Reviewer</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="nama_reviewer" id="nama_reviewer"><?php
                                                                                                    if ($idReviewer->id_reviewer == null || $idReviewer->id_reviewer == '') {
                                                                                                        echo "Reviewer Belum Dipilih";
                                                                                                    } else {
                                                                                                        echo $dataPenelitian->nama_reviewer;
                                                                                                    }
                                                                                                    ?></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status_reviewer" class="col-sm-3 col-form-label">Status</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="status_reviewer" id="status_reviewer"><?php
                                                                                                        if ($idReviewer->id_reviewer == null || $idReviewer->id_reviewer == '') {
                                                                                                            echo "Status Reviewer Belum Tersedia";
                                                                                                        } else {
                                                                                                            echo $dataPenelitian->status_reviewer;
                                                                                                        }
                                                                                                        ?></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="komentar_reviewer" class="col-sm-3 col-form-label">Komentar</label>
                        <div class="col-sm-9">
                            <textarea class="form-control" name="komentar_reviewer" id="komentar_reviewer" rows="5" readonly style="resize: none; background-color: white;"><?php echo $dataPenelitian->komentar_reviewer; ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tgl_validasi_reviewer" class="col-sm-3 col-form-label">Terakhir Diubah</label>
                        <div class="col-sm-9">
                            <p class="form-control my-0" name="tgl_validasi_reviewer" id="tgl_validasi_reviewer">
                                <?php if ($dataPenelitian->tgl_validasi_reviewer == NULL) {
                                    echo "-";
                                } else {
                                    echo tgl_indonesia($dataPenelitian->tgl_validasi_reviewer);
                                }
                                ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="berkas_review" class="col-sm-3 col-form-label">Hasil Review</label>
                        <div class="col-sm-2">
                            <a class="btn btn-block bg-gradient-info" id="berkas_review" href="<?php echo $berkasReview; ?>" target="_blank">Preview</a>
                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <div class="text-right">
                    <button class="btn btn-primary" onclick="batal()" data-dismiss="modal"> Tutup</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->