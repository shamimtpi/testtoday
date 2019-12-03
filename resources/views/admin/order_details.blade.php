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
                    
                      <span class="section">Order Details</span>

                      
                      
					  
					  
					  
					  
						
						
					
                      
                      
                      
                      
					  
                      
                      
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Item Id :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $view_orders[0]->item_id;?>
						  
                        </div>
                      </div>
                     
                     
                     <div style="clear:both; height:20px;"></div>
					
                     <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Item Token :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $view_orders[0]->item_token;?>
						  
                        </div>
                      </div>
                      
                      
                      <div style="clear:both; height:20px;"></div>
					
                     <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Purchase Id :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $view_orders[0]->purchase_token;?>
						  
                        </div>
                      </div>
                      
                      
                       <div style="clear:both; height:20px;"></div>
					
                     <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Purchase Code :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $view_orders[0]->purchase_code;?>
						  
                        </div>
                      </div>
                      
                   
                      
                     <div style="clear:both; height:20px;"></div>
					
                     <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Item Name :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <a href="<?php echo $url;?>/item/<?php echo $view_orders[0]->item_id;?>/<?php echo $product_details[0]->item_slug;?>" target="_blank" style="color:#0000FF;"><?php echo $view_orders[0]->item_name;?></a>
						  
                        </div>
                      </div>
                      
                       
                      
                      <div style="clear:both; height:20px;"></div>
					
                     <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Buyer Name :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <a href="<?php echo $url;?>/user/<?php echo $buyer_details[0]->user_slug;?>" target="_blank" style="color:#0000FF;"><?php echo $buyer_details[0]->name;?></a>
						  
                        </div>
                      </div>
                      
                      
                      <div style="clear:both; height:20px;"></div>
					
                     <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Vendor Name :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <a href="<?php echo $url;?>/user/<?php echo $vendor_details[0]->user_slug;?>" target="_blank" style="color:#0000FF;"><?php echo $vendor_details[0]->name;?></a>
						  
                        </div>
                      </div>
                      
                      
                      
                      
                      <div style="clear:both; height:20px;"></div>
					
                     <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Payment Type :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $view_orders[0]->payment_type;?>
						  
                        </div>
                      </div>
                      
                      
                      <div style="clear:both; height:20px;"></div>
					
                     <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Payment Token :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $view_orders[0]->payment_token;?>
						  
                        </div>
                      </div>
                      
                      <?php
					  if($view_orders[0]->licence_type == "regular_price_six_month"){ $license_text = "Regular Price (Six Month)"; }
							else if($view_orders[0]->licence_type == "regular_price_one_year"){ $license_text = "Regular Price (One Year)"; }
							else if($view_orders[0]->licence_type == "extended_price_six_month"){ $license_text = "Extended Price (Six Month)"; }
							else if($view_orders[0]->licence_type == "extended_price_one_year"){ $license_text = "Extended Price (One Year)"; }
					  ?>
                       
                       
                       <div style="clear:both; height:20px;"></div>
					
                     <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Licence Type :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $license_text;?>
						  
                        </div>
                      </div>
                      
                      
                      
                      
                      <div style="clear:both; height:20px;"></div>
					
                     <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Licence Start Date :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $view_orders[0]->license_start_date;?>
						  
                        </div>
                      </div>
                      
                      
                      
                      
                       <div style="clear:both; height:20px;"></div>
					
                     <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Licence End Date :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $view_orders[0]->license_end_date;?>
						  
                        </div>
                      </div>
                      
                      
                      
                      <div style="clear:both; height:20px;"></div>
					
                     <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Vendor Amount :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $view_orders[0]->vendor_amount;?> <?php echo $setts[0]->site_currency;?>
						  
                        </div>
                      </div>
                      
                      
                      
                       <div style="clear:both; height:20px;"></div>
					
                     <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Admin Amount :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $view_orders[0]->admin_amount;?> <?php echo $setts[0]->site_currency;?>
						  
                        </div>
                      </div>
                      
                      
                      
                       <div style="clear:both; height:20px;"></div>
					
                     <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Item Amount :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $view_orders[0]->total;?> <?php echo $setts[0]->site_currency;?>
						  
                        </div>
                      </div>
                      
                      
                      
                      <div style="clear:both; height:20px;"></div>
					
                     <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Payment Status :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php if($view_orders[0]->payment_type!="localbank"){ echo $view_orders[0]->status; } ?> 
						  
                        </div>
                      </div>
                      
                      
                      <div style="clear:both; height:20px;"></div>
					
                     <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Payment Approval :</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                         <?php echo $view_orders[0]->approval_status;?> 
						  
                        </div>
                      </div>
                      
                      
					  <div style="clear:both; height:20px;"></div>
                     
                     
                      <div class="form-group">
                        <div class="col-md-6 text-left">
                          <a href="<?php echo $url;?>/admin/orders" class="btn btn-primary">Back</a>
						  
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
