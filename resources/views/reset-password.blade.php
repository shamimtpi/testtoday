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
	<title><?php echo translate( 25, $lang);?> - <?php echo translate( 811, $lang);?></title>




</head>
<body class="index">

    

    <!-- fixed navigation bar -->
    @include('header')

    
     
    <div class="promo-area" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $setts[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="promo-text">
                        <h2 class="avigher-title bolder fontsize30"><?php echo translate( 811, $lang);?></h2>
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
                        <li class="breadcrumb-item active"><?php echo translate( 811, $lang);?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
	
	
	
	
	
	
	
	<main class="main-wrapper-inner" id="container">

   <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="panel panel-default">
                <div class="panel-body">
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
            </div>
        </div>
    </div>



    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="panel panel-default" style="padding:40px">
             <div class="panel-heading text-center"><?php echo translate( 811, $lang);?></div>
                    <div class="clearfix height20"></div>
                    <div class="panel-body">
                         <form class="form-horizontal" role="form" method="POST" action="{{ route('reset-password') }}" id="formID">
                                {{ csrf_field() }}

                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label para black"><?php echo translate( 430, $lang);?></label>
                                        <input id="email" type="text" class="form-control validate[required,custom[email]] text-input radiusoff" name="email" value="{{ old('email') }}">

                                        @if ($errors->has('email'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                
                                
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label para black"><?php echo translate( 814, $lang);?></label>
                                        <input id="password" type="text" class="form-control validate[required] text-input radiusoff" name="password" value="{{ old('password') }}">

                                        @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                </div>
                                
                                
                                <input type="hidden" name="password_token" value="<?php echo $id;?>">
                                

                                <div class="form-group">
                                    <div class="col-md-6 col-md-offset-4">
                                        <button type="submit" class="custom-btn">
                                            <?php echo translate( 811, $lang);?>
                                        </button>
                                    </div>
                                </div>
                            </form>
                     </div>
                </div>
            </div>
        </div>





     </div>
    <div class="clearfix height50"></div>
    </main>
	

      @include('footer')
      
</body>
</html>