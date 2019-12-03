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
	<title><?php echo translate( 25, $lang);?> - <?php echo translate( 898, $lang);?></title>




</head>
<body class="index">

    @include('header')

    
    <div class="promo-area" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $setts[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="promo-text">
                        <h2 class="avigher-title bolder fontsize30"><?php echo translate( 898, $lang);?></h2>
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
                        <li class="breadcrumb-item active"><?php echo translate( 898, $lang);?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
 
    <main class="checkout-area main-content">
        <div class="container">
        
        <div class="row">
                     <div class="">
                    

	
	
 	@if(Session::has('down_error'))

	    <p class="alert alert-danger">

	      {{ Session::get('down_error') }}

	    </p>

	@endif
    </div>
    </div>
        
           <?php if(!empty($items_count)){?>
           
           
          
           
            <div class="row order_details">
                
                <div class="col-md-6 col-sm-12">
                    <div class="billing-details">
                        <h3 class="check-title"><?php echo translate( 901, $lang);?></h3>
                        
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span><?php echo translate( 874, $lang);?> :</span> <?php echo $items[0]->purchase_token;?></label>
                                      </div>  
                                    
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span><?php echo translate( 718, $lang);?> :</span> <?php echo $items[0]->payment_type;?></label>
                                      </div>  
                                    
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span><?php echo translate( 760, $lang);?> :</span> <?php echo date("d M, Y", strtotime($items[0]->license_start_date));?></label>
                                      </div>  
                                    
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span><?php echo translate( 763, $lang);?> :</span> <?php echo date("d M, Y", strtotime($items[0]->license_end_date));?></label>
                                      </div>  
                                    
                                </div>
                            </div>
                            
                            <?php
							if($items[0]->licence_type == "regular_price_six_month"){ $license_text = translate( 106, $lang); }
							else if($items[0]->licence_type == "regular_price_one_year"){ $license_text = translate( 109, $lang); }
							else if($items[0]->licence_type == "extended_price_six_month"){ $license_text = translate( 112, $lang); }
							else if($items[0]->licence_type == "extended_price_one_year"){ $license_text = translate( 115, $lang); }
							?>
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span><?php echo translate( 283, $lang);?> :</span> <?php echo $items[0]->total;?> <?php echo $setts[0]->site_currency;?></label>
                                      </div>  
                                    
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span><?php echo translate( 280, $lang);?> :</span> <?php echo $license_text;?></label>
                                      </div>  
                                    
                                </div>
                            </div>
                            
                            
                       <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span><?php echo translate( 475, $lang);?> :</span> <?php echo $items[0]->payment_token;?> </label>
                                      </div>  
                                    
                                </div>
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span><?php echo translate( 877, $lang);?> :</span> <?php echo $items[0]->status;?> </label>
                                      </div>  
                                    
                                </div>
                                 
                            </div>
                            
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span><?php echo translate( 1257, $lang);?> :</span> <?php if(!empty($items[0]->purchase_code)){?><?php echo $items[0]->purchase_code;?><?php } ?> </label>
                                      </div>  
                                    
                                </div>
                                
                                
                                 
                            </div>
                            

                    </div>
                </div>
                
                
                
                
                <div class="col-md-6 col-sm-12 ">
                    <div class="billing-details">
                        <h3 class="check-title"><?php echo translate( 904, $lang);?></h3>
                        
                        
                        
                        
                        <div class="ship_details">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span><?php echo translate( 244, $lang);?> :</span> <?php echo $user_detail[0]->name;?></label>
                                      </div>  
                                    
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span><?php echo translate( 340, $lang);?> :</span> <?php echo $user_detail[0]->phone;?></label>
                                      </div>  
                                    
                                </div>
                            </div>
                            
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span><?php echo translate( 247, $lang);?> :</span> <?php echo $user_detail[0]->email;?></label>
                                      </div>  
                                    
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span><?php echo translate( 436, $lang);?> :</span> <?php echo $user_detail[0]->gender;?></label>
                                      </div>  
                                    
                                </div>
                            </div>
                            
                            
                            
                            
                            
                            
                         
                         </div>
                         
                         
                          
                         
                         
                    </div>
                </div>
                
                
                
                
                
                
                
            </div>
            
            
           <div class="height100"></div>
            
            <div class="row order_details">
                
                <div class="col-md-6 col-sm-12">
                    <div class="billing-details">
                        <h3 class="check-title"><?php echo translate( 883, $lang);?></h3>
                        
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span><?php echo translate( 331, $lang);?> :</span> <?php echo $checkout_detail[0]->bill_firstname;?></label>
                                      </div>  
                                    
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span>	<?php echo translate( 334, $lang);?> :</span> <?php echo $checkout_detail[0]->bill_lastname;?></label>
                                      </div>  
                                    
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span><?php echo translate( 337, $lang);?> :</span> <?php echo $checkout_detail[0]->bill_companyname;?></label>
                                      </div>  
                                    
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span><?php echo translate( 247, $lang);?> :</span> <?php echo $checkout_detail[0]->bill_email;?></label>
                                      </div>  
                                    
                                </div>
                            </div>
                            
                           
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span><?php echo translate( 340, $lang);?> :</span> <?php echo $checkout_detail[0]->bill_phone;?></label>
                                      </div>  
                                    
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span><?php echo translate( 355, $lang);?> :</span> <?php echo $checkout_detail[0]->bill_country;?></label>
                                      </div>  
                                    
                                </div>
                            </div>
                            
                            
                       <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span><?php echo translate( 343, $lang);?> :</span> <?php echo $checkout_detail[0]->bill_address;?></label>
                                      </div>  
                                    
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span><?php echo translate( 886, $lang);?> :</span> <?php echo $checkout_detail[0]->bill_city;?></label>
                                      </div>  
                                    
                                </div>
                            </div>
                            
                            
                        <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span><?php echo translate( 349, $lang);?> :</span> <?php echo $checkout_detail[0]->bill_state;?></label>
                                      </div>  
                                    
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span><?php echo translate( 352, $lang);?> :</span> <?php echo $checkout_detail[0]->bill_postcode;?></label>
                                      </div>  
                                    
                                </div>
                            </div>    

                    </div>
                </div>
                
                
                
                
                <?php /*?><div class="col-md-6 col-sm-12" style="display:none;">
                    <div class="billing-details">
                        <h3 class="check-title">Shipping Details</h3>
                        
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span>First Name :</span> <?php echo $checkout_detail[0]->ship_firstname;?></label>
                                      </div>  
                                    
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span>Last Name :</span> <?php echo $checkout_detail[0]->ship_lastname;?></label>
                                      </div>  
                                    
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span>Company Name :</span> <?php echo $checkout_detail[0]->ship_companyname;?></label>
                                      </div>  
                                    
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span>Email :</span> <?php echo $checkout_detail[0]->ship_email;?></label>
                                      </div>  
                                    
                                </div>
                            </div>
                            
                           
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span>Phone :</span> <?php echo $checkout_detail[0]->ship_phone;?></label>
                                      </div>  
                                    
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span>Country :</span> <?php echo $checkout_detail[0]->ship_country;?></label>
                                      </div>  
                                    
                                </div>
                            </div>
                            
                            
                       <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span>Address :</span> <?php echo $checkout_detail[0]->ship_address;?></label>
                                      </div>  
                                    
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span>City :</span> <?php echo $checkout_detail[0]->ship_city;?></label>
                                      </div>  
                                    
                                </div>
                            </div>
                            
                            
                        <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span>State :</span> <?php echo $checkout_detail[0]->ship_state;?></label>
                                      </div>  
                                    
                                </div>
                                 <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span>Postcode/zip :</span> <?php echo $checkout_detail[0]->ship_postcode;?></label>
                                      </div>  
                                    
                                </div>
                            </div>    

                    </div>
                </div><?php */?>
                
                
                
                
                
                
                
                
                <div class="col-md-6 col-sm-12">
                
            <h3 class="check-title"><?php echo translate( 889, $lang);?></h3>
            <div class="height30"></div>
            <div class="row order_details">
                
                <div class="col-md-12 col-sm-12">
                
                <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span><?php echo translate( 892, $lang);?> :</span> <?php echo $checkout_detail[0]->other_notes;?></label>
                                      </div>  
                                    
                                </div>
                                 
                            </div>
                            
                  </div>
           </div>
           <?php 
		   
		   /*$newDate = date('Y-m-d', strtotime($items[0]->license_start_date.' + '.$setts[0]->refund_time_limit.' days'));
		   
		   $today_date = date("Y-m-d");*/
		   ?>
                <div class="height20"></div>  
                
                <div class="row order_details">
                
                <div class="col-md-12 col-sm-12">
                
                <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label class="info-title" for="exampleInputName"><span><?php echo translate( 907, $lang);?> : <?php if($items[0]->approval_status=="payment released to vendor"){?> <a href="javascript:void(0);" onClick="window.location.href='<?php echo $url;?>/view-shopping-details/<?php echo $items[0]->item_id;?>/<?php echo $items[0]->ord_id;?>'"><?php echo translate( 910, $lang);?></a> <?php } elseif($items[0]->approval_status=="") {?><span style="font-weight:normal; color:#FF3300;"> Payment approval for admin</span> <?php } else { ?><?php } ?></span> </label>
                                      </div>  
                                    
                                </div>
                                 
                            </div>
                            
                  </div>
           </div>
                
                
                
          </div>      
                
                
                
                
                
                
                
                
                
                
                
                
                
                
                
            </div>
            
            
            
            
            
                
                
                
                
                
                
                  <div class="height50"></div>          
            
            <div class="row">
                <div class="col-md-12 text-left paddingoff">
                <a href="<?php echo $url;?>/my-shopping" class="custom-btn"><?php echo translate( 913, $lang);?></a>
                </div>
                
           </div>
            
            
            <?php } ?>
            
           
            
            
            
        

        </div>
    </main>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    

	
	

	
	
      @include('footer')
</body>
</html>