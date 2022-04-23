<script type="text/javascript">
    var filtering = 0;
    var nama_lv = [];
    var totalPenelitian = [];
    var totalPKM = [];

    $(document).ready(function() {
        $('#tahun').select2({
            placeholder: "-- Tahun --"
        });
        filter();
        // init();
    })

    function filter() {
        $('#tahun').change(function() {
            filtering = $(this).val();
            console.log(filtering)
            // init(filtering)

            $.ajax({
                url: "<?php echo site_url('dashboard/fetch_data') ?>",
                type: "POST",
                data: "tahun=" + filtering,
                dataType: "JSON",
                success: function(data) {
                    // draw(data)
                    var ctx = document.getElementById("chartData").getContext("2d");

                    var bulan = [];
                    var total = [];

                    // for (var i in data.bulan) {
                    //     bulan.push(data.bulan[i].nama_bulan);
                    // }

                    for (var i in data.grafik) {
                        bulan.push(data.grafik[i].bulan);
                        total.push(data.grafik[i].total);
                    }

                    if (data.grafik != undefined) {
                        var dataload = {
                            labels: bulan,
                            datasets: [{
                                label: 'Total Data',
                                data: total,
                                backgroundColor: 'rgba(56, 86, 255, 0.87)',
                                borderColor: 'rgba(56, 86, 255, 0.87)',
                            }],
                        }
                    }

                    var options = {
                        title: {
                            display: true,
                            text: "Data Kegiatan " + data.tahun
                        },
                        scales: {
                            yAxes: [{
                                ticks: {
                                    beginAtZero: true
                                }
                            }]
                        }
                    }

                    document.getElementById("chart-container").innerHTML = '&nbsp;';
                    document.getElementById("chart-container").innerHTML = '<canvas id="chartData"></canvas>';
                    var ctx = document.getElementById("chartData").getContext("2d");

                    //create bar Chart class object
                    var chart1 = new Chart(ctx, {
                        type: "bar",
                        data: dataload,
                        options: options
                    });
                }
            });
        })
    }
</script>