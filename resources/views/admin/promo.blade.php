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
         
		 
		 
		 
		 
         <?php  if (in_array(10, $hidden)){?>
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
                   <form class="form-horizontal form-label-left" role="form" method="POST" action="{{ route('admin.promo') }}" enctype="multipart/form-data" novalidate>
                     {{ csrf_field() }}  
                      <span class="section">Box 1</span>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Icon <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="inputid1" class="form-control col-md-7 col-xs-12"  name="promo_icon_1" value="<?php echo $edit_setting[0]->promo_icon_1;?>" readonly required="required" autocomplete="off" type="text">
                           
                        
					   </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Heading <span class="required">*</span>
                        </label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <input id="promo_title_1" class="form-control col-md-7 col-xs-12"  name="promo_title_1" value="<?php echo $translate_1[0]->name;?>" required="required" autocomplete="off" type="text" readonly>
                           
                        
					   </div>
                       <div class="col-md-2 col-sm-2 col-xs-12">
                       <a href="<?php echo $url;?>/admin/edittranslate/<?php echo $translate_1[0]->id;?>" class="btn btn-success">Translate</a>
                       </div>
                       
                      </div>
                      
                      
                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc"> Short Description <span class="required">*</span>
                        </label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          
                        <textarea id="promo_desc_1" class="form-control col-md-7 col-xs-12" name="promo_desc_1" style="min-height:100px;" readonly><?php echo $translate_2[0]->name;?></textarea>
					   </div>
                       <div class="col-md-2 col-sm-2 col-xs-12">
                       <a href="<?php echo $url;?>/admin/edittranslate/<?php echo $translate_2[0]->id;?>" class="btn btn-success">Translate</a>
                       </div>
                      </div>
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      
                      <span class="section">Box 2</span>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Icon <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="inputid2" class="form-control col-md-7 col-xs-12"  name="promo_icon_2" value="<?php echo $edit_setting[0]->promo_icon_2;?>" readonly required="required" autocomplete="off" type="text">
                           
                        
					   </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Heading <span class="required">*</span>
                        </label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <input id="promo_title_2" class="form-control col-md-7 col-xs-12"  name="promo_title_2" value="<?php echo $translate_3[0]->name;?>" required="required" autocomplete="off" type="text" readonly>
                           
                        
					   </div>
                       <div class="col-md-2 col-sm-2 col-xs-12">
                       <a href="<?php echo $url;?>/admin/edittranslate/<?php echo $translate_3[0]->id;?>" class="btn btn-success">Translate</a>
                       </div>
                      </div>
                      
                      
                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc"> Short Description <span class="required">*</span>
                        </label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          
                        <textarea id="promo_desc_2" class="form-control col-md-7 col-xs-12" name="promo_desc_2" style="min-height:100px;" readonly><?php echo $translate_4[0]->name;?></textarea>
					   </div>
                       <div class="col-md-2 col-sm-2 col-xs-12">
                       <a href="<?php echo $url;?>/admin/edittranslate/<?php echo $translate_4[0]->id;?>" class="btn btn-success">Translate</a>
                       </div>
                      </div>
                      
                      
                      
                      
                      
                      
                      <span class="section">Box 3</span>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Icon <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="inputid3" class="form-control col-md-7 col-xs-12"  name="promo_icon_3" value="<?php echo $edit_setting[0]->promo_icon_3;?>" readonly required="required" autocomplete="off" type="text">
                           
                        
					   </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Heading <span class="required">*</span>
                        </label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <input id="promo_title_3" class="form-control col-md-7 col-xs-12"  name="promo_title_3" value="<?php echo $translate_5[0]->name;?>" required="required" autocomplete="off" type="text" readonly>
                           
                        
					   </div>
                       <div class="col-md-2 col-sm-2 col-xs-12">
                       <a href="<?php echo $url;?>/admin/edittranslate/<?php echo $translate_5[0]->id;?>" class="btn btn-success">Translate</a>
                       </div>
                      </div>
                      
                      
                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc"> Short Description <span class="required">*</span>
                        </label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          
                        <textarea id="promo_desc_3" class="form-control col-md-7 col-xs-12" name="promo_desc_3" style="min-height:100px;" readonly><?php echo $translate_6[0]->name;?></textarea>
					   </div>
                       <div class="col-md-2 col-sm-2 col-xs-12">
                       <a href="<?php echo $url;?>/admin/edittranslate/<?php echo $translate_6[0]->id;?>" class="btn btn-success">Translate</a>
                       </div>
                      </div>
                      
                      
                      
                      
                      <span class="section">Box 4</span>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Icon <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="inputid4" class="form-control col-md-7 col-xs-12"  name="promo_icon_4" value="<?php echo $edit_setting[0]->promo_icon_4;?>" readonly required="required" autocomplete="off" type="text">
                           
                        
					   </div>
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Heading <span class="required">*</span>
                        </label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          <input id="promo_title_4" class="form-control col-md-7 col-xs-12"  name="promo_title_4" value="<?php echo $translate_7[0]->name;?>" required="required" autocomplete="off" type="text" readonly>
                           
                        
					   </div>
                       <div class="col-md-2 col-sm-2 col-xs-12">
                       <a href="<?php echo $url;?>/admin/edittranslate/<?php echo $translate_7[0]->id;?>" class="btn btn-success">Translate</a>
                       </div>
                      </div>
                      
                      
                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc"> Short Description <span class="required">*</span>
                        </label>
                        <div class="col-md-5 col-sm-5 col-xs-12">
                          
                        <textarea id="promo_desc_4" class="form-control col-md-7 col-xs-12" name="promo_desc_4" style="min-height:100px;" readonly><?php echo $translate_8[0]->name;?></textarea>
					   </div>
                       <div class="col-md-2 col-sm-2 col-xs-12">
                       <a href="<?php echo $url;?>/admin/edittranslate/<?php echo $translate_8[0]->id;?>" class="btn btn-success">Translate</a>
                       </div>
                      </div>
                      
                      
                      
                      
					  
					  
                     
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <?php if(config('global.demosite')=="yes"){?><a href="#" class="btn btn-success">Submit</a> <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span><?php } else { ?>
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
