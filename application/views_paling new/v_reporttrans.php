<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <img src="<?php echo base_url()?>assets/dist/img/ui4.jpg" width="210">
        </div>
      </form>
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url()?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
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
          <a href="<?php echo base_url()?>dashboard">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>

        <?php
          if (($this->session->userdata('level')) == 1 || ($this->session->userdata('level') == 3)) {
        ?>
        <li>
          <a href="<?php echo base_url()?>student/register">
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

        <li class="treeview active">
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
          <a href="<?php echo base_url()?>student">
            <i class="fa fa-user"></i> <span>Student</span>
          </a>
        </li>

        <li>
          <a href="<?php echo base_url()?>voucher">
            <i class="fa fa-credit-card"></i> <span>Voucher</span>
          </a>
        </li>

        <li>
          <a href="<?php echo base_url()?>price">
            <i class="fa fa-dollar"></i> <span>Price</span>
          </a>
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
        Transaction Report
        <small>list Transactions</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#">Report</a></li>
        <li class="active">Transaction Report</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">Transaction Report</h3>
            </div>
            <!-- /.box-header -->
			<form role="form" id="example" name="example" class="form-horizontal" action="<?php echo base_url()?>report/showTrans" method="post" enctype="multipart/form-data">
            <div class="box-body">
			  <div class="col-sm-12">
              <div class="row">
                <div class="col-xs-5">
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">Start Date</label>
                    <div class="col-sm-9">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker" name="startdate" id="startdate" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-5">
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-3 control-label">End Date</label>
                    <div class="col-sm-9">
                      <div class="input-group date">
                        <div class="input-group-addon">
                          <i class="fa fa-calendar"></i>
                        </div>
                        <input type="text" class="form-control pull-right" id="datepicker1" name="enddate" id="enddate" required>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-xs-2">
                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<button type="submit" class="btn btn-primary">Search Report</button>
                </div>
              </div>
              <div class="table-responsive">
              <table id="example1" class="table table-bordered table-striped table-hover">
                <thead>
                <tr>
                  <th>Number</th>
                  <th>Date</th>
                  <th>Method</th>
                  <th>Total Pay</th>
                  <th class="notPrintable">Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                if(isset($listTransaction)) {
                  foreach ($listTransaction->result() as $row) {
                ?>
                <tr>
                  <td><?= $row->id ?></td>
                  <?php
                    $var = $row->paydate;
                    $parts = explode('-',$var);
                    $paydate = $parts[2] . '/' . $parts[1] . '/' . $parts[0];
                  ?>
                  <td><?= $paydate ?></td>
                  <td><?= $row->method ?></td>
                  <td>Rp <?= number_format($row->total, 0, ".", ".") ?></td>
                  <td><a data-toggle="modal" data-target="#delModal<?php echo $row->id;?>" href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i></a>
                  <a data-toggle="modal" data-target="#showModal<?php echo $row->id;?>" href="#" class="btn btn-primary btn-xs"><i class="fa fa-file-text-o"></i></a></td>
                </tr>
                <?php
                  }
                }
                ?>
                </tbody>

              </table>
              </div>
            </div>
            <!-- /.box-body -->
			</form>
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

  <?php
  if(isset($listTransaction)) {
    foreach ($listTransaction->result() as $row) {
  ?>
  <div class="modal modal-danger fade" id="delModal<?php echo $row->id;?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Delete Transaction</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure to delete this selected transaction?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancel</button>
          <a href="<?= base_url() ?>report/deletePaymentDb/<?= $row->id ?>"><button type="button" class="btn btn-outline">Delete</button></a>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <?php
    }
  }
  ?>

  <?php
  if(isset($listTransaction)) {
    foreach ($listTransaction->result() as $row) {
  ?>
  <div class="modal modal-default fade" id="showModal<?php echo $row->id;?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Detail Payment List</h4>
        </div>
        <div class="modal-body">
          <table id="examples" class="table table-bordered table-striped table-hover">
            <thead>
            <tr>
              <th>Number</th>
              <th>Name</th>
              <th>Level</th>
              <th>Payment</th>
              <th>Amount</th>
              <th>Voucher</th>
            </tr>
            </thead>
            <tbody>
            <?php
              $payid = 0;
              $program = "";
              foreach ($listDetailPayment->result() as $payment) {
                if ($payment->id == $row->id) {
                  $payid = $payment->id;
                  $program = $payment->program;
            ?>
            <tr>
              <td><?= $payment->id ?></td>
              <td><?= $payment->name ?></td>
              <td><?= $payment->program ?></td>
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
          <a href="<?= base_url() ?>report/printtrans/<?= $payid ?>/<?= $program ?>" target="_blank"><button type="button" class="btn btn-default">Reprint</button></a> 
          <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
  <?php
    }
  }
  ?>
