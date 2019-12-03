      <div class="col-md-12 paddingoff">
        <div class="h3 black blogsidebar"><?php echo translate( 241, $lang);?></div>
        <div class="clear height20"></div>
        <?php if(Auth::check()) { ?>
        <div>
        <form class="form-horizontal" role="form" method="POST" action="{{ route('blog') }}" id="formID" enctype="multipart/form-data">
                        {{ csrf_field() }}
	
	<div class="paddingoff">
    
	
          <div class="col-lg-12 col-md-12 col-sm-12 paddingoff">
            <label class="ash"><?php echo translate( 244, $lang);?><span class="star">*</span></label>
            <input type="text" value=""  class="form-control validate[required] text-input radiusoff" required="required" id="name" name="name" >
          </div>
         <div class="clearfix height10"></div>
          <div class="col-lg-12 col-md-12 col-sm-12 paddingoff">
            <label class="ash"><?php echo translate( 247, $lang);?><span class="star">*</span> </label>
            <input type="text" value="<?php echo Auth::user()->email;?>"  class="form-control validate[required,custom[email]] text-input radiusoff" id="email" name="email" readonly>
          </div>
		  
          <div class="clearfix height10"></div>
          <div class="col-lg-12 col-md-12 col-sm-12 paddingoff">
            <label class="ash"><?php echo translate( 250, $lang);?><span class="star">*</span> </label>
            <textarea value=""   class="form-control validate[required] text-input radiusoff height150" id="msg" name="msg" required="required"></textarea>
          </div>
          
          <input type="hidden" name="post_comment_type" value="blog">
          
           <input type="hidden" name="post_type" value="comment">
           
           <input type="hidden" name="post_user_id" value="<?php echo Auth::user()->id;?>">
           
           <?php if($lang == "en") { $newy = $post[0]->post_id; } else { $newy = $post[0]->parent; } ?>
          
          <input type="hidden" name="post_parent" value="<?php echo $newy;?>">
          
		  <div class="clearfix height20"></div>
          <div class="paddingoff">
            <input type="submit" class="custom-btn customwidth" value="<?php echo translate( 253, $lang);?>">
          </div>
		  <div class="clearfix height50"></div>
		 </div> 
        </form>
        </div>
        
		
		<?php
		if($lang == "en")
		{
		   $texter = $post[0]->post_id;
		}
		else
		{
		   $texter = $post[0]->parent;
		}
		
		$pcomment = DB::table('posts')
							 ->where('post_parent', '=', $texter)
							 ->where('post_comment_type', '=', 'blog')
							 ->where('post_type', '=', 'comment')
							 ->where('post_status', '=', '1')
							 ->orderBy('post_id', 'DESC')
							 ->get();
							 $pcnt = DB::table('posts')
							 ->where('post_parent', '=', $texter)
							 ->where('post_comment_type', '=', 'blog')
							 ->where('post_type', '=', 'comment')
							 ->where('post_status', '=', '1')
							 ->count();
						 
			if(!empty($pcnt)){				 ?>
        <div class="clearfix height20"></div>
         <div class="h3 black"><?php echo translate( 256, $lang);?></div>
         <div class="clearfix height30"></div>
         
         <?php 
		 
							 foreach($pcomment as $viwcomment){
							 $user = DB::table('users')
							         ->where('id', '=', $viwcomment->post_user_id)
									 ->get();
		?>				
        <div class="row">	 
         <div class="col-lg-2 col-md-2 col-sm-2">
         <?php 
					   $userphoto="/media/userphoto/";
						$path ='/local/images'.$userphoto.$user[0]->photo;
						if($user[0]->photo!=""){
						?>
						 <img src="<?php echo $url.$path;?>" class="thumb round" width="70" style="padding:0px !important;">
						 <?php } else { ?>
						  <img src="<?php echo $url.'/local/images/nophoto.jpg';?>" class="thumb round" width="70" style="padding:0px !important;">
						 <?php } ?>
         </div>
         <div class="col-lg-10 col-md-10 col-sm-10 paddingoff">
         <div class="h4 black"><?php echo $viwcomment->post_title;?></div>
         <div class="height5"></div>
         <div class="para"><?php echo $viwcomment->post_desc;?></div>
         <div class="height5"></div>
         <div class="fontsize12 gold italic"><?php echo date('d M Y h:i:s a',strtotime($viwcomment->post_date));?></div>
         </div>
       </div>
         <div class="clearfix borderbottom paddingtopbottom10"></div>
         <div class="height20"></div>
         <?php } } ?>
         
        
        <?php } else {?>
        <div class="para black"><?php echo translate( 259, $lang);?> <a href="<?php echo $url;?>/login" class="blacker bold"><?php echo translate( 262, $lang);?></a> <?php echo translate( 265, $lang);?></div>
        <div class="height100"></div>
        <?php } ?>
        </div>
          
