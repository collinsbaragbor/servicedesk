<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>
<script src="js/sb-admin-2.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.13/js/bootstrap-multiselect.js"></script>
<script src="vendor/datatables/jquery.dataTables.min.js"></script>
<script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.24.1/feather.min.js" crossorigin="anonymous"></script>
<script src="js/demo/datatables-demo.js"></script>
<script>
    function display_c(){
    var refresh=1000;
    mytime=setTimeout('display_ct()',refresh)
    }
    function display_ct() {
        var x = new Date()
        var x1=x.toUTCString();
        document.getElementById('ct').innerHTML = x1;
        tt=display_c();
    }
    $(document).ready(function () {
        $('#dataTable').DataTable({
            order: [[0, 'desc']],
            "bDestroy":true,
        });
    });
</script>
<script>
    $(document).ready(function(){
        var date_input=$('input[id="date"]');
        var container=$('.bootstrap-iso form').length>0 ? $('.bootstrap-iso form').parent() : "body";
        date_input.datepicker({
            format: 'mm/dd/yyyy',
            container: container,
            todayHighlight: true,
            autoclose: true,
        })
    })
</script>

