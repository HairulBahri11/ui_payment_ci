<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Add Employee
			<small>add new Employee</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li class="active">Add Employee</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<!-- <div class="box"> -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Add Employee Form</h3>
					</div>
					<!-- /.box-header -->

					<!-- /.box-header -->
					<!-- form start -->
					<form id="example" name="example" class="form-horizontal" action="<?php echo base_url() ?>user/addUserDb" method="post" enctype="multipart/form-data">
						<div class="box-body">
							<div class="form-group">
								<label for="" class="col-sm-2 control-label">Username</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" placeholder="username" name="userid">
								</div>
							</div>

							<div class="form-group">
								<label for="" class="col-sm-2 control-label">Password</label>
								<div class="col-sm-10">
									<input type="password" class="form-control" placeholder="Password" name="password">
								</div>
							</div>

							<div class="form-group">
								<label for="" class="col-sm-2 control-label">Employee Name</label>
								<div class="col-sm-10">
									<input type="text" class="form-control" placeholder="Name" name="name">
								</div>
							</div>

							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label">Position</label>
								<div class="col-sm-10">
									<select class="form-control select2" style="width: 100%;" name="position">
										<option selected="selected">-- Choose --</option>
										<option value="Admin">Admin</option>
										<option value="Front Desk">Front Desk</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="inputPassword3" class="col-sm-2 control-label">U&I Location</label>
								<div class="col-sm-10">
									<select class="form-control select2" style="width: 100%;" name="branch_id">
										<option selected="selected">-- Choose --</option>
										<option value="1">Surabaya</option>
										<option value="2">Bali</option>
									</select>
								</div>
							</div>

						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<button type="submit" class="btn btn-primary pull-right">Submit</button>
							<!-- <button type="submit" class="btn btn-default pull-right">Cancel</button> -->
						</div>
						<!-- /.box-footer -->
					</form>
				</div>
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