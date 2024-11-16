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
            <li><a href="<?= base_url() ?>payment/addother"><i class="fa fa-circle-o"></i> <span>Other Payment</span></a></li>
            <li class="active"><a href="<?= base_url() ?>expense/addexpense"><i class="fa fa-circle-o"></i> <span>Expense</span></a></li>
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
        Expense
        <small>expense Form</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
        <li class="active">Expense</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-xs-7">
          <!-- <div class="box"> -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Form Expense</h3>
             </div>
            
            <!-- form start -->
            <form role="form" id="example" name="example" class="form-horizontal" action="<?php echo base_url()?>expense/addExpenseDb" method="post" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="inputPassword3" class="col-sm-3 control-label">Date</label>
                  <div class="col-sm-9">
                    <div class="input-group date">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                      <input type="text" class="form-control pull-right" id="datepicker" name="expdate" id="expdate">
                    </div>
                  </div>
                </div>  

                <div class="form-group">
                  <label for="category" class="col-sm-3 control-label">Category</label>
                  <div class="col-sm-9">
                  <select class="form-control select2" style="width: 100%;" name="category" id="category" onchange="changeCategory()" required>
                      <option selected="selected" disabled="disabled" value="">-- Choose Category --</option>
                      <option value="OFFICE NEEDS">Office Needs</option>
                      <option value="SALARY">Salary</option>
                      <option value="SOUVENIR">Souvenir</option>
                      <option value="DENPASAR">Denpasar</option>
                      <option value="OTHER">Other</option>
                  </select>
                  </div>
                </div>
                  
                <div class="form-group" id="divother" style="display: none">
                  <label for="other" class="col-sm-3 control-label">Expense Other</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="other" name="other">
                  </div>
                </div>

                <div class="form-group">
                  <label for="explanation" class="col-sm-3 control-label">Explanation</label>
                  <div class="col-sm-9">
                    <textarea class="form-control" rows="3" id="explanation" name="explanation"></textarea>
                  </div>
                </div>
                  
                <div class="form-group">
                  <label for="registration" class="col-sm-3 control-label">Amount</label>
                  <div class="col-sm-9">
                    <input type="text" class="form-control" id="amount" name="amount">
                  </div>
                </div>

                <div class="form-group">
                  <label for="registration" class="col-sm-3 control-label"></label>
                  <div class="col-sm-9">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <a href="<?= base_url() ?>expense/addexpense"><button type="button" class="btn btn-warning">Clear</button></a> 
                  </div>
                </div>

                <div class="form-group">
                  <div class="col-sm-12">
                    <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                      <thead>
                      <tr>
                        <th>Date</th>
                        <th>Category</th>
                        <th>Explanation</th>
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

                <form role="form" id="example3" name="example" class="form-horizontal" action="<?php echo base_url()?>expense/addExpenseDb" method="post" enctype="multipart/form-data">
                  <div class="form-group">
                    <label for="registration" class="col-sm-3 control-label"></label>
                    <div class="col-sm-9">
                      <button type="button" class="btn btn-primary">Submit</button>
                      <a href="<?= base_url() ?>expense/addexpense"><button type="button" class="btn btn-danger">Cancel</button></a> 
                    </div>
                  </div>
                </form>

              </div>
              <!-- /.box-body -->
              
              <!-- <div class="box-footer">
                
              </div> -->
              <!-- /.box-footer -->
            </form>
    
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

      document.getElementById("amount").value = 0;
      document.getElementById("amount").value = "Rp " + FormatDuit(document.getElementById("amount").value);
    });

    function changeCategory() {
      if (document.getElementById("category").value == "OTHER") {
        $("#divother").show(750);
      } else {
        $("#divother").hide(750);
      }
    }

    $('#example').on('keyup keypress', function(e) {
      var keyCode = e.keyCode || e.which;
      if (keyCode === 13) { 
        e.preventDefault();
        return false;
      }
    });

    function FormatDuit(x) {
      var tmp_num;
      var negatif = false;
      if(x<0) {
          negatif = true;
          tmp_num = Math.abs(x);
      } else {
          tmp_num = x;
      }

      var num = tmp_num.toString();
      for(var i=0; i < Math.floor((num.length-(1+i))/3); i++)
        num=num.substring(0,num.length-(4*i+3)) + '.' + num.substring(num.length-(4*i+3));
      if(negatif) { num = '-'+num; }
      return(num);
    }

  </script>