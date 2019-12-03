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
	<title><?php echo translate( 25, $lang);?> - <?php echo translate( 217, $lang);?></title>



<script type="text/javascript">
    $(document).ready(function() {
        

        $(".listShow").cPager({
            pageSize: <?php echo $setts[0]->site_post_per;?>, 
            pageid: "welpager", 
            itemClass: "li-item",
			pageIndex: 1

        });
	});
    </script>	
</head>
<body class="index">

    <!-- fixed navigation bar -->
    @include('header')

    
    <div class="promo-area" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $setts[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="promo-text">
                        <h1 class="avigher-title bolder fontsize30"><?php echo translate( 217, $lang);?></h1>
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
                        <li class="breadcrumb-item active"><?php echo translate( 217, $lang);?></li>
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



    <div class="row listShow">
                <?php if(!empty($items_count)){
				
				$items = DB::table('products')
				->where('delete_status', '=', '')
				->where('item_status', '=', 1)
				->where('lang_code', '=', $lang)
				->orderBy('item_id', 'desc')->get();	
				foreach($items as $views){
				
				if($lang == "en")
						  {
						    $item_id = $views->item_id; 
						  }
						  else
						  {
						     $item_id = $views->parent;
						  }
						  
					$download_as = DB::table('products')->where('item_id','=',$item_id)->count();
					if(!empty($download_as))
					{	  
					$download_only = DB::table('products')->where('item_id','=',$item_id)->get();
					$view_download_as = $download_only[0]->downloaded;
					$view_like_as = $download_only[0]->liked;
					}
					else
					{
					$view_download_as = 0;
					$view_like_as = 0;
					}	  
				
				$user_count = DB::table('users')
						 ->where('id', '=', $views->user_id)
						 ->count();	
				if(!empty($user_count))
				{
				   $user_details = DB::table('users')
						 ->where('id', '=', $views->user_id)
						 ->get();
					$user_name = $user_details[0]->name;
					$user_slug = $user_details[0]->user_slug;	
					$user_photo = $user_details[0]->photo; 	
				}
				else
				{
				  $user_name = "";
				  $user_slug = "";
				  $user_photo = "";
				}
				
				
				
				
				$review_count_03 = DB::table('product_ratings')
				->where('item_id', '=', $item_id)
				->count();
				
				if(!empty($review_count_03))
				{
				$review_value_03 = DB::table('product_ratings')
				               ->where('item_id', '=', $item_id)
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
												
					
					
				/*$check_item_file = DB::table('product_metas')
		        ->where('item_token', '=' , $views->item_token)
				->where('item_meta_key', '=' , "item_type")
		        
				->count();
		if(!empty($check_item_file))
		{
		   
		    $item_meta_well = DB::table('product_metas')
		        ->where('item_token', '=' , $views->item_token)
				->where('item_meta_key', '=' , "item_type")
		        
				->count();
				
			if(!empty($item_meta_well))
			{	
		   $item_meta = DB::table('product_metas')
		        ->where('item_token', '=' , $views->item_token)
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
		
			$free_status = $views->item_type; 
				?>
                
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12 li-item">
                
                    <div class="item-demo">
                     <?php if($free_status=="yes"){?><div class="ribbon"><span><?php echo translate( 220, $lang);?></span></div><?php } ?>
                        <figure>
                            
                            <?php if(!empty($views->preview_image)){?>
                            <img src="<?php echo $url;?>/local/images/media/preview/<?php echo $views->preview_image;?>" alt="{{$views->item_title}}">
                            <?php } else { ?>
                             <img src="<?php echo $url;?>/local/images/noimage.jpg" alt="No Image">
                             <?php } ?>
                            
                            <div class="product-caption">
                                <div class="caption-cel">
                                    <div class="product-link">
                                        <div>
                                            <div>
                                                <a href="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $views->item_slug;?>" class="radiusoff"><?php echo translate( 223, $lang);?> <span><i class="fa fa-eye"></i></span></a>
                                            </div>
                                            <?php /*?><div>
                                                <a href="<?php echo $url;?>/cart" class="radiusoff">Add to Cart<span><i class="fa fa-shopping-cart"></i></span></a>
                                            </div><?php */?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </figure>
                        <div class="product-info">
                            <div class="product-header">
                            	<div class="row pl-3 pr-3">
                                <h3 class="product-name custom_tittle col-md-8 paddingoff homenew"><a href="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $views->item_slug;?>"><?php echo $views->item_title;?></a> </h3>
                                <span class="alink col-md-4 paddingoff text-right">
                                	

                               @if($site_setting[0]->site_currency == "USD")
                                	${{$views->regular_price_six_month}}
                                @else
                                	{{$site_setting[0]->site_currency}}
                                	{{$views->regular_price_six_month}}
                                @endif

                                	</span>
							   </div>

                                <span class="p-author">
                                    <a href="<?php echo $url;?>/<?php echo $user_slug;?>" class="auth_texter"><?php if(!empty($user_photo)){?><img src="<?php echo $url;?>/local/images/media/userphoto/<?php echo $user_photo;?>" alt="<?php echo $user_name;?>" border="0" class="roundshape" style="width:30px; border-radius:50px;" /><?php } else { ?><img src="<?php echo $url;?>/local/images/nophoto.jpg" alt="<?php echo $user_name;?>" border="0" class="roundshape" style="width:30px; border-radius:50px;" /><?php } ?> <?php echo $user_name;?></a>
                                </span>
                            </div>
                            <div class="product-meta">
                                <span class="meta-download">
                                    <i class="fa fa-cloud-download"></i><?php echo $view_download_as;?>
                                </span>
                                <span class="meta-love">
                                    <i class="fa fa-heart"></i><?php echo $view_like_as;?>
                                </span>
                                <span class="meta-rating">
                                    <?php if(!empty($review_count_03)){ echo $rateus_new_03; } else { echo $rateus_empty_03; }?> 
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <?php } } ?>
            </div>
    <div class="turn-page" id="welpager"></div>
    
    
</div>
<div class="clearfix"></div>
</main>
	

	
	
      @include('footer')
  
</body>
</html>