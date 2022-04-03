<!-- Bootstrap modal -->
<div class="modal fade" id="print-report" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title">Export Data</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <form target="_blank" action="<?= base_url('datapenelitian/print') ?>" method="POST" id="form" class="form-horizontal">
                <div class="modal-body form">
                    <div class="form-group row ">
                        <label for="tipeFile" class="col-sm-3 col-form-label">Tipe File</label>
                        <div class="col-sm-9">
                            <select class="form-control selectpicker" name="tipeFile" id="tipeFile">
                                <option value="" disabled selected>-- Pilih Tipe File --</option>
                                <option value="Excel">Excel</option>
                                <option value="PDF">PDF</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <label for="priode" class="col-sm-3 col-form-label">Priode</label>
                        <div class="col-sm-9">
                            <select class="form-control selectpicker" name="priode" id="priode" data-live-search="true">
                                <option value="" disabled selected>-- Pilih Priode --</option>
                                <option value="all">Semua Data</option>
                                <?php
                                foreach ($priode as $pr) { ?>
                                    <option value="<?= $pr->id_priode; ?>"><?= $pr->priode . ' -- ' . $pr->judul; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" id="btnSave" class="btn btn-success">Export</button>
                    <button type="button" id="btnClose" onclick="tutup()" class="btn btn-outline-primary" data-dismiss="modal">Tutup</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->