<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> v.0.1
    </div>
    <strong>Copyright &copy; 2017-2018 <a href="http://coedigoe.co.id/">Coedigoe</a>.</strong> All rights
    reserved.
  </footer>

  
</div>
<!-- ./wrapper -->

<!-- <script>
	document.body.style.zoom = "110%";
</script> -->

<!-- jQuery 3 -->
<script src="<?php echo base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?php echo base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url()?>assets/bower_components/Chart.js/Chart.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url()?>assets/bower_components/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/datatables/dataTables.bootstrap.min.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/datatables/dataTables.buttons.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/datatables/buttons.flash.min.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/datatables/jszip.min.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/datatables/vfs_fonts.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/datatables/buttons.html5.min.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/datatables/buttons.colVis.min.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/datatables/buttons.print.min.js"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url()?>assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?php echo base_url()?>assets/bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()?>assets/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()?>assets/dist/js/demo.js"></script>
<!-- Bootstrap slider -->
<script src="<?php echo base_url()?>assets/plugins/bootstrap-slider/bootstrap-slider.js"></script>
<!-- bootstrap datepicker -->
<script src="<?php echo base_url()?>assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url()?>assets/bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url()?>assets/bower_components/jquery-maskmoney/dist/jquery.maskMoney.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/jquery-maskmoney/dist/jquery.maskMoney.min.js"></script>
<!-- bootstrap tagsinput -->
<script src="<?php echo base_url()?>assets/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
<script src="<?php echo base_url()?>assets/bower_components/bootstrap-tagsinput/dist/bootstrap-tagsinput.js"></script>
<!-- iCheck 1.0.1 -->
<script src="<?php echo base_url()?>assets/plugins/iCheck/icheck.min.js"></script>
<!-- page script -->
<script>
  $(function () {
    $('.select2').select2()
  })

  $(function () {
    $('#example2').DataTable()
  })

  $(function () {
    $('#example5').DataTable()
  })
  
  $(function () {
    $("#example1").DataTable({
        dom: 'Bfrtip',
        "aaSorting": [],
        buttons: [
          {
            extend: 'excel', 
            exportOptions:{
              columns: ':not(.notPrintable)'
            }
          },
          {
            extend: 'print', 
            exportOptions:{
              columns: ':not(.notPrintable)'
            }
          },
          {
            extend: 'copy', 
            exportOptions:{
              columns: ':not(.notPrintable)'
            }
          }
        ]
    });

    var y = document.getElementsByClassName("buttons-excel");
    y[0].classList.add('btn');
    y[0].classList.add('btn-success');
    var z = document.getElementsByClassName("buttons-print");
    z[0].classList.add('btn');
    z[0].classList.add('btn-primary');
    var b = document.getElementsByClassName("buttons-copy");
    b[0].classList.add('btn');
    b[0].classList.add('btn-warning');
  });

  $(function () {
    /* BOOTSTRAP SLIDER */
    $('.slider').slider()
  })

  //Date picker
    $('#datepicker').datepicker({
      autoclose: true
    })
    //Date picker
    $('#datepicker1').datepicker({
      autoclose: true
    })
    //Date picker
    $('#datepicker2').datepicker({
      autoclose: true
    })
    //Date picker
    $('#datepicker3').datepicker({
      autoclose: true
    })

    //iCheck for checkbox and radio inputs
    $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
      checkboxClass: 'icheckbox_minimal-blue',
      radioClass   : 'iradio_minimal-blue'
    })
</script>
</body>
</html>