

<?php
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
	<title><?php echo translate( 25, $lang);?> - <?php echo $item_title;?></title>
  
<meta name="author" content="<?php echo $setts[0]->site_name;?>" />    
<meta property="og:type" content="article">
<meta property="og:title" content="<?php echo $item_title;?>">
<meta property="og:description" content="<?php echo substr(html_entity_decode($item_title),0,80);?>">
<meta property="og:url" content="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $item_slug;?>">
<meta property="og:site_name" content="<?php echo $setts[0]->site_name;?>">
<meta property="og:image" content="<?php echo $img_url;?>">
<meta property="og:image:width" content="400">
<meta property="og:image:height" content="300">

 
	  

<script type="text/javascript">
	$(document).ready(function() {		
		$(".support_price").click(function(event) {
			var total = "";
			var text = " <?php echo $setts[0]->site_currency;?>";
			$(".support_price:checked").each(function() {
				total += parseFloat($(this).val())+ text;
			});
			
			if (total == 0) {
				$('#amount').val('');
			} else {				
				$('#amount').val(total);
			}
		});
	});	
	</script>

<script type="text/javascript">
    $(document).ready(function() {
       
		$(".listShow1").cPager({
            pageSize: <?php echo $setts[0]->site_comment_per;?>, 
            pageid: "welpager1", 
            itemClass: "li-item1",
			pageIndex: 1

        });
		
		
		$(".listShow2").cPager({
            pageSize: <?php echo $setts[0]->site_comment_per;?>, 
            pageid: "welpager2", 
            itemClass: "li-item2",
			pageIndex: 1

        });
		
		
		
		
		
    });
    </script>

<script src="<?php echo $url;?>/local/resources/views/theme/video/videopopup.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo $url;?>/local/resources/views/theme/video/videopopup.css" media="screen" />
</head>
<body class="index">

    

    <!-- fixed navigation bar -->
    @include('header')

    <div class="promo-area" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $setts[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="promo-text">
                        <h1 class="avigher-title bolder fontsize30"><?php echo $item_title;?></h1>
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
                        <li class="breadcrumb-item active"><?php echo $item_title;?></li>
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


<?php if(!empty($items_count)){?>
    <div class="row">
    
    <div class="col-md-12">
     @if(Session::has('support_success'))

	    <div class="alert alert-success marginbottom_off">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
	      {{ Session::get('support_success') }}

	    </div>
        <div class="height20"></div>
	@endif
    </div>
    
    
                <div class="col-md-8 col-sm-12">
                    <!-- SINGLE PRODUCT START -->
                    <div class="single-product">
                        <div class="s-product-thumb">
                        
                     
                        <?php
						   /* item meta */
		$check_item_meta = DB::table('product_metas')
		        ->where('item_token', '=' , $item_token)
				->where('item_meta_key', '=' , "item_video_preview")
		        
				->count();
		if(!empty($check_item_meta))
		{
		   
		    $item_meta_well = DB::table('product_metas')
		        ->where('item_token', '=' , $item_token)
				->where('item_meta_key', '=' , "item_video_preview")
		        
				->count();
				
			if(!empty($item_meta_well))
			{	
		   $item_meta = DB::table('product_metas')
		        ->where('item_token', '=' , $item_token)
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
                       
                          <?php if(!empty($video_status)){ if($item_script_type=="code"){ if($site_file_upload_by == "s3_server"){ $videourll = Storage::disk('s3')->url($video_status);?> 
                        
                        <div id="vidBox">
        <div id="videCont">
		<video id="v1" loop controls>
            <source src="<?php echo $videourll;?>" type="video/mp4">
           
        </video>
         </div>
        </div>
        <?php } else { ?>
        <div id="vidBox">
        <div id="videCont">
		<video id="v1" loop controls>
            <source src="<?php echo $url;?>/local/images/media/video/<?php echo $video_status;?>" type="video/mp4">
           
        </video>
         </div>
        </div>
        <?php } ?>
            <script type="text/javascript">
            $(function () {
               $('#vidBox').VideoPopUp({
                	backgroundColor: "#17212a",
                	opener: "video<?php echo $item_token;?>",
                    maxweight: "340",
                    idvideo: "v1"
                });
            });
    </script>
                        
                  <?php } } ?>      
                        
                        <div class="clearfix"></div>
                        
                        
                            <?php if($img_url!=""){?><img src="<?php echo $img_url;?>" alt="images"><?php } ?>




<div class="like_view_download_info">
    <?php if(Auth::check()) 
          {
          if($item_user_id!=Auth::user()->id)
          {
          $get_viewer = DB::table('product_likes')->where('item_id','=',$item_id)->where('user_id','=',Auth::user()->id)->count();
    ?>    
    <a href="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $item_slug;?>/like"><i class="<?php if(empty($get_viewer)){?>fa fa-heart-o <?php } else {?>fa fa-heart<?php }?> heart_icon"></i></a>
    <?php
    } } else { ?>
    <a href="javascript:void(0);" onClick="javascript:alert('Login user only');"><i class="fa fa-heart-o heart_icon"></i></a>
    <?php } ?>
    <?php if(!empty($video_status)){ if($item_script_type=="code"){?>
    <a href="javascript:void(0);" id="video<?php echo $item_token;?>"><i class="fa fa-play-circle heart_icon" aria-hidden="true" style="font-size:40px;"></i></a>
    <?php }  } ?>

</div>







                            
                        </div>
                        
                        
                        







                        
                        <div class="demo-social">
                            <div class="p-demo-btn">
                            <?php $pro_sluger = base64_encode($url.'/item/'.$item_id.'/'.$item_slug);?>
                            
                            
                            <?php if(!empty($demo_url)){ if($demo_url == "#" ) { if($item_script_type=="code"){?>
                            
                            <a href="<?php echo $demo_url;?>" class="custom-btn_review" target="_blank"><?php echo translate( 541, $lang);?> <i class="fa fa-heart-o"></i> </a>
                            
                            <?php } } else { $ser_trip = str_replace("/","-",$demo_url);?>
                            
                            <?php 
							if($site_preview_iframe=="on")
							{
							  $prev_url = $url.'/preview/'.$ser_trip.'/'.$pro_sluger;
							}
							else
							{
							   $prev_url = $demo_url;
							}
							if($item_script_type=="code"){
                            ?>
                            <a href="<?php echo $prev_url;?>" class="custom-btn_review" target="_blank"><?php echo translate( 541, $lang);?>  </a><?php } } } ?>
                    
                    <?php
						  $viewimg_counter = DB::table('product_images')
		                              ->where('item_token', '=' , $item_token)
				                      ->count();
							if(!empty($viewimg_counter)){
							
							$first_get = DB::table('product_images')
		                              ->where('item_token', '=' , $item_token)
				                      ->first();		  
						  ?>
                    
                                <a href="javascript:void(0);" class="custom-btn lumos-link thumbnail" id="image-1"><?php echo translate( 544, $lang);?> <i class="fa fa-eye"></i></a>
                    <?php } ?>
                    
                    



                    
                    <div class="d-none" id="img-repo">
          
                    <?php 
                    if(!empty($viewimg_counter)){
					  $viewimg_get = DB::table('product_images')
		                              ->where('item_token', '=' , $item_token)
				                      ->get();
					  foreach($viewimg_get as $gallery){ if($site_file_upload_by == "s3_server"){
					  
					  $ggimg = Storage::disk('s3')->url($gallery->image);
					  ?>
                    
                    
                    <div class="item" id="image-1">
			<img class="thumbnail img-responsive" title="" src="<?php echo $ggimg;?>" alt="image">
		</div>
        <?php } else {?>
        <div class="item" id="image-1">
			<img class="thumbnail img-responsive" title="image" src="<?php echo $url;?>/local/images/media/screenshots/<?php echo $gallery->image;?>" alt="image">
		</div>
                    
               <?php } } } ?>

                    </div>
                    


                    
                            </div>





    
                        





                            
                            <div class="p-demo-social">
                                <ul>
                                    
                            
      <li>                              
<a class="share-button avigher_social" data-share-url="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $item_slug;?>" data-share-network="facebook" data-share-text="<?php echo substr(html_entity_decode($item_title),0,80);?>" data-share-title="<?php echo $item_title;?>" data-share-via="<?php echo $setts[0]->site_name;?>" data-share-tags="" data-share-media="<?php echo $img_url;?>" href="javascript:void(0)"><i class="fa fa-facebook"></i></a>
</li>

<li>
<a class="share-button" data-share-url="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $item_slug;?>" data-share-network="twitter" data-share-text="<?php echo substr(html_entity_decode($item_title),0,80);?>" data-share-title="<?php echo $item_title;?>" data-share-via="<?php echo $setts[0]->site_name;?>" data-share-tags="" data-share-media="<?php echo $img_url;?>" href="javascript:void(0)"><i class="fa fa-twitter"></i></a>
</li>

<li>
<a class="share-button" data-share-url="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $item_slug;?>" data-share-network="pinterest" data-share-text="<?php echo substr(html_entity_decode($item_title),0,80);?>" data-share-title="<?php echo $item_title;?>" data-share-via="<?php echo $setts[0]->site_name;?>" data-share-tags="" data-share-media="<?php echo $img_url;?>" href="javascript:void(0)"><i class="fa fa-pinterest"></i></a>
</li>

<li>
<a class="share-button" data-share-url="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $item_slug;?>" data-share-network="googleplus" data-share-text="<?php echo substr(html_entity_decode($item_title),0,80);?>" data-share-title="<?php echo $item_title;?>" data-share-via="<?php echo $setts[0]->site_name;?>" data-share-tags="" data-share-media="<?php echo $img_url;?>" href="javascript:void(0)"><i class="fa fa-google-plus"></i></a>
</li>
                           

<script type="text/javascript">

	$(document).ready(function(){

		$('.share-button').simpleSocialShare();

	});

</script>
	
                                </ul>
                            </div>
                        </div>
                        
 
<div class="modal" id="modal-gallery" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button class="close black fontsize20" type="button" data-dismiss="modal"><i class="fa fa-times-circle-o fontsize20" aria-hidden="true"></i></button>
          <h3 class="modal-title"></h3>
      </div>
      <div class="modal-body">
          <div id="modal-carousel" class="carousel">
   
            <div class="carousel-inner">           
            </div>
            
            <a class="carousel-control new-control left" href="#modal-carousel" data-slide="prev"><i class="fa fa-chevron-left"></i></a>
            <a class="carousel-control new-control right" href="#modal-carousel" data-slide="next"><i class="fa fa-chevron-right"></i></a>
            
          </div>
      </div>
      
    </div>
  </div>
</div>
                        




<!--- 

<ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">{{translate( 547, $lang)}}</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">{{translate( 553, $lang)}}</a>
  </li>

  <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">{{translate( 550, $lang)}}</a>
  </li> 
   <li class="nav-item">
    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">{{translate( 1092, $lang)}}</a>
  </li> 




</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">...</div>
  <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
  <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
</div>
 ---->













                       
                        <!-- S-product Tab Start -->
                        <div class="s-product-tab">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="item_details" class="active"><a  href="#item_details" aria-controls="i-details" role="tab" data-toggle="tab"><?php echo translate( 547, $lang);?></a>
                                </li>
                                 <?php if(!empty($sale_count)){ if(!empty($item_rate_count)){?>
                                 <li role="reviews"><a href="#reviews" aria-controls="comments" role="tab" data-toggle="tab"><?php echo translate( 550, $lang);?></a>
                                </li>
                                <?php } } ?>
                                <li role="comments"><a href="#comments" aria-controls="comments" role="tab" data-toggle="tab"><?php echo translate( 553, $lang);?></a>
                                </li>
                                <?php if($item_support_item=="Yes"){?>
                                <li role="support"><a href="#support" aria-controls="support" role="tab" data-toggle="tab"><?php echo translate( 490, $lang);?></a>
                                </li>
                                <?php } ?>
                                
                                 <?php if(Auth::check()) {
								 
								 if($item_user_id!=Auth::user()->id)
								 {
								 
								 
								 ?> 
                                
                                <li role="report"><a href="#report" aria-controls="report" role="tab" data-toggle="tab"><?php echo translate( 1092, $lang);?></a>
                                </li>
                                
                                <?php } } else {?>
                                <li role="report"><a href="#report" aria-controls="report" role="tab" data-toggle="tab"><?php echo translate( 1092, $lang);?></a>
                                </li>
                                <?php } ?>
                                
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade in active show" id="item_details">
                                    <div class="item-detail-tab">
                                       <?php echo html_entity_decode($item_desc);?> 
                                    </div>
                                </div>
                                
                                <?php 
								
								if(!empty($sale_count)){
								
								if(!empty($item_rate_count)){
								$item_rate = DB::table('product_ratings')
													->where('item_id', '=', $item_id)
													->get();
								?>
                                <div role="tabpanel" class="tab-pane fade" id="reviews">
                                    
                                    <div class="comment-area">
                                        <ol class="comment-wrap">
                                            
                                            <?php foreach($item_rate as $item){
											
											$user_details = DB::table('users')
													->where('id', '=', $item->user_id)
													->get();
													
											$ratinger = $item->rating;		
											?>
                                            <li>
                                                <div class="single-comment">
                                                    <div class="comment-thumb">
                                                    <?php if(!empty($user_details[0]->photo)){?>
                                                        <img src="<?php echo $url;?>/local/media/userphoto/<?php echo $user_details[0]->photo;?>" alt="<?php echo $user_details[0]->name;?>">
                                                    <?php } else { ?> 
                                                    <img src="<?php echo $url;?>/local/images/nophoto.jpg" alt="User Image">
                                                    <?php } ?>   
                                                    </div>
                                                    <div class="comment-txt">
                                                        <h4 class="name"><?php echo $user_details[0]->name;?> </h4>
                                                        <p><?php echo $item->review;?></p>
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
                                                    
                                                </p><?php } if($ratinger==0){ ?> 
                                                 <p class="review-icon">
                                                    <span>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                     <i class="fa fa-star" aria-hidden="true"></i>
                                                     <i class="fa fa-star" aria-hidden="true"></i>
                                                    </span>
                                                    
                                                </p>
                                                
                                                <?php } ?>
                                                
                                                
                                                        
                                                        <a href="#" class="comment-btn disable_button"><span class="review_datetime"><i class="fa fa-calendar" aria-hidden="true"></i> <?php echo $item->review_date;?></span></a>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php } ?>
                                            
                                            
                                        </ol>
                                    </div>
                                    
                                    
                                </div>
                                <?php } } ?>
                                
                                
                                
                                
                                <div role="tabpanel" class="tab-pane fade" id="comments">
                                    <!-- PRODUCTS COMMENT -->
                                    <div class="comment-area">
                                        <ol class="comment-wrap listShow1">
                                           <?php  if(Auth::guest()) {  if(!empty($comment_count)){
										   $comment_item = DB::table('product_comments')
										                   ->where('item_token','=',$item_token)
														   ->where('item_id','=',$item_id)
														  ->where('comm_parent','=',0)
														   ->get();
										   ?> 
                                            <?php foreach($comment_item as $comment_view){
											
											$user_photo = DB::table('users')
						                                  ->where('id','=',$comment_view->comm_user_id)
				                                          ->get();
														  
														  
											$sub_comment_count = DB::table('product_comments')
														->where('item_token','=',$item_token)
														->where('item_id','=',$item_id)
														->where('comm_parent','=',$comment_view->comm_id)
														->count();				  
														  
											?>
                                            <div class="li-item1">
                                            <li>
                                                <div class="single-comment">
                                                    <div class="comment-thumb">
                                                         <?php if(!empty($user_photo[0]->photo)){?>
                                                        <img src="<?php echo $url;?>/local/images/media/userphoto/<?php echo $user_photo[0]->photo;?>" alt="{{$user_photo[0]->name}}">
                                                        <?php } else { ?>
                                                        <img src="<?php echo $url;?>/local/images/nophoto.jpg" border="0" alt="image">
                                                        <?php } ?>
                                                    </div>
                                                    <div class="comment-txt">
                                                        <h4 class="name"><?php echo $user_photo[0]->name;?> <?php if($comment_view->comm_user_id==$item_user_id){?><span class="authorbg"><?php echo translate( 556, $lang);?></span><?php } else {
													$subb_count = DB::table('product_orders')
														->where('user_id','=',$comment_view->comm_user_id)
														->where('item_id','=',$item_id)
														->where('status','=','completed')
														->where('approval_status','!=',"payment refunded to buyer")
														
														->count();
														$subb_getter = DB::table('product_orders')
														->where('user_id','=',$comment_view->comm_user_id)
														->where('item_id','=',$item_id)
														->where('status','=','completed')
														->where('approval_status','!=',"payment refunded to buyer")
														
														->get();		
														
														if(!empty($subb_count))
														{
														  $todayyer = date("Y-m-d");
														    
														 ?><span class="purchasebg">Purchased </span> <?php if($subb_getter[0]->license_end_date < $todayyer){?> <span class="expiredbg"> <?php echo translate( 559, $lang);?> </span> <?php } } } ?> <a href="#" class="comment_linkoff"><?php echo date("d M Y h:i:s a",strtotime($comment_view->comm_date));?></a></h4>
                                                        <p><?php echo $comment_view->comm_text;?></p>
                                                        
                                                    </div>
                                                </div>
                                               <div class="height20"></div>
                                            
                                            
                                            <?php if(!empty($sub_comment_count)){
											
											$sub_comment_view = DB::table('product_comments')
														->where('item_token','=',$item_token)
														->where('item_id','=',$item_id)
														->where('comm_parent','=',$comment_view->comm_id)
														->get();
											
											?>
                                            
                                            <?php foreach($sub_comment_view as $commentt_view){
											
											$user_photo = DB::table('users')
						                                  ->where('id','=',$commentt_view->comm_user_id)
				                                          ->get();
											?>
                                               
                                                <div class="single-comment">
                                                    <div class="comment-thumb">
                                                         <?php if(!empty($user_photo[0]->photo)){?>
                                                        <img src="<?php echo $url;?>/local/images/media/userphoto/<?php echo $user_photo[0]->photo;?>" alt="">
                                                        <?php } else { ?>
                                                        <img src="<?php echo $url;?>/local/images/nophoto.jpg" border="0">
                                                        <?php } ?>
                                                    </div>
                                                    <div class="comment-txt">
                                                        <h4 class="name"><?php echo $user_photo[0]->name;?> <?php if($commentt_view->comm_user_id==$item_user_id){?><span class="authorbg"><?php echo translate( 556, $lang);?></span><?php } else {
													$subb_count = DB::table('product_orders')
														->where('user_id','=',$commentt_view->comm_user_id)
														->where('item_id','=',$item_id)
														->where('status','=','completed')
														->where('approval_status','!=',"payment refunded to buyer")
														->count();
														$subb_getter = DB::table('product_orders')
														->where('user_id','=',$commentt_view->comm_user_id)
														->where('item_id','=',$item_id)
														->where('status','=','completed')
														->where('approval_status','!=',"payment refunded to buyer")
														->get();		
														
														if(!empty($subb_count))
														{
														  $todayyer = date("Y-m-d");
														    
														 ?><span class="purchasebg">Purchased</span> <?php if($subb_getter[0]->license_end_date < $todayyer){?> <span class="expiredbg"> <?php echo translate( 559, $lang);?> </span> <?php } } } ?> <a href="#" class="comment_linkoff"><?php echo date("d M Y h:i:s a",strtotime($commentt_view->comm_date));?></a></h4>
                                                        <p><?php echo $commentt_view->comm_text;?></p>
                                                        
                                                    </div>
                                                </div>
                                                <div class="height20"></div>
                                                
                                            </li>
                                            
                                            </div>
                                           
                                            
                                            <?php } } ?>
                                            
                                            
                                            
                                            <?php } } } ?>
                                            
                                        </ol>
                                        
                                    </div>
                                    <?php  if(Auth::guest()) {  if(!empty($comment_count)){?>
                                    
                                    <div class="turn-page" id="welpager1"></div><?php } } ?>
                                    <!-- PRODUCTS COMMENT -->

                                    <?php if(Auth::check()) {
									
									
									
									?>
                                    <div class="add-comment">
                                        
                                        <div class="ac-wrap">
                                            
                                            <?php   if(!empty($comment_count)){
											
											$comment_item = DB::table('product_comments')
														->where('item_token','=',$item_token)
														->where('item_id','=',$item_id)
														->where('comm_parent','=',0)
														->get();
											?> 
                                            <form id="formID_n1" enctype="multipart/form-data" method="post" action="{{ route('comment_item_reply') }}">
                                            {{ csrf_field() }}
											<div class="comment-area">
                                        <ol class="comment-wrap listShow2">
                                            <?php foreach($comment_item as $comment_view){
											
											$user_photo = DB::table('users')
						                                  ->where('id','=',$comment_view->comm_user_id)
				                                          ->get();
														  
														  
												$sub_comment_count = DB::table('product_comments')
														->where('item_token','=',$item_token)
														->where('item_id','=',$item_id)
														->where('comm_parent','=',$comment_view->comm_id)
														->count();		  
														  
											?>
                                            
                                           
                                            <div class="li-item2">
                                            <li>
                                                <div class="single-comment">
                                                    <div class="comment-thumb">
                                                    <?php if(!empty($user_photo[0]->photo)){?>
                                                        <img src="<?php echo $url;?>/local/images/media/userphoto/<?php echo $user_photo[0]->photo;?>" alt="" class="round_img">
                                                        <?php } else { ?>
                                                        <img src="<?php echo $url;?>/local/images/nophoto.jpg" border="0" class="round_img">
                                                        <?php } ?>
                                                    </div>
                                                    <div class="comment-txt">
                                                        <h4 class="name"><?php echo $user_photo[0]->name;?> <?php if($comment_view->comm_user_id==$item_user_id){?><span class="authorbg"><?php echo translate( 556, $lang);?></span><?php } else {
													$subb_count = DB::table('product_orders')
														->where('user_id','=',$comment_view->comm_user_id)
														->where('item_id','=',$item_id)
														->where('status','=','completed')
														->where('approval_status','!=',"payment refunded to buyer")
														
														->count();
														$subb_getter = DB::table('product_orders')
														->where('user_id','=',$comment_view->comm_user_id)
														->where('item_id','=',$item_id)
														->where('status','=','completed')
														->where('approval_status','!=',"payment refunded to buyer")
														
														->get();		
														
														if(!empty($subb_count))
														{
														  $todayyer = date("Y-m-d");
														    
														 ?><span class="purchasebg">Purchased </span> <?php if($subb_getter[0]->license_end_date < $todayyer){?> <span class="expiredbg"> <?php echo translate( 559, $lang);?> </span> <?php } } } ?> <a href="#"><?php echo date("d M Y h:i:s a",strtotime($comment_view->comm_date));?></a></h4>
                                                        <p><?php echo $comment_view->comm_text;?></p>
                                                         
                                                         <?php if($comment_view->comm_user_id != Auth::user()->id && Auth::user()->id == $item_user_id){?>
                                                         <a href="javascript:void(0);" class="comment-btn" id="driver<?php echo $comment_view->comm_id;?>"><i class="fa fa-reply" aria-hidden="true"></i><?php echo translate( 562, $lang);?></a>
                                                         <?php } ?>
                                                    </div>
                                                </div> 
                                           
                                            <div class="height20  clearfix"></div>
                                            <?php if(!empty($sub_comment_count)){
											
											$sub_comment_view = DB::table('product_comments')
														->where('item_token','=',$item_token)
														->where('item_id','=',$item_id)
														->where('comm_parent','=',$comment_view->comm_id)
														->get();
											
											?>
                                            
                                            <?php foreach($sub_comment_view as $commentt_view){
											
											$user_photo = DB::table('users')
						                                  ->where('id','=',$commentt_view->comm_user_id)
				                                          ->get();
											?>
                                           
                                            
                                                <div class="single-comment">
                                                    <div class="comment-thumb">
                                                    <?php if(!empty($user_photo[0]->photo)){?>
                                                        <img src="<?php echo $url;?>/local/images/media/userphoto/<?php echo $user_photo[0]->photo;?>" alt="" class="round_img">
                                                        <?php } else { ?>
                                                        <img src="<?php echo $url;?>/local/images/nophoto.jpg" border="0" class="round_img">
                                                        <?php } ?>
                                                    </div>
                                                    <div class="comment-txt">
                                                        <h4 class="name"><?php echo $user_photo[0]->name;?> <?php if($commentt_view->comm_user_id==$item_user_id){?><span class="authorbg"><?php echo translate( 556, $lang);?></span><?php } else {
													$subb_count = DB::table('product_orders')
														->where('user_id','=',$commentt_view->comm_user_id)
														->where('item_id','=',$item_id)
														->where('status','=','completed')
														->where('approval_status','!=',"payment refunded to buyer")
														->count();
														$subb_getter = DB::table('product_orders')
														->where('user_id','=',$commentt_view->comm_user_id)
														->where('item_id','=',$item_id)
														->where('status','=','completed')
														->where('approval_status','!=',"payment refunded to buyer")
														->get();		
														
														if(!empty($subb_count))
														{
														  $todayyer = date("Y-m-d");
														    
														 ?><span class="purchasebg">Purchased</span> <?php if($subb_getter[0]->license_end_date < $todayyer){?> <span class="expiredbg"> <?php echo translate( 559, $lang);?> </span> <?php } } } ?> <a href="#"><?php echo date("d M Y h:i:s a",strtotime($commentt_view->comm_date));?></a></h4>
                                                        <p><?php echo $commentt_view->comm_text;?></p>
                                                         
                                                         <?php if($commentt_view->comm_user_id != Auth::user()->id && Auth::user()->id == $item_user_id){?>
                                                         <a href="javascript:void(0);" class="comment-btn" id="driver<?php echo $commentt_view->comm_id;?>"><i class="fa fa-reply" aria-hidden="true"></i><?php echo translate( 562, $lang);?></a>
                                                         <?php } ?>
                                                    </div>
                                                </div> 
                                            		<div class="height20  clearfix"></div>	  
                                            
                                             
                                            <?php } } ?>
                                            
                                           
                                            <?php if($comment_view->comm_user_id != Auth::user()->id && Auth::user()->id == $item_user_id){?>
                                            <script type="text/javascript">
									$(document).ready(function(){
											$("#driver<?php echo $comment_view->comm_id;?>").click(function(){
											   $("#text<?php echo $comment_view->comm_id;?>").slideToggle("slow");
										  });
										});
									</script>
                                            
                                            <div id="text<?php echo $comment_view->comm_id;?>" style="display:none; margin-top:10px;">
                                                <div class="col-md-1 paddingoff">
                                                <?php if(!empty($user_photo_url)){?>
                                                <img src="<?php echo $url;?>/local/images/media/userphoto/<?php echo $user_photo_url;?>" border="0" class="round_img">
                                                <?php } else {?>
                                                <img src="<?php echo $url;?>/local/images/nophoto.jpg" border="0" class="round_img"/>
                                                <?php } ?>
                                                </div>
                                                <div class="col-md-11 text-right">
                                                
                                                     
                                                      <input type="text" class="form-control validate[required] text-input" required="required"  name="comm_text_reply[]" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 30px;">  
                                                        <div class="height10"></div>
                                                        
                                                        
                                                        <button class="custom-btn_review" type="submit"><?php echo translate( 562, $lang);?></button>
                                                      
                                                    </div>
                                                  </div> 
                                                  <input type="hidden" name="comm_id[]" value="<?php echo $comment_view->comm_id;?>"> 
                                                  <div class="height20 clearfix"></div>
                                                </li>
                                                </div>
                                            <?php } ?>
                                            
                                           
                                            
                                       
                                    
                                    
                                    
                                    
                                    
                                    	
                                            <div class="height10"></div>
                                            <input type="hidden" name="comm_user_id" value="<?php echo Auth::user()->id;?>">
                                                <input type="hidden" name="item_user_id" value="<?php echo $item_user_id;?>">
                                                <input type="hidden" name="item_id" value="<?php echo $item_id;?>">
                                                <input type="hidden" name="item_token" value="<?php echo $item_token;?>">
                                                
                                            <?php } ?>
											 </ol>
                                    </div>
									
                                    
											
                                            </form>
                                            
                                            <form id="formID_n2" enctype="multipart/form-data" method="post" action="{{ route('comment_item') }}">
                                            {{ csrf_field() }}
                                                <div class="row">
                                                <div class="col-md-1 paddingoff">
                                                <?php if(!empty($user_photo_url)){?>
                                                <img src="<?php echo $url;?>/local/images/media/userphoto/<?php echo $user_photo_url;?>" border="0" class="round_img">
                                                <?php } else {?>
                                                <img src="<?php echo $url;?>/local/images/nophoto.jpg" border="0" class="round_img"/>
                                                <?php } ?>
                                                </div>
                                                <div class="col-md-11 text-right">
                                                <input type="hidden" name="comm_user_id" value="<?php echo Auth::user()->id;?>">
                                                <input type="hidden" name="item_user_id" value="<?php echo $item_user_id;?>">
                                                <input type="hidden" name="item_id" value="<?php echo $item_id;?>">
                                                <input type="hidden" name="item_token" value="<?php echo $item_token;?>">
                                                <input type="hidden" name="comm_id" value="0">
                                                     
                                                      <input type="text" class="form-control validate[required] text-input" id="comm_text" required="required" name="comm_text" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 30px;">  
                                                        <div class="height10"></div>
                                                        
                                                        
                                                        <button class="custom-btn_review" type="submit"><?php echo translate( 565, $lang);?></button>
                                                      
                                                    </div>
                                                </div>
                                                
                                                
                                                 <?php } else {  ?>
                                                  <form id="formID_n2" enctype="multipart/form-data" method="post" action="{{ route('comment_item') }}">
                                            {{ csrf_field() }}
                                                 <div class="row">
                                                <div class="col-md-1 paddingoff">
                                                <?php if(!empty($user_photo_url)){?>
                                                <img src="<?php echo $url;?>/local/images/media/userphoto/<?php echo $user_photo_url;?>" border="0" class="round_img">
                                                <?php } else {?>
                                                <img src="<?php echo $url;?>/local/images/nophoto.jpg" border="0" class="round_img"/>
                                                <?php } ?>
                                                </div>
                                                <div class="col-md-11 text-right">
                                                <input type="hidden" name="comm_user_id" value="<?php echo Auth::user()->id;?>">
                                                <input type="hidden" name="item_user_id" value="<?php echo $item_user_id;?>">
                                                <input type="hidden" name="item_id" value="<?php echo $item_id;?>">
                                                <input type="hidden" name="item_token" value="<?php echo $item_token;?>">
                                                <input type="hidden" name="comm_id" value="0">
                                                     
                                                      <input type="text" class="form-control validate[required] text-input" id="comm_text" required="required" name="comm_text" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 30px;">  
                                                        <div class="height10"></div>
                                                        
                                                        
                                                        <button class="custom-btn_review" type="submit"><?php echo translate( 565, $lang);?></button>
                                                      
                                                    </div>
                                                </div>
                                                
                                                
                                                <?php } ?>
                                                 
                                                 
                                                 
                                                 
                                                
                                            </form>
											<div class="turn-page" id="welpager2"></div>
                                            <div class="height10"></div>
                                        </div>
                                    </div>
                                    <?php } ?>
                                    
                                    
                                </div>
                                
                                
                                

                                
                                
                                <div role="tabpanel" class="tab-pane fade" id="report">
                                    <div class="item-support">
                                        <h3><?php echo translate( 1098, $lang);?></h3>
                                        <?php if(Auth::check()) {} else { ?>
                                       <p><?php echo translate( 1119, $lang);?> <a href="<?php echo $url;?>/login"><?php echo translate( 574, $lang);?></a> <?php echo translate( 1122, $lang);?></p><?php } ?>
                                 <?php if(Auth::check()) {
								 
								 if($item_user_id!=Auth::user()->id)
								 {
								 
								 
								 ?>       
                                <form id="formIDreport" enctype="multipart/form-data" method="post" action="{{ route('report_item') }}">
                                {{ csrf_field() }}
                                 <div class="form-group">
                                  <label><?php echo translate( 1095, $lang);?> </label>
                                  <select class="form-control validate[required]"  name="report_category">
                                  <option value=""></option>
                                  <option value="Copyright and trademark"><?php echo translate( 1101, $lang);?></option>
                                  <option value="Listing practices"><?php echo translate( 1104, $lang);?></option>
                                  <option value="Prohibited and restricted items"><?php echo translate( 1107, $lang);?></option>
                                  </select>
                                </div>
                                <div class="form-group">
                                  <label><?php echo translate( 1110, $lang);?> </label>
                                  <textarea name="report_message" class="form-control support_message validate[required] text-input"></textarea>
                                </div>
                                <input type="hidden" name="report_user_id" value="<?php echo Auth::user()->id;?>">
                                <input type="hidden" name="item_user_id" value="<?php echo $item_user_id;?>">
                                <input type="hidden" name="item_id" value="<?php echo $item_id;?>">
                                
                                <button type="submit" class="custom-btn"><?php echo translate( 1113, $lang);?></button>
                              </form>
                                   <?php  } } ?>     
                                        
                                        
                                    </div>
                                </div>
                                
                                
                                
                                
                                
                                
                                
                                <div role="tabpanel" class="tab-pane fade" id="support">
                                    <div class="item-support">
                                        <h3><?php echo translate( 568, $lang);?></h3>
                                        <p><a href="<?php echo $url;?>/<?php echo $author_slug;?>"><?php echo $author;?></a> <?php if($item_support_item=="Yes"){?><?php echo translate( 490, $lang);?><?php } else {?><?php echo translate( 571, $lang);?><?php } ?> this item. <?php if(Auth::check()) { } else {?><?php echo translate( 1119, $lang);?> <a href="<?php echo $url;?>/login"><?php echo translate( 574, $lang);?></a> <?php echo translate( 577, $lang);?><?php } ?></p>
                                        
                                        
                                        
                                        
                                 <?php if(Auth::check()) {
								 
								 if($item_user_id!=Auth::user()->id)
								 {
								 
								 if($item_support_item=="Yes"){
								 ?>       
                                <form id="formID" enctype="multipart/form-data" method="post" action="{{ route('support_item') }}">
                                {{ csrf_field() }}
                                 <div class="form-group">
                                  <label><?php echo translate( 955, $lang);?> </label>
                                  <input type="email" class="form-control" id="buyer_email" value="<?php echo Auth::user()->email;?>" readonly name="buyer_email">
                                </div>
                                <div class="form-group">
                                  <label><?php echo translate( 250, $lang);?> </label>
                                  <textarea name="support_message" class="form-control support_message validate[required] text-input"></textarea>
                                </div>
                                <input type="hidden" name="buyer_name" value="<?php echo Auth::user()->name;?>">
                                <input type="hidden" name="vendor_email" value="<?php echo $author_email;?>">
                                <input type="hidden" name="vendor_name" value="<?php echo $author;?>">
                                
                                <button type="submit" class="custom-btn"><?php echo translate( 580, $lang);?></button>
                              </form>
                                   <?php } } } ?>     
                                        
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- PRODUCT TAB END -->
                    </div>
                    <!-- SINGLE PRODUCT END -->
                </div>
                
               <?php
						   /* item meta */
		/*$check_item_file = DB::table('product_metas')
		        ->where('item_token', '=' , $item_token)
				->where('item_meta_key', '=' , "item_type")
		        
				->count();
		if(!empty($check_item_file))
		{
		   
		    $item_meta_well = DB::table('product_metas')
		        ->where('item_token', '=' , $item_token)
				->where('item_meta_key', '=' , "item_type")
		        
				->count();
				
			if(!empty($item_meta_well))
			{	
		   $item_meta = DB::table('product_metas')
		        ->where('item_token', '=' , $item_token)
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
		
		
		/* item meta */
						
		
						   ?>
                
                
                <div class="col-md-4 col-sm-12">
                    <aside class="product-sidebar">
                       
                        
                    <?php if($free_status=="yes"){?>
                    <div class="product-widget">
                           <div class="item-information"><?php echo translate( 583, $lang);?> <a href="<?php echo $url;?>/free-items"><?php echo translate( 586, $lang);?></a>. <?php echo translate( 589, $lang);?></div>
                            <div  align="center">
                            <?php  if(Auth::check()) {?>
                            <a href="<?php echo $url;?>/free-item/<?php echo base64_encode($item_token);?>" class="custom-btn"><i class="fa fa-download"></i> <?php echo translate( 592, $lang);?></a>
                            <?php } else { ?>
                            <a href="<?php echo $url;?>/login" class="custom-btn"><i class="fa fa-download"></i> <?php echo translate( 592, $lang);?></a>
                            <?php } ?>
                            <br>
                            <a class="btn btn-warning mt-5" href="{{$url}}/page/donate">Donate Now</a>
                            </div>
                            <div class="height20"></div>
                        </div>
                    <?php } ?>
                     <form class="" role="form" method="POST" action="{{ route('item') }}" id="formID" enctype="multipart/form-data">
                       {{ csrf_field() }}
                    
                        <div class="product-widget">
                            
                             <input type="text" name="amount" id="amount" class="currency" onFocus="this.blur()" value="<?php echo $regular_price_six_month;?> <?php echo $setts[0]->site_currency;?>"/>
                            <div class="price-info">
                            <?php if($item_future_update=="Yes"){ $icons = '<i class="fa fa-check-square-o"></i>'; } else if($item_future_update=="No"){ $icons = '<i class="fa fa-times"></i>'; } else { $icons = ""; }
							if($item_support_item=="Yes"){ $icons_two = '<i class="fa fa-check-square-o"></i>'; } else if($item_support_item=="No"){ $icons_two = '<i class="fa fa-times"></i>'; } else { $icons_two = ""; }
							?>
                                <ul class="price-feature">
                                    <li><i class="fa fa-check-square-o"></i> <?php echo translate( 595, $lang);?> <?php echo $setts[0]->site_name;?></li>
                                    <li><?php echo $icons;?> <?php echo translate( 598, $lang);?></li>
                                    <li><?php echo $icons_two;?> <?php echo translate( 601, $lang);?></li>
                                    
                                </ul>
                                <div class="price-form">
                          
                                    <?php if(!empty( $regular_price_six_month)){?>
                                     <div class="form-group">
                                            <label>
                                                <input type="radio" class="support_price" value="<?php echo $regular_price_six_month;?>_1" name="support_price" checked> <?php echo translate( 604, $lang);?> &nbsp;<span style="color:<?php echo $setts[0]->site_button_color;?>">[<?php echo $regular_price_six_month;?> <?php echo $setts[0]->site_currency;?>]</span>
                                            </label>
                                        </div>
                                    <?php } ?>
                                    
                                    <?php if(!empty($regular_price_one_year)){?>
                                        <div class="form-group">
                                            <label>
                                                <input type="radio" class="support_price" value="<?php echo $regular_price_one_year;?>_2" name="support_price"> <?php echo translate( 607, $lang);?> &nbsp;<span style="color:<?php echo $setts[0]->site_button_color;?>">[<?php echo $regular_price_one_year;?> <?php echo $setts[0]->site_currency;?>]</span>
                                            </label>
                                        </div>
                                    <?php } ?>
                                    <?php if(!empty($extended_price_six_month)){?>
                                        <div class="form-group">
                                            <label>
                                                <input type="radio" class="support_price" value="<?php echo $extended_price_six_month;?>_3" name="support_price"> <?php echo translate( 610, $lang);?> &nbsp;<span style="color:<?php echo $setts[0]->site_button_color;?>">[<?php echo $extended_price_six_month;?> <?php echo $setts[0]->site_currency;?>]</span>
                                            </label>
                                        </div>
                                    <?php } ?> 
                                    <?php if(!empty($extended_price_one_year)){?>   
                                        <div class="form-group">
                                            <label>
                                                <input type="radio" class="support_price" value="<?php echo $extended_price_one_year;?>_4" name="support_price"> <?php echo translate( 613, $lang);?> &nbsp;<span style="color:<?php echo $setts[0]->site_button_color;?>">[<?php echo $extended_price_one_year;?> <?php echo $setts[0]->site_currency;?>]</span>
                                            </label>
                                        </div>
                                     <?php } ?>   
                                        
                                        
                                       <div>
                                       <a href="<?php echo $url;?>/page/item-support"><?php echo translate( 616, $lang);?></a>
                                       
                                       </div> 
                                    
                                </div>
                                <?php if(Auth::check()) {
								
								if($item_user_id==Auth::user()->id)
								{
								  if(Auth::user()->admin==1)
								  {
								 ?>
                                 <a href="<?php echo $url;?>/admin/edit-item/<?php echo $item_token;?>" class="custom-btn" value="buy now"><?php echo translate( 619, $lang);?></a>
                                 <?php
								 }
								 else
								 {
								 ?>
                                 <a href="<?php echo $url;?>/edit-item/<?php echo $item_token;?>" class="custom-btn" value="buy now"><?php echo translate( 619, $lang);?></a>
                                 <?php
								 } 
								 }
								 else
								 {
								    $today_date = date("Y-m-d");
								    $it_check = DB::table('product_orders')
												->where('user_id', '=', Auth::user()->id)
												->where('item_id', '=', $item_id)
												->where('status', '=', 'completed')
												->where('approval_status','!=','payment refunded to buyer')
												->where('license_end_date', '>=', $today_date)
												->count();
								  if(empty($it_check))
								  {				
								 
								 ?>
                                 <input type="hidden" name="user_id" value="<?php echo Auth::user()->id;?>">
                                 <input type="hidden" name="item_id" value="<?php echo $item_gain;?>">
                                 <input type="hidden" name="item_token" value="<?php echo $item_token;?>">
                                 <input type="hidden" name="item_user_id" value="<?php echo $item_user_id;?>">
                                <input type="submit" class="custom-btn" value="<?php echo translate( 622, $lang);?>">
                                <?php } }  } else { ?>
                                <a href="<?php echo $url;?>/login" class="custom-btn" value="buy now"><?php echo translate( 622, $lang);?></a>
								<?php } ?>
                            </div>
                        </div>
                        </form>
                        
                        <?php if(!empty($featured_count)){ ?>
                         <div class="product-widget">
                            <div class="feature-number">
                                <img src="<?php echo $url;?>/local/images/badges/feature_item.png" width="30" border="0" alt="<?php echo translate( 478, $lang);?> : <?php echo translate( 1164, $lang);?> <?php echo translate( 454, $lang);?> <?php echo translate( 25, $lang);?>" title="<?php echo translate( 478, $lang);?> : <?php echo translate( 1164, $lang);?> <?php echo translate( 454, $lang);?> <?php echo translate( 25, $lang);?>" class="elite_cls"> <span><?php echo translate( 1167, $lang);?></span>
                            </div>
                        </div>
                        
                        <?php } ?>
                        
                        <?php if($sold_price >= $author_level_six){?>
                        <div class="product-widget">
                            <div class="sells-number">
                                <img src="<?php echo $url;?>/local/images/badges/elite.png" width="30" border="0" alt="<?php echo translate( 1152, $lang);?>" title="<?php echo translate( 1152, $lang);?>" class="elite_cls"> <span><?php echo translate( 1152, $lang);?></span>
                            </div>
                        </div>
                        <?php } ?>
                        
                        
                        <div class="product-widget">
                           <h3 class="prodect-info-heading"><?php echo translate( 556, $lang);?></h3>
                            <div class="prodect-information rating_move">
                            <div class="col-md-4">
                            <a href="<?php echo $url;?>/<?php echo $author_slug;?>"><?php if(!empty($author_photo)){?><img src="<?php echo $url;?>/local/images/media/userphoto/<?php echo $author_photo;?>" class="itemauthor" border="0" alt="<?php echo $author;?>" /><?php } else { ?><img src="<?php echo $url;?>/local/images/nophoto.jpg" class="itemauthor" border="0" alt="<?php echo $author;?>" /><?php } ?></a>
                            </div>
                            
                            <div class="col-md-8">
                            <h3 style="margin-top:30px;"><a href="<?php echo $url;?>/<?php echo $author_slug;?>" class="black"><?php echo $author;?></a></h3>
                            </div>
                            </div>
                            
                            <div class="clearfix"></div>
                            <div class="col-md-4"></div>
                            <div class="col-md-8 flag">
                            
                            <?php if($profile_badges=="on"){?>
							<?php if(!empty($country_view)){?>
                            <img src="<?php echo $url;?>/local/images/media/flag/<?php echo $country_view;?>" width="30" border="0" alt="<?php echo translate( 1134, $lang);?> <?php echo $country_text;?>" title="<?php echo translate( 1134, $lang);?> <?php echo $country_text;?>"  style="width:28px; height:28px;">
                            
							<?php } ?>
							<?php } ?>
                            
                            <?php
							$from_date = strtotime($datter);
	   $today_date = strtotime(date("Y-m-d H:i:s"));
	   $diff = abs($today_date - $from_date);
	   $get_years = floor($diff / (365*60*60*24));
	   if($get_years == 1) { $year_badges = "1.png"; $member_year = translate( 1140, $lang); }
	   else if($get_years == 2) { $year_badges = "2.png"; $member_year = translate( 1143, $lang); }
	   else if($get_years == 3) { $year_badges = "3.png"; $member_year = translate( 1143, $lang); }
	   else if($get_years == 4) { $year_badges = "4.png"; $member_year = translate( 1143, $lang); }
	   else if($get_years == 5) { $year_badges = "5.png"; $member_year = translate( 1143, $lang); }
	   else if($get_years == 6) { $year_badges = "6.png";  $member_year = translate( 1143, $lang); }
	   else if($get_years == 7) { $year_badges = "7.png"; $member_year = translate( 1143, $lang); }
	   else if($get_years == 8) { $year_badges = "8.png"; $member_year = translate( 1143, $lang); }
	   else if($get_years == 9) { $year_badges = "9.png"; $member_year = translate( 1143, $lang); }
	   else if($get_years == 10) { $year_badges = "10.png"; $member_year = translate( 1143, $lang); }
	   else if($get_years > 10) { $year_badges = "10_plus.png"; $member_year = translate( 1143, $lang); }
	   else {$year_badges = ""; $member_year = ""; }
	   ?>
                            
                            <?php if(!empty($datter)){ if(!empty($get_years)){?>
                  <img src="<?php echo $url;?>/local/images/badges/<?php echo $year_badges;?>" width="30" border="0" alt="<?php echo $get_years;?> <?php echo $member_year;?>" title="<?php echo $get_years;?> <?php echo $member_year;?>">
                  <?php } } ?>
                  
                   <?php if($minimum_sells < $proders_details){?>
                  
                    <img src="<?php echo $url;?>/local/images/badges/exclusive.png" width="30" border="0" alt="<?php echo translate( 1146, $lang);?>" title="<?php echo translate( 1146, $lang);?>">
                       <?php } ?>  
                       
                       <?php if(!empty($trends_details)){?>
                        <img src="<?php echo $url;?>/local/images/badges/trends.png" width="30" border="0" alt="<?php echo translate( 1149, $lang);?>" title="<?php echo translate( 1149, $lang);?>">
                         <?php } ?>
                         
                         <?php if($sold_price >= $author_level_one && $author_level_two >= $sold_price){ $sold_badges = "sold1.png"; $level_no = 1; $level_price = $author_level_one; } 
						 else if($sold_price >= $author_level_two && $author_level_three >= $sold_price){ $sold_badges = "sold2.png"; $level_no = 2; $level_price = $author_level_two; }
						 else if($sold_price >= $author_level_three && $author_level_four >= $sold_price){ $sold_badges = "sold3.png"; $level_no = 3; $level_price = $author_level_three;}
						 else if($sold_price >= $author_level_four && $author_level_five >= $sold_price){ $sold_badges = "sold4.png"; $level_no = 4; $level_price = $author_level_four;}
						 else if($sold_price >= $author_level_five && $author_level_six >= $sold_price){ $sold_badges = "sold5.png"; $level_no = 5; $level_price = $author_level_five;}
						 else if($sold_price >= $author_level_six){ $sold_badges = "sold6.png"; $level_no = 6; $level_price = $author_level_six;}
						 else { $sold_badges = ""; $level_no = 0; $level_price = 0;}
						 ?>
                         
                          <?php  if(!empty($sold_price)){ if(!empty($sold_badges)){ ?>
                        <img src="<?php echo $url;?>/local/images/badges/<?php echo $sold_badges;?>" width="30" border="0" alt="<?php echo translate( 1155, $lang);?> <?php echo $level_no.' : ';?> <?php echo translate( 1158, $lang);?> <?php echo $setts[0]->site_currency;?> <?php echo $level_price.'+';?> <?php echo translate( 454, $lang);?> <?php echo translate( 25, $lang);?>" title="<?php echo translate( 1155, $lang);?> <?php echo $level_no.' : ';?> <?php echo translate( 1158, $lang);?> <?php echo $setts[0]->site_currency;?> <?php echo $level_price.'+';?> <?php echo translate( 454, $lang);?> <?php echo translate( 25, $lang);?>" style="border-radius:0px;">
                         <?php } } ?>
                         
                         <?php if($sold_price >= $author_level_six){?>
                         <img src="<?php echo $url;?>/local/images/badges/elite.png" width="30" border="0" alt="<?php echo translate( 1152, $lang);?>" title="<?php echo translate( 1152, $lang);?>" class="elite_cls">
                         
                         <?php } ?>
                         
                         
                         
                         <?php if($collector_details >= $collector_level_one && $collector_level_two >= $collector_details){ $sc_badges = "sc1.png"; $clevel_no = 1; $clevel_price = $collector_level_one; } 
						 else if($collector_details >= $collector_level_two && $collector_level_three >= $collector_details){ $sc_badges = "sc2.png"; $clevel_no = 2; $clevel_price = $collector_level_two; }
						 else if($collector_details >= $collector_level_three && $collector_level_four >= $collector_details){ $sc_badges = "sc3.png"; $clevel_no = 3; $clevel_price = $collector_level_three;}
						 else if($collector_details >= $collector_level_four && $collector_level_five >= $collector_details){ $sc_badges = "sc4.png"; $clevel_no = 4; $clevel_price = $collector_level_four;}
						 else if($collector_details >= $collector_level_five && $collector_level_six >= $collector_details){ $sc_badges = "sc5.png"; $clevel_no = 5; $clevel_price = $collector_level_five;}
						 else if($collector_details >= $collector_level_six){ $sc_badges = "sc6.png"; $clevel_no = 6; $clevel_price = $collector_level_six;}
						 else { $sc_badges = ""; $clevel_no = 0; $clevel_price = 0;}
						 ?>
                         
                          <?php if(!empty($collector_details)){ if(!empty($sc_badges)){ ?>
                        <img src="<?php echo $url;?>/local/images/badges/<?php echo $sc_badges;?>" width="30" border="0" alt="<?php echo translate( 1179, $lang);?> <?php echo $clevel_no.' : ';?> <?php echo translate( 1161, $lang);?> <?php echo $clevel_price.'+';?> <?php echo translate( 454, $lang);?> <?php echo translate( 25, $lang);?>" title="<?php echo translate( 1179, $lang);?> <?php echo $clevel_no.' : ';?> <?php echo translate( 1161, $lang);?> <?php echo $clevel_price.'+';?> <?php echo translate( 454, $lang);?> <?php echo translate( 25, $lang);?>" style="border-radius:0px;">
                         <?php } } ?>
                         
                         <?php if(!empty($featured_count)){ ?>
                         <img src="<?php echo $url;?>/local/images/badges/feature_item.png" width="30" border="0" alt="<?php echo translate( 478, $lang);?> : <?php echo translate( 1164, $lang);?> <?php echo translate( 454, $lang);?> <?php echo translate( 25, $lang);?>" title="<?php echo translate( 478, $lang);?> : <?php echo translate( 1164, $lang);?> <?php echo translate( 454, $lang);?> <?php echo translate( 25, $lang);?>" class="elite_cls">
                         <?php } ?>
                         
                         
                         
                          <?php if($referred_details >= $referred_level_one && $referred_level_two >= $referred_details){ $ref_badges = "ref1.png"; $rlevel_no = 1; $rlevel_price = $referred_level_one; } 
						 else if($referred_details >= $referred_level_two && $referred_level_three >= $referred_details){ $ref_badges = "ref2.png"; $rlevel_no = 2; $rlevel_price = $referred_level_two; }
						 else if($referred_details >= $referred_level_three && $referred_level_four >= $referred_details){ $ref_badges = "ref3.png"; $rlevel_no = 3; $rlevel_price = $referred_level_three;}
						 else if($referred_details >= $referred_level_four && $referred_level_five >= $referred_details){ $ref_badges = "ref4.png"; $rlevel_no = 4; $rlevel_price = $referred_level_four;}
						 else if($referred_details >= $referred_level_five && $referred_level_six >= $referred_details){ $ref_badges = "ref5.png"; $rlevel_no = 5; $rlevel_price = $referred_level_five;}
						 else if($referred_details >= $referred_level_six){ $ref_badges = "ref6.png"; $rlevel_no = 6; $rlevel_price = $referred_level_six;}
						 else { $ref_badges = ""; $rlevel_no = 0; $rlevel_price = 0;}
						 ?>
                         
                         <?php if(!empty($referred_details)){ if(!empty($ref_badges)){ ?>
                        <img src="<?php echo $url;?>/local/images/badges/<?php echo $ref_badges;?>" width="30" border="0" alt="<?php echo translate( 1170, $lang);?> <?php echo $rlevel_no.' : ';?> <?php echo translate( 1173, $lang);?> <?php echo $rlevel_price.'+';?> <?php echo translate( 1176, $lang);?>" title="<?php echo translate( 1170, $lang);?> <?php echo $rlevel_no.' : ';?> <?php echo translate( 1173, $lang);?> <?php echo $rlevel_price.'+';?> <?php echo translate( 1176, $lang);?>" style="border-radius:0px;">
                         <?php } } ?>
                            </div>
                            <div class="height10 clearfix"></div>
                            <div class="clearfix height10"></div>
                            
                        </div>
                        
                        <?php if($sale_count > 1){ $sale_text = translate( 625, $lang); } else { $sale_text = translate( 628, $lang); } ?>
                        <div class="product-widget">
                            <div class="sells-number">
                                <h3><i class="fa fa-cart-arrow-down" aria-hidden="true"></i> <span><?php echo $sale_count;?></span> <?php echo $sale_text;?></h3>
                            </div>
                        </div>
                        
                        
                        <div class="product-widget">
                           <h3 class="prodect-info-heading"><?php echo translate( 631, $lang);?></h3>
                            <div class="prodect-information rating_move">
                            <?php if(!empty($review_count_03)){ echo $rateus_new_03; } else { echo $rateus_empty_03; }?> 
                            </div>
                        </div>

                        <div class="product-widget">
                            <h3 class="prodect-info-heading"><?php echo translate( 634, $lang);?></h3>
                            <div class="prodect-information">
                               
                                    <ul>
                                    <li>
                                    
                                        <span class="info-name"><?php echo translate( 637, $lang);?></span>
                                        
                                        
                                       
                                        <span class="info-value"> <?php echo $first_update;?></span>
                                   </li>
                                   
                                   
                                   <li>
                                        <span class="info-name"><?php echo translate( 640, $lang);?></span>
                                        
                                        <span class="info-value"> <?php echo $last_update;?></span>
                                  </li>
                                  
                                  <li>
                                        <span class="info-name"><?php echo translate( 178, $lang);?></span>
                                       
                                        <span class="info-value overflow-wrap"><?php if(!empty($category_name)){?><?php echo rtrim($category_name,', ');?><?php } else {?><?php echo $category_name;?><?php } ?></span>
                                   
                                   </li>
                                   
                                  <?php if(!empty($framework_name)){?> 
                                   <li>
                                        <span class="info-name"><?php echo translate( 181, $lang);?></span>
                                       
                                        <span class="info-value overflow-wrap"><?php echo rtrim($framework_name,', ');?><?php } else {?><?php echo $framework_name;?></span>
                                   
                                   </li>
                                   <?php } ?>
                                   
                                   
                                   <li>
                                   
                                        <span class="info-name"><?php echo translate( 118, $lang);?></span>
                                        
                                        <span class="info-value"><?php echo $high_resolution;?></span>
                                   </li>
                                   
                                   
                                   <?php 
								   if(!empty($item_script_type))
								   {
								   if($item_script_type=="code"){?>
                                   
                                   <li style="padding-bottom:30px;">
                                        <span class="info-name"><?php echo translate( 121, $lang);?></span>
                                       
                                        <span class="info-value overflow-wrap"><?php echo str_replace(",",", ",$compatible_browser);?></span>
                                   </li>
                                   
                                   <li>
                                        <span class="info-name"><?php echo translate( 157, $lang);?></span>
                                        
                                        <span class="info-value overflow-wrap"> <?php echo str_replace(",",", ",$file_included);?></span>
                                  </li>
                                  
                                 <?php } } ?>
                                 
                                 <?php 
								   if(!empty($item_script_type))
								   {
								   if($item_script_type=="graphics"){?>
                                   <li>
                                        <span class="info-name"><?php echo translate( 1191, $lang);?></span>
                                        
                                        <span class="info-value overflow-wrap"> <?php echo $item_layered;?></span>
                                  </li>
                                  
                                  
                                   <li>
                                        <span class="info-name"><?php echo translate( 1194, $lang);?></span>
                                        
                                        <span class="info-value overflow-wrap"> <?php echo str_replace(",",", ",$graphics_files);?></span>
                                  </li>
                                  
                                  
                                   <li>
                                        <span class="info-name"><?php echo translate( 1197, $lang);?></span>
                                        
                                        <span class="info-value overflow-wrap"> <?php echo $adobe_cs_version;?></span>
                                  </li>
                                  
                                  
                                  <li>
                                        <span class="info-name"><?php echo translate( 1200, $lang);?></span>
                                        
                                        <span class="info-value overflow-wrap"> <?php echo $pixel_dimensions;?></span>
                                  </li>
                                  
                                  
                                  <li>
                                        <span class="info-name"><?php echo translate( 1203, $lang);?></span>
                                        
                                        <span class="info-value overflow-wrap"> <?php echo $print_dimensions;?></span>
                                  </li>
                                   
                                   <?php } } ?>
                                 
                                 
                                   
                                   <li>
                                        <span class="info-name"><?php echo translate( 205, $lang);?></span>
                                       
                                        <span class="info-value overflow-wrap">
										<?php /*?><a href="<?php echo $url;?>/tag/<?php echo $item_tags;?>"><?php echo str_replace(",",", ",$item_tags);?></a><?php */?>
                                        
                     <?php 
					 $post_tags = explode(',',$item_tags);
					 foreach($post_tags as $tags)
                    {
					$tag =strtolower(str_replace(" ","-",$tags)); 
					
					if(!empty($tags))
					{
					?>
                    <a href="<?php echo $url;?>/tag/item/<?php echo $tag;?>" class="item"><?php echo $tags;?>,</a>
                    <?php
					}
					}?>
                                        
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
            
            
            
            
            
            
            
            
            
            <?php /******* Related Items ************/ ?>
            <div class="height100"></div>
            <div class="row">
            <div class="col-md-12">
                    <div class="text-left">
                        <h2 class="section-title text-left"><?php echo translate( 643, $lang);?></h2>
                    </div>
                    <div class="height10"></div>
                </div>
                <?php if(!empty($related_cnt)){
				
				$items = DB::table('products')
				->where('delete_status', '=', '')
				->where('item_status', '=', 1)
				->where('item_id','!=',$item_id)
				->where('lang_code','=',$lang)
				->where('user_id','=',$item_user_id)
				->take(3)
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
                                <h3 class="product-name custom_tittle col-md-8 paddingoff"><a href="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $views->item_slug;?>"><?php echo $views->item_title;?></a> </h3>
                                <span class="alink col-md-4 paddingoff text-right">
                               @if($setts[0]->site_currency == "USD")
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
                
                
                <?php } } ?>
            </div>
            
            
          <?php /******* Related Items ************/ ?>  
            
    <?php } ?>



    
</div>
<div class="clearfix"></div>
</main>
	

	
	
      @include('footer')
</body>
</html>