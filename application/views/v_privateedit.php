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

				<li class="treeview active">
					<a href="#">
						<i class="fa fa-money"></i> <span>Payment</span>
						<span class="pull-right-container">
							<i class="fa fa-angle-left pull-right"></i>
						</span>
					</a>
					<ul class="treeview-menu">
						<li class="active"><a href="<?= base_url() ?>payment/addprivate"><i class="fa fa-circle-o"></i> <span>Private Payment</span></a></li>
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
					<li class=""><a href="<?= base_url() ?>accounting/jurnal"><i class="fa fa-circle-o"></i> <span>Journal</span></a></li>
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
			Private Payment
			<small>private payment Form</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="#">Payment</a></li>
			<li class="active">Private Payment</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-7">
				<!-- <div class="box"> -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Payment System (Private)</h3>
					</div>
					<!-- /.box-header 
            
            <!-- /.box-header -->
					<!-- form start -->
					<?php
					foreach ($payment->result() as $pay) {
					?>
						<div class="box-body">
							<form role="form" id="example" name="example" class="form-horizontal" action="<?php echo base_url() ?>payment/updatePrivateDb/<?= $pay->id ?>" method="post" enctype="multipart/form-data">
								<div class="form-group">
									<label for="program" class="col-sm-3 control-label">Student ID</label>
									<div class="col-sm-9">
										<?php
										foreach ($listPaydetail->result() as $paydetail) {
											$studentid = $paydetail->studentid;
										}
										?>
										<input type="text" class="form-control" id="studentid" name="studentid" value="<?php echo $paydetail->studentid; ?>">
										<input type="hidden" class="form-control" id="spriceid" name="spriceid" readonly>
									</div>
								</div>

								<div class="form-group">
									<label for="name" class="col-sm-3 control-label">Student Name</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="sname" name="sname" readonly>
									</div>
								</div>

								<div class="form-group">
									<label for="level" class="col-sm-3 control-label">Program</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="level" name="level" readonly>
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

								<div class="form-group">
									<label for="discount" class="col-sm-3 control-label">Discount</label>
									<div class="col-sm-9">
										<div class="col-xs-3 input-group">
											<input type="text" class="form-control" id="discount" name="discount" value="0">
											<span class="input-group-addon">%</span>
										</div>
									</div>
								</div>

								<div class="form-group">
									<label for="registration" class="col-sm-3 control-label">Amount</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="amount" name="amount" readonly>
									</div>
								</div>

								<input type="hidden" class="form-control" id="vid" name="vid" value="">
								<input type="hidden" class="form-control" id="vamount" name="vamount">
								<input type="hidden" class="form-control" id="countattn" name="countattn">

								<div class="form-group">
									<label for="registration" class="col-sm-3 control-label"></label>
									<div class="col-sm-9">
										<button type="submit" class="btn btn-primary">Add</button>
										<a href="<?= base_url() ?>payment/updateprivate/<?= $pay->id ?>"><button type="button" class="btn btn-warning">Clear</button></a>
										<a id="voucherdiv" style="display:none;" data-toggle="modal" data-target="#voucherModal" href="#" class="btn btn-primary pull-right"><i class="fa fa-credit-card"></i>&nbsp;Use Voucher</a>

									</div>
								</div>

								<div class="form-group">
									<div class="col-sm-12">
										<div class="table-responsive">
											<table class="table table-bordered table-striped table-hover">
												<thead>
													<tr>
														<th>Name</th>
														<th>Attendance</th>
														<th>Price / Day</th>
														<th>Discount</th>
														<th>Voucher</th>
														<th>Amount</th>
														<th>Action</th>
													</tr>
												</thead>
												<tbody>
													<?php
													if (isset($listPaydetail)) {
														foreach ($listPaydetail->result() as $row) {
													?>
															<tr>
																<td><?= $row->name ?></td>
																<?php
																$var = $row->explanation;
																if ($var != "") {
																	$parts = explode(' ', $var);
																	$attendance = $parts[1][0];
																	$parts2 = explode('x', $parts[1]);
																	$pos = strpos($parts2[1], '-');
																	if ($pos === false) {
																		$price = $parts2[1];
																		$discount = '';
																	} else {
																		$parts3 = explode('-', $parts2[1]);
																		$price = $parts3[0];
																		$discount = $parts3[1];
																	}
																}
																?>
																<td><?= $attendance ?></td>
																<td>Rp <?= number_format($price, 0, ".", ".") ?></td>
																<td><?= $discount ?></td>
																<td><?= $row->voucherid ?></td>
																<td>Rp <?= number_format($row->amount, 0, ".", ".") ?></td>
																<td><a data-toggle="modal" data-target="#delModal<?php echo $row->id; ?>" href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
															</tr>
													<?php
														}
													}
													?>
												</tbody>

											</table>
										</div>
									</div>
								</div>
							</form>

							<form role="form" id="example3" name="example" class="form-horizontal" action="<?php echo base_url() ?>payment/submitPrivateDb/<?= $pay->id ?>" method="post" enctype="multipart/form-data">
								<div id="dpayment" style="display: none">
									<div class="form-group">
										<label for="total" class="col-sm-3 control-label">Total Amount</label>
										<div class="col-sm-9">
											<input type="text" class="form-control" id="total" name="total" readonly>
										</div>
									</div>

									<div class="form-group">
										<label for="method" class="col-sm-3 control-label">Payment Method</label>
										<div class="col-sm-9">
											<select class="form-control select2" style="width: 100%;" name="method" id="method" onchange="changeMethod()" required>
												<option selected="selected" disabled="disabled" value="">-- Choose Method --</option>
												<option value="CASH">Cash</option>
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

									<div class="form-group">
										<label for="registration" class="col-sm-3 control-label"></label>
										<div class="col-sm-9">
											<button type="submit" class="btn btn-primary">Submit</button>
											<a href="<?= base_url() ?>payment/addprivate"><button type="button" class="btn btn-danger">Cancel</button></a>
										</div>
									</div>
								</div>
							</form>

						</div>
						<!-- /.box-body -->
					<?php
					}
					?>

				</div>
				<!-- /.box-body -->

			</div>
			<!-- /.col -->

			<div class="col-xs-5">
				<!-- <div class="box"> -->


			</div>
			<!-- /.col -->


		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<?php
foreach ($listPaydetail->result() as $row) {
?>
	<div class="modal modal-danger fade" id="delModal<?php echo $row->id; ?>">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Delete Payment Detail</h4>
				</div>
				<div class="modal-body">
					<p>Are you sure to delete this selected payment?</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
					<a href="<?= base_url() ?>payment/deletePrvdetailDb/<?= $row->paymentid ?>/<?= $row->id ?>"><button type="button" class="btn btn-outline">Delete</button></a>
				</div>
			</div>
			<!-- /.modal-content -->
		</div>
		<!-- /.modal-dialog -->
	</div>
	<!-- /.modal -->
<?php
}
?>

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


<script type="text/javascript">
	var olddiscn = 0;
	var oldvoucher = 0;
	var paymentcut = 0.00;

	$(document).ready(function() {
		<?php
		foreach ($listStudent->result() as $student) {
		?>
			if (document.getElementById("studentid").value == "<?= $student->sid ?>") {
				document.getElementById("spriceid").value = <?= $student->priceid ?>;
				document.getElementById("sname").value = "<?= $student->name ?>";
				document.getElementById("level").value = "<?= $student->program ?>";
				$("#voucherdiv").show(750);
			}
		<?php
		}
		?>

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
		$("#total").maskMoney({
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

		document.getElementById("amount").value = 0;
		document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
		document.getElementById("priceattn").value = 0;
		document.getElementById("priceattn").value = "Rp " + FormatDuit(document.getElementById("priceattn").value);

		document.getElementById("cash").value = 0;
		document.getElementById("cash").value = "Rp " + FormatDuit(document.getElementById("cash").value);
		document.getElementById("cashback").value = 0;
		document.getElementById("cashback").value = "Rp " + FormatDuit(document.getElementById("cashback").value);

		$('#attendance').on('itemAdded', function(event) {
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
				if (document.getElementById("spriceid").value == <?= $price->id ?>) {
					var vamount = document.getElementById("vamount").value.replace(/\./g, '');
					vamount = vamount.replace("Rp ", "");
					var priceattn = document.getElementById("priceattn").value.replace(/\./g, '');
					priceattn = priceattn.replace("Rp ", "");
					var discount = document.getElementById("discount").value;
					var attendance = $("#attendance").tagsinput('items').length;
					document.getElementById("countattn").value = attendance;
					amount = parseInt(priceattn) * parseInt(attendance);
					if (document.getElementById("vamount").value != "") {
						amount = parseInt(amount) - parseInt(vamount);
						oldvoucher = vamount;
					}
					document.getElementById("amount").value = parseInt(amount) - Math.round(parseInt(discount) * parseInt(amount) / 100);
					document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
					olddiscn = Math.round(parseInt(discount) * parseInt(amount) / 100);
				}
			<?php
			}
			?>
		});

		$('#attendance').on('itemRemoved', function(event) {
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
				if (document.getElementById("spriceid").value == <?= $price->id ?>) {
					var vamount = document.getElementById("vamount").value.replace(/\./g, '');
					vamount = vamount.replace("Rp ", "");
					var priceattn = document.getElementById("priceattn").value.replace(/\./g, '');
					priceattn = priceattn.replace("Rp ", "");
					var discount = document.getElementById("discount").value;
					var attendance = $("#attendance").tagsinput('items').length;
					document.getElementById("countattn").value = attendance;
					amount = parseInt(priceattn) * parseInt(attendance);
					if (document.getElementById("vamount").value != "") {
						amount = parseInt(amount) - parseInt(vamount);
						oldvoucher = vamount;
					}
					document.getElementById("amount").value = parseInt(amount) - Math.round(parseInt(discount) * parseInt(amount) / 100);
					document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
					olddiscn = Math.round(parseInt(discount) * parseInt(amount) / 100);
				}
			<?php
			}
			?>
		});

		$("#dpayment").show(750);

		<?php
		$totalpay = 0;
		foreach ($listPaydetail->result() as $paydet) {
			$totalpay = $totalpay + $paydet->amount;
		}
		?>
		document.getElementById("total").value = "Rp <?php echo number_format($totalpay, 0, ".", "."); ?>";
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
			if (document.getElementById("spriceid").value == <?= $price->id ?>) {
				var vamount = document.getElementById("vamount").value.replace(/\./g, '');
				vamount = vamount.replace("Rp ", "");
				var priceattn = document.getElementById("priceattn").value.replace(/\./g, '');
				priceattn = priceattn.replace("Rp ", "");
				var discount = document.getElementById("discount").value;
				var attendance = $("#attendance").tagsinput('items').length;
				document.getElementById("countattn").value = attendance;
				amount = parseInt(priceattn) * parseInt(attendance);
				if (document.getElementById("vamount").value != "") {
					amount = parseInt(amount) - parseInt(vamount);
					oldvoucher = vamount;
				}
				document.getElementById("amount").value = parseInt(amount) - Math.round(parseInt(discount) * parseInt(amount) / 100);
				document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
				olddiscn = Math.round(parseInt(discount) * parseInt(amount) / 100);
			}
		<?php
		}
		?>
		// }
	});

	$('#example').on('keyup keypress', function(e) {
		var keyCode = e.keyCode || e.which;
		if (keyCode === 13) {
			e.preventDefault();
			return false;
		}
	});

	$("#example").submit(function() {
		var x = document.getElementById("studentid").value;
		if (x == "") {
			alert("Please select a student first.");
			return false;
		}
	});

	$("#example2").on('click', 'tr', function() {
		// alert('<?php echo "hi"; ?>');
		document.getElementById("studentid").value = $(this).find("#id").text();
		document.getElementById("spriceid").value = $(this).find("#priceid").text();
		document.getElementById("sname").value = $(this).find("#name").text();
		document.getElementById("level").value = $(this).find("#program").text();

		// <?php
			//   foreach ($listPrice->result() as $price) { 
			// 
			?>
		//   if (document.getElementById("spriceid").value == <?= $price->id ?>) {
		//     document.getElementById("priceattn").value = parseInt(<?= $price->priceperday ?>);
		//     document.getElementById("priceattn").value = "Rp " + FormatDuit(document.getElementById("priceattn").value);

		//     var vamount =  document.getElementById("vamount").value.replace(/\./g, '');
		//     vamount =  vamount.replace("Rp ", "");
		//     var discount =  document.getElementById("discount").value;
		//     var attendance = $("#attendance").tagsinput('items').length;
		//     amount = parseInt(<?= $price->priceperday ?>) * parseInt(attendance);
		//     if(document.getElementById("vamount").value != "") {
		//       amount = parseInt(amount) - parseInt(vamount);
		//       oldvoucher = vamount;
		//     }
		//     document.getElementById("amount").value = parseInt(amount) - Math.round(parseInt(discount) * parseInt(amount) / 100);
		//     document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
		//     olddiscn = Math.round(parseInt(discount) * parseInt(amount) / 100);
		//   }
		// <?php
			//   }
			// 
			?>

		$("#voucherdiv").show(750);
	});

	$("#studentid").on('keyup', function(e) {
		var checksid = 0;
		if (e.keyCode == 13) {
			<?php
			foreach ($listStudent->result() as $student) {
			?>
				if (document.getElementById("studentid").value == "<?= $student->sid ?>") {
					document.getElementById("spriceid").value = <?= $student->priceid ?>;
					document.getElementById("sname").value = "<?= $student->name ?>";
					document.getElementById("level").value = "<?= $student->program ?>";
					checksid = 1;
					$("#voucherdiv").show(750);
				}
			<?php
			}
			?>
			if (checksid == 0) {
				alert("Student ID not found");
			}
		}
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

	$("#discount").on('keyup', function(e) {
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

		if (document.getElementById("discount").value != "") {
			var discount = document.getElementById("discount").value;
			amount = parseInt(amount) + parseInt(olddiscn);
			document.getElementById("amount").value = parseInt(amount) - Math.round(parseInt(discount) * parseInt(amount) / 100);
			document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
			olddiscn = Math.round(parseInt(discount) * parseInt(amount) / 100);
		}
		// }
	});

	function changeMethod() {
		var amount = document.getElementById("total").value.replace(/\./g, '');
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
		var amount = document.getElementById("total").value.replace(/\./g, '');
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

	$("#example3").submit(function() {
		var amount = document.getElementById("total").value.replace(/\./g, '');
		amount = amount.replace("Rp ", "");
		var paymentcut = document.getElementById("paymentcut").value.replace(/\./g, '');
		paymentcut = paymentcut.replace("Rp ", "");
		document.getElementById("total").value = parseInt(amount) - parseInt(paymentcut);
		document.getElementById("total").value = "Rp " + FormatDuit(document.getElementById("total").value);
		alert('Add private payment successful.');
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
</script>