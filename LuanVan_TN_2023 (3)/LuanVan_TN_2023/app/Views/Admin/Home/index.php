<?= $this->extend('Admin/layout') ?>

<?= $this->section('content') ?>
<div class="pcoded-content">
    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <!-- task, page, download counter  start -->
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-yellow update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white"><?= $orderCount4 ?></h4>
                                            <h6 class="text-white m-b-0">Số Lượng Đã Bán</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-1" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i><?= date('H:i') ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-green update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white"><?= $orderCount2 ?></h4>
                                            <h6 class="text-white m-b-0">Đang Vận Chuyển</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-2" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i><?= date('H:i') ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-pink update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white"><?= $orderCount1 ?></h4>
                                            <h6 class="text-white m-b-0">Đã Giao</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-3" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i><?= date('H:i') ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="card bg-c-lite-green update-card">
                                <div class="card-block">
                                    <div class="row align-items-end">
                                        <div class="col-8">
                                            <h4 class="text-white"><?= $orderCount3 ?></h4>
                                            <h6 class="text-white m-b-0">Đã Hủy</h6>
                                        </div>
                                        <div class="col-4 text-right">
                                            <canvas id="update-chart-4" height="50"></canvas>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <p class="text-white m-b-0"><i class="feather icon-clock text-white f-14 m-r-10"></i><?= date('H:i') ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-9 col-md-12">
                            <div class="col-xl-8 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="card-header-left ">
                                            <h5>Monthly View</h5>
                                            <span class="text-muted">For more details about usage, please refer <a href="https://www.amcharts.com/online-store/" target="_blank">amCharts</a> licences.</span>
                                        </div>
                                    </div>
                                    <div class="card-block-big">
                                        <div id="monthly-graph" style="height: 250px;"></div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Đường dẫn tới các tệp JavaScript của amCharts -->
                        <!-- Đường dẫn tới các tệp CSS của amCharts -->

                        <script src="https://cdn.amcharts.com/lib/4/core.js"></script>
                        <script src="https://cdn.amcharts.com/lib/4/charts.js"></script>
                        <script src="https://cdn.amcharts.com/lib/4/themes/animated.js"></script>

                        <script>
                            // Gọi phương thức API để lấy dữ liệu từ controller
                            fetch('<?php echo base_url('dashboard/bieudo'); ?>')
                                .then(response => response.json())
                                .then(data => {
                                    // Tạo biểu đồ
                                    var chart = am4core.create("monthly-graph", am4charts.XYChart);
                                    chart.data = data;

                                    var categoryAxis = chart.xAxes.push(new am4charts.CategoryAxis());
                                    categoryAxis.dataFields.category = "month";
                                    categoryAxis.renderer.grid.template.location = 0;
                                    categoryAxis.renderer.minGridDistance = 20;

                                    var valueAxis = chart.yAxes.push(new am4charts.ValueAxis());

                                    var series = chart.series.push(new am4charts.ColumnSeries());
                                    series.dataFields.categoryX = "month";
                                    series.dataFields.valueY = "count";
                                    series.columns.template.tooltipText = "{categoryX}: {valueY} đơn hàng";
                                    series.columns.template.fillOpacity = 0.8;

                                    chart.cursor = new am4charts.XYCursor();
                                })
                                .catch(error => console.error(error));
                        </script>


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>