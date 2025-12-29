<!-- Left side column. contains the logo and sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Student
			<small>List Students</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Student</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box box-primary">
					<br>
					<!-- /.box-header -->
					<?php
					foreach ($teacher->result() as $data) {
						$dataid = $data->id;
					?>
						<form action="<?= base_url() ?>teacher/update/<?= $data->id ?>" enctype="multipart/form-data" method="POST">
							<div class="box-body">
								<div class="form-group">
									<label for="name" class="col-sm-3 control-label">Full Name <span style="color: red;margin-bottom:20px;">

											<?php echo form_error('name'); ?>
										</span></label>

									<div class="col-sm-9" style="margin-bottom:20px;">
										<input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="<?php echo $data->name ?>" required>
									</div>
								</div>
								<div class="form-group">
									<label for="username" class="col-sm-3 control-label">Username <span style="color: red;margin-bottom:20px;">

											<?php echo form_error('username'); ?>
										</span></label>

									<div class="col-sm-9" style="margin-bottom:20px;">
										<input type="text" class="form-control" id="username" placeholder="Username" name="username" value="<?php echo $data->username ?>" required>
									</div>
								</div>
								<div class="form-group">
									<label for="name" class="col-sm-3 control-label" style="margin-bottom:20px;">Signature <span style="color: red;">

											<?php echo form_error('signature'); ?>
										</span></label>

									<div class="col-sm-9" style="margin-bottom:20px;">
										<?php if ($data->signature != '') : ?>
											<img src="<?php echo base_url('upload/signature/' . $data->signature); ?>" height="50">
										<?php endif ?>
										<input type="file" class="form-control" id="signature" placeholder="Signature" name="signature">
									</div>
								</div>
							</div>
							<div class="box-footer">
								<button type="submit" class="btn btn-primary pull-right">Submit</button>
								<a href="<?= base_url() ?>teacher"><button type="button" class="btn btn-default">Cancel</button></a>
							</div>
						</form>
					<?php
					}
					?>
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