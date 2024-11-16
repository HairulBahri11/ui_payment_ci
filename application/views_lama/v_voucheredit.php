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
          <a href="<?php echo base_url()?>student">
            <i class="fa fa-user"></i> <span>Student</span>
          </a>
        </li> 

        <li class="active">
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
        Edit Voucher
        <small>edit Voucher Form</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li><a href="#">Voucher</a></li>
        <li class="active">Edit Voucher</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-7">
          <!-- <div class="box"> -->
          <div class="box box-primary">
            <!-- <div class="box-header with-border">
              <h3 class="box-title">Add Price Form</h3>
            </div> -->
            <!-- /.box-header -->
            
            <!-- /.box-header -->
            <!-- form start -->
            <?php
              foreach ($voucher->result() as $voucher) { 
                $voucherid = $voucher->id;
            ?>
            <form role="form" id="example" name="example" class="form-horizontal" action="<?php echo base_url()?>voucher/updateVoucherDb" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="code" class="col-sm-3 control-label">Voucher Code</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="code" name="code" value="<?php echo $voucher->id; ?>" readonly>
                  </div>
                </div>

                <div class="form-group">
                  <label for="program" class="col-sm-3 control-label">Voucher Type</label>
                  <div class="col-sm-9">
                    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $voucher->id; ?>">
                    <select class="form-control select2" style="width: 100%;" name="type" required>
                      <option disabled="disabled" value="">-- Choose Voucher Type --</option>
                      <?php 
                        if($voucher->type == "MGM"){
                      ?>
                        <option selected="selected" value="MGM">(MGM) Member Get Member</option>
                      <?php 
                        }
                      ?>
                      
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label for="level" class="col-sm-3 control-label">Voucher Amount</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="amount" placeholder="Enter Voucher Amount" name="amount" value="Rp <?php echo number_format($voucher->amount, 0, ".", "."); ?>" required>
                  </div>
                </div>
              <!-- /.box-body -->
              
              <div class="box-footer">
                <button type="submit" class="btn btn-primary pull-right">Submit</button>
                <a href="<?= base_url() ?>voucher"><button type="button" class="btn btn-default">Cancel</button></a> 
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
    $(document).ready(function(){
      $("#amount").maskMoney({prefix:'Rp ', thousands:'.', decimal:',',precision:0});
    });
  </script>