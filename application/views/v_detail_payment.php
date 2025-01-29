<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Student
			<small>Detail Payment</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="<?php echo base_url() ?>student"><i class="fa fa-user"></i> Student</a></li>
			<li class="active">Detail Payment</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title"><?= urldecode($name) ?></h3>
					</div>
					<!-- /.box-header -->
					<div class="box-body">

						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>Nota</th>
										<th>Payment</th>
										<th>Method</th>
										<th>Pay Date</th>
										<th>Amount</th>
										<th>Voucher</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$sum = count($listStudentPayment->result());
									if ($sum != 0) {
										foreach ($listStudentPayment->result() as $payment) {
									?>
											<tr class="inactive">
												<td><?= $payment->id ?></td>
												<?php
												if ($payment->category == "COURSE" && $payment->monthpay != "") {
													$var = $payment->monthpay;
													$parts = explode('-', $var);
													$monthpay = $parts[1] . '/' . $parts[0];
													$monthpay =  date("M", strtotime($payment->monthpay));
													$yearpay =  date("y", strtotime($payment->monthpay));
													$category = $payment->category . " (" . $monthpay . " " . $yearpay . ")";
												} else {
													$category = $payment->category;
												}
												?>
												<td><?= $category ?></td>
												<td><?= $payment->method ?></td>
												<?php
												$var = $payment->paydate;
												$parts = explode('-', $var);
												$paydate = $parts[2] . '/' . $parts[1] . '/' . $parts[0];
												?>
												<td><?= $paydate ?></td>
												<td>Rp <?= number_format($payment->amount, 0, ".", ".") ?></td>
												<?php
												if ($payment->voucherid == "" || $payment->voucherid == "0") {
													$voucherid = "NO";
												} else {
													$voucherid = $payment->voucherid;
												}
												?>
												<td><?= $voucherid ?></td>
											</tr>
									<?php
										}
									}
									?>
								</tbody>
							</table>
							<p id="tabel"></p>
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