<?php
use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();	
$url = URL::to("/");
$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
if(!empty($min_price_count))
{
   $min_price = 	DB::table('products')
		            ->where('delete_status','=','')
					->where('item_status', '=', 1)
					->orderBy('regular_price_six_month', 'asc')
					->take(1)
					->get();
	$minprice = $min_price[0]->regular_price_six_month;			
}
else
{
 $minprice = 0;
}


if(!empty($max_price_count))
{
   $max_price = DB::table('products')
		            ->where('delete_status','=','')
					->where('item_status', '=', 1)
					->orderBy('regular_price_six_month', 'desc')
					->take(1)
					->get();
	$maxprice = $max_price[0]->regular_price_six_month;			
}
else
{
 $maxprice = 0;
}

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
     <title><?php echo translate( 25, $lang);?> - <?php echo translate( 46, $lang);?></title>
	
	
	<script type="text/javascript">
	function showProducts(minPrice, maxPrice) {
    $("#products .ranger").hide().filter(function() {
        var price = parseInt($(this).data("price"), 10);
        return price >= minPrice && price <= maxPrice;
    }).show();
}

$(function() {
    var options = {
        range: true,
        min: <?php echo $setts[0]->min_price_range;?>,
        max: <?php echo $setts[0]->max_price_range;?>,
        values: [<?php echo $minprice;?>, <?php echo $maxprice;?>],
        slide: function(event, ui) {
            var min = ui.values[0],
                max = ui.values[1];

            $("#amount").val("<?php echo $setts[0]->site_currency;?>" + min + " - <?php echo $setts[0]->site_currency;?>" + max);
            showProducts(min, max);
        }
    }, min, max;

    $("#slider-range").slider(options);

    min = $("#slider-range").slider("values", 0);
    max = $("#slider-range").slider("values", 1);

    $("#amount").val("<?php echo $setts[0]->site_currency;?>" + min + " - <?php echo $setts[0]->site_currency;?>" + max);

    showProducts(min, max);
});
</script>


 <script type="text/javascript">
    $(document).ready(function() {
        

        $(".listShow").cPager({
            pageSize: <?php echo $setts[0]->site_post_per;?>, 
            pageid: "welpager", 
            itemClass: "li-item",
			pageIndex: 1

        });
		
		$(".listShow2").cPager({
            pageSize: <?php echo $setts[0]->site_post_per;?>, 
            pageid: "welpager2", 
            itemClass: "li-item2",
			pageIndex: 1

        });
		
		
		
		$(".listShow3").cPager({
            pageSize: <?php echo $setts[0]->site_post_per;?>, 
            pageid: "welpager3", 
            itemClass: "li-item3",
			pageIndex: 1

        });
		
		$(".listShow4").cPager({
            pageSize: <?php echo $setts[0]->site_post_per;?>, 
            pageid: "welpager4", 
            itemClass: "li-item4",
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
                        <h1 class="avigher-title bolder fontsize30"><?php echo translate( 46, $lang);?></h1>
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
                        <li class="breadcrumb-item active"><?php echo translate( 46, $lang);?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
  
     <main class="product-area main-content">
        <div class="container">
            <div class="row" id="demo">
            
            <div class="col-md-12">
            <div class="tab-header clearfix">

               <!-- tab button -->           
				<ul class="product-tab nav nav-pills pull-left" id="pills-tab" role="tablist">
				  <li >
				    <a class="active" id="pills-newitem-tab" data-toggle="pill" href="#pills-newitem" role="tab" aria-controls="pills-newitem" aria-selected="true"><?php echo translate( 817, $lang);?></a>
				  </li>
				  <li>
				    <a  id="pills-popularitem-tab" data-toggle="pill" href="#pills-popularitem" role="tab" aria-controls="pills-popularitem" aria-selected="false"><?php echo translate( 820, $lang);?></a>
				  </li>
				</ul>
				<!-- end tab button -->



                            <div class="tab-viewport pull-right hidden-xs">
                                <div class="filter-form">
                                    <h5 class="filter-title"><?php echo translate( 823, $lang);?>: </h5>
                                    <div class="filter-form">
                                        
                                        
                                        <div class="jplist-panel">						
									
						<select 
						   class="jplist-select" 
						   data-control-type="sort-select" 
						   data-control-name="sort" 
						   data-control-action="sort" id="seltect-opt">
						   
							  <option data-path="default"><?php echo translate( 823, $lang);?></option>
							  <!--<option data-path=".title" data-order="asc" data-type="text">Title A-Z</option>
							  <option data-path=".title" data-order="desc" data-type="text">Title Z-A</option>
							  <option data-path=".desc" data-order="asc" data-type="text">Description A-Z</option>
							  <option data-path=".desc" data-order="desc" data-type="text">Description Z-A</option>
							  <option data-path=".like" data-order="asc" data-type="number">Likes asc</option>-->
							  <option data-path=".pro_id_value" data-order="desc" data-type="number"><?php echo translate( 826, $lang);?></option>
							  <option data-path=".price_value" data-order="asc" data-type="number"><?php echo translate( 829, $lang);?></option>
							  <option data-path=".price_value" data-order="desc" data-type="number"><?php echo translate( 832, $lang);?></option>								
						</select>						
						
					</div>
                                        
                                    </div>
                                </div>
                                <div class="view-tab">
                                    <ul role="tablist">
                                        <li><a href="<?php echo $url;?>/search"><i class="fa fa-th"></i></a></li>
                                        <li><a href="<?php echo $url;?>/search/list"><i class="fa fa-th-list"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                </div>        
            
            
            
            
            <div class="col-md-3 col-sm-12">
                    
                    
                        <div class="sidebar-widget">
                             <div class="jplist-panel">	
                               
                                
                                <input 
							  data-path="*" 
							  type="text" 
							  
							  placeholder="<?php echo translate( 952, $lang);?>" 
							  data-control-type="textbox" 
							  data-control-name="title-filter" 
							  data-control-action="filter"
                              name="search" value="<?php if(!empty($text)){?><?php echo $text; ?><?php } ?>"
						   />
                             </div>   
                           
                        </div>
                        
                        <div class="sidebar-widget">
                        <h3 class="widget-title"><?php echo translate( 835, $lang);?></h3>
                        <div class="demo col-md-12">

    <p>
        
        <input type="text" id="amount" style="border:0; color:#21C063; font-weight:bold;" />
    </p>

    <div id="slider-range"></div>
    
    </div>
    <div class="clearfix height30"></div>
                        </div>
                        
                        
                        
                        <!-- Search Widget End -->
                        <div class="sidebar-widget">
                            <h3 class="widget-title"><?php echo translate( 838, $lang);?></h3>
                            <div class="overflow">
                            
                        <div class="jplist-panel box panel-top">						
											
						
						<div class="jplist-group"
						   data-control-type="checkbox-group-filter"
						   data-control-action="filter"
						   data-control-name="themes">
                            
                            <?php
							if(!empty($cate_count)){
					
					$views_category = DB::table('product_categories')
								 ->where('delete_status','=','')
								 ->where('status','=',1)
								  ->where('lang_code','=',$lang)
								 ->where('cat_type','=','default')
								 ->orderBy('cat_name','asc')
								 ->get();	
					foreach($views_category as $views){
					
					if($lang == "en")
						  {
						    $cat_id = $views->id; 
						  }
						  else
						  {
						     $cat_id = $views->parent;
						  }		
						?>
                     
                    <p><input data-path=".<?php echo $cat_id;?>-cat" id="<?php echo $cat_id;?>-cat" type="checkbox" <?php if($cat_id.'-cat'==$tag){?> checked <?php } ?>/> <strong><?php echo $views->cat_name;?></strong></p>
                           
                           <?php
					  $subcat_cnt = DB::table('product_subcats')
									->where('delete_status','=','')
									->where('status','=',1)
									->where('subcat_type','=','default')
									->where('cat_id','=',$cat_id)
									->where('lang_code','=',$lang)
									->orderBy('subid','asc')
									->count();
					  if(!empty($subcat_cnt)){	
					  
					  $viewsub = DB::table('product_subcats')
									->where('delete_status','=','')
									->where('status','=',1)
									->where('subcat_type','=','default')
									->where('cat_id','=',$cat_id)
									->where('lang_code','=',$lang)
									->orderBy('subid','asc')
									->get();
					  
					  		
					  ?>
                       <?php foreach($viewsub as $subs){
					   
					    if($lang == "en")
						  {
						    $subcat_id = $subs->subid; 
						  }
						  else
						  {
						     $subcat_id = $subs->parent;
						  }	
					   ?>
                      <p class="left10"><input data-path=".<?php echo $subcat_id;?>-subcat" id="<?php echo $subcat_id;?>-subcat" type="checkbox" <?php if($subcat_id.'-subcat'==$tag){?> checked <?php } ?>/> <?php echo $subs->subcat_name;?></p>
                    
							 <?php } ?> <?php } ?>  <?php } } ?>
                             <div class="height10"></div>
                        </div>
                        
                        </div>
                        
                       </div>
                       
                       
                       </div>
                       
                       
                       
                       <div class="sidebar-widget">
                            <h3 class="widget-title"><?php echo translate( 181, $lang);?></h3>
                            <div class="overflow">
                            
                        <div class="jplist-panel box panel-top">						
											
						
						<div class="jplist-group"
						   data-control-type="checkbox-group-filter"
						   data-control-action="filter"
						   data-control-name="themes_new">
                            
                            <?php
							
							if(!empty($frame_count)){
					
					$views_category = DB::table('product_categories')
								 ->where('delete_status','=','')
								 ->where('status','=',1)
								 ->where('cat_type','=','framework')
								 ->where('lang_code','=',$lang)
								 ->orderBy('cat_name','asc')
								 ->get();	
					foreach($views_category as $views){	
					
					if($lang == "en")
						  {
						    $cat_id = $views->id; 
						  }
						  else
						  {
						     $cat_id = $views->parent;
						  }	
					?>
                     
                    <p><input data-path=".<?php echo $cat_id;?>-cat" id="<?php echo $cat_id;?>-cat" type="checkbox" <?php if($cat_id.'-cat'==$tag){?> checked <?php } ?>/> <strong><?php echo $views->cat_name;?></strong></p>
                           
                           <?php
					  $subcat_cnt = DB::table('product_subcats')
									->where('delete_status','=','')
									->where('status','=',1)
									->where('subcat_type','=','framework')
									->where('cat_id','=',$cat_id)
									->where('lang_code','=',$lang)
									->orderBy('subid','asc')
									->count();
					  if(!empty($subcat_cnt)){	
					  
					  $viewsub = DB::table('product_subcats')
									->where('delete_status','=','')
									->where('status','=',1)
									->where('subcat_type','=','framework')
									->where('cat_id','=',$cat_id)
									->where('lang_code','=',$lang)
									->orderBy('subid','asc')
									->get();
					  
					  		
					  ?>
                       <?php foreach($viewsub as $subs){
					    if($lang == "en")
						  {
						    $subcat_id = $subs->subid; 
						  }
						  else
						  {
						     $subcat_id = $subs->parent;
						  }	
					   
					   ?>
                      <p class="left10"><input data-path=".<?php echo $subcat_id;?>-subcat" id="<?php echo $subcat_id;?>-subcat" type="checkbox" <?php if($subcat_id.'-subcat'==$tag){?> checked <?php } ?>/> <?php echo $subs->subcat_name;?></p>
                    
							 <?php } ?> <?php } ?>  <?php } } ?>
                             <div class="height10"></div>
                        </div>
                        
                        </div>
                        
                       </div>
                       
                       
                       </div>
                       
                       
                       
                       
                        <div class="sidebar-widget">
                            <h3 class="widget-title"><?php echo translate( 841, $lang);?></h3>
                            <div class="tagclouds jplist-panel">
                                <!--<input 
							  data-control-type="radio-buttons-text-filters"
							  data-control-action="filter"
							  data-control-name="default" 
							  data-path="default"
                              value=""
							  
							  id="default-radio" 
							  type="radio" 
							  name="jplist"
							  checked="checked"
						   />-->
                                
                               <input 
							  data-control-type="radio-buttons-text-filters"
							  data-control-action="filter"
							  data-control-name="default" 
							  data-path="default"
                              value=""
							  
							  id="default-radio" 
							  type="radio" 
							  name="jplist"
							  
						   /> 
							  
						   <label for="default-radio"><?php echo translate( 844, $lang);?></label><br/>
						   
						   <input 									
							  data-control-type="radio-buttons-text-filters"
							  data-control-action="filter"
							  data-control-name="5_star"
							  value="5_star"
                              data-path=".theme"
							  
							  id="5_star" 
							  type="radio" 
							  name="jplist"
						   /> 
							  
						   <label for="5 Stars">5 <?php echo translate( 847, $lang);?></label><br/>
						   
						   <input 
							  data-control-type="radio-buttons-text-filters"
							  data-control-action="filter"
							  data-control-name="4_star" 
							  value="4_star"
                              data-path=".theme"
							  
							  id="4_star" 
							  type="radio"
							  name="jplist"
						   /> 
							  
						   <label for="4 Stars">4 <?php echo translate( 847, $lang);?></label><br/>
						   
						   <input 
							  data-control-type="radio-buttons-text-filters"
							  data-control-action="filter"
							  data-control-name="3_star" 
							  value="3_star"
                              data-path=".theme"
							  
							  id="3_star" 
							  type="radio" 
							  name="jplist"
						   /> 
						   
						   <label for="3 Stars">3 <?php echo translate( 847, $lang);?></label><br/>
						   
						   <input 
							  data-control-type="radio-buttons-text-filters"
							  data-control-action="filter"
							  data-control-name="2_star" 
							  value="2_star"
                              data-path=".theme"
							  
							  id="2_star" 
							  type="radio"
							  name="jplist"
						   /> 
						   
						   <label for="2 Stars">2 <?php echo translate( 847, $lang);?></label><br/>
						   
						   <input 
							  data-control-type="radio-buttons-text-filters"
							  data-control-action="filter"
							  data-control-name="1_star" 
							  value="1_star"
                              data-path=".theme"
							  
							  id="1_star" 
							  type="radio" 
							  name="jplist"
						   /> 
						   
						   <label for="1 Star">1 <?php echo translate( 850, $lang);?></label>
						   
                                
                                
                                
                            </div>
                        </div>
                       
                   
                    </div>
                    
                     
                
            
            
            
            
                <div class="col-md-9 col-sm-12">
                    <div class="promo-item-wrap">
                        
                        
                        <?php /******* GRID VIEW ***********/?>
                        
                        <?php if(empty($list)){?>
                     <div class="tab-content" id="pills-tabContent">
                        
                        <?php if(!empty($new_items_count)){
						
						
									
						?>
                        
                           <div class="tab-pane fade show active" id="pills-newitem" role="tabpanel" aria-labelledby="pills-newitem-tab">
                                <div class="row list listShow" id="products">
                                    
                                    
                                    <?php 
									    $items = DB::table('products')
											->where('delete_status', '=', '')
											->where('item_status', '=', 1)
											 ->where('lang_code','=',$lang)
											->orderBy('item_id', 'desc')->get();	
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
												$user_photo = $user_details[0]->photo;	 	
											}
											else
											{
											  $user_name = "";
											  $user_slug = "";
											  $user_photo = "";
											}
											
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
                                    
                                    <div class="col-md-6 col-sm-6 list-item ranger li-item" data-price="<?php echo $views->regular_price_six_month;?>">
                                    <div class="pro_id_value" style="display:none;"><?php echo $item_id;?></div>
                                    <p class="theme" style="display:none;">
                                    <?php 
									$array_checkin =  explode(',', $views->category);
									?>
                                    
                                    <?php foreach($array_checkin as $checkin){?>
									<span class="<?php echo $checkin;?>"><?php echo $checkin;?></span>, 
									<?php } ?>
                                    
                                    
                                    
                                    <p class="theme" style="display:none;">
                                    <?php 
									$array_checker =  explode(',', $views->framework_category);
									?>
                                    
                                    <?php foreach($array_checker as $checker){?>
									<span class="<?php echo $checker;?>"><?php echo $checker;?></span>, 
									<?php } ?>
								</p>
                                    
                                    
                    <div class="item-demo">
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
                                                <a href="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $views->item_slug;?>"><?php echo translate( 223, $lang);?> <span><i class="fa fa-eye"></i></span></a>
                                            </div>
                                            <?php /*?>
                                            <div>
                                                <a href="<?php echo $url;?>/cart">Add to Cart<span><i class="fa fa-shopping-cart"></i></span></a>
                                            </div><?php */?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </figure>
                        <div class="product-info">
                            <div class="product-header">
                            <?php if(!empty($review_count_03)) { if(!empty($roundeding_03)){ ?>
                            <span class="theme star_text_hide">
                            	<span class="<?php echo $roundeding_03.'_star';?>"><?php echo $roundeding_03.'_star';?>
                            	</span>
                           </span>
                           <?php } } ?>
								<div class="row pl-3 pr-3">
                                <h3 class="product-name title col-md-8 paddingoff"><a href="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $views->item_slug;?>"><?php echo $views->item_title;?></a>
                                </h3>


                                 <span class="alink col-md-4 paddingoff text-right price_value">
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
                                 <?php } ?>
                                 
                                 
                                 
                                 
                                </div>
                                
                                <div class="turn-page" id="welpager"></div>
                                
                                
                            </div>
                            <?php  } ?>

                           
                           
                           
                           <?php if(!empty($popular_items_count)){?>
                           <div class="tab-pane fade" id="pills-popularitem" role="tabpanel" aria-labelledby="pills-popularitem-tab">
                                <div class="row list1 listShow2" id="products">
                                    
                                    
                                    <?php 
									    $items = DB::table('products')
											->where('delete_status', '=', '')
											 ->where('lang_code','=',$lang)
											->where('item_status', '=', 1)
											->orderBy('downloaded', 'desc')
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
												$user_photo = $user_details[0]->photo;	 	
											}
											else
											{
											  $user_name = "";
											  $user_slug = "";
											  $user_photo = "";
											}
											
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
											  
											
									$review_count_04 = DB::table('product_ratings')
														->where('item_id', '=', $item_id)
														->count();
														
														if(!empty($review_count_04))
														{
														$review_value_04 = DB::table('product_ratings')
																	   ->where('item_id', '=', $item_id)
																	   ->get();
														
														
														$over_04 = 0;
														$fine_value_04 = 0;
														foreach($review_value_04 as $review){
														if($review->rating==1){$value1 = $review->rating*1;} else { $value1 = 0; }
												if($review->rating==2){$value2 = $review->rating*2;} else { $value2 = 0; }
												if($review->rating==3){$value3 = $review->rating*3;} else { $value3 = 0; }
												if($review->rating==4){$value4 = $review->rating*4;} else { $value4 = 0; }
												if($review->rating==5){$value5 = $review->rating*5;} else { $value5 = 0; }
												
												$fine_value_04 += $value1 + $value2 + $value3 + $value4 + $value5;
												
										
											  $over_04 +=$review->rating;
											  
											  
											  
														}
														if(!empty(round($fine_value_04/$over_04))){ $roundeding_04 = round($fine_value_04/$over_04); } else {
												  $roundeding_04 = 0; }	
														
														
														}
				
											if(!empty($review_count_04))
				                               {
	                                           if(!empty($roundeding_04)){
	
	                                           if($roundeding_04==1){ $rateus_new_04 ='
                                                <p class="review-icon">
                                                   
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    
                                                    
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_04.')
                                                </p>';
												}
												if($roundeding_04==2){ $rateus_new_04 ='
                                                <p class="review-icon">
                                                   
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                   
													
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_04.')
                                                </p>';
												}
												
												if($roundeding_04==3){ $rateus_new_04 ='
                                                <p class="review-icon">
                                                   
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                   
													
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_04.')
                                                </p>';
												}
												
												if($roundeding_04==4){ $rateus_new_04 ='
                                                <p class="review-icon">
                                                    
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i> 
                                                    
											                                                
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_04.')
                                                </p>';
												}
												
												if($roundeding_04==5){ $rateus_new_04 ='
                                                <p class="review-icon">
                                                    
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i>
													 <i class="fa fa-star my_yellow" aria-hidden="true"></i> ('.$review_count_04.')
                                                    
											    </p>';
												}
												
												
												}
											    else if(empty($roundeding_04)){  $rateus_new_04 = '
												<p class="review-icon">
                                                    
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_04.')
											    </p>';
												}
												
												}
												
												
												
												$rateus_empty_04 = '
												<p class="review-icon">
                                                    
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_04.')
											    </p>';
								 
									?>

                                    <div class="col-md-6 col-sm-6 list-item1 ranger li-item2" data-price="<?php echo $views->regular_price_six_month;?>">
                                    <div class="pro_id_value" style="display:none;"><?php echo $item_id;?></div>
                                    
                                    <p class="theme" style="display:none;">
                                    <?php 
									$array_checkin =  explode(',', $views->category);
									?>
                                    
                                    <?php foreach($array_checkin as $checkin){?>
									<span class="<?php echo $checkin;?>"><?php echo $checkin;?></span>, 
									<?php } ?>
								</p>
                                
                                
                                <p class="theme" style="display:none;">
                                    <?php 
									$array_checker =  explode(',', $views->framework_category);
									?>
                                    
                                    <?php foreach($array_checker as $checker){?>
									<span class="<?php echo $checker;?>"><?php echo $checker;?></span>, 
									<?php } ?>
								</p>
                                
                                
                                    
                                    
                    <div class="item-demo">
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
                                                <a href="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $views->item_slug;?>"><?php echo translate( 223, $lang);?> <span><i class="fa fa-eye"></i></span></a>
                                            </div>
                                           <?php /*?> <div>
                                                <a href="<?php echo $url;?>/cart">Add to Cart<span><i class="fa fa-shopping-cart"></i></span></a>
                                            </div><?php */?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </figure>

                        <div class="product-info">
                            <div class="product-header">
                            <?php if(!empty($review_count_04)) { if(!empty($roundeding_04)){ ?>
                            <span class="theme star_text_hide">
                            	<span class="<?php echo $roundeding_04.'_star';?>"><?php echo $roundeding_04.'_star';?></span></span>
                           <?php } } ?>
                            <div class="row pl-3 pr-3">
                                <h3 class="product-name title col-md-8 paddingoff"><a href="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $views->item_slug;?>"><?php echo $views->item_title;?>
                                	
                                </a>
                                </h3> 

                                <span class="alink col-md-4 paddingoff text-right price_value"><?php echo $views->regular_price_six_month;?> <?php echo $site_setting[0]->site_currency;?>
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
                                    <?php if(!empty($review_count_04)){ echo $rateus_new_04; } else { echo $rateus_empty_04; }?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                                    
                                    
                                    
                                    

                                  <?php } ?> 
                                   
                                   
                                  
                                  
                                  
                                  
                                </div>
                                
                                <div class="turn-page" id="welpager2"></div>
                            </div>
                            <?php } ?>
                           
                        </div>
                        
                        <?php } ?>
                        
                        
                        <?php /******* END GRID VIEW ***********/?> 
                        
                        
                        
                        
                        <?php /******* LIST VIEW ***********/?>
                        <?php if(!empty($list)){?>

                        <div class="tab-content12">
                        
                        <?php if(!empty($new_items_count)){?>
                            <div role="tabpanel1" class="tab-pane1 fade1 in1 active" id="seller1">
                                <div class="row list2 listShow3" id="products">
                                    
                                    
                                    <?php 
									    $items = DB::table('products')
											->where('delete_status', '=', '')
											 ->where('lang_code','=',$lang)
											->where('item_status', '=', 1)
											->orderBy('item_id', 'desc')->get();	
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
												$user_photo = $user_details[0]->photo;		 	
											}
											else
											{
											  $user_name = "";
											  $user_slug = "";
											  $user_photo = "";
											}
											
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
											  
											  
									
									    $review_count_05 = DB::table('product_ratings')
														->where('item_id', '=', $item_id)
														->count();
														
														if(!empty($review_count_05))
														{
														$review_value_05 = DB::table('product_ratings')
																	   ->where('item_id', '=', $item_id)
																	   ->get();
														
														
														$over_05 = 0;
														$fine_value_05 = 0;
														foreach($review_value_05 as $review){
														if($review->rating==1){$value1 = $review->rating*1;} else { $value1 = 0; }
												if($review->rating==2){$value2 = $review->rating*2;} else { $value2 = 0; }
												if($review->rating==3){$value3 = $review->rating*3;} else { $value3 = 0; }
												if($review->rating==4){$value4 = $review->rating*4;} else { $value4 = 0; }
												if($review->rating==5){$value5 = $review->rating*5;} else { $value5 = 0; }
												
												$fine_value_05 += $value1 + $value2 + $value3 + $value4 + $value5;
												
										
											  $over_05 +=$review->rating;
											  
											  
											  
														}
														if(!empty(round($fine_value_05/$over_05))){ $roundeding_05 = round($fine_value_05/$over_05); } else {
												  $roundeding_05 = 0; }	
														
														
														}
				
											if(!empty($review_count_05))
				                               {
	                                           if(!empty($roundeding_05)){
	
	                                           if($roundeding_05==1){ $rateus_new_05 ='
                                                <p class="review-icon">
                                                   
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    
                                                    
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_05.')
                                                </p>';
												}
												if($roundeding_05==2){ $rateus_new_05 ='
                                                <p class="review-icon">
                                                   
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                   
													
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_05.')
                                                </p>';
												}
												
												if($roundeding_05==3){ $rateus_new_05 ='
                                                <p class="review-icon">
                                                   
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                   
													
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_05.')
                                                </p>';
												}
												
												if($roundeding_05==4){ $rateus_new_05 ='
                                                <p class="review-icon">
                                                    
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i> 
                                                    
											                                                
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_05.')
                                                </p>';
												}
												
												if($roundeding_05==5){ $rateus_new_05 ='
                                                <p class="review-icon">
                                                    
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i>
													 <i class="fa fa-star my_yellow" aria-hidden="true"></i> ('.$review_count_05.')
                                                    
											    </p>';
												}
												
												
												}
											    else if(empty($roundeding_05)){  $rateus_new_05 = '
												<p class="review-icon">
                                                    
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_05.')
											    </p>';
												}
												
												}
												
												
												
												$rateus_empty_05 = '
												<p class="review-icon">
                                                    
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_05.')
											    </p>';
								 
													 
									?>
                                    
                                    <div class="col-md-12 list-item2 ranger li-item3" data-price="<?php echo $views->regular_price_six_month;?>">
                                    <div class="pro_id_value" style="display:none;"><?php echo $item_id;?></div>
                                    
                                    <p class="theme" style="display:none;">
                                    <?php 
									$array_checkin =  explode(',', $views->category);
									?>
                                    
                                    <?php foreach($array_checkin as $checkin){?>
									<span class="<?php echo $checkin;?>"><?php echo $checkin;?></span>, 
									<?php } ?>
								</p>
                                
                                
                                <p class="theme" style="display:none;">
                                    <?php 
									$array_checker =  explode(',', $views->framework_category);
									?>
                                    
                                    <?php foreach($array_checker as $checker){?>
									<span class="<?php echo $checker;?>"><?php echo $checker;?></span>, 
									<?php } ?>
								</p>
                                
                                
                                
                                    
                                    
                                        <div class="item-demo item-list">
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
                                                <a href="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $views->item_slug;?>"><?php echo translate( 223, $lang);?> <span><i class="fa fa-eye"></i></span></a>
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
                            <?php if(!empty($review_count_05)) { if(!empty($roundeding_05)){ ?>
                            <span class="theme star_text_hide"><span class="<?php echo $roundeding_05.'_star';?>"><?php echo $roundeding_05.'_star';?></span></span>
                           <?php } } ?>
                            
                                <h3 class="product-name title"><a href="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $views->item_slug;?>"><?php echo $views->item_title;?></a> <span class=" alink price_value"><?php echo $views->regular_price_six_month;?> <?php echo $site_setting[0]->site_currency;?></span></h3>
                                <span class="p-author">
                                    <a href="<?php echo $url;?>/<?php echo $user_slug;?>" class="auth_texter"><?php if(!empty($user_photo)){?><img src="<?php echo $url;?>/local/images/media/userphoto/<?php echo $user_photo;?>" alt="<?php echo $user_name;?>" border="0" class="roundshape" style="width:30px; border-radius:50px;" /><?php } else { ?><img src="<?php echo $url;?>/local/images/nophoto.jpg" alt="<?php echo $user_name;?>" border="0" class="roundshape" style="width:30px; border-radius:50px;" /><?php } ?> <?php echo $user_name;?></a>
                                </span>
                                <p class="short_desc fontsize14"><?php echo substr(html_entity_decode($views->item_short_desc),0,150).'...';?></p>
                            </div>
                            <div class="product-meta">
                                <span class="meta-download">
                                    <i class="fa fa-cloud-download"></i><?php echo $view_download_as;?>
                                </span>
                                <span class="meta-love">
                                    <i class="fa fa-heart"></i><?php echo $view_like_as;?>
                                </span>
                                <span class="meta-rating">
                                    <?php if(!empty($review_count_05)){ echo $rateus_new_05; } else { echo $rateus_empty_05; }?> 
                                </span>
                            </div>
                        </div>
                                            
                                            
                                            
                                        </div>
                                    </div>
                                    <?php } ?>

                                   
                                    
                                    
                                </div>
                                
                                <div class="turn-page" id="welpager3"></div>
                            </div>
                            
                            </div>
                            <?php } ?>
                            
                            
                            
                            
                            <?php if(!empty($popular_items_count)){?>
                            <div role="tabpanel" class="tab-pane fade" id="popular" style="display:none;">
                                <div class="row list3 listShow4" id="products">
                                    
                                    
                                    
                                    
                                    <?php 
									    $items = DB::table('products')
											->where('delete_status', '=', '')
											 ->where('lang_code','=',$lang)
											->where('item_status', '=', 1)
											->orderBy('downloaded', 'desc')
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
												$user_photo = $user_details[0]->photo;		 	
											}
											else
											{
											  $user_name = "";
											  $user_slug = "";
											  $user_photo = "";
											}
											
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
											
									$review_count_06 = DB::table('product_ratings')
														->where('item_id', '=', $item_id)
														->count();
														
														if(!empty($review_count_06))
														{
														$review_value_06 = DB::table('product_ratings')
																	   ->where('item_id', '=', $item_id)
																	   ->get();
														
														
														$over_06 = 0;
														$fine_value_06 = 0;
														foreach($review_value_06 as $review){
														if($review->rating==1){$value1 = $review->rating*1;} else { $value1 = 0; }
												if($review->rating==2){$value2 = $review->rating*2;} else { $value2 = 0; }
												if($review->rating==3){$value3 = $review->rating*3;} else { $value3 = 0; }
												if($review->rating==4){$value4 = $review->rating*4;} else { $value4 = 0; }
												if($review->rating==5){$value5 = $review->rating*5;} else { $value5 = 0; }
												
												$fine_value_06 += $value1 + $value2 + $value3 + $value4 + $value5;
												
										
											  $over_06 +=$review->rating;
											  
											  
											  
														}
														if(!empty(round($fine_value_06/$over_06))){ $roundeding_06 = round($fine_value_06/$over_06); } else {
												  $roundeding_06 = 0; }	
														
														
														}
				
											if(!empty($review_count_06))
				                               {
	                                           if(!empty($roundeding_06)){
	
	                                           if($roundeding_06==1){ $rateus_new_06 ='
                                                <p class="review-icon">
                                                   
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    
                                                    
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_06.')
                                                </p>';
												}
												if($roundeding_06==2){ $rateus_new_06 ='
                                                <p class="review-icon">
                                                   
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                   
													
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_06.')
                                                </p>';
												}
												
												if($roundeding_06==3){ $rateus_new_06 ='
                                                <p class="review-icon">
                                                   
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                   
													
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_06.')
                                                </p>';
												}
												
												if($roundeding_06==4){ $rateus_new_06 ='
                                                <p class="review-icon">
                                                    
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i> 
                                                    
											                                                
                                                    
                                                    <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_06.')
                                                </p>';
												}
												
												if($roundeding_06==5){ $rateus_new_06 ='
                                                <p class="review-icon">
                                                    
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
                                                    <i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i>
													<i class="fa fa-star my_yellow" aria-hidden="true"></i>
													 <i class="fa fa-star my_yellow" aria-hidden="true"></i> ('.$review_count_06.')
                                                    
											    </p>';
												}
												
												
												}
											    else if(empty($roundeding_06)){  $rateus_new_06 = '
												<p class="review-icon">
                                                    
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_06.')
											    </p>';
												}
												
												}
												
												
												
												$rateus_empty_06 = '
												<p class="review-icon">
                                                    
													<i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													<i class="fa fa-star" aria-hidden="true"></i>
													 <i class="fa fa-star" aria-hidden="true"></i> ('.$review_count_06.')
											    </p>';
								 
												
											
													 
									?>
                                    <div class="col-md-12 list-item3 ranger li-item4" data-price="<?php echo $views->regular_price_six_month;?>">
                                    <div class="pro_id_value" style="display:none;"><?php echo $item_id;?></div>
                                    
                                    <p class="theme" style="display:none;">
                                    <?php 
									$array_checkin =  explode(',', $views->category);
									?>
                                    
                                    <?php foreach($array_checkin as $checkin){?>
									<span class="<?php echo $checkin;?>"><?php echo $checkin;?></span>, 
									<?php } ?>
								</p>
                                
                                <p class="theme" style="display:none;">
                                    <?php 
									$array_checker =  explode(',', $views->framework_category);
									?>
                                    
                                    <?php foreach($array_checker as $checker){?>
									<span class="<?php echo $checker;?>"><?php echo $checker;?></span>, 
									<?php } ?>
								</p>
                                
                                
                                
                                    
                                    
                                        <div class="item-demo item-list">
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
                                                <a href="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $views->item_slug;?>"><?php echo translate( 223, $lang);?> <span><i class="fa fa-eye"></i></span></a>
                                            </div>
                                            
                                        </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </figure>
                                            
                                            
                                            <div class="product-info">
                            <div class="product-header">
                            <?php if(!empty($review_count_06)) { if(!empty($roundeding_06)){ ?>
                            <span class="theme star_text_hide"><span class="<?php echo $roundeding_06.'_star';?>"><?php echo $roundeding_06.'_star';?></span></span>
                           <?php } } ?>
                                <h3 class="product-name title"><a href="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $views->item_slug;?>"><?php echo $views->item_title;?></a> <span class="alink price_value"><?php echo $views->regular_price_six_month;?> <?php echo $site_setting[0]->site_currency;?></span></h3>
                                <span class="p-author">
                                    <a href="<?php echo $url;?>/<?php echo $user_slug;?>" class="auth_texter"><?php if(!empty($user_photo)){?><img src="<?php echo $url;?>/local/images/media/userphoto/<?php echo $user_photo;?>" alt="<?php echo $user_name;?>" border="0" class="roundshape" style="width:30px; border-radius:50px;" /><?php } else { ?><img src="<?php echo $url;?>/local/images/nophoto.jpg" alt="<?php echo $user_name;?>" border="0" class="roundshape" style="width:30px; border-radius:50px;" /><?php } ?> <?php echo $user_name;?></a>
                                </span>
                                <p class="short_desc fontsize14"><?php echo substr(html_entity_decode($views->item_short_desc),0,150).'...';?></p>
                            </div>
                            <div class="product-meta">
                                <span class="meta-download">
                                    <i class="fa fa-cloud-download"></i><?php echo $view_download_as;?>
                                </span>
                                <span class="meta-love">
                                    <i class="fa fa-heart"></i><?php echo $view_like_as;?>
                                </span>
                                <span class="meta-rating">
                                   <?php if(!empty($review_count_06)){ echo $rateus_new_06; } else { echo $rateus_empty_06; }?> 
                                </span>
                            </div>
                        </div>
                                            
                                            
                                            
                                        </div>
                                    </div>
                                    
                                    
                                    
                                    <?php } ?>

                                    
                                    
                                </div>
                                
                                 <div class="turn-page" id="welpager4"></div>
                            </div>
                            <?php } ?>
                            
                           
                        </div>
                        
                        <?php } ?>
                        
                        <?php /******* END LIST VIEW ***********/?>
                        
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    
    
	

	
	
      @include('footer')
      
 
</body>
</html>