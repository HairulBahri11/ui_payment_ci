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
			Edit Price
			<small>edit selected Price</small>
		</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
			<li><a href="#">Price</a></li>
			<li class="active">Edit Price</li>
		</ol>
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-xs-7">
				<!-- <div class="box"> -->
				<div class="box box-primary">

					<!-- form start -->
					<?php
					foreach ($price->result() as $price) {
						$priceid = $price->id;
					?>
						<form role="form" id="example" name="example" class="form-horizontal" action="<?php echo base_url() ?>price/updatePriceDb" method="post" enctype="multipart/form-data">
							<div class="box-body">
								<div class="form-group">
									<label for="program" class="col-sm-3 control-label">Program</label>
									<div class="col-sm-9">
										<input type="hidden" class="form-control" id="id" name="id" value="<?php echo $price->id; ?>">
										<input type="text" class="form-control" id="program" placeholder="Enter Program" name="program" value="<?php echo $price->program; ?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="level" class="col-sm-3 control-label">Level</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="level" placeholder="Enter Level" name="level" value="<?php echo $price->level; ?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="pointbook" class="col-sm-3 control-label">Point Book</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="pointbook" placeholder="Enter Point Book Price" name="pointbook" value="Rp <?php echo number_format($price->pointbook, 0, ".", "."); ?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="registration" class="col-sm-3 control-label">Registration</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="registration" placeholder="Enter Registration Fee" name="registration" value="Rp <?php echo number_format($price->registration, 0, ".", "."); ?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="book" class="col-sm-3 control-label">Book</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="book" placeholder="Enter Book Price" name="book" value="Rp <?php echo number_format($price->book, 0, ".", "."); ?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="agenda" class="col-sm-3 control-label">Agenda</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="agenda" placeholder="Enter Agenda Price" name="agenda" value="Rp <?php echo number_format($price->agenda, 0, ".", "."); ?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="course" class="col-sm-3 control-label">Course</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="course" placeholder="Enter Course Price" name="course" value="Rp <?php echo number_format($price->course, 0, ".", "."); ?>" required>
									</div>
								</div>

								<div class="form-group">
									<label for="priceperday" class="col-sm-3 control-label">Price/Day</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="priceperday" placeholder="Enter Price/Day" name="priceperday" value="Rp <?php echo number_format($price->priceperday, 0, ".", "."); ?>" required>
									</div>
								</div>

							</div>
							<!-- /.box-body -->
							<div class="box-footer">
								<button type="submit" class="btn btn-primary pull-right">Submit</button>
								<a href="<?= base_url() ?>price"><button type="button" class="btn btn-default">Cancel</button></a>
							</div>
							<!-- /.box-footer -->
						</form>

					<?php
					}
					?>
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

<script type="text/javascript">
	$(document).ready(function() {
		$("#pointbook").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
		$("#registration").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
		$("#book").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
		$("#agenda").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
		$("#course").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
		$("#priceperday").maskMoney({
			prefix: 'Rp ',
			thousands: '.',
			decimal: ',',
			precision: 0
		});
	});
</script>