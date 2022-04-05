<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form_detail" role="dialog" data-backdrop="static">
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
                    <div class="form-group row">
                        <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                        <div class="col-sm-10">
                            <p class="form-control my-0" name="judul" id="judul"><?php echo $judul; ?></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-10">
                            <p class="form-control my-0" name="judul" id="judul"><?php echo $this->fungsi->tanggalindo($tanggal); ?></p>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="keterangan" class="col-sm-2 col-form-label">Keterangan</label>
                        <div class="col-sm-10">
                            <textarea type="text" class="form-control" name="keterangan" id="keterangan" rows="5" style="resize: none; background:white;" readonly><?php echo $keterangan; ?></textarea>
                        </div>
                    </div>
                    <?php
                    if (!empty($foto)) { ?>
                        <div class="form-group row">
                            <label for="foto" class="col-sm-2 col-form-label">Foto</label>
                            <div class="input-group col-sm-10">
                                <img src="<?php echo base_url("upload/kegiatan/{$foto}") ?>" alt="" width="50%" class="rounded">
                            </div>
                        </div>
                    <?php };
                    ?>

                    <?php
                    if (!empty($foto2)) { ?>
                        <div class="form-group row">
                            <label for="foto2" class="col-sm-2 col-form-label"></label>
                            <div class="input-group col-sm-10">
                                <img src="<?php echo base_url("upload/kegiatan/{$foto2}") ?>" alt="" width="50%" class="rounded">
                            </div>
                        </div>
                    <?php };
                    ?>

                    <?php
                    if (!empty($foto3)) { ?>
                        <div class="form-group row">
                            <label for="foto3" class="col-sm-2 col-form-label"></label>
                            <div class="input-group col-sm-10">
                                <img src="<?php echo base_url("upload/kegiatan/{$foto3}") ?>" alt="" width="50%" class="rounded">
                            </div>
                        </div>
                    <?php };
                    ?>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="batal()" data-dismiss="modal"> Tutup</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->