<!-- Modal Custom Settings-->
<div class="modal fade right" id="Settingmodal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog  modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Custom Settings</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body custom_setting">
                <!-- Settings: Color -->
                <div class="setting-theme pb-3">
                    <h6 class="card-title mb-2 fs-6 d-flex align-items-center"><i class="icofont-color-bucket fs-4 me-2 text-primary"></i>Template Color Settings</h6>
                    <ul class="list-unstyled row row-cols-3 g-2 choose-skin mb-2 mt-2">
                        <li data-theme="indigo">
                            <div class="indigo"></div>
                        </li>
                        <li data-theme="tradewind">
                            <div class="tradewind"></div>
                        </li>
                        <li data-theme="monalisa">
                            <div class="monalisa"></div>
                        </li>
                        <li data-theme="blue">
                            <div class="blue"></div>
                        </li>
                        <li data-theme="cyan">
                            <div class="cyan"></div>
                        </li>
                        <li data-theme="green">
                            <div class="green"></div>
                        </li>
                        <li data-theme="orange" class="active">
                            <div class="orange"></div>
                        </li>
                        <li data-theme="blush">
                            <div class="blush"></div>
                        </li>
                        <li data-theme="red">
                            <div class="red"></div>
                        </li>
                    </ul>
                </div>
                <!-- Settings: Template dynamics -->
                <div class="dynamic-block py-3">
                    <ul class="list-unstyled choose-skin mb-2 mt-1">
                        <li data-theme="dynamic">
                            <div class="dynamic"><i class="icofont-paint me-2"></i> Use Dynamic Template</div>
                        </li>
                    </ul>
                    <div class="dt-setting">
                        <ul class="list-group list-unstyled mt-1">
                            <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                <label>Primary Color</label>
                                <button id="primaryColorPicker" class="btn bg-primary avatar xs border-0 rounded-0"></button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                <label>Secondary Color</label>
                                <button id="secondaryColorPicker" class="btn bg-secondary avatar xs border-0 rounded-0"></button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                <label class="text-muted">Chart Color 1</label>
                                <button id="chartColorPicker1" class="btn chart-color1 avatar xs border-0 rounded-0"></button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                <label class="text-muted">Chart Color 2</label>
                                <button id="chartColorPicker2" class="btn chart-color2 avatar xs border-0 rounded-0"></button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                <label class="text-muted">Chart Color 3</label>
                                <button id="chartColorPicker3" class="btn chart-color3 avatar xs border-0 rounded-0"></button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                <label class="text-muted">Chart Color 4</label>
                                <button id="chartColorPicker4" class="btn chart-color4 avatar xs border-0 rounded-0"></button>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center py-1 px-2">
                                <label class="text-muted">Chart Color 5</label>
                                <button id="chartColorPicker5" class="btn chart-color5 avatar xs border-0 rounded-0"></button>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- Settings: Font -->
                <div class="setting-font py-3">
                    <h6 class="card-title mb-2 fs-6 d-flex align-items-center"><i class="icofont-font fs-4 me-2 text-primary"></i> Font Settings</h6>
                    <ul class="list-group font_setting mt-1">
                        <li class="list-group-item py-1 px-2">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="radio" name="font" id="font-poppins" value="font-poppins">
                                <label class="form-check-label" for="font-poppins">
                                    Poppins Google Font
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item py-1 px-2">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="radio" name="font" id="font-opensans" value="font-opensans">
                                <label class="form-check-label" for="font-opensans">
                                    Open Sans Google Font
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item py-1 px-2">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="radio" name="font" id="font-montserrat" value="font-montserrat">
                                <label class="form-check-label" for="font-montserrat">
                                    Montserrat Google Font
                                </label>
                            </div>
                        </li>
                        <li class="list-group-item py-1 px-2">
                            <div class="form-check mb-0">
                                <input class="form-check-input" type="radio" name="font" id="font-Plex" value="font-Plex" checked="">
                                <label class="form-check-label" for="font-Plex">
                                    Plex Google Font
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
                <!-- Settings: Light/dark -->
                <div class="setting-mode py-3">
                    <h6 class="card-title mb-2 fs-6 d-flex align-items-center"><i class="icofont-layout fs-4 me-2 text-primary"></i>Contrast Layout</h6>
                    <ul class="list-group list-unstyled mb-0 mt-1">
                        <li class="list-group-item d-flex align-items-center py-1 px-2">
                            <div class="form-check form-switch theme-switch mb-0">
                                <input class="form-check-input" type="checkbox" id="theme-switch">
                                <label class="form-check-label" for="theme-switch">Enable Dark Mode!</label>
                            </div>
                        </li>
                        <li class="list-group-item d-flex align-items-center py-1 px-2">
                            <div class="form-check form-switch theme-high-contrast mb-0">
                                <input class="form-check-input" type="checkbox" id="theme-high-contrast">
                                <label class="form-check-label" for="theme-high-contrast">Enable High Contrast</label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="modal-footer justify-content-start">
                <button type="button" class="btn btn-white border lift" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary lift">Save Changes</button>
            </div>
        </div>
    </div>
</div>

</div>

</div>

<!-- Jquery Core Js -->
<script src="../assets/bundles/libscripts.bundle.js"></script>

<!-- Plugin Js -->
<script src="../assets/bundles/dataTables.bundle.js"></script>
<script src="../assets/bundles/apexcharts.bundle.js"></script>

<!-- Jquery Page Js -->
<script src="../assets/js/template.js"></script>


<?php if (isset($page_title) && $page_title == 'Dashboard') : ?>
    <script>
        // per bulan pemasukan & pengeluaran
        $(document).ready(function() {
            var options = {
                chart: {
                    height: 300,
                    type: 'area',
                    stacked: true,
                    toolbar: {
                        show: false,
                    },
                    events: {
                        selection: function(chart, e) {
                            console.log(new Date(e.xaxis.min))
                        }
                    },
                },

                colors: ['#82f6a8', '#ff5c5c'],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    curve: 'smooth',
                    width: 2,
                },
                series: [{
                    name: 'Pemasukan',
                    data: [
                        <?php
                        for ($bulan = 1; $bulan <= 12; $bulan++) {
                            $thn_ini = date('Y');
                            $pemasukan = mysqli_query($koneksi, "select sum(transaksi_nominal) as total_pemasukan from transaksi where transaksi_jenis='Pemasukan' and month(transaksi_tanggal)='$bulan' and year(transaksi_tanggal)='$thn_ini'");
                            $pem = mysqli_fetch_assoc($pemasukan);

                            // $total = str_replace(",", "44", number_format($pem['total_pemasukan']));
                            $total = $pem['total_pemasukan'];
                            if ($pem['total_pemasukan'] == "") {
                                echo "0,";
                            } else {
                                echo $total . ",";
                            }
                        }
                        ?>
                    ]
                }, {
                    name: 'Pengeluaran',
                    data: [
                        <?php
                        for ($bulan = 1; $bulan <= 12; $bulan++) {
                            $thn_ini = date('Y');
                            $pengeluaran = mysqli_query($koneksi, "select sum(transaksi_nominal) as total_pengeluaran from transaksi where transaksi_jenis='pengeluaran' and month(transaksi_tanggal)='$bulan' and year(transaksi_tanggal)='$thn_ini'");
                            $peng = mysqli_fetch_assoc($pengeluaran);

                            // $total = str_replace(",", "44", number_format($peng['total_pengeluaran']));
                            $total = $peng['total_pengeluaran'];
                            if ($peng['total_pengeluaran'] == "") {
                                echo "0,";
                            } else {

                                echo $total . ",";
                            }
                        }
                        ?>
                    ]
                }],
                fill: {
                    type: 'gradient',
                    gradient: {
                        opacityFrom: 0.6,
                        opacityTo: 0.8,
                    }
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    show: true,
                },
                xaxis: {
                    // type: 'datetime',
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                },
                grid: {
                    yaxis: {
                        lines: {
                            show: false,
                        }
                    },
                    padding: {
                        top: 20,
                        right: 0,
                        bottom: 0,
                        left: 0
                    },
                },
            }

            var chart = new ApexCharts(
                document.querySelector("#apex-stacked-area"),
                options
            );
            chart.render();

            function generateDayWiseTimeSeries(baseval, count, yrange) {
                var i = 0;
                var series = [];
                while (i < count) {
                    var x = baseval;
                    var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

                    series.push([x, y]);
                    baseval += 86400000;
                    i++;
                }
                return series;
            }
        });

        // per tahun pemasukan & pengeluaran
        $(document).ready(function() {
            <?php
            $yearly_data = [];
            $years = [];
            $pemasukan_data = [];
            $pengeluaran_data = [];

            $result = mysqli_query($koneksi, "SELECT YEAR(transaksi_tanggal) as tahun, transaksi_jenis, SUM(transaksi_nominal) as total FROM transaksi GROUP BY YEAR(transaksi_tanggal), transaksi_jenis ORDER BY tahun ASC");

            while ($row = mysqli_fetch_assoc($result)) {
                if (!in_array($row['tahun'], $years)) {
                    $years[] = $row['tahun'];
                }
                $yearly_data[$row['tahun']][$row['transaksi_jenis']] = $row['total'];
            }

            foreach ($years as $year) {
                $pemasukan_data[] = $yearly_data[$year]['Pemasukan'] ?? 0;
                $pengeluaran_data[] = $yearly_data[$year]['Pengeluaran'] ?? 0;
            }
            ?>
            var options = {
                chart: {
                    height: 300,
                    type: 'area',
                    stacked: true,
                    toolbar: {
                        show: false,
                    },
                    events: {
                        selection: function(chart, e) {
                            console.log(new Date(e.xaxis.min))
                        }
                    },
                },
                colors: ['#82f6a8', '#ff5c5c'],
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    curve: 'smooth',
                    width: 2,
                },
                series: [{
                    name: 'Pemasukan',
                    data: [<?php echo implode(",", $pemasukan_data); ?>]
                }, {
                    name: 'Pengeluaran',
                    data: [<?php echo implode(",", $pengeluaran_data); ?>]
                }],
                fill: {
                    type: 'gradient',
                    gradient: {
                        opacityFrom: 0.6,
                        opacityTo: 0.8,
                    }
                },
                legend: {
                    position: 'top',
                    horizontalAlign: 'right',
                    show: true,
                },
                xaxis: {
                    categories: [<?php echo "'" . implode("','", $years) . "'"; ?>],
                },
                grid: {
                    yaxis: {
                        lines: {
                            show: false,
                        }
                    },
                    padding: {
                        top: 20,
                        right: 0,
                        bottom: 0,
                        left: 0
                    },
                },
            }

            var chart = new ApexCharts(
                document.querySelector("#apex-stacked-bar-chart"),
                options
            );
            chart.render();
        });

        // total pemasukan & pengeluaran
        $(document).ready(function() {
            <?php
            $pemasukan_total = mysqli_query($koneksi, "SELECT sum(transaksi_nominal) as total FROM transaksi WHERE transaksi_jenis='Pemasukan'");
            $pem_total = mysqli_fetch_assoc($pemasukan_total);
            $total_pemasukan = $pem_total['total'] ?? 0;

            $pengeluaran_total = mysqli_query($koneksi, "SELECT sum(transaksi_nominal) as total FROM transaksi WHERE transaksi_jenis='pengeluaran'");
            $peng_total = mysqli_fetch_assoc($pengeluaran_total);
            $total_pengeluaran = $peng_total['total'] ?? 0;
            ?>
            var options = {
                chart: {
                    height: 300,
                    type: 'donut',
                },
                dataLabels: {
                    enabled: true,
                },
                legend: {
                    position: 'bottom',
                    horizontalAlign: 'center',
                    show: true,
                },
                colors: ['#82f6a8', '#ff5c5c'],
                series: [<?php echo $total_pemasukan; ?>, <?php echo $total_pengeluaran; ?>],
                labels: ['Pemasukan', 'Pengeluaran'],
                responsive: [{
                    breakpoint: 480,
                    options: {
                        chart: {
                            width: 200
                        },
                        legend: {
                            position: 'bottom'
                        }
                    }
                }]
            }

            var chart = new ApexCharts(
                document.querySelector("#apex-simple-donut"),
                options
            );

            chart.render();
        });
    </script>
<?php endif; ?>

</body>

</html>