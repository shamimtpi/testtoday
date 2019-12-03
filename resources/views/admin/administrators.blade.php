<!DOCTYPE html>
<html lang="en">
  <head>
   
   @include('admin.title')
    
    @include('admin.style')
    <?php
$logid = Auth::user()->id;

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
        <?php if($logid==1){?>
        <!-- page content -->
       
        <div class="right_col" role="main">
          <!-- top tiles -->
         
		 
		 
		 
		 
		 
		 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel padding15">
                  <div class="x_title">
                    <h2>Administrators</h2>
                    <ul class="nav navbar-right panel_toolbox">
                     
                       <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
					
                  </div>
				  <div align="right">
				  <?php if(config('global.demosite')=="yes"){?>
				  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span> <a href="#" class="btn btn-primary btndisable">Add Administrator</a> 
				  <?php } else { ?>
				  <a href="<?php echo $url;?>/admin/add_administrator" class="btn btn-primary">Add Administrator</a>
				  <?php } ?>
				  </div>
                  <div class="x_content">
                   
					
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sno</th>
						  <th>Photo</th>
                          <th>Username</th>
                          <th>Email</th>
						 
						  
                           <?php /*?><th>Status</th><?php */?>
                          <th>Action</th>
                          
                        </tr>
                      </thead>
                      <tbody>
					  <?php 
					  $i=1;
					  foreach ($administrator as $user) { $sta=$user->admin; if($sta==1){ $viewst="Admin"; } else if($sta==2) { $viewst="Seller"; } else if($sta==0) { $viewst="Customer"; }
					  
					  
					  
					  
					  
					  ?>
    
						
                        <tr>
						 <td><?php echo $i;?></td>
						 <?php 
					   $userphoto="/media/userphoto/";
						$path ='/local/images'.$userphoto.$user->photo;
						if($user->photo!=""){
						?>
						 <td><img src="<?php echo $url.$path;?>" class="thumb" width="70"></td>
						 <?php } else { ?>
						  <td><img src="<?php echo $url.'/local/images/nophoto.jpg';?>" class="thumb" width="70"></td>
						 <?php } ?>
                          <td><?php echo $user->name;?></td>
                          <td><?php echo $user->email;?></td>
						  
						  
						  
						  
						  
						  
						  
						  <?php if($user->status==1){ $status_txt = "Active"; $clrs="green"; $btn_class = "btn btn-success"; $sid = 0; } 
						  else { $status_txt = "InActive"; $btn_class = "btn btn-danger"; $sid = 1; $clrs="red"; } ?>
						  
						  
						  <?php /*?><td style="color:<?php echo $clrs;?>; font-weight:bold;">
						  <?php if($user->id!=1){?>
						  
						  
						  
						  <?php echo $status_txt;?>
				         <?php } ?>
				  
				         </td><?php */?>
						 
						 
						 
						
						 
						 
						 
						 
						  
						  
						  
						  <td>
						  
						 <?php /*?> <?php if(config('global.demosite')=="yes"){?>
						  <a href="#" class="btn btn-success btndisable">Active</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
						  <?php } else {?> @if($user->id!=1) <a href="<?php echo $url;?>/admin/administrators/status/1/{{ $user->id }}" class="btn btn-success">Active</a> @endif
						  <?php } ?>
						  
						  
						  <?php if(config('global.demosite')=="yes"){?>
						  <a href="#" class="btn btn-success btndisable">InActive</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
						  <?php } else {?> @if($user->id!=1) <a href="<?php echo $url;?>/admin/administrators/status/0/{{ $user->id }}" class="btn btn-success">InActive</a> @endif
						  <?php } ?><?php */?>
						  
						  
						  
						  
						  
						  <?php if(config('global.demosite')=="yes"){?>
						  <a href="#" class="btn btn-success btndisable">Edit</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  
						  <a href="<?php echo $url;?>/admin/edit_administrator/{{ $user->id }}" class="btn btn-success">Edit</a>
				  <?php } ?>
				  
				  
				  
				  
				  
				   <?php if(config('global.demosite')=="yes"){?>
				    <a href="#" class="btn btn-danger btndisable">Delete</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  
						  @if($user->id!=1)<a href="<?php echo $url;?>/admin/administrators/{{ $user->id }}" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete this?')">Delete</a> @endif
						  
				  <?php } ?>
						  </td>
                        </tr>
                        <?php $i++; } ?>
                       
                      </tbody>
                    </table>
					
					
                  </div>
                
              </div>
			  
			  
			  
		 
		  
		  
		  
        </div>
        <!-- /page content -->

      
      </div>
    
		      
    </div>
<?php } else { ?>
	  
	  
	  @include('admin.permission')
	  
		<?php } ?>
	  
	  
	  
	 
	 @include('admin.footer')
    
	
  </body>
</html>
