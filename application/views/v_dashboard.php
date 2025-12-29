<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Dashboard
			<small>monitoring Dashboard</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li class="active"><a href="#">Dashboard</a></li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<!-- <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title"><b>Sistem Informasi Pembayaran U&I English Course</b> </h3><br>
              <h5><i class="fa fa-map-marker user-profile-icon"></i> &nbsp;Jl. Sutorejo Prima Utara PDD 18-19 Surabaya</h5>
              <h5><i class="fa fa-phone"></i> 031-58204040 / 58207070</h5>
            </div>
          </div>
        </div> -->
			<!-- /.col -->

			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<h3><?php echo number_format($activeStudent, 0, ".", "."); ?></h3>

						<p>Active Students</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-stalker"></i>
					</div>
					<a href="<?php echo base_url() ?>student" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<h3><sup style="font-size: 20px">Rp </sup><?php echo number_format($totalPay != null ? $totalPay : 0, 0, ".", "."); ?></h3>

						<p>Total Income (<?php echo date('Y'); ?>)</p>
					</div>
					<div class="icon">
						<i class="ion ion-log-in"></i>
					</div>
					<a href="<?= base_url() ?>report/showdetail" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3><sup style="font-size: 20px">Rp </sup><?php echo number_format($totalExp != null ? $totalExp : 0, 0, ".", "."); ?></h3>
						<p>Total Expense Costs (<?php echo date('Y'); ?>)</p>
					</div>
					<div class="icon">
						<i class="ion ion-log-out"></i>
					</div>
					<a href="<?= base_url() ?>report/showexpense" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-red">
					<div class="inner">
						<h3><?php echo number_format($listLateStudent, 0, ".", "."); ?></h3>

						<p>Late Payments</p>
					</div>
					<div class="icon">
						<i class="ion ion-calendar"></i>
					</div>
					<a href="<?= base_url() ?>report/showlate" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->

			<div class="col-md-5">
				<!-- DONUT CHART -->
				<div class="box box-danger">
					<div class="box-header with-border">
						<h3 class="box-title">Students Payment Comparison</h3>

						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body" style="display: flex; justify-content: center; align-items: center;">
						<div style="width: 50%; max-width: 500px;">
							<canvas id="pieChart" style="height: 265px;"></canvas>
						</div>
					</div>

					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col (LEFT) -->

			<div class="col-md-7">
				<!-- BAR CHART -->
				<div class="box box-success">
					<div class="box-header with-border">
						<h3 class="box-title">Monthly Expense Costs vs Income</h3>

						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
							</button>
							<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						<div class="chart">
							<canvas id="barChart" style="height:265px"></canvas>
						</div>
					</div>
					<!-- /.box-body -->
				</div>
				<!-- /.box -->
			</div>
			<!-- /.col (RIGHT) -->

		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->
<!-- page script -->
<!-- <script>
	$(function() {
		/* ChartJS
		 * -------
		 * Here we will create a few charts using ChartJS
		 */

		//-------------
		//- PIE CHART -
		//-------------
		// Get context with jQuery - using jQuery's .get() method.
		var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
		var pieChart = new Chart(pieChartCanvas)
		var PieData = [{
				value: <?php echo $listLateStudent; ?>,
				color: '#f56954',
				highlight: '#f56954',
				label: 'Students Pay Late'
			},
			{
				value: <?php echo $listTimeStudent; ?>,
				color: '#3c8dbc',
				highlight: '#3c8dbc',
				label: 'Students Have Paid'
			}
		]
		var pieOptions = {
			//Boolean - Whether we should show a stroke on each segment
			segmentShowStroke: true,
			//String - The colour of each segment stroke
			segmentStrokeColor: '#fff',
			//Number - The width of each segment stroke
			segmentStrokeWidth: 2,
			//Number - The percentage of the chart that we cut out of the middle
			percentageInnerCutout: 50, // This is 0 for Pie charts
			//Number - Amount of animation steps
			animationSteps: 100,
			//String - Animation easing effect
			animationEasing: 'easeOutBounce',
			//Boolean - Whether we animate the rotation of the Doughnut
			animateRotate: true,
			//Boolean - Whether we animate scaling the Doughnut from the centre
			animateScale: false,
			//Boolean - whether to make the chart responsive to window resizing
			responsive: true,
			// Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
			maintainAspectRatio: true,
			//String - A legend template
			legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
		}
		//Create pie or douhnut chart
		// You can switch between pie and douhnut using the method below.
		pieChart.Doughnut(PieData, pieOptions)

		//-------------
		//- BAR CHART -
		//-------------
		var areaChartData = {
			labels: [
				<?php
				$i = 0;
				foreach ($listMonthlyPay as $monthlypay) {
					$i = $i + 1;
					if ($i <= 8) {
				?> '<?= $monthlypay->nmonth ?>',
				<?php
					}
				}
				?>
			],
			//labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July',],  
			datasets: [{
					label: 'Electronics',
					fillColor: 'rgba(210, 214, 222, 1)',
					strokeColor: 'rgba(210, 214, 222, 1)',
					pointColor: 'rgba(210, 214, 222, 1)',
					pointStrokeColor: '#c1c7d1',
					pointHighlightFill: '#fff',
					pointHighlightStroke: 'rgba(220,220,220,1)',
					data: [
						<?php
						foreach ($listMonthlyPay as $monthlypay) {
							foreach ($listMonthlyExp as $monthlyexp) {
								if ($monthlyexp->nmonth == $monthlypay->nmonth) {
						?>
									<?= $monthlyexp->totalexp ?>,
								<?php
								} else {
								?>
									<?= 0 ?>,
						<?php
								}
							}
						}
						?>
					]
				},
				{
					label: 'Digital Goods',
					fillColor: 'rgba(60,141,188,0.9)',
					strokeColor: 'rgba(60,141,188,0.8)',
					pointColor: '#3b8bba',
					pointStrokeColor: 'rgba(60,141,188,1)',
					pointHighlightFill: '#fff',
					pointHighlightStroke: 'rgba(60,141,188,1)',
					data: [
						<?php
						foreach ($listMonthlyPay as $monthlypay) {
						?>
							<?= $monthlypay->totalpay ?>,
						<?php
						}
						?>
					]
				}
			]
		}

		var barChartCanvas = $('#barChart').get(0).getContext('2d')
		var barChart = new Chart(barChartCanvas)
		var barChartData = areaChartData
		barChartData.datasets[1].fillColor = '#00a65a'
		barChartData.datasets[1].strokeColor = '#00a65a'
		barChartData.datasets[1].pointColor = '#00a65a'
		var barChartOptions = {
			//Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
			scaleBeginAtZero: true,
			//Boolean - Whether grid lines are shown across the chart
			scaleShowGridLines: true,
			//String - Colour of the grid lines
			scaleGridLineColor: 'rgba(0,0,0,.05)',
			//Number - Width of the grid lines
			scaleGridLineWidth: 1,
			//Boolean - Whether to show horizontal lines (except X axis)
			scaleShowHorizontalLines: true,
			//Boolean - Whether to show vertical lines (except Y axis)
			scaleShowVerticalLines: true,
			//Boolean - If there is a stroke on each bar
			barShowStroke: true,
			//Number - Pixel width of the bar stroke
			barStrokeWidth: 2,
			//Number - Spacing between each of the X value sets
			barValueSpacing: 5,
			//Number - Spacing between data sets within X values
			barDatasetSpacing: 1,
			//String - A legend template
			legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>',
			//Boolean - whether to make the chart responsive
			responsive: true,
			maintainAspectRatio: true
		}

		barChartOptions.datasetFill = false
		barChart.Bar(barChartData, barChartOptions)
	})
</script> -->

<!-- Tambahkan library Chart.js dulu -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Lalu tambahkan kode untuk pie chart -->
<script>
	// Ambil tanggal sekarang
	var currentDate = new Date();

	// Format bulan dan tahun (contoh: "October 2025")
	var options = {
		year: 'numeric',
		month: 'long'
	};
	var formattedDate = currentDate.toLocaleDateString('en-US', options);

	$(document).ready(function() {
		var pieChartCanvas = $('#pieChart').get(0).getContext('2d');
		var pieChart = new Chart(pieChartCanvas, {
			type: 'doughnut',
			data: {
				labels: ['Students Pay Late', 'Students Have Paid'],
				datasets: [{
					data: [<?php echo $listLateStudent; ?>, <?php echo $listTimeStudent; ?>],
					backgroundColor: ['#f56954', '#3c8dbc'],
					hoverBackgroundColor: ['#f56954', '#3c8dbc']
				}]
			},
			options: {
				responsive: true,
				maintainAspectRatio: true,
				plugins: {
					title: {
						display: true,
						text: formattedDate, // Contoh: "Student Payment Status - October 2025"
						font: {
							size: 18
						}
					}
				}
			}
		});
	});

	// Ambil tanggal sekarang dengan format "October 2025"
	var currentDate = new Date();
	var options = {
		year: 'numeric',
		month: 'long'
	};
	var formattedDate = currentDate.toLocaleDateString('en-US', options);

	$(document).ready(function() {
		var ctx = $('#barChart').get(0).getContext('2d');

		var barChart = new Chart(ctx, {
			type: 'bar',
			data: {
				labels: [
					<?php
					$labels = [];
					$dataExp = [];
					$dataPay = [];

					foreach ($listMonthlyPay as $monthlypay) {
						$labels[] = "'" . $monthlypay->nmonth . "'";
						$dataPay[] = $monthlypay->totalpay;

						// Cek apakah ada data expense untuk bulan yang sama
						$totalExp = 0;
						foreach ($listMonthlyExp as $monthlyexp) {
							if ($monthlyexp->nmonth == $monthlypay->nmonth) {
								$totalExp = $monthlyexp->totalexp;
								break;
							}
						}
						$dataExp[] = $totalExp;
					}

					echo implode(',', $labels);
					?>
				],
				datasets: [{
						label: 'Expenses',
						backgroundColor: 'rgb(231, 181, 33)',
						borderColor: 'rgb(231, 181, 33)',
						data: [<?= implode(',', $dataExp) ?>]
					},
					{
						label: 'Income',
						backgroundColor: '#00a65a',
						borderColor: '#00a65a',
						data: [<?= implode(',', $dataPay) ?>]
					}
				]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				plugins: {
					title: {
						display: true,
						// text: formattedDate, // Contoh: "Monthly Financial Report - October 2025"
						font: {
							size: 18
						}
					},
					legend: {
						display: true,
						position: 'top'
					}
				},
				scales: {
					y: {
						beginAtZero: true
					}
				}
			}
		});
	});
</script>