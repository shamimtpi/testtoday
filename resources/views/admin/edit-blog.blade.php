<!DOCTYPE html>
<html lang="en">
  <head>
   
   @include('admin.title')
    
    @include('admin.style')
	
     <?php $url = URL::to("/"); ?> 
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
         
		 
		 
		 
		 
		  <?php  if (in_array(11, $hidden)){?>
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
                    
                   <form class="form-horizontal form-label-left" role="form" method="POST" action="{{ route('admin.edit-blog') }}" enctype="multipart/form-data" novalidate>
                     {{ csrf_field() }}  
                      <span class="section">Edit Post</span>
                      
                      
                      
                      <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="">
                  
                  <div class="x_content">


                    <div class="" role="tabpanel" data-example-id="togglable-tabs">
                      <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                      <?php foreach($language as $languages){?>
                        <li role="presentation" class="<?php if($languages->id==2){?>active<?php } ?>"><a href="#tab_content<?php echo $languages->id;?>" id="home-tab" role="tab" data-toggle="tab" aria-expanded="true"><img src="<?php echo $url; ?>/local/images/media/language/<?php echo $languages->lang_flag;?>" style="max-width:24px; max-height:24px;"> <?php echo $languages->lang_name;?></a>
                        </li>
                       <?php } ?> 
                      </ul>
                      <div id="myTabContent" class="tab-content">
                      
                      
                      <?php 
					  foreach($language as $languagee){
					  
					  if($languagee->lang_code=="en")
					  {
					      
						  $count_en = DB::table('posts')
										->where('parent', '=', 0)
										->where('post_id', '=', $blog[0]->post_id)
										
										->count();
						  if(!empty($count_en))
						  {
						  $view = DB::table('posts')
										->where('parent', '=', 0)
										->where('post_id', '=', $blog[0]->post_id)
										
										->get();
						  $viewname = $view[0]->post_title;
						  $viewdesc = $view[0]->post_desc;
						  $viewtag = $view[0]->post_tags;
						  }	
						  else
						  {
						     $viewname = "";
							 $viewdesc = "";
							 $viewtag = "";
						  }			
								
										
					  }
					  else
					  {
					      $count_other = DB::table('posts')
										->where('parent', '=', $blog[0]->post_id)
										->where('lang_code', '=', $languagee->lang_code)
										
										->count();
					      if(!empty($count_other))
						  {
					      $view = DB::table('posts')
										->where('parent', '=', $blog[0]->post_id)
										->where('lang_code', '=', $languagee->lang_code)
										
										->get();
						  $viewname = $view[0]->post_title;
						  $viewdesc = $view[0]->post_desc;
						  $viewtag = $view[0]->post_tags;			
						  }
						  else
						  {
						     $viewname = "";
							 $viewdesc = "";
							 $viewtag = "";
						  }	
								
					  }
					  
					  ?>
                        <div role="tabpanel" class="tab-pane fade <?php if($languagee->id==2){?>active<?php } ?> in" id="tab_content<?php echo $languagee->id;?>" aria-labelledby="home-tab">
                          
                          
                      
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Post Title
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                 <input id="name" class="form-control col-md-7 col-xs-12"  name="post_title[]" value="<?php echo $viewname; ?>" type="text" required="required">
						   @if ($errors->has('post_title'))
                                    <span class="help-block" style="color:red;">
                                        <strong>That post title is already exists</strong>
                                    </span>
                                @endif
                  
                </div>
              </div>
                      
                      
                      
                       <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Description
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                 
                  
                  
                  <textarea id="id_cazary_full" placeholder="" class="form-control col-md-7 col-xs-12" name="post_desc[]" style="width:640px; height:300px;" required="required"><?php echo html_entity_decode($viewdesc); ?></textarea>
                  
                </div>
              </div>
             
					  
					  
				
                      
                      <input type="hidden" name="code[]" value="<?php echo $languagee->lang_code;?>">
                      
                      
                      
                     
                      
                        </div>
                        <?php } ?>
                        
                        
                        
                      </div>
                      
                      <input type="hidden" name="token" value="<?php echo uniqid();?>">
                     
                     
                      <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">URL Slug <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                          <input id="slug" class="form-control col-md-7 col-xs-12"  name="slug" value="<?php echo $blog[0]->post_slug;?>" type="text" required="required">
						  ( Ex : an appeal to charismatic friends ) - Blog Title
                        
					   </div>
                      </div>
                     
                      
                      
                      
                      
                 <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Media Type
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                  <select class="form-control col-md-7 col-xs-12"  name="media_type"  onChange="showDiv(this)" required="required">
						  <option value=""></option>
						  <?php 
						  $mediatype=array("image","mp3","video");
						  foreach($mediatype as $media){?>
						  <option value="<?php echo $media;?>" <?php if($blog[0]->post_media_type==$media){?> selected <?php } ?>><?php echo $media;?></option>
						  <?php } ?>
						  </select>
                </div>
              </div>
              
             
               <input type="hidden" name="post_type" value="blog">
                      
                                           
					  <input type="hidden" name="post_id" value="<?php echo $blog[0]->post_id; ?>">
                      
                      
                      
                      
					  
             
             <div class="item form-group" id="mediaurl" <?php if($blog[0]->post_media_type!="video"){?> style="display:none;" <?php } ?>>
                
                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Youtube or Vimeo Url
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="video_url" class="form-control col-md-7 col-xs-12"  name="video_url" value="<?php echo $blog[0]->post_video;?>" type="text" required="required">
						   <br/>( Example : https://www.youtube.com/watch?v=2MpUj-Aua48 OR https://vimeo.com/56282283 )
                </div>
              </div>
              
               <input type="hidden" name="save_video" value="<?php echo $blog[0]->post_video;?>">
              
					  
				 <div class="item form-group" id="mediamp3" <?php if($blog[0]->post_media_type!="mp3"){?> style="display:none;" <?php } ?>>
                                
                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Mp3 Upload
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="file" id="audio_file" name="audio_file" class="form-control col-md-7 col-xs-12" <?php if(empty($blog[0]->post_audio)){?>required="required"<?php } ?>>
						  <?php if($blog[0]->post_media_type=="mp3"){?>
                          <?php $url = URL::to("/"); 
					   $mp3path ='/local/images/media/blog/'.$blog[0]->post_audio;
					   
					   ?> <a href="<?php echo $url.$mp3path;?>" target="_blank" class="tagcolr"><?php echo $blog[0]->post_audio; ?></a>
                       <?php } ?>
                          
						  @if ($errors->has('audio_file'))
                                    <span class="help-block" style="color:red;">
                                        <strong><?php echo str_replace("mpga","mp3",$errors->first('audio_file'));?></strong>
                                    </span>
                                @endif
                </div>
              </div>	 
               <input type="hidden" name="save_audio" value="<?php echo $blog[0]->post_audio;?>">
              
               
               <div class="item form-group" id="mediaimg" <?php if($blog[0]->post_media_type!="image"){?> style="display:none;" <?php } ?>>
                                 
                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Image
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12"> 
                  <input type="file" id="photo" name="photo" class="form-control col-md-7 col-xs-12" l>
						  
						  @if ($errors->has('photo'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                  
                </div>
                
                <?php $url = URL::to("/"); ?>
					  <?php 
					  if($blog[0]->post_media_type=="image"){
						$path ='/local/images/media/blog/'.$blog[0]->post_image;
						if($blog[0]->post_image!=""){
						?>
					 <div class="item form-group" align="center">
                      <div class="col-md-6 col-sm-6 col-xs-12">
					  <img src="<?php echo $url.$path;?>" class="thumb" width="100">
					  </div>
					  </div>
                     
						<?php } else { ?>
					  <div class="item form-group" align="center">
                      <div class="col-md-6 col-sm-6 col-xs-12">
					  <img src="<?php echo $url.'/local/images/noimage.jpg';?>" class="thumb" width="100">
					  </div>
					 
                      </div>
						<?php } } ?>
              </div>
               
               
               
				
                 
                  <div class="item form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Tags
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                  <input id="tags" class="span8" value="<?php echo $blog[0]->post_tags;?>"  name="tags"  type="text" data-role="tagsinput" required="required">
                  <p>(Example : blog post,latest post,popular blog,trending,social media )</p>   
                </div>
              </div>	 
              <input type="hidden" name="save_tags" value="<?php echo $blog[0]->post_tags;?>">
					   
					  
					  <input type="hidden" name="currentphoto" value="<?php echo $blog[0]->post_image;?>">
					
               

                   
                      
                    </div>

                  </div>
                </div>
              </div>
                      
                      
                     
                      <div class="ln_solid"></div>
                      <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                          <a href="<?php echo $url;?>/admin/blog" class="btn btn-primary">Cancel</a>
                          <button id="send" type="submit" class="btn btn-success">Submit</button>
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
