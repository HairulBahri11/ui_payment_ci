<!-- Left side column. contains the logo and sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Billing Data
			<small>List Billing Data</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Billing</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<h3>
					Billing Created
				</h3>
			</div>
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
										<th>Amount</th>
										<th>Class Type</th>
										<th>Created By</th>
										<th>Created At</th>
										<th class="notPrintable">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($from_sistem as $row) {
									?>
										<tr>
											<td>Rp <?= number_format($row->total_price, 0, ".", ".") ?></td>
											<td><?= $row->class_type ?></td>
											<td><?= $row->created_by ?></td>
											<td><?= $row->created_at ?></td>
											<td>
												<a href="<?= base_url() ?>billing/detail/<?= $row->id ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
											</td>
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
			<!-- /.col -->
			<div class="col-md-12">
				<h3>
					Waiting For Confirmation
				</h3>
			</div>
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
										<th>Transaction ID</th>
										<th>Amount</th>
										<th>Created By</th>
										<th>Student Name</th>
										<th>Status</th>
										<th class="notPrintable">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($from_parent as $row) {
									?>
										<tr>
											<td><?= $row->unique_code ?></td>
											<td>Rp <?= number_format($row->amount, 0, ".", ".") ?></td>
											<td><?= $row->name != null ? $row->name : $row->created_by_admin ?></td>
											<td><?= $row->student_name ?></td>
											<td><?= $row->status ?></td>
											<td>
												<a href="<?= base_url() ?>billing/detailHistory/<?= $row->unique_code ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
											</td>
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
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->