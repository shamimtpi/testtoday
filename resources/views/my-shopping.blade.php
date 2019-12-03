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
	<title><?php echo translate( 25, $lang);?> - <?php echo translate( 526, $lang);?></title>




</head>
<body>

    
   
    @include('header')

    
     
    <div class="promo-area" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $setts[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="promo-text">
                        <h2 class="avigher-title bolder fontsize30"><?php echo translate( 526, $lang);?></h2>
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
                        <li class="breadcrumb-item active"><?php echo translate( 526, $lang);?></li>
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
                    @if(Session::has('refund_success'))

	    <p class="alert alert-success">

	      {{ Session::get('refund_success') }}

	    </p>

	@endif


	
	
 	@if(Session::has('refund_error'))

	    <p class="alert alert-danger">

	      {{ Session::get('refund_error') }}

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
                                   <strong class="p-title"><?php echo translate( 769, $lang);?></strong>
                               </div>
                               
                               <div class="col-sm-2">
                                   <strong class="p-title"><?php echo translate( 283, $lang);?></strong>
                               </div>
                               
                               
                               
                                
                               
                               <div class="col-sm-2">
                                   <strong class="p-title"><?php echo translate( 772, $lang);?></strong>
                               </div>
                               
                               
                                <div class="col-sm-2">
                                   <strong class="p-title"><?php echo translate( 775, $lang);?></strong>
                               </div>
                               
                               
                                <div class="col-sm-2">
                                   <strong class="p-title"><?php echo translate( 766, $lang);?></strong>
                               </div>
                            </div> 
                            
                            
                            
                            
                            
                            <?php if(!empty($items_count)){
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
								
							$items_cntt = DB::table('products')
											->where('delete_status','=','')
											->where('item_id','=',$iteem->item_id)
											
											->orderBy('item_id', 'desc')
											->count();
							
							if(!empty($items_cntt))
							{
							$items = DB::table('products')
											->where('delete_status','=','')
											->where('item_id','=',$iteem->item_id)
											
											->orderBy('item_id', 'desc')
											->get();
											
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
							}
							else
							{
							  $titler = "";
							}	
							
								
											
							if($iteem->licence_type == "regular_price_six_month"){ $license_text = translate( 106, $lang); }
							else if($iteem->licence_type == "regular_price_one_year"){ $license_text = translate( 109, $lang); }
							else if($iteem->licence_type == "extended_price_six_month"){ $license_text = translate( 112, $lang); }
							else if($iteem->licence_type == "extended_price_one_year"){ $license_text = translate( 115, $lang); }
							
							
							$checkout_why = DB::table('product_checkouts')
												->where('purchase_token','=',$iteem->purchase_token)
												->where('payment_status','=','completed')
												->count();
							
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
										
							if(!empty($items_cntt))
							{										
							?>
                            <div class="row single-cart">
                               
                               
                              
                            
                            
                                <div class="col-sm-2 no-padding">
                                    <div class="cart-prev" align="center">
                                    <?php if(!empty($items[0]->preview_image)){?>
                                        <a href="<?php echo $url;?>/item/<?php echo $items[0]->item_id;?>/<?php echo $items[0]->item_slug;?>"><img src="<?php echo $url;?>/local/images/media/preview/<?php echo $items[0]->preview_image;?>" alt=""></a>
                                    <?php } else { ?>  
                                    <a href="<?php echo $url;?>/item/<?php echo $items[0]->item_id;?>/<?php echo $items[0]->item_slug;?>"><img src="<?php echo $url;?>/local/images/noimage.jpg" alt=""></a>
                                    <?php } ?>  
                                    <p class="fontsize13"><a href="<?php echo $url;?>/item/<?php echo $items[0]->item_id;?>/<?php echo $items[0]->item_slug;?>"><?php echo $titler;?></a></p>
                                    <?php /*?><?php if($items[0]->unlimited_download==""){?>
                                    <p>Download File : <a href="javascript:void(0);" onClick="window.location.href='<?php echo $url;?>/local/images/media/<?php echo $items[0]->main_file;?>'" download><?php echo uniqid().time();?>.zip</a></p>
                                    <?php } ?><?php */?>
                                    
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
                                           <p><?php echo $iteem->price;?> <?php echo $settings[0]->site_currency;?></p>
                                          
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="col-sm-2">
                                    <div class="product-quantity">
                                        <div class="cart-count" align="center">
                                           
                                           <?php 
					
					$check_two = DB::table('product_refunds')
									->where('purchase_token','=', $iteem->purchase_token)
									->where('order_id','=', $iteem->ord_id)
									->where('buyer_id','=', $iteem->user_id)
									->where('vendor_id','=', $iteem->item_user_id)
									->where('dispute_status','=', '')
									->count();
									
					$check_three = DB::table('product_refunds')
									->where('purchase_token','=', $iteem->purchase_token)
									->where('order_id','=', $iteem->ord_id)
									->where('buyer_id','=', $iteem->user_id)
									->where('vendor_id','=', $iteem->item_user_id)
									->where('dispute_status','!=', '')
									->count();	
					
					if(!empty($check_two)){?>
                    
                    <span class="orange transform font14"><?php echo translate( 778, $lang);?></span>
                    <?php } if(!empty($check_three)){
					
					$check_three_view = DB::table('product_refunds')
									->where('purchase_token','=', $iteem->purchase_token)
									->where('order_id','=', $iteem->ord_id)
									->where('buyer_id','=', $iteem->user_id)
									->where('vendor_id','=', $iteem->item_user_id)
									->where('dispute_status','!=', '')
									->get();
					?>
                    
                    <span class="green font14 transform"><?php echo $check_three_view[0]->dispute_status;?></span>
                    <?php } ?>
                    
                                           
                                           <?php 
					
					
					$newDate = date('Y-m-d', strtotime($iteem->license_start_date.' + '.$settings[0]->refund_time_limit.' days'));
					$today_date = date("Y-m-d");
					
					if($iteem->status=="completed")
					{ 
					if($today_date <= $newDate)
					{
					
					   $check_one = DB::table('product_refunds')
									->where('purchase_token','=', $iteem->purchase_token)
									->where('order_id','=', $iteem->ord_id)
									->where('buyer_id','=', $iteem->user_id)
									->where('vendor_id','=', $iteem->item_user_id)
									->count();
									
												
					 if(empty($check_one))
					 {
					 
					    if($iteem->status=="completed")
						{
					?>
                    <a data-toggle="modal" data-target="#myModal_<?php echo $iteem->ord_id;?>" style="color:#0033CC; cursor:pointer;">
					<?php if($iteem->payment_type!="localbank"){?>
					<?php echo translate( 781, $lang);?>
                    <?php } else { if($iteem->approval_status=="payment released to vendor"){ echo translate( 781, $lang); } else { echo "-"; } } ?>
                    
                    
                    </a>
                    
                    <?php } else {?>
					<span class="green font14 transform"><?php echo $iteem->status;?></span>
					
					<?php } } ?>
                    
                    
                    
                    
                    
                    <?php } else { if(empty($check_three)){ if($iteem->approval_status==""){ $ttx = translate( 778, $lang); } else { $ttx = $iteem->approval_status; }?>
                    
                   <span class="green font14 transform"><?php echo $ttx;?></span>
                   <?php } } ?>
                    
                    
                    <?php } ?>
                    
                    
                    
                                           
                                          
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                
                                
                                
                                

                                <div class="modal fade" id="myModal_<?php echo $iteem->ord_id;?>">
                <div class="modal-dialog modal-lg" >
                    <div class="Quick-view-popup modal-content text-left">
                        <div class="modal-header" style="border:none;">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                        </div>
                        
                        <div class="col-md-12 col-xs-12">
                            <div class="row">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <div class="row">
                                        <div class="col-xs-12 marB30">
                                            <figure>
                                                <?php
														
														
														if(!empty($items[0]->preview_image)){					
														
																			
																		
														
														?>
                                                        <a href="<?php echo $url;?>/item/<?php echo $items[0]->item_id;?>/<?php echo $items[0]->item_slug;?>"><img src="<?php echo $url;?>/local/images/media/preview/<?php echo $items[0]->preview_image;?>" alt="" style="width:100%; max-width:350px;"></a>
                                                        <?php } else { ?>
                                                        <a href="<?php echo $url;?>/item/<?php echo $items[0]->item_id;?>/<?php echo $items[0]->item_slug;?>"><img src="<?php echo $url;?>/local/images/noimage_box.jpg" alt="" style="width:100%; max-width:350px;"></a>
                                                        <?php } ?>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <form class="form-horizontal" role="form" method="POST" action="{{ route('view-refund') }}" id="RATEID" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="col-md-6 col-sm-6 col-xs-12 padT30">
                                    <div class="row">
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="caption price-box  marB30">
                                                <h3><?php echo translate( 772, $lang);?></h3>
                                                <div class="clear height10"></div>
                                                
                                                
                                                
                                                <h5 class="color-gray"><a href="<?php echo $url;?>/item/<?php echo $items[0]->item_id;?>/<?php echo $items[0]->item_slug;?>"><?php echo $items[0]->item_title;?></a></h5>
                                            </div>
                                        </div>
                                        
                                        
                                        <input type="hidden" name="item_id" value="<?php echo $iteem->item_id;?>">
                                        
                                        <input type="hidden" name="purchase_token" value="<?php echo $iteem->purchase_token;?>">
                                        <input type="hidden" name="order_id" value="<?php echo $iteem->ord_id;?>">
                                        <input type="hidden" name="license_start_date" value="<?php echo $iteem->license_start_date;?>">
                                        <input type="hidden" name="buyer_id" value="<?php echo $iteem->user_id;?>">
                                        <input type="hidden" name="vendor_id" value="<?php echo $iteem->item_user_id;?>">
                                         <input type="hidden" name="payment" value="<?php echo $iteem->total;?>">
                                         <input type="hidden" name="payment_type" value="<?php echo $iteem->payment_type;?>">
                                         
                                        
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="quantity-box marB30">
                                                    <div class="col-md-12 col-sm-12">
                                                        <h4><?php echo translate( 784, $lang);?></h4>
                                                        <p class="review-icon">
                                                        <input type="text" name="subject" class="form-control unicase-form-control" required="required">
                                                        </p>
                                                        <div class="height10"></div>
                                                        <h4><?php echo translate( 235, $lang);?></h4>
                                                        <p class="review-icon">
                                                        <textarea rows="3" name="message" class="form-control unicase-form-control" required="required"></textarea></p>
                                              </div>
                                              
                                              
                                                <div class="col-md-12 height10"></div>
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="add-to-cart">
                                                        <input type="submit" name="submit" value="<?php echo translate( 214, $lang);?>" class="btn-upper custom-btn custombtn_width">
                                                        
                                                       
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12 height50"></div>
                                              
                                              </div>
                                              </div>
                                              </div>
                                        
                                        
                                    </div>
                                </div>
                                </form>
                                
                            </div>
                        </div>
                        
                        
                        
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
                                
                                
                                 
                                
                                
                                
                                <div class="col-sm-2">
                                <div class="product-quantity">
                                        <div class="cart-count" align="center">
                                        
                                <?php if($iteem->approval_status!="payment refunded to buyer"){?>
                                <?php if($iteem->payment_type!="localbank"){?>
                                 <a href="javascript:void(0);" class="featurebtn show-modal<?php echo $items[0]->item_token;?>" id="element"><?php echo translate( 775, $lang);?></a>
                                 <?php } else { if($iteem->approval_status=="payment released to vendor"){?> <a href="javascript:void(0);" class="featurebtn show-modal<?php echo $items[0]->item_token;?>" id="element"><?php echo translate( 775, $lang);?></a> <?php } else { echo "-"; } } } else { ?>
                                 <?php echo "<strong>-</strong>";?>
                                 <?php } ?>
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
                           
                                 
                                </div>
                                </div>
                                </div>
                                
                         
                                
                                <div class="col-sm-2">
                                    <div class="product-quantity">
                                        <div class="cart-count" align="center">
                                         <?php if($iteem->payment_type!="localbank"){?>
                                           <a href="<?php echo $url;?>/view-shopping-details/<?php echo $iteem->ord_id;?>" class="featurebtn" id="element"><?php echo translate( 766, $lang);?></a>
                                         <?php } else { if($iteem->approval_status=="payment released to vendor"){ ?> <a href="<?php echo $url;?>/view-shopping-details/<?php echo $iteem->ord_id;?>" class="featurebtn" id="element"><?php echo translate( 766, $lang);?></a> <?php  } else { if($iteem->approval_status!="payment refunded to buyer"){ echo '<span style="color:red;">'.translate( 1245, $lang).'</span>'; } } } ?>
                                        </div>
                                    </div>
                                </div>
                                
                            </div> 
                            
                            <script type="text/javascript">
							$(document).ready(function(){
							  var show_btn=$('.show-modal<?php echo $items[0]->item_token;?>');
							  
							  
							  
								show_btn.click(function(){
								  $("#testmodal<?php echo $items[0]->item_token;?>").modal('show');
							  })
							});
							
							
	                     </script>
                            
                            <div id="testmodal<?php echo $items[0]->item_token;?>" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title"><?php echo translate( 787, $lang);?></h4>
            </div>
            
            <?php
								if($lang == "en")
								{
								   $texter = "item_id";
								}
								else
								{
								  $texter = "parent";
								}			
								$get_tile = DB::table('products')->where($texter,'=',$items[0]->item_id)->count();	
								if(!empty($get_tile))
								{
								$get_tiles = DB::table('products')->where($texter,'=',$items[0]->item_id)->get();
								$titlers = $get_tiles[0]->item_title;	
								}
								else
								{
								$titlers = "";
								}	
			?>
            
            <div class="modal-body">
                <p><?php echo $titlers;?></p>
                <div class="row">
                <div class="col-md-6">
                <?php if(!empty($items[0]->preview_image)){?>
                                        <a href="<?php echo $url;?>/item/<?php echo $items[0]->item_id;?>/<?php echo $items[0]->item_slug;?>"><img src="<?php echo $url;?>/local/images/media/preview/<?php echo $items[0]->preview_image;?>" alt=""></a>
                                    <?php } else { ?>  
                                    <a href="<?php echo $url;?>/item/<?php echo $items[0]->item_id;?>/<?php echo $items[0]->item_slug;?>"><img src="<?php echo $url;?>/local/images/noimage.jpg" alt=""></a>
                                    <?php } ?>
                                    
                </div>
                
                <div class="col-md-6 rateitem">
                
                <form class="form-horizontal" role="form" method="POST" action="{{ route('my-shopping') }}" id="RATEID" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                
                                    <div class="row">
                                        
                                        
                                        <input type="hidden" name="user_id" value="<?php echo $iteem->user_id;?>">
                                        <input type="hidden" name="item_id" value="<?php echo $iteem->item_id;?>">
                                        
                                        
                                        
                                        <div class="col-md-12 col-sm-12 col-xs-12">
                                            <div class="row">
                                                <div class="quantity-box marB30">
                                                    <div class="col-md-12 col-sm-12">
                                                        <h4><?php echo translate( 790, $lang);?></h4>
                                                        <p class="review-icon">
                                                        
                                                    <span>
                                                    <input type="radio" name="rating" value="5" <?php if(!empty($check)){ if($check_view[0]->rating==5){ ?> checked <?php } } ?> required="required">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    </span>
                                                    
                                                    </p>
                                                    
                                                    <p class="review-icon">
                                                        
                                                    <span>
                                                    <input type="radio" name="rating" value="4"  <?php if(!empty($check)){ if($check_view[0]->rating==4){ ?> checked <?php } } ?> required="required">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    </span>
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>
                                                    
                                                    
                                                    <p class="review-icon">
                                                        
                                                    <span>
                                                    <input type="radio" name="rating" value="3"  <?php if(!empty($check)){ if($check_view[0]->rating==3){ ?> checked <?php } } ?> required="required">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    
                                                    </span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>
                                                    
                                                    
                                                    
                                                    <p class="review-icon">
                                                        
                                                    <span>
                                                    <input type="radio" name="rating" value="2" <?php if(!empty($check)){ if($check_view[0]->rating==2){ ?> checked <?php } } ?> required="required">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    
                                                    
                                                    </span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>
                                                    
                                                    
                                                    
                                                    <p class="review-icon">
                                                        
                                                    <span>
                                                    <input type="radio" name="rating" value="1" <?php if(!empty($check)){ if($check_view[0]->rating==1){ ?> checked <?php } } ?> required="required">
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    
                                                    
                                                    
                                                    </span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    </p>
                                                    
                                                    
                                                    </div>
                                                    
                                                    <div class="clearfix height30"></div>
                                                    
                                                    <div class="col-md-10 col-sm-10 ">
                                                        <h4><?php echo translate( 793, $lang);?></h4>
                                                        <textarea rows="3" name="review" class="form-control unicase-form-control" required="required"><?php if(!empty($check)){ echo $check_view[0]->review; } ?></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 height10"></div>
                                                <div class="col-md-12 col-sm-12">
                                                    <div class="add-to-cart">
                                                        <input type="submit" name="submit" value="<?php echo translate( 214, $lang);?>" class="btn-upper btn btn-primary">
                                                        
                                                       
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-12 height50"></div>
                                                
                                            </div>
                                        </div>
                                    
                                </div>
                                </form>
                
                
                
                </div>
                
               </div> 
                                    
                                    
                                    
            </div>
            
        </div>
    </div>
</div>



<?php } ?>
                         <?php } } ?>   
                            
                            
                            
                            
                            
                            
                              
                        </div> 
                    </div>
                </div>
            </div>
        </div> <!-- Product Cart End -->
        
    </main>

	
    
      @include('footer')
      
     
    
</body>
</html>