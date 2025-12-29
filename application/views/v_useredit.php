<!-- Left side column. contains the logo and sidebar -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Profile
			<small>Update Form</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Profile</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-7">
				<!-- <div class="box"> -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Update Profile</h3>
					</div>
					<!-- Left side column. contains the logo and sidebar -->
					<!-- form start -->
					<?php
					foreach ($user->result() as $data) {
						// $dataid = $data->id;
					?>
						<form role="form" id="example" name="example" class="form-horizontal" action="<?php echo base_url() ?>User/updateUserDB" method="post" enctype="multipart/form-data">
							<div class="box-body">
								<div class="form-group">
									<label for="name" class="col-sm-2 control-label">Username</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" id="username" placeholder="Enter Name" name="username" value="<?= $data->userid  ?>" readonly required>
									</div>
								</div>
								<div class="form-group">
									<label for="name" class="col-sm-2 control-label">Password</label>
									<div class="col-sm-10">
										<input type="password" class="form-control" id="password" placeholder="Enter Name" name="password"><br>
										<span><small class="text-muted">Note : Leave blank if you don't want to change your password</small></span>
									</div>

								</div>
								<div class="form-group">
									<label for="" class="col-sm-2 control-label"> Name</label>
									<div class="col-sm-10">
										<input type="text" class="form-control" placeholder="Name" name="name" value="<?= $data->name  ?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="inputPassword3" class="col-sm-2 control-label">Position</label>
									<div class="col-sm-10">
										<select class="form-control select2" style="width: 100%;" name="position">
											<option selected="selected" value="<?= $data->levelname  ?>"><?= $data->levelname  ?></option>
											<option value="">--Choose--</option>
											<option value="Admin">Admin</option>
											<option value="Front Desk">Front Desk</option>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="inputPassword3" class="col-sm-2 control-label">U&I Location</label>
									<div class="col-sm-10">
										<select class="form-control select2" style="width: 100%;" name="branch_id">
											<option selected="selected" value="<?= $data->branch_id ?>"><?= $data->branch_id == 1 ? 'Surabaya' : 'Bali'  ?></option>
											<option>-- Choose --</option>
											<option value="1">Surabaya</option>
											<option value="2">Bali</option>
										</select>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label for="registration" class="col-sm-2 control-label"></label>
								<div class="col-sm-5" style="margin-bottom:10px;">
									<button type="submit" class="btn btn-primary">Submit</button>

								</div>
							</div>

				</div>
				<!-- /.box-body -->

				<!-- <div class="box-footer">
                
              </div> -->
				<!-- /.box-footer -->
				</form>
			<?php
					}
			?>

			</div>
			<!-- /.box-body -->
		</div>
		<!-- /.col -->

</div>
<!-- /.row -->
</section>
<!-- /.content -->
</div>
<!-- /.content-wrapper -->