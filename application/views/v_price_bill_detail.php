<!-- Left side column. contains the logo and sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Billing Data
			<small>Detail Billing Data</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Billing</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">

			<?php
			if ($type == 'sistem') {
			?>
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-header">
							<!-- <h3 class="box-title">List Prices</h3> -->

						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								<table id="example3" class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th>Student Name</th>
											<th>Price</th>
											<th>Category</th>
											<th>Payment For</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($detail as $row) {
										?>
											<tr>
												<td><?= $row->name ?></td>
												<td>Rp <?= number_format($row->price, 0, ".", ".") ?></td>
												<td><?= $row->category ?></td>
												<td><?= $row->payment ?></td>
												<td><?= $row->status ?></td>
											</tr>
										<?php
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
			<?php
			} else {
			?>
				<div class="col-xs-12">
					<div class="box box-primary">
						<div class="box-header">
							<!-- <h3 class="box-title">List Prices</h3> -->

						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								<table id="example2" class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th>Student Name</th>
											<th>Transaction Id</th>
											<th>Price</th>
											<th>Category</th>
											<th>Payment For</th>
											<th>Status</th>
										</tr>
									</thead>
									<tbody>
										<?php
										foreach ($detail as $row) {
										?>
											<tr>
												<td><?= $row->name ?></td>
												<td><?= $row->unique_code ?></td>
												<td>Rp <?= number_format($row->price, 0, ".", ".") ?></td>
												<td><?= $row->category ?></td>
												<td><?= $row->payment ?></td>
												<td><?= $row->status ?></td>
											</tr>
										<?php
										}
										?>
									</tbody>

								</table>
							</div>
						</div>
						<?php
						if ($detail[0]->status == 'To Be Confirm') {
						?>
							<div class="box-footer">
								<!-- <form action="<?= base_url() . "billing/confirmBilling" ?>" method="POST">
									<input type="hidden" readonly name="unique_code" value="<?= $detail[0]->unique_code ?>">
									<button type="submit" class="btn btn-primary">Confirm</button>
								</form> -->
								<a href="<?= base_url() . "billing/confirmBill?id=" . $detail[0]->student_id ?>" class="btn btn-primary">Confirm</a>
							</div>
						<?php
						}
						?>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->


				</div>
			<?php
			}
			?>

			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->