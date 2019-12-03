<?php
/*
Theme Name: CodePopular
Theme URI: http://codepopular.com
Author: codepopular
Author URI: http://codepopular.com
Description: CodePopular is a Freelancing Marketplace
Version: 6.0
*/
?>
 <?php 
 use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();
 $url = URL::to("/"); 

  $setts = DB::table('settings')->where('id',1)->get();

		
		
		$name = Route::currentRouteName();
 if($currentPaths=="/")
 {
	 $pagetitle="Home";
	 $activemenu = "/";
 }
 else 
 {
	 $pagetitle=$currentPaths;
	 $activemenu = $currentPaths;
 }
 
 ?>

<?php 

$sett_meta_google = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 3)
				->where('sett_meta_key', '=' , "site_google_analytics")
		        
				->count();
				
			if(!empty($sett_meta_google))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 3)
				->where('sett_meta_key', '=' , "site_google_analytics")
		        
				->get();
			$sett_google = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_google = "";
			}
function translate($id,$lang) 
{					
	if($lang == "en")
	{
	$translate = DB::table('codepopular_translates')
		            
					->where('lang_code', '=', $lang)
					->where('id', '=', $id)
					->get();
					
		$translate_cnt = DB::table('codepopular_translates')
		            
					->where('lang_code', '=', $lang)
					->where('id', '=', $id)
					->count();			
	}
	else
	{
	$translate = DB::table('codepopular_translates')
		            
					->where('lang_code', '=', $lang)
					->where('parent', '=', $id)
					->get();
					
		$translate_cnt = DB::table('codepopular_translates')
		            
					->where('lang_code', '=', $lang)
					->where('parent', '=', $id)
					->count();			
	}				
	if(!empty($translate_cnt))
	{
					return $translate[0]->name;
	}
	else
	{
	  return "";
	}
}
			?>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no">
   <meta name="csrf-token" content="{{ csrf_token() }}">
	 <!-- css stylesheets -->
	 <?php if(!empty($setts[0]->site_favicon)){?>
	 <link rel="icon" type="image/x-icon" href="<?php echo $url.'/local/images/media/settings/'.$setts[0]->site_favicon;?>" />
	 <?php } else { ?>
	 <link rel="icon" type="image/x-icon" href="<?php echo $url.'/local/images/noimage.jpg';?>" />
	 <?php } ?>
	
     <meta name="description" content="<?php echo $setts[0]->site_desc;?>">
     <meta name="keywords" content="<?php echo $setts[0]->site_keyword;?>">
     <meta name="author" content="<?php echo $setts[0]->site_name;?>">
     
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,500,700" rel="stylesheet">


  <link rel="stylesheet" href="<?php echo $url;?>/local/resources/views/theme/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?php echo $url;?>/local/resources/views/theme/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo $url;?>/local/resources/views/theme/css/mmenu-light.css">
    
    <link rel="stylesheet" href="<?php echo $url;?>/local/resources/views/theme/css/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo $url;?>/local/resources/views/theme/css/responsive.css">
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->

      <?php if(!empty($sett_google)){ ?> 
      <script type="text/javascript">
      <?php 
      echo html_entity_decode($sett_google); 
	  ?>
	  </script>
	  <?php } ?> 
    
    
  <script src="<?php echo $url;?>/local/resources/views/theme/js/jquery.min.js"></script>       
        
    
<link rel="stylesheet" href="<?php echo $url;?>/local/resources/views/theme/css/validationEngine.jquery.css" type="text/css"/>
<?php /*********** Loader *******/?>

    


 <script type="text/javascript">
$(window).load(function() {
    $(".loader").fadeOut("slow");
});





$(document).ready(function() {
        
   /* activate the carousel */
   $("#modal-carousel").carousel({interval:false});

   /* change modal title when slide changes */
   $("#modal-carousel").on("slid.bs.carousel",       
   function () {
        $(".modal-title")
        .html($(this)
        .find(".active img")
        .attr("title"));
   });

   /* when clicking a thumbnail */
   $(".row .thumbnail").click(function(){
    var content = $(".carousel-inner");
    var title = $(".modal-title");
  
    content.empty();  
    title.empty();
  
  	var id = this.id;  
     var repo = $("#img-repo .item");
     var repoCopy = repo.filter("#" + id).clone();
     var active = repoCopy.first();
  
    active.addClass("active");
    title.html(active.find("img").attr("title"));
  	content.append(repoCopy);

    // show the modal
  	$("#modal-gallery").modal("show");
  });

});
</script>

<script src='https://www.google.com/recaptcha/api.js'></script>

<?php /********* End Loader********/ ?>



<?php /* search */ ?>

<script src="<?php echo $url;?>/local/resources/views/theme/sort/jplist.core.min.js"></script>
		
		
<script src="<?php echo $url;?>/local/resources/views/theme/sort/jplist.sort-bundle.min.js"></script>
        
 <script src="<?php echo $url;?>/local/resources/views/theme/sort/jplist.textbox-filter.min.js"></script>
	
<script src="<?php echo $url;?>/local/resources/views/theme/sort/jplist.filter-toggle-bundle.min.js"></script>
    
		
		<script>
		$('document').ready(function(){
		
			$('#demo').jplist({				
				itemsBox: '.list' 
				,itemPath: '.list-item' 
				,panelPath: '.jplist-panel'	
				//,debug: true
			});
			
			$('#demo').jplist({				
				itemsBox: '.list1' 
				,itemPath: '.list-item1' 
				,panelPath: '.jplist-panel'	
				//,debug: true
			});
			
			
			$('#demo').jplist({				
				itemsBox: '.list2' 
				,itemPath: '.list-item2' 
				,panelPath: '.jplist-panel'	
				//,debug: true
			});
			
			
			
			$('#demo').jplist({				
				itemsBox: '.list3' 
				,itemPath: '.list-item3' 
				,panelPath: '.jplist-panel'	
				//,debug: true
			});
			
			
		});
		
		
	</script>
    
<!--tooltip -->

<!--  social share -->

<script src="<?php echo $url;?>/local/resources/views/theme/js/jquery.social.min.js"></script>

<!-- social share -->
<script src="<?php echo $url;?>/local/resources/views/theme/share/jquery.simpleSocialShare.min.js"></script>

 <style type="text/css">


@media (max-width: 768px) { 
.single-promo
{
min-height:180px;
}
#quote-carousel .carousel-indicators
{
display:none;
}



.col-md-2.ntip_trigger_new
{
    float: left;
    margin-bottom: 10px;
	padding-left: 5px;
    padding-right: 5px;
}
.col-md-2.ntip_trigger_new img
{
width:70px;
height: 70px;
    object-fit: cover;
}
.mbers img
{
	width:105px !important;
	height:105px !important;
	object-fit: cover;
	min-width:105px !important;
}

}

body
{
direction:ltr;
text-align:left !important;

}
.owl-carousel,
.bx-wrapper { direction: ltr !important; }
.owl-carousel .owl-item { direction: ltr !important; }



<?php if($activemenu != "/"){?>

.carousel-control.left,.carousel-control.right{
  background-image:none;
  
  width:5%;
  
  position: absolute;
  
  top: 50%;
  font-size:30px;
 
  
}

<?php } ?>


.ntip {
	color: #fff;
	background:#051F39;
	display:none; /*--Hides by default--*/
	width:450px;
	height:320px;
	position:absolute;	z-index:1000;
	-webkit-border-radius: 3px;
	-moz-border-radius: 3px;
	border-radius: 3px;
	padding:0px 20px;
}
.ntip img
{
    max-width:450px;
    height: 240px;
    object-fit: cover;
	margin-top:20px;
	width:100%;

}

.ntip .titleitem
{
	text-align:left;
	color:#FFFFFF;
	font-size:16px;
	font-weight:bold;
	margin-top:5px;
	white-space: nowrap;
	overflow:hidden;
	text-overflow: ellipsis;
}
.ntip .currrency
{
	text-align:right;
	color:#FFFFFF;
	font-size:20px;
	font-weight:bold;
	margin-top:10px;
}

.ntip .authorr 
{
	color:#fff;
	font-size:11px;
	text-align:left !important;
}

.ntip .authorr_right 
{
color:#fff;
font-size:11px;
text-align:right !important;
}

@media(max-width:768px){
	.ntip {
	display: none !important;
}

}


</style>


<script type="text/javascript">

$(document).ready(function() {
	//Tooltips
	$(".ntip_trigger").hover(function(){
		tip = $(this).find('.ntip');
		tip.show(); //Show tooltip
	}, function() {
		tip.hide(); //Hide tooltip		  
	}).mousemove(function(e) {
		var mousex = e.pageX + 10; //Get X coodrinates
		var mousey = e.pageY + 10; //Get Y coordinates
		var tipWidth = tip.width(); //Find width of tooltip
		var tipHeight = tip.height(); //Find height of tooltip
		
		//Distance of element from the right edge of viewport
		var tipVisX = $(window).width() - (mousex + tipWidth);
		//Distance of element from the bottom of viewport
		var tipVisY = $(window).height() - (mousey + tipHeight);
		  
		if ( tipVisX < 10 ) { //If tooltip exceeds the X coordinate of viewport
			mousex = e.pageX - tipWidth - 10;
		} if ( tipVisY < 10 ) { //If tooltip exceeds the Y coordinate of viewport
			mousey = e.pageY - tipHeight - 10;
		} 
		tip.css({  top: mousey + 'px', left: mousex + 'px' });
	});
	
	
	
	
	
	
	
});


</script>

<!-- tooltip -->
   
   
    
<script type="text/javascript">
$(function() {
$("#btnclick").click(function() {
var searchv = document.getElementById("searchtext").value; 
if(searchv!="")
{
var url = '<?php echo $url;?>/search/search/'+searchv;
$(location).attr('href', url);
}
else
{
$(location).attr('href', '<?php echo $url;?>/search');
}

})
});



function valueChanged()
{


    if($('.enable_ship').is(":checked"))   
        $(".ship_details").show();
    else
        $(".ship_details").hide();
}
</script>
    

      
 <link rel="stylesheet" href="<?php echo $url;?>/local/resources/views/theme/css/jquery-ui.css" />

<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
 
<script src="<?php echo $url;?>/local/resources/views/theme/js/jquery-ui.js"></script>

<!--**********   search  ********-->
<!-- ******** pagination *****  -->
    <script type="text/javascript" src="<?php echo $url;?>/local/resources/views/theme/pagination/cPager.js"></script>

<!--    pagination /-->


<?php /* text editor */ ?>
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
     
      
  
<?php /* text editor */?>




<style type="text/css">

/* 
 $setts[0]->site_primary_color
 $setts[0]->site_link_color
 $setts[0]->site_secondary_color
 $setts[0]->site_button_color
*/

:root {
  --site-link-color:{{$setts[0]->site_link_color}};
  --site-primary-color:{{$setts[0]->site_primary_color}};

    /* header */
  --header-top-bg:{{$setts[0]->site_primary_color}};
  --header-top-color:{{$setts[0]->site_primary_color}};
   /*  mainmenu */
  --main-menu-bg:#fff;
  --main-menu-tcolor:#000;
   /*widget*/
  --footer-top_bg:{{$setts[0]->site_secondary_color}};
  --footer-top_tcolor: #DCDCDC;

  /*footer*/
  --footer-bg-color:{{$setts[0]->site_primary_color}};
  --footer-text-color:#DCDCDC;


  --site-secondary-color:{{$setts[0]->site_secondary_color}};
  --site-button-color:{{$setts[0]->site_button_color}};


}



@font-face {
  font-family: 'm_bold';
  src: url('<?php echo $url;?>/local/resources/views/theme/fonts/Montserrat-Bold.eot?#iefix') format('embedded-opentype'),  url('<?php echo $url;?>/local/resources/views/theme/fonts/Montserrat-Bold.woff') format('woff'), url('<?php echo $url;?>/local/resources/views/theme/fonts/Montserrat-Bold.ttf')  format('truetype'), url('<?php echo $url;?>/local/resources/views/theme/fonts/Montserrat-Bold.svg#Montserrat-Bold') format('svg');
  font-weight: normal;
  font-style: normal;
}




@font-face {
  font-family: 'm_regular';
  src: url('<?php echo $url;?>/local/resources/views/theme/fonts/Montserrat-Regular.eot?#iefix') format('embedded-opentype'),  url('<?php echo $url;?>/local/resources/views/theme/fonts/Montserrat-Regular.woff') format('woff'), url('<?php echo $url;?>/local/resources/views/theme/fonts/Montserrat-Regular.ttf')  format('truetype'), url('<?php echo $url;?>/local/resources/views/theme/fonts/Montserrat-Regular.svg#Montserrat-Regular') format('svg');
  font-weight: normal;
  font-style: normal;
}




@font-face {
  font-family: 'm_light';
  src: url('<?php echo $url;?>/local/resources/views/theme/fonts/Montserrat-Light.eot?#iefix') format('embedded-opentype'),  url('<?php echo $url;?>/local/resources/views/theme/fonts/Montserrat-Light.woff') format('woff'), url('<?php echo $url;?>/local/resources/views/theme/fonts/Montserrat-Light.ttf')  format('truetype'), url('<?php echo $url;?>/local/resources/views/theme/fonts/Montserrat-Light.svg#Montserrat-Light') format('svg');
  font-weight: normal;
  font-style: normal;
}

	</style>    
<link rel="stylesheet" href="<?php echo $url;?>/local/resources/views/theme/css/style.css">
