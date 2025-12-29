<!-- Left side column. contains the logo and sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Voucher
			<small>List Voucher</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Voucher</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
						<!-- <h3 class="box-title">List Prices</h3> -->
						<div class="pull-right">
							<a href="<?= base_url() ?>voucher/addVoucher"><button class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true">&nbsp;</i>&nbsp;Add Voucher</button></a>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>Voucher Code</th>
										<th>Voucher Type</th>
										<th>Amount</th>
										<th>Usable</th>
										<th class="notPrintable">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($listVoucher->result() as $row) {
									?>
										<tr>
											<td><?= $row->id ?></td>
											<td><?= $row->type ?></td>
											<td>Rp <?= number_format($row->amount, 0, ".", ".") ?></td>
											<td><?= $row->isused ?></td>
											<td>
												<a href="<?= base_url() ?>voucher/updateVoucher/<?= $row->id ?>" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
												<a data-toggle="modal" data-target="#delModal<?php echo $row->id; ?>" href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
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

<?php
foreach ($listVoucher->result() as $row) {
?>
	<div class="modal modal-danger fade" id="delModal<?php echo $row->id; ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Delete Voucher</h4>
				</div>
				<div class="modal-body">
					<p>Are you sure to delete Voucher Code <?= $row->id ?>?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
					<a href="<?= base_url() ?>voucher/deleteVoucherDb/<?= $row->id ?>"><button type="button" class="btn btn-outline">Delete</button></a>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
<?php
}
?>