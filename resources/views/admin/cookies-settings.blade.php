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
		
		
		
		
        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <!-- top tiles -->
         
		 
		 
		 
		 
          <?php  if (in_array(2, $hidden)){?>
		 <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">
                  
 	@if(Session::has('success'))

	    <div class="alert alert-success">

	      {{ Session::get('success') }}

	    </div>

	@endif


	
	
 	@if(Session::has('error'))

	    <div class="alert alert-danger">

	      {{ Session::get('error') }}

	    </div>

	@endif
                <?php $url = URL::to("/"); ?>    
                   <form class="form-horizontal form-label-left" role="form" method="POST" action="{{ route('admin.cookies-settings') }}" enctype="multipart/form-data" novalidate>
                     {{ csrf_field() }}  
                      <span class="section">Cookies Settings</span>

                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="currency">Cookie<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<select name="site_cookie" required="required" class="form-control col-md-7 col-xs-12">
						<option value=""></option>
						<option value="on" <?php if($site_cookie=="on"){?> selected <?php } ?>>ON</option>
                        <option value="off" <?php if($site_cookie=="off"){?> selected <?php } ?>>OFF</option>
						</select>
                          
                        </div>
                      </div>
                      
                      
                      
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="currency">Position<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
						<select name="site_cookie_position" required="required" class="form-control col-md-7 col-xs-12">
						<option value=""></option>
						<option value="top" <?php if($site_cookie_position=="top"){?> selected <?php } ?>>Top</option>
                        <option value="bottom" <?php if($site_cookie_position=="bottom"){?> selected <?php } ?>>Bottom</option>
						</select>
                          
                        </div>
                      </div>
                     
                      
                      
                       <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Message</label> 
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <input id="site_cookie_message" type="text" name="site_cookie_message" value="<?php echo $translate_01[0]->name; ?>"  class="form-control col-md-7 col-xs-12" readonly>
						  
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                       <a href="<?php echo $url;?>/admin/edittranslate/<?php echo $translate_01[0]->id; ?>" class="btn btn-success">Translate</a>
                       </div>
                      </div>
                      
                      
                      
                      <div class="item form-group">
                        <label for="keyword" class="control-label col-md-3">Button Text</label> 
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <input id="site_cookie_button" type="text" name="site_cookie_button" value="<?php echo $translate_02[0]->name; ?>"  class="form-control col-md-7 col-xs-12" readonly>
						  
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                       <a href="<?php echo $url;?>/admin/edittranslate/<?php echo $translate_02[0]->id; ?>" class="btn btn-success">Translate</a>
                       </div>
                      </div>
                      
                   
					  
                     
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <a href="<?php echo $url;?>/admin/cookies-settings" class="btn btn-primary">Cancel</a>
						  <?php if(config('global.demosite')=="yes"){?><button type="button" class="btn btn-success btndisable">Submit</button> 
								<span class="disabletxt">( <?php echo config('global.demotxt');?> )</span><?php } else { ?>
						  
                          <button id="send" type="submit" class="btn btn-success">Submit</button>
								<?php } ?>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              <?php }  ?>
		
		
		
		
		
		
		
		
		
		
		
		
		
		
        <!-- /page content -->

      @include('admin.footer')
      </div>
    </div>

    
	
  </body>
</html>
