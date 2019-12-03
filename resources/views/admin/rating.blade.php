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
                    <h2>Ratings & Reviews</h2>
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
						  <th>Buyer Name</th>
                          <th>Item Name</th>
                          <th>Rating</th>
                          <th style="width:300px;">Review</th>
                          
                          <th>Action</th>
                          
                         </tr>
                         
                         
                          
                        
                      </thead>
                      <tbody>
             <?php if(!empty($rating_count)){
					  $i=1;
					  
					  $rating = DB::table('product_ratings')
		                ->orderBy('rate_id','desc')
					   ->get();
					  foreach ($rating as $ratings) {
					  
					  
					  
					  $buyer_count = DB::table('users')
		                            ->where('id','=',$ratings->user_id)
					                ->count();
					  if(!empty($buyer_count))
					  {				
					  $buyer_details = DB::table('users')
		                            ->where('id','=',$ratings->user_id)
					                ->get();
					    $buyer_namer = $buyer_details[0]->name;
						$buyer_slug =  $buyer_details[0]->user_slug;
						
					  }
					  else
					  {
					     $buyer_namer = "";
						 $buyer_slug = "";
					  } 
					  
					  
					  
					 
					  
					  
					  
					  $prod_count = DB::table('products')
		                            ->where('item_id','=',$ratings->item_id)
					                ->count();
					  
					  if(!empty($prod_count))
					  {				
					  $prod_details = DB::table('products')
		                            ->where('item_id','=',$ratings->item_id)
					                ->get();
					    $item_title = $prod_details[0]->item_title;
						$item_slug = $prod_details[0]->item_slug;
					  }
					  else
					  {
					     $item_title = "";
						 $item_slug = "";
					  } 
					  
					  
					
				   
				   
				   
					   ?>
    
						
                        <tr>
                         
                        
						 <td><?php echo $i;?></td>
                        
                          <td><a href="<?php echo $url;?>/user/<?php echo $buyer_slug;?>" style="color:#0000CC; text-decoration:underline;"><?php echo $buyer_namer;?></a></td>
                          <td><a href="<?php echo $url;?>/item/<?php echo $ratings->item_id;?>/<?php echo $item_slug;?>" style="color:#0000CC; text-decoration:underline;"><?php echo $item_title;?></a></td>
                          
                         <td><?php echo $ratings->rating;?> stars</td>
                        
                          <td><?php echo $ratings->review;?></td>
                          
						  
						  <td>
						   <?php if(config('global.demosite')=="yes"){?>
				    <a href="#" class="btn btn-danger btndisable">Delete</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  
						  <a href="<?php echo $url;?>/admin/rating/{{ $ratings->rate_id }}" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete this?')">Delete</a> 
						  
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
