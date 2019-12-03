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
	<title><?php echo translate( 25, $lang);?> - <?php echo translate( 529, $lang);?></title>




</head>
<body>

    

    @include('header')

    
     
    <div class="promo-area" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $setts[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="promo-text">
                        <h2 class="avigher-title bolder fontsize30"><?php echo translate( 529, $lang);?></h2>
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
                        <li class="breadcrumb-item active"><?php echo translate( 529, $lang);?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
   
    <main class="cart-area main-content">
    
    
    
        <div class="product-cart">
            <div class="container">
                
                <div class="clearfix height10"></div>
               <div class="row">
                     <div class="">
                    @if(Session::has('success'))

	    <p class="alert alert-success">

	      {{ Session::get('success') }}

	    </p>

	@endif


	
	
 	@if(Session::has('error'))

	    <p class="alert alert-danger">

	      {{ Session::get('error') }}

	    </p>

	@endif
    </div>
    </div>
                
    <div class="clearfix height10"></div>
    
                <div class="row">                                                                               
                    <div class="col-md-12">
                        <div class="cart-wrap">
                            <div class="row cart-header">
                              
                               <div class="col-sm-2">
                                   <strong class="p-title"><?php echo translate( 736, $lang);?></strong>
                               </div>
                               <div class="col-sm-2">
                                   <strong class="p-title"><?php echo translate( 757, $lang);?></strong>
                               </div>
                               
                               <div class="col-sm-2">
                                   <strong class="p-title"><?php echo translate( 280, $lang);?></strong>
                               </div>
                               
                               
                               
                                <div class="col-sm-2">
                                   <strong class="p-title"><?php echo translate( 760, $lang);?></strong>
                               </div>
                               
                               <div class="col-sm-2">
                                   <strong class="p-title"><?php echo translate( 763, $lang);?></strong>
                               </div>
                               
                               
                                <div class="col-sm-2">
                                   <strong class="p-title"><?php echo translate( 766, $lang);?></strong>
                               </div>
                            </div> 
                            
                            
                            
                            
                            
                            <?php
                            
                            $items_count = DB::table('product_orders')->count();
                            
                            if(!empty($items_count)){
							$logged = Auth::user()->id;
							$today_date = date("Y-m-d");
							$view_items = DB::table('product_orders')
											->where('user_id','=',$logged)
											->where('status','=','completed')
											->where('license_end_date', '>=', $today_date)
											->orderBy('ord_id', 'desc')
											->get();
							foreach($view_items as $iteem)
							{
							
							$items_count = DB::table('products')
											->where('delete_status','=','')
											->where('item_id','=',$iteem->item_id)
											->orderBy('item_id', 'desc')
											->count();
							
							$items = DB::table('products')
											->where('delete_status','=','')
											->where('item_id','=',$iteem->item_id)
											->orderBy('item_id', 'desc')
											->get();
							if($iteem->licence_type == "regular_price_six_month"){ $license_text = translate( 106, $lang); }
							else if($iteem->licence_type == "regular_price_one_year"){ $license_text = translate( 109, $lang); }
							else if($iteem->licence_type == "extended_price_six_month"){ $license_text = translate( 112, $lang); }
							else if($iteem->licence_type == "extended_price_one_year"){ $license_text = translate( 115, $lang); }
							
							if($lang == "en")
								{
								   $texter = "item_id";
								}
								else
								{
								  $texter = "parent";
								}			
								$get_tile = DB::table('products')->where($texter,'=',$iteem->item_id)->count();	
								if(!empty($get_tile))
								{
								$get_tiles = DB::table('products')->where($texter,'=',$iteem->item_id)->get();
								$titler = $get_tiles[0]->item_title;	
								}
								else
								{
								$titler = "";
								}
							
							
							
							$check = DB::table('product_ratings')
												  ->where('user_id','=', $iteem->user_id)
												  ->where('item_id','=', $iteem->item_id)
												  ->count();
										if(!empty($check))
										{
										  $check_view = DB::table('product_ratings')
												  ->where('user_id','=', $iteem->user_id)
												  ->where('item_id','=', $iteem->item_id)
												  ->get();
										$ratinger = $check_view[0]->rating;		  
										
										}
										else
										{
										$ratinger = "";
										}	
										
						    $user_data = DB::table('users')
									 ->where('id','=',$iteem->user_id)
									 ->count();	
							if(!empty($user_data))
							{
							   $user_details = DB::table('users')
									 			->where('id','=',$iteem->user_id)
									 			->get();	
							   $buyer_name = $user_details[0]->name;
							   $buyer_url = $user_details[0]->user_slug;
							}
							else
							{
							   $buyer_name = "";
							}
									 									
							?>
                            <?php if(!empty($items_count)){ ?> 
                            <div class="row single-cart">
                               
                               
                              
                            
                            
                                <div class="col-sm-2 no-padding">
                                    <div class="cart-prev" align="center">
                                    <?php  if(!empty($items[0]->preview_image)){?>
                                        <a href="<?php echo $url;?>/item/<?php echo $items[0]->item_id;?>/<?php echo $items[0]->item_slug;?>"><img src="<?php echo $url;?>/local/images/media/preview/<?php echo $items[0]->preview_image;?>" alt=""></a>
                                    <?php } else { ?>  
                                    <a href="<?php echo $url;?>/item/<?php echo $items[0]->item_id;?>/<?php echo $items[0]->item_slug;?>"><img src="<?php echo $url;?>/local/images/noimage.jpg" alt=""></a>
                                    <?php }  ?> 
                                    
                                    <p class="fontsize13"><a href="<?php echo $url;?>/item/<?php echo $items[0]->item_id;?>/<?php echo $items[0]->item_slug;?>"><?php echo $titler;?></a></p>
                              
                                    
                                    <?php if($ratinger==1){?>
                                                        <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                    </span>
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </p><?php } ?>
                                                <?php if($ratinger==2){?>
                                                        <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                    </span>
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </p><?php } ?>
                                                <?php if($ratinger==3){?>
                                                        <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                    </span>
                                                    
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </p><?php } ?>
                                                
                                                <?php if($ratinger==4){?>
                                                        <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                     <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                    </span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </p><?php } ?>
                                                    <?php if($ratinger==5){?>
                                                        <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                     <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                     <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                    </span>
                                                    
                                                </p><?php } ?>
                                                <p><?php echo $iteem->price;?> <?php echo $settings[0]->site_currency;?></p>
                                    </div>
                                    
                                    
                                </div>
                                
                                <div class="col-sm-2">
                                    <div class="product-quantity">
                                        <div class="cart-count" align="center">
                                           
                                           <a href="<?php echo $url;?>/user/<?php echo $buyer_url;?>"><?php echo $buyer_name;?></a>
                                          
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-2">
                                <div class="product-quantity">
                                        <div class="cart-count" align="center">
                                        <?php echo $license_text;?>
                                  </div>
                                  </div>
                                </div>
                                
                                
                               
                                
                                
                                
                                 <div class="col-sm-2">
                                    <div class="product-quantity">
                                        <div class="cart-count" align="center">
                                   <span class="vmiddle"> <?php echo date("d M, Y", strtotime($iteem->license_start_date));?></span>
                                   
                                   </div></div>
                                </div>
                                
                                
                                 <div class="col-sm-2">
                                    <div class="product-quantity">
                                        <div class="cart-count" align="center">
                                           
                                          <?php echo date("d M, Y", strtotime($iteem->license_end_date));?>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="col-sm-2">
                                <div class="product-quantity">
                                        <div class="cart-count" align="center">
                                        
                                
                                 <a href="<?php echo $url;?>/view-order-details/<?php echo $iteem->ord_id;?>" class="featurebtn" id="element"><?php echo translate( 766, $lang);?></a>
                                  
                           
                                 
                                </div>
                                </div>
                                </div>
                            </div> 
                            
                            
                            
                            




                         <?php } } } ?>   
                            
                            
                            
                            
                            
                            
                              
                        </div> 
                    </div>
                </div>
            </div>
        </div> <!-- Product Cart End -->
        
    </main>

	
    
      @include('footer')
  
</body>
</html>