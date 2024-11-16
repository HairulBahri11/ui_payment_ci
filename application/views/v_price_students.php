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

			<li class="active">
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
			Billing
			<small>Add Regular Class Billing</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Billing</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<form action="<?= base_url() ?>billing/saveRegularBill" method="POST">
					<div class="box box-primary">
						<div class="box-header">
							<!-- <h3 class="box-title">List Prices</h3> -->

						</div>
						<!-- /.box-header -->
						<div class="box-body">
							<div class="table-responsive">
								<table class="table table-bordered table-striped table-hover">
									<thead>
										<tr>
											<th>Name</th>
											<th>Mounth</th>
											<th>
												<div class="checkbox" style="margin-top: 5px!important; margin-bottom:0px!important;">
													<label>
														<input type="checkbox" checked id="checkAll"> <b>Course</b>
													</label>
												</div>
											</th>
											<th>
												<div class="checkbox" style="margin-top: 5px!important; margin-bottom:0px!important;">
													<label>
														<input type="checkbox" checked id="checkAllPb"> <b>Point Book</b>
													</label>
												</div>
											</th>

											<th>
												<div class="checkbox" style="margin-top: 5px!important; margin-bottom:0px!important;">
													<label>
														<input type="checkbox" checked id="checkAllBook"> <b>Book</b>
													</label>
												</div>
											</th>
											<th>
												<div class="checkbox" style="margin-top: 5px!important; margin-bottom:0px!important;">
													<label>
														<input type="checkbox" checked id="checkAllAgenda"> <b>Agenda</b>
													</label>
												</div>
											</th>
											<th>Total</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$no = 1;
										foreach ($studentList as $row) {

										?>
											<tr>
												<td>
													<input type="hidden" readonly name="student_id[]" value="<?= $row->sid ?>">
													<?= $row->name ?>
												</td>
												<td style="width:170px;">
													<input type="hidden" readonly id="valMonth<?= $no ?>" value="<?= $row->monthpay; ?>">
													<select class="form-control select2 col-md-12" name="monthpay[]" id="monthpay<?= $no ?>">
														<option value="">Mounth Pay</option>
														<?php
														for ($month = 1; $month <= 12; $month++) {
															$monthName = date("F", mktime(0, 0, 0, $month + 1, 1));
															$year = date("Y");
															$numMounth = $month < 10 ? '0' . $month : $month;
															$valOption = $numMounth . '-' . $year;
															$val = explode('-', $row->monthpay);
														?>
															<option value="<?= $valOption ?>" <?= $valOption == $val[1] . '-' . $val[0] ? 'selected' : '' ?>><?= $monthName . ' ' . $year ?></option>
														<?php
														}
														?>
													</select>
												</td>
												<td style="text-align: center;">
													<input type="hidden" name="course[<?= $no ?>][]" readonly value="0">
													<input type="checkbox" value="1" checked name="course[<?= $no ?>][]" id="checkedCourse<?= $no ?>">
												</td>
												<td style="text-align: center;">
													<input type="hidden" name="pointBook[<?= $no ?>][]" readonly value="0">
													<input type="checkbox" value="1" checked name="pointBook[<?= $no ?>][]" id="pointbook<?= $no ?>">
												</td>
												<td style="text-align: center;">
													<input type="hidden" name="book[<?= $no ?>][]" readonly value="0">
													<input type="checkbox" value="1" checked name="book[<?= $no ?>][]" id="book<?= $no ?>">
												</td>
												<td style="text-align: center;">
													<input type="hidden" name="agenda[<?= $no ?>][]" readonly value="0">
													<input type="checkbox" value="1" checked name="agenda[<?= $no ?>][]" id="agenda<?= $no ?>">
												</td>


												<td>
													<input type="hidden" id="valTotal<?= $no ?>" name="totalBill[]" value="0">
													<h4 id="total<?= $no ?>">Rp. 0</h4>
												</td>

											</tr>
										<?php
											$no++;
										}
										?>
									</tbody>

								</table>
							</div>
						</div>
						<!-- /.box-body -->
						<div class="box-footer">
							<input type="hidden" readonly name="coursePrice" value="<?= $detail->course; ?>">
							<input type="hidden" readonly name="registrationPrice" value="<?= $detail->registration; ?>">
							<input type="hidden" readonly name="agendaPrice" value="<?= $detail->agenda; ?>">
							<input type="hidden" readonly name="pointbookPrice" value="<?= $detail->pointbook; ?>">
							<input type="hidden" readonly name="bookPrice" value="<?= $detail->book; ?>">
							<div class="col-sm-9">
								<button type="submit" class="btn btn-primary">Submit</button>
							</div>
						</div>
					</div>
				</form>
				<!-- /.box -->


			</div>
			<!-- /.col -->
		</div>
		<!-- /.row -->
	</section>
	<!-- /.content -->
</div>
<script type="text/javascript">
	var course = "<?= $detail->course; ?>";
	var pointbook = "<?= $detail->pointbook; ?>";
	var book = "<?= $detail->book; ?>";
	var agenda = "<?= $detail->agenda; ?>";

	$(document).ready(function() {

		var len = $('.select2').length;
		for (let id = 1; id <= len; id++) {
			var tmpTotal = parseInt($('#valTotal' + id).val());
			var tmpCourse = 0;
			var tmpPointBook = 0;
			var tmpBook = 0;
			var tmpAgenda = 0;
			if ($('#checkedCourse' + id).is(':checked')) {
				tmpCourse += parseInt(course);
			} else {
				tmpCourse -= parseInt(course);
			}
			if ($('#pointbook' + id).is(':checked')) {
				tmpPointBook += parseInt(pointbook);
			} else {
				tmpPointBook -= parseInt(pointbook);
			}
			if ($('#book' + id).is(':checked')) {
				tmpBook += parseInt(book);
			} else {
				tmpBook -= parseInt(book);
			}
			if ($('#agenda' + id).is(':checked')) {
				tmpAgenda += parseInt(agenda);
			} else {
				tmpAgenda -= parseInt(agenda);
			}
			$('#valTotal' + id).val(tmpTotal + tmpPointBook + tmpBook + tmpAgenda + tmpCourse);
			$('#total' + id).text(formatCurrency(tmpTotal + tmpPointBook + tmpBook + tmpAgenda + tmpCourse));
			$('#checkedCourse' + id).change(function() {
				if (this.checked) {
					tmpTotal += parseInt(course);
				} else {
					tmpTotal -= parseInt(course);
				}

				$('#valTotal' + id).val(tmpTotal);
				$('#total' + id).text(formatCurrency(tmpTotal));
			});
			$('#pointbook' + id).change(function() {
				if (this.checked) {
					tmpTotal += parseInt(pointbook);
				} else {
					tmpTotal -= parseInt(pointbook);
				}

				$('#valTotal' + id).val(tmpTotal);
				$('#total' + id).text(formatCurrency(tmpTotal));
			});
			$('#book' + id).change(function() {
				if (this.checked) {
					tmpTotal += parseInt(book);
				} else {
					tmpTotal -= parseInt(book);
				}

				$('#valTotal' + id).val(tmpTotal);
				$('#total' + id).text(formatCurrency(tmpTotal));
			});
			$('#agenda' + id).change(function() {
				if (this.checked) {
					tmpTotal += parseInt(agenda);
				} else {
					tmpTotal -= parseInt(agenda);
				}

				$('#valTotal' + id).val(tmpTotal);
				$('#total' + id).text(formatCurrency(tmpTotal));
			});

			// $('#pointbook' + id).keyup(function() {
			// 	tmpPointBook = 0;
			// 	if ($(this).val() != '') {
			// 		tmpPointBook += (parseInt($(this).val()) * pointbook);
			// 	}
			// 	$('#valTotal' + id).val(tmpTotal + tmpPointBook + tmpBook + tmpAgenda + tmpCourse);
			// 	$('#total' + id).text(formatCurrency(tmpTotal + tmpPointBook + tmpBook + tmpAgenda + tmpCourse));
			// });

			// $('#book' + id).keyup(function() {
			// 	tmpBook = 0;
			// 	if ($(this).val() != '') {
			// 		tmpBook += (parseInt($(this).val()) * book);
			// 	}
			// 	console.log(tmpBook);
			// 	$('#valTotal' + id).val(tmpTotal + tmpPointBook + tmpBook + tmpAgenda + tmpCourse);
			// 	$('#total' + id).text(formatCurrency(tmpTotal + tmpPointBook + tmpBook + tmpAgenda + tmpCourse));
			// });
			// $('#agenda' + id).keyup(function() {
			// 	tmpAgenda = 0;
			// 	if ($(this).val() != '') {
			// 		tmpAgenda += (parseInt($(this).val()) * agenda);
			// 	}
			// 	$('#valTotal' + id).val(tmpTotal + tmpPointBook + tmpBook + tmpAgenda + tmpCourse);
			// 	$('#total' + id).text(formatCurrency(tmpTotal + tmpPointBook + tmpBook + tmpAgenda + tmpCourse));
			// });
		}

		$('#checkAll').click(function(event) {
			for (let id = 1; id <= len; id++) {
				var tmpTotal = parseInt($('#valTotal' + id).val());
				$('#checkedCourse' + id).not(this).prop('checked', this.checked);
				if (this.checked) {
					tmpTotal += parseInt(course);
				} else {
					tmpTotal -= parseInt(course);
				}
				$('#valTotal' + id).val(tmpTotal);
				$('#total' + id).text(formatCurrency(tmpTotal));
			}
		});
		$('#checkAllPb').click(function(event) {
			for (let id = 1; id <= len; id++) {
				var tmpTotal = parseInt($('#valTotal' + id).val());
				$('#pointbook' + id).not(this).prop('checked', this.checked);

				if (this.checked) {
					tmpTotal += parseInt(pointbook);
				} else {
					tmpTotal -= parseInt(pointbook);
				}
				// console.log(tmpTotal);
				$('#valTotal' + id).val(tmpTotal);
				$('#total' + id).text(formatCurrency(tmpTotal));
			}
		});
		$('#checkAllBook').click(function(event) {
			for (let id = 1; id <= len; id++) {
				var tmpTotal = parseInt($('#valTotal' + id).val());
				$('#book' + id).not(this).prop('checked', this.checked);
				if (this.checked) {
					tmpTotal += parseInt(book);
				} else {

					tmpTotal -= parseInt(book);
				}
				$('#valTotal' + id).val(tmpTotal);
				$('#total' + id).text(formatCurrency(tmpTotal));
			}
		});
		$('#checkAllAgenda').click(function(event) {
			for (let id = 1; id <= len; id++) {
				var tmpTotal = parseInt($('#valTotal' + id).val());
				$('#agenda' + id).not(this).prop('checked', this.checked);
				if (this.checked) {
					tmpTotal += parseInt(agenda);
				} else {

					tmpTotal -= parseInt(agenda);
				}
				$('#valTotal' + id).val(tmpTotal);
				$('#total' + id).text(formatCurrency(tmpTotal));
			}
		});

		function formatCurrency(total) {
			var neg = false;
			if (total < 0) {
				neg = true;
				total = Math.abs(total);
			}
			return (neg ? "-Rp." : 'Rp.') + parseInt(total, 10).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1.").toString();
		}
	});
</script>
<!-- /.content-wrapper -->