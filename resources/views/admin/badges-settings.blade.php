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
                   <form class="form-horizontal form-label-left" role="form" method="POST" action="{{ route('admin.badges-settings') }}" enctype="multipart/form-data" novalidate>
                     {{ csrf_field() }}  
                      <span class="section">Exclusive Author</span>
                    
                    
                      <div style="height:30px;"></div>
                      
                      
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Minimum sells items of Exclusive Author</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="minimum_sells" type="text" name="minimum_sells" value="<?php echo $minimum_sells; ?>"  class="form-control col-md-7 col-xs-12" required="required"> item(s)
						  
                        </div>
                      </div>
                      
                      
                      <div style="height:30px;"></div>
                      
                      
                      <span class="section">Author Level</span>
						
                        
                        
                     <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Level 1 (has sold)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="author_level_one" type="text" name="author_level_one" value="<?php echo $author_level_one;?>"  class="form-control col-md-7 col-xs-12" required="required"> <?php echo $msettings[0]->site_currency;?> 
						  
                        </div>
                      </div>
                      
                      
                      
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Level 2 (has sold)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="author_level_two" type="text" name="author_level_two" value="<?php echo $author_level_two;?>"  class="form-control col-md-7 col-xs-12" required="required"> <?php echo $msettings[0]->site_currency;?> 
						  
                        </div>
                      </div>
                      
                      
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Level 3 (has sold)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="author_level_three" type="text" name="author_level_three" value="<?php echo $author_level_three;?>"  class="form-control col-md-7 col-xs-12" required="required"> <?php echo $msettings[0]->site_currency;?> 
						  
                        </div>
                      </div>
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Level 4 (has sold)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="author_level_four" type="text" name="author_level_four" value="<?php echo $author_level_four;?>"  class="form-control col-md-7 col-xs-12" required="required"> <?php echo $msettings[0]->site_currency;?> 
						  
                        </div>
                      </div>
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Level 5 (has sold)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="author_level_five" type="text" name="author_level_five" value="<?php echo $author_level_five;?>"  class="form-control col-md-7 col-xs-12" required="required"> <?php echo $msettings[0]->site_currency;?> 
						  
                        </div>
                      </div>
					  
					  
					  
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Level 6+ (has sold)</label> 
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input id="author_level_six" type="text" name="author_level_six" value="<?php echo $author_level_six;?>"  class="form-control col-md-3 col-xs-12" required="required"> <?php echo $msettings[0]->site_currency;?> 
                          </div>
                          
                           <div class="col-md-3 col-sm-3 col-xs-12">
                          <input type="text" name="last_level_name" value="<?php echo $trans_view;?>" class="form-control col-md-4 col-xs-12" readonly placeholder="eg: Power Author">
						  
                        </div>
                         <div class="col-md-3 col-sm-3 col-xs-12">
                        <a href="<?php echo $url;?>/admin/edittranslate/1152" class="btn btn-success">Translate</a>
                        </div>
                      </div>
                      
                      
                      
                      
                      
                      <div style="height:30px;"></div>
                      
                      
                      <span class="section">Collector Level</span>
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Level 1 (has collected)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="collector_level_one" type="text" name="collector_level_one" value="<?php echo $collector_level_one;?>"  class="form-control col-md-7 col-xs-12" required="required"> item(s) 
						  
                        </div>
                      </div>
                      
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Level 2 (has collected)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="collector_level_two" type="text" name="collector_level_two" value="<?php echo $collector_level_two;?>"  class="form-control col-md-7 col-xs-12" required="required"> item(s) 
						  
                        </div>
                      </div>
                      
                      
                      
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Level 3 (has collected)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="collector_level_three" type="text" name="collector_level_three" value="<?php echo $collector_level_three;?>"  class="form-control col-md-7 col-xs-12" required="required"> item(s) 
						  
                        </div>
                      </div>
                      
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Level 4 (has collected)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="collector_level_four" type="text" name="collector_level_four" value="<?php echo $collector_level_four;?>"  class="form-control col-md-7 col-xs-12" required="required"> item(s)
						  
                        </div>
                      </div>
                      
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Level 5 (has collected)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="collector_level_five" type="text" name="collector_level_five" value="<?php echo $collector_level_five;?>"  class="form-control col-md-7 col-xs-12" required="required"> item(s) 
						  
                        </div>
                      </div>
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Level 6 (has collected)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="collector_level_six" type="text" name="collector_level_six" value="<?php echo $collector_level_six;?>"  class="form-control col-md-7 col-xs-12" required="required"> item(s) 
						  
                        </div>
                      </div>
                      
                      
                      
                      
                      <div style="height:30px;"></div>
                      
                      
                      <span class="section">Referral Level</span>
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Level 1 (has referred)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="referred_level_one" type="text" name="referred_level_one" value="<?php echo $referred_level_one;?>"  class="form-control col-md-7 col-xs-12" required="required"> member(s) 
						  
                        </div>
                      </div>
                      
                      
                      
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Level 2 (has referred)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="referred_level_two" type="text" name="referred_level_two" value="<?php echo $referred_level_two;?>"  class="form-control col-md-7 col-xs-12" required="required"> member(s) 
						  
                        </div>
                      </div>
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Level 3 (has referred)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="referred_level_three" type="text" name="referred_level_three" value="<?php echo $referred_level_three;?>"  class="form-control col-md-7 col-xs-12" required="required"> member(s) 
						  
                        </div>
                      </div>
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Level 4 (has referred)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="referred_level_four" type="text" name="referred_level_four" value="<?php echo $referred_level_four;?>"  class="form-control col-md-7 col-xs-12" required="required"> member(s) 
						  
                        </div>
                      </div>
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Level 5 (has referred)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="referred_level_five" type="text" name="referred_level_five" value="<?php echo $referred_level_five;?>"  class="form-control col-md-7 col-xs-12" required="required"> member(s) 
						  
                        </div>
                      </div>
                      
                      
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Level 6 (has referred)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="referred_level_six" type="text" name="referred_level_six" value="<?php echo $referred_level_six;?>"  class="form-control col-md-7 col-xs-12" required="required"> member(s) 
						  
                        </div>
                      </div>
                      
                      
                     
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <a href="<?php echo $url;?>/admin/badges-settings" class="btn btn-primary">Cancel</a>
						  <?php if(config('global.demosite')=="yes"){?><a href="#" class="btn btn-success">Submit</a> 
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
