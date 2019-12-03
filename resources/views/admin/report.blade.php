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
                    <h2>Report Items</h2>
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
											<th>Report By</th>
											<th>Item Name</th>
											<th>Report Category</th>
                                            <th>Reason for Report</th>
                                            
                                            
                                            
                                            <th>Action</th>
                        </tr>
                      </thead>
                     <tbody>
             <?php if(!empty($report_count)){?>
                                        <?php 
										$i=1;
										foreach($report_view as $view_contact){
										
										
										 $item_details_cc = DB::table('products')
														  ->where('item_id','=',$view_contact->item_id)
														 ->count();
										if(!empty($item_details_cc))
										{
										  $item_details = DB::table('products')
														  ->where('item_id','=',$view_contact->item_id)
														 ->get();
										  $item_name = $item_details[0]->item_title;
										  $item_slug = $item_details[0]->item_slug;
										  $item_id = $item_details[0]->item_id;
										}
										else
										{
										  $item_name = "";
										  $item_slug = "";
										  $item_id = "";
										  
										}
										
														 
										$user_details_cc = DB::table('users')
														  ->where('id','=',$view_contact->report_user_id)
														 ->count();
										if(!empty($user_details_cc))
										{
										$user_details = DB::table('users')
														  ->where('id','=',$view_contact->report_user_id)
														 ->get();
										$report_name = $user_details[0]->name;				 
										}	
										else
										{
										 $report_name = "";
										}			 
										?>	
    
						
                        <tr>
											<td><?php echo $i;?></td>
											
												
											<td><?php echo $report_name;?></td>											
											<td><a href="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $item_slug;?>" style="color:#0000FF;"><?php echo $item_name;?></a></td>
                                            <td><?php echo $view_contact->report_category;?></td>
                                            <td><?php echo $view_contact->reason_for_report;?></td>
                                            
                                           
                                            <td>
                                            
                                            
                          <?php if(config('global.demosite')=="yes"){?>
				  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span> <a href="#" class="btn btn-danger btndisable" onClick="return confirm('Are you sure you want to delete this?')">Delete</a> 
				  <?php } else { ?>
				  <a href="<?php echo $url;?>/admin/report/<?php echo $view_contact->rid;?>" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete this?')">Delete</a>
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
