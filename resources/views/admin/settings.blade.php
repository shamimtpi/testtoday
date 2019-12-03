<!DOCTYPE html>
<html lang="en">
  <head>
   
   @include('admin.title')
    
    @include('admin.style')
	<?php
   $logid = Auth::user()->id;
   $user_checkker = DB::select('select * from users where id = ?',[$logid]);
   $hidden = explode(',',$user_checkker[0]->show_menu);
   ?> 
    <script type="text/javascript">
	


function showDiver(elem)
{
   
   if(elem.value == 'static')
   {
      document.getElementById('heading_banner').style.display = "block";
	  document.getElementById('subheading_banner').style.display = "block";
   }
   else if(elem.value == 'slider')
   {
       document.getElementById('heading_banner').style.display = "none";
	  document.getElementById('subheading_banner').style.display = "none";
   }
   else
   {
     document.getElementById('heading_banner').style.display = "none";
	  document.getElementById('subheading_banner').style.display = "none";
   }
   
}


function showLoad(elem)
{

   if(elem.value == "1")
   {
     document.getElementById('animated').style.display = "block";
   }
   else if(elem.value == "0")
   {
     document.getElementById('animated').style.display = "none";
   }
   else
   {
     document.getElementById('animated').style.display = "none";
	}

}
</script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            @include('admin.sitename');

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            @include('admin.welcomeuser')
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            @include('admin.menu')
			
			
			
			
            <!-- /sidebar menu -->

            <!-- /menu footer buttons -->
            
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
       @include('admin.top')
		
		
		
		
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
         
		 
		 
         <?php  if (in_array(2, $hidden)){?>
		 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                  
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
                <?php $url = URL::to("/"); ?>    
                   <form class="form-horizontal form-label-left" role="form" method="POST" action="{{ route('admin.settings') }}" enctype="multipart/form-data" novalidate>
                     {{ csrf_field() }}  
                      <span class="section">Settings</span>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Site Name <span class="required">*</span>
                        </label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <input id="site_name" class="form-control col-md-7 col-xs-12"  name="site_name" value="<?php echo $translate_01[0]->name; ?>" required="required" type="text" readonly>
                        
					   </div>
                       <div class="col-md-2 col-sm-2 col-xs-12">
                       <a href="<?php echo $url;?>/admin/edittranslate/<?php echo $translate_01[0]->id; ?>" class="btn btn-success">Translate</a>
                       </div>
                       
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Site Description
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
						   <textarea id="site_desc" class="form-control col-md-7 col-xs-12" name="site_desc"><?php echo $settings[0]->site_desc; ?></textarea>
                        </div>
                      </div>
					  
					  <input type="hidden" name="save_desc" value="<?php echo $settings[0]->site_desc; ?>">
                      
                      
                      <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Site Keyword</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_keyword" type="text" name="site_keyword" value="<?php echo $settings[0]->site_keyword; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
                      
                      
                      
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Site Address
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          
						   <textarea id="site_address" class="form-control col-md-7 col-xs-12" name="site_address"><?php echo $settings[0]->site_address; ?></textarea>
                        </div>
                      </div>
                      
                      
					  <input type="hidden" name="save_address" value="<?php echo $settings[0]->site_address; ?>">
					  
					  <input type="hidden" name="save_key" value="<?php echo $settings[0]->site_keyword; ?>">
					  
					  
					  <input type="hidden" name="save_facebook" value="<?php echo $settings[0]->site_facebook; ?>">
					  <input type="hidden" name="save_twitter" value="<?php echo $settings[0]->site_twitter; ?>">
					  <input type="hidden" name="save_gplus" value="<?php echo $settings[0]->site_gplus; ?>">
					  <input type="hidden" name="save_pinterest" value="<?php echo $settings[0]->site_pinterest; ?>">
					  <input type="hidden" name="save_instagram" value="<?php echo $settings[0]->site_instagram; ?>">
					  
					  <input type="hidden" name="save_copyright" value="<?php echo $settings[0]->site_copyright; ?>">
					  
                      
                       <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Email</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_email" type="text" name="site_email" value="<?php echo $settings[0]->site_email; ?>" required="required"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
                      
                      
                      
                      <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Phone No</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_phone" type="text" name="site_phone" value="<?php echo $settings[0]->site_phone; ?>" required="required"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
                      
                      
                      
                      
					  <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Facebook Link</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_facebook" type="text" name="site_facebook" value="<?php echo $settings[0]->site_facebook; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
					  
					  
					  
					  <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Twitter Link</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_twitter" type="text" name="site_twitter" value="<?php echo $settings[0]->site_twitter; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
					  
					  
					  <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">GPlus Link</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_gplus" type="text" name="site_gplus" value="<?php echo $settings[0]->site_gplus; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
					  
					  
					  
					   <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Pinterest Link</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_pinterest" type="text" name="site_pinterest" value="<?php echo $settings[0]->site_pinterest; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
					  
					  
					  
					  
					  <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Instagram Link</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_instagram" type="text" name="site_instagram" value="<?php echo $settings[0]->site_instagram; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
					  
		<div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Footer Copyright</label> 
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <input id="site_copyright" type="text" name="site_copyright" value="<?php echo $translate_02[0]->name; ?>"  class="form-control col-md-7 col-xs-12" readonly>
						  
                        </div>
                        
                        <div class="col-md-2 col-sm-2 col-xs-12">
                       <a href="<?php echo $url;?>/admin/edittranslate/<?php echo $translate_02[0]->id; ?>" class="btn btn-success">Translate</a>
                       </div>
                      </div>	
                      
                      
                      
                      <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Product Item Per Page</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_post_per" type="text" name="site_post_per" value="<?php echo $settings[0]->site_post_per; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
                      
                      
                      
                      <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Product Comment Per Page</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_comment_per" type="text" name="site_comment_per" value="<?php echo $settings[0]->site_comment_per; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
                      
                      
                      
                      <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Blog Post Per Page</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_blog_per" type="text" name="site_blog_per" value="<?php echo $settings[0]->site_blog_per; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
                      
                      
                      
                      
                      <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Home Page Latest Item Category</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_latest_item" type="text" name="site_latest_item" value="<?php echo $settings[0]->site_latest_item; ?>"  required="required" class="form-control col-md-7 col-xs-12">(ex : 5 )
						  
                        </div>
                      </div>
                      
                      
                    <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Home Page Latest Item Count</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_latest_item_count" type="text" name="site_latest_item_count" value="<?php echo $settings[0]->site_latest_item_count; ?>"  required="required" class="form-control col-md-7 col-xs-12">(ex : 5 )
						  
                        </div>
                      </div>
                      
                      
                      
                      <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Home Page Display Featured Item Count</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_feature_item_count" type="text" name="site_feature_item_count" value="<?php if($sett_feature_item!=""){ echo $sett_feature_item; } ?>"  required="required" class="form-control col-md-7 col-xs-12">(ex : 5 )
						  
                        </div>
                      </div>
                      
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="currency">Back to top scroller<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<select name="site_back_to_top" required="required" class="form-control col-md-7 col-xs-12">
						<option value=""></option>
						<option value="on" <?php if($site_back_to_top=="on"){?> selected <?php } ?>>ON</option>
                        <option value="off" <?php if($site_back_to_top=="off"){?> selected <?php } ?>>OFF</option>
						</select>
                          
                        </div>
                      </div>
                      
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="currency">Homepage Customer Feedback<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<select name="site_customer_feedback" required="required" class="form-control col-md-7 col-xs-12">
						<option value=""></option>
						<option value="on" <?php if($site_customer_feedback=="on"){?> selected <?php } ?>>ON</option>
                        <option value="off" <?php if($site_customer_feedback=="off"){?> selected <?php } ?>>OFF</option>
						</select>
                          
                        </div>
                      </div>
                      
                      
                      
                      
                      
                      
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="currency">Translation Dropdown<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<select name="site_translation" required="required" class="form-control col-md-7 col-xs-12">
						<option value=""></option>
						<option value="on" <?php if($site_translation=="on"){?> selected <?php } ?>>ON</option>
                        <option value="off" <?php if($site_translation=="off"){?> selected <?php } ?>>OFF</option>
						</select>
                          
                        </div>
                      </div>
                      
                      
                      
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="currency">Preview Iframe<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<select name="site_preview_iframe" required="required" class="form-control col-md-7 col-xs-12">
						<option value=""></option>
						<option value="on" <?php if($site_preview_iframe=="on"){?> selected <?php } ?>>ON</option>
                        <option value="off" <?php if($site_preview_iframe=="off"){?> selected <?php } ?>>OFF</option>
						</select>
                          
                        </div>
                      </div>
                      
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="currency">Verify Purchase Details<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<select name="site_verify_purchase" required="required" class="form-control col-md-7 col-xs-12">
						<option value=""></option>
						<option value="on" <?php if($site_verify_purchase=="on"){?> selected <?php } ?>>ON</option>
                        <option value="off" <?php if($site_verify_purchase=="off"){?> selected <?php } ?>>OFF</option>
						</select>
                          
                        </div>
                      </div>
                      
                      
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="currency">Homepage Feature Item View<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<select name="site_feature_view" required="required" class="form-control col-md-7 col-xs-12">
						<option value=""></option>
						<option value="carousel" <?php if($site_feature_view=="carousel"){?> selected <?php } ?>>Carousel</option>
                        <option value="normal" <?php if($site_feature_view=="normal"){?> selected <?php } ?>>Normal</option>
						</select>
                          
                        </div>
                      </div>
                      
                      
                      
                      
                      
                      
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="currency">SEO slug<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<select name="site_seo_slug" required="required" class="form-control col-md-7 col-xs-12">
						<option value=""></option>
						<option value="yes" <?php if($site_seo=="yes"){?> selected <?php } ?>>Yes</option>
                        <option value="no" <?php if($site_seo=="no"){?> selected <?php } ?>>No</option>
						</select>
                          
                        </div>
                      </div>
                      
                      
                      
                      
                      		  
					  <input type="hidden" name="save_post_per" value="<?php echo $settings[0]->site_post_per; ?>">
                      
                      
                      
					   <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="currency">Currency <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<select name="currency" required="required" class="form-control col-md-7 col-xs-12">
						<option value=""></option>
						<?php foreach($currency as $newcurrency){?>
							   <option value="<?php echo $newcurrency->currency_code;?>" <?php if($settings[0]->site_currency==$newcurrency->currency_code){?> selected="selected" <?php } ?>><?php echo $newcurrency->currency_code;?></option>
						<?php } ?>
						</select>
                          
                        </div>
                      </div>
					 
					  
					  
					  
					<div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo">Logo
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="site_logo" name="site_logo" class="form-control col-md-7 col-xs-12">
						  
						   @if ($errors->has('site_logo'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('site_logo') }}</strong>
                                    </span>
                                @endif
						  
                        </div>
                      </div>
					   
					  <?php 
					   $settingphoto="/media/settings/";
						$path ='/local/images'.$settingphoto.$settings[0]->site_logo;
						if($settings[0]->site_logo!=""){
						?>
					  <div class="item form-group" align="center">
					  <div class="col-md-6 col-sm-6 col-xs-12">
					  <img src="<?php echo $url.$path;?>" class="thumb" width="100">
					  </div>
					  </div>
						<?php } else { ?>
					  <div class="item form-group" align="center">
					  <div class="col-md-6 col-sm-6 col-xs-12">
					  <img src="<?php echo $url.'/local/images/noimage.jpg';?>" class="logo" width="100">
					  </div>
					  </div>
						<?php } ?>
						
						
						
						
						<div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo">Favicon
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="site_favicon" name="site_favicon" class="form-control col-md-7 col-xs-12">
						   @if ($errors->has('site_favicon'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('site_favicon') }}</strong>
                                    </span>
                                @endif
						  
                        </div>
                      </div>
					  
					  
					  <?php 
					   $settingphotos="/media/settings/";
						$paths ='/local/images'.$settingphotos.$settings[0]->site_favicon;
						if($settings[0]->site_favicon!=""){
						?>
					  <div class="item form-group" align="center">
					  <div class="col-md-6 col-sm-6 col-xs-12">
					  <img src="<?php echo $url.$paths;?>" class="thumb" width="24" style="border:1px solid #CCCCCC;">
					  </div>
					  </div>
						<?php } else { ?>
					  <div class="item form-group" align="center">
					  <div class="col-md-6 col-sm-6 col-xs-12">
					  <img src="<?php echo $url.'/local/images/noimage.jpg';?>" class="logo" width="24" style="border:1px solid #CCCCCC;">
					  </div>
					  </div>
						<?php } ?>
						
						
						
						
						
						
						<div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo">Static Banner
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="site_banner" name="site_banner" class="form-control col-md-7 col-xs-12"><br/>[Please select an image 1920px / 300px]
						   @if ($errors->has('site_banner'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('site_banner') }}</strong>
                                    </span>
                                @endif
						  
                        </div>
                      </div>
					  
					  
					   <?php 
					   $bannerphotos="/media/settings/";
						$pathes ='/local/images'.$bannerphotos.$settings[0]->site_banner;
						if($settings[0]->site_banner!=""){
						?>
					  <div class="item form-group" align="center">
					  <div class="col-md-6 col-sm-6 col-xs-12">
					  <img src="<?php echo $url.$pathes;?>" class="thumb" width="200" style="border:1px solid #CCCCCC;">
					  </div>
					  </div>
						<?php } else { ?>
					  <div class="item form-group" align="center">
					  <div class="col-md-6 col-sm-6 col-xs-12">
					  <img src="<?php echo $url.'/local/images/noimage.jpg';?>" class="logo" width="100" style="border:1px solid #CCCCCC;">
					  </div>
					  </div>
						<?php } ?>
                        
                       
                        
                        
                       
						 <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Banner Heading</label> 
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <input id="site_banner_heading" type="text" name="site_banner_heading" value="<?php echo $translate_03[0]->name; ?>"  class="form-control col-md-7 col-xs-12" readonly>
						  
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                       <a href="<?php echo $url;?>/admin/edittranslate/<?php echo $translate_03[0]->id; ?>" class="btn btn-success">Translate</a>
                       </div>
                      </div>
                      
                      
                      
                      <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Banner Sub Heading</label> 
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <input id="site_banner_subheading" type="text" name="site_banner_subheading" value="<?php echo $translate_04[0]->name; ?>"  class="form-control col-md-7 col-xs-12" readonly>
						  
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                       <a href="<?php echo $url;?>/admin/edittranslate/<?php echo $translate_04[0]->id; ?>" class="btn btn-success">Translate</a>
                       </div>
                      </div>
						
						
                         <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Footer Newsletter Content</label> 
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <input id="site_footer_newsletter" type="text" name="site_footer_newsletter" value="<?php echo $translate_05[0]->name; ?>"  class="form-control col-md-7 col-xs-12" readonly>
						  
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                       <a href="<?php echo $url;?>/admin/edittranslate/<?php echo $translate_05[0]->id; ?>" class="btn btn-success">Translate</a>
                       </div>
                      </div>
                        
                        
                        <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="commission mode">Blog Enable? <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						
						<select name="site_blog_visible" id="site_blog_visible" class="form-control" required="required">
						<option value="">Select</option>
									<option value="yes" <?php { if($settings[0]->site_blog_visible=="yes") echo "selected='selected'"; }?>>Yes</option>
									<option value="no" <?php { if($settings[0]->site_blog_visible=="no") echo "selected='selected'"; }?>>No</option>
								</select>
						
                          
                        </div>
                      </div>
						
						
						
						<?php /* ?><div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="commission mode">Home page header type <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						
						<select name="header_type" id="header_type" class="form-control" required="required">
						<option value="">Select</option>
									<option value="static" <?php { if($settings[0]->header_type=="static") echo "selected='selected'"; }?>>Static Banner</option>
									<option value="slider" <?php { if($settings[0]->header_type=="slider") echo "selected='selected'"; }?>>Slideshow</option>
								</select>
						
                          
                        </div>
                      </div><?php */?>
						
						 
					 
                        
                        
					  
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="commission mode">Page Loading Animation <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						
						<select name="site_loading" id="site_loading" class="form-control" required="required" onChange="showLoad(this)">
						<option value="">Select</option>
									<option value="1" <?php { if($settings[0]->site_loading=="1") echo "selected='selected'"; }?>>On</option>
									<option value="0" <?php { if($settings[0]->site_loading=="0") echo "selected='selected'"; }?>>Off</option>
								</select>
						
                          
                        </div>
                      </div>
                      
                      
                      <div id="animated" <?php if($settings[0]->site_loading!="1"){?> style="display:none;" <?php } ?>>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo">Animated Gif Image 
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="site_loading_url" name="site_loading_url" <?php if($settings[0]->site_loading_url==""){?>required="required"<?php } ?> class="form-control col-md-7 col-xs-12"><br/>
                          ( Gif format only )						  
						   @if ($errors->has('site_loading_url'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('site_loading_url') }}</strong>
                                    </span>
                                @endif
						  
                        </div>
                      </div>
					   
					  <?php 
					   $setting_gif="/media/settings/";
						$pathh ='/local/images'.$setting_gif.$settings[0]->site_loading_url;
						if($settings[0]->site_loading_url!=""){
						?>
					  <div class="item form-group" align="center">
					  <div class="col-md-6 col-sm-6 col-xs-12">
					  <img src="<?php echo $url.$pathh;?>" class="thumb" width="100">
					  </div>
					  </div>
						<?php } else { ?>
					  <div class="item form-group" align="center">
					  <div class="col-md-6 col-sm-6 col-xs-12">
					  <img src="<?php echo $url.'/local/images/noimage.jpg';?>" class="logo" width="100">
					  </div>
					  </div>
						<?php } ?>
                      </div>
                      
                      <input type="hidden" name="save_loading_url" value="<?php echo $settings[0]->site_loading_url;?>">
					  
					  
					  
					 <?php /*?> <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Paypal Id</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="paypal_id" type="text" name="paypal_id" value="<?php echo $settings[0]->paypal_id; ?>"  class="form-control col-md-7 col-xs-12" required="required">
						  
                        </div>
                      </div><?php */?>
					  
					  
					  <?php /*?>
					  
					   <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="commission mode">Paypal site Mode <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						
						<select name="paypal_url" id="paypal_url" class="form-control" required="required">
						<option value="">Select</option>
									<option value="https://www.sandbox.paypal.com/cgi-bin/webscr" <?php { if($settings[0]->paypal_url=="https://www.sandbox.paypal.com/cgi-bin/webscr") echo "selected='selected'"; }?>>Test</option>
									<option value="https://www.paypal.com/cgi-bin/webscr" <?php { if($settings[0]->paypal_url=="https://www.paypal.com/cgi-bin/webscr") echo "selected='selected'"; }?>>Live</option>
								</select>
						
                          
                        </div>
                      </div><?php */?>
					  
					  
					  
						
						<?php /* ?><?php  if(in_array($draw,$narray)){?> checked <?php } ?><?php */?>
						
						<div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="commission mode">Apply Watermark Image <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						
						<select name="site_watermark_status" id="site_watermark_status" class="form-control" required="required">
						<option value="">Select</option>
									<option value="on" <?php { if($site_watermark_status=="on") echo "selected='selected'"; }?>>On</option>
									<option value="off" <?php { if($site_watermark_status=="off") echo "selected='selected'"; }?>>Off</option>
								</select>
						
                          
                        </div>
                      </div>
					  
					  
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="logo">Upload Watermark Image
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="site_watermark" name="site_watermark" class="form-control col-md-7 col-xs-12"><br/>[Please select minimum size image 200px / 50px]
						   @if ($errors->has('site_watermark'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('site_watermark') }}</strong>
                                    </span>
                                @endif
						  
                        </div>
                      </div>
					  
					  
					   <?php 
					   $bannerpotto="/media/settings/";
						$patyes ='/local/images'.$bannerpotto.$site_watermark;
						if($site_watermark!=""){
						?>
					  <div class="item form-group" align="center">
					  <div class="col-md-6 col-sm-6 col-xs-12">
					  <img src="<?php echo $url.$patyes;?>" class="thumb" width="200" style="border:1px solid #CCCCCC;">
					  </div>
					  </div>
						<?php } else { ?>
					  <div class="item form-group" align="center">
					  <div class="col-md-6 col-sm-6 col-xs-12">
					  <img src="<?php echo $url.'/local/images/noimage.jpg';?>" class="logo" width="100" style="border:1px solid #CCCCCC;">
					  </div>
					  </div>
						<?php } ?>
                        
                       
                        
                      
                      
                      
                      
                      
					  
						
						
						<div class="item form-group">
                        <label for="api" class="control-label col-md-3">Google Map Api Key</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_map_api" type="text" name="site_map_api" value="<?php echo $settings[0]->site_map_api; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
                      
                      
                      
                      <div class="item form-group">
                        <label for="api" class="control-label col-md-3">Site Primary Color</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_primary_color" type="text" name="site_primary_color" value="<?php echo $settings[0]->site_primary_color; ?>"  class="form-control col-md-7 col-xs-12" required="required">
						  (ex: #000000 )
                        </div>
                      </div>
                      
                      
                      
                      <div class="item form-group">
                        <label for="api" class="control-label col-md-3">Site Secondary Color</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_secondary_color" type="text" name="site_secondary_color" value="<?php echo $settings[0]->site_secondary_color; ?>"  class="form-control col-md-7 col-xs-12" required="required">
						  (ex: #000000 )
                        </div>
                      </div>
                      
                      
                      
                      <div class="item form-group">
                        <label for="api" class="control-label col-md-3">Site Button Color</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_button_color" type="text" name="site_button_color" value="<?php echo $settings[0]->site_button_color; ?>"  class="form-control col-md-7 col-xs-12" required="required">
						  (ex: #000000 )
                        </div>
                      </div>
					  
					  <div class="item form-group">
                        <label for="api" class="control-label col-md-3">Site Link Color</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_link_color" type="text" name="site_link_color" value="<?php echo $settings[0]->site_link_color; ?>"  class="form-control col-md-7 col-xs-12" required="required">
						  (ex: #000000 )
                        </div>
                      </div>
					  
					  
					  <?php /*?><div class="item form-group">
                        <label for="api" class="control-label col-md-3">Site Url</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="site_url" type="text" name="site_url" value="<?php echo $settings[0]->site_url; ?>"  class="form-control col-md-7 col-xs-12">
						  <br/> ( ex : http://www.yoursite.com/ )
                        </div>
                      </div><?php */?>
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Price Range Min Price</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="min_price_range" type="text" name="min_price_range" value="<?php echo $settings[0]->min_price_range; ?>"  class="form-control col-md-7 col-xs-12" required="required">
						  
                        </div>
                      </div>
                      
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Price Range Max Price</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="max_price_range" type="text" name="max_price_range" value="<?php echo $settings[0]->max_price_range; ?>"  class="form-control col-md-7 col-xs-12" required="required">
						  
                        </div>
                      </div>
                      
                      
                      
                      <input type="hidden" name="save_map_api" value="<?php echo $settings[0]->site_map_api; ?>">
                      
					  <input type="hidden" name="save_header_type" value="<?php echo $settings[0]->header_type; ?>">
                      
                      
                       
                       <input type="hidden" name="image_size" value="<?php echo $settings[0]->image_size; ?>">
                       <input type="hidden" name="image_type" value="<?php echo $settings[0]->image_type; ?>">
					  
					 
					  
					  <input type="hidden" name="save_siteurl" value="<?php echo $settings[0]->site_url; ?>">
					  
						
						
						<input type="hidden" name="current_watermark" value="<?php echo $site_watermark;?>">
						
					  
					  <input type="hidden" name="currentlogo" value="<?php echo $settings[0]->site_logo;?>">
					  
					  
					  <input type="hidden" name="currentfav" value="<?php echo $settings[0]->site_favicon;?>">
					  
					  <input type="hidden" name="currentban" value="<?php echo $settings[0]->site_banner;?>">
					 
					  
					  <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Google Analytics</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <textarea id="site_google_analytics" name="site_google_analytics" required="required" class="form-control col-md-7 col-xs-12" style="min-height:200px;align-content:left; text-align: left;">
                          <?php if($site_google_analytics!=""){ echo $site_google_analytics; } ?></textarea>
						  
                        </div>
                      </div>
                      
                      
                      
                      <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Live Chat Code</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12" style="color:#FF0000;">
                        Goto yourwebsite.com/local/resources/views/chat.blade.php<br/>
                        
                        just remove example code and replace your code<br/>
                        
                       <br/>
                        
                        
                        
                          <?php /*?><textarea id="site_live_chat" name="site_live_chat" class="form-control col-md-7 col-xs-12" style="min-height:200px;align-content:left; text-align: left;">
                          <?php if($site_live_chat!=""){ echo $site_live_chat; } ?></textarea><?php */?>
                          
                          <input type="hidden" name="site_live_chat" value="">
						  
                        </div>
                      </div>
					  
                     
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <a href="<?php echo $url;?>/admin/settings" class="btn btn-primary">Cancel</a>
						  <?php if(config('global.demosite')=="yes"){?><button type="button" class="btn btn-success btndisable">Submit</button> 
								<span class="disabletxt">( <?php echo config('global.demotxt');?> )</span><?php } else { ?>
						  
                          <button id="send" type="submit" class="btn btn-success">Submit</button>
								<?php } ?>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
               <?php }  ?> 
		
		
		
		
		
		
		
		
		
		
		
		
		
        <!-- /page content -->

      @include('admin.footer')
      </div>
    </div>

    
	
  </body>
</html>
