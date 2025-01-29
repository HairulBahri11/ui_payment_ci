<!-- Left side column. contains the logo and sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Price
			<small>List Prices</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Price</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
						<!-- <h3 class="box-title">List Prices</h3> -->

					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>Program</th>
										<th>Level</th>
										<th>Point Book</th>
										<th>Registration</th>
										<th>Book</th>
										<th>Agenda</th>
										<th>Course</th>
										<th>Price/Day</th>
										<th class="notPrintable">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($listPrice->result() as $row) {
									?>
										<tr>
											<td><?= $row->program ?></td>
											<td><?= $row->level ?></td>
											<td>Rp <?= number_format($row->pointbook, 0, ".", ".") ?></td>
											<td>Rp <?= number_format($row->registration, 0, ".", ".") ?></td>
											<td>Rp <?= number_format($row->book, 0, ".", ".") ?></td>
											<td>Rp <?= number_format($row->agenda, 0, ".", ".") ?></td>
											<td>Rp <?= number_format($row->course, 0, ".", ".") ?></td>
											<td>Rp <?= number_format($row->priceperday, 0, ".", ".") ?></td>
											<td>
												<a href="<?= base_url() ?>billing/studentByClass/<?= $row->id ?>" class="btn btn-success btn-xs"><i class="fa fa-eye"></i></a>
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
foreach ($listPrice->result() as $row) {
?>
	<div class="modal modal-danger fade" id="delModal<?php echo $row->id; ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Delete Price</h4>
				</div>
				<div class="modal-body">
					<p>Are you sure to delete <?= $row->program ?> program?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
					<a href="<?= base_url() ?>price/deletePriceDb/<?= $row->id ?>"><button type="button" class="btn btn-outline">Delete</button></a>
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