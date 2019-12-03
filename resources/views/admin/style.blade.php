 <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap -->

    <link rel="stylesheet" href="{{ asset('/') }}/local/resources/assets/admin/vendors/bootstrap/dist/css/bootstrap.min.css"> 

    <link rel="stylesheet" href="{{ asset('/') }}/local/resources/assets/admin/vendors/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{ asset('/') }}/local/resources/assets/admin/vendors/iCheck/skins/flat/green.css">

    <link rel="stylesheet" href="{{ asset('/') }}/local/resources/assets/admin/vendors/bootstrap-daterangepicker/daterangepicker.css"> 

    <link rel="stylesheet" href="{{ asset('/') }}/local/resources/assets/admin/build/css/custom.min.css"> 

    <link rel="stylesheet" href="{{ asset('/') }}/local/resources/assets/admin/js/dataTables.bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('/') }}/local/resources/assets/admin/js/buttons.bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('/') }}/local/resources/assets/admin/js/fixedHeader.bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('/') }}/local/resources/assets/admin/js/responsive.bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('/') }}/local/resources/assets/admin/js/scroller.bootstrap.min.css">

    <link rel="stylesheet" href="{{ asset('/') }}/local/resources/assets/admin/fontscript/fontselect.css">

    <link rel="stylesheet" href="{{ asset('/') }}/local/resources/assets/admin/fontscript/color.css">

    <link rel="stylesheet" href="{{ asset('/') }}/local/resources/assets/js/tagsinput.css"> 

    <link rel="stylesheet" href="{{ asset('/') }}/local/resources/assets/admin/build/css/jquery-ui-timepicker-addon.css"> 

    <link rel="stylesheet" href="{{ asset('/') }}/local/resources/assets/admin/build/css/jquery-ui.css">


    <link rel="stylesheet" href="{{ asset('/') }}/local/resources/assets/admin/build/css/new_font-awesome.css">


    <link rel="stylesheet" href="{{ asset('/') }}/local/resources/assets/admin/build/css/simple-iconpicker.min.css">
    <link rel="stylesheet" href="{{ asset('/') }}/local/resources/assets/admin/build/css/simple-iconpicker.min.css">

    <script src="{{ asset('/') }}/local/resources/assets/admin/vendors/jquery/dist/jquery.min.js"></script>

    <script src="{{ asset('/') }}/local/resources/assets/admin/js/jquery.geocomplete.js"></script>

     <script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyB6PU-XRqBA-gLGvpD__IPYdGcAT_W-5EA"></script>

    <script src="{{ asset('/') }}/local/resources/assets/admin/build/js/jquery-ui.min.js"></script>

     <script src="{{ asset('/') }}/local/resources/assets/admin/build/js/jquery-ui-timepicker-addon.js"></script>
     
     <script src="{{ asset('/') }}/local/resources/assets/admin/build/js/simple-iconpicker.min.js"></script>


  
<?php $url = URL::to("/"); ?>  

      <script>
    var whichInput = 0;

    $(document).ready(function(){
     
      $('#inputid1').iconpicker("#inputid1");
	  $('#inputid2').iconpicker("#inputid2");
	  $('#inputid3').iconpicker("#inputid3");
	  $('#inputid4').iconpicker("#inputid4");
      
    });
    </script>
      
       <script type="text/javascript">
      
      $(document).ready(function () {
   $('body').on('click', '#selectAll', function () {
      if ($(this).hasClass('allChecked')) {
         $('input[type="checkbox"]', '#datatable-responsive').prop('checked', false);
      } else {
       $('input[type="checkbox"]', '#datatable-responsive').prop('checked', true);
       }
       $(this).toggleClass('allChecked');
     })
});


$(document).ready(function () {
    $('#checkBtn').click(function() {
      checked = $("input[type=checkbox]:checked").length;

      if(!checked) {
        alert("You must check at least one checkbox.");
        return false;
      }

    });
});

</script>


<?php /* text editor */ ?>
<script type="text/javascript">



 
$(document).ready(function () { 
 
 $('#item_script_type').on('change', function() {
		
		if ( this.value == 'code')
      {
		  $("#code_only1").show();
		  $("#code_only2").show();
		  $("#code_only3").show();
		  $("#grapics_only1").hide();
		 
		  
	  }
	  else if(this.value == 'graphics')
      {
		  $("#code_only1").hide();
		  $("#code_only2").hide();
		   $("#code_only3").hide();
		    $("#grapics_only1").show();
		  
	  }
	  
	 
	  
	  else
	  {
	   $("#code_only1").hide();
	   $("#code_only2").hide();
	    $("#code_only3").hide();
		 $("#grapics_only1").hide();
	  
	  }
		
	
	});
	
	
});	

</script>

<link rel="stylesheet" type="text/css" href="<?php echo $url;?>/local/resources/views/editor/style.css" />
		
		<script type="text/javascript" src="<?php echo $url;?>/local/resources/views/editor/cazary.min.js"></script>
		<script type="text/javascript">
(function($, window)
{
	$(function($)
	{
		
		$("textarea#id_cazary_full").cazary({
			commands: "FULL"
		});
	});
})(jQuery, window);
		</script>
      
  
<?php /* text editor */?>

