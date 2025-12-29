<?php
if (isset($_GET['print'])) {
	$idprint = $_GET['print'];
} else {
	$idprint = 0;
}

$url = base_url() . "cetak/printother/";
?>
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
						<li><a href="<?= base_url() ?>payment/addprivate"><i class="fa fa-circle-o"></i> <span>Private Payment</span></a></li>
						<li><a href="<?= base_url() ?>payment/addregular"><i class="fa fa-circle-o"></i> <span>Regular Payment</span></a></li>
						<li class="active"><a href="<?= base_url() ?>payment/addother"><i class="fa fa-circle-o"></i> <span>Other Payment</span></a></li>
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
			<?php
			if (($this->session->userdata('level')) == 1) {
				?>
				<li >
				<a href="<?php echo base_url() ?>user" >
					<i class="fa fa-user"></i> <span>Employee</span>
				</a>
			</li>	
			<?php
			}
			?>

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
			Other Payment
			<small>other payment Form</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li><a href="#">Payment</a></li>
			<li class="active">Other Payment</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-7">
				<!-- <div class="box"> -->
				<div class="box box-primary">
					<div class="box-header with-border">
						<h3 class="box-title">Payment System (Other)</h3>
					</div>
					<!-- /.box-header

            <!-- /.box-header -->
					<!-- form start -->
					<div class="box-body">
						<form role="form" id="example3" name="example3" class="form-horizontal" action="<?php echo base_url() ?>payment/addOtherDb" method="post" enctype="multipart/form-data">
							<div class="form-group">
								<label for="program" class="col-sm-3 control-label">Student ID</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="studentid" name="studentid">
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
								<label for="level" class="col-sm-3 control-label">Level</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="level" name="level" readonly>
								</div>
							</div>

							<div class="form-group">
								<label for="pointbook" class="col-sm-3 control-label">Payment Category</label>
								<div class="col-sm-9">
									<select class="form-control select2" style="width: 100%;" name="category" id="category" onchange="fillAmount()" required>
										<option selected="selected" disabled="disabled" value="">-- Choose Category --</option>
										<option value="POINT BOOK">Point Book</option>
										<option value="BOOK">Book</option>
										<option value="AGENDA">Agenda</option>
										<option value="REGISTRATION">Registration</option>
										<option value="PENALTY">Penalty</option>
										<option value="EXERCISE">Exercise Book</option>
										<option value="OTHER">Other</option>
									</select>
								</div>
							</div>

							<div class="form-group" id="divother" style="display: none">
								<label for="other" class="col-sm-3 control-label">Payment Other</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="other" name="other">
								</div>
							</div>

							<div class="form-group">
								<label for="registration" class="col-sm-3 control-label">Amount</label>
								<div class="col-sm-9">
									<input type="text" class="form-control" id="amount" name="amount" readonly>
								</div>
							</div>

							<div class="form-group">
								<label for="registration" class="col-sm-3 control-label"></label>
								<div class="col-sm-9">
									<button onclick="addDetail()" type="button" class="btn btn-primary">Add</button>
									<a href="<?= base_url() ?>payment/addother"><button type="button" class="btn btn-warning">Clear</button></a>

								</div>
							</div>

							<div class="form-group">
								<div class="col-sm-12">
									<div class="table-responsive">
										<table id="paytab" name="paytab" class="table table-bordered table-striped table-hover">
											<thead>
												<tr>
													<th>Name</th>
													<th>Level</th>
													<th>Payment</th>
													<th>Amount</th>
													<th>Action</th>
												</tr>
											</thead>
											<tbody>

											</tbody>

										</table>
									</div>
								</div>
							</div>
							<!-- </form> -->

							<!-- <form role="form" id="example3" name="example" class="form-horizontal" action="<?php echo base_url() ?>payment/addOtherDb" method="post" enctype="multipart/form-data"> -->
							<div id="dpayment" style="display: none">


								<div class="form-group">
									<label for="no_hp" class="col-sm-3 control-label">No Handphone</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="no_hp" name="no_hp" required>
									</div>
								</div>

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
											<option value="QRIS">QRIS</option>
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
											<option value="OVO">OVO</option>
											<option value="GOPAY">GOPAY</option>
											<option value="SHOPEE PAY">SHOPEE PAY</option>
											<option value="DANA">DANA</option>
											<option value="LINK AJA">LINK AJA</option>
											<option value="OCTO MOBILE">OCTO MOBILE</option>
											<option value="BCA MOBILE">BCA MOBILE</option>
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
										<a href="<?= base_url() ?>payment/addother"><button type="button" class="btn btn-danger">Cancel</button></a>
									</div>
								</div>
							</div>
						</form>

					</div>
					<!-- /.box-body -->

				</div>
				<!-- /.box-body -->

			</div>
			<!-- /.col -->

			<div class="col-xs-5">
				<!-- <div class="box"> -->
				<div class="box box-success">
					<div class="box-header with-border">
						<h3 class="box-title">Select Student</h3>
					</div>
					<div class="box-body">

						<table id="example2" class="table table-bordered table-striped table-hover">
							<thead>
								<tr>
									<th>ID</th>
									<th style="display:none;">priceid</th>
									<th>Name</th>
									<th>Program</th>
									<th>Status</th>
									<th style="display:none;">priceid</th>
								</tr>
							</thead>
							<tbody>
								<?php
								foreach ($listStudent->result() as $row) {
								?>
									<tr>
										<td id="id"><?= $row->sid ?></td>
										<td id="priceid" style="display:none;"><?= $row->priceid ?></td>
										<td id="name"><?= $row->name ?></td>
										<td id="program"><?= $row->program ?></td>
										<td id="phone" style="display:none;"><?= $row->phone ?></td>

										<?php
										if ($row->status == "ACTIVE") {
										?>
											<td><span class="badge bg-green"><?= $row->status ?></span></td>
										<?php
										} elseif ($row->status == "INACTIVE") {
										?>
											<td><span class="badge bg-red"><?= $row->status ?></span></td>
										<?php
										}
										?>
									</tr>
								<?php
								}
								?>
							</tbody>

						</table>

					</div>
					<!-- /.box-body -->
				</div>

			</div>
			<!-- /.col -->


		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

<script type="text/javascript">
	var penalty = 0;
	var totalpay = 0;
	var paymentcut = 0.00;
	var selectedcell = 0;
	var selectedamount = "";

	$(document).ready(function() {
		$("#amount").maskMoney({
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
		document.getElementById("cash").value = 0;
		document.getElementById("cash").value = "Rp " + FormatDuit(document.getElementById("cash").value);
		document.getElementById("cashback").value = 0;
		document.getElementById("cashback").value = "Rp " + FormatDuit(document.getElementById("cashback").value);
	});

	$('#example3').on('keyup keypress', function(e) {
		var keyCode = e.keyCode || e.which;
		if (keyCode === 13) {
			e.preventDefault();
			return false;
		}
	});

	function addDetail() {
		var x = document.getElementById("studentid").value;
		if (x == "") {
			alert("Please select a student first.");
		}

		var paytab = document.getElementById("paytab");
		var tbody = document.createElement("tbody");
		var tr = document.createElement("tr");

		var nametab = document.getElementById("sname").value;
		var leveltab = document.getElementById("level").value;
		var categorytab = document.getElementById("category").value;
		var amounttab = document.getElementById("amount").value;
		var sidtab = document.getElementById("studentid").value;
		var othertab = document.getElementById("other").value;

		var td = document.createElement("td");
		var txt = document.createTextNode(nametab);
		td.appendChild(txt);
		tr.appendChild(td);

		var td = document.createElement("td");
		var txt = document.createTextNode(leveltab);
		td.appendChild(txt);
		tr.appendChild(td);

		if (document.getElementById("category").value === "OTHER") {
			var td = document.createElement("td");
			var txt = document.createTextNode(othertab.toUpperCase());
			td.appendChild(txt);
			tr.appendChild(td);
		} else {
			var td = document.createElement("td");
			var txt = document.createTextNode(categorytab);
			td.appendChild(txt);
			tr.appendChild(td);
		}

		var td = document.createElement("td");
		var txt = document.createTextNode(amounttab);
		td.appendChild(txt);
		tr.appendChild(td);

		var td = document.createElement('td');
		var txt = '<button type="button" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></button>';
		td.innerHTML = txt;
		tr.appendChild(td);

		var td = document.createElement("td");
		var txt = document.createTextNode(sidtab);
		td.appendChild(txt);
		td.style.display = 'none';
		tr.appendChild(td);

		tbody.appendChild(tr);
		paytab.appendChild(tbody);

		var amount = document.getElementById("amount").value.replace(/\./g, '');
		var amount = amount.replace("Rp ", "");
		totalpay = parseInt(totalpay) + parseInt(amount);
		document.getElementById("total").value = totalpay;
		document.getElementById("total").value = "Rp " + FormatDuit(document.getElementById("total").value);

		$("#dpayment").show(750);

		return false;
	}

	$("#paytab").on('click', 'tr', function() {
		if (selectedcell == 4) {
			var values = $(this).find('td').map(function() {
				return $(this).text();
			}).get();
			selectedamount = values[3];
			var amount = selectedamount.replace(/\./g, '');
			var amount = amount.replace("Rp ", "");
			totalpay = parseInt(totalpay) - parseInt(amount);
			document.getElementById("total").value = totalpay;
			document.getElementById("total").value = "Rp " + FormatDuit(document.getElementById("total").value);

			$("tr").eq($("tr").index(this)).remove();
		}

		// alert($("tr").index(this));
	});

	$("#paytab").on('click', 'td', function() {
		selectedcell = $(this).index();
	});

	$("#example2").on('click', 'tr', function() {
		// alert('<?php echo "hi"; ?>');
		document.getElementById("studentid").value = $(this).find("#id").text();
		document.getElementById("spriceid").value = $(this).find("#priceid").text();
		document.getElementById("sname").value = $(this).find("#name").text();
		document.getElementById("level").value = $(this).find("#program").text();
		document.getElementById("no_hp").value = $(this).find("#phone").text();
		fillAmount();
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
					fillAmount();
				}
			<?php
			}
			?>
			if (checksid == 0) {
				alert("Student ID not found");
			}
		}
	});

	function fillAmount() {
		if (document.getElementById("category").value == "OTHER") {
			$("#divother").show(750);
		} else {
			$("#divother").hide(750);
		}

		<?php
		foreach ($listStudent->result() as $student) {
		?>
			if (document.getElementById("studentid").value == "<?= $student->sid ?>") {
				penalty = <?= $student->penalty ?>;
			}
		<?php
		}
		?>

		<?php
		foreach ($listPrice->result() as $price) {
		?>
			if (document.getElementById("spriceid").value == <?= $price->id ?>) {
				var category = document.getElementById('category');
				var i;
				var exist = 0;
				for (i = 0; i < category.length; i++) {
					if (category.options[i].text == "Penalty") {
						exist = 1;
					}
				}
				if ("<?= $price->level ?>" == "Private") {
					if (exist == 1) {
						category.remove(5);
					}
				} else {
					if (exist == 0) {
						var option = document.createElement("option");
						option.value = "PENALTY";
						option.text = "Penalty";
						category.add(option, category[5]);
					}
				}

				if (document.getElementById("category").value === "POINT BOOK") {
					document.getElementById("amount").value = "Rp <?php echo number_format($price->pointbook, 0, ".", "."); ?>";
					document.getElementById('amount').readOnly = true;
				} else if (document.getElementById("category").value === "REGISTRATION") {
					document.getElementById("amount").value = "Rp <?php echo number_format($price->registration, 0, ".", "."); ?>";
					document.getElementById('amount').readOnly = true;
				} else if (document.getElementById("category").value === "BOOK") {
					document.getElementById("amount").value = "Rp <?php echo number_format($price->book, 0, ".", "."); ?>";
					document.getElementById('amount').readOnly = true;
				} else if (document.getElementById("category").value === "AGENDA") {
					document.getElementById("amount").value = "Rp <?php echo number_format($price->agenda, 0, ".", "."); ?>";
					document.getElementById('amount').readOnly = true;
				} else if (document.getElementById("category").value === "EXERCISE") {
					document.getElementById("amount").value = "Rp <?php echo number_format($price->exercisebook, 0, ".", "."); ?>";
					document.getElementById('amount').readOnly = true;
				} else if (document.getElementById("category").value === "PENALTY") {
					document.getElementById("amount").value = penalty;
					document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
					document.getElementById('amount').readOnly = true;
				} else if (document.getElementById("category").value === "OTHER") {
					document.getElementById("amount").value = "Rp <?php echo number_format(0, 0, ".", "."); ?>";
					document.getElementById('amount').readOnly = false;
				}
			}
		<?php
		}
		?>
	}

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
		} else if (document.getElementById("method").value == "QRIS") {
			$("#dbank").show(750);
			$("#dcut").show(750);
			$("#dnumber").show(750);

			if (document.getElementById("bank").value != "") {
				paymentcut = parseInt(amount) * 0.6 / 100;
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
		} else if (document.getElementById("method").value == "QRIS") {
			if (document.getElementById("bank").value != "") {
				paymentcut = parseInt(amount) * 0.6 / 100;
			}
		}

		document.getElementById("paymentcut").value = parseInt(paymentcut);
		document.getElementById("paymentcut").value = "Rp " + FormatDuit(document.getElementById("paymentcut").value);
	}

	$("#example3").submit(function() {
		var example3 = document.getElementById("example3");
		var paytab = document.getElementById("paytab");
		var recordnum = 0;

		for (var i = 1, row; row = paytab.rows[i]; i++) {
			var fieldname = "name";
			var fieldname = fieldname.concat(i);
			var value = row.cells[0].innerHTML;
			var field = document.createElement("INPUT");
			field.setAttribute("type", "hidden");
			field.setAttribute("name", fieldname);
			field.setAttribute("value", value);
			example3.appendChild(field);

			var fieldname = "level";
			var fieldname = fieldname.concat(i);
			var value = row.cells[1].innerHTML;
			var field = document.createElement("INPUT");
			field.setAttribute("type", "hidden");
			field.setAttribute("name", fieldname);
			field.setAttribute("value", value);
			example3.appendChild(field);

			var fieldname = "payment";
			var fieldname = fieldname.concat(i);
			var value = row.cells[2].innerHTML;
			var field = document.createElement("INPUT");
			field.setAttribute("type", "hidden");
			field.setAttribute("name", fieldname);
			field.setAttribute("value", value);
			example3.appendChild(field);

			var fieldname = "amount";
			var fieldname = fieldname.concat(i);
			var value = row.cells[3].innerHTML;
			var field = document.createElement("INPUT");
			field.setAttribute("type", "hidden");
			field.setAttribute("name", fieldname);
			field.setAttribute("value", value);
			example3.appendChild(field);

			var fieldname = "studentid";
			var fieldname = fieldname.concat(i);
			var value = row.cells[5].innerHTML;
			var field = document.createElement("INPUT");
			field.setAttribute("type", "hidden");
			field.setAttribute("name", fieldname);
			field.setAttribute("value", value);
			example3.appendChild(field);

			recordnum = recordnum + 1;
		}

		var fieldname = "recordnum";
		var field = document.createElement("INPUT");
		field.setAttribute("type", "hidden");
		field.setAttribute("name", fieldname);
		field.setAttribute("value", recordnum);
		example3.appendChild(field);

		var amount = document.getElementById("total").value.replace(/\./g, '');
		amount = amount.replace("Rp ", "");
		var paymentcut = document.getElementById("paymentcut").value.replace(/\./g, '');
		paymentcut = paymentcut.replace("Rp ", "");
		document.getElementById("total").value = parseInt(amount) - parseInt(paymentcut);
		document.getElementById("total").value = "Rp " + FormatDuit(document.getElementById("total").value);
		alert('Add other payment successful.');
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

	var idprint = <?= $idprint; ?>;

	function Printdata() {
		my_window = window.open("<?= $url; ?>" + idprint, "mywindow", "status=1,width=0,height=10");
		setTimeout(function() {
			my_window.close();
		}, 100000);
	}
	if (idprint > 0) {
		$(document).ready(function() {
			Printdata();
		});
	}
</script>