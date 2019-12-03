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
		
		
		
		
        <!-- /top navigation -->

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
                <?php $url = URL::to("/"); ?>    
                   <form class="form-horizontal form-label-left" role="form" method="POST" action="{{ route('admin.color-settings') }}" enctype="multipart/form-data" novalidate>
                     {{ csrf_field() }}  
                      <span class="section">Font & Color Settings</span>

                      
                      
					  
					  
					  
					  
						
						
					
                      
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Body(Main) Font</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="font1" type="text" name="body_font" value="<?php echo $msettings[0]->body_font; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
                      
                      <input type="hidden" name="save_body" value="<?php echo $msettings[0]->body_font; ?>">
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Font Size</label> 
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input type="number" name="font_size" class="form-control col-md-7 col-xs-12" value="<?php echo $msettings[0]->font_size; ?>">
						 
                        </div>
                         <span class="col-md-1 paddoffs">px</span>
                      </div>
                      
                      <input type="hidden" name="save_font" value="<?php echo $msettings[0]->font_size; ?>">
                      
                      
                      
                      <div class="item form-group">
                      <h4 style="color:#000; font-weight:600;">Heading Font</h4>
                      
                        <label for="amount" class="control-label col-md-3">Heading (&lt;h1&gt;)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="font2" type="text" name="heading1" value="<?php echo $msettings[0]->heading1; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                    
                      </div>
                      <input type="hidden" name="save_heading1" value="<?php echo $msettings[0]->heading1; ?>">
                      
                      
                      
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Font Size</label> 
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input type="number" name="head_font1" class="form-control col-md-7 col-xs-12" value="<?php echo $msettings[0]->head_font1; ?>">
						  
                        </div>
                         <span class="col-md-1 paddoffs">px</span>
                      </div>
                      
                       <input type="hidden" name="save_head_font1" value="<?php echo $msettings[0]->head_font1; ?>">
                      
                      
                      <div class="item form-group">
                      <label for="amount" class="control-label col-md-3">Heading (&lt;h2&gt;)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="font3" type="text" name="heading2" value="<?php echo $msettings[0]->heading2; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
                      
                      <input type="hidden" name="save_heading2" value="<?php echo $msettings[0]->heading2; ?>">
                      
                      
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Font Size</label> 
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input type="number" name="head_font2" class="form-control col-md-7 col-xs-12" value="<?php echo $msettings[0]->head_font2; ?>">
						  
                        </div>
                         <span class="col-md-1 paddoffs">px</span>
                      </div>
                      <input type="hidden" name="save_head_font2" value="<?php echo $msettings[0]->head_font2; ?>">
                      
                      
                      <div class="item form-group">
                      <label for="amount" class="control-label col-md-3">Heading (&lt;h3&gt;)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="font4" type="text" name="heading3" value="<?php echo $msettings[0]->heading3; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
                      <input type="hidden" name="save_heading3" value="<?php echo $msettings[0]->heading3; ?>">
                      
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Font Size</label> 
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input type="number" name="head_font3" class="form-control col-md-7 col-xs-12" value="<?php echo $msettings[0]->head_font3; ?>">
						  
                        </div>
                         <span class="col-md-1 paddoffs">px</span>
                      </div>
                      <input type="hidden" name="save_head_font3" value="<?php echo $msettings[0]->head_font3; ?>">
                      
                      
                      <div class="item form-group">
                      <label for="amount" class="control-label col-md-3">Heading (&lt;h4&gt;)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="font5" type="text" name="heading4" value="<?php echo $msettings[0]->heading4; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
                      <input type="hidden" name="save_heading4" value="<?php echo $msettings[0]->heading4; ?>">
                      
                      
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Font Size</label> 
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input type="number" name="head_font4" class="form-control col-md-7 col-xs-12" value="<?php echo $msettings[0]->head_font4; ?>">
						  
                        </div>
                         <span class="col-md-1 paddoffs">px</span>
                      </div>
                      <input type="hidden" name="save_head_font4" value="<?php echo $msettings[0]->head_font4; ?>">
                      
                      
                       <div class="item form-group">
                      <label for="amount" class="control-label col-md-3">Heading (&lt;h5&gt;)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="font6" type="text" name="heading5" value="<?php echo $msettings[0]->heading5; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
                      
                       <input type="hidden" name="save_heading5" value="<?php echo $msettings[0]->heading5; ?>">
                      
                      
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Font Size</label> 
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input type="number" name="head_font5" class="form-control col-md-7 col-xs-12" value="<?php echo $msettings[0]->head_font5; ?>">
						  
                        </div>
                         <span class="col-md-1 paddoffs">px</span>
                      </div>
                      <input type="hidden" name="save_head_font5" value="<?php echo $msettings[0]->head_font5; ?>">
                      
                      
                      <div class="item form-group">
                      <label for="amount" class="control-label col-md-3">Heading (&lt;h6&gt;)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="font7" type="text" name="heading6" value="<?php echo $msettings[0]->heading6; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                      </div>
                       <input type="hidden" name="save_heading6" value="<?php echo $msettings[0]->heading6; ?>">
                      
                      
                      
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Font Size</label> 
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input type="number" name="head_font6" class="form-control col-md-7 col-xs-12" value="<?php echo $msettings[0]->head_font6; ?>">
						 
                        </div>
                         <span class="col-md-1 paddoffs">px</span>
                      </div>
                      <input type="hidden" name="save_head_font6" value="<?php echo $msettings[0]->head_font6; ?>">
                      
                      
                      
                      <div class="item form-group">
                      <h4 style="color:#000; font-weight:600;">Paragraph Font</h4>
                      
                        <label for="amount" class="control-label col-md-3">Paragraph (&ltp&gt;)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="font8" type="text" name="paragraph" value="<?php echo $msettings[0]->paragraph; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                    
                      </div>
                      <input type="hidden" name="save_paragraph" value="<?php echo $msettings[0]->paragraph; ?>">
                      
                      
                      
                       <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Font Size</label> 
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input type="number" name="para_font_size" class="form-control col-md-7 col-xs-12" value="<?php echo $msettings[0]->para_font_size; ?>">
						  
                        </div>
                         <span class="col-md-1 paddoffs">px</span>
                      </div>
                      <input type="hidden" name="save_para_font" value="<?php echo $msettings[0]->para_font_size; ?>">
                      
                      
                       <div class="item form-group">
                      <h4 style="color:#000; font-weight:600;">Listing Font</h4>
                      
                        <label for="amount" class="control-label col-md-3">Listing font (&ltli&gt;)</label> 
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="font9" type="text" name="list_font" value="<?php echo $msettings[0]->list_font; ?>"  class="form-control col-md-7 col-xs-12">
						  
                        </div>
                    
                      </div>
                      <input type="hidden" name="save_list_font" value="<?php echo $msettings[0]->list_font; ?>">
                      
                      <div class="item form-group">
                        <label for="amount" class="control-label col-md-3">Font Size</label> 
                        <div class="col-md-2 col-sm-2 col-xs-12">
                          <input type="number" name="list_font_size" class="form-control col-md-7 col-xs-12" value="<?php echo $msettings[0]->list_font_size; ?>">
						  
                        </div>
                         <span class="col-md-1 paddoffs">px</span>
                      </div>
                      
                      <input type="hidden" name="save_list_size" value="<?php echo $msettings[0]->list_font_size; ?>">
                      
                      
                     
					  
                      <?php 
					  if($msettings[0]->theme_color!=""){ $themecolor = $msettings[0]->theme_color; } else { $themecolor = "#DBA860"; }
					  if($msettings[0]->button_color!=""){ $buttoncolor = $msettings[0]->button_color; } else { $buttoncolor = "#DBA860"; }
					  if($msettings[0]->link_color!=""){ $linkcolor = $msettings[0]->link_color; } else { $linkcolor = "#FFFFFF"; }
					  ?>
                       <div class="item form-group">
                       <h4 style="color:#000; font-weight:600;">Theme Color</h4>
                       
                        <label for="amount" class="control-label col-md-3">Theme Color</label> 
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <input type="text" id="color1" name="theme_color" class="form-control col-md-7 col-xs-12 colorwell" value="<?php echo $themecolor; ?>" /><br/><br/>
						  <div  id="picker"></div>
                        </div>
                        
                      </div>
                      <input type="hidden" name="save_theme" value="<?php echo $msettings[0]->theme_color; ?>">
                       
					 
					  <div class="item form-group">
                      
                       
                        <label for="amount" class="control-label col-md-3">Button Color</label> 
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <input type="text" id="color2" name="button_color" class="form-control col-md-7 col-xs-12 colorwellr" value="<?php echo $buttoncolor; ?>" /><br/><br/>
						  <div  id="pickerr"></div>
                        </div>
                        
                      </div>
						 <input type="hidden" name="save_button" value="<?php echo $msettings[0]->button_color; ?>">
						
						
						<div class="item form-group">
                      
                       
                        <label for="amount" class="control-label col-md-3">Link Color</label> 
                        <div class="col-md-6 col-sm-6 col-xs-6">
                          <input type="text" id="color3" name="link_color" class="form-control col-md-7 col-xs-12 colorwellre" value="<?php echo $linkcolor; ?>" /><br/><br/>
						  <div  id="pickerre"></div>
                        </div>
                        
                      </div>
					  <input type="hidden" name="save_link" value="<?php echo $msettings[0]->link_color; ?>">
					 
					  
					  
					  
                     
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <a href="<?php echo $url;?>/admin/color-settings" class="btn btn-primary">Cancel</a>
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

      @include('admin.footer')
      </div>
    </div>

    
	
  </body>
</html>
