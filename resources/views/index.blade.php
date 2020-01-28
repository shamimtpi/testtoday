<!--<center style="    background: #0976c2;-->
<!--    color: #fff;">Website Currently Maintaince Mode</center>-->



<?php
	use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();	
$url = URL::to("/");
$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		$headertype = $setts[0]->header_type;
		$default = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }

	?>
<!DOCTYPE html>

<html class="no-js"  lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">

		
   
   @include('style')
   <title><?php echo translate( 25, $lang);?> - <?php echo translate( 40, $lang);?></title>






   <?php /****** feature item ******/?>
<link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/owl-carousel/1.3.3/owl.carousel.min.css'>
<link rel="stylesheet" href="<?php echo $url;?>/local/resources/views/theme/carousel/style.css">

<?php /******* feature item **********/?>  




</head>
<body>

 @include('header')
    

  
    <section class="home_banner" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $setts[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="avigher-wrap searchhome">
                        <h1 class="avigher-title"><?php echo translate( 31, $lang);?></h1>
                        <p class="avigher-intro"><?php echo translate( 34, $lang);?></p>
                       
                        
                       <div class="row justify-content-center">
                        
                        <div class="col-md-6 paddingoff">
                        
                            <input type="text" name="search" id="searchtext" placeholder="<?php echo translate( 43, $lang);?>">
                       </div>
                       
                       <div class="col-md-2 paddingoff">    
                            <input type="button" id="btnclick" value="<?php echo translate( 46, $lang);?>" />
                       </div> 
                       
                       </div>

                       <a href="{{url::to('php-online-editor')}}" class="btn btn-success mt-5">PHP Online Editor</a>
                        
                        
                        <div class="clearfix height30"></div>

                        

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- CodePopular AREA END HERE -->
    <section class="share_script">
       <div class="text-white " style="background: #051f39">
		<div class="container text-center">	
					<div class="row justify-content-center">
						<div class="wrapper col-md-12 m-t-sm m-b-sm text-center">
				          <span class=" h3 link-info  pt-6 "><a class="d-inline-block" style="padding:20px 0px" href="@if(!Auth::check()){{route('register')}}@endif">Create an Account</a> to Share Your <strong>Free Script</strong>	
								          				
				        </span></div>
					</div>	
				
		</div>	
		
	</div>
 </section>


    <!-- FREATURE PRODUCT AREA START HERE -->
    <section class="feature-product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-intro">
                        <h2 class="section-title"><?php echo translate( 49, $lang);?></h2>
                    </div>
                </div>
            </div>
            <div class="height20"></div>
            
            
            <?php if($site_feature_view == "normal"){?>
            <div class="row">
                <?php if(!empty($featured_count)){
				$today_date = date("Y-m-d");
				$featured = DB::table('products')
				->where('item_featured', '=', 1)
				->where('lang_code','=',$lang)
				->where('delete_status', '=', '')
				->where('item_status', '=', 1)
				->where('featured_enddate', '>=', $today_date)
				->orderBy('item_id', 'desc')->take($sett_feature_item)->get();
				foreach($featured as $views){
				
				if($lang == "en")
				{
				   $texter = $views->item_id;
				}
				else
				{
				  $texter = $views->parent;
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
				?>
                <div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
                    <div class="item-demo">
                        <figure>
                            
                            <?php if(!empty($views->preview_image)){?>
                            <img src="<?php echo $url;?>/local/images/media/preview/<?php echo $views->preview_image;?>" alt="<?php echo $views->item_title;?>">
                            <?php } else { ?>
                             <img src="<?php echo $url;?>/local/images/noimage.jpg" alt="No Image">
                             <?php } ?>
                            
                            <div class="product-caption">
                                <div class="caption-cel">
                                    <div class="product-link">
                                        <div>
                                            <div>
                                                <a href="<?php echo $url;?>/item/<?php echo $texter;?>/<?php echo $views->item_slug;?>">View Details <span><i class="fa fa-eye"></i></span></a>
                                            </div>
                                            <?php /*?><div>
                                                <a href="<?php echo $url;?>/cart">Add to Cart<span><i class="fa fa-shopping-cart"></i></span></a>
                                            </div><?php */?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </figure>
                        <div class="product-info">
                        <div class="product-header">
							<div class="row pl-3 pr-3">
                                <h3 class="product-name custom_tittle col-md-8 paddingoff homenew">
                                	<a href="<?php echo $url;?>/item/<?php echo $texter;?>/<?php echo $views->item_slug;?>"><?php echo $views->item_title;?>
                                		
                                	</a> 
                                </h3>
                                <span class="alink col-md-4 paddingoff text-right">
                                @if($site_setting[0]->site_currency == "USD")
                                	${{$views->regular_price_six_month}}
                                @else
                                	{{$site_setting[0]->site_currency}}
                                @endif
																				
                                </span>
							     </div>

                                <span class="p-author">
                                    <a href="<?php echo $url;?>/<?php echo $user_slug;?>" class="auth_texter"><?php if(!empty($user_photo)){?><img src="<?php echo $url;?>/local/images/media/userphoto/<?php echo $user_photo;?>" alt="<?php echo $user_name;?>" border="0" class="roundshape" style="width:30px; border-radius:50px;" /><?php } else { ?><img src="<?php echo $url;?>/local/images/nophoto.jpg" alt="<?php echo $user_name;?>" border="0" class="roundshape" style="width:30px; border-radius:50px;" /><?php } ?> <?php echo $user_name;?></a>
                                </span>
                            </div>
                        
                            <div class="product-meta">
                                <span class="meta-download">
                                    <i class="fa fa-cloud-download"></i><?php echo $views->downloaded;?>
                                </span>
                                <span class="meta-love">
                                    <i class="fa fa-heart"></i><?php echo $views->liked;?>
                                </span>
                                <span class="meta-love" style="padding-left:8px">
                                    <i class="fa fa-eye"></i>{{$views->view_count}}
                                </span>
                                 
                                <?php
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
                <span class="meta-rating">
                                    <?php if(!empty($review_count_03)){ echo $rateus_new_03; } else { echo $rateus_empty_03; }?> 
                                </span>
								
                            </div>
                        </div>
                    </div>
                </div>
                
                
                <?php } } ?>
            </div>
            
            <?php } else { ?>
            
            
            
            <div class="row">
            
            <div class="owl-carousel feature_item" style="margin-left:7px;">
           
           <?php 
			
			if(!empty($featured_count)){
				$today_date = date("Y-m-d");
				$featured = DB::table('products')
				->where('item_featured', '=', 1)
				->where('lang_code','=',$lang)
				->where('delete_status', '=', '')
				->where('item_status', '=', 1)
				->where('featured_enddate', '>=', $today_date)
				->orderBy('item_id', 'desc')->take($sett_feature_item)->get();
				foreach($featured as $viewer){
				
				if($lang == "en")
				{
				   $texter = $viewer->item_id;
				}
				else
				{
				  $texter = $viewer->parent;
				}
				
				?>
                <div class="item">
                  <?php if(!empty($viewer->preview_image)){?>
                  
                  
                            <a href="<?php echo $url;?>/item/<?php echo $texter;?>/<?php echo $viewer->item_slug;?>"><img src="<?php echo $url;?>/local/images/media/thumbnail/<?php echo $viewer->item_thumbnail;?>" alt="{{$viewer->item_title}}" ></a>
                            
                            <?php } else { ?>
                             <a href="<?php echo $url;?>/item/<?php echo $texter;?>/<?php echo $viewer->item_slug;?>"><img src="<?php echo $url;?>/local/images/noimage.jpg" alt="No image" ></a>
                             <?php } ?>
               </div>
             <?php } } ?>
           
          </div>
            
            
            
            
               
            </div>
            
            <?php } ?>
            <div class="height30"></div>
            <div class="product-button">
                        <button onClick="window.location.href='<?php echo $url;?>/featured-items'" class="custom-btn"><?php echo translate( 52, $lang);?></button>
                    </div>
            
        </div>
    </section>

    <!-- ENd FEATURED PROUDUCT AREA -->
    
    

    <!-----------------------------------
            START LATEST ITEM AREA 
     ------------------------------------>

    <section class="new-product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-intro">
                        <h2 class="section-title"><?php echo translate( 55, $lang);?></h2>
                    </div>
                </div>
            </div>
            
         <div class="row justify-content-center flex-nowrap">
			<div class="center">
				<div id="demo" class="box jplist">
					<!-- panel -->
					<div class="jplist-panel box panel-top col-md-12" align="center">						
						<?php
					$item_per = $site_setting[0]->site_latest_item;
					$cate_cnts = DB::table('product_categories')
								 ->where('delete_status','=','')
								 ->where('status','=',1)
								 ->where('cat_type','=','default')
								 ->where('lang_code','=',$lang)
								 ->orderBy('cat_name','asc')
								 ->take($item_per)
								 ->count();
								 
					if(!empty($cate_cnts))
					{
					
					$views_category = DB::table('product_categories')
								 ->where('delete_status','=','')
								 ->where('status','=',1)
								 ->where('cat_type','=','default')
								 ->where('lang_code','=',$lang)
								 ->take($item_per)
								 ->orderBy('cat_name','asc')
								 ->get();
					$i=1;			 	
					foreach($views_category as $views)
					{	
					if($lang == "en")
						  {
						    $cat_id = $views->id; 
						  }
						  else
						  {
						     $cat_id = $views->parent;
						  }			 		 
					?>					
						<button
							type="button"									
							data-control-type="button-filter"
							data-control-action="filter"
							data-control-name="<?php echo $cat_id;?>-btn" 
							data-path=".<?php echo $cat_id;?>_cat" 
							 class="latest_item">
								
								<?php echo $views->cat_name;?>
							</button>
											
					<?php $i++; } } ?>	
						
					</div>	
					
					 <div class="height20"></div>
					<div class="mobile row justify-content-center">
						
						<?php
						$item_per_count = $site_setting[0]->site_latest_item_count;
                         $items_count = DB::table('products')
											->where('delete_status', '=', '')
											->where('item_status', '=', 1)
											->where('lang_code','=',$lang)
											->take($item_per_count)
											->orderBy('item_id', 'desc')
											->count();
										if(!empty($items_count))
										{		
										$items = DB::table('products')
											->where('delete_status', '=', '')
											->where('item_status', '=', 1)
											->where('lang_code','=',$lang)
											->take($item_per_count)
											->orderBy('item_id', 'desc')
											->get();	
											foreach($items as $views){
											
											 if($lang == "en")
											  {
												$item_id = $views->item_id; 
											  }
											  else
											  {
												 $item_id = $views->parent;
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
											}
											else
											{
											  $user_name = "";
											  $user_slug = "";
											}
											?>
                                          
						<div class="latest_item_grid ntip_trigger">
							<?php if(!empty($views->preview_image)){?>

                           <a href="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $views->item_slug;?>"> <img src="<?php echo $url;?>/local/images/media/thumbnail/<?php echo $views->item_thumbnail;?>" alt="{{$views->item_title}}" style="max-width:80px;width:100%; height:80px;">

                           <?php
						   /* item meta */
		$check_item_meta = DB::table('product_metas')
		        ->where('item_token', '=' , $views->item_token)
				->where('item_meta_key', '=' , "item_video_preview")
		        
				->count();
		if(!empty($check_item_meta))
		{
		   
		    $item_meta_well = DB::table('product_metas')
		        ->where('item_token', '=' , $views->item_token)
				->where('item_meta_key', '=' , "item_video_preview")
		        
				->count();
				
			if(!empty($item_meta_well))
			{	
		   $item_meta = DB::table('product_metas')
		        ->where('item_token', '=' , $views->item_token)
				->where('item_meta_key', '=' , "item_video_preview")
		        
				->get();
			$video_status = $item_meta[0]->item_meta_value;
			}
			else
			{
			$video_status = "";
			}	
		}
		else
		{
		  $video_status = "";
		}
		
		
		/* item meta */
						
		
						   ?>
                           
                           
                           <span class="ntip">
                           <?php if(!empty($video_status)){ if($views->item_script_type=="code"){ if($site_file_upload_by == "s3_server") { 
						   $vidName = Storage::disk('s3')->url($video_status);
						   ?>
                           <video width="100%" height="240" autoplay controls loop muted>
  <source src="<?php echo $vidName;?>" type="video/mp4">
  
  Your browser does not support the video tag.
</video>
<?php } else { ?>
<video width="100%" height="240" autoplay controls loop muted>
  <source src="<?php echo $url;?>/local/images/media/video/<?php echo $video_status;?>" type="video/mp4">
  
  Your browser does not support the video tag.
</video>


                           <?php } } else { ?>
                           
	       <div>
	       	<img src="<?php echo $url;?>/local/images/media/preview/<?php echo $views->preview_image;?>" height="250" alt="" />
	       </div>
	       
                           <?php } } else { ?>
        <div>
        	<img src="<?php echo $url;?>/local/images/media/preview/<?php echo $views->preview_image;?>" height="250" alt="" />
        </div>
        <?php } ?>

		<div class="row">
	        <div class="col-md-8" align="left">
	        <div class="titleitem"><?php echo $views->item_title;?></div>
		        <span class="authorr">
		        	<?php echo translate( 61, $lang);?> <?php echo $user_name;?>
		        </span>
	        </div>

	        <div class="col-md-4" align="right">
	        <div class="currrency">
	        	<?php echo $views->regular_price_six_month;?> <?php echo $site_setting[0]->site_currency;?>
	        </div>
	        <span class="authorr_right"><?php echo translate( 58, $lang);?> <?php echo $site_setting[0]->site_currency;?></span>
	        </div>
        </div>
        
        </span> 
           </a>
                            <?php } else { ?>
       <a href="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $views->item_slug;?>"> <img src="<?php echo $url;?>/local/images/noimage.jpg" alt="">

      
      <span class="ntip">
	        <img src="<?php echo $url;?>/local/images/noimage.jpg" height="250" alt="" />
	        <div class="row">
		        <div class="col-md-8" align="left">
		        <div class="titleitem"><?php echo $views->item_title;?></div>
		        <span class="authorr"><?php echo translate( 61, $lang);?> <?php echo $user_name;?></span>
		        </div>
		        <div class="col-md-4" align="right">
		        <div class="currrency"><?php echo $views->regular_price_six_month;?> <?php echo $site_setting[0]->site_currency;?></div>
		        <span class="authorr_right"><?php echo translate( 58, $lang);?> <?php echo $site_setting[0]->site_currency;?></span>

		        </div>
	        </div>
        </span> 
            </a>
        <?php } ?>
			 
						<p class="theme" style="display:none;">
                                <?php 
								$array_checkin =  explode(',', $views->category);
								?>
                                
                                <?php foreach($array_checkin as $checkin){?>
								<span class="<?php echo $checkin;?>"><?php echo $checkin;?></span>
								<?php } ?>
							</p>

						</div>
					<?php } } ?>
					
						
					</div>
				</div>
			</div>		
		</div>
                
                
            
           </div> 

    </section>
    
    <!------------------------------------------
              END LATEST ITEM AREA 
     -------------------------------------------->
    
      <div class="full_line container-fluid"></div>
  
 <!-- Start Free Item Area -->
  <section class="section-padding">
           <?php 
		   $item_meta_cc = DB::table('product_metas')
		           		  ->where('item_meta_key', '=' , "item_type")
		                  ->where('item_meta_value', '=' , "yes")
				          ->count(); ?>

          <div class="container">   <!-- Free item heading -->
            <div class="row">
               <div class="col-md-12">
                    <div class="section-intro">
                        <h2 class="section-title"><?php echo translate( 64, $lang);?></h2>
                    
                    </div>
                </div>
           </div>     
         </div>                     <!--End Free Item Heading-->
         <div class="height20"></div>

         <div class="container">
	         
			         <div class="mobile row justify-content-center">
			          <?php if(!empty($items_counted)){
							
							$items = DB::table('products')
							->where('delete_status', '=', '')
							->where('item_status', '=', 1)
							->where('item_type', '=', "yes")
							->where('lang_code', '=', $lang)
							->orderBy('item_id', 'desc')
					        ->limit(20)
							->get();	
							foreach($items as $views){
							
							if($lang == "en")
									  {
									    $item_id = $views->item_id; 
									  }
									  else
									  {
									     $item_id = $views->parent;
									  }
									  
									  $item_slug = $views->item_slug;
									  $item_thumbnail = $views->item_thumbnail;
					
							?>
			                 
			                <div class="latest-item-grid ntip_trigger_new">
			                          @if(!empty($item_thumbnail))
			                           <a href="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $item_slug;?>"> 
			                           	<img src="{{$url}}/local/images/media/thumbnail/{{$item_thumbnail}}" alt="{{$views->item_title}}" style="max-width:80px;width:100%; height:80px;">
			                             
			                           </a>
			                            @endif
										
			                             
			               </div>
			               <?php  } } ?> 
					
			        </div>
       </div>
            
            
            <div class="height20"></div>
            <div class="product-button">
                        <button onClick="window.location.href='<?php echo $url;?>/free-items'" class="custom-btn"><?php echo translate( 67, $lang);?></button>
                    </div>
             <div class="height20"></div>
      
     </section>
    
    <!--End Free Item Section-->

  
   
    <!-- PROMO AREA START HERE -->
    <section class="<?php if($site_feed == "on") {?>feature-product-area<?php } else { ?>promo-area<?php } ?> section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo">
                        <span class="promo-icon"><i class="fa <?php echo $site_setting[0]->promo_icon_1;?>"></i></span>
                        <h3 class="promo-heading"><?php echo translate( 1, $lang);?></h3>
                        <p><?php echo translate( 4, $lang);?></p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo">
                        <span class="promo-icon"><i class="fa <?php echo $site_setting[0]->promo_icon_2;?>"></i></span>
                        <h3 class="promo-heading"><?php echo translate( 7, $lang);?></h3>
                        <p><?php echo translate( 10, $lang);?></p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo">
                        <span class="promo-icon"><i class="fa <?php echo $site_setting[0]->promo_icon_3;?>"></i></span>
                        <h3 class="promo-heading">	<?php echo translate( 13, $lang);?></h3>
                        <p><?php echo translate( 16, $lang);?></p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo">
                        <span class="promo-icon"><i class="fa <?php echo $site_setting[0]->promo_icon_4;?>"></i></span>
                        <h3 class="promo-heading"><?php echo translate( 19, $lang);?></h3>
                        <p><?php echo translate( 22, $lang);?></p>
                    </div>
                </div>
                
                
            </div>
        </div>
    </section>
    <!-- PROMO AREA END HERE -->
    
    
    
    
    <?php 
	if($site_setting[0]->site_blog_visible=="yes")
	{
	
	if(!empty($blogs_cnt)){?>
    
     <section class="choose-us-area section-padding">
    <div class="container">
    <div class="row">
     <div class="section-intro">
                        <h2 class="section-title"><?php echo translate( 73, $lang);?></h2>
                        
                    </div>
    </div>
    <div class="height20"></div>
	<div class="row">
    
                           <?php foreach($blogs as $blog){?>
                           
                            <div class="col-md-4">
                            <div class="single_blog_item">
                            <?php if($blog->post_media_type=="image"){
							
							  if(!empty($blog->post_image))
							  {
							     $img_url = $url.'/local/images/media/blog/'.$blog->post_image; 
							  }
							  else
							  {
							  $img_url = $url.'/local/images/noimage.jpg';
							  }
							?>
                            
                                <div class="entry-media">
                                    <img src="<?php echo $img_url;?>" alt="{{$blog->post_title}}">
                                </div>
                                
                            <?php } else if($blog->post_media_type=="mp3"){?>  
                             <div class="entry-media">
                                    <div class="mediPlayer" align="center">
    				<audio class="listen" preload="none" data-size="188" src="<?php echo $url;?>/local/images/media/blog/<?php echo $blog->post_audio;?>"></audio>
					</div>
                                </div>
                                
                            <?php } else if($blog->post_media_type=="video"){?>  
                            <div class="entry-media">
                                    
                                     <?php
					if (strpos($blog->post_video, 'youtube') > 0) {
					 $vurl = $blog->post_video;
						preg_match('/[\\?\\&]v=([^\\?\\&]+)/', $vurl, $matches);
						$id = $matches[1];
						
						$height = '188px';
					?>
                    <iframe id="ytplayer" type="text/html" width="100%" height="<?php echo $height ?>" src="https://www.youtube.com/embed/<?php echo $id ?>?rel=0&showinfo=0&color=white&iv_load_policy=3" frameborder="0" allowfullscreen></iframe>
                    
                    <?php } 
					if (strpos($blog->post_video, 'vimeo') > 0) {
					$vimeo = $blog->post_video;
					?>
                    
                    <iframe src="https://player.vimeo.com/video/<?php echo (int) substr(parse_url($vimeo, PHP_URL_PATH), 1);?>" width="100%" height="188" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                    
					<?php }?>
                     </div>
                              <?php } ?>      
                                    
                                    
                               
                               
                              
                                <div class="entry-body">
                                    <?php 
							$date = $blog->post_date;
					
					$old_date = strtotime($date);
					$dateonly = date('d M Y', $old_date);
					?>
                                    <h3><a href="<?php echo $url;?>/blog/<?php echo $blog->post_slug;?>"><?php echo $blog->post_title;?></a></h3>
                                    <p><?php echo substr(strip_tags(html_entity_decode($blog->post_desc)),0,128).'..';?></p>
                                    <div class="read-more-date">
                                        <a href="<?php echo $url;?>/blog/<?php echo $blog->post_slug;?>"><?php echo translate( 76, $lang);?></a>
                                        <span class="date"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $dateonly;?></span>
                                    </div>
                                </div>








                            </div>
                            </div>
                           
                         <?php } ?>   
                            
	</div>
</div>
    
    </section>
    
    <?php } } ?>


      @include('footer')
      
      
</body>
</html>