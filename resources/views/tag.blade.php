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
	 <title><?php echo translate( 25, $lang);?> - <?php echo translate( 205, $lang);?></title>




</head>
<body class="index">

    <!-- fixed navigation bar -->
    @include('header')

    
<div class="promo-area" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $setts[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="promo-text">
                   
                        <h2 class="avigher-title bolder fontsize30"><?php echo translate( 853, $lang);?> <?php echo $tag_txt;?></h2>
                        
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
                       
                        <li class="breadcrumb-item active"><?php echo translate( 853, $lang);?> <?php echo $tag_txt;?></li>
                        
                    </ol>
                </div>
            </div>
        </div>
    </div> 
   
   
	
	
	 <main class="main-wrapper-inner blog-wrapper" id="container">

            	<div class="container">

                	<div class="wrapper-inner">
                    
                    
	<div class="row">
	
    
    
    <?php if($type=="blog"){?>
	
	<?php 
	if(!empty($query_count))
	{
	
	$query = DB::table('posts')
					
					 ->whereRaw("find_in_set('".$tag_txt."',post_tags)")
					 ->where("post_status", "=", "1")
					 ->where('lang_code','=',$lang)
					 ->where("post_type","=","blog")
					 ->get();
	foreach($query as $nquery){ ?>
    
    
    
    <div class="container">








<div class="container">


        <div class="wrapper-inner row">
                    
             <div class="col-md-4">  
                <div class="bloglist listShow1">
                  <article id="post" class="post li-item1" style="display: block;">
                   
          			<?php if($nquery->post_media_type=="image"){ ?>
    				<?php if(!empty($nquery->post_image)){ ?>
          			<a href="<?php echo $url;?>/blog/<?php echo $nquery->post_slug;?>" title="<?php echo $nquery->post_title;?>"><img src="<?php echo $url.'/local/images/media/blog/'.$nquery->post_image;?>" class="img-responsive blogpost"></a>
        			<?php } else {?>
       				<a href="<?php echo $url;?>/blog/<?php echo $nquery->post_slug;?>" title="<?php echo $nquery->post_title;?>"><img src="<?php echo $url;?>/local/images/noimage.jpg" class="img-responsive blogpost"></a>
        			<?php } ?>
                    <?php } ?>
                    
                    <?php if($nquery->post_media_type=="mp3"){ ?>
                    <a href="<?php echo $url;?>/blog/<?php echo $nquery->post_slug;?>" title="<?php echo $nquery->post_title;?>"><img src="<?php echo $url;?>/local/images/blogaudio.png" class="img-responsive blogpost"></a>
                   
                    <?php } ?>
                    <?php if($nquery->post_media_type=="video"){?>
                    <a href="<?php echo $url;?>/blog/<?php echo $nquery->post_slug;?>" title="<?php echo $nquery->post_title;?>"><img src="<?php echo $url;?>/local/images/blogvideo.png" class="img-responsive blogpost"></a>
                    <?php } ?>                  
                            <div class="codepopular_bloginfo">
                              <span class="blogerdate">
                              <i class="fa fa-calendar"></i> <?php echo date("d M Y",strtotime($nquery->post_date));?></span>
                            		<h3><a href="<?php echo $url;?>/blog/<?php echo $nquery->post_slug;?>" class="blacker decorationoff"><?php echo $nquery->post_title;?></a></h3>
                            	<p><?php echo substr(strip_tags(html_entity_decode($nquery->post_desc)),0,110).'...';?></p>
                             <div class="clearfix"></div>
                             <div class="float-left">
							<div class="text-left">
								<a href="<?php echo $url;?>/blog/<?php echo $nquery->post_slug;?>" class="custom-btn"><?php echo translate( 766, $lang);?></a>
							</div>
                             </div>
                             <div class="float-right">
                             <i class="fa fa-comment-o" aria-hidden="true"></i> 1 Comment                             </div>
                              </div>
                            <div class="clearfix height20"></div>
                        </article>
                         </div>
                          </div>

                    </div>

                </div>
 </div>

    
  
    
    <?php } } ?>
    
    <?php } ?>
    
    
    
    </div>
    
    
    
    
    
    <div class="row">
    <?php if($type=="item"){ ?>
    <?php 
	if(!empty($query_count))
	{
	$query = DB::table('products')
		            ->whereRaw("find_in_set('".$tag_txt."',item_tags)")
					->where('delete_status', '=', '')
					->where('item_status', '=', 1)
					->where('lang_code','=',$lang)
					->orderBy('item_id', 'desc')
					->get();
	
	foreach($query as $views){ 
    
    if($lang == "en")
						  {
						    $item_id = $views->item_id; 
						  }
						  else
						  {
						     $item_id = $views->parent;
						  }	
    ?>
                <?php 	
				
				
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
												
					 
				?>
                <div class="col-md-4 col-sm-4">
                    <div class="item-demo">
                        <figure>
                            
                            <?php if(!empty($views->preview_image)){?>
                            <img src="<?php echo $url;?>/local/images/media/preview/<?php echo $views->preview_image;?>" alt="">
                            <?php } else { ?>
                             <img src="<?php echo $url;?>/local/images/noimage.jpg" alt="">
                             <?php } ?>
                            
                            <div class="product-caption">
                                <div class="caption-cel">
                                    <div class="product-link">
                                        <div>
                                            <div>
                                                <a href="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $views->item_slug;?>" class="radiusoff"><?php echo translate( 223, $lang);?><span><i class="fa fa-eye"></i></span></a>
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
                                <h3 class="product-name custom_tittle col-md-8 paddingoff">
                                	<a href="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $views->item_slug;?>"><?php echo $views->item_title;?></a> 
                                </h3>
                                <span class="alink col-md-4 paddingoff text-right"><?php echo $views->regular_price_six_month;?> <?php echo $site_setting[0]->site_currency;?>
                                </span>

                                  <span class="p-author">
                                    <a href="<?php echo $url;?>/<?php echo $user_slug;?>" class="auth_texter"><?php if(!empty($user_photo)){?>
                                    	<img src="<?php echo $url;?>/local/images/media/userphoto/<?php echo $user_photo;?>" alt="<?php echo $user_name;?>" border="0" class="roundshape" style="width:30px; border-radius:50px;" /><?php
                                    	 } else { ?>
                                    	<img src="<?php echo $url;?>/local/images/nophoto.jpg" alt="<?php echo $user_name;?>" border="0" class="roundshape" style="width:30px; border-radius:50px;" /><?php } ?> 
                                    	<?php echo $user_name;?></a>
                                </span>
                            </div>
                            </div>
                            <div class="product-meta">
                                <span class="meta-download">
                                    <i class="fa fa-cloud-download"></i><?php echo $views->downloaded;?>
                                </span>
                                <span class="meta-love">
                                    <i class="fa fa-heart"></i><?php echo $views->liked;?>
                                </span>
                                <span class="meta-rating">
                                    <?php if(!empty($review_count_03)){ echo $rateus_new_03; } else { echo $rateus_empty_03; }?> 
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                
                
              
           
    
    
    
    
    
    
    
    
    
    <?php } } } ?>
    </div>
    
    
    
	</div>
	</div>
    <div class="height100"></div>
	</main>
	
	

      <div class="clearfix"></div>
	   <div class="clearfix"></div>

      @include('footer')
       
</body>
</html>