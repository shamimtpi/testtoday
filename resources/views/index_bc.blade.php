<?php
	use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();	
$url = URL::to("/");
$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		$headertype = $setts[0]->header_type;
	?>
<!DOCTYPE html>

<html class="no-js"  lang="en">
<head>

		

   @include('style')
   

<script>
    document.getElementById('viid').play();
</script>


</head>
<body>

   

   
    @include('header')
    
  
    
    <section class="home_banner" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $setts[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="avigher-wrap searchhome">
                        <h2 class="avigher-title"><?php echo $setts[0]->site_banner_heading;?></h2>
                        <p class="avigher-intro"><?php echo $setts[0]->site_banner_subheading;?></p>
                       
                        <div class="col-md-12">
                        
                        <div class="col-md-2"></div>
                       <div class="col-md-8">
                        
                        <div class="col-md-10 paddingoff">
                        
                            <input type="text" name="search" id="searchtext" placeholder="Search your Items">
                       </div>
                       
                       <div class="col-md-2 paddingoff">    
                            <input type="button" id="btnclick" value="Search" />
                       </div> 
                       
                       </div>
                       
                       <div class="col-md-2"></div>
                       
                       </div>
                        
                        
                        <div class="clearfix height30"></div>

                        

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- avigher AREA END HERE -->

    <!-- FREATURE PRODUCT AREA START HERE -->
    <section class="feature-product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-intro">
                        <h2 class="section-title">Featured Items</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <?php if(!empty($featured_count)){
				$today_date = date("Y-m-d");
				$featured = DB::table('products')
				->where('item_featured', '=', 1)
				->where('delete_status', '=', '')
				->where('item_status', '=', 1)
				->where('featured_enddate', '>=', $today_date)
				->orderBy('item_id', 'desc')->take($sett_feature_item)->get();
				foreach($featured as $views){
				
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
                <div class="col-md-4 col-sm-4">
                    <div class="item-demo">
                        <figure>
                            
                            <?php if(!empty($views->preview_image)){?>
                            <img src="<?php echo $url;?>/local/images/media/<?php echo $views->preview_image;?>" alt="">
                            <?php } else { ?>
                             <img src="<?php echo $url;?>/local/images/noimage.jpg" alt="">
                             <?php } ?>
                            
                            <div class="product-caption">
                                <div class="caption-cel">
                                    <div class="product-link">
                                        <div>
                                            <div>
                                                <a href="<?php echo $url;?>/item/<?php echo $views->item_id;?>/<?php echo $views->item_slug;?>">View Details <span><i class="fa fa-eye"></i></span></a>
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
                                <h3 class="product-name custom_tittle col-md-8 paddingoff"><a href="<?php echo $url;?>/item/<?php echo $views->item_id;?>/<?php echo $views->item_slug;?>"><?php echo $views->item_title;?></a> </h3><span class="alink col-md-4 paddingoff text-right"><?php echo $views->regular_price_six_month;?> <?php echo $site_setting[0]->site_currency;?></span>
                                <span class="p-author">
                                    <a href="<?php echo $url;?>/<?php echo $user_slug;?>" class="auth_texter"><?php if(!empty($user_photo)){?><img src="<?php echo $url;?>/local/images/media/<?php echo $user_photo;?>" alt="<?php echo $user_name;?>" border="0" class="roundshape" style="width:30px; border-radius:50px;" /><?php } else { ?><img src="<?php echo $url;?>/local/images/nophoto.jpg" alt="<?php echo $user_name;?>" border="0" class="roundshape" style="width:30px; border-radius:50px;" /><?php } ?> <?php echo $user_name;?></a>
                                </span>
                            </div>
                        
                            <div class="product-meta">
                                <span class="meta-download">
                                    <i class="fa fa-cloud-download"></i><?php echo $views->downloaded;?>
                                </span>
                                <span class="meta-love">
                                    <i class="fa fa-heart"></i><?php echo $views->liked;?>
                                </span>
                                <?php
								$review_count_03 = DB::table('product_ratings')
				->where('item_id', '=', $views->item_id)
				->count();
				
				if(!empty($review_count_03))
				{
				$review_value_03 = DB::table('product_ratings')
				               ->where('item_id', '=', $views->item_id)
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
            
            <div class="product-button">
                        <button onClick="window.location.href='<?php echo $url;?>/featured-items'" class="custom-btn">View All Featured Items</button>
                    </div>
            
        </div>
    </section>
    
    
    
    
    
    

    <!-- NEW PRODUCT AREA START HERE -->
    <section class="new-product-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-intro">
                        <h2 class="section-title">Latest Items</h2>
                    </div>
                </div>
            </div>
            
            
            
            <div class="row">
                
                
                
                <div class="box">
			<div class="center">
				
				<div id="demo" class="box jplist">
				
					
					
					<div class="height20 clearfix"></div>
					<!-- panel -->
					<div class="jplist-panel box panel-top col-md-12" align="center">						
						<?php
					$item_per = $site_setting[0]->site_latest_item;
					$cate_cnts = DB::table('product_categories')
								 ->where('delete_status','=','')
								 ->where('status','=',1)
								 ->orderBy('cat_name','asc')
								 ->take($item_per)
								 ->count();
					if(!empty($cate_cnts))
					{
					
					$views_category = DB::table('product_categories')
								 ->where('delete_status','=','')
								 ->where('status','=',1)
								 ->take($item_per)
								 ->orderBy('cat_name','asc')
								 ->get();
					$i=1;			 	
					foreach($views_category as $views)
					{			 		 
					?>					
						<button
							type="button"									
							data-control-type="button-filter"
							data-control-action="filter"
							data-control-name="<?php echo $views->id;?>-btn" 
							data-path=".<?php echo $views->id;?>_cat" 
							 class="latest_item">
								
								<?php echo $views->cat_name;?>
							</button>
											
					<?php $i++; } } ?>	
						
					</div>				 
					
					 
                     
                     <div class="height50 clearfix"></div>
					<div class="list box text-shadow">
						
						<?php
						$item_per_count = $site_setting[0]->site_latest_item_count;
                         $items_count = DB::table('products')
											->where('delete_status', '=', '')
											->where('item_status', '=', 1)
											->take($item_per_count)
											->orderBy('item_id', 'desc')
											->count();
										if(!empty($items_count))
										{		
										$items = DB::table('products')
											->where('delete_status', '=', '')
											->where('item_status', '=', 1)
											->take($item_per_count)
											->orderBy('item_id', 'desc')
											->get();	
											foreach($items as $views){
											
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
                                            
                                            
                                            
						<div class="list-item box">
                        
                        
						<div class="col-md-2 latest_item_grid ntip_trigger" style="position:inherit !important;">
                        
                                               
							<?php if(!empty($views->preview_image)){?>
                           <a href="<?php echo $url;?>/item/<?php echo $views->item_id;?>/<?php echo $views->item_slug;?>"> <img src="<?php echo $url;?>/local/images/media/<?php echo $views->item_thumbnail;?>" alt="" style="min-width:165px; height:165px;">
                           
                           
                           
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
                           <?php if(!empty($video_status)){?>
                           <video autoplay muted loop controls  width="100%" height="240" id="viid">
  <source src="<?php echo $url;?>/local/images/media/<?php echo $video_status;?>" type="video/mp4">
  
  Your browser does not support the video tag.
</video>
                           <?php } else { ?>
        <div><img src="<?php echo $url;?>/local/images/media/<?php echo $views->preview_image;?>" height="250" alt="" /></div>
        <?php } ?>
        <div class="col-md-8" align="left">
        <div class="titleitem"><?php echo $views->item_title;?></div>
        <span class="authorr">by <?php echo $user_name;?></span>
        </div>
        <div class="col-md-4" align="right">
        <div class="currrency"><?php echo $views->regular_price_six_month;?> <?php echo $site_setting[0]->site_currency;?></div>
        <span class="authorr_right">All prices are in <?php echo $site_setting[0]->site_currency;?></span>
        </div>
        
        </span> 
                           </a>
                            <?php } else { ?>
                            <a href="<?php echo $url;?>/item/<?php echo $views->item_id;?>/<?php echo $views->item_slug;?>"> <img src="<?php echo $url;?>/local/images/noimage.jpg" alt="">
                              <span class="ntip">
        <div><img src="<?php echo $url;?>/local/images/noimage.jpg" height="250" alt="" /></div>
        <div class="col-md-8" align="left">
        <div class="titleitem"><?php echo $views->item_title;?></div>
        <span class="authorr">by <?php echo $user_name;?></span>
        </div>
        <div class="col-md-4" align="right">
        <div class="currrency"><?php echo $views->regular_price_six_month;?> <?php echo $site_setting[0]->site_currency;?></div>
        <span class="authorr_right">All prices are in <?php echo $site_setting[0]->site_currency;?></span>
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
							
						</div>
						
						<?php } } ?>
						
						
					</div>
				</div>
			</div>		
		</div>
                
                
                
                
                
                
                
                
            </div>
        </div>
    </section>
    <!-- FEATEAR AREA END HERE -->

   

    <!-- CHOOSING AREA START HERE -->
    <?php if(!empty($rate_count)){?>
    <section class="choose-us-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="section-intro">
                        <h2 class="section-title">CUSTOMER FEEDBACK</h2>
                        
                    </div>
                    
                    
                    
                    
                    <div class='row'>
                    <div class='col-md-1'></div>
    <div class='col-md-10'>
      <div class="carousel slide" data-ride="carousel" id="quote-carousel">
       
        <ol class="carousel-indicators">
          <?php
	 $kj=1;
	 foreach($rate as $rate_view){
	 
	 ?>
          <li data-target="#quote-carousel" data-slide-to="0" class="<?php if($kj==1){?>active<?php } ?>"></li>
     <?php $kj++;} ?>     
        </ol>
        
       
        <div class="carousel-inner">
     
     <?php
	 $ij=1;
	 foreach($rate as $rateview){
	 $user_rating = DB::table('users')
				      ->where('id','=', $rateview->user_id)
				      ->get();	
	 ?>
          <div class="item <?php if($ij==1){?>active<?php } ?>">
            <blockquote>
              <div class="row">
                <div class="col-sm-3 text-center">
                <?php if(!empty($user_rating[0]->photo)){?>
                  <img class="img-circle" src="<?php echo $url;?>/local/images/media/<?php echo $user_rating[0]->photo;?>" style="width: 100px;height:100px;">
                  <?php } else { ?>
                   <img class="img-circle" src="<?php echo $url;?>/local/images/nophoto.jpg" style="width: 100px;height:100px;">
                   <?php } ?>
                </div>
                <div class="col-sm-9">
                  <p><?php echo $rateview->review;?></p>
                  
                  <?php if($rateview->rating==1){?>
                                                        <div class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                    </span>
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </div><?php } ?>
                                                <?php if($rateview->rating==2){?>
                                                        <div class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                    </span>
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </div><?php } ?>
                                                <?php if($rateview->rating==3){?>
                                                        <div class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                    </span>
                                                    
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </div><?php } ?>
                                                
                                                <?php if($rateview->rating==4){?>
                                                        <div class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                     <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                    </span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                </div><?php } ?>
                                                    <?php if($rateview->rating==5){?>
                                                        <div class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                     <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                     <i class="fa fa-star yellow" aria-hidden="true"></i>
                                                    </span>
                                                    
                                                </div><?php } ?> 
                           
                                 <div class="height10"></div>
                  <small><a href="<?php echo $url;?>/user/<?php echo $user_rating[0]->user_slug;?>" class="feedback_user"><?php echo $user_rating[0]->name;?></a></small>
                </div>
              </div>
            </blockquote>
          </div>
      <?php $ij++; } ?>
      
        </div>
        
        
        <a data-slide="prev" href="#quote-carousel" class="left carousel-control"><i class="fa fa-chevron-left"></i></a>
        <a data-slide="next" href="#quote-carousel" class="right carousel-control"><i class="fa fa-chevron-right"></i></a>
      </div>                          
    </div>
          <div class='col-md-1'></div>          
                    
                    
                    
                </div>
            </div>
        </div>
    </section>
    <?php } ?>

   

    <!-- PROMO AREA START HERE -->
    <section class="promo-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo">
                        <span class="promo-icon"><i class="fa <?php echo $site_setting[0]->promo_icon_1;?>"></i></span>
                        <h3 class="promo-heading"><?php echo $site_setting[0]->promo_title_1;?></h3>
                        <p><?php echo $site_setting[0]->promo_desc_1;?></p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo">
                        <span class="promo-icon"><i class="fa <?php echo $site_setting[0]->promo_icon_2;?>"></i></span>
                        <h3 class="promo-heading"><?php echo $site_setting[0]->promo_title_2;?></h3>
                        <p><?php echo $site_setting[0]->promo_desc_2;?></p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo">
                        <span class="promo-icon"><i class="fa <?php echo $site_setting[0]->promo_icon_3;?>"></i></span>
                        <h3 class="promo-heading"><?php echo $site_setting[0]->promo_title_3;?></h3>
                        <p><?php echo $site_setting[0]->promo_desc_3;?></p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6">
                    <div class="single-promo">
                        <span class="promo-icon"><i class="fa <?php echo $site_setting[0]->promo_icon_4;?>"></i></span>
                        <h3 class="promo-heading"><?php echo $site_setting[0]->promo_title_4;?></h3>
                        <p><?php echo $site_setting[0]->promo_desc_4;?></p>
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
                        <h2 class="section-title">LATEST BLOG</h2>
                        
                    </div>
    </div>
    <div class="height20"></div>
	<div class="row">
    
    
    
		<div class="col paddingoff">
                        <div class="blog-grids">
                           <?php foreach($blogs as $blog){?>
                           
                            <div class="grid col-md-4 my-md-4">
                            <?php if($blog->post_media_type=="image"){
							
							  if(!empty($blog->post_image))
							  {
							     $img_url = $url.'/local/images/media/'.$blog->post_image; 
							  }
							  else
							  {
							  $img_url = $url.'/local/images/noimage.jpg';
							  }
							?>
                            
                                <div class="entry-media">
                                    <img src="<?php echo $img_url;?>" alt="">
                                </div>
                                
                            <?php } else if($blog->post_media_type=="mp3"){?>  
                             <div class="entry-media">
                                    <div class="mediPlayer" align="center">
    				<audio class="listen" preload="none" data-size="188" src="<?php echo $url;?>/local/images/media/<?php echo $blog->post_audio;?>"></audio>
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
                                    <p><?php echo substr($blog->post_desc,0,150).'...';?></p>
                                    <div class="read-more-date">
                                        <a href="<?php echo $url;?>/blog/<?php echo $blog->post_slug;?>">Read More..</a>
                                        <span class="date"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $dateonly;?></span>
                                    </div>
                                </div>
                            </div>
                           
                         <?php } ?>   
                            
                        </div>
                    </div>
	</div>
</div>
    
    </section>
    
    <?php } } ?>

   

			

      @include('footer')
      
</body>
</html>