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
         
		 
		 
		 
		 
         <?php  if (in_array(14, $hidden)){?>
		 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Contact Us</h2>
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
											<th>Name</th>
											<th>Email</th>
											<th>Phone</th>
                                            <th>Date</th>
                                            <th>Message</th>
                                            
                                            
                                            <th>Action</th>
                        </tr>
                      </thead>
                     <tbody>
             <?php if(!empty($contact_count)){?>
                                        <?php 
										$i=1;
										foreach($contact_view as $view_contact){?>	
    
						
                        <tr>
											<td><?php echo $i;?></td>
											
												
											<td><?php echo $view_contact->cont_name;?></td>											
											<td><?php echo $view_contact->cont_email;?></td>
                                            <td><?php echo $view_contact->cont_phone;?></td>
                                            <td><?php echo $view_contact->cont_date;?></td>
                                            <td><?php echo nl2br($view_contact->cont_message);?></td>
                                           
                                            <td>
                                            
                                            
                          <?php if(config('global.demosite')=="yes"){?>
				  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span> <a href="#" class="btn btn-danger btndisable" onClick="return confirm('Are you sure you want to delete this?')">Delete</a> 
				  <?php } else { ?>
				  <a href="<?php echo $url;?>/admin/contact/<?php echo $view_contact->cont_id;?>" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete this?')">Delete</a>
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
