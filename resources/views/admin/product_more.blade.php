<!DOCTYPE html>
<html lang="en">
  <head>
   
   @include('admin.title')
    
    @include('admin.style')
	
    
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
                    
                      <span class="section"><?php echo $single_items[0]->item_title;?></span>

                      
                      
					  
					  
					  
					  
						
						
					
                      
                      
                      
                      
					  
                      
                      
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Item Id :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $single_items[0]->item_token;?>
						  
                        </div>
                      </div>
                     
                     
                     <div style="clear:both; height:20px;"></div>
					
                     <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Item Title :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $single_items[0]->item_title;?>
						  
                        </div>
                      </div>
                      
                      
                      <div style="clear:both; height:20px;"></div>
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Item Description :</label> 
                        <div class="col-md-6 col-sm-8 col-xs-12">
                         <?php echo html_entity_decode($single_items[0]->item_desc);?>
						  
                        </div>
                      </div>
                      
                      <div style="clear:both; height:20px;"></div>
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Regular Price (6 months) :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $single_items[0]->regular_price_six_month;?> <?php echo $setting[0]->site_currency;?>
						  
                        </div>
                      </div>
                    
					 <div style="clear:both; height:20px;"></div>
                    
                    <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Regular Price (1 year) :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $single_items[0]->regular_price_one_year;?> <?php echo $setting[0]->site_currency;?>
						  
                        </div>
                      </div>
                    
                     <div style="clear:both; height:20px;"></div>
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Extended Price (6 months) :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $single_items[0]->extended_price_six_month;?> <?php echo $setting[0]->site_currency;?>
						  
                        </div>
                      </div>
                      
                      
                      <div style="clear:both; height:20px;"></div>
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Extended Price (1 year) :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $single_items[0]->extended_price_one_year;?> <?php echo $setting[0]->site_currency;?>
						  
                        </div>
                      </div>
                      
                      <div style="clear:both; height:20px;"></div>
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">High Resolution :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $single_items[0]->high_resolution;?>
						  
                        </div>
                      </div>
                       <div style="clear:both; height:20px;"></div>
                      
                      
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Compatible Browser :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $single_items[0]->compatible_browser;?>
						  
                        </div>
                      </div>
                      <div style="clear:both; height:20px;"></div>
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">	File Included :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $single_items[0]->file_included;?>
						  
                        </div>
                      </div>
                      
                      <div style="clear:both; height:20px;"></div>
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">	Demo Url :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $single_items[0]->demo_url;?>
						  
                        </div>
                      </div>
                      
                      <div style="clear:both; height:20px;"></div>
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">	Support Item :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $single_items[0]->support_item;?>
						  
                        </div>
                      </div>
                      
                      <div style="clear:both; height:20px;"></div>
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">	Future Update :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $single_items[0]->future_update;?>
						  
                        </div>
                      </div>
                      
                      <div style="clear:both; height:20px;"></div>
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">	Download Limit :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php if($single_items[0]->unlimited_download==""){ echo "unlimited"; } else { echo $single_items[0]->unlimited_download; }?>
						  
                        </div>
                      </div>
                      
                       <div style="clear:both; height:20px;"></div>
                      <?php
					  if(!empty($single_items[0]->category))
					  {
					  $category_id = $single_items[0]->category;
					  
					  
                      $pieces = explode(",", $category_id);
					  $category_name ="";
                      foreach($pieces as $view)
					  {
					      $split = explode("-",$view);
						  $cid = $split[0];
						  $ctype = $split[1];
						  if($ctype=="cat")
						  {
						      $category_first_count = DB::table('product_categories')
									            ->where('id','=',$cid)
									            ->count();
						      if(!empty($category_first_count))
							  {
						      $category_first = DB::table('product_categories')
									            ->where('id','=',$cid)
									            ->get();
							  $category_name .= $category_first[0]->cat_name.',';
							  }
							  else
							  {
							    $category_name = "";
							  }
						  }
						  else if($ctype=="subcat")
						  {
						  
						      $category_first_count = DB::table('product_subcats')
									            ->where('subid','=',$cid)
									            ->count();
							  if(!empty($category_first_count))
							  {					
						      $category_first = DB::table('product_subcats')
									            ->where('subid','=',$cid)
									            ->get();
							  $category_name .= $category_first[0]->subcat_name.',';
							  }
							  else
							  {
							   $category_name = "";
							  }
						  }
						  else
						  {
						     $category_name="";
						  }
						  
						  
					  }
					  
					  }
					  else
					  {
					     $category_name="";
					  }
					  ?>
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">	Category :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo rtrim($category_name,",");?>
						  
                        </div>
                      </div>
                      
                      <div style="clear:both; height:20px;"></div>
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">	Created :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo date("d M Y", strtotime($single_items[0]->first_update));?>
						  
                        </div>
                      </div>
                      
                      <div style="clear:both; height:20px;"></div> 
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">	Last Updated :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo date("d M Y", strtotime($single_items[0]->last_update));?>
						  
                        </div>
                      </div>
                      
                       <div style="clear:both; height:20px;"></div> 
                      
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">	Sales :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $single_items[0]->sales;?>
						  
                        </div>
                      </div>
                      
                      <div style="clear:both; height:20px;"></div> 
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">	Image :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php 
					   
						$path ='/local/images/media/preview/'.$single_items[0]->preview_image;
						if($single_items[0]->preview_image!=""){
						?>
						 <img src="<?php echo $url.$path;?>" class="thumb" width="70">
                         <?php } else { ?> 
                         <img src="<?php echo $url.'/local/images/nophoto.jpg';?>" class="thumb" width="70">
                         <?php } ?>
                        </div>
                      </div>
                      
                      
                        <div style="clear:both; height:20px;"></div> 
                        
                        
                        <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">	Main File :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <a href="<?php echo $url;?>/local/images/media/itemfile/<?php echo $single_items[0]->main_file;?>" style="color:#0000CC; text-decoration:underline;" download><?php echo $single_items[0]->main_file;?></a>
						  
                        </div>
                      </div>
                      
                       <div style="clear:both; height:20px;"></div> 
                       
                       
                       
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">	Tags :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $single_items[0]->item_tags;?>
						  
                        </div>
                      </div>
                       
                       <div style="clear:both; height:20px;"></div>
                       
                       
                       
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">	Featured Item? :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php if($single_items[0]->item_featured==1){ echo "Yes"; } else { echo "No"; } ?>
						  
                        </div>
                      </div>
                      
                      
                       <div style="clear:both; height:20px;"></div>
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">	Item Status :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php if($single_items[0]->item_status==1){ echo "<span style='color:green;'>Active</span>"; } else { echo "<span style='color:red;'>InActive</span>"; } ?>
						  
                        </div>
                      </div>
                      
                      
                      
                      <div style="clear:both; height:20px;"></div>
                       
                       <?php if($single_items[0]->item_featured==1){?>
                       
                       <h4 style="font-size:18px; color:#000000; font-weight:bold;">Featured Item Details</h4>
                       
                       <div style="clear:both; height:20px;"></div>
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">	Display Start Date :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php echo date("d M Y", strtotime($single_items[0]->featured_startdate));?>
						  
                        </div>
                      </div>
                       <div style="clear:both; height:20px;"></div>
                       
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">	Display End Date :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php echo date("d M Y", strtotime($single_items[0]->featured_enddate));?>
						  
                        </div>
                      </div>
                       
                       <div style="clear:both; height:20px;"></div>
                       
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">	Duration :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php echo $single_items[0]->featured_days;?> days
						  
                        </div>
                      </div>
                       
                       
                       <div style="clear:both; height:20px;"></div>
                       
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">	Price :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php echo $single_items[0]->featured_price;?> <?php echo $setting[0]->site_currency;?> 
						  
                        </div>
                      </div>
                      
                      
                      <div style="clear:both; height:20px;"></div>
                       
                       
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">	Payment Type :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php echo $single_items[0]->featured_payment_type;?> 
						  
                        </div>
                      </div>
                      
                      <div style="clear:both; height:20px;"></div>
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">	Payment Status :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php if($single_items[0]->featured_payment_status==""){ echo "pending"; } else { echo $single_items[0]->featured_payment_status; } ?>
						  
                        </div>
                      </div>
                      
                      <div style="clear:both; height:20px;"></div>
                       
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">	Payment Id :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                        <?php echo $single_items[0]->featured_payment_key;?> 
						  
                        </div>
                      </div>
                      
                      <div style="clear:both; height:20px;"></div>
                       
                       
                       <?php } ?>
                       
                       
                       
					  
                     
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 text-left">
                          <a href="<?php echo $url;?>/admin/products" class="btn btn-primary">Back</a>
						  
                        </div>
                      </div>
                   
                  </div>
                </div>
              </div>
			  
		
		
		
		
		
		
		
		
		
		
		
		
		
		
        <!-- /page content -->

      @include('admin.footer')
      </div>
    </div>

    
	
  </body>
</html>
