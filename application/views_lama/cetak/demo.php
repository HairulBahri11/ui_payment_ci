<input type="button" name="" value="Print" onclick="Printdata()">
<script type="text/javascript">
  function Printdata() {
    my_window = window.open("http://serverku.dlinkddns.com:8080/u&i/struk/struk.php","mywindow","status=1,width=0,height=500");
    setTimeout(function() {
      my_window.close ();
    },20000);
  }
</script>
