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
	<title><?php echo translate( 25, $lang);?> - <?php echo translate( 523, $lang);?></title>




</head>
<body>

    
    @include('header')

    
     
    <div class="promo-area" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $setts[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="promo-text">
                        <h2 class="avigher-title bolder fontsize30"><?php echo translate( 523, $lang);?></h2>
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
                        <li class="breadcrumb-item active"><?php echo translate( 523, $lang);?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
   
    <main class="cart-area main-content">
    
    
    
        <div class="product-cart">
            <div class="container">
                
                <div class="row">
                <div class="col-md-12 text-right paddingoff">
                <a href="<?php echo $url;?>/add-item" class="custom-btn"><?php echo translate( 85, $lang);?></a>
                </div>
                
                </div>
                <div class="clearfix height10"></div>
                
                <div class="row">                                                                               
                    <div class="col-md-12">
                        <div class="cart-wrap">
                            <div class="row cart-header">
                               <div class="col-sm-2">
                                   <strong class="p-title"><?php echo translate( 733, $lang);?></strong>
                               </div>
                               <div class="col-sm-2">
                                   <strong class="p-title"><?php echo translate( 736, $lang);?></strong>
                               </div>
                               <div class="col-sm-2">
                                   <strong class="p-title"><?php echo translate( 739, $lang);?></strong>
                               </div>
                               
                               <div class="col-sm-2">
                                   <strong class="p-title"><?php echo translate( 742, $lang);?></strong>
                               </div>
                               
                               <div class="col-sm-2">
                                   <strong class="p-title"><?php echo translate( 664, $lang);?></strong>
                               </div>
                               
                               
                                <div class="col-sm-2">
                                   <strong class="p-title"><?php echo translate( 667, $lang);?></strong>
                               </div>
                            </div> 
                            
                            
                            
                            
                            
                            <?php 
							
							if(!empty($items_count)){
							$logged = Auth::user()->id;
							$view_items = DB::table('products')
											->where('delete_status','=','')
											->where('lang_code','=',$lang)
											->where('user_id','=',$logged)
											->orderBy('item_id', 'desc')
											->get();
							foreach($view_items as $items)
							{
							
							/*$check_item_file = DB::table('product_metas')
								->where('item_token', '=' , $items->item_token)
								->where('item_meta_key', '=' , "item_type")
								
								->count();
						if(!empty($check_item_file))
						{
						   
							$item_meta_well = DB::table('product_metas')
								->where('item_token', '=' , $items->item_token)
								->where('item_meta_key', '=' , "item_type")
								
								->count();
								
							if(!empty($item_meta_well))
							{	
						   $item_meta = DB::table('product_metas')
								->where('item_token', '=' , $items->item_token)
								->where('item_meta_key', '=' , "item_type")
								
								->get();
							$free_status = $item_meta[0]->item_meta_value;
							}
							else
							{
							$free_status = "";
							}	
						}
						else
						{
						  $free_status = "";
						}*/
						$free_status = $items->item_type;
						
						if($lang == "en")
						  {
						    $item_id = $items->item_id; 
						  }
						  else
						  {
						     $item_id = $items->parent;
						  }	
											
							?>
                            
                            <div class="row single-cart">
                                
                               
                               <div class="col-sm-2">
                                    <div class="product-quantity">
                                        <div class="cart-count" align="center">
                                   <span class="vmiddle"> <?php echo $items->item_token;?></span>
                                   
                                   </div></div>
                                </div>
                            
                                
                                <div class="col-sm-2 no-padding">
                                <?php if($free_status=="yes"){?><div class="ribbon_new"><span><?php echo translate( 220, $lang);?></span></div><?php } ?>
                                    <div class="cart-prev" align="center">
                                    
                                    <?php if(!empty($items->preview_image)){?>
                                        <a href="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $items->item_slug;?>"><img src="<?php echo $url;?>/local/images/media/preview/<?php echo $items->preview_image;?>" alt=""></a>
                                    <?php } else { ?>  
                                    <a href="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $items->item_slug;?>"><img src="<?php echo $url;?>/local/images/noimage.jpg" alt=""></a>
                                    <?php } ?>  
                                    <p class="fontsize13"><a href="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $items->item_slug;?>"><?php echo $items->item_title;?></a></p>
                                    </div>
                                    
                                    
                                </div>
                                
                                <div class="col-sm-2">
                                    <div class="product-quantity">
                                        <div class="cart-count" align="center">
                                           <?php echo $items->regular_price_six_month;?> <?php echo $settings[0]->site_currency;?>
                                           <span class="fontsize12"><?php echo translate( 745, $lang);?></span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-2">
                                <div class="product-quantity">
                                        <div class="cart-count" align="center">
                                        <?php 
										$today_dates = date("Y-m-d");
										if($items->featured_enddate > $today_dates){
										
										if(empty($items->item_featured)){?>
                                    <a href="<?php echo $url;?>/featured/<?php echo $items->item_token;?>" class="featurebtn"><?php echo translate( 748, $lang);?></a>
                                    <?php } else { ?>
                                    <span class="custom-btn"> <?php echo translate( 751, $lang);?> </span>
                                    <?php } } else {  ?>
                                    <a href="<?php echo $url;?>/featured/<?php echo $items->item_token;?>" class="featurebtn"><?php echo translate( 748, $lang);?></a>
                                    <?php } ?>
                                    
                                  </div>
                                  </div>
                                </div>
                                
                                
                                <div class="col-sm-2">
                                    <div class="product-quantity">
                                        <div class="cart-count" align="center">
                                           
                                          <?php if(empty($items->item_status)){?><span style="color:#E11705;"> <?php echo translate( 754, $lang);?> </span><?php } else {?><span style="color:#0B9752;"> <?php echo translate( 670, $lang);?> </span><?php } ?>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                <div class="col-sm-2">
                                <div class="product-quantity">
                                        <div class="cart-count" align="center">
                                        <a href="<?php echo $url;?>/edit-item/<?php echo $items->item_token;?>" title="edit"><img src="<?php echo $url;?>/local/images/edit.png"></a>
                                <a href="<?php echo $url;?>/my-items/<?php echo $items->item_token;?>" onClick="return confirm('<?php echo translate( 304, $lang);?>');" title="delete"><img src="<?php echo $url;?>/local/images/delete.png"></a>
                                </div>
                                </div>
                                </div>
                            </div> 
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