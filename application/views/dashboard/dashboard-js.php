<script type="text/javascript">
    var filtering = 0;
    var nama_lv = [];
    var totalPenelitian = [];
    var totalPKM = [];

    $(document).ready(function() {
        $('#priode').select2({
            placeholder: "-- Pilih Priode --"
        });
        filter();
        // init();
    })

    function filter() {
        $('#priode').change(function() {
            filtering = $(this).val();
            // console.log(filtering)
            // init(filtering)

            $.ajax({
                url: "<?php echo site_url('dashboard/fetch_data') ?>",
                type: "POST",
                data: "idPriode=" + filtering,
                dataType: "JSON",
                success: function(data) {
                    // draw(data)
                    var ctx = document.getElementById("chartData").getContext("2d");
                    // var cData = JSON.parse(data);
                    // console.log(cData)

                    // // var color = [];

                    nama_lv = data.nama_level;
                    totalPenelitian = data.total;
                    totalPKM = data.totalPKM;

                    // console.log(nama_lv)

                    if (totalPenelitian != undefined && totalPKM != undefined) {
                        var dataload = {
                            labels: nama_lv,
                            datasets: [{
                                label: 'Penelitian',
                                data: totalPenelitian,
                                backgroundColor: 'rgb(255, 99, 132)',
                                borderColor: 'rgb(255, 99, 132)',
                            }, {
                                label: 'PKM',
                                data: totalPKM,
                                backgroundColor: 'rgba(56, 86, 255, 0.87)',
                                borderColor: 'rgba(56, 86, 255, 0.87)',
                            }],
                        }
                    } else if (totalPenelitian != undefined && totalPKM == undefined) {
                        var dataload = {
                            labels: nama_lv,
                            datasets: [{
                                label: 'Penelitian',
                                data: totalPenelitian,
                                backgroundColor: 'rgb(255, 99, 132)',
                                borderColor: 'rgb(255, 99, 132)',
                            }],
                        }
                    } else if (totalPenelitian == undefined && totalPKM != undefined) {
                        var dataload = {
                            labels: data.nama_level_pkm,
                            datasets: [{
                                label: 'PKM',
                                data: totalPKM,
                                backgroundColor: 'rgba(56, 86, 255, 0.87)',
                                borderColor: 'rgba(56, 86, 255, 0.87)',
                            }],
                        }
                    }




                    var options = {
                        title: {
                            display: true,
                            text: "Data Priode " + data.priode
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