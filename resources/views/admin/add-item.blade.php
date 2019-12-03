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
                    <h2>Add Item</h2>
                    
                    <div class="clearfix"></div>
					
                  </div>
              
              <?php $url = URL::to("/"); ?>   
                   <form class="form-horizontal form-label-left" role="form" method="POST" action="{{ route('admin.add-item') }}"  enctype="multipart/form-data" novalidate>
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
                      
                      
                      <?php foreach($language as $languagee){?>
                        <div role="tabpanel" class="tab-pane fade <?php if($languagee->id==2){?>active<?php } ?> in" id="tab_content<?php echo $languagee->id;?>" aria-labelledby="home-tab">
                          
                          
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Title <span class="reqq">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" id="item_title[]" placeholder="" name="item_title[]" class="form-control col-md-7 col-xs-12" required="required">             
                         
                  
                </div>
              </div>
              
              
              <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Short Description <span class="reqq">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                                 
                       <textarea placeholder="" required="required" class="form-control col-md-7 col-xs-12" name="item_short_desc[]" style="width:100% !important; height:100px;"></textarea>  
                  
                </div>
              </div>
                      
                      
                   <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Description <span class="reqq">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                                 
                        
                  <textarea id="id_cazary_full" placeholder="" class="form-control col-md-7 col-xs-12" name="item_desc[]" style="width:640px; height:300px;" required="required"></textarea>
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
                      <input type="text" id="item_slug" placeholder="" name="item_slug" class="form-control col-md-7 col-xs-12" required="required">          
                   
					</div>	                
                  
                </div>
              
              
              
                 
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Select Type <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12">   
                              
                   <select name="item_script_type" id="item_script_type" class="form-control col-md-7 col-xs-12" required="required">
                                        <option value="">Select</option>
                                        <option value="code">Code</option>
                                        <option value="graphics">Graphics</option>
                                        </select> 
					</div>	                
                  
                </div>
                     
                        
                    <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Download For Free File? <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12">   
                          <select name="item_type" id="item_type" class="form-control col-md-7 col-xs-12" required="required">
                                        <option value="">Select</option>
                                        <option value="yes">Yes</option>
                                        <option value="no">No</option>
                                        </select>      
                  
					</div>	                
                  
                </div>
                
                
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Regular Price (Six Month) <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12">   
                              
                  <input type="text" id="regular_price_six_month" placeholder="" name="regular_price_six_month" class="form-control col-md-7 col-xs-12" required="required">
					</div>	                
                  
                </div>
                
                
                 <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Regular Price (One Year)
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12">   
                              <input type="text" id="regular_price_one_year" placeholder="" name="regular_price_one_year" class="form-control col-md-7 col-xs-12">
                 
					</div>	                
                  
                </div>
                
                
                
                 <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Extended Price (Six Month)
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                  <input type="text" id="extended_price_six_month" placeholder="" name="extended_price_six_month" class="form-control col-md-7 col-xs-12">  
                             
                 
					</div>	                
                  
                </div>
                
                
                 <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Extended Price (One Year)
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   
                  <input type="text" id="extended_price_one_year" placeholder="" name="extended_price_one_year" class="form-control col-md-7 col-xs-12">           
                 
					</div>	                
                  
                </div>
                
                
                
                
                 <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">High Resolution <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   
                           
                 <select name="high_resolution" class="form-control col-md-7 col-xs-12" required="required">
                                        <option value="">Select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                        </select>
					</div>	                
                  
                </div>
                
                
                <div  id="grapics_only1">
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Layered <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   
                   <select name="item_layered" class="form-control col-md-7 col-xs-12" required="required">
                                       <option value="">Select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                        </select>        
                 
					</div>	                
                  
                </div>
                
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Graphics Files Included <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   
                  
                 <select multiple="multiple" name="graphics_files[]" id="graphics_files" class="form-control col-md-7 col-xs-12" required="required">
                            <?php foreach($graphics as $graphic){?>
                            <option value="<?php echo $graphic;?>"><?php echo $graphic;?></option>
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
                                        <option value="<?php echo $adobe;?>"><?php echo $adobe;?></option>
                                       <?php } ?>
                                        </select>
                  
                 
					</div>	                
                  
                </div>
                
                
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Pixel Dimensions <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   
                  <input type="text" id="pixel_dimensions" placeholder="" name="pixel_dimensions" class="form-control col-md-7 col-xs-12" required="required">
                 <span class="fontsize12">Image dimensions in Pixels for screen-based items. E.g. 300x600, 50x50</span>
					</div>	                
                  
                </div>
                
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Print Dimensions <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   <input type="text" id="print_dimensions" placeholder="" name="print_dimensions" class="form-control col-md-7 col-xs-12" required="required">
                  
                 <span class="fontsize12">Print dimensions in Inches for printable items, width x height. E.g. 3.5x2.5, 8.5x11</span>
					</div>	                
                  
                </div>
                
                
                </div> 
                
                
                
                <div  id="code_only1">
                
                 <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Compatible Browsers <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   
                  
                <select multiple="multiple" name="compatible_browser[]" id="compatible_browser" class="form-control col-md-7 col-xs-12" required="required">
                            <?php foreach($browser as $browse){?>
                            <option value="<?php echo $browse;?>"><?php echo $browse;?></option>
                            <?php } ?>
                            
                            
                            </select>
					</div>	                
                  
                </div>
                
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Files Included <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   <input type="text" id="file_included" placeholder="" name="file_included" class="form-control col-md-7 col-xs-12" required="required">
                  
                <span class="fontsize12">( separated by commas. e.g. html,css,php,javascript,... )</span>
					</div>	                
                  
                </div>
                
                
               <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Demo Url <span class="reqq">*</span>
                        </label>
                   <?php if($protocol == "http://"){ $linker = "https://"; } else { $linker = "http://"; } ?>     
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   
                  <input type="text" id="demo_url" placeholder="" name="demo_url" class="form-control col-md-7 col-xs-12" required="required">
                <span style="color:#FF0033; font-size:12px;">( example link :  <?php echo $protocol;?>www.yourwebsite.com )  <b style="color:#009900;">Not Supported - <?php echo $linker;?></b></span>
					</div>	                
                  
                </div> 
                
                
                </div> 
                
                 <input type="hidden" name="item_token" value="<?php echo uniqid();?>">
                
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Support Item? <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   <select name="support_item" class="form-control col-md-7 col-xs-12" required="required">
                                        <option value="">Select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                        </select>
                  
               
					</div>	                
                  
                </div>
                
                
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Future Update? <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   
                  
               <select name="future_update" class="form-control col-md-7 col-xs-12" required="required">
                                        <option value="">Select</option>
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                        </select> 
					</div>	                
                  
                </div>
                
                
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Download Limit
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                   <input type="number" id="unlimited_download" placeholder="" name="unlimited_download" class="form-control col-md-7 col-xs-12">
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
                            <option value="<?php echo $cat_id;?>-cat" class="bold"><?php echo $view->cat_name;?></option>
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
                            <option value="<?php echo $subcat_id;?>-subcat"> - <?php echo $subview->subcat_name;?></option>
                            
                            
                            <?php } } } } ?>
                            </select> 
                   
                  
               
					</div>	                
                  
                </div>
                
                
                <div class="item form-group" id="code_only2">
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
                            <option value="<?php echo $cat_id;?>-cat" class="bold"><?php echo $view->cat_name;?></option>
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
                            <option value="<?php echo $subcat_id;?>-subcat"> - <?php echo $subview->subcat_name;?></option>
                            
                            
                            <?php } } } } ?>
                            </select>
                  
					</div>	                
                  
                </div>
                
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Thumbnail Image <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                  <input type="file" id="item_thumbnail" placeholder="" name="item_thumbnail" class="form-control col-md-7 col-xs-12" required="required">
                  
                  <span class="fontsize12">(200 X 200px)</span>
               
					</div>	                
                  
                </div>
                
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Upload Banner Image <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                  
                  <input type="file" id="preview_image" placeholder="" name="preview_image" class="form-control col-md-7 col-xs-12" required="required">
                  <span class="fontsize12">(600 X 450px)</span>
               
					</div>	                
                  
                </div>
                
                
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Preview Screenshots (multiple images)
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                  
                  
                   <input type="file" placeholder="" name="image[]" class="form-control col-md-7 col-xs-12" accept="image/*" multiple>
               
					</div>	                
                  
                </div>
                
                
                 <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Upload File <span class="reqq">*</span>
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                  <input type="file" id="main_file" placeholder="" name="main_file" class="form-control col-md-7 col-xs-12" required="required">
                  
                   <span class="fontsize12">( ZIP - format only )</span>
               
					</div>	                
                  
                </div>
                
                
                
                 <div class="item form-group" id="code_only3">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Optional Video Preview
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                 
                  <input type="file" id="video_file" placeholder="" name="video_file" class="form-control col-md-7 col-xs-12">
                   <span class="fontsize12">( MP4 - format only )</span>
               
					</div>	                
                  
                </div>
                
                
                <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Tags
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12"> 
                 <textarea id="item_tags" placeholder="" rows="5" name="item_tags" class="form-control col-md-7 col-xs-12"></textarea>
                  
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
                         
                          <a href="<?php echo $url;?>/admin/add-item" class="btn btn-primary">Cancel</a>
                        
                       
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
