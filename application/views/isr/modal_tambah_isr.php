<!-- Bootstrap modal -->
<div class="modal fade" id="modal_form" role="dialog" data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">

            <div class="modal-header">
                <h3 class="modal-title">Form</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

            </div>
            <div class="modal-body form">
                <form action="#" id="form" class="form-horizontal">
                    <input type="hidden" value="" name="id_isr" id="id_isr" />
                    <div class="form-group row ">
                        <div class="col-sm-12 kosong">
                            <label for="cluster" class="col-form-label">Cluster</label>
                            <select class="form-control select2" name="cluster" id="cluster">
                                <option value="0" selected disabled>-- Pilih Cluster --</option>
                                <?php
                                foreach ($cluster as $c) { ?>
                                    <option value="<?= $c->id_cluster; ?>"><?= $c->nama_cluster; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-sm-12 kosong">
                            <label for="induk_isr" class="col-form-label">Induk ISR</label>
                            <input type="text" class="form-control" name="induk_isr" id="induk_isr" placeholder="Induk ISR">
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-sm-4">
                            <label for="site_id" class="col-form-label">Site ID</label>
                            <input type="text" class="form-control" name="site_id" id="site_id" placeholder="Site ID">
                        </div>
                        <div class="col-sm-4">
                            <label for="rr" class="col-form-label">RR</label>
                            <input type="text" class="form-control" name="rr" id="rr" placeholder="RR">
                        </div>
                        <div class="col-sm-4">
                            <label for="apl_id" class="col-form-label">APL ID</label>
                            <input type="text" class="form-control" name="apl_id" id="apl_id" placeholder="APL ID">
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-sm-6">
                            <label for="isr_tx" class="col-form-label">ISR TX</label>
                            <input type="text" class="form-control" name="isr_tx" id="isr_tx" placeholder="ISR TX">
                        </div>
                        <div class="col-sm-6">
                            <label for="isr_rx" class="col-form-label">ISR RX</label>
                            <input type="text" class="form-control" name="isr_rx" id="isr_rx" placeholder="ISR RX">
                        </div>
                    </div>
                    <div class="form-group row ">
                        <div class="col-sm-6">
                            <label for="actual_tx" class="col-form-label">ACTUAL TX</label>
                            <input type="text" class="form-control" name="actual_tx" id="actual_tx" placeholder="ACTUAL TX">
                        </div>
                        <div class="col-sm-6">
                            <label for="actual_rx" class="col-form-label">ACTUAL RX</label>
                            <input type="text" class="form-control" name="actual_rx" id="actual_rx" placeholder="ACTUAL RX">
                        </div>
                    </div>
                    <div class="center">
                        <button type="button" onclick="tambah_data()" class="btn btn-success col-12">Tambah Baru</button>
                    </div>
                    <br>
                    <br>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="3"></th>
                                <th colspan="2" style="text-align:center;">ISR</th>
                                <th colspan="2" style="text-align:center;">ACTUAL</th>
                            </tr>
                            <tr>
                                <th hidden>ID</th>
                                <th style="text-align:center;">Site ID</th>
                                <th style="text-align:center;">RR</th>
                                <th style="text-align:center;">APL ID</th>
                                <th style="text-align:center;">TX</th>
                                <th style="text-align:center;">RX</th>
                                <th style="text-align:center;">TX</th>
                                <th style="text-align:center;">RX</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="dynamic_field">
                        </tbody>
                    </table>
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