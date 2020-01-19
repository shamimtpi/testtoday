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
          <?php  if (in_array(1, $hidden)){?>
          <div class="row tile_count">
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Users</span>
              <div class="count green"><?php echo $total_user;?></div>
              
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-picture-o"></i> Total Items</span>
              <div class="count"><?php echo $items_count;?></div>
              
            </div>
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-user"></i> Total Blog</span>
              <div class="count"><?php echo $total_blog;?></div>
              
            </div>
            
             <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-comment-o"></i> Today Comments</span>
              <div class="count"> <?php echo $total_comment;?> </div>
              
            </div>
            
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-book"></i> Total Pages</span>
              <div class="count"><?php echo $pages;?></div>
              
            </div>
            
            <div class="col-md-2 col-sm-4 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-book"></i> Total Newsletter</span>
              <div class="count"><?php echo $newsletter;?></div>
              
            </div>
            
           
          </div>
          <!-- /top tiles -->

		  <div style="clear:both;"></div>
		  	  
		  
		  <div class="row whitebg">
         <h3 class="report_title">Last 7 Days Item Orders Report</h3>
		 
		 
		 
		 <script type="text/javascript">
	window.onload = function () {
			var dps = [
		<?php echo $javas;?>
		];
		
		var chart = new CanvasJS.Chart("chartContainer",
		{
			
			 
			title:{
				//text: "Last 7 Days Order Report",
				fontSize:20,
				titleFontFamily: "Myriad Pro, sans-serif"
			},
			
                        animationEnabled: true,
			axisX:{

				gridColor: "Silver",
				tickColor: "silver"
				//valueFormatString: "DD/MMM"

			},                        
                        toolTip:{
                          shared:true
                        },
			theme: "theme1",
			axisY: {
				gridColor: "Silver",
				tickColor: "silver"
			},
			legend:{
				verticalAlign: "center",
				horizontalAlign: "right"
			},
			data: [
			{        
				type: "splineArea",
				showInLegend: true,
				lineThickness: 2,
				name: "Orders",
				markerType: "circle",
				color: "#F42434",
				dataPoints: dps
			}			
			],
			axisX: {
        title: "Last 7 days",
       // titleFontFamily: "comic sans ms"
      },
			axisY: {
        title: "No of Orders",
        //titleFontFamily: "comic sans ms"
      },
          legend:{
            cursor:"pointer",
            itemclick:function(e){
              if (typeof(e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
              	e.dataSeries.visible = false;
              }
              else{
                e.dataSeries.visible = true;
              }
              chart.render();
            }
          }
		});

chart.render();
}
</script>



	<div id="chartContainer" style="height: 300px; width: 100%;">
	</div>
		  
	</div>
		  
		  
		  <br/><br/>
		  
		  
		 
          <div class="row">


            <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Recent Blog</h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                 
                  <div class="widget_summary">
                   
				   
				   <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
                      <th width="20%">
                        <p>Sno</p>
                      </th>
                      <th width="30%">
                        
                          <p>Image</p>
                       </th>
					   <th width="50%">
                       
                          <p>Title</p>
                       
                      </th>
					  
					  
                    </tr>
					
					<?php 
					  $i=1;
					  if(!empty($blog_cnt))
					  {
					  foreach ($blog as $blogs) { 
					  
					  $post_comment = DB::table('posts')
							 ->where('post_parent', '=', $blogs->post_id)
							 ->where('post_comment_type', '=', 'blog')
							 ->where('lang_code','=','en')
							 ->where('post_type', '=', 'comment')
							 ->count();
							 ?>
                    <tr>
                    
                    <td><?php echo $i;?></td>
                    <td>
                      <?php 
					  
						$path ='/local/images/media/blog/'.$blogs->post_image;
						if($blogs->post_media_type=="image"){
						?>
						 <img src="<?php echo $url.$path;?>" class="thumb" width="55">
						 <?php } 
             if($blogs->post_media_type=="mp3"){ ?>
						  <img src="<?php echo $url.'/local/images/mp3.png';?>" class="thumb" width="55">
						 <?php }
              if($blogs->post_media_type=="video"){ ?>
						  <img src="<?php echo $url.'/local/images/video.png';?>" class="thumb" width="55">
						 <?php  } ?>
                          </td>
					
                    <td><?php echo $blogs->post_title;?></td>
                    
					</tr>
                  <tr height="20"></tr>
				  <?php $i++;} } ?>
				  
				  </table>
                </div>
				
                  </div>

                  
                  
                  
                 

                </div>
              </div>
            </div>

            
			
			
			

			
			

           
		   
		   
		   
		   
		   <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Top Items</h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                 
                  <div class="widget_summary">
                   
				   
				   <div class="x_content">
                  
                  <table class="" style="width:100%">
                    <tr>
                      <th width="20%">
                        <p>Sno</p>
                      </th>
                      <th width="30%">
                        
                          <p>Image</p>
                       </th>
					   <th width="50%">
                       
                          <p>Title</p>
                       
                      </th>
					  
					  
                    </tr>
					
					<?php 
					  $i=1;
					  if(!empty($top_items_count))
					  {
					  $top_items = DB::table('products')
										->where('delete_status', '=', '')
										->where('item_status', '=', 1)
										->where('lang_code','=','en')
										->orderBy('item_id', 'desc')
										->limit(3)->offset(0)
										->get();
					  foreach ($top_items as $items) { 
					  
					  
							 ?>
                    <tr>
                    
                    <td><?php echo $i;?></td>
                    <td>
                      <?php 
					  
						$path ='/local/images/media/preview/'.$items->preview_image;
						if(!empty($items->preview_image)){
						?>
						 <img src="<?php echo $url.$path;?>" class="thumb" width="55">
						 <?php } else { ?>
						  <img src="<?php echo $url.'/local/images/noimage_box.jpg';?>" class="thumb" width="55">
						 <?php }  ?>
                          </td>
					
                    <td><?php echo $items->item_title;?></td>
                    
					</tr>
                  <tr height="20"></tr>
				  <?php $i++;} } ?>
				  
				  </table>
                  
                </div>
				
                  </div>

                  
                  
                  
                 

                </div>
              </div>
            </div>
		  


          
		  
		  
		  <div class="col-md-4 col-sm-4 col-xs-12">
              <div class="x_panel tile fixed_height_320">
                <div class="x_title">
                  <h2>Latest Users</h2>
                  
                  <div class="clearfix"></div>
                </div>
                <div class="x_content">
                 
                  <div class="widget_summary">
                   
				   
				   <div class="x_content">
                  <table class="" style="width:100%">
                    <tr>
					<th>
                       
                          <p>Photo</p>
                       
                      </th>
					
                      <th>
                        <p>Name</p>
                      </th>
                      <th>
                        
                          <p>Phone</p>
                       </th>
					   <th>
                       
                          <p>Gender</p>
                       
                      </th>
					  
					  
                    </tr>
					
					<?php foreach($users as $user){
						
						?>
					
                    <tr>
                      <?php 
					   $userphoto="/media/userphoto/";
						$path ='/local/images'.$userphoto.$user->photo;
						if($user->photo!=""){
						?>
						 <td><img src="<?php echo $url.$path;?>" class="thumb" width="55"></td>
						 <?php } else { ?>
						  <td><img src="<?php echo $url.'/local/images/nophoto.jpg';?>" class="thumb" width="55"></td>
						 <?php } ?>
                      <td>
                       <?php echo $user->name;?>
                      </td>
					  
					  <td>
                      <?php echo $user->phone;?>
                      </td>
					  
					  <td>
                       <?php echo $user->gender;?>
                      </td>
                    </tr>
                    <tr height="20"></tr>
					<?php } ?>
                  </table>
                </div>
				
                  </div>

                  
                  
                  
                 

                </div>
              </div>
            </div>
		  
		  
		  
		  
		  
        </div>
        <?php }  ?> 
    
        <!-- /page content -->

      
      </div>
      
      
      @include('admin.footer')
    </div>

    
	
  </body>
</html>
