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

			<li class="active">
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
			Student
			<small>Prospective Student</small>
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
					<div class="box-header">
						<!-- <h3 class="box-title">List Prices</h3> -->
					</div>
					<br>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="row">
							<div class="col-xs-12" style="text-align: end;margin-bottom:20px">
								<a href="<?php echo base_url() . 'student/exportStudentOnline' ?>" class="btn btn-success">Export Excel</a>
							</div>
						</div>
						<div class="table-responsive">
							<table id="exporttrans" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Telephone</th>
										<th>Birthday</th>
										<th>Speaking</th>
										<th>Written</th>
										<th class="notPrintable">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									$no = 1;
									foreach ($listStudent->result() as $row) {
									?>
										<tr class="status<?= $row->status ?>">
											<td><?= $no++ ?></td>
											<td><?= $row->name ?></td>
											<td><?= $row->phone ?></td>
											<td><?= $row->birthday ?></td>
											<td><?= $row->speaking ?></td>
											<td><?= $row->written ?></td>
											<td>
												<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#showResult" onclick="showModalResult('<?= $row->id ?>', '<?= $row->name ?>', '<?= $row->written ?>', '<?= $row->speaking ?>', '<?= $row->priceid ?>')"><?= $row->written == null ? 'Result Test' : 'Edit Result Test' ?></a>
												<a href="#" class="btn btn-primary" data-toggle="modal" data-target="#showModal" onclick="showModalData('<?= $row->id ?>', '<?= $row->name ?>')">Payment</a>
											</td>
										</tr>
									<?php
									}
									?>
								</tbody>
							</table>
						</div>
					</div>
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

<div class="modal fade" id="showModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="<?= base_url() ?>student/updateStudentOnline" method="post" class="form-horizontal">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Payment New Student</h4>
				</div>
				<div class="modal-body">
					<p id="textModal"></p>
					<input type="hidden" name="idstudent" id="idModal" style="color:#000">

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
						<label for="level" class="col-sm-3 control-label">Teacher</label>
						<div class="col-sm-9">
							<select class="form-control select2" style="width: 100%;" name="id_teacher" id="id_teacher" required>
								<option selected="selected" disabled="disabled" value="">-- Choose Teacher --</option>
								<?php
								$day = $this->db->query("SELECT * FROM day ORDER BY id ASC")->result();
								foreach ($teacher->result() as $row) {
								?>
									<option value="<?= $row->id ?>"><?= $row->name ?></option>
								<?php
								}
								?>
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
							<label for="day" class="col-sm-3 control-label">Day</label>
							<div class="col-sm-4">
								<select class="form-control select2" style="width: 100%;" name="day1prv">
									<option selected="selected" disabled="disabled" value="">-- Choose Day --</option>
									<?php foreach ($day as $opt) {
										// $selected = set_value('know') == $opt ? 'selected' : '';
									?>
										<option value="<?= $opt->id ?>"><?= $opt->day ?></option>
									<?php
									}
									?>
								</select>
							</div>
							<label for="day" class="col-sm-1 control-label">-</label>
							<div class="col-sm-4">
								<select class="form-control select2" style="width: 100%;" name="day2prv">
									<option selected="selected" disabled="disabled" value="">-- Choose Day --</option>
									<?php foreach ($day as $opt) {
										// $selected = set_value('know') == $opt ? 'selected' : '';
									?>
										<option value="<?= $opt->id ?>"><?= $opt->day ?></option>
									<?php
									}
									?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="time" class="col-sm-3 control-label">Time</label>
							<div class="col-sm-3">
								<input type="number" class="form-control" name="timeprv">
							</div>
							<div class="col-sm-6">
								<select name="ampmprv" id="" class="form-control">
									<option value="AM">AM</option>
									<option value="PM">PM</option>
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
							<label for="day" class="col-sm-3 control-label">Day</label>
							<div class="col-sm-4">
								<select class="form-control select2" style="width: 100%;" name="day1reg">
									<option selected="selected" disabled="disabled" value="">-- Choose Day --</option>
									<?php foreach ($day as $opt) {
										// $selected = set_value('know') == $opt ? 'selected' : '';
									?>
										<option value="<?= $opt->id ?>"><?= $opt->day ?></option>
									<?php
									}
									?>
								</select>
							</div>
							<label for="day" class="col-sm-1 control-label">-</label>
							<div class="col-sm-4">
								<select class="form-control select2" style="width: 100%;" name="day2reg">
									<option selected="selected" disabled="disabled" value="">-- Choose Day --</option>
									<?php foreach ($day as $opt) {
										// $selected = set_value('know') == $opt ? 'selected' : '';
									?>
										<option value="<?= $opt->id ?>"><?= $opt->day ?></option>
									<?php
									}
									?>
								</select>
							</div>
						</div>

						<div class="form-group">
							<label for="time" class="col-sm-3 control-label">Time</label>
							<div class="col-sm-3">
								<input type="number" class="form-control" name="timereg">
							</div>
							<div class="col-sm-6">
								<select name="ampmreg" id="" class="form-control">
									<option value="AM">AM</option>
									<option value="PM">PM</option>
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

					<div id="dpayment" style="display: none;">
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
									<div class="row">
										<div class="col-md-3" style="margin-top:7px">
											<label>
												<input type="checkbox" id="other" name="other" onclick="checkOther()">
												Other
											</label>
										</div>
										<div class="col-md-9">
											<input type="number" class="form-control" id="iother" name="iother" onkeyup="sumOther()" value="0">
										</div>
									</div>
								</div>
								<!-- <div class="checkbox">
									<label>
										<input type="checkbox" id="exercise" name="exercise" onclick="checkExercise()">
										Belum Bisa
									</label>
								</div> -->
								<div class="checkbox">
									<label>
										<input type="checkbox" id="course" name="course" onclick="checkCourse()">
										Course
									</label>
								</div>
							</div>
						</div>
					</div>

					<div id="divpayment" style="display: none;">
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

						<div class="form-group" id="dtrfdate" style="display: none;">
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

						<div class="form-group" id="dbank" style="display: none;">
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

						<div class="form-group" id="dnumber" style="display: none;">
							<label for="number" class="col-sm-3 control-label">Number</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="number" name="number">
							</div>
						</div>

						<div class="form-group" id="dcut" style="display: none;">
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

						<input type="hidden" class="form-control" id="cashback" name="cashback" readonly value="0">

						<!-- <div class="form-group">
							<label for="cashback" class="col-sm-3 control-label">Cashback</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="cashback" name="cashback" readonly>
							</div>
						</div> -->
					</div>

					<input type="hidden" class="form-control" id="vid" name="vid" value="">
					<input type="hidden" class="form-control" id="vamount" name="vamount">
					<input type="hidden" class="form-control" id="vregistration" name="vregistration" value="">
					<input type="hidden" class="form-control" id="vpointbook" name="vpointbook">
					<input type="hidden" class="form-control" id="vbook" name="vbook" value="">
					<input type="hidden" class="form-control" id="vagenda" name="vagenda">
					<input type="hidden" class="form-control" id="vbooklet" name="vbooklet">
					<!-- <input type="hidden" class="form-control" id="vexercise" name="vexercise"> -->
					<input type="hidden" class="form-control" id="vcourse" name="vcourse">
					<input type="text" class="form-control" id="vother" name="vother" value="0">
					<input type="hidden" class="form-control" id="countattn" name="countattn">
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary pull-left">Submit</button>
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
					<!-- <a href=""><button type="button" class="btn btn-outline">Delete</button></a> -->
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<div class="modal fade" id="showResult">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="<?= base_url() ?>student/resultTest" method="post" class="form-horizontal">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Result Test Student</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<p id="textModal"></p>
						<input type="hidden" name="idstudent" id="idModalResult" style="color:#000">

						<div class="col-sm-4">
							<label for="category" class="control-label">Category</label>
						</div>
						<div class="col-sm-8">
							<select class="form-control select2" style="width: 100%;" name="" id="categoryResult" onchange="changeCategoryResult()" required>
								<option disabled="disabled" value="">-- Choose Category --</option>
								<option value="PRIVATE">PRIVATE</option>
								<option value="REGULAR">REGULAR</option>
							</select>
						</div>
						<div class="col-sm-4" style="margin-top: 15px;">
							<label for="placement_test_result" class="control-label">Placement Test Result</label>
						</div>
						<div class="col-sm-8" style="margin-top: 15px;">
							<input type="text" class="form-control" value="" id="placement_test_result" name="placement_test_result" required>
						</div>
						<div class="col-sm-4" style="margin-top: 15px;">
							<label for="kind_of_test" class="control-label">Kind Of Test</label>
						</div>
						<div class="col-sm-8" style="margin-top: 15px;">
							<input type="text" class="form-control" value="" id="kind_of_test" name="kind_of_test" required>
						</div>
						<div class="col-sm-4" style="margin-top: 15px;">
							<label for="written" class="control-label">Written</label>
						</div>
						<div class="col-sm-2" style="margin-top: 15px;">
							<input type="number" max="100" class="form-control" value="" id="written" name="written" required>
						</div>
						<div class="col-sm-2" style="margin-top: 15px;">
							<label for="speaking" class="control-label">Speaking</label>
						</div>
						<div class="col-sm-4" style="margin-top: 15px;">
							<select class="form-control select2" style="width: 100%;" id="speaking" name="speaking" required>
								<option disabled="disabled" value="" selected>-- Choose Score --</option>
								<?php
								$options = array("A", "A-", "B+", "B", "B-", "C+", "C", "C-", "D+", "D", "D-", "E");
								foreach ($options as $opt) {
									$selected = set_value('speaking') == $opt ? 'selected' : '';
								?>
									<option value="<?= $opt ?>" <?= $selected ?>><?= $opt ?></option>
								<?php
								}
								?>
							</select>
						</div>
						<div class="col-sm-4" style="margin-top: 15px;">
							<label for="staff" class="control-label">Staff</label>
						</div>
						<div class="col-sm-8" style="margin-top: 15px;">
							<select class="form-control select2" style="width: 100%;" name="staff" id="staff" required>
								<option disabled="disabled" value="" selected>-- Choose Staff --</option>
								<?php
								foreach ($staff->result() as $stf) {
									$selected = set_value('staff') == $stf->id ? 'selected' : '';
								?>
									<option value="<?= $stf->id ?>" <?= $selected ?>><?= $stf->name ?></option>
								<?php
								}
								?>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-primary pull-left">Submit</button>
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
					<!-- <a href=""><button type="button" class="btn btn-outline">Delete</button></a> -->
				</div>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

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

	function changeCategoryResult() {
		if (document.getElementById("categoryResult").value == "PRIVATE") {
			$("#resultprivatediv").show(750);
			$("#resultregulardiv").hide(750);
		} else {
			$("#resultprivatediv").hide(750);
			$("#resultregulardiv").show(750);
		}
	}

	function showDetail() {
		document.getElementById("registration").checked = false;
		document.getElementById("pointbook").checked = false;
		document.getElementById("book").checked = false;
		document.getElementById("agenda").checked = false;
		document.getElementById("booklet").checked = false;
		document.getElementById("other").checked = false;
		// document.getElementById("exercise").checked = false;
		document.getElementById("course").checked = false;

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

	function showDetailResult() {
		console.log('asd');
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

	function checkOther() {
		if (document.getElementById("amount").value != "") {
			var amount = document.getElementById("amount").value.replace(/\./g, '');
			amount = amount.replace("Rp ", "");
		} else {
			var amount = 0;
		}
		var checkBox = document.getElementById("other");
		var totalOther = 0
		if (checkBox.checked == true) {
			$("#divpayment").show(750);
			$("#voucherdiv").show(750);
			totalOther = document.getElementById("vother").value
			document.getElementById("amount").value = parseInt(amount) + parseInt(totalOther);
			document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
		} else {
			document.getElementById("amount").value = parseInt(amount) + parseInt(totalOther);
			document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
		}
	}

	function sumOther() {
		if (document.getElementById("amount").value != "") {
			var amount = document.getElementById("amount").value.replace(/\./g, '');
			amount = amount.replace("Rp ", "");
		} else {
			var amount = 0;
		}
		var checkBox = document.getElementById("other");
		var subOther = 0
		var totalOther = 0
		if (checkBox.checked == true) {
			subOther = document.getElementById("iother").value
			document.getElementById("vother").value = isNaN(parseInt(subOther)) == false ? parseInt(subOther) : 0;
			totalOther = document.getElementById("vother").value
			document.getElementById("amount").value = parseInt(amount) + parseInt(totalOther);
			document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
		}
		/* else {
			totalOther = document.getElementById("vother").value
			document.getElementById("amount").value = parseInt(amount) - parseInt(totalOther);
			document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
		} */

	}

	function checkExercise() {
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
					var checkBox = document.getElementById("exercise");
					if (checkBox.checked == true) {
						$("#divpayment").show(750);
						$("#voucherdiv").show(750);
						document.getElementById("amount").value = parseInt(amount) + parseInt(<?= $price->agenda ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vexercise").value = parseInt(<?= $price->agenda ?>);
					} else {
						document.getElementById("amount").value = parseInt(amount) - parseInt(<?= $price->agenda ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vexercise").value = parseInt(<?= $price->agenda ?>);
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
						document.getElementById("vexercise").value = parseInt(<?= $price->agenda ?>);
					} else {
						document.getElementById("amount").value = parseInt(amount) - parseInt(<?= $price->agenda ?>);
						document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
						document.getElementById("vexercise").value = parseInt(<?= $price->agenda ?>);
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

	function showModalData(id, name) {
		$('.modal-title').html('Update student ' + name);
		$('#idModal').val(id);
	}

	function showModalResult(id, name, written, speaking, priceid) {
		$('.modal-title').html('Result Student Test ' + name);
		$('#idModalResult').val(id);
		$('#written').val(written);
		$('#speaking').val(speaking);
		// $.ajax({
		// 	url: '<?php echo base_url(); ?>/mahasiswa/edit',
		// 	method: 'post',
		// 	data: {
		// 		nim: nim
		// 	},
		// 	success: function(data) {
		// 		$('#myModal').modal("show");
		// 		$('#tampil_modal').html(data);
		// 		document.getElementById("judul").innerHTML = 'Edit Data';
		// 	}
		// });
		$.ajax({
			url: '<?php echo base_url(); ?>student/getPrice/' + priceid,
			type: 'GET',
			dataType: 'json',
			error: function() {
				console.log('Something is wrong');
			},
			success: function(data) {
				// $("tbody").append("<tr><td>" + title + "</td><td>" + description + "</td></tr>");
				var category = data[0].program != 'Private' ? 'REGULAR' : 'PRIVATE';
				$('#levelResult').val(data[0].id);
				$('#categoryResult').val(category);
				// $("#categoryResult").select2("val", category);
				// $("#categoryResult").select2().select2('val', 'REGULAR');
			}
		});
	}
</script>