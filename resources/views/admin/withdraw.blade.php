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
         
		 
		 
		 
		 
         <?php  if (in_array(9, $hidden)){?>
		 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Withdraw Details</h2>
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
                        
                        
                        
                          <th>SNo</th>
											<th>Amount</th>
											<th>Payment Type</th>
                                            <th>Perfectmoney Id</th>
											<th>Paypal Id</th>
                                            <th>Stripe Id</th>
                                             <th>Paytm No</th>
                                            <th>Bank Account No</th>
                                            <th>Bank Info</th>
                                            <th>IFSC Code</th>
                                            <th>Status</th>
                                            <th>Action</th>
                        </tr>
                      </thead>
                     <tbody>
             <?php if(!empty($withdraw_count)){?>
                                        <?php 
										$i=1;
										foreach($withdraw_view as $view_withdraw){?>	
    
						
                        <tr>
											<td><?php echo $i;?></td>
											<td><?php echo $view_withdraw->withdraw_amount.' '.$site_setting[0]->site_currency;?></td>
											<td><?php echo $view_withdraw->withdraw_payment_type;?></td>
                                            <td><?php echo $view_withdraw->perfectmoney_id;?></td>	
											<td><?php echo $view_withdraw->paypal_id;?></td>	
												
											<td><?php echo $view_withdraw->stripe_id;?></td>	
                                            <td><?php echo $view_withdraw->paytm_no;?></td>										
											<td><?php echo $view_withdraw->bank_account_no;?></td>
                                            <td><?php echo $view_withdraw->bank_info;?></td>
                                            <td><?php echo $view_withdraw->bank_ifsc;?></td>
                                           
                                            <td>
                                            <?php if($view_withdraw->withdraw_status=="pending"){?>
                                            
                          <?php if(config('global.demosite')=="yes"){?>
				  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span> <a href="#" class="btn btn-success btndisable">Mark as complete</a> 
				  <?php } else { ?>
				  <a href="<?php echo $url;?>/admin/withdraw/<?php echo base64_encode($view_withdraw->wid);?>" class="btn btn-success">Mark as complete</a>
				  <?php } ?>
                  <?php } else { ?>
                  <span style="color:#00CC00;"><?php echo $view_withdraw->withdraw_status;?></span>
                  <?php } ?>
                  
                  
                          </td>
                          <td>
                          <?php if(config('global.demosite')=="yes"){?>
				    <a href="#" class="btn btn-danger btndisable">Delete</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  
						  <a href="<?php echo $url;?>/admin/withdraw/delete/<?php echo $view_withdraw->wid;?>" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete this?')">Delete</a> 
						  
				  <?php } ?>
                  </td>
                          
                          
										</tr>
                        <?php $i++;} ?>
                        <?php } ?>	
                                
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
