<!-- Left side column. contains the logo and sidebar -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			General Report
			<small>list General Payment</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="#">Report</a></li>
			<li class="active">General Report</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">General Report</h3>
					</div>
					<!-- /.box-header -->
					<form role="form" id="example" name="example" class="form-horizontal" action="<?php echo base_url() ?>report/showGeneral" method="post" enctype="multipart/form-data">
						<div class="box-body">
							<div class="col-sm-12">
								<div class="row">
									<div class="col-xs-5">
										<div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">Start Date</label>
											<div class="col-sm-9">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" id="datepicker" name="startdate" id="startdate" required>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-5">
										<div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">End Date</label>
											<div class="col-sm-9">
												<div class="input-group date">
													<div class="input-group-addon">
														<i class="fa fa-calendar"></i>
													</div>
													<input type="text" class="form-control pull-right" id="datepicker1" name="enddate" id="enddate" required>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-2">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary">Search Report</button>
									</div>
									</row>
								</div>

								<br>
								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>No</th>
												<th>Date</th>
												<th>Rec</th>
												<th>Name</th>
												<th>Level</th>
												<th>Method</th>
												<th>Amount</th>
											</tr>
										</thead>
										<tbody>
											<?php
											if (isset($listGeneral)) {
												$i = 0;
												foreach ($listGeneral as $row) {
													$i = $i + 1;
											?>
													<tr>
														<td><?= $i ?></td>
														<?php
														$var = $row->paydate;
														$parts = explode('-', $var);
														$paydate = $parts[2] . '/' . $parts[1] . '/' . $parts[0];
														?>
														<td><?= $paydate ?></td>
														<td><?= $row->id ?></td>
														<td><?= $row->name ?></td>
														<td><?= $row->program ?></td>
														<?php
														if ($row->method == "CASH") {
															$method = $row->method;
														} elseif ($row->method == "BANK TRANSFER") {
															$var = $row->trfdate;
															$parts = explode('-', $var);
															$trfdate = $parts[2] . '/' . $parts[1];
															$method = $row->method . " (" . $trfdate . ")";
														} elseif ($row->method == "DEBIT") {
															$method = $row->method . " (" . $row->number . ")";
														} elseif ($row->method == "CREDIT") {
															$method = $row->method . " (" . $row->number . ")";
														}
														?>
														<td><?= $method ?></td>
														<td>Rp <?= number_format($row->total, 0, ".", ".") ?></td>
													</tr>
											<?php
												}
											}
											?>
										</tbody>

									</table>
								</div>
							</div>
							<!-- /.box-body -->
					</form>
				</div>
				<!-- /.box -->


			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->