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
         
		 
		 
		 
          <?php  if (in_array(15, $hidden)){?>
		 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="">
                  <div class="x_title">
                    <h2>Translate</h2>
                    <ul class="nav navbar-right panel_toolbox">
                     
                       <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
					
                  </div>
                 
				  <div align="right">
                  
                   
                  
				   <?php if(config('global.demosite')=="yes"){?>
				  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span> <a href="#" class="btn btn-primary btndisable">Add Translate</a> 
				  <?php } else { ?>
				  <a href="<?php echo $url;?>/admin/addtranslate" class="btn btn-primary">Add Translate</a>
				  <?php } ?>
                  
                  
                  
                  </div>
                  <div class="x_content">
                   
					
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                      <thead>
                        <tr>
                        
                        
                        
                          <th>Sno</th>
						  
                          <th>Name</th>
                          
                          <th>Shortcode</th>
                         
                          <th>Action</th>
                          
                        </tr>
                      </thead>
                      <tbody>
					  <?php 
					  $i=1;
					  foreach ($translate as $translates) { ?>
    
						
                        <tr>
                        
                        
						 <td><?php echo $i;?></td>
						<?php 
						/*$gview = DB::table('gallery')
		              ->where('parent', '=', $translates->id)->get();
					  $get ="";
					  foreach($gview as $nview){ $get .=$nview->lang_code; 
					   $getflag = DB::table('codepopular_langs')->where('lang_status','=',1)->where('lang_code','=',$nview->lang_code)->get();
					  }*/
					 
					  
                          ?>
						  
						  <td><?php echo $translates->name;?></td>
                          
                          <td>
                          
                          <?php highlight_string('<?php echo translate(');?><?php echo $translates->id.',';?><?php highlight_string('$lang);?>');?>
                          </td>
                          
						  
						  <td>
						   <?php if(config('global.demosite')=="yes"){?>
						  <a href="#" class="btn btn-success btndisable">Edit</a>  <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span>
				  <?php } else { ?>
						  <a href="<?php echo $url;?>/admin/edittranslate/{{ $translates->id }}" class="btn btn-success">Edit</a>
						  <?php } ?>
				   
						 </td>
                        </tr>
                        <?php $i++;} ?>
                       
                      </tbody>
                    </table>
					
					
                  </div>
                  
                  </form>
                  
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
