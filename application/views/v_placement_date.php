<!-- Left side column. contains the logo and sidebar -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Placement Test Date
			<small>List Placement Test Dates</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Placement Test Date</li>
		</ol>
	</section>

    <!-- flash yang dikirim tampilkan -->
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

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<div class="box-header">
						<!-- <h3 class="box-title">List Prices</h3> -->
						<div class="pull-right">
							<a href="<?= base_url() ?>PlacementDate/create"><button class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true">&nbsp;</i>&nbsp;Add Placement Test Date</button></a>
						</div>
					</div>
					<br>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<!-- <th>ID</th> -->
										<th>Date</th>
										<th>Time</th>
										<th>Name</th>
                                        <th>WhatsApp</th>
                                        <th>Status</th>
                                        <th>Created At</th>
										<th class="notPrintable">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($data->result() as $row) {
									?>
										<tr>
											<td><?= $row->date ?></td>
											<td><?= $row->time ?></td>
											<td><?= $row->student_name ?></td>
											<td><?= $row->whatsapp ?></td>
											<td>
												<?php
												if ($row->status == 'complete') {
													echo '<span class="label label-success">Complete</span>';
												} else {
													echo '<span class="label label-danger">Incomplete</span>';
												}
												?>
											</td>
                                            <td>
                                                <?= $row->created_at ?>
                                            </td>
											<td>
												<a href="<?= base_url() ?>PlacementDate/edit/<?= $row->id ?>" class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i></a>
												<a href="<?= base_url() ?>PlacementDate/updateStatus/<?= $row->id ?>" class="btn btn-warning btn-xs" onclick="return confirm('Are you sure you want to complete this placement date?');">
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