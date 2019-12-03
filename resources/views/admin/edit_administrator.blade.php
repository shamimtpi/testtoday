<!DOCTYPE html>
<html lang="en">
  <head>
   
   @include('admin.title')
    
    @include('admin.style')
	
    <?php
$logid = Auth::user()->id;

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
         <?php if($logid == 1){?>
        <!-- page content -->
        
        <div class="right_col" role="main">
          <!-- top tiles -->
         
		 
		 
		 
		 
		 
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
                    
                   <form class="form-horizontal form-label-left" role="form" method="POST" action="{{ route('admin.edituser') }}" enctype="multipart/form-data" novalidate>
                     {{ csrf_field() }}  
                      <span class="section">Edit Administrator</span>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Username <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12"  name="name" value="<?php echo $users[0]->name; ?>" required="required" type="text">
                         @if ($errors->has('name'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
					   </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" required="required" value="<?php echo $users[0]->email; ?>" class="form-control col-md-7 col-xs-12">
						  @if ($errors->has('email'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
					  
					  
					  
					  
					  
                      
                     
				 
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-3">Password <span class="required">*</span></label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="password" type="text" name="password" value=""  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
					  
                      
                      
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="telephone">Phone <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="tel" id="phone" name="phone" required="required" data-validate-length-range="8,20" class="form-control col-md-7 col-xs-12" value="<?php echo $users[0]->phone; ?>">
                        </div>
                      </div>
                      

					  
					  
					  <input type="hidden" name="savepassword" value="<?php echo $users[0]->password;?>">
					  
					  
                      
                     
					  <input type="hidden" name="id" value="<?php echo $users[0]->id; ?>">
					  
					  
					  
					   <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photo">Photo <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="photo" name="photo" class="form-control col-md-7 col-xs-12">
						  @if ($errors->has('photo'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
					   <?php $url = URL::to("/"); ?>
					  <?php 
					   $userphoto="/media/userphoto/";
						$path ='/local/images'.$userphoto.$users[0]->photo;
						if($users[0]->photo!=""){
						?>

					  <div class="item form-group" align="center">
					  <div class="col-md-6 col-sm-6 col-xs-12">
					  <img src="<?php echo $url.$path;?>" class="thumb" width="100">
					  </div>
					  </div>
						<?php } else { ?>
					  <div class="item form-group" align="center">
					  <div class="col-md-6 col-sm-6 col-xs-12">
					  <img src="<?php echo $url.'/local/images/nophoto.jpg';?>" class="thumb" width="100">
					  </div>
					  </div>
						<?php } ?>
					  
					  <input type="hidden" name="currentphoto" value="<?php echo $users[0]->photo;?>">
					  
					  
					  <?php if(Auth::user()->id==1){?>
					  <?php if($users[0]->id!=1){?>
					  <?php
					  $arrays =  explode(',', $users[0]->show_menu);
					  ?>
					  
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photo">Capabilities<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top:5px;"> 
					  
					  <input type="checkbox" id="select_all"/> Selecct All<br/>
    
	<?php foreach($menu_option as $key => $value){?>
	<input class="checkboxy" type="checkbox" name="menu_option[]" value="<?php echo $value;?>" <?php  if(in_array($value,$arrays)){?> checked <?php } ?>> <?php echo $key;?><br/>
	<?php } ?>		 
			</div>	
</div>			
					  <?php } ?>
                      <?php } ?>

					  
					 <?php if($users[0]->id==1){?>
					 <input type="hidden" name="menu_option" value="">
					 <?php } ?>
					  
					  <input type="hidden" name="usertype" value="1">
                     
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          
						  <?php if(Auth::user()->id==1){?>
						  <a href="<?php echo $url;?>/admin/administrators" class="btn btn-primary">Cancel</a>
						  <?php } ?>
						  
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
			  
		
		
		
		
		
		
		
		
		
		
		
		
		
		
        <!-- /page content -->

     
      </div>
	  
		 <?php } ?>
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 <?php if($logid == $users[0]->id && $logid!=1){?>
		 
		 <div class="right_col" role="main">
          <!-- top tiles -->
         
		 
		 
		 
		 
		 
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
                    
                   <form class="form-horizontal form-label-left" role="form" method="POST" action="{{ route('admin.edituser') }}" enctype="multipart/form-data" novalidate>
                     {{ csrf_field() }}  
                      <span class="section">Edit Administrator</span>

                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Username <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="name" class="form-control col-md-7 col-xs-12"  name="name" value="<?php echo $users[0]->name; ?>" required="required" type="text">
                         @if ($errors->has('name'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
					   </div>
                      </div>
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="email" id="email" name="email" required="required" value="<?php echo $users[0]->email; ?>" class="form-control col-md-7 col-xs-12">
						  @if ($errors->has('email'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
					  
					  
					  
					  
					  
                      
                     
				 
                      <div class="item form-group">
                        <label for="password" class="control-label col-md-3">Password <span class="required">*</span></label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="password" type="text" name="password" value=""  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
					  

					  
					  
					  <input type="hidden" name="savepassword" value="<?php echo $users[0]->password;?>">
					  
					  
                      
                     
					  <input type="hidden" name="id" value="<?php echo $users[0]->id; ?>">
					  
					  
					  
					   <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photo">Photo <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="file" id="photo" name="photo" class="form-control col-md-7 col-xs-12">
						  @if ($errors->has('photo'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                        </div>
                      </div>
					   <?php $url = URL::to("/"); ?>
					  <?php 
					   $userphoto="/userphoto/";
						$path ='/local/images'.$userphoto.$users[0]->photo;
						if($users[0]->photo!=""){
						?>
					  <div class="item form-group" align="center">
					  <div class="col-md-6 col-sm-6 col-xs-12">
					  <img src="<?php echo $url.$path;?>" class="thumb" width="100">
					  </div>
					  </div>
						<?php } else { ?>
					  <div class="item form-group" align="center">
					  <div class="col-md-6 col-sm-6 col-xs-12">
					  <img src="<?php echo $url.'/local/images/nophoto.jpg';?>" class="thumb" width="100">
					  </div>
					  </div>
						<?php } ?>
					  
					  <input type="hidden" name="currentphoto" value="<?php echo $users[0]->photo;?>">
					  
					  
					  <?php if(Auth::user()->id==1){?>
					  <?php if($users[0]->id!=1){?>
					  <?php
					  $arrays =  explode(',', $users[0]->show_menu);
					  ?>
					  
					  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="photo">Menu Option<span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12" style="margin-top:5px;"> 
					  
					  <input type="checkbox" id="select_all"/> Selecct All<br/>
    
	<?php foreach($menu_option as $key => $value){?>
	<input class="checkboxy" type="checkbox" name="menu_option[]" value="<?php echo $value;?>" <?php  if(in_array($value,$arrays)){?> checked <?php } ?>> <?php echo $key;?><br/>
	<?php } ?>		 
			</div>	
</div>			
					  <?php } ?>
                      <?php } ?>

					  
					 <?php if($users[0]->id==1){?>
					 <input type="hidden" name="menu_option" value="">
					 <?php } ?>
					  
					  
                     
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          
						  <?php if(Auth::user()->id==1){?>
						  <a href="<?php echo $url;?>/admin/administrators" class="btn btn-primary">Cancel</a>
						  <?php } ?>
						  
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
			  
		
		
		
		
		
		
		
		
		
		
		
		
		
		
        <!-- /page content -->

     
      </div>
		 
		 <?php } ?>	 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
	  
    </div>


	  
	  
	 
	 @include('admin.footer')
    
	
  </body>
</html>
