<?php
use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();	
$url = URL::to("/");
$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
$default = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }			
$check_local_name = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 98)
				->where('sett_meta_key', '=' , "bank_details")
		        
				->count();
		if(!empty($check_local_name))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 98)
				->where('sett_meta_key', '=' , "bank_details")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 98)
				->where('sett_meta_key', '=' , "bank_details")
		        
				->get();
			$bank_details = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$bank_details = "";
			}	
		}
		else
		{
		  $bank_details = "";
		}	
?>
<!DOCTYPE html>
<html lang="en">
<head>

    

   @include('style')
	<title><?php echo translate( 25, $lang);?> - <?php echo translate( 1227, $lang);?></title>




</head>
<body class="index">

    

    <!-- fixed navigation bar -->
    @include('header')

    
    <div class="promo-area" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $setts[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="promo-text">
                        <h2 class="avigher-title bolder fontsize30"><?php echo translate( 1227, $lang);?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>



 <div class="about-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo $url;?>"><?php echo translate( 40, $lang);?></a>
                        </li>
                        <li class="breadcrumb-item active"><?php echo translate( 1227, $lang);?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    

	<main class="checkout-area main-content">
<div class="clearfix height20"></div>
        <div class="container">

<div class="row">
@if(Session::has('success'))

	    <div class="alert alert-success">

	      {{ Session::get('success') }}

	    </div>

	@endif


	
	
 	@if(Session::has('error'))

	    <div class="alert alert-danger">

	      {{ Session::get('error') }}

	    </div>

	@endif


</div>



    <div class="row">
	
	
	
	
	 <div class="text-center">   
	<div class="clearfix height30"></div>
	<div class="h4 black">
    <label class="h4 black"><?php echo translate( 1233, $lang);?></label><br/><br/>
   <?php if(!empty($cid)){?><label class="h4 black"><?php echo translate( 1236, $lang);?> : <?php echo $cid;?></label><br/><br/><?php } ?><br/><br/>
   <label class="h4 black"><?php echo translate( 1239, $lang);?></label><br/><br/>
   <label class="h4 black"><?php echo translate( 1242, $lang);?></label><br/><br/>
   <?php echo nl2br($bank_details);?>
    
	</div>
	<div class="clear height20"></div>
    
    
    </div>
     
     
     </div>
	
	
	
	
	
	
	
	</div>
</div>
<div class="clearfix"></div>
</main>
	

	
	
      @include('footer')
</body>
</html>