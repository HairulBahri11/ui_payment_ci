<!-- Left side column. contains the logo and sidebar -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Late Payment Report
			<small>list Late Payment</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="#">Report</a></li>
			<li class="active">Late Payment Report</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Late Payment Report</h3>
					</div>
					<!-- /.box-header -->
					<form role="form" id="example" name="example" class="form-horizontal" method="post" enctype="multipart/form-data">
						<div class="box-body">
							<div class="col-sm-12">
								<div class="row">
									<div class="col-xs-4">
										<div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">Month Late</label>
											<div class="col-sm-8">
												<div class="form-group">
													<select class="form-control select2" name="month">
														<option value="1">Januari</option>
														<option value="2">Februari</option>
														<option value="3">Maret</option>
														<option value="4">April</option>
														<option value="5">Mei</option>
														<option value="6">Juni</option>
														<option value="7">Juli</option>
														<option value="8">Agustus</option>
														<option value="9">September</option>
														<option value="10">Oktober</option>
														<option value="11">November</option>
														<option value="12">Desember</option>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-4">
										<div class="form-group">
											<label for="inputPassword3" class="col-sm-3 control-label">Year Late</label>
											<div class="col-sm-8">
												<div class="form-group">
													<select class="form-control select2" name="year">
														<?php
														for ($i = 2017; $i <= date('Y'); $i++) {
															echo '<option value="' . $i . '">' . $i . '</option>';
														}
														?>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="col-xs-2">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="btn btn-primary" id="search">Search Report</a>
									</div>
									<div class="col-xs-2">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="btn btn-primary" id="send">Send Wa</a>
									</div>
									<!-- <div class="col-xs-2">
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" class="btn btn-primary" id="send">Send Wa</a>
									</div> -->
								</div>

								<div class="table-responsive">
									<table id="example1" class="table table-bordered table-striped table-hover">
										<thead>
											<tr>
												<th>ID</th>
												<th>Name</th>
												<th>Telephone</th>
												<th>Program</th>
												<th>Level</th>
												<th>Last Payment</th>
												<th>Send Wa <input type="checkbox" id="checkAll" value=""></th>
											</tr>
										</thead>
										<tbody>
											<?php
											if (isset($listLateStudent)) {
												foreach ($listLateStudent as $row) {
											?>
													<tr>
														<td><?= $row->id ?></td>
														<td><?= $row->name ?></td>
														<td><?= $row->phone ?></td>
														<td><?= $row->program ?></td>
														<td><?= $row->level ?></td>
														<?php
														if ($row->monthpay != "") {
															$month =  date("F", strtotime($row->monthpay));
															$year =  date("Y", strtotime($row->monthpay));

															if ($year < 2000)
																$monthpay = "No payment yet";
															else
																$monthpay = $month . " " . $year;
														} else {
															$monthpay = "No payment yet";
														}
														?>
														<td><?= $monthpay ?></td>
														<td><input type="checkbox" name="sendwa[]" id="" class="sendwa" value="<?= $row->id ?>.<?= $monthpay ?>"></td>
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
<script>
	$('#search').click(function() {
		$("#example").attr("action", '<?php echo base_url() ?>report/showLate').submit();
	});
	$('#send').click(function() {
		$("#example").attr("action", '<?php echo base_url() ?>student/send').submit();
	});
	$('#checkAll').change(function() {
		if ($(this).is(':checked')) {
			$('.sendwa').prop('checked', true);
		} else {
			$('.sendwa').prop('checked', false);
		}
	});
</script>