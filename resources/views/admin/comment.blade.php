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
		
		<?php $url = URL::to("/"); ?>
		
		
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
         
		 
		 
		 
		 
		 
		 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <?php if($urlcomment=='blog'){ $urls = "blog";?><h2>Comment - <?php echo $view_title[0]->post_title;?></h2><?php } ?>
                    <?php if($urlcomment=='event'){ $urls = "events";?><h2>Comment - <?php echo $view_title[0]->post_title;?></h2><?php } ?>
                    <?php if($urlcomment=='sermons'){ $urls = "sermons";?><h2>Comment - <?php echo $view_title[0]->name;?></h2><?php } ?>
                    
                    <ul class="nav navbar-right panel_toolbox">
                     
                       <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
					
                  </div>
				  <div align="right">
				  <?php if(config('global.demosite')=="yes"){?>
				  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span> <a href="#" class="btn btn-primary btndisable">Back</a> 
				  <?php } else { ?>
				  <a href="<?php echo $url;?>/admin/<?php echo $urls;?>" class="btn btn-primary">Back</a>
				  <?php } ?>
                  <div class="x_content">
                   
					
                    <table id="" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                          <th>Sno</th>
						  <th>Name</th>
                          <th>Email</th>
                          <th style="width:400px !important;">Message</th>
                         
                          <th>Status</th>
                          <th>Action</th>
                          
                        </tr>
                      </thead>
                      <tbody>
					  <?php 
					  $i=1;
					  foreach ($view_comment as $comment) { 
					  
					  if($comment->post_status==0){ $btn = "btn btn-danger"; $text = "Deactive"; $sid = 1; } else { $btn = "btn btn-success"; $text = "Active"; $sid=0; }
					  ?>
    
						
                        <tr>
						 <td><?php echo $i;?></td>
						
                          <td><?php echo $comment->post_title;?></td>
                          
                          <td><?php echo $comment->post_email;?></td>
                          
						  <td style="width:400px !important;"><?php echo $comment->post_desc;?></td>
                          
                          <td> <?php if(config('global.demosite')=="yes"){?>
				    <a href="#" class="<?php echo $btn;?> btndisable"><?php echo $text;?></a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  
						  <a href="<?php echo $url;?>/admin/comment/{{ $comment->post_id }}/{{ $sid }}" class="<?php echo $btn;?>"><?php echo $text;?></a>
						  
				  <?php } ?> </td>
                          
                         
                          
                          
						  
                          <td>
                          
                          
                          
                          
                          
                          
						  
				   <?php if(config('global.demosite')=="yes"){?>
				    <a href="#" class="btn btn-danger btndisable">Delete</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						 <a href="<?php echo $url;?>/admin/comment/{{ $comment->post_id }}" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete this?')">Delete</a>
						  <?php } ?>
						  </td>
                        </tr>
                        <?php $i++;} ?>
                       
                      </tbody>
                    </table>
					
					
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
