<input type="button" name="" value="Print" onclick="Printdata()">
<script type="text/javascript">
  function Printdata() {
    my_window = window.open("http://serverku.dlinkddns.com/u&i/fpdf/struk.php","mywindow","status=1,width=0,height=10");    
    setTimeout(function() {
      my_window.close ();
    },10000);
  }
</script>
