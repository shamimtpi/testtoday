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
         
		 
		 
		 
         <?php  if (in_array(16, $hidden)){?>
		 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Language</h2>
                    <ul class="nav navbar-right panel_toolbox">
                     
                       <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
					
                  </div>
				  <div align="right">
				  <?php if(config('global.demosite')=="yes"){?>
				  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span> <a href="#" class="btn btn-primary btndisable">Add Language</a> 
				  <?php } else { ?>
				  <a href="<?php echo $url;?>/admin/add-language" class="btn btn-primary">Add Language</a>
				  <?php } ?>
                  <div class="x_content">
                   
					
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sno</th>
                          <th>Name</th>
						  <th>ISO Code</th>
                          <th>Flag</th>
                           <th>Set as default</th>
                          <th>Status</th>
                          
                          <th>Action</th>
                          
                        </tr>
                      </thead>
                      <tbody>
					  <?php 
					  $i=1;
					  foreach ($language as $languages) { ?>
    
						
                        <tr>
						 <td><?php echo $i;?></td>
						
                          <td><?php echo $languages->lang_name;?></td>
                          
                          <td><?php echo $languages->lang_code;?></td>
                          
                          
                           <?php 
					   $photo="/media/language/";
						$path ='/local/images'.$photo.$languages->lang_flag;
						if($languages->lang_flag!=""){
						?>
						 <td><img src="<?php echo $url.$path;?>" class="thumb" width="24"></td>
						 <?php } else { ?>
						  <td><img src="<?php echo $url.'/local/images/noimage.jpg';?>" class="thumb" width="24"></td>
						 <?php } ?>
						 
                        <td>
                        <?php 
						  if($languages->lang_default==0){ $btn = "btn btn-danger"; $text = "Set as default"; $sid = 1; } else { $btn = "btn btn-success"; $text = "Default"; $sid=0; }
						  ?>
                           <?php if(config('global.demosite')=="yes"){?>
				    <a href="#" class="<?php echo $btn;?> btndisable"><?php echo $text;?></a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  
						  <a href="<?php echo $url;?>/admin/language/{{ $languages->id }}/{{ $sid }}" class="<?php echo $btn;?>" <?php if($sid==0){?> style="pointer-events: none;
   cursor: default;" <?php } ?>><?php echo $text;?></a>
						  
				  <?php } ?>
                  
                        
                        </td>
                         
                          <td>
                          <?php 
						  if($languages->lang_status==0){ $btn = "btn btn-danger"; $text = "Disable"; $sid = 1; } else { $btn = "btn btn-success"; $text = "Enable"; $sid=0; }
						  ?>
                          
                          <?php if($languages->id!=2){?>
                           <?php if(config('global.demosite')=="yes"){?>
				    <a href="#" class="<?php echo $btn;?> btndisable"><?php echo $text;?></a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  
						  <a href="<?php echo $url;?>/admin/language/action/{{ $languages->id }}/{{ $sid }}" class="<?php echo $btn;?>"><?php echo $text;?></a>
						  
				  <?php } ?>
                           <?php } else { ?>
                          <img src="<?php echo $url.'/local/images/not-allowed.png';?>" width="24" border="0" alt="Not Allowed">
                          <?php } ?>
                         
                          </td>
                         
                         
						  <td>
						   <?php if($languages->id!=2){?>
						   <?php if(config('global.demosite')=="yes"){?>
						  <a href="#" class="btn btn-success btndisable">Edit</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  
						  <a href="<?php echo $url;?>/admin/edit-language/{{ $languages->id }}" class="btn btn-success">Edit</a>
						  <?php } ?>
				   <?php if(config('global.demosite')=="yes"){?>
				    <a href="#" class="btn btn-danger btndisable">Delete</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						 <a href="<?php echo $url;?>/admin/language/{{ $languages->id }}" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete this?')">Delete</a>
						  <?php } ?>
                           <?php } else { ?>
                          <img src="<?php echo $url.'/local/images/not-allowed.png';?>" width="24" border="0" alt="Not Allowed">
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
