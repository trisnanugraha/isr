<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $penelitian; ?></h3>

                        <p>Total Pengajuan Penelitian</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-import"></i>
                    </div>
                    <a href="<?php echo base_url('ajuanpenelitian'); ?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3><?php echo $pkm; ?></h3>

                        <p>Total Pengajuan PKM</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-file-import"></i>
                    </div>
                    <a href="<?php echo base_url('ajuanpkm'); ?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</section>