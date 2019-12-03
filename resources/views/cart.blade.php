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
	<title><?php echo translate( 25, $lang);?> - <?php echo translate( 274, $lang);?></title>




</head>
<body class="index">

    @include('header')

    
    <div class="promo-area" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $setts[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="promo-text">
                        <h1 class="avigher-title bolder fontsize30"><?php echo translate( 274, $lang);?></h1>
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
                        <li class="breadcrumb-item active"><?php echo translate( 274, $lang);?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
 
    <main class="cart-area main-content">
    
     <?php if(!empty($cart_views_count)){?>
    
        <div class="product-cart">
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
                    <div class="col-md-12">
                        <div class="cart-wrap">
                            <div class="row cart-header">
                               <div class="col-sm-2">
                                   <strong class="p-title"><?php echo translate( 277, $lang);?></strong>
                               </div>
                               <div class="col-sm-3">
                                   <strong class="p-title"><?php echo translate( 244, $lang);?></strong>
                               </div>
                               <div class="col-sm-2">
                                   <strong class="p-title"><?php echo translate( 280, $lang);?></strong>
                               </div>
                               <div class="col-sm-2">
                                   <strong class="p-title"><?php echo translate( 283, $lang);?></strong>
                               </div>
                               <div class="col-sm-2">
                                   <strong class="p-title"><?php echo translate( 286, $lang);?></strong>
                               </div>
                                <div class="col-sm-1">
                                   <strong class="p-title"><?php echo translate( 289, $lang);?></strong>
                               </div>
                            </div> 
                            
                            
                            
                             <?php if(!empty($cart_views_count)){?>
                                <?php 
								
								$price_val=0;
								$ord_id = ""; 
								$item_name = "";
								foreach($cart_views as $item){
								
								 $item_id = $item->item_token; 
								 
								$view_item = DB::table('products')
													->where('item_token','=',$item_id)
													->where('lang_code','=',$lang)
													->get();
									if($lang == "en")
									{
									   $texter = $view_item[0]->item_id;
									}
									else
									{
									  $texter = $view_item[0]->parent;
									}				
										$ord_id .=	$item->ord_id.',';	
										
										
										
										
										
										
				$review_count_03 = DB::table('product_ratings')
				->where('item_id', '=', $texter)
				->count();
				
				if(!empty($review_count_03))
				{
				$review_value_03 = DB::table('product_ratings')
				               ->where('item_id', '=', $texter)
				               ->get();
				
				
				$over_03 = 0;
		        $fine_value_03 = 0;
				foreach($review_value_03 as $review){
				if($review->rating==1){$value1 = $review->rating*1;} else { $value1 = 0; }
		if($review->rating==2){$value2 = $review->rating*2;} else { $value2 = 0; }
		if($review->rating==3){$value3 = $review->rating*3;} else { $value3 = 0; }
		if($review->rating==4){$value4 = $review->rating*4;} else { $value4 = 0; }
		if($review->rating==5){$value5 = $review->rating*5;} else { $value5 = 0; }
		
		$fine_value_03 += $value1 + $value2 + $value3 + $value4 + $value5;
		

      $over_03 +=$review->rating;
	  
	  
	  
				}
				if(!empty(round($fine_value_03/$over_03))){ $roundeding_03 = round($fine_value_03/$over_03); } else {
		  $roundeding_03 = 0; }	
				
				
				}
				
				if(!empty($review_count_03))
				                               {
	                                           if(!empty($roundeding_03)){
	
	                                           if($roundeding_03==1){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                   
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    
                                                    
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_03.')
                                                </p>';
												}
												if($roundeding_03==2){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                   
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                   
													
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_03.')
                                                </p>';
												}
												
												if($roundeding_03==3){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                   
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                   
													
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_03.')
                                                </p>';
												}
												
												if($roundeding_03==4){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i> 
                                                    
											                                                
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_03.')
                                                </p>';
												}
												
												if($roundeding_03==5){ $rateus_new_03 ='
                                                <p class="review-icon">
                                                    
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i>
													 <i class="fa fa-star my_yellow" aria-hidden="true"></i> ('.$review_count_03.')
                                                    
											    </p>';
												}
												
												
												}
											    else if(empty($roundeding_03)){  $rateus_new_03 = '
												<p class="review-icon">
                                                    
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_03.')
											    </p>';
												}
												
												}
												
												
												
												$rateus_empty_03 = '
												<p class="review-icon">
                                                    
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_03.')
											    </p>';
												
				
											
																		
													?>
                            <div class="row single-cart">
                                <div class="col-sm-2" align="center">
                                    <div class="cart-prev">
                                        
                                        <?php
														if(!empty($view_item[0]->preview_image)){
														
														?>
                                                        
                                                        <a href="<?php echo $url;?>/item/<?php echo $texter;?>/<?php echo $view_item[0]->item_slug;?>" class="entry-thumbnail"><img src="<?php echo $url;?>/local/images/media/preview/<?php echo $view_item[0]->preview_image;?>" alt="" ></a>
                                                        <?php } else { ?>
                                                        <a href="<?php echo $url;?>/item/<?php echo $texter;?>/<?php echo $view_item[0]->item_slug;?>" class="entry-thumbnail"><img src="<?php echo $url;?>/local/images/noimage_box.jpg" alt="" ></a>
                                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-sm-3" align="center">
                                    <div class="product-heading"  align="left">
                                        <p><a href="<?php echo $url;?>/item/<?php echo $texter;?>/<?php echo $view_item[0]->item_slug;?>"><?php echo $view_item[0]->item_title;?></a></p>
                                        <?php if(!empty($review_count_03)){ echo $rateus_new_03; } else { echo $rateus_empty_03; }?> 
                                    </div>
                                </div>
                                <?php 
								if($item->licence_type=="regular_price_six_month"){ $license_txt = translate( 292, $lang); }
								else if($item->licence_type=="regular_price_one_year"){ $license_txt = translate( 295, $lang); }
								else if($item->licence_type=="extended_price_six_month"){ $license_txt = translate( 298, $lang); }
								else if($item->licence_type=="extended_price_one_year"){ $license_txt = translate( 301, $lang); }
								else { $license_txt = ""; }
								?>
                                <div class="col-sm-2" align="center">
                                    <div class="product-quantity">
                                        <div class="cart-count">
                                            <?php echo $license_txt;?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-2" align="center">
                                    <strong class="s-cart-price"><?php echo $item->price;?> <?php echo $setts[0]->site_currency;?></strong>
                                </div>
                                <div class="col-sm-2" align="center">
                                    <strong class="s-cart-price"><?php echo $item->price;?> <?php echo $setts[0]->site_currency;?></strong>
                                    
                                </div>
                                
                                <div class="col-sm-1" align="center">
                                <strong class="s-cart-price"><a href="<?php echo $url;?>/cart/<?php echo $item->ord_id;?>" onClick="return confirm('<?php echo translate( 304, $lang);?>');"><img src="<?php echo $url;?>/local/images/delete.png" border="0"></a></strong>
                                </div>
                                
                            </div> 
                            
                            
                          <?php $price_val +=$item->price;  } } ?>  
                            
                        </div> 
                        
                    </div>
                </div>
                
                
                <div class="row">
                <div class="col-md-12 paddingoff">
                <a href="<?php echo $url;?>/all-items" class="custom-btn"><?php echo translate( 307, $lang);?></a>
                </div>
                </div>
                
                
                
            </div>
        </div> <!-- Product Cart End -->
        <section class="product-coupon">
            <div class="container">
                <div class="row">
                    <?php /* ?><div class="col-sm-5 col-md-3 col-xs-12 pc-box">
                        <div class="update-coupon">
                            <a href="#" class="custom-btn">update cart</a>
                        </div>
                    </div>
                    <div class="col-sm-7 col-md-5 col-xs-12  pc-box">
                        <div class="offer-coupon">
                            <h4 class="offer-heading">Offer Coupon</h4>
                            <p>Enter your coupon code if you have one</p>
                            <form action="#" class="coupon-form">
                                <input type="text" placeholder="Write Coupon Number here">
                                <button type="submit" class="custom-btn">apply coupon</button>
                            </form>
                        </div>
                    </div> <?php */?>
                    
                    <div class="col-sm-12 col-md-8 col-xs-12  pc-box"></div>
                    <div class="col-sm-12 col-md-4 col-xs-12  pc-box">
                        <div class="cart-total">
                            <h3><?php echo translate( 310, $lang);?></h3>
                            <ul class="cart-list">
                                <li><?php echo translate( 313, $lang);?> <span><?php echo $price_val;?> <?php echo $setts[0]->site_currency;?></span></li>
                               
                            </ul>
                            <strong><?php echo translate( 316, $lang);?> <span><?php echo $price_val;?> <?php echo $setts[0]->site_currency;?></span></strong>
                            <a href="<?php echo $url;?>/checkout" class="custom-btn"><?php echo translate( 319, $lang);?></a>
                        </div>
                    </div>
                </div>
            </div>
        </section> 
        
        
        <?php } else { ?>
        
         <div class="product-cart">
            <div class="container">
            
            <div class="row">
                <div class="nodata"><?php echo translate( 322, $lang);?></div>
            </div>
            
           </div>
        </div>
        
        
        <?php } ?>
        
    </main>
    
  
	
      @include('footer')
      
    
</body>
</html>