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
                    <input type="hidden" value="" name="id_isr" />
                    <p>Cluster : <strong><?php echo $isr->nama_cluster; ?></strong></p>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th colspan="3" class="text-center"><?php echo $isr->induk_isr; ?></th>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($detail_isr as $isr) {
                                $i = 0;
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $isr->site_id; ?></td>
                                    <td class="text-center"><?php echo $isr->rr; ?></td>
                                    <td class="text-center"><?php echo $isr->apl_id; ?></td>
                                    <td class="text-center"><?php echo $isr->isr_tx; ?></td>
                                    <td class="text-center"><?php echo $isr->isr_rx; ?></td>
                                    <td class="text-center"><?php echo $isr->actual_tx; ?></td>
                                    <td class="text-center"><?php echo $isr->actual_rx; ?></td>
                                </tr>
                            <?php $i++;
                            };
                            ?>
                        </tbody>
                    </table>
                </form>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" onclick="batal()" data-dismiss="modal"> Tutup</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- End Bootstrap modal -->