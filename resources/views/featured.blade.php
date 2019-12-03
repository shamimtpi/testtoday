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
?>
<!DOCTYPE html>
<html lang="en">
<head>

    

   @include('style')
	<title><?php echo translate( 25, $lang);?> - <?php echo translate( 478, $lang);?></title>




</head>
<body class="index">

    

    <!-- fixed navigation bar -->
    @include('header')

    
     
    

	
    <div class="promo-area" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $settings[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="promo-text">
                        <h2 class="avigher-title bolder fontsize30"><?php echo translate( 478, $lang);?></h2>
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
                        <li class="breadcrumb-item active"><?php echo translate( 478, $lang);?></li>
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
	
	
	
	
	
	
	
	
	<?php if(!empty($items_count)){?>
	
	<div class="">
    <div class="">
     <div class="col-md-2"></div> 
        <div class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><?php echo $items_details[0]->item_title;?></div>
                <div class="panel-body">
                    
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('featured-payment') }}" id="formID" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    
                    <div class="col-md-6 col-md-12 paddingoff">
                        <?php if(!empty($items_details[0]->preview_image)){?> 
                        <a href="<?php echo $url;?>/item/<?php echo $items_details[0]->item_id;?>/<?php echo $items_details[0]->item_slug;?>"><img src="<?php echo $url;?>/local/images/media/preview/<?php echo $items_details[0]->preview_image;?>" alt=""></a>
                                    <?php } else { ?>  
                                    <a href="<?php echo $url;?>/item/<?php echo $items_details[0]->item_id;?>/<?php echo $items_details[0]->item_slug;?>"><img src="<?php echo $url;?>/local/images/noimage.jpg" alt=""></a>
                                    <?php } ?>            	
                    </div>
                    
                    <input type="hidden" name="price" value="<?php echo $settings[0]->featured_price;?>">
                     <input type="hidden" name="duration" value="<?php echo $settings[0]->featured_days;?>">
                     <input type="hidden" name="item_name" value="<?php echo $items_details[0]->item_title;?>">
                      <input type="hidden" name="item_number" value="<?php echo $items_details[0]->item_token;?>">
                    <div class="col-md-6 col-md-12 text-center">
                    <div class="clearfix height40"></div>
                    <div><strong class="black"><?php echo translate( 283, $lang);?>:</strong> <?php echo $settings[0]->featured_price;?> <?php echo $settings[0]->site_currency;?></div>
                    <div class="height10"></div>
                    <div><strong class="black"><?php echo translate( 481, $lang);?>:</strong> <?php echo $settings[0]->featured_days;?> <?php echo translate( 484, $lang);?></div>
                    
                    <?php $option = explode (",", $settings[0]->payment_option); ?>
                    <div class="height10"></div>
                    <div><select name="payment_type" class="validate[required]" style="max-width:200px;">
                    <option value=""><?php echo translate( 97, $lang);?></option>
					<?php $i=1;
					foreach($option as $withdraw){?>
                    <option value="<?php echo $withdraw;?>" <?php if($withdraw=="wallet" or $withdraw=="paytm" or $withdraw=="2checkout"){?> style="display:none;" <?php } ?>><?php echo $withdraw;?></option>
                    <?php } ?>
                    </select>
                    </div>
                    
                    
                     <div class="height20"></div>
                     <div><input type="submit" name="submit" value="<?php echo translate( 382, $lang);?>" class="custom-btn" style="max-width:150px;"></div>
                    <div class="clearfix height40"></div>
                                    	
                    </div>
                    
                    
                    </form>
                </div>
            </div>
        </div>
         <div class="col-md-2"></div> 
    </div>
</div>

<?php } ?>





	
	</div>
</div>
<div class="clearfix"></div>
</main>
	

      @include('footer')
</body>
</html>