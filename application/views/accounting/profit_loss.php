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
					<li class="active"><a href="<?= base_url() ?>report/showtrans"><i class="fa fa-circle-o"></i> <span>Transaction</span></a></li>
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
				<li class="treeview active">
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
	<section class="content-header">
		<h1>Profit and Loss</h1>
		<ol class="breadcrumb">
			<li><a href="#"><i class="fa fa-home"></i> Home</a></li>
			<li class="active">Profit and Loss</li>
		</ol>
	</section>

	<section class="content">
		<div class="box box-primary">
			<div class="box-header">
				<h3 class="box-title">Profit and Loss</h3>
				<div class="box-tools pull-right">
					<?php echo form_open('accounting/profit_loss', ['method' => 'post', 'class' => 'form-inline']); ?>
					<label>Pilih Bulan : </label>&nbsp;
					<select data-plugin-selectTwo class="form-control select2" name="month" id="month" required>
						<option value="">--Select Month--</option>
						<option value="01" <?= $month == '01' ? 'selected' : '' ?> >January</option>
						<option value="02" <?= $month == '02' ? 'selected' : '' ?> >February</option>
						<option value="03" <?= $month == '03' ? 'selected' : '' ?> >March</option>
						<option value="04" <?= $month == '04' ? 'selected' : '' ?> >April</option>
						<option value="05" <?= $month == '05' ? 'selected' : '' ?> >May</option>
						<option value="06" <?= $month == '06' ? 'selected' : '' ?> >June</option>
						<option value="07" <?= $month == '07' ? 'selected' : '' ?> >July</option>
						<option value="08" <?= $month == '08' ? 'selected' : '' ?> >August</option>
						<option value="09" <?= $month == '09' ? 'selected' : '' ?> >September</option>
						<option value="10" <?= $month == '10' ? 'selected' : '' ?> >October</option>
						<option value="11" <?= $month == '11' ? 'selected' : '' ?> >November</option>
						<option value="12" <?= $month == '12' ? 'selected' : '' ?> >December</option>
					</select>
					&nbsp;
					<select data-plugin-selectTwo class="form-control select2" name="year" id="year" required>
						<option value="">--Select Year--</option>
						<?php
						for ($i = date('Y') - 3; $i <= date('Y'); $i++):
						?>
						<option value="<?= $i ?>" <?= $year == $i ? 'selected' : '' ?> > <?= $i ?></option>
						<?php
							endfor;
						?>
					</select>
					<button class="btn btn-success">Search</button>

					<?php echo form_close(); ?>
				</div>
			</div>

			<div class="box-body">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead style="background-color:#3c8dbc; color:white">
						<tr>
							<th>Income</th>
							<th width="20%"></th>
						</tr>
						</thead>
						<tbody>
						<?php
						$total_revenue = $data['pendapatan'] + $data['pendapatan_denda'];
						?>
						<tr>
							<td>Income</td>
							<td><?= number_format($data['pendapatan'],0,',','.') ?></td>
						</tr>
						<tr>
							<td>Penalty Income</td>
							<td><?= number_format($data['pendapatan_denda'],0,',','.') ?></td>
						</tr>

						<tr bgColor="#cad6e3">
							<td>Total Income</td>
							<td><?= number_format($total_revenue,0,',','.') ?></td>
						</tr>
						</tbody>
					</table>
					<table class="table table-bordered">
						<thead class="mt-3" style="background-color:#3c8dbc; color:white">
						<tr>
							<th>Expenses</th>
							<th width="20%"></th>
						</tr>
						</thead>
						<tbody>
						<?php
						$total_expense = 0;
						?>
						<?php
						foreach ($data['detail_pengeluaran'] as $key => $value):
							$total_expense += $value->amount;
						?>
						<tr>
							<td><?= $value->explanation ?> </td>
							<td><?= number_format($value->amount,0,',','.')?></td>
						</tr>
						<?php
						endforeach;
						$profit_loss = $total_revenue - $total_expense;
						?>
						<tr bgColor="#cad6e3">
							<td>Total Expense</td>
							<td><?= number_format($total_expense,0,',','.') ?> </td>
						</tr>
						</tbody>
					</table>

					<table class="table table-bordered">
						<thead style="background-color:#3c8dbc; color:white">
						<tr>
							<th>Profit & Loss</th>
							<th width="20%"><?= number_format($profit_loss, 0, ',', '.') ?></th>
						</tr>
						</thead>
					</table>
				</div>
			</div>
		</div>
	</section>
</div>

