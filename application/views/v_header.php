<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>U&I | Payment System</title>
  <link rel="icon" type="image/jpg" href="<?php echo base_url() ?>assets/dist/img/ui4.jpg" />
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables/dataTables.bootstrap.css">
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/datatables/buttons.dataTables.css">
  <!-- bootstrap slider -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/plugins/bootstrap-slider/slider.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets//plugins/iCheck/all.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/select2/dist/css/select2.min.css">
  <!-- bootstrap tagsinput -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?php echo base_url() ?>assets/dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


  <script src="<?php echo base_url() ?>assets/bower_components/jquery/dist/jquery.min.js"></script>

</head>

<body class="hold-transition skin-blue-light sidebar-mini">
  <div class="wrapper">

    <header class="main-header">
      <!-- Logo -->
      <a href="<?php echo base_url() ?>dashboard" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>U</b>&I</span>
        <!-- logo for regular state and mobile devices -->
        <span style="font-family:Arial;" class="logo-lg"><b>U&I Payment</b>System</a></span>
      </a>
      <!-- Header Navbar: style can be found in header.less -->
      <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </a>

        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">

            <!-- User Account: style can be found in dropdown.less -->
            <li class="dropdown user user-menu">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?php echo base_url() ?>assets/dist/img/avatar5.png" class="user-image" alt="User Image">
                <span class="hidden-xs"><?= $this->session->userdata('nama') ?></span>
              </a>
              <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                  <img src="<?php echo base_url() ?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">

                  <p>
                    <?= $this->session->userdata('nama') ?>
                    <!-- - <?= $this->session->userdata('status') ?> -->
                    <small>User Level - <?= $this->session->userdata('position') ?></small>
                  </p>
                </li>
                <!-- Menu Body -->
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="<?= base_url() ?>user/profile" class="btn btn-default btn-flat">Profile</a>
                  </div>
                  <div class="pull-right">
                    <a href="<?= base_url() ?>login/logout" class="btn btn-default btn-flat">Sign out</a>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
    </header>
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
          <li class="<?= $this->uri->segment(1) == 'dashboard' ? 'active' : '' ?>">
            <a href="<?= base_url() ?>dashboard">
              <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            </a>
          </li>

          <?php if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 3) { ?>
            <li class="<?= $this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'register' ? 'active' : '' ?>">
              <a href="<?= base_url() ?>student/register">
                <i class="fa fa-edit"></i> <span>Register</span>
              </a>
            </li>

            <li class="treeview <?= $this->uri->segment(1) == 'payment' ? 'active menu-open' : '' ?>">
              <a href="#">
                <i class="fa fa-money"></i> <span>Payment</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?= $this->uri->segment(2) == 'addprivate' ? 'active' : '' ?>">
                  <a href="<?= base_url() ?>payment/addprivate"><i class="fa fa-circle-o"></i> <span>Private Payment</span></a>
                </li>
                <li class="<?= $this->uri->segment(2) == 'addregular' ? 'active' : '' ?>">
                  <a href="<?= base_url() ?>payment/addregular"><i class="fa fa-circle-o"></i> <span>Regular Payment</span></a>
                </li>
                <li class="<?= $this->uri->segment(2) == 'addexpense' ? 'active' : '' ?>">
                  <a href="<?= base_url() ?>expense/addexpense"><i class="fa fa-circle-o"></i> <span>Expense</span></a>
                </li>
              </ul>
            </li>
          <?php } ?>
          
          
          <li class="<?= $this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'latepayment' ? 'active' : '' ?>">
            <a href="<?= base_url() ?>student/latepayment">
              <i class="fa fa-money"></i> <span>Late Payment</span>
            </a>
          </li>

          <li class="treeview <?= $this->uri->segment(1) == 'report' ? 'active menu-open' : '' ?>">
            <a href="#">
              <i class="fa fa-file-text-o"></i> <span>Report</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <?php if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 2) { ?>
                <li class="<?= $this->uri->segment(2) == 'showexpense' ? 'active' : '' ?>">
                  <a href="<?= base_url() ?>report/showexpense"><i class="fa fa-circle-o"></i> <span>Expense Report</span></a>
                </li>
              <?php } ?>
              <li class="<?= $this->uri->segment(2) == 'showlate' ? 'active' : '' ?>">
                <a href="<?= base_url() ?>report/showlate"><i class="fa fa-circle-o"></i> <span>Late Payments</span></a>
              </li>
              <?php if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 2) { ?>
                <li class="<?= $this->uri->segment(2) == 'showgeneral' ? 'active' : '' ?>">
                  <a href="<?= base_url() ?>report/showgeneral"><i class="fa fa-circle-o"></i> <span>General</span></a>
                </li>
                <li class="<?= $this->uri->segment(2) == 'showdetail' ? 'active' : '' ?>">
                  <a href="<?= base_url() ?>report/showdetail"><i class="fa fa-circle-o"></i> <span>Detail</span></a>
                </li>
              <?php } ?>
              <li class="<?= $this->uri->segment(2) == 'showtrans' ? 'active' : '' ?>">
                <a href="<?= base_url() ?>report/showtrans"><i class="fa fa-circle-o"></i> <span>Transaction</span></a>
              </li>
            </ul>
          </li>

          <?php if ($this->session->userdata('level') == 1) { ?>
            <li class="<?= $this->uri->segment(1) == 'user' ? 'active' : '' ?>">
              <a href="<?= base_url() ?>user">
                <i class="fa fa-user"></i> <span>Employee</span>
              </a>
            </li>
          <?php } ?>

          <li class="<?= $this->uri->segment(1) == 'student' && $this->uri->segment(2) == '' ? 'active' : '' ?>">
            <a href="<?= base_url() ?>student">
              <i class="fa fa-user"></i> <span>Student</span>
            </a>
          </li>

           <?php if ($this->session->userdata('level') == 1 || $this->session->userdata('level') == 2) { ?>
           <li class="<?= $this->uri->segment(1) == 'PlacementDate' ? 'active' : '' ?>">
            <a href="<?= base_url() ?>PlacementDate/">
              <i class="fa fa-calendar-check-o"></i> <span>Placement Test Date</span>
            </a>
          </li>
          <?php } ?>

          <li class="<?= $this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'studentOnline' ? 'active' : '' ?>">
            <a href="<?= base_url() ?>student/studentOnline">
              <i class="fa fa-users"></i> <span>Prospective Student</span>
            </a>
          </li>

          <li class="<?= $this->uri->segment(1) == 'teacher' ? 'active' : '' ?>">
            <a href="<?= base_url() ?>teacher">
              <i class="fa fa-users"></i> <span>Teacher</span>
            </a>
          </li>

          <!-- <li class="treeview <?= $this->uri->segment(1) == 'billing' ? 'active menu-open' : '' ?>">
            <a href="#">
              <i class="fa fa-money"></i> <span>Payment Bills</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?= $this->uri->segment(2) == 'data' ? 'active' : '' ?>">
                <a href="<?= base_url() ?>billing/data"><i class="fa fa-circle-o"></i> <span>Billing Data</span></a>
              </li>
              <li class="<?= $this->uri->segment(2) == 'addRegularBill' ? 'active' : '' ?>">
                <a href="<?= base_url() ?>billing/addRegularBill"><i class="fa fa-circle-o"></i> <span>Regular Billing Payment</span></a>
              </li>
              <li class="<?= $this->uri->segment(2) == 'removePenaltyBill' ? 'active' : '' ?>">
                <a href="<?= base_url() ?>billing/removePenaltyBill"><i class="fa fa-circle-o"></i> <span>Remove Penalty</span></a>
              </li>
            </ul>
          </li> -->

          <li class="<?= $this->uri->segment(1) == 'student' && $this->uri->segment(2) == 'student_review' ? 'active' : '' ?>">
            <a href="<?= base_url() ?>student/student_review">
              <i class="fa fa-file"></i> <span>Student Review</span>
            </a>
          </li>
          <?php if ($this->session->userdata('level') == 1) { ?>
            <li class="treeview <?= $this->uri->segment(1) == 'accounting' ? 'active menu-open' : '' ?>">
              <a href="#">
                <i class="fa fa-tag"></i> <span>Accounting</span>
                <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
              </a>
              <ul class="treeview-menu">
                <li class="<?= $this->uri->segment(2) == 'journal' ? 'active' : '' ?>">
                  <a href="<?= base_url() ?>accounting/journal"><i class="fa fa-circle-o"></i> <span>Journal</span></a>
                </li>
                <li class="<?= $this->uri->segment(2) == 'profit_loss' ? 'active' : '' ?>">
                  <a href="<?= base_url() ?>accounting/profit_loss"><i class="fa fa-circle-o"></i> <span>Profit & Loss</span></a>
                </li>
              </ul>
            </li>
          <?php } ?>
        </ul>

      </section>
      <!-- /.sidebar -->
    </aside>