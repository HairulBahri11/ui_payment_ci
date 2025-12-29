<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <img src="<?php echo base_url()?>assets/dist/img/bvr.jpg" width="210">
        </div>
      </form> 
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?php echo base_url()?>assets/dist/img/avatar5.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Aldila Hilman</p>
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
        
        <li class="treeview">
          <a href="#">
            <i class="fa fa-folder-open"></i> <span>Projects</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url() ?>project/addProject"><i class="fa fa-plus"></i> Add Projects</a></li>
            <li><a href="<?= base_url() ?>project"><i class="fa fa-list-ul"></i> List Projects</a></li>
          </ul>
        </li> 

        <li class="treeview active">
          <a href="#">
            <i class="fa fa-user"></i> <span>Master Employee</span>
            <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url() ?>employee/addEmployee"><i class="fa fa-user-plus"></i> Add Employee</a></li>
            <li class="active"><a href="<?= base_url() ?>employee"><i class="fa fa-users"></i> List Employee</a></li>
          </ul>
        </li>

        <li>
          <a href="<?php echo base_url()?>paymentreport">
            <i class="fa fa-list-alt"></i> <span>Payment Report (Open)</span>
          </a>
        </li>

        <li>
          <a href="<?php echo base_url()?>paymentreport/getClosed">
            <i class="fa fa-table"></i> <span>Payment Report (Closed)</span>
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
        Employee
        <small>list all Employees</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Employee</a></li>
        <li class="active">List Employee</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-12">
          <div class="box box-primary">
            <div class="box-header">
              <h3 class="box-title">List Employee</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <div class="table-responsive">
              <table id="example1" class="table table-bordered table-hover">
                <thead>
                <tr>
                  <th>No</th>
                  <th>Employee Name</th>
                  <th>User Email</th>
                  <th>Position</th>
                  <th>Profile Photo</th>  
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                  $i = 1; //nantinya akan digunakan untuk pengisian Nomor
                  foreach ($listEmployee->result() as $row) { 
                ?>
                <tr>
                  <td><?= $i ?></td>
                  <td><?= $row->name ?></td>
                  <td><?= $row->userid ?></td>
                  <td><?= $row->position ?></td>
                  <td><a href="<?= base_url() ?>upload/<?= $row->photo ?>" target="_blank"><i class="fa fa-paperclip">&nbsp;Photo</a></td>  
                  <td>
                    <a href="<?= base_url() ?>employee/updateEmployee/<?= $row->id ?>"><span class="badge bg-green"><i class="glyphicon glyphicon-pencil"></i></span></a>
                    &nbsp;<a data-toggle="modal" data-target="#delModal<?php echo $row->id;?>" href="#"><span class="badge bg-red"><i class="glyphicon glyphicon-trash"></i></span></a>
                  </td>
                </tr>
                <?php
                    $i = $i + 1;
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


  <?php
    foreach ($listEmployee->result() as $row) { 
  ?>
  <div class="modal modal-danger fade" id="delModal<?php echo $row->id;?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Delete Employee</h4>
        </div>
        <div class="modal-body">
          <p>Are you sure to delete <?= $row->name ?>?</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Cancel</button>
          <a href="<?= base_url() ?>employee/deleteEmployeeDb/<?= $row->id ?>"><button type="button" class="btn btn-outline">Delete</button></a>
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