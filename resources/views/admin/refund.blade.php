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
		
		<?php $url = URL::to("/"); ?>
		
		
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
         
		 
		 
		 
         <?php  if (in_array(8, $hidden)){?>
		 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Dispute Refund Request</h2>
                    <ul class="nav navbar-right panel_toolbox">
                     
                       <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
					
                  </div>
                  
                  
				  
                  
				
                  <div class="x_content">
                   
					
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                        
                        
                        
                          <th>Sno</th>
						  <th>Purchase id</th>
                          <th>Request date</th>
                          <th>Order id</th>
                          <th>Product</th>
                          <th style="width:70px;">Payment date</th>
                          <th>Contact buyer</th>
                          <th>Contact vendor</th>
                          <th style="width:70px;">Amount</th>
                          <th style="width:100px;">Payment type</th>
                          <th style="width:100px;">Subject</th>
                          <th style="width:200px;">Comment or Reason</th>
                          <th style="width:300px;">Payment Action</th>
                          <th>Action</th>
                         </tr>
                         
                         
                          
                        
                      </thead>
                      <tbody>
             <?php 
			 $refund = DB::table('product_refunds')
		                ->where('delete_status','=','')
		                ->orderBy('dispute_id','desc')
					   ->get();
					  $i=1;
					  foreach ($refund as $request) {
					  
					  $buyer_count = DB::table('users')
		                            ->where('id','=',$request->buyer_id)
					                ->count();
					  if(!empty($buyer_count))
					  {				
					  $buyer_details = DB::table('users')
		                            ->where('id','=',$request->buyer_id)
					                ->get();
					    $buyer_namer = $buyer_details[0]->name;
						$buyer_slug =  $buyer_details[0]->user_slug;
						
					  }
					  else
					  {
					     $buyer_namer = "";
						 $buyer_slug = "";
					  } 
					  
					  
					  
					  $vendor_count = DB::table('users')
		                            ->where('id','=',$request->vendor_id)
					                ->count();
					  if(!empty($vendor_count))
					  {				
					  $vendor_details = DB::table('users')
		                            ->where('id','=',$request->vendor_id)
					                ->get();
					    $vendor_namer = $vendor_details[0]->name;
						$vendor_slug =  $vendor_details[0]->user_slug;
					  }
					  else
					  {
					     $vendor_namer = "";
						 $vendor_slug = "";
					  } 
					  
					  
					  
					  
					  
					  $prod_count = DB::table('products')
		                            ->where('item_id','=',$request->item_id)
					                ->count();
					  
					  if(!empty($prod_count))
					  {				
					  $prod_details = DB::table('products')
		                            ->where('item_id','=',$request->item_id)
					                ->get();
					    $item_title = $prod_details[0]->item_title;
						$item_slug = $prod_details[0]->item_slug;
					  }
					  else
					  {
					     $item_title = "";
						 $item_slug = "";
					  } 
					  
					  
					
				    $order_item_count = DB::table('product_orders')
		                            ->where('ord_id','=',$request->order_id)
					                ->count();
									
					if(!empty($order_item_count))
					{				
				   $order_item = DB::table('product_orders')
		                            ->where('ord_id','=',$request->order_id)
					                ->get();
					$vendor_commission = $order_item[0]->vendor_amount;
				   
				   $admin_commission = $order_item[0]->admin_amount;
				   }
				   else
				   {
				   $vendor_commission = "";
				   $admin_commission = "";
				   }
				   
				   
					   ?>
    
						
                        <tr>
                         
                        
						 <td><?php echo $i;?></td>
                         
                         
						
                         
                         
                         
                         
                          <td><?php echo $request->purchase_token;?></td>
                          <td><?php echo $request->request_date;?></td>
                          
                         <td><?php echo $request->order_id;?></td>
                         <td><a href="<?php echo $url;?>/item/<?php echo $request->item_id;?>/<?php echo $item_slug;?>" style="color:#009900; text-decoration:underline;" target="_blank"><?php echo $item_title;?></a></td>
                         <td><?php echo $request->payment_date;?></td>
                         <td><a href="<?php echo $url;?>/user/<?php echo $buyer_slug;?>" style="color:#0000FF; text-decoration:underline;" target="_blank"><?php echo $buyer_namer;?></a></td>
                          <td><a href="<?php echo $url;?>/user/<?php echo $vendor_slug;?>" style="color:#CC0066; text-decoration:underline;" target="_blank"><?php echo $vendor_namer;?></a></td>
                          <td><?php echo $setts[0]->site_currency.' '.$request->payment;?></td>
                          <td><?php echo $request->payment_type;?></td>
                          <td><?php echo $request->subject;?></td>
                          <td><?php echo $request->message;?></td>
						  
						  <td>
						  <?php if(empty($request->dispute_status)){?>
						   <?php if(config('global.demosite')=="yes"){?>
				  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span> <a href="#" class="btn btn-primary btndisable" style="margin-bottom:10px;">Release to vendor</a>
                  
                  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span> <a href="#" class="btn btn-primary btndisable" style="margin-bottom:10px;">Refund to buyer</a>  
				  <?php } else { ?>
				  <a href="<?php echo $url;?>/admin/refund/<?php echo $request->dispute_id;?>/<?php echo $request->order_id;?>/<?php echo $request->purchase_token;?>/<?php echo $admin_commission;?>/<?php echo $vendor_commission;?>" class="btn btn-primary" style="margin-bottom:10px;">Release to vendor</a>
                  <a href="<?php echo $url;?>/admin/refund/<?php echo $request->dispute_id;?>/<?php echo $request->order_id;?>/<?php echo $request->purchase_token;?>/<?php echo $request->payment;?>" class="btn btn-primary" style="margin-bottom:10px;">Refund to buyer</a>
				  <?php } ?>
                  
                  <?php } else { ?>
                  
                  <span style="color:#FF3300;"><?php echo $request->dispute_status;?></span>
                  <?php } ?>
				   
						  </td>
                          
                          
                          
                          <td>
						   <?php if(config('global.demosite')=="yes"){?>
				    <a href="#" class="btn btn-danger btndisable">Delete</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  
						  <a href="<?php echo $url;?>/admin/refund/delete/<?php echo $request->dispute_id;?>" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete this?')">Delete</a> 
						  
				  <?php } ?>
				   
						  </td>
                        </tr>
                        <?php $i++;} ?>
                                
              </tbody>
                    </table>
					
					
                  </div>
                </div>
                
                
              </div>
              <?php }  ?>
		
		 
		  
		  
		  
        </div>
        <!-- /page content -->

      @include('admin.footer')
      </div>
    </div>

    
	
  </body>
</html>
