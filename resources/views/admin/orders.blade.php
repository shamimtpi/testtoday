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
                    <h2>Item Order Details</h2>
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
						  
                          <th>Purchase ID</th>
                          
                          <th>Buyer Name</th>
                          
                          <th>Seller Name</th>
                          
                          <th>Item Name</th>
                          
                          <th>Item Token</th>
                          
                          <th>Purchase Code</th>
                          
                          <th>Payment Type</th>
                          
                          <th>Payment Token</th>
                          
                          <th>Payment Status</th>
                          
                          <th>Payment Approval?</th>
                          
                          <th>View More</th>
                          
                          <th>Action</th>
                          
                        </tr>
                      </thead>
                      <tbody>
					  <?php
					  if(!empty($edit_orders_count))
					  { 
					  $edit_orders = DB::table('product_orders')->where('delete_status','=','')->orderBy('ord_id','desc')->get();
					  $i=1;
					  foreach ($edit_orders as $orders) { 
					  
					  $buyer_id = $orders->user_id;
					  $buyer_details = DB::table('users')->where('id','=',$buyer_id)->get();
					  
					  $vendor_id = $orders->item_user_id;
					  $vendor_details = DB::table('users')->where('id','=',$vendor_id)->get();
					  
					   $item_id = $orders->item_id;
					  $product_details = DB::table('products')->where('item_id','=',$item_id)->get();
					  ?>
    
						
                        <tr>
                        
                        
						 <td><?php echo $i;?></td>
						
                          <td><?php echo $orders->purchase_token;?></td>
                          
                          
                          <td><a href="<?php echo $url;?>/user/<?php echo $buyer_details[0]->user_slug;?>" target="_blank" style="color:#003399; text-decoration:underline;"><?php echo $buyer_details[0]->name;?></a></td>
                          
                          <td><a href="<?php echo $url;?>/user/<?php echo $vendor_details[0]->user_slug;?>" target="_blank" style="color:#FF0033; text-decoration:underline;"><?php echo $vendor_details[0]->name;?></a></td>
                          
						  
                          <td><a href="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $product_details[0]->item_slug;?>" style="color:#0033FF; text-decoration:underline;"><?php echo $orders->item_name;?></a></td>
                          
                           <td><?php echo $orders->item_token;?></td>
                           
                           <td><?php echo $orders->purchase_code;?></td>
                           
                           <td><?php echo $orders->payment_type;?></td>
                           
                            <td><?php echo $orders->payment_token;?></td>
                            
                            
                             <td><?php if($orders->payment_type!="localbank"){?><?php echo $orders->status;?><?php } ?></td>
                          
                          <td>
                          <?php if($orders->approval_status==""){
						  
						  $purchase_date = $orders->license_start_date;
						  $today_date = date('Y-m-d');
						  $refund_date = '+'.$setts[0]->refund_time_limit.' days';
						 $refund_by_date = date('Y-m-d', strtotime($purchase_date. $refund_date));
						
						 /*if($refund_by_date < $today_date)
						 {*/
						  ?>
                          <?php if(config('global.demosite')=="yes"){?>
						  <a href="#" class="btn btn-success btndisable">Waiting for Approval</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  <a href="<?php echo $url;?>/admin/orders/<?php echo $orders->ord_id;?>" class="btn btn-success">Waiting for Approval</a>
				  <?php } /*}*/ ?>
                  <?php } else {?>
                  <span style="color:#FF6600;"><?php echo $orders->approval_status;?></span>
                  <?php } ?>
                          </td>
                          
						  <td>
						  <?php if(config('global.demosite')=="yes"){?>
						  <a href="#" class="btn btn-success btndisable">View More</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  <a href="<?php echo $url;?>/admin/order_details/<?php echo $orders->ord_id;?>" class="btn btn-success">View More</a>
				  <?php } ?>
                  
                  
                  
						  </td>
                          
                          <td>
						   <?php if(config('global.demosite')=="yes"){?>
				    <a href="#" class="btn btn-danger btndisable">Delete</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  
						  <a href="<?php echo $url;?>/admin/orders/delete/<?php echo $orders->ord_id;?>" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete this?')">Delete</a> 
						  
				  <?php } ?>
				   
						  </td>
                          
                        </tr>
                        <?php $i++;} } ?>
                       
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
