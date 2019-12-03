<!DOCTYPE html>
<html lang="en">
  <head>
   
   @include('admin.title')
    
    @include('admin.style')
	
    <?php
	
	if (isset($_SERVER['HTTPS']) &&
    ($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
    isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
    $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
  $protocol = 'https://';
}
else {
  $protocol = 'http://';
}

?>
<?php
   $logid = Auth::user()->id;
   $user_checkker = DB::select('select * from users where id = ?',[$logid]);
   $hidden = explode(',',$user_checkker[0]->show_menu);
   ?> 
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
         
		 
		 
		 
		 
         <?php  if (in_array(8, $hidden)){?>
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
    
    <div class="x_title">
                    <h2>Edit Item</h2>
                    
                    <div class="clearfix"></div>
					
                  </div>
              
              <?php $url = URL::to("/"); ?>   
                   <form class="form-horizontal form-label-left" role="form" method="POST" action="{{ route('admin.edit-item') }}"  enctype="multipart/form-data" novalidate>
                     {{ csrf_field() }} 
                     
                    
                    <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">


                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                      <?php foreach($language as $languages){?>
                        <li role="presentation" class="<?php if($languages->id==2){?>active<?php } ?>"><a href="#tab_content<?php echo $languages->id;?>" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><img src="<?php echo $url; ?>/local/images/media/language/<?php echo $languages->lang_flag;?>" style="max-width:24px; max-height:24px;"> <?php echo $languages->lang_name;?></a>
                        </li>
                       <?php } ?> 
                      </ul>
                      <div id="myTabContent" class="tab-content">
                      
                      
                      <?php foreach($language as $languagee){
					  if($languagee->lang_code=="en")
					  {
					      
						  $count_en = DB::table('products')
										->where('parent', '=', 0)
										->where('item_id', '=', $edit[0]->item_id)
										
										->count();
						  if(!empty($count_en))
						  {
						  $view = DB::table('products')
										->where('parent', '=', 0)
										->where('item_id', '=', $edit[0]->item_id)
										
										->get();
						  $viewname = $view[0]->item_title;
						  $viewdesc = $view[0]->item_desc;
						  $viewshort = $view[0]->item_short_desc;
						  
						  }	
						  else
						  {
						     $viewname = "";
							 $viewdesc = "";
							 $viewshort = "";
							 
							 
						  }			
								
										
					  }
					  else
					  {
					      $count_other = DB::table('products')
										->where('parent', '=', $edit[0]->item_id)
										->where('lang_code', '=', $languagee->lang_code)
										
										->count();
					      if(!empty($count_other))
						  {
					      $view = DB::table('products')
										->where('parent', '=', $edit[0]->item_id)
										->where('lang_code', '=', $languagee->lang_code)
										
										->get();
						   $viewname = $view[0]->item_title;
						  $viewdesc = $view[0]->item_desc;
						  $viewshort = $view[0]->item_short_desc;
						  				
						  }
						  else
						  {
						     $viewname = "";
							 $viewdesc = "";
							 $viewshort = "";
							  
						  }	
								
					  }
					  
					  ?>
                      
                      
                      
                      
                        <div role="tabpanel" class="tab-pane fade <?php if($languagee->id==2){?>active<?php } ?> in" id="tab_content<?php echo $languagee->id;?>" aria-labelledby="home-tab">
                          
                          
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Title <span class="reqq">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="item_title[]" placeholder="" name="item_title[]" value="<?php echo $viewname;?>" class="form-control col-md-7 col-xs-12" required="required">             
                         
                  
                </div>
              </div>
              
              
              <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Short Description <span class="reqq">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                                 
                       <textarea placeholder="" required="required" class="form-control col-md-7 col-xs-12" name="item_short_desc[]" style="width:100% !important; height:100px;"><?php echo html_entity_decode($viewshort); ?></textarea>  
                  
                </div>
              </div>
                      
                      
                   <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Description <span class="reqq">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                                 
                        
                  <textarea id="id_cazary_full" placeholder="" class="form-control col-md-7 col-xs-12" name="item_desc[]" style="width:640px; height:300px;" required="required"><?php echo html_entity_decode($viewdesc); ?></textarea>
                </div>
              </div>   
                      
                      
                      <input type="hidden" name="code[]" value="<?php echo $languagee->lang_code;?>">
                       
                      
                        </div>
                        <?php } ?>
                        
                        
                        
                      </div>
                      
                      
                       
                       
                      
                       
              <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Slug <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12">   
                      <input type="text" id="item_slug" placeholder="" value="<?php echo $edit[0]->item_slug;?>" name="item_slug" class="form-control col-md-7 col-xs-12" required="required">          
                   
					</div>	                
                  
                </div>
              
              
              
                 
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Select Type <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12">   
                              
                   <select name="item_script_type" id="item_script_type" class="form-control col-md-7 col-xs-12" required="required">
                                        <option value="">Select</option>
                                        <option value="code" <?php if($edit[0]->item_script_type=="code"){?> selected <?php } ?>>Code</option>
                                        <option value="graphics" <?php if($edit[0]->item_script_type=="graphics"){?> selected <?php } ?>>Graphics</option>
                                        </select> 
					</div>	                
                  
                </div>
                     
                        
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Download For Free File? <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12">   
                          <select name="item_type" id="item_type" class="form-control col-md-7 col-xs-12" required="required">
                                        <option value="">Select</option>
                                        <option value="yes" <?php if($edit[0]->item_type=="yes"){?> selected <?php } ?>>Yes</option>
                                        <option value="no" <?php if($edit[0]->item_type=="no"){?> selected <?php } ?>>No</option>
                                        </select>      
                  
					</div>	                
                  
                </div>
                
                
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Regular Price (Six Month) <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12">   
                              
                  <input type="text" id="regular_price_six_month" placeholder="" name="regular_price_six_month" value="<?php if(!empty($viewcount)){ echo $edit[0]->regular_price_six_month; } ?>" class="form-control col-md-7 col-xs-12" required="required">
					</div>	                
                  
                </div>
                
                
                 <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Regular Price (One Year)
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12">   
                              <input type="text" id="regular_price_one_year" placeholder="" name="regular_price_one_year" value="<?php if(!empty($viewcount)){ if(!empty($edit[0]->regular_price_one_year)){ echo $edit[0]->regular_price_one_year; } } ?>" class="form-control col-md-7 col-xs-12">
                 
					</div>	                
                  
                </div>
                
                
                
                 <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Extended Price (Six Month)
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                  <input type="text" id="extended_price_six_month" placeholder="" name="extended_price_six_month" value="<?php if(!empty($viewcount)){ if(!empty($edit[0]->extended_price_six_month)){ echo $edit[0]->extended_price_six_month; } } ?>" class="form-control col-md-7 col-xs-12">  
                             
                 
					</div>	                
                  
                </div>
                
                
                 <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Extended Price (One Year)
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   
                  <input type="text" id="extended_price_one_year" placeholder="" name="extended_price_one_year"  value="<?php if(!empty($viewcount)){ if(!empty($edit[0]->extended_price_one_year)){ echo $edit[0]->extended_price_one_year;  } } ?>" class="form-control col-md-7 col-xs-12">           
                 
					</div>	                
                  
                </div>
                
                
                
                
                 <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">High Resolution <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   
                           
                 <select name="high_resolution" class="form-control col-md-7 col-xs-12" required="required">
                                        <option value="">Select</option>
                                        <option value="Yes" <?php if(!empty($viewcount)){ if($edit[0]->high_resolution=="Yes"){?> selected <?php } } ?>>Yes</option>
                                        <option value="No" <?php if(!empty($viewcount)){ if($edit[0]->high_resolution=="No"){?> selected <?php } } ?>>No</option>
                                        </select>
					</div>	                
                  
                </div>
                
                
                <div  id="grapics_only1" <?php if(!empty($viewcount)){  if(!empty($edit[0]->item_script_type=="graphics")){?> style="display:block;" <?php } else {?> style="display:none;" <?php } } ?>>
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Layered <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   
                   <select name="item_layered" class="form-control col-md-7 col-xs-12" required="required">
                                       <option value="">Select</option>
                                        <option value="Yes" <?php if($edit[0]->item_layered=="Yes"){?> selected <?php } ?>>Yes</option>
                                        <option value="No" <?php if($edit[0]->item_layered=="No"){?> selected <?php } ?>>No</option>
                                        </select>        
                 
					</div>	                
                  
                </div>
                
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Graphics Files Included <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   
                  
                 <select multiple="multiple" name="graphics_files[]" id="graphics_files" class="form-control col-md-7 col-xs-12" required="required">
                            <?php foreach($graphics as $graphic){?>
                            <?php 
				  if(!empty($viewcount)){
				  $sel=explode(",",$edit[0]->graphics_files);
				  }
				   ?>
                            <option value="<?php echo $graphic;?>" <?php if(!empty($viewcount)){ if(in_array($graphic,$sel)){?> selected <?php } } ?>><?php echo $graphic;?></option>
                            <?php } ?>
                            
                            
                            </select>
					</div>	                
                  
                </div>
                
                
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Minimum Adobe CS Version <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   <select name="adobe_cs_version" class="form-control col-md-7 col-xs-12" required="required">
                                        <option value="">Select</option>
                                        <?php foreach($adobe_cs as $adobe){?>
                                        <option value="<?php echo $adobe;?>" <?php if(!empty($viewcount)){ if($edit[0]->adobe_cs_version==$adobe){?> selected <?php } } ?>><?php echo $adobe;?></option>
                                       <?php } ?>
                                        </select>
                  
                 
					</div>	                
                  
                </div>
                
                
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Pixel Dimensions <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   
                  <input type="text" id="pixel_dimensions" placeholder="" name="pixel_dimensions" value="<?php if(!empty($viewcount)){ echo $edit[0]->pixel_dimensions; } ?>" class="form-control col-md-7 col-xs-12" required="required">
                 <span class="fontsize12">Image dimensions in Pixels for screen-based items. E.g. 300x600, 50x50</span>
					</div>	                
                  
                </div>
                
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Print Dimensions <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   <input type="text" id="print_dimensions" placeholder="" name="print_dimensions" value="<?php if(!empty($viewcount)){ echo $edit[0]->print_dimensions; } ?>" class="form-control col-md-7 col-xs-12" required="required">
                  
                 <span class="fontsize12">Print dimensions in Inches for printable items, width x height. E.g. 3.5x2.5, 8.5x11</span>
					</div>	                
                  
                </div>
                
                
                </div> 
                
                
                
                <div  id="code_only1" <?php if(!empty($viewcount)){  if(!empty($edit[0]->item_script_type=="code")){?> style="display:block;" <?php } else {?> style="display:none;" <?php } } ?>>
                
                 <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Compatible Browsers <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   
                  
                <select multiple="multiple" name="compatible_browser[]" id="compatible_browser" class="form-control col-md-7 col-xs-12" required="required">
                            <?php foreach($browser as $browse){?>
                             <?php 
				  if(!empty($viewcount)){
				  $sel=explode(",",$edit[0]->compatible_browser);
				  }
				   ?>
                            <option value="<?php echo $browse;?>" <?php if(!empty($viewcount)){ if(in_array($browse,$sel)){?> selected <?php } } ?>><?php echo $browse;?></option>
                            <?php } ?>
                            
                            
                            </select>
					</div>	                
                  
                </div>
                
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Files Included <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   <input type="text" id="file_included" placeholder="" name="file_included" value="<?php if(!empty($viewcount)){ echo $edit[0]->file_included; } ?>" class="form-control col-md-7 col-xs-12" required="required">
                  
                <span class="fontsize12">( separated by commas. e.g. html,css,php,javascript,... )</span>
					</div>	                
                  
                </div>
                
                
               <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Demo Url <span class="reqq">*</span>
                        </label>
                   <?php if($protocol == "http://"){ $linker = "https://"; } else { $linker = "http://"; } ?>     
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   
                  <input type="text" id="demo_url" placeholder="" name="demo_url" class="form-control col-md-7 col-xs-12" value="<?php if(!empty($viewcount)){ echo $edit[0]->demo_url; } ?>" required="required">
                <span style="color:#FF0033; font-size:12px;">( example link :  <?php echo $protocol;?>www.yourwebsite.com )  <b style="color:#009900;">Not Supported - <?php echo $linker;?></b></span>
					</div>	                
                  
                </div> 
                
                
                </div> 
                
                 <input type="hidden" name="item_token" value="<?php if(!empty($viewcount)){ echo $edit[0]->item_token; } ?>">
                            <input type="hidden" name="item_id" value="<?php if(!empty($viewcount)){ echo $edit[0]->item_id; } ?>">
                 <input type="hidden" name="user_id" value="<?php if(!empty($viewcount)){ echo $edit[0]->user_id; } ?>">
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Support Item? <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   <select name="support_item" class="form-control col-md-7 col-xs-12" required="required">
                                        <option value="">Select</option>
                                        <option value="Yes" <?php if(!empty($viewcount)){ if($edit[0]->support_item=="Yes"){?> selected <?php } } ?>>Yes</option>
                                        <option value="No" <?php if(!empty($viewcount)){ if($edit[0]->support_item=="No"){?> selected <?php } } ?>>No</option>
                                        </select>
                  
               
					</div>	                
                  
                </div>
                
                
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Future Update? <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   
                  
               <select name="future_update" class="form-control col-md-7 col-xs-12" required="required">
                                        <option value="">Select</option>
                                        <option value="Yes" <?php if(!empty($viewcount)){ if($edit[0]->future_update=="Yes"){?> selected <?php } } ?>>Yes</option>
                                        <option value="No" <?php if(!empty($viewcount)){ if($edit[0]->future_update=="No"){?> selected <?php } } ?>>No</option>
                                        </select> 
					</div>	                
                  
                </div>
                
                
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Download Limit
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   <input type="number" id="unlimited_download" placeholder="" name="unlimited_download" value="<?php if(!empty($viewcount)){ echo $edit[0]->unlimited_download; } ?>" class="form-control col-md-7 col-xs-12">
                  <span class="fontsize12">( Leave empty is unlimited downloads )</span>
               
					</div>	                
                  
                </div>
                
                
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Category <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  <select multiple="multiple" name="item_category[]" id="item_category" class="form-control col-md-7 col-xs-12" required="required">
                            <?php 
							if(!empty($category_count))
							{
							$category = DB::table('product_categories')
										->where('delete_status','=','')
										->where('cat_type','=','default')
										->where('lang_code','=',"en")
										->where('status','=',1)
										->orderBy('cat_name', 'asc')->get();
							foreach($category as $view){
							
						    $cat_id = $view->id; 
						  
							?>
                            <?php 
				  if(!empty($viewcount)){
				  $sel=explode(",",$edit[0]->category);
				  }
				   ?>
                            <option value="<?php echo $cat_id;?>-cat" class="bold" <?php if(!empty($viewcount)){ if(in_array($cat_id.'-cat',$sel)){?> selected <?php } } ?>><?php echo $view->cat_name;?></option>
                            <?php 
						  $subcount = DB::table('product_subcats')
							->where('delete_status','=','')
							->where('status','=',1)
							->where('cat_id','=',$cat_id)
							->where('lang_code','=',"en")
							->where('subcat_type','=','default')
							->orderBy('subcat_name', 'asc')->count();
							if(!empty($subcount)){
							$subcategory = DB::table('product_subcats')
							->where('delete_status','=','')
							->where('status','=',1)
							->where('cat_id','=',$cat_id)
							->where('lang_code','=',"en")
							->where('subcat_type','=','default')
							->orderBy('subcat_name', 'asc')->get();
							foreach($subcategory as $subview){
							
						    $subcat_id = $subview->subid; 
						  
					      ?>
                          <?php 
				  if(!empty($viewcount)){
				  $ssel=explode(",",$edit[0]->category);
				  }
				   ?>
                            <option value="<?php echo $subcat_id;?>-subcat" <?php if(!empty($viewcount)){ if(in_array($subcat_id.'-subcat',$ssel)){?> selected <?php } } ?>> - <?php echo $subview->subcat_name;?></option>
                            
                            
                            <?php } } } } ?>
                            </select> 
                   
                  
               
					</div>	                
                  
                </div>
                
                
                <div class="item form-group" id="code_only2" <?php if(!empty($viewcount)){  if(!empty($edit[0]->item_script_type=="code")){?> style="display:block;" <?php } else {?> style="display:none;" <?php } } ?>>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Software Framework
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12">
                  <select multiple="multiple" name="item_framework[]" id="item_framework" class="form-control col-md-7 col-xs-12">
                            <?php 
							if(!empty($framework_count))
							{
							$category = DB::table('product_categories')
										->where('delete_status','=','')
										->where('status','=',1)
										->where('lang_code','=',"en")
										->where('cat_type','=','framework')
										->orderBy('cat_name', 'asc')->get();
							foreach($category as $view){
							
						    $cat_id = $view->id; 
						  
							?>
                             <?php 
				  if(!empty($viewcount)){
				  $sel=explode(",",$edit[0]->framework_category);
				  }
				   ?>
                            <option value="<?php echo $cat_id;?>-cat" class="bold" <?php if(!empty($viewcount)){ if(in_array($cat_id.'-cat',$sel)){?> selected <?php } } ?>><?php echo $view->cat_name;?></option>
                            <?php 
						  $subcount = DB::table('product_subcats')
							->where('delete_status','=','')
							->where('status','=',1)
							->where('cat_id','=',$cat_id)
							->where('lang_code','=',"en")
							->where('subcat_type','=','framework')
							->orderBy('subcat_name', 'asc')->count();
							if(!empty($subcount)){
							$subcategory = DB::table('product_subcats')
							->where('delete_status','=','')
							->where('status','=',1)
							->where('cat_id','=',$cat_id)
							->where('lang_code','=',"en")
							->where('subcat_type','=','framework')
							->orderBy('subcat_name', 'asc')->get();
							foreach($subcategory as $subview){
							
						    $subcat_id = $subview->subid; 
						  
					      ?>
                          <?php 
				  if(!empty($viewcount)){
				  $ssel=explode(",",$edit[0]->framework_category);
				  }
				   ?>
                            <option value="<?php echo $subcat_id;?>-subcat" <?php if(!empty($viewcount)){ if(in_array($subcat_id.'-subcat',$ssel)){?> selected <?php } } ?>> - <?php echo $subview->subcat_name;?></option>
                            
                            
                            <?php } } } } ?>
                            </select>
                  
					</div>	                
                  
                </div>
                
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Thumbnail Image <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                  <input type="file" id="item_thumbnail" placeholder="" name="item_thumbnail" class="form-control col-md-7 col-xs-12" <?php if(!empty($viewcount)){ if(empty($edit[0]->item_thumbnail)){?>required="required"<?php } } ?>>
                  
                  <span class="fontsize12">(200 X 200px)</span><br/>
               <?php if(!empty($viewcount)){ if(!empty($edit[0]->item_thumbnail)){?>
                                        <img src="<?php echo $url;?>/local/images/media/thumbnail/<?php echo $edit[0]->item_thumbnail;?>" alt="" style="max-width:100px;">
                                       
                                        <?php } } ?>
					</div>	                
                  
                </div>
                <input type="hidden" name="current_thumb" value="<?php if(!empty($viewcount)){ if(!empty($edit[0]->item_thumbnail)){?><?php echo $edit[0]->item_thumbnail;?><?php } } ?>">
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Upload Banner Image <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                  
                  <input type="file" id="preview_image" placeholder="" name="preview_image" class="form-control col-md-7 col-xs-12" <?php if(!empty($viewcount)){ if(empty($edit[0]->preview_image)){?>required="required"<?php } } ?>>
                  <span class="fontsize12">(600 X 450px)</span><br/>
               <?php if(!empty($viewcount)){ if(!empty($edit[0]->preview_image)){?>
                                        <img src="<?php echo $url;?>/local/images/media/preview/<?php echo $edit[0]->preview_image;?>" alt="" style="max-width:100px;">
                                       
                                        <?php } } ?>
					</div>	                
                  
                </div>
                <input type="hidden" name="current_preview" value="<?php if(!empty($viewcount)){ if(!empty($edit[0]->preview_image)){?><?php echo $edit[0]->preview_image;?><?php } } ?>">
                
                
                 <?php
						  $viewimg_counter = DB::table('product_images')
		                              ->where('item_token', '=' , $edit[0]->item_token)
				                      ->count();
									  
						  ?>
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Preview Screenshots (multiple images)
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                  
                  
                   <input type="file" placeholder="" name="image[]" class="form-control col-md-7 col-xs-12" accept="image/*" multiple>
                   <br/>
                   <?php if(!empty($viewcount)){?>
                      
                      <?php
					  $viewimg_count = DB::table('product_images')
		                              ->where('item_token', '=' , $edit[0]->item_token)
				                      ->count();
	
	                   
	
					  if(!empty($viewimg_count)){
					  $viewimg_get = DB::table('product_images')
		                              ->where('item_token', '=' , $edit[0]->item_token)
				                      ->get();
					  foreach($viewimg_get as $gallery){
					  
					  
					  if($site_file_upload_by == "s3_server")
					  {
					  $imageurls = Storage::disk('s3')->url($gallery->image);
					  ?>
                      
                      <div style="margin-bottom:15px;">
                      <?php if(!empty($gallery->image)){?>
                      <img src="<?php echo $imageurls;?>" width="80" height="80" border="0" alt="">
                      <a href="<?php echo $url;?>/admin/edit-item/delete/<?php echo $gallery->item_img_id;?>/<?php echo base64_encode($gallery->image);?>" onClick="return confirm('Are you sure you want to delete');"><img src="<?php echo $url;?>/local/images/delete.png" width="24" border="0" alt=""></a>
                      </div>
                      <?php } ?>
                       <?php
					  }
					  else
					  {
					  ?>
                      
                      <div style="margin-bottom:15px;">
                      <?php if(!empty($gallery->image)){?>
                      <img src="<?php echo $url;?>/local/images/media/screenshots/<?php echo $gallery->image;?>" width="80" height="80" border="0" alt="">
                      <a href="<?php echo $url;?>/admin/edit-item/delete/<?php echo $gallery->item_img_id;?>/<?php echo base64_encode($gallery->image);?>" onClick="return confirm('Are you sure you want to delete');"><img src="<?php echo $url;?>/local/images/delete.png" width="24" border="0" alt=""></a>
                      </div>
                      
                      <?php } } } } } ?>
					</div>	                
                  
                </div>
                
                
                 <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Upload File <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                  <input type="file" id="main_file" placeholder="" name="main_file" class="form-control col-md-7 col-xs-12" <?php if(!empty($viewcount)){ if(empty($edit[0]->main_file)){?>required="required"<?php } } ?>>
                  
                   <span class="fontsize12">( ZIP - format only )</span><br/>
                   <?php if(!empty($viewcount)){ if(!empty($edit[0]->main_file)){?>
                   <?php if($site_file_upload_by == "s3_server"){ 
										$imageurls = Storage::disk('s3')->url($edit[0]->main_file);
										?>
                                        <a href="<?php echo $imageurls;?>" style="color:#0000CC;" download> <?php echo $edit[0]->main_file;?>
                                        </a>
                                         <?php } else { ?>
                                        <a href="<?php echo $url;?>/local/images/media/itemfile/<?php echo $edit[0]->main_file;?>" style="color:#0000CC;" download> <?php echo $edit[0]->main_file;?>
                                        </a>
                                         <?php } ?>
                                        <?php } } ?>
					</div>	                
                  
                </div>
                
                
                
                 <div class="item form-group" id="code_only3" <?php if(!empty($viewcount)){  if(!empty($edit[0]->item_script_type=="code")){?> style="display:block;" <?php } else {?> style="display:none;" <?php } } ?>>
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Optional Video Preview
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                 
                  <input type="file" id="video_file" placeholder="" name="video_file" class="form-control col-md-7 col-xs-12">
                   <span class="fontsize12">( MP4 - format only )</span><br/>
                <?php if(!empty($video_status)){?>
                <?php if($site_file_upload_by == "s3_server"){ 
										$videourls = Storage::disk('s3')->url($video_status);
										?>
                                    <a href="<?php echo $videourls;?>" style="color:#0000CC;" download> <?php echo $video_status;?>
                                        </a> 
                                       <?php } else { ?> 
                                        <a href="<?php echo $url;?>/local/images/media/video/<?php echo $video_status;?>" style="color:#0000CC;" download> <?php echo $video_status;?>
                                        </a>     
                                        <?php } ?>  
                                        <?php } ?>
					</div>	                
                  
                </div>
                <input type="hidden" name="current_video" value="<?php echo $video_status;?>">
                <input type="hidden" name="current_file" value="<?php if(!empty($viewcount)){ if(!empty($edit[0]->main_file)){?><?php echo $edit[0]->main_file;?><?php } } ?>">
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Tags
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                 <textarea id="item_tags" placeholder="" rows="5" name="item_tags" class="form-control col-md-7 col-xs-12"><?php if(!empty($viewcount)){ echo $edit[0]->item_tags; } ?></textarea>
                  
                   <span class="fontsize12">( separated by commas. e.g. php script,html template,css menu,.... )</span>
               
					</div>	                
                  
                </div>
                
                
                
                
                      
                      
                      
                    </div>

                  </div>
                </div>
              </div>
                    
                    
                 
                 
                    
                    
              
					
              
					
              <?php $url = URL::to("/"); ?>
              <div class="form-actions">
                        <div class="col-md-6 col-md-offset-3">
                         
                          <a href="<?php echo $url;?>/admin/edit-item/<?php echo $edit[0]->item_token;?>" class="btn btn-primary">Cancel</a>
                        
                       
						  <?php if(config('global.demosite')=="yes"){?><a href="#" class="btn btn-success">Submit</a> 
								<span class="disabletxt">( <?php echo config('global.demotxt');?> )</span><?php } else { ?>
						  
                           
                           <button id="send" type="submit" class="btn btn-success">Submit</button>
								<?php } ?>
                        </div>
              
            </form>
          </div>
          <?php }  ?>
     
          
          
        </div>
      </div>
    </div>
    
  </div>
</div>



</div>
  
  
  
 @include('admin.footer')
	
  </body>
</html>
