<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Employee
			<small>list all Employees</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Employee</a></li>
			<li class="active">List Employee</li>
		</ol>
		<?php if ($this->session->flashdata('alert')): ?>
			<div class="alert alert-success" timeout="100">
				<?php echo $this->session->flashdata('alert'); ?>
				<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
			</div>
		<?php endif; ?>
		<script>
			setTimeout(() => {
				const alert = document.querySelector('.alert');
				if (alert) {
					alert.style.display = 'none';
				}
			}, 2000); // 3000ms = 3 seconds
		</script>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
						<h3 class="box-title">List Employee</h3>
						<!-- <h3 class="box-title">List Prices</h3> -->
						<div class="pull-right">
							<a href="<?= base_url() ?>user/addUser"><button class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true">&nbsp;</i>&nbsp;Add New Student</button></a>
						</div>
					</div>

					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-hover">
								<thead>
									<tr>
										<th>No</th>
										<th>Employee Name</th>
										<th>Username</th>
										<th>Position</th>
										<th>U&I Location</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$i = 1; //nantinya akan digunakan untuk pengisian Nomor
									foreach ($listEmployee->result() as $row) {
									?>
										<tr>
											<td><?= $i ?></td>
											<td><?= $row->name ?></td>
											<td><?= $row->userid ?></td>
											<td><?= $row->levelname ?></td>

											<td>
												<?php
												if ($row->branch_id === null) {
													echo '-';
												} elseif ($row->branch_id == 1) {
													echo 'Surabaya';
												} else {
													echo 'Bali';
												}
												?>
											</td>
											<td>
												<?php
												if ($row->status == 'active') {
													echo '<span class="label label-success">Active</span>';
												} else {
													echo '<span class="label label-danger">Not Active</span>';
												}
												?>
											</td>
											<td>
												<a href="<?= base_url() ?>user/updateUser/<?= $row->userid ?>"><span class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-pencil"></i></span></a>
												&nbsp;<a href="<?= base_url() ?>user/activateUser/<?= $row->userid ?>"><span class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-trash"></i></span></a>
											</td>
										</tr>
									<?php
										$i = $i + 1;
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