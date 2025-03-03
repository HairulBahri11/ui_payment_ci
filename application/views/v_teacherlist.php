<!-- Left side column. contains the logo and sidebar -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Teacher
			<small>List Teachers</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Teacher</li>
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
							<a href="<?= base_url() ?>teacher/create"><button class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true">&nbsp;</i>&nbsp;Add New Teacher</button></a>
						</div>
					</div>
					<br>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Username</th>
										<th>Status</th>
										<th class="notPrintable">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($data->result() as $row) {
									?>
										<tr>
											<td><?= $row->id ?></td>
											<td><?= $row->name ?></td>
											<td><?= $row->username ?></td>
											<td>
												<?php
												if ($row->status == 'active') {
													echo '<span class="label label-success">Active</span>';
												} else {
													echo '<span class="label label-danger">Inactive</span>';
												}
												?>
											</td>
											<td>
												<a href="<?= base_url() ?>teacher/edit/<?= $row->id ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
												<a href="<?= base_url() ?>teacher/activateUser/<?= $row->id ?>/<?= $row->status ?>" class="btn btn-warning btn-xs" onclick="return confirm('Are you sure you want to activate or deactivate this teacher?');">
													<i class="fa fa-check"></i></a>
											</td>
										</tr>
									<?php } ?>
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