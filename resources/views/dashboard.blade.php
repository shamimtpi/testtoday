<?php
use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();	
$url = URL::to("/");
$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
$default = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }			
?>
<!DOCTYPE html>
<html lang="en">
<head>

   

   @include('style')
	<title><?php echo translate( 25, $lang);?> - <?php echo translate( 424, $lang);?></title>




</head>
<body>


    <!-- fixed navigation bar -->
    @include('header')

    <!-- slider -->
    

     <div class="promo-area" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $setts[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="promo-text">
                        <h2 class="avigher-title bolder fontsize30"><?php echo translate( 424, $lang);?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

	
    
	
	<div class="about-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo $url;?>"><?php echo translate( 40, $lang);?></a>
                        </li>
                        <li class="breadcrumb-item active"><?php echo translate( 424, $lang);?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
	
	
	
	<main class="main-wrapper-inner blog-wrapper" id="container">
      <div class="container">
      	 <!-- alert -->
		<div class="profile-content">
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
		 </div>
		 <!--alert-->
    <div class="wrapper-inner">
	
    <div class="profile">
    <form class="form-horizontal" role="form" method="POST" action="{{ route('dashboard') }}" id="formID" enctype="multipart/form-data">
                        {{ csrf_field() }}
         <div class="row">
		<div class="col-md-6">
        
                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class=" control-label"><?php echo translate( 427, $lang);?></label>
                                <input id="name" type="text" class="form-control validate[required] text-input radiusoff" name="name" value="<?php echo $editprofile[0]->name;?>" readonly>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="control-label"><?php echo translate( 430, $lang);?></label>
                                <input id="email" type="text" class="form-control validate[required,custom[email]] text-input radiusoff" name="email" value="<?php echo $editprofile[0]->email;?>">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="control-label"><?php echo translate( 433, $lang);?></label>
                                <input id="password" type="password" class="form-control radiusoff"  name="password" value="">
                        </div>

                        
						
						<input type="hidden" name="savepassword" value="<?php echo $editprofile[0]->password;?>">
						
						 <input type="hidden" name="id" value="<?php echo $editprofile[0]->id; ?>">
						
						 <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                            <label for="phone" class="control-label"><?php echo translate( 415, $lang);?></label>
                                <input id="phone" type="text" class="form-control validate[required] text-input radiusoff" value="<?php echo $editprofile[0]->phone;?>" name="phone">
								@if ($errors->has('phone'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                @endif
                        </div>
						
						
						
						<div class="form-group">
                            <label for="gender" class="control-label"><?php echo translate( 436, $lang);?></label>

							<select name="gender" class="form-control validate[required] text-input radiusoff">
							  
							  <option value=""></option>
							   <option value="male" <?php if($editprofile[0]->gender=='male'){?> selected="selected" <?php } ?>>Male</option>
							   <option value="female" <?php if($editprofile[0]->gender=='female'){?> selected="selected" <?php } ?>>Female</option>
							</select>
                        </div>
						
						
						
						
						<div class="form-group">
                            <label for="phoneno" class="control-label"><?php echo translate( 439, $lang);?></label>
                                <input type="file" id="photo" name="photo" class="form-control radiusoff">
								@if ($errors->has('photo'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('photo') }}</strong>
                                    </span>
                                @endif
                                <div class="height5"></div>
                                <?php 
				$url = URL::to("/");
				$userphoto="/media/userphoto/";
						$path ='/local/images'.$userphoto.$editprofile[0]->photo;
						if($editprofile[0]->photo!=""){?>
					<img src="<?php echo $url.$path;?>" class="img-responsive itemauthor" alt="">
						<?php } else { ?>
						<img src="<?php echo $url.'/local/images/nophoto.jpg';?>" class="img-responsive itemauthor" alt="">
						<?php } ?>
                        </div>
						<?php if(Auth::user()->id!=1){?>
						<div class="form-group">
                            <label for="gender" class="control-label"><?php echo translate( 442, $lang);?></label>
							<select name="buyers_update_approval" class="form-control validate[required] text-input radiusoff">
							  
							  <option value=""></option>
							   <option value="yes" <?php if($buyers_update_approval!=""){ if($buyers_update_approval=='yes'){?> selected="selected" <?php } } ?>><?php echo translate( 100, $lang);?></option>
							   <option value="no" <?php if($buyers_update_approval!="") { if($buyers_update_approval=='no'){?> selected="selected" <?php } } ?>><?php echo translate( 103, $lang);?></option>
							</select>
                               
                        </div>
                        <?php } ?>
                        
						<input type="hidden" name="currentphoto" value="<?php echo $editprofile[0]->photo;?>">
						
						
						<input type="hidden" name="usertype" value="<?php echo $editprofile[0]->admin;?>">
                        
                        <input type="hidden" name="save_gender" value="<?php echo $editprofile[0]->gender;?>">
						

                        
        
		</div>
		<div class="col-md-6">
        
           <div class="form-group">
                            <label for="phoneno" class="control-label"><?php echo translate( 445, $lang);?></label>
                                <input type="file" id="profile_banner" name="profile_banner" class="form-control radiusoff">
								@if ($errors->has('profile_banner'))
                                    <span class="help-block" style="color:red;">
                                        <strong>{{ $errors->first('profile_banner') }}</strong>
                                    </span>
                                @endif
                                <div class="height5"></div>
                                <?php 
				$url = URL::to("/");
				$userphoto="/media/userphoto/";
						$path ='/local/images'.$userphoto.$editprofile[0]->profile_banner;
						if($editprofile[0]->profile_banner!=""){?>
					<img src="<?php echo $url.$path;?>" class="img-responsive newbann" alt="">
						<?php } else { ?>
						<img src="<?php echo $url.'/local/images/noimage.jpg';?>" class="img-responsive newbann" alt="">
						<?php } ?>
                        </div>
                        
                        <input type="hidden" name="currentbanner" value="<?php echo $editprofile[0]->profile_banner;?>">
                        
                        
                 <div class="form-group">
                            <label for="name" class="control-label"><?php echo translate( 355, $lang);?></label>
                            <select name="country" class="validate[required]">
							  <option value=""><?php echo translate( 358, $lang);?></option>
							  <?php 
							  if(!empty($countries_count)){
							  $countries = DB::table('countries')
												->orderBy('country_name', 'asc')
												->get();
							  foreach($countries as $country){?>
                              <option value="<?php echo $country->country_id;?>" <?php if($editprofile[0]->country==$country->country_id){?> selected <?php } ?>><?php echo $country->country_name;?></option>
                              <?php } } ?>
							</select>
                     </div>       
                        
                        
                     <div class="form-group">
                            <label for="name" class="control-label"><?php echo translate( 343, $lang);?></label>
                                <input id="address" type="text" class="form-control validate[required] text-input radiusoff" name="address" value="<?php echo $editprofile[0]->address;?>">
                        </div>  
                        
                        
                      <div class="form-group">
                            <label for="name" class="control-label"><?php echo translate( 448, $lang);?></label>

                                <textarea class="form-control validate[required] text-input radiusoff" name="about"><?php echo $editprofile[0]->about;?></textarea>

                        </div>   
			   <?php if(Auth::user()->id!=1){?>
               
               
               <div class="form-group">
                   <label for="gender" class="control-label"><?php echo translate( 1131, $lang);?></label>

				<select name="profile_badges_status" class="form-control validate[required] text-input radiusoff">
				  
				  <option value=""></option>
				   <option value="on" <?php if($profile_badges!=""){ if($profile_badges=='on'){?> selected="selected" <?php } } ?>><?php echo translate( 454, $lang);?></option>
				   <option value="off" <?php if($profile_badges!="") { if($profile_badges=='off'){?> selected="selected" <?php } } ?>><?php echo translate( 457, $lang);?></option>
				</select>
                   
            </div>
               
               
               <div class="form-group">
                            <label for="gender" class="control-label"><?php echo translate( 451, $lang);?></label>

                           
							<select name="profile_details_status" class="form-control validate[required] text-input radiusoff">
							  
							  <option value=""></option>
							   <option value="on" <?php if($profile_status!=""){ if($profile_status=='on'){?> selected="selected" <?php } } ?>><?php echo translate( 454, $lang);?></option>
							   <option value="off" <?php if($profile_status!="") { if($profile_status=='off'){?> selected="selected" <?php } } ?>><?php echo translate( 457, $lang);?></option>
							</select>
                        </div>
                        
                        <div class="form-group">
                            <label for="name" class="control-label"><?php echo translate( 460, $lang);?></label>
                                <input id="referral_url" type="text" readonly class="form-control validate[required] text-input radiusoff" name="referral_url" value="<?php echo $url.'/?ref='.Auth::user()->id; ?>" onClick="this.focus();this.select()">
                        </div>
               <?php } ?>
			  
				<div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
					<?php if(config('global.demosite') == "yes"){?>
					<button type="button" class="btn btn-primary btn disable"><?php echo translate( 463, $lang);?></button> <span class="disabletxt">( <?php echo config('global.demotxt');?> )</span><?php } else { ?>
					
                        <button type="submit" class="custom-btn custombtn_width">
                            <?php echo translate( 463, $lang);?>
                        </button>
					<?php } ?>
                    </div>
                </div>
			    
		</div>
		</div>
        </form>
	</div>


	 
	 <div class="height30"></div>
	 <div class="row">
	
	</div>
	
	</div>
	</div>
	<div class="clearfix height50"></div>
	</main>
    

      @include('footer')
      
     
</body>
</html>