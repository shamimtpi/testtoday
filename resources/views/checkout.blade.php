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
	<title><?php echo translate( 25, $lang);?> - <?php echo translate( 325, $lang);?></title>




</head>
<body class="index">


    @include('header')

    
    <div class="promo-area" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $setts[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="promo-text">
                        <h1 class="avigher-title bolder fontsize30"><?php echo translate( 325, $lang);?></h1>
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
                        <li class="breadcrumb-item active"><?php echo translate( 325, $lang);?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
 
    <main class="checkout-area main-content">
        <div class="container">
        <form role="form" method="POST" action="{{ route('checkout') }}" id="formID" enctype="multipart/form-data">
        {{ csrf_field() }}
        
            <div class="row">
                
                <div class="col-md-6 col-sm-12">
                    <div class="billing-details">
                        <h3 class="check-title"><?php echo translate( 328, $lang);?></h3>
                        
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><?php echo translate( 331, $lang);?> <span class="red">*</span></label>
                                        <input type="text" name="bill_firstname" class="validate[required]">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><?php echo translate( 334, $lang);?> <span class="red">*</span></label>
                                        <input type="text" name="bill_lastname" class="validate[required]">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><?php echo translate( 337, $lang);?> <span class="red">*</span></label>
                                        <input name="bill_companyname" type="text" class="validate[required]">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><?php echo translate( 247, $lang);?> <span class="red">*</span></label>
                                        <input name="bill_email" type="text" class="validate[required,custom[email]]" value="<?php echo Auth::user()->email;?>" >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><?php echo translate( 340, $lang);?> <span class="red">*</span></label>
                                        <input type="text" name="bill_phone" class="validate[required]" value="<?php echo Auth::user()->phone;?>">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                     <label class="info-title" for="exampleInputName"><?php echo translate( 343, $lang);?> <span class="red">*</span></label>
                                        <input type="text" name="bill_address" class="validate[required]">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><?php echo translate( 346, $lang);?> <span class="red">*</span></label>
                                        <input type="text" name="bill_city" class="validate[required]">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><?php echo translate( 349, $lang);?> <span class="red">*</span></label>
                                        <input type="text" name="bill_state" class="validate[required]">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><?php echo translate( 352, $lang);?> <span class="red">*</span></label>
                                        <input type="text" name="bill_postcode" class="validate[required]">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><?php echo translate( 355, $lang);?> <span class="red">*</span></label>
                                        <select name="bill_country" class="validate[required]">
							  
							  <option value=""><?php echo translate( 358, $lang);?></option>
							  <?php 
							  if(!empty($countries_count)){
							  $countries = DB::table('countries')
												->orderBy('country_name', 'asc')
												->get();
							  foreach($countries as $country){?>
                              <option value="<?php echo $country->country_name;?>"><?php echo $country->country_name;?></option>
                              <?php } } ?>
							</select>
                                    </div>
                                </div>
                            </div>
                       

                    </div>
                </div>
                
                
                
                
                <div class="col-md-6 col-sm-12" style="display:none;">
                    <div class="billing-details">
                        <h3 class="check-title"><?php echo translate( 361, $lang);?></h3>
                        
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                <label class="info-title" for="enable_ship">
                                <input type="checkbox" style="margin-top:5px; margin-right:5px;" value="1" name="enable_ship" id="enable_ship" class="enable_ship" onChange="valueChanged()"> <strong><?php echo translate( 364, $lang);?> </strong></label>
                                    
                                </div>
                            </div>
                                
                         </div>

                        
                        <div class="ship_details" style="display:none;">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><?php echo translate( 331, $lang);?> <span class="red">*</span></label>
                                        <input type="text" name="ship_firstname" class="validate[required]">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><?php echo translate( 334, $lang);?> <span class="red">*</span></label>
                                        <input type="text" name="ship_lastname" class="validate[required]">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><?php echo translate( 337, $lang);?> <span class="red">*</span></label>
                                        <input name="ship_companyname" type="text" class="validate[required]">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><?php echo translate( 247, $lang);?> <span class="red">*</span></label>
                                        <input name="ship_email" type="text" class="validate[required,custom[email]]">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><?php echo translate( 340, $lang);?> <span class="red">*</span></label>
                                        <input type="text" name="ship_phone" class="validate[required]">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                     <label class="info-title" for="exampleInputName"><?php echo translate( 343, $lang);?> <span class="red">*</span></label>
                                        <input type="text" name="ship_address" class="validate[required]">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><?php echo translate( 346, $lang);?> <span class="red">*</span></label>
                                        <input type="text" name="ship_city" class="validate[required]">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><?php echo translate( 349, $lang);?> <span class="red">*</span></label>
                                        <input type="text" name="ship_state" class="validate[required]">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><?php echo translate( 352, $lang);?> <span class="red">*</span></label>
                                        <input type="text" name="ship_postcode" class="validate[required]">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><?php echo translate( 355, $lang);?> <span class="red">*</span></label>
                                        <select name="ship_country" class="validate[required]">
							  
							  <option value=""><?php echo translate( 358, $lang);?></option>
							 
							  
							  <?php 
							  if(!empty($countries_count)){
							  $countries = DB::table('countries')
												->orderBy('country_name', 'asc')
												->get();
							  foreach($countries as $country){?>
                              <option value="<?php echo $country->country_name;?>"><?php echo $country->country_name;?></option>
                              <?php } } ?>
							  
							</select>
                                    </div>
                                </div>
                            </div>
                            
                            
                            
                            
                            
                         
                         </div>
                         
                         
                         <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><?php echo translate( 367, $lang);?> <span class="red">*</span></label>
                                        <textarea cols="10" rows="5" placeholder="Notes about your order, e.g. special notes for delivery." id="order_comments" class="validate[required]" name="order_comments"></textarea>
                                    </div>
                                </div>
                                
                            </div> 
                         
                         
                    </div>
                </div>
                
                
                
                
                
                
                
            
            
            
            <?php if(!empty($cart_views_count)){?>
                                <?php 
								
								$price_val=0;
								$ord_id = ""; 
								$item_name = "";
								$item_prices = "";
								$item_user = "";
								foreach($cart_views as $item){ 
								$price_val +=$item->price;
								$ord_id .=$item->ord_id.',';
								$item_prices .=$item->price.',';
								$item_user .=$item->item_user_id.',';
								 } }
								 else
								 {
								    $price_val = 0;
									$ord_id = "";
									$item_prices = "";
									$item_user = "";
								 }
								 
								 $order_ids = rtrim($ord_id,",");
								 $item_price = rtrim($item_prices,",");
								 $item_users = rtrim($item_user,",");
								 ?>
           
            
           <div class="col-md-6 col-sm-12">
                    <div class="payment-method">
                        <h3 class="check-title"><?php echo translate( 370, $lang);?></h3>
                        <div class="cart-total pay-cart">
                            <h3><?php echo translate( 310, $lang);?></h3>
                            <ul class="cart-list">
                                <li><?php echo translate( 313, $lang);?> <span><?php echo $price_val;?> <?php echo $setts[0]->site_currency;?></span></li>
                                
                            </ul>
                            <strong><?php echo translate( 316, $lang);?><span><?php echo $price_val;?> <?php echo $setts[0]->site_currency;?></span></strong>
                        </div>
                        <input type="hidden" name="order_id" value="<?php echo $order_ids;?>">
                        <input type="hidden" name="item_prices" value="<?php echo base64_encode($item_price);?>">
                        <input type="hidden" name="total" value="<?php echo base64_encode($price_val);?>">
                        <input type="hidden" name="item_user_id" value="<?php echo $item_users;?>">
                        <div class="cart-total pay-cart">
                        <h3><?php echo translate( 373, $lang);?></h3>
                        </div>
                        
                        <?php
						$option = explode (",", $setts[0]->payment_option);
						?>
                        
                        <div class="payment-checkbox">
                         <select name="payment_type" class="payment_type validate[required]">
                         <option value=""></option>
                         <?php 
										
						$i=1;
						foreach($option as $withdraw){
						
						
						?>
                        
                       
                        <option value="<?php echo $withdraw;?>" <?php if($withdraw=="wallet"){?><?php if(Auth::user()->wallet >= $price_val) { } else {?> style="display:none;" <?php } } ?>><?php echo $withdraw;?><?php if($withdraw=="wallet"){?> (<?php echo Auth::user()->wallet;?> <?php echo $setts[0]->site_currency;?>)<?php } ?></option>
                        
                        
                        <?php $i++; } ?>
                        </select>
                        </div>
                        
                        <div class="height30"></div>
                                   
                                
                        
                        <div class="payment-checkbox">
                            <input type="checkbox" class="validate[required]" name="terms"> <?php echo translate( 376, $lang);?> <a href="<?php echo $url;?>/page/terms-conditions"><?php echo translate( 379, $lang);?></a>
                        </div>
                        <div class="place-order">
                        
                        <?php if(config('global.demosite')=="yes"){?><button type="button" class="custom-btn disable_button"><?php echo translate( 382, $lang);?></button> 
								<span class="disabletxt">( <?php echo config('global.demotxt');?> )</span><?php } else { ?>
						  
                            <button id="send" type="submit" class="custom-btn"><?php echo translate( 382, $lang);?></button>
								<?php } ?>   
                            
                        </div>
                    </div>
                </div> 
            
            
            
         </form>
         
         
         </div>

        </div>
    </main>
    
    
   
	
      @include('footer')
      
  
</body>
</html>