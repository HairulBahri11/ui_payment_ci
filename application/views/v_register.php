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
				<li class="active">
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
						<li><a href="<?= base_url() ?>payment/addother"><i class="fa fa-circle-o"></i> <span>Other Payment</span></a></li>
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

			<li>
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
		</ul>
	</section>
	<!-- /.sidebar -->
</aside>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
			Registration
			<small>registration Form</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Register</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-7">
				<!-- <div class="box"> -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Form Registration</h3>
					</div>

					<!-- form start -->
					<form role="form" id="example" name="example" class="form-horizontal" action="<?php echo base_url() ?>student/registerDb" method="post" enctype="multipart/form-data">
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
								<label for="category" class="col-sm-3 control-label">Category</label>
								<div class="col-sm-9">
									<select class="form-control select2" style="width: 100%;" name="category" id="category" onchange="changeCategory()" required>
										<option selected="selected" disabled="disabled" value="">-- Choose Category --</option>
										<option value="PRIVATE">PRIVATE</option>
										<option value="REGULAR">REGULAR</option>
									</select>
								</div>
							</div>

							<div class="form-group">
								<label for="category" class="col-sm-3 control-label">U&I Location</label>
								<div class="col-sm-9">
									<select class="form-control select2" style="width: 100%;" name="branch_id" id="branch_id" required>
										<option selected="selected" disabled="disabled" value="">-- Choose U&I Location --</option>
										<option value="1">Surabaya</option>
										<option value="2">Bali</option>
									</select>
								</div>
							</div>

							<div id="privatediv" style="display:none;">
								<div class="form-group">
									<label for="programprv" class="col-sm-3 control-label">Level</label>
									<div class="col-sm-9">
										<select class="form-control select2" style="width: 100%;" name="programprv" id="programprv" onchange="showDetail()">
											<option selected="selected" disabled="disabled" value="">-- Choose Level --</option>
											<?php
											foreach ($listPrice->result() as $row) {
												if ($row->level == "Private") {
											?>
													<option value="<?= $row->id ?>"><?= $row->program ?></option>
											<?php
												}
											}
											?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label for="attendance" class="col-sm-3 control-label">Attendance</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" value="" id="attendance" name="attendance" data-role="tagsinput">
									</div>
								</div>

								<div class="form-group">
									<label for="priceattn" class="col-sm-3 control-label">Price per Attendance</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="priceattn" name="priceattn">
									</div>
								</div>
							</div>

							<div id="regulardiv" style="display:none;">
								<div class="form-group">
									<label for="program" class="col-sm-3 control-label">Level</label>
									<div class="col-sm-9">
										<select class="form-control select2" style="width: 100%;" name="program" id="program" onchange="showDetail()">
											<option selected="selected" disabled="disabled" value="">-- Choose Level --</option>
											<?php
											foreach ($listPrice->result() as $row) {
												if ($row->level != "Private") {
											?>
													<option value="<?= $row->id ?>"><?= $row->program ?></option>
											<?php
												}
											}
											?>
										</select>
									</div>
								</div>

								<div class="form-group">
									<label id="labelattn" for="attendance" class="col-sm-3 control-label">Attendance</label>
									<div class="col-sm-9">
										<input type="number" class="form-control" id="attendancereg" name="attendancereg">
									</div>
								</div>

								<div class="form-group">
									<label id="labelprice" for="priceattn" class="col-sm-3 control-label">Price per Attendance</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="priceattnreg" name="priceattnreg" readonly>
									</div>
								</div>
							</div>

							<div id="dpayment" style="display: none">
								<div class="form-group">
									<label for="registration" class="col-sm-3 control-label"></label>
									<div class="col-sm-9">
										<div class="checkbox">
											<label>
												<input type="checkbox" id="registration" name="registration" onclick="checkRegistration()">
												Registration
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" id="pointbook" name="pointbook" onclick="checkPointbook()">
												Point Book
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" id="book" name="book" onclick="checkBook()">
												Book
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" id="agenda" name="agenda" onclick="checkAgenda()">
												Agenda
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" id="booklet" name="booklet" onclick="checkBooklet()">
												Booklet
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" id="course" name="course" onclick="checkCourse()">
												Course
											</label>
										</div>
										<div class="checkbox">
											<label>
												<input type="checkbox" id="others" name="others" onclick="checkOthers()">
												Others
											</label>
										</div>
									</div>
								</div>
							</div>

							<div id="divpayment" style="display: none">
								<div class="form-group">
									<label for="total" class="col-sm-3 control-label">Total Amount</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="amount" name="amount" readonly>
									</div>
								</div>

								<div class="form-group">
									<label for="method" class="col-sm-3 control-label">Payment Method</label>
									<div class="col-sm-9">
										<select class="form-control select2" style="width: 100%;" name="method" id="method" onchange="changeMethod()" required>
											<option selected="selected" value="CASH">Cash</option>
											<option value="SWITCHING CARD">Switching Card</option>
											<option value="BANK TRANSFER">Bank Transfer</option>
											<option value="DEBIT">Debit</option>
											<option value="CREDIT">Credit</option>
										</select>
									</div>
								</div>

								<div class="form-group" id="dtrfdate" style="display: none">
									<label for="inputPassword3" class="col-sm-3 control-label">Transfer Date</label>
									<div class="col-sm-9">
										<div class="input-group date">
											<div class="input-group-addon">
												<i class="fa fa-calendar"></i>
											</div>
											<input type="text" class="form-control pull-right" id="datepicker" name="trfdate" id="trfdate">
										</div>
									</div>
								</div>

								<div class="form-group" id="dbank" style="display: none">
									<label for="method" class="col-sm-3 control-label">Bank</label>
									<div class="col-sm-9">
										<select class="form-control select2" style="width: 100%;" name="bank" id="bank" onchange="changeBank()">
											<option selected="selected" disabled="disabled" value="">-- Choose Bank --</option>
											<option value="BCA CARD">BCA Card</option>
											<option value="VISA CARD">Visa Card</option>
											<option value="VISA BCA">Visa BCA</option>
											<option value="MASTER CARD">Master Card</option>
											<option value="MAESTRO CARD">Maestro Card</option>
											<option value="JCB">JCB</option>
											<option value="AMERICAN EXPRESS">American Express</option>
											<option value="OTHER">Other</option>
										</select>
									</div>
								</div>

								<div class="form-group" id="dnumber" style="display: none">
									<label for="number" class="col-sm-3 control-label">Number</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="number" name="number">
									</div>
								</div>

								<div class="form-group" id="dcut" style="display: none">
									<label for="cash" class="col-sm-3 control-label">Bank Payment Cut</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="paymentcut" name="paymentcut" readonly>
									</div>
								</div>

								<div class="form-group">
									<label for="cash" class="col-sm-3 control-label">Cash</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="cash" name="cash">
									</div>
								</div>

								<div class="form-group">
									<label for="cashback" class="col-sm-3 control-label">Cashback</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="cashback" name="cashback" readonly>
									</div>
								</div>
							</div>

							<input type="hidden" class="form-control" id="vid" name="vid" value="">
							<input type="hidden" class="form-control" id="vamount" name="vamount">
							<input type="hidden" class="form-control" id="vregistration" name="vregistration" value="">
							<input type="hidden" class="form-control" id="vpointbook" name="vpointbook">
							<input type="hidden" class="form-control" id="vbook" name="vbook" value="">
							<input type="hidden" class="form-control" id="vagenda" name="vagenda">
							<input type="hidden" class="form-control" id="vbooklet" name="vbooklet">
							<input type="hidden" class="form-control" id="vothers" name="vothers">
							<input type="hidden" class="form-control" id="vcourse" name="vcourse">
							<input type="hidden" class="form-control" id="countattn" name="countattn">

							<div class="form-group">
								<label for="registration" class="col-sm-3 control-label"></label>
								<div class="col-sm-9">
									<button type="submit" class="btn btn-primary">Submit</button>
									<a href="<?= base_url() ?>student/register"><button type="button" class="btn btn-warning">Clear</button></a>
									<a id="voucherdiv" style="display:none;" data-toggle="modal" data-target="#voucherModal" href="#" class="btn btn-primary pull-right"><i class="fa fa-credit-card"></i>&nbsp;Use Voucher</a>
								</div>
							</div>

						</div>
						<!-- /.box-body -->

						<!-- <div class="box-footer">
                
              </div> -->
						<!-- /.box-footer -->
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

<div class="modal modal-default fade" id="voucherModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Choose Voucher</h4>
			</div>
			<div class="modal-body">
				<table id="example5" class="table table-bordered table-striped table-hover">
					<thead>
						<tr>
							<th>Voucher Code</th>
							<th>Voucher Type</th>
							<th>Amount</th>
							<th>Usable</th>
						</tr>
					</thead>
					<tbody>
						<?php
						foreach ($listVoucher->result() as $row) {
						?>
							<tr>
								<td id="voucherid"><?= $row->id ?></td>
								<td><?= $row->type ?></td>
								<td id="voucheramount">Rp <?= number_format($row->amount, 0, ".", ".") ?></td>
								<td><?= $row->isused ?></td>
							</tr>
						<?php
						}
						?>
					</tbody>
				</table>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<?php
$totalpay = 0;
?>

<script type="text/javascript">
	var oldvoucher = 0;
	var oldattnreg = 0;
	var oldpriceprv = 0;
	var cashback = 0;
	var paymentcut = 0.00;

	$(document).ready(function() {
		$("#amount").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
		$("#priceattn").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
		$("#priceattnreg").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
		$("#cash").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
		$("#cashback").maskMoney({
			prefix: '-Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});

		document.getElementById("cash").value = 0;
		document.getElementById("cash").value = "Rp " + FormatDuit(document.getElementById("cash").value);
		document.getElementById("cashback").value = 0;
		document.getElementById("cashback").value = "Rp " + FormatDuit(document.getElementById("cashback").value);
		document.getElementById("priceattn").value = 0;
		document.getElementById("priceattn").value = "Rp " + FormatDuit(document.getElementById("priceattn").value);

		document.getElementById("attendancereg").value = 0;

		$('#attendance').on('itemAdded', function(event) {
			if (document.getElementById("amount").value != "") {
				var amount = document.getElementById("amount").value.replace(/\./g, '');
				amount = amount.replace("Rp ", "");
			} else {
				var amount = 0;
			}

			<?php
			foreach ($listPrice->result() as $price) {
			?>
				if (document.getElementById("programprv").value == <?= $price->id ?>) {
					var checkBox = document.getElementById("course");
					var attendance = $("#attendance").tagsinput('items').length;
					document.getElementById("countattn").value = attendance;
					var priceattn = document.getElementById("priceattn").value.replace(/\./g, '');
					priceattn = priceattn.replace("Rp ", "");
					if (checkBox.checked == true) {
						document.getElementById("amount").value = parseInt(amount) + parseInt(priceattn);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vcourse").value = (parseInt(priceattn) * parseInt(attendance));
					}
				}
			<?php
			}
			?>
		});

		$('#attendance').on('itemRemoved', function(event) {
			if (document.getElementById("amount").value != "") {
				var amount = document.getElementById("amount").value.replace(/\./g, '');
				amount = amount.replace("Rp ", "");
			} else {
				var amount = 0;
			}

			<?php
			foreach ($listPrice->result() as $price) {
			?>
				if (document.getElementById("programprv").value == <?= $price->id ?>) {
					var checkBox = document.getElementById("course");
					var attendance = $("#attendance").tagsinput('items').length;
					document.getElementById("countattn").value = attendance;
					var priceattn = document.getElementById("priceattn").value.replace(/\./g, '');
					priceattn = priceattn.replace("Rp ", "");
					if (checkBox.checked == true) {
						document.getElementById("amount").value = parseInt(amount) - parseInt(priceattn);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vcourse").value = (parseInt(priceattn) * parseInt(attendance));
					}
				}
			<?php
			}
			?>
		});
	});

	$("#priceattn").on('keyup', function(e) {
		// if (e.keyCode == 13) {
		if (document.getElementById("amount").value != "") {
			var amount = document.getElementById("amount").value.replace(/\./g, '');
			amount = amount.replace("Rp ", "");
			if (parseInt(amount) < 0) {
				amount = 0;
			}
		} else {
			var amount = 0;
		}

		<?php
		foreach ($listPrice->result() as $price) {
		?>
			if (document.getElementById("programprv").value == <?= $price->id ?>) {
				var checkBox = document.getElementById("course");
				var attendance = $("#attendance").tagsinput('items').length;
				document.getElementById("countattn").value = attendance;
				var priceattn = document.getElementById("priceattn").value.replace(/\./g, '');
				priceattn = priceattn.replace("Rp ", "");
				if (checkBox.checked == true) {
					document.getElementById("amount").value = parseInt(amount) - (parseInt(oldpriceprv) * parseInt(attendance)) + (parseInt(priceattn) * parseInt(attendance));
					document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
					document.getElementById("vcourse").value = (parseInt(priceattn) * parseInt(attendance));
					oldpriceprv = priceattn;
				}
			}
		<?php
		}
		?>
		// }
	});

	$("#attendancereg").on('keyup', function(e) {
		// if (e.keyCode == 13) {
		if (document.getElementById("amount").value != "") {
			var amount = document.getElementById("amount").value.replace(/\./g, '');
			amount = amount.replace("Rp ", "");
		} else {
			var amount = 0;
		}

		<?php
		foreach ($listPrice->result() as $price) {
		?>
			if (document.getElementById("program").value == <?= $price->id ?>) {
				var checkBox = document.getElementById("course");
				var attendancereg = document.getElementById("attendancereg").value.replace(/\./g, '');
				attendancereg = attendancereg.replace("Rp ", "");
				if (checkBox.checked == true) {
					document.getElementById("amount").value = parseInt(amount) - (parseInt(<?= $price->priceperday ?>) * parseInt(oldattnreg)) + (parseInt(<?= $price->priceperday ?>) * parseInt(attendancereg));
					document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
					document.getElementById("vcourse").value = (parseInt(<?= $price->priceperday ?>) * parseInt(attendancereg));
					oldattnreg = attendancereg;
				}
			}
		<?php
		}
		?>
		// }
	});

	$("#example5").on('click', 'tr', function() {
		$('#voucherModal').modal('hide');

		document.getElementById("vid").value = $(this).find("#voucherid").text();
		document.getElementById("vamount").value = $(this).find("#voucheramount").text();

		if (document.getElementById("amount").value != "") {
			var amount = document.getElementById("amount").value.replace(/\./g, '');
			amount = amount.replace("Rp ", "");
			if (parseInt(amount) < 0) {
				amount = 0;
			}
		} else {
			var amount = 0;
		}

		if (document.getElementById("vamount").value != "") {
			var vamount = document.getElementById("vamount").value.replace(/\./g, '');
			vamount = vamount.replace("Rp ", "");
			document.getElementById("amount").value = parseInt(amount) + parseInt(oldvoucher) - parseInt(vamount);
			document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
			oldvoucher = vamount;
		}
	});

	function changeCategory() {
		if (document.getElementById("category").value == "PRIVATE") {
			$("#privatediv").show(750);
			$("#regulardiv").hide(750);
			$("#dpayment").hide(750);
			$("#divpayment").hide(750);
			$("#voucherdiv").hide(750);
		} else {
			$("#privatediv").hide(750);
			$("#regulardiv").show(750);
			$("#dpayment").hide(750);
			$("#divpayment").hide(750);
			$("#voucherdiv").hide(750);
		}
	}

	function showDetail() {
		document.getElementById("registration").checked = false;
		document.getElementById("pointbook").checked = false;
		document.getElementById("book").checked = false;
		document.getElementById("agenda").checked = false;
		document.getElementById("booklet").checked = false;
		document.getElementById("course").checked = false;
		document.getElementById("others").checked = false;

		//document.getElementById("method").selectedIndex = 0;
		$("#method").val("CASH").change();
		//document.getElementById("method").text = "Cash";
		document.getElementById("amount").value = 0;
		oldvoucher = 0;
		$("#dtrfdate").hide(750);
		$("#dbank").hide(750);
		$("#dnumber").hide(750);

		$("#dpayment").show(750);
		$("#divpayment").hide(750);
		$("#voucherdiv").hide(750);

		<?php
		foreach ($listPrice->result() as $price) {
		?>
			if (document.getElementById("program").value == <?= $price->id ?>) {
				document.getElementById("priceattnreg").value = parseInt(<?= $price->priceperday ?>);
				document.getElementById("priceattnreg").value = "Rp " + FormatDuit(document.getElementById("priceattnreg").value);
			}
		<?php
		}
		?>
	}

	function checkRegistration() {
		if (document.getElementById("amount").value != "") {
			var amount = document.getElementById("amount").value.replace(/\./g, '');
			amount = amount.replace("Rp ", "");
		} else {
			var amount = 0;
		}

		<?php
		foreach ($listPrice->result() as $price) {
		?>
			if (document.getElementById("category").value == "REGULAR") {
				if (document.getElementById("program").value == <?= $price->id ?>) {
					var checkBox = document.getElementById("registration");
					if (checkBox.checked == true) {
						$("#divpayment").show(750);
						$("#voucherdiv").show(750);
						document.getElementById("amount").value = parseInt(amount) + parseInt(<?= $price->registration ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vregistration").value = parseInt(<?= $price->registration ?>);
					} else {
						document.getElementById("amount").value = parseInt(amount) - parseInt(<?= $price->registration ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vregistration").value = parseInt(<?= $price->registration ?>);
					}
				}
			} else {
				if (document.getElementById("programprv").value == <?= $price->id ?>) {
					var checkBox = document.getElementById("registration");
					if (checkBox.checked == true) {
						$("#divpayment").show(750);
						$("#voucherdiv").show(750);
						document.getElementById("amount").value = parseInt(amount) + parseInt(<?= $price->registration ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vregistration").value = parseInt(<?= $price->registration ?>);
					} else {
						document.getElementById("amount").value = parseInt(amount) - parseInt(<?= $price->registration ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vregistration").value = parseInt(<?= $price->registration ?>);
					}
				}
			}
		<?php
		}
		?>
	}

	function checkPointbook() {
		if (document.getElementById("amount").value != "") {
			var amount = document.getElementById("amount").value.replace(/\./g, '');
			amount = amount.replace("Rp ", "");
		} else {
			var amount = 0;
		}

		<?php
		foreach ($listPrice->result() as $price) {
		?>
			if (document.getElementById("category").value == "REGULAR") {
				if (document.getElementById("program").value == <?= $price->id ?>) {
					var checkBox = document.getElementById("pointbook");
					if (checkBox.checked == true) {
						$("#divpayment").show(750);
						$("#voucherdiv").show(750);
						document.getElementById("amount").value = parseInt(amount) + parseInt(<?= $price->pointbook ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vpointbook").value = parseInt(<?= $price->pointbook ?>);
					} else {
						document.getElementById("amount").value = parseInt(amount) - parseInt(<?= $price->pointbook ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vpointbook").value = parseInt(<?= $price->pointbook ?>);
					}
				}
			} else {
				if (document.getElementById("programprv").value == <?= $price->id ?>) {
					var checkBox = document.getElementById("pointbook");
					if (checkBox.checked == true) {
						$("#divpayment").show(750);
						$("#voucherdiv").show(750);
						document.getElementById("amount").value = parseInt(amount) + parseInt(<?= $price->pointbook ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vpointbook").value = parseInt(<?= $price->pointbook ?>);
					} else {
						document.getElementById("amount").value = parseInt(amount) - parseInt(<?= $price->pointbook ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vpointbook").value = parseInt(<?= $price->pointbook ?>);
					}
				}
			}
		<?php
		}
		?>
	}

	function checkBook() {
		if (document.getElementById("amount").value != "") {
			var amount = document.getElementById("amount").value.replace(/\./g, '');
			amount = amount.replace("Rp ", "");
		} else {
			var amount = 0;
		}

		<?php
		foreach ($listPrice->result() as $price) {
		?>
			if (document.getElementById("category").value == "REGULAR") {
				if (document.getElementById("program").value == <?= $price->id ?>) {
					var checkBox = document.getElementById("book");
					if (checkBox.checked == true) {
						$("#divpayment").show(750);
						$("#voucherdiv").show(750);
						document.getElementById("amount").value = parseInt(amount) + parseInt(<?= $price->book ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vbook").value = parseInt(<?= $price->book ?>);
					} else {
						document.getElementById("amount").value = parseInt(amount) - parseInt(<?= $price->book ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vbook").value = parseInt(<?= $price->book ?>);
					}
				}
			} else {
				if (document.getElementById("programprv").value == <?= $price->id ?>) {
					var checkBox = document.getElementById("book");
					if (checkBox.checked == true) {
						$("#divpayment").show(750);
						$("#voucherdiv").show(750);
						document.getElementById("amount").value = parseInt(amount) + parseInt(<?= $price->book ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vbook").value = parseInt(<?= $price->book ?>);
					} else {
						document.getElementById("amount").value = parseInt(amount) - parseInt(<?= $price->book ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vbook").value = parseInt(<?= $price->book ?>);
					}
				}
			}
		<?php
		}
		?>
	}

	function checkAgenda() {
		if (document.getElementById("amount").value != "") {
			var amount = document.getElementById("amount").value.replace(/\./g, '');
			amount = amount.replace("Rp ", "");
		} else {
			var amount = 0;
		}

		<?php
		foreach ($listPrice->result() as $price) {
		?>
			if (document.getElementById("category").value == "REGULAR") {
				if (document.getElementById("program").value == <?= $price->id ?>) {
					var checkBox = document.getElementById("agenda");
					if (checkBox.checked == true) {
						$("#divpayment").show(750);
						$("#voucherdiv").show(750);
						document.getElementById("amount").value = parseInt(amount) + parseInt(<?= $price->agenda ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vagenda").value = parseInt(<?= $price->agenda ?>);
					} else {
						document.getElementById("amount").value = parseInt(amount) - parseInt(<?= $price->agenda ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vagenda").value = parseInt(<?= $price->agenda ?>);
					}
				}
			} else {
				if (document.getElementById("programprv").value == <?= $price->id ?>) {
					var checkBox = document.getElementById("agenda");
					if (checkBox.checked == true) {
						$("#divpayment").show(750);
						$("#voucherdiv").show(750);
						document.getElementById("amount").value = parseInt(amount) + parseInt(<?= $price->agenda ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vagenda").value = parseInt(<?= $price->agenda ?>);
					} else {
						document.getElementById("amount").value = parseInt(amount) - parseInt(<?= $price->agenda ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vagenda").value = parseInt(<?= $price->agenda ?>);
					}
				}
			}
		<?php
		}
		?>
	}

	function checkBooklet() {
		if (document.getElementById("amount").value != "") {
			var amount = document.getElementById("amount").value.replace(/\./g, '');
			amount = amount.replace("Rp ", "");
			console.log(amount);
		} else {
			var amount = 0;
		}


		<?php
		foreach ($listPrice->result() as $price) {
		?>
			if (document.getElementById("category").value == "REGULAR") {
				if (document.getElementById("program").value == <?= $price->id ?>) {
					var checkBox = document.getElementById("booklet");
					if (checkBox.checked == true) {
						$("#divpayment").show(750);
						$("#voucherdiv").show(750);
						document.getElementById("amount").value = parseInt(amount) + parseInt(<?= $price->booklet ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vbooklet").value = parseInt(<?= $price->booklet ?>);
					} else {
						document.getElementById("amount").value = parseInt(amount) - parseInt(<?= $price->booklet ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vbooklet").value = parseInt(<?= $price->booklet ?>);
					}
				}
			} else {
				if (document.getElementById("programprv").value == <?= $price->id ?>) {
					var checkBox = document.getElementById("booklet");
					if (checkBox.checked == true) {
						$("#divpayment").show(750);
						$("#voucherdiv").show(750);
						document.getElementById("amount").value = parseInt(amount) + parseInt(<?= $price->booklet ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vbooklet").value = parseInt(<?= $price->booklet ?>);
					} else {
						document.getElementById("amount").value = parseInt(amount) - parseInt(<?= $price->booklet ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vbooklet").value = parseInt(<?= $price->booklet ?>);
					}
				}
			}
		<?php
		}
		?>


	}

	function checkOthers() {
		if (document.getElementById("amount").value != "") {
			var amount = document.getElementById("amount").value.replace(/\./g, '');
			amount = amount.replace("Rp ", "");
			console.log(amount);
		} else {
			var amount = 0;
		}


		<?php
		foreach ($listPrice->result() as $price) {
		?>
			if (document.getElementById("category").value == "REGULAR") {
				if (document.getElementById("program").value == <?= $price->id ?>) {
					var checkBox = document.getElementById("others");
					if (checkBox.checked == true) {
						$("#divpayment").show(750);
						$("#voucherdiv").show(750);
						document.getElementById("amount").value = parseInt(amount) + parseInt(<?= $price->others ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vothers").value = parseInt(<?= $price->others ?>);
					} else {
						document.getElementById("amount").value = parseInt(amount) - parseInt(<?= $price->others ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vothers").value = parseInt(<?= $price->others ?>);
					}
				}
			} else {
				if (document.getElementById("programprv").value == <?= $price->id ?>) {
					var checkBox = document.getElementById("others");
					if (checkBox.checked == true) {
						$("#divpayment").show(750);
						$("#voucherdiv").show(750);
						document.getElementById("amount").value = parseInt(amount) + parseInt(<?= $price->others ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vothers").value = parseInt(<?= $price->others ?>);
					} else {
						document.getElementById("amount").value = parseInt(amount) - parseInt(<?= $price->others ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vothers").value = parseInt(<?= $price->others ?>);
					}
				}
			}
		<?php
		}
		?>


	}


	function checkCourse() {
		if (document.getElementById("amount").value != "") {
			var amount = document.getElementById("amount").value.replace(/\./g, '');
			amount = amount.replace("Rp ", "");
		} else {
			var amount = 0;
		}

		<?php
		foreach ($listPrice->result() as $price) {
		?>
			if (document.getElementById("category").value == "REGULAR") {
				if (document.getElementById("program").value == <?= $price->id ?>) {
					var checkBox = document.getElementById("course");
					var attendancereg = document.getElementById("attendancereg").value.replace(/\./g, '');
					attendancereg = attendancereg.replace("Rp ", "");
					if (checkBox.checked == true) {
						$("#divpayment").show(750);
						$("#voucherdiv").show(750);
						document.getElementById("amount").value = parseInt(amount) + (parseInt(<?= $price->priceperday ?>) * parseInt(attendancereg));
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vcourse").value = (parseInt(<?= $price->priceperday ?>) * parseInt(attendancereg));
						oldattnreg = attendancereg;
					} else {
						document.getElementById("amount").value = parseInt(amount) - (parseInt(<?= $price->priceperday ?>) * parseInt(attendancereg));
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vcourse").value = (parseInt(<?= $price->priceperday ?>) * parseInt(attendancereg));
						oldattnreg = attendancereg;
					}
				}
			} else {
				if (document.getElementById("programprv").value == <?= $price->id ?>) {
					var checkBox = document.getElementById("course");
					var attendance = $("#attendance").tagsinput('items').length;
					var priceattn = document.getElementById("priceattn").value.replace(/\./g, '');
					priceattn = priceattn.replace("Rp ", "");
					if (checkBox.checked == true) {
						$("#divpayment").show(750);
						$("#voucherdiv").show(750);
						document.getElementById("amount").value = parseInt(amount) + (parseInt(priceattn) * parseInt(attendance));
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vcourse").value = (parseInt(priceattn) * parseInt(attendance));
						oldpriceprv = priceattn;
					} else {
						document.getElementById("amount").value = parseInt(amount) - (parseInt(priceattn) * parseInt(attendance));
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vcourse").value = (parseInt(priceattn) * parseInt(attendance));
						oldpriceprv = priceattn;
					}
				}
			}
		<?php
		}
		?>
	}

	function changeMethod() {
		var amount = document.getElementById("amount").value.replace(/\./g, '');
		amount = amount.replace("Rp ", "");

		if (document.getElementById("method").value == "CASH") {
			$("#dtrfdate").hide(750);
			$("#dbank").hide(750);
			$("#dcut").hide(750);
			$("#dnumber").hide(750);
		} else if (document.getElementById("method").value == "BANK TRANSFER") {
			$("#dtrfdate").show(750);
			$("#dnumber").show(750);
			$("#dbank").hide(750);
			$("#dcut").hide(750);
		} else if (document.getElementById("method").value == "DEBIT") {
			$("#dbank").show(750);
			$("#dcut").show(750);
			$("#dnumber").show(750);
			$("#dtrfdate").hide(750);
			if (document.getElementById("bank").value == "BCA Card") {
				paymentcut = parseInt(amount) * 0.15 / 100;
			} else if (document.getElementById("bank").value != "") {
				paymentcut = parseInt(amount) * 1 / 100;
			}
		} else if (document.getElementById("method").value == "CREDIT") {
			$("#dbank").show(750);
			$("#dcut").show(750);
			$("#dnumber").show(750);
			$("#dtrfdate").hide(750);
			if (document.getElementById("bank").value == "BCA CARD") {
				paymentcut = parseInt(amount) * 0.9 / 100;
			} else if (document.getElementById("bank").value == "AMERICAN EXPRESS") {
				paymentcut = parseInt(amount) * 3.25 / 100;
			} else if (document.getElementById("bank").value != "") {
				paymentcut = parseInt(amount) * 2 / 100;
			}
		} else if (document.getElementById("method").value == "SWITCHING CARD") {
			$("#dbank").show(750);
			$("#dcut").show(750);
			$("#dnumber").show(750);
			$("#dtrfdate").hide(750);
			if (document.getElementById("bank").value != "") {
				paymentcut = parseInt(amount) * 0.75 / 100;
			}
		}

		document.getElementById("paymentcut").value = parseInt(paymentcut);
		document.getElementById("paymentcut").value = "Rp " + FormatDuit(document.getElementById("paymentcut").value);
	}

	function changeBank() {
		var amount = document.getElementById("amount").value.replace(/\./g, '');
		amount = amount.replace("Rp ", "");

		if (document.getElementById("method").value == "DEBIT") {
			if (document.getElementById("bank").value == "BCA CARD") {
				paymentcut = parseInt(amount) * 0.15 / 100;
			} else if (document.getElementById("bank").value != "") {
				paymentcut = parseInt(amount) * 1 / 100;
			}
		} else if (document.getElementById("method").value == "CREDIT") {
			if (document.getElementById("bank").value == "BCA CARD") {
				paymentcut = parseInt(amount) * 0.9 / 100;
			} else if (document.getElementById("bank").value == "AMERICAN EXPRESS") {
				paymentcut = parseInt(amount) * 3.25 / 100;
			} else if (document.getElementById("bank").value != "") {
				paymentcut = parseInt(amount) * 2 / 100;
			}
		} else if (document.getElementById("method").value == "SWITCHING CARD") {
			if (document.getElementById("bank").value != "") {
				paymentcut = parseInt(amount) * 0.75 / 100;
			}
		}

		document.getElementById("paymentcut").value = parseInt(paymentcut);
		document.getElementById("paymentcut").value = "Rp " + FormatDuit(document.getElementById("paymentcut").value);
	}

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

	$('#example').on('keyup keypress', function(e) {
		var keyCode = e.keyCode || e.which;
		if (keyCode === 13) {
			e.preventDefault();
			return false;
		}
	});

	$("#example").submit(function() {
		var amount = document.getElementById("amount").value.replace(/\./g, '');
		amount = amount.replace("Rp ", "");
		var paymentcut = document.getElementById("paymentcut").value.replace(/\./g, '');
		paymentcut = paymentcut.replace("Rp ", "");
		document.getElementById("amount").value = parseInt(amount) - parseInt(paymentcut);
		document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
		alert('Add registration successful.');
	});
</script>