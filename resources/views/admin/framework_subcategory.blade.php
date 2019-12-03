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
         
		 
         <?php  if (in_array(7, $hidden)){?>
		 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Software Framework Sub Category</h2>
                    
                    <div class="clearfix"></div>
					
                  </div>
                  
                  
                 <form action="{{ route('admin.framework_subcategory') }}" method="post">
                 
                 {{ csrf_field() }}
				  <div align="right">
                  
                  <?php if(config('global.demosite')=="yes"){?>
					
				   <a href="#" class="btn btn-danger btndisable">Delete All</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
				   <input type="submit" value="Delete All" class="btn btn-danger" id="checkBtn" onClick="return confirm('Are you sure you want to delete?');">
				  <?php } ?>
                  
                  
				  <?php if(config('global.demosite')=="yes"){?>
				  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span> <a href="#" class="btn btn-primary btndisable">Add Sub Category</a> 
				  <?php } else { ?>
				  <a href="<?php echo $url;?>/admin/add_framework_subcategory" class="btn btn-primary">Add Sub Category</a>
				  <?php } ?>
                  <div class="x_content">
                   
					
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                        
                         <th width="10%">
          <button type="button" id="selectAll" class="main">
          <span class="sub"></span> Select All </button></th>
                        
                          <th>Sno</th>
						  <?php /*?><th>Image</th><?php */?>
                          <th>Category</th>
                          <th>Sub Category</th>
                          <th>Action</th>
                          
                        </tr>
                      </thead>
                      <tbody>
            <?php 
					  $i=1;
					  foreach ($subcategory as $subservice) { ?>
    
                      
                      
                      <tr class="gradeX">
                        <td><input type="checkbox" name="subid[]" value="<?php echo $subservice->subid;?>"/></td>
                        
						 <td><?php echo $i;?></td>
						 <?php /*?><?php 
					   $subservicephoto="/media/";
						$path ='/local/images'.$subservicephoto.$subservice->subimage;
						if($subservice->subimage!=""){
						?>
						 <td><img src="<?php echo $url.$path;?>" class="thumb" width="70"></td>
						 <?php } else { ?>
						  <td><img src="<?php echo $url.'/local/images/noimage.jpg';?>" class="thumb" width="70"></td>
						 <?php } ?><?php */?>
                         
                          
						  <td><?php echo $subservice->cat_name;?></td>
						   <td><?php echo $subservice->subcat_name;?></td>
						  <td>
						  <?php if(config('global.demosite')=="yes"){?>
						  <a href="#" class="btn btn-success btndisable">Edit</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  
						  <a href="<?php echo $url;?>/admin/edit_framework_subcategory/{{ $subservice->subid }}" class="btn btn-success">Edit</a>
						   <?php } ?>
				   <?php if(config('global.demosite')=="yes"){?>
				    <a href="#" class="btn btn-danger btndisable">Delete</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
				   
						 <a href="<?php echo $url;?>/admin/framework_subcategory/{{ $subservice->subid }}" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete this?')">Delete</a>
						   <?php } ?>
						  </td>
                        </tr>
                      
                   <?php $i++;} ?>
                                
              </tbody>
                    </table>
					
					
                  </div>
                </div>
                </form>
                
              </div>
			  
			  
			  
		 
		  
		  
		  
        </div>
        <?php }  ?>
    
        
		 
         
         
         
		 
		 
         </div>
         
         
         </div>
         
         
         
         
  
      

    
	 @include('admin.footer')
  </body>
</html>
