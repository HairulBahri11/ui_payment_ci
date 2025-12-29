<!-- Left side column. contains the logo and sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Teacher
			<small>Add Teacher</small>
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
					<br>
					<!-- /.box-header -->
					<form action="<?= base_url() ?>teacher/store" method="POST">
						<div class="box-body">
							<div class="form-group">
								<label for="name" class="col-sm-4 control-label" style="margin-bottom:20px;">Full Name <span style="color: red;">

										<?php echo form_error('name'); ?>
									</span></label>

								<div class="col-sm-8" style="margin-bottom:20px;">
									<input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="<?php echo set_value('name'); ?>" required>
								</div>
							</div>
							<div class="form-group">
								<label for="name" class="col-sm-4 control-label" style="margin-bottom:20px;">Username <span style="color: red;">

										<?php echo form_error('username'); ?>
									</span></label>

								<div class="col-sm-8" style="margin-bottom:20px;">
									<input type="text" class="form-control" id="username" placeholder="Enter Username" name="username" value="<?php echo set_value('username'); ?>" required>
								</div>
							</div>
							<div class="form-group">
								<label for="name" class="col-sm-4 control-label" style="margin-bottom:20px;">Signature <span style="color: red;">

										<?php echo form_error('signature'); ?>
									</span></label>

								<div class="col-sm-8" style="margin-bottom:20px;">
									<input type="file" class="form-control" id="signature" placeholder="Signature" name="signature" value="<?php echo set_value('signature'); ?>">
								</div>
							</div>


						</div>
						<div class="box-footer">
							<button type="submit" class="btn btn-primary pull-right">Submit</button>
							<a href="<?= base_url() ?>teacher"><button type="button" class="btn btn-default">Cancel</button></a>
						</div>
					</form>
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