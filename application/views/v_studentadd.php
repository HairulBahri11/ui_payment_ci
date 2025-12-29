<!-- Left side column. contains the logo and sidebar -->


<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Add New Student
			<small>add Student Form</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="#">Student</a></li>
			<li class="active">Add New Student</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-7">
				<!-- <div class="box"> -->
				<div class="box box-primary">

					<!-- form start -->
					<form role="form" id="example" name="example" class="form-horizontal" action="<?php echo base_url() ?>student/addStudentDb" method="post" enctype="multipart/form-data">
						<div class="box-body">
							<div class="form-group">
								<label for="name" class="col-sm-3 control-label">Full Name</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" required>
								</div>
							</div>

							<div class="form-group">
								<label for="birthday" class="col-sm-3 control-label">Birthday</label>
								<div class="col-sm-9">
									<div class="row">
										<div class="col-xs-6">
											<select class="form-control select2" style="width: 100%;" name="date" required>
												<option selected="selected" disabled="disabled" value="">-- Choose Date --</option>
												<?php
												for ($i = 1; $i <= 31; $i++) {
												?>
													<option value="<?= $i ?>"><?= $i ?></option>
												<?php
												}
												?>
											</select>
										</div>
										<div class="col-xs-6">
											<select class="form-control select2" style="width: 100%;" name="month" required>
												<option selected="selected" disabled="disabled" value="">-- Choose month --</option>
												<?php
												$months = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
												foreach ($months as $month) {
												?>
													<option value="<?= $month ?>"><?= $month ?></option>
												<?php
												}
												?>
											</select>
										</div>
									</div>
								</div>
							</div>

							<div class="form-group">
								<label for="phone" class="col-sm-3 control-label">Phone Number</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="phone" placeholder="Enter Phone" name="phone" required>
								</div>
							</div>

							<div class="form-group">
								<label for="adjusment" class="col-sm-3 control-label">Adjusment</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="adjusment" name="adjusment" readonly>
								</div>
							</div>

							<div class="form-group">
								<label for="penalty" class="col-sm-3 control-label">Penalty</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="penalty" name="penalty" readonly>
								</div>
							</div>

							<div class="form-group">
								<label for="balance" class="col-sm-3 control-label">Balance</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="balance" name="balance" readonly>
								</div>
							</div>

							<div class="form-group">
								<label for="program" class="col-sm-3 control-label">Level</label>
								<div class="col-sm-9">
									<select class="form-control select2" style="width: 100%;" name="program" required>
										<option selected="selected" disabled="disabled" value="">-- Choose Level --</option>
										<?php
										foreach ($listPrice->result() as $row) {
										?>
											<option value="<?= $row->id ?>"><?= $row->program ?></option>
										<?php
										}
										?>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="status" class="col-sm-3 control-label">Status</label>
								<div class="col-sm-9">
									<input type="hidden" class="form-control" id="cond" name="cond">
									<select class="form-control select2" style="width: 100%;" name="status" required>
										<option selected="selected" disabled="disabled" value="">-- Choose Status --</option>
										<option value="ACTIVE">ACTIVE</option>
										<option value="INACTIVE">INACTIVE</option>
									</select>
								</div>
							</div>

						</div>
						<!-- /.box-body -->

						<div class="box-footer">
							<button type="submit" class="btn btn-primary pull-right">Submit</button>
							<a href="<?= base_url() ?>student"><button type="button" class="btn btn-default">Cancel</button></a>
						</div>
						<!-- /.box-footer -->
					</form>

				</div>
				<!-- /.box-body -->
			</div>
			<!-- /.col -->

			<div class="col-xs-5">
				<!-- <div class="box"> -->
				<div class="box box-success">
					<form role="form" id="example1" name="example1" class="form-horizontal">
						<div class="box-body">

							<div class="form-group">
								<label for="status" class="col-sm-4 control-label">Price Condition</label>
								<div class="col-sm-8">
									<select class="form-control select2" style="width: 100%;" name="condition" id="condition" onchange="hide()">
										<option selected="selected" value="DEFAULT">Default Price</option>
										<option value="CHANGE">Change Price</option>
									</select>
								</div>
							</div>

							<div class="form-group" id="nprice" style="display: none">
								<label for="newprice" class="col-sm-4 control-label">New Price</label>
								<div class="col-sm-8">
									<input type="text" class="form-control" id="newprice" placeholder="Enter New Price" name="newprice" required>
								</div>
							</div>

						</div>
						<!-- /.box-body -->

					</form>
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

<script type="text/javascript">
	$(document).ready(function() {
		$("#newprice").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
		$("#adjusment").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
		$("#penalty").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
		$("#balance").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});

		document.getElementById("newprice").value = 0;
		document.getElementById("newprice").value = "Rp " + FormatDuit(document.getElementById("newprice").value);

		document.getElementById("adjusment").value = 0;
		document.getElementById("adjusment").value = "Rp " + FormatDuit(document.getElementById("adjusment").value);
		document.getElementById("penalty").value = 0;
		document.getElementById("penalty").value = "Rp " + FormatDuit(document.getElementById("penalty").value);
		document.getElementById("balance").value = 0;
		document.getElementById("balance").value = "Rp " + FormatDuit(document.getElementById("balance").value);
	});

	function FormatDuit(x) {
		var tmp_num;
		var negatif = false;
		if (x < 0) {
			negatif = true;
			tmp_num = Math.abs(x);
		} else {
			tmp_num = x;
		}

		var num = tmp_num.toString();
		for (var i = 0; i < Math.floor((num.length - (1 + i)) / 3); i++)
			num = num.substring(0, num.length - (4 * i + 3)) + '.' + num.substring(num.length - (4 * i + 3));
		if (negatif) {
			num = '-' + num;
		}
		return (num);
	}

	$('#example1').on('keyup keypress', function(e) {
		var keyCode = e.keyCode || e.which;
		if (keyCode === 13) {
			e.preventDefault();
			return false;
		}
	});

	$("#newprice").on('keyup', function(e) {
		if (e.keyCode == 13) {
			document.getElementById("adjusment").value = document.getElementById("newprice").value;
		}
	});

	$("#example").submit(function() {
		document.getElementById("adjusment").value = document.getElementById("newprice").value;
		document.getElementById("cond").value = document.getElementById("condition").value;
	});

	function hide() {
		if (document.example1.condition.value === "CHANGE") {
			$("#nprice").show(750);
			document.getElementById("newprice").value = 0;
			document.getElementById("newprice").value = "Rp " + FormatDuit(document.getElementById("newprice").value);
		} else {
			$("#nprice").hide(750);
			document.getElementById("adjusment").value = 0;
			document.getElementById("adjusment").value = "Rp " + FormatDuit(document.getElementById("adjusment").value);
		}
	}
</script>