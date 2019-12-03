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
                    <h2>Items</h2>
                    <ul class="nav navbar-right panel_toolbox">
                     
                       <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
					
                  </div>
                  
                  <form action="{{ route('admin.products') }}" method="post">
                 
                 {{ csrf_field() }}
				  <div align="right">
                  
                   <?php if(config('global.demosite')=="yes"){?>
					
				   <a href="#" class="btn btn-danger btndisable">Delete All</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
				   <input type="submit" value="Delete All" class="btn btn-danger" id="checkBtn" onClick="return confirm('Are you sure you want to delete?');">
				  <?php } ?>
                  
				   <?php if(config('global.demosite')=="yes"){?>
				  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span> <a href="#" class="btn btn-primary">Add Item</a> 
				  <?php } else { ?>
				  <a href="<?php echo $url;?>/admin/add-item" class="btn btn-primary">Add Item</a>
				  <?php } ?>
                  
                  </div>
                  
				
                  <div class="x_content">
                   
					
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                        
                        <th width="10%">
          <button type="button" id="selectAll" class="main">
          <span class="sub"></span> Select All </button></th>
                        
                          <th>Sno</th>
                          
                          <th>Item Id</th>
                          
                          <th>Image</th>
                          
						  
                          <th>Title</th>
                          
                          <th>Category</th>
                          
                          <th>Featured?</th>
                          
                          <th>Make Featured</th>
                          
                          <th>Regular Price</th>
                          
                          <th>View More</th>
                          
                          <th>Status</th>
                          
                          <th>Action</th>
                          
                        </tr>
                      </thead>
                      <tbody>
					  <?php 
					  if(!empty($items_count))
					  {
					  $items_get = DB::table('products')
									->where('delete_status','=','')
									->where('lang_code','=','en')
									->orderBy('item_id', 'desc')
									->get();
					  
					  $i=1;
					  foreach ($items_get as $items) { 
					  
					  
					  if(!empty($items->category))
					  {
					  $category_id = $items->category;
					  
					  
                      $pieces = explode(",", $category_id);
					  $category_name ="";
                      foreach($pieces as $view)
					  {
					      $split = explode("-",$view);
						  $cid = $split[0];
						  $ctype = $split[1];
						  if($ctype=="cat")
						  {
						  
						      $category_first_count = DB::table('product_categories')
									            ->where('id','=',$cid)
									            ->count();
						      if(!empty($category_first_count))
							  {
						      $category_first = DB::table('product_categories')
									            ->where('id','=',$cid)
									            ->get();
												
							  $category_name .= $category_first[0]->cat_name.',';
							  }
							  else
							  {
							    $category_name = "";
							  }
						  }
						  else if($ctype=="subcat")
						  {
						       $category_first_count = DB::table('product_subcats')
									            ->where('subid','=',$cid)
									            ->count();
						      if(!empty($category_first_count))
							  {
						      $category_first = DB::table('product_subcats')
									            ->where('subid','=',$cid)
									            ->get();
							  $category_name .= $category_first[0]->subcat_name.',';
							  }
							  else
							  {
							    $category_name = "";
							  }
						  }
						  else
						  {
						     $category_name="";
						  }
						  
						  
					  }
					  
					  }
					  else
					  {
					     $category_name="";
					  }
					  ?>
    
						
                        <tr>
                        <td><input type="checkbox" name="token[]" value="<?php echo $items->item_token;?>"/></td>
                        
						 <td><?php echo $i;?></td>
                         
                          <td><?php echo $items->item_token;?></td>
                          
                          <?php 
					   
						$path ='/local/images/media/preview/'.$items->preview_image;
						if($items->preview_image!=""){
						?>
						 <td><img src="<?php echo $url.$path;?>" class="thumb" width="70"></td>
						 <?php } else { ?>
						  <td><img src="<?php echo $url.'/local/images/nophoto.jpg';?>" class="thumb" width="70"></td>
						 <?php } ?>
                          
						
                          <td><?php echo substr($items->item_title,0,30);?></td>
                          
						  
                          <td><?php if(!empty($category_name)){?><?php echo rtrim($category_name,',');?><?php } else {?><?php echo $category_name;?><?php } ?></td>
                          
                          
                          <td><?php if($items->item_featured==1){?><span style="background:#006600; color:#fff; padding:5px;"> Yes </span><?php } else { ?><span style="background:#FF0000; color:#fff; padding:5px;"> No </span><?php } ?></td>
                          
                          
                          <td align="center">
                          <?php if($items->item_featured==0){?><a href="<?php echo $url;?>/admin/products/{{ $items->item_token }}/1" class="btn btn-success">Make Featured</a><?php } else { ?> - <?php } ?>
                          </td>
                          
                          
                          <td><?php echo $items->regular_price_six_month;?> <?php echo $setting[0]->site_currency;?> (6 months)</td>
                          
                          
						  <td>
						  
                  
                  <?php if(config('global.demosite')=="yes"){?>
						  <a href="#" class="btn btn-success btndisable">View More</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  <a href="<?php echo $url;?>/admin/product_more/{{ $items->item_token }}" class="btn btn-success">View More</a>
				  <?php } ?>
                  </td>
                  
                  
                  <?php
				  if($items->item_status==0){ $btn = "btn btn-danger"; $text = "Waiting For Approval"; $sid = 1; } else { $btn = "btn btn-success"; $text = "Approved"; $sid=0; }
				  ?>
                  
                  <td>
                  
                   <?php if(config('global.demosite')=="yes"){?>
				    <a href="#" class="<?php echo $btn;?> btndisable"><?php echo $text;?></a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  
						  <a href="<?php echo $url;?>/admin/products/{{ $items->item_token }}/{{ $sid }}/<?php echo $items->item_id;?>/<?php echo $items->user_id;?>" class="<?php echo $btn;?>"><?php echo $text;?></a>
						  
				  <?php } ?>
                  </td>
                  
                  
                  
                  <td>
                  <?php if(config('global.demosite')=="yes"){?>
						  <a href="#" class="btn btn-success">Edit</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  <a href="<?php echo $url;?>/admin/edit-item/{{ $items->item_token }}" class="btn btn-success">Edit</a>
						  <?php } ?>
                  
                  <?php if(config('global.demosite')=="yes"){?>
				   <a href="#" class="btn btn-danger btndisable">Delete</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						 <a href="<?php echo $url;?>/admin/products/{{ $items->item_token }}" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete this?')">Delete</a>
						 
					 <?php } ?>
                 
                  
						  </td>
                        </tr>
                        <?php $i++;} } ?>
                       
                      </tbody>
                    </table>
					
					
                  </div>
                </div>
                 </form>
                
              </div>
              <?php }  ?>
		
		  
        </div>
        <!-- /page content -->

      @include('admin.footer')
      </div>
    </div>

    
	
  </body>
</html>
