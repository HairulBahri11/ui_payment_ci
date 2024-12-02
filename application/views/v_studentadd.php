<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
	<!-- sidebar: style can be found in sidebar.less -->
	<section class="sidebar">
		<!-- search form -->
		<form action="#" method="get" class="sidebar-form">
			<div class="input-group">
				<img src="<?php echo base_url() ?>assets/dist/img/ui4.jpg" width="210">
			</div>
		</form>
		<!-- Sidebar user panel -->
		<div class="user-panel">
			<div class="pull-left image">
				<img src="<?php echo base_url() ?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
			</div>
			<div class="pull-left info">
				<p><?= $this->session->userdata('nama') ?></p>
				<a href="#"><i class="fa fa-circle text-success"></i> Online</a>
			</div>
		</div>
		<!-- /.search form -->
		<!-- sidebar menu: : style can be found in sidebar.less -->
		<ul class="sidebar-menu" data-widget="tree">
			<li class="header">MAIN NAVIGATION</li>
			<li>
				<a href="<?php echo base_url() ?>dashboard">
					<i class="fa fa-dashboard"></i> <span>Dashboard</span>
				</a>
			</li>

			<?php
			if (($this->session->userdata('level')) == 1 || ($this->session->userdata('level') == 3)) {
			?>
				<li>
					<a href="<?php echo base_url() ?>student/register">
						<i class="fa fa-edit"></i> <span>Register</span>
					</a>
				</li>

				<li class="treeview">
					<a href="#">
						<i class="fa fa-money"></i> <span>Payment</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li><a href="<?= base_url() ?>payment/addprivate"><i class="fa fa-circle-o"></i> <span>Private Payment</span></a></li>
						<li><a href="<?= base_url() ?>payment/addregular"><i class="fa fa-circle-o"></i> <span>Regular Payment</span></a></li>
						
						<li><a href="<?= base_url() ?>expense/addexpense"><i class="fa fa-circle-o"></i> <span>Expense</span></a></li>
					</ul>
				</li>
			<?php
			}
			?>

			<li class="treeview">
				<a href="#">
					<i class="fa fa-file-text-o"></i> <span>Report</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<?php
					if (($this->session->userdata('level')) == 1 || ($this->session->userdata('level') == 2)) {
					?>
						<li><a href="<?= base_url() ?>report/showexpense"><i class="fa fa-circle-o"></i> <span>Expense Report</span></a></li>
					<?php
					}
					?>
					<li><a href="<?= base_url() ?>report/showlate"><i class="fa fa-circle-o"></i> <span>Late Payments</span></a></li>
					<?php
					if (($this->session->userdata('level')) == 1 || ($this->session->userdata('level') == 2)) {
					?>
						<li><a href="<?= base_url() ?>report/showgeneral"><i class="fa fa-circle-o"></i> <span>General</span></a></li>
						<li><a href="<?= base_url() ?>report/showdetail"><i class="fa fa-circle-o"></i> <span>Detail</span></a></li>
					<?php
					}
					?>
					<li><a href="<?= base_url() ?>report/showtrans"><i class="fa fa-circle-o"></i> <span>Transaction</span></a></li>
				</ul>
			</li>

			<li class="active">
				<a href="<?php echo base_url() ?>student">
					<i class="fa fa-user"></i> <span>Student</span>
				</a>
			</li>

			<li>
				<a href="<?php echo base_url() ?>student/studentOnline">
					<i class="fa fa-users"></i> <span>Prospective Student</span>
				</a>
			</li>

			<li>
				<a href="<?php echo base_url() ?>teacher">
					<i class="fa fa-users"></i> <span>Teacher</span>
				</a>
			</li>

			<li>
				<a href="<?php echo base_url() ?>voucher">
					<i class="fa fa-credit-card"></i> <span>Voucher</span>
				</a>
			</li>

			<li>
				<a href="<?php echo base_url() ?>price">
					<i class="fa fa-dollar"></i> <span>Price</span>
				</a>
			</li>
			<li class="treeview <?= $this->uri->segment(1) == 'billing' ? 'active' : '' ?>">
				<a href="#">
					<i class="fa fa-money"></i> <span>Payment Bills</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class="<?= $this->uri->segment(2) == 'data' ? 'active' : '' ?>"><a href="<?= base_url() ?>billing/data"><i class="fa fa-circle-o"></i> <span>Billing Data</span></a></li>
					<li class="<?= $this->uri->segment(2) == 'addRegularBill' || $this->uri->segment(2) == 'studentByClass' ? 'active' : '' ?>"><a href="<?= base_url() ?>billing/addRegularBill"><i class="fa fa-circle-o"></i> <span>Regular Billing Payment</span></a></li>
					<li class="<?= $this->uri->segment(3) == 'removePenaltyBill' ? 'active' : '' ?>"><a href="<?= base_url() ?>billing/removePenaltyBill"><i class="fa fa-circle-o"></i> <span>Remove Penalty</span></a></li>
				</ul>
			</li>
			<?php
			if (($this->session->userdata('level')) == 1 || $this->session->userdata('level') == 2) {
				?>
				<li class="treeview">
				<a href="#">
					<i class="fa fa-tag"></i> <span>Accounting</span>
					<span class="pull-right-container">
						<i class="fa fa-angle-left pull-right"></i>
					</span>
				</a>
				<ul class="treeview-menu">
					<li class=""><a href="<?= base_url() ?>accounting/journal"><i class="fa fa-circle-o"></i> <span>Journal</span></a></li>
					<li class=""><a href="<?= base_url() ?>accounting/profit_loss"><i class="fa fa-circle-o"></i> <span>Profit & Loss</span></a></li>
					
				</ul>
			</li>
				
			<?php } ?>
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>

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