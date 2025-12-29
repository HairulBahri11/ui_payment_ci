<!-- Left side column. contains the logo and sidebar -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Expense Report
			<small>list Expense Payment</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="#">Report</a></li>
			<li class="active">Expense Report</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">Expense Report</h3>
					</div>
					<!-- /.box-header -->
					<form role="form" id="example" name="example" class="form-horizontal" action="<?php echo base_url() ?>report/showExpense" method="post" enctype="multipart/form-data">
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
												<th>Date</th>
												<th>Category</th>
												<th>Explanation</th>
												<th>Amount</th>
												<th class="notPrintable">Action</th>
											</tr>
										</thead>
										<tbody>
											<?php
											if (isset($listExpdetail)) {
												foreach ($listExpdetail->result() as $row) {
											?>
													<tr>
														<?php
														$var = $row->expdate;
														$parts = explode('-', $var);
														$expdate = $parts[2] . '/' . $parts[1] . '/' . $parts[0];
														?>
														<td><?= $expdate ?></td>
														<td><?= $row->category ?></td>
														<td><?= $row->explanation ?></td>
														<td>Rp <?= number_format($row->amount, 0, ".", ".") ?></td>
														<td><a data-toggle="modal" data-target="#delModal<?php echo $row->id; ?>" href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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

<?php
if (isset($listExpdetail)) {
	foreach ($listExpdetail->result() as $row) {
?>
		<div class="modal modal-danger fade" id="delModal<?php echo $row->id; ?>">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title">Delete Expense Detail</h4>
					</div>
					<div class="modal-body">
						<p>Are you sure to delete this selected expense?</p>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
						<a href="<?= base_url() ?>report/deleteExpdetailDb/<?= $row->expenseid ?>/<?= $row->id ?>"><button type="button" class="btn btn-outline">Delete</button></a>
					</div>
				</div>
				<!-- /.modal-content -->
			</div>
			<!-- /.modal-dialog -->
		</div>
		<!-- /.modal -->
<?php
	}
}
?>
