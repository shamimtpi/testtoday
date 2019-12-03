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
         
		 
		 
		 
		 
		 <?php  if (in_array(7, $hidden)){?>
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
    
    <div class="x_title">
                    
                    
                    <div class="clearfix"></div>
					
                  </div>
          
              
              <?php $url = URL::to("/"); ?>   
                   <form class="form-horizontal form-label-left" role="form" method="POST" action="{{ route('admin.add_framework_subcategory') }}" enctype="multipart/form-data" novalidate>
                     {{ csrf_field() }} 
                     
                     
                     <span class="section">Add Software Framework Sub Category</span> 
                     
                    <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  
                  <div class="x_content">


                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                      <?php foreach($language as $languages){?>
                        <li role="presentation" class="<?php if($languages->id==2){?>active<?php } ?>"><a href="#tab_content<?php echo $languages->id;?>" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><img src="<?php echo $url; ?>/local/images/media/language/<?php echo $languages->lang_flag;?>" style="max-width:24px; max-height:24px;"> <?php echo $languages->lang_name;?></a>
                        </li>
                       <?php } ?> 
                      </ul>
                      <div id="myTabContent" class="tab-content">
                      
                      
                      <?php foreach($language as $languagee){?>
                        <div role="tabpanel" class="tab-pane fade <?php if($languagee->id==2){?>active<?php } ?> in" id="tab_content<?php echo $languagee->id;?>" aria-labelledby="home-tab">
                          
                       
                    
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Name  <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">            
                                         
                  <input id="name" name="name[]" value="" type="text" class="form-control col-md-7 col-xs-12" required="required">
                        @if ($errors->has('name'))
                                    <span class="help-block" style="color:red;">
                                        <strong>That sub category is already exists</strong>
                                    </span>
                                @endif
                </div>
              </div>
              
              
              
                      
                      
                     
                      
                      
                      <input type="hidden" name="code[]" value="<?php echo $languagee->lang_code;?>">
                       
                      
                        </div>
                        <?php } ?>
                        
                        
                        
                      </div>
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Select Category <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">              
                   <select  name="cat_id" class="form-control col-md-7 col-xs-12" required="required">
						  <option value=""></option>
						  <?php foreach($category as $service){?>
						  <option value="<?php echo $service->id;?>"><?php echo $service->cat_name;?></option>
						  <?php } ?>
						  </select>                       
                  
                </div>
              </div>
                       
                     <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="desc">Slug
                        </label>
                        
                  <div class="col-md-6 col-sm-6 col-xs-12">   
                                
                   <input id="slug" name="slug"  value="" type="text" class="form-control col-md-7 col-xs-12" required="required">
					</div>	                
                  
                </div> 
                   
                      
                      <input type="hidden" name="token" value="<?php echo uniqid();?>"> 
                    </div>

                  </div>
                </div>
              </div>
                    
                    
               
              
              
              <input type="hidden" name="photo" value=""> 
              
              
              
              
              
					
              <?php $url = URL::to("/"); ?>
              <div class="form-actions">
                         <div class="col-md-6 col-md-offset-3">
                         
                          <a href="<?php echo $url;?>/admin/framework_subcategory" class="btn btn-primary">Cancel</a>
                        
                       
						  <?php if(config('global.demosite')=="yes"){?><a href="#" class="btn btn-success btndisable">Submit</a> 
								<span class="disabletxt">( <?php echo config('global.demotxt');?> )</span><?php } else { ?>
						  
                           
                          
                            <button id="send" type="submit" class="btn btn-success">Submit</button>
								<?php } ?>
                        </div>
              
            </form>
          </div>
        </div>
      </div>
    </div>
     <?php }  ?>
  </div>
</div>



</div>



    
	@include('admin.footer')
  </body>
</html>
