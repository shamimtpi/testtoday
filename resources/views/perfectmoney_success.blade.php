<?php
use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();	
$url = URL::to("/");
$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
if(!empty($finder))
{
   
   DB::update('update product_orders set payment_token="'.$paymentBatchNum.'" where status="completed" and purchase_token = ?', [$cid]);
   DB::update('update product_checkout set payment_token="'.$paymentBatchNum.'" where payment_status="completed" and purchase_token = ?', [$cid]);
}
$default = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }			
?>
<!DOCTYPE html>
<html lang="en">
<head>

    

   @include('style')
	 <title><?php echo translate( 25, $lang);?> - <?php if(!empty($finder)){ ?><?php echo translate( 469, $lang);?><?php } else { ?><?php echo translate( 268, $lang);?><?php } ?></title>




</head>
<body class="index">

    

    <!-- fixed navigation bar -->
    @include('header')

    
    <div class="promo-area" style="background-image: url(<?php echo $url;?>/local/images/media/<?php echo $setts[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="promo-text">
                    <?php if(!empty($finder)){ ?>
                        <h2 class="avigher-title bolder fontsize30"><?php echo translate( 469, $lang);?></h2>
                        <?php } else { ?>
                        <h2 class="avigher-title bolder fontsize30"><?php echo translate( 268, $lang);?></h2>
                        <?php } ?>
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
                        <?php if(!empty($finder)){ ?>
                        <li class="breadcrumb-item active"><?php echo translate( 469, $lang);?></li>
                        <?php } else {?>
                         <li class="breadcrumb-item active"><?php echo translate( 268, $lang);?></li>
                         <?php } ?>
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
     <?php if(!empty($finder)){ ?>
    <label class="black"><?php echo translate( 805, $lang);?></label><br/><br/>
   <label class="black"><?php echo translate( 475, $lang);?> : <?php echo $paymentBatchNum;?> </label><?php } else { ?>
   
    <label class="black"><?php echo translate( 271, $lang);?></label>
    <?php } ?>
    
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