<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3><?php echo $kegiatan; ?></h3>

                        <p>Total Kegiatan</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-chart-line"></i>
                    </div>
                    <a href="<?php echo base_url('kegiatan'); ?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-primary">
                    <div class="inner">
                        <h3><?php echo $arsip; ?></h3>

                        <p>Total Arsip</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-archive"></i>
                    </div>
                    <a href="<?php echo base_url('arsip'); ?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <!-- small box -->
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3><?php echo $penelitian; ?></h3>

                        <p>Total ISR</p>
                    </div>
                    <div class="icon">
                        <i class="fas fa-database"></i>
                    </div>
                    <a href="<?php echo base_url('datapenelitian'); ?>" class="small-box-footer">Detail <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
        <br>
        <div id="graph"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-success">
                    <div class="card-header">
                        <h3 class="card-title col-form-label">Data Grafik Priode</h3>
                        <div class="card-tools col-sm-4">
                            <!-- <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                            <button type="button" class="btn btn-tool" data-card-widget="remove">
                                <i class="fas fa-times"></i>
                            </button> -->
                            <div>
                                <select class="form-control select2" name="priode" id="priode">
                                    <option value="" selected disabled>Pilih Priode</option>
                                    <?php
                                    foreach ($periode as $pr) { ?>
                                        <option value="<?= $pr->id_priode; ?>"><?= $pr->priode; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0" style="display: block;">
                        <div class="chart">
                            <div class="chartjs-size-monitor">
                                <div class="chartjs-size-monitor-expand">
                                    <div class=""></div>
                                </div>
                                <div class="chartjs-size-monitor-shrink">
                                    <div class=""></div>
                                </div>
                            </div>
                            <div id="chart-container">
                                <canvas id="chartData" class="chartjs-render-monitor"></canvas>

                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
    <!-- /.row -->
</section>