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
			Student
			<small>List Students</small>
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
						<div class="pull-right">
							<a href="<?= base_url() ?>student/addStudent"><button class="btn btn-primary btn-sm"><i class="fa fa-plus" aria-hidden="true">&nbsp;</i>&nbsp;Add New Student</button></a>
						</div>
						<div class="pull-left">
							<button class="btn btn-primary" id="showstudentall">ALL</button>&nbsp;<button class="btn btn-success" id="hideInactive">Student Active</button>&nbsp;<button class="btn btn-danger" id="hideActive">Student Inactive</button>
						</div>
					</div>
					<br>
					<!-- /.box-header -->
					<div class="box-body">
						<div class="table-responsive">
							<table id="example1" class="table table-bordered table-striped table-hover">
								<thead>
									<tr>
										<th>ID</th>
										<th>Name</th>
										<th>Telephone</th>
										<th>Birthday</th>
										<!--  <th>Last Payment</th> -->
										<th>Program</th>
										<!--<th>Course Fee</th>-->
										<th>Note</th>
										<th>Status</th>
										<th class="notPrintable">Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									
									
									foreach ($listStudent->result() as $row) {
									?>
										<tr class="status<?= $row->status ?>">
											<td><?= $row->sid ?></td>
											<td><?= $row->name ?></td>
											<td><?= $row->phone ?></td>
											<td><?= $row->birthday ?></td>
											<?php /*
                  if ($row->monthpay != null) {
                    $var = $row->monthpay;
                    $parts = explode('-',$var);
                    $paydate = $parts[2] . '/' . $parts[1] . '/' . $parts[0]; 
                    echo "<td>".$paydate."</td>";
                  }else{
                    echo "<td>-</td>";
                  }*/
											?>
											<?php
											if ($row->program != null) {
												echo "<td>" . $row->program . "</td>";
											} else {
												echo "<td>-</td>";
											}
											?>
											
											<td><?= $row->note ?></td>
											
											
											<?php
											//if ($row->level != "Private") {
												//if ($row->condition == "DEFAULT") {
											?>
													<!--<td><span class="badge bg-yellow">Default: Rp <?= number_format($row->course, 0, ".", ".") ?></span></td>-->
												<?php
												//} elseif ($row->condition == "CHANGE") {
												?>
													<!--<td><span class="badge bg-light-blue">Change: Rp <?= number_format($row->course, 0, ".", ".") ?></span></td>-->
												<?php
												//} else {
												//	echo "<td>-</td>";
												//}
											//} else {
												?>
												<!--<td>-</td>-->
											<?php
											//}
											?>
											<?php
											if ($row->status == "ACTIVE") {
											?>
												<td><span class="badge bg-green"><?= $row->status ?></span></td>
											<?php
											} elseif ($row->status == "INACTIVE") {
											?>
												<td><span class="badge bg-red"><?= $row->status ?></span></td>
											<?php
											} else {
												echo "<td>-</td>";
											}
											?>
											<td>
												<a href="<?= base_url() ?>student/updateStudent/<?= $row->sid ?>" class="btn btn-success btn-xs"><i class="fa fa-pencil"></i></a>
												<a data-toggle="modal" data-target="#delModal" onclick="showModalData('<?= $row->sid ?>','<?= $row->name ?>')" href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
												<!-- <a data-toggle="modal" data-target="#delModal<?php echo $row->sid; ?>" href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a> -->
												<!-- <a data-toggle="modal" data-target="#showModal<?php echo $row->sid; ?>" href="#" class="btn btn-primary btn-xs"><i class="fa fa-file-text-o"></i></a> -->
												<a href="<?= base_url('student/detailPayment/') ?><?= $row->sid; ?>/<?= $row->name; ?>" class="btn btn-primary btn-xs"><i class="fa fa-file-text-o"></i></a>
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

<div class="modal modal-danger fade" id="delModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<form action="<?= base_url() ?>student/deleteStudentDb" method="post">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title">Delete Student</h4>
				</div>
				<div class="modal-body">
					<p id="textModal"></p>
					<input type="hidden" name="idstudent" id="idModal" style="color:#000">
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-outline">Delete</button>
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
	function showModalData(id, name) {
		$('#textModal').html('Are you sure to delete student ' + name + '?');
		$('#idModal').val(id);
	}
</script>

<?php
/*foreach ($listStudent->result() as $row) { 
  ?>
  <div class="modal modal-danger fade" id="delModal<?php echo $row->sid;?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Delete Student</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure to delete student <?= $row->name ?>?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
          <a href="<?= base_url() ?>student/deleteStudentDb/<?= $row->sid ?>"><button type="button" class="btn btn-outline">Delete</button></a>
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

  <?php
/*    foreach ($listStudent->result() as $row) { 
  ?>
  <div class="modal modal-default fade" id="showModal<?php echo $row->sid;?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Student Payment List</h4>
        </div>
        <div class="modal-body">
          <table id="examples" class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
              <th>Nota</th>
              <th>Payment</th>
              <th>Method</th>
              <th>Pay Date</th>
              <th>Amount</th>
              <th>Voucher</th>
            </tr>
            </thead>
            <tbody>
            <?php
              foreach ($listStudentPayment->result() as $payment) { 
                if ($payment->studentid == $row->sid) {
            ?>
            <tr>
              <td><?= $payment->id ?></td>
              <?php
                if ($payment->category == "COURSE" && $payment->monthpay != "") {
                  $var = $payment->monthpay;
                  $parts = explode('-',$var);
                  $monthpay = $parts[1] . '/' . $parts[0]; 
                  $monthpay =  date("M", strtotime($payment->monthpay));
                  $yearpay =  date("y", strtotime($payment->monthpay));
                  $category = $payment->category . " (" . $monthpay . " ". $yearpay . ")";
                } else {
                  $category = $payment->category;
                }
              ?>
              <td><?= $category ?></td>
              <td><?= $payment->method ?></td>
              <?php
                $var = $payment->paydate;
                $parts = explode('-',$var);
                $paydate = $parts[2] . '/' . $parts[1] . '/' . $parts[0]; 
              ?>
              <td><?= $paydate ?></td>  
              <td>Rp <?= number_format($payment->amount, 0, ".", ".") ?></td>
              <?php
                if ($payment->voucherid == "" || $payment->voucherid == "0") {
                  $voucherid = "NO";
                } else {
                  $voucherid = $payment->voucherid;
                }
              ?>
              <td><?= $voucherid ?></td>
            </tr>
            <?php
                }
              }
            ?>
            </tbody>           
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <?php
    }*/
?>