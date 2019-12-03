 <!-- footer content -->
        <footer>
          <div class="pull-right">
            Copyright &copy; <?php echo date('Y');?> 
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
		
	
	<!-- jQuery -->
    
   
	<!-- Bootstrap -->
    <script src="{{ asset('/') }}/local/resources/assets/admin/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <!-- FastClick -->
    <script src="{{ asset('/') }}/local/resources/assets/admin/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="{{ asset('/') }}/local/resources/assets/admin/vendors/nprogress/nprogress.js"></script>
    <!-- Chart.js -->
   
    <script src="{{ asset('/') }}/local/resources/assets/admin/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- gauge.js -->
    <script src="{{ asset('/') }}/local/resources/assets/admin/vendors/gauge.js/dist/gauge.min.js"></script>
    <!-- bootstrap-progressbar -->
    <script src="{{ asset('/') }}/local/resources/assets/admin/vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
    <!-- iCheck -->
     <script src="{{ asset('/') }}/local/resources/assets/admin/vendors/iCheck/icheck.min.js"></script>
    <!-- Skycons -->
     <script src="{{ asset('/') }}/local/resources/assets/admin/vendors/skycons/skycons.js"></script>
    <!-- Flot -->
    
     <script src="{{ asset('/') }}/local/resources/assets/admin/vendors/Flot/jquery.flot.js"></script>
     <script src="{{ asset('/') }}/local/resources/assets/admin/vendors/Flot/jquery.flot.pie.js"></script>
     <script src="{{ asset('/') }}/local/resources/assets/admin/vendors/Flot/jquery.flot.time.js"></script>
     <script src="{{ asset('/') }}/local/resources/assets/admin/vendors/Flot/jquery.flot.stack.js"></script>
     <script src="{{ asset('/') }}/local/resources/assets/admin/vendors/Flot/jquery.flot.resize.js"></script>
    
    <!-- Flot plugins -->
    <script src="{{ asset('/') }}/local/resources/assets/admin/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>

   <script src="{{ asset('/') }}/local/resources/assets/admin/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>

   <script src="{{ asset('/') }}/local/resources/assets/admin/vendors/flot.curvedlines/curvedLines.js"></script>
    
    <!-- DateJS -->
     <script src="{{ asset('/') }}/local/resources/assets/admin/vendors/DateJS/build/date.js"></script>
    <!-- JQVMap -->
    <script src="{{ asset('/') }}/local/resources/assets/admin/vendors/jqvmap/dist/jquery.vmap.js"></script>
    <script src="{{ asset('/') }}/local/resources/assets/admin/vendors/jqvmap/dist/maps/jquery.vmap.world.js"></script>

    <script src="{{ asset('/') }}/local/resources/assets/admin/vendors/jqvmap/examples/js/jquery.vmap.sampledata.js"></script>
   
    <!-- bootstrap-daterangepicker -->
     <script src="{{ asset('/') }}/local/resources/assets/admin/vendors/moment/min/moment.min.js"></script>
     <script src="{{ asset('/') }}/local/resources/assets/admin/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Custom Theme Scripts -->
	
    <script src="{{ asset('/') }}/local/resources/assets/admin/build/js/custom.min.js"></script> 
    <script src="{{ asset('/') }}/local/resources/assets/admin/js/jquery.dataTables.min.js"></script>

    <script src="{{ asset('/') }}/local/resources/assets/admin/js/dataTables.bootstrap.min.js"></script>

    <script src="{{ asset('/') }}/local/resources/assets/admin/js/validator.js"></script>
    <script src="{{ asset('/') }}/local/resources/assets/admin/js/canvasjs.min.js"></script>

    <script src="{{ asset('/') }}/local/resources/assets/admin/js/custom.js"></script>
    <script src="{{ asset('/') }}/local/resources/assets/js/tagsinput.js"></script>
    <script src="{{ asset('/') }}/local/resources/assets/admin/fontscript/jquery.fontselect.js"></script> 

    <script src="{{ asset('/') }}/local/resources/assets/admin/fontscript/color.js"></script>
     
     
     
     <script type="text/javascript">
	$("#select_all").change(function(){  //"select all" change 
    $(".checkboxy").prop('checked', $(this).prop("checked")); //change all ".checkboxy" checked status
});

//".checkboxy" change 
$('.checkboxy').change(function(){ 
    //uncheck "select all", if one of the listed checkbox item is unchecked
    if(false == $(this).prop("checked")){ //if this item is unchecked
        $("#select_all").prop('checked', false); //change "select all" checked status to false
    }
    //check "select all" if all checkbox items are checked
    if ($('.checkboxy:checked').length == $('.checkboxy').length ){
        $("#select_all").prop('checked', true);
    }
});


</script>
     
     
     