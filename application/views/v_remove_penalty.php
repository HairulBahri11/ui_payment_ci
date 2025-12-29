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
										<th>No</th>
										<th>Name</th>
										<th>Payment</th>
										<th class="notPrintable">Action</th>
									</tr>
								</thead>
								<?php
								foreach ($data as $row) {
								?>
									<tr>
										<td><?= $row->id ?></td>
										<td><?= $row->name ? $row->name : '-' ?></td>
										<td><?= $row->payment ?></td>
										<td>
											<a href="<?= base_url() ?>billing/removePenalty/<?= $row->id ?>" class="btn btn-success btn-xs">Remove Penalty</a>
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