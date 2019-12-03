@extends('layouts.app')

@section('content')

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
function translate_header($id,$lang) 
{					
	if($lang == "en")
	{
	$translate = DB::table('codepopular_translates')
		            
					->where('lang_code', '=', $lang)
					->where('id', '=', $id)
					->get();
					
		$translate_cnt = DB::table('codepopular_translates')
		            
					->where('lang_code', '=', $lang)
					->where('id', '=', $id)
					->count();			
	}
	else
	{
	$translate = DB::table('codepopular_translates')
		            
					->where('lang_code', '=', $lang)
					->where('parent', '=', $id)
					->get();
					
		$translate_cnt = DB::table('codepopular_translates')
		            
					->where('lang_code', '=', $lang)
					->where('parent', '=', $id)
					->count();			
	}				
	if(!empty($translate_cnt))
	{
					return $translate[0]->name;
	}
	else
	{
	  return "";
	}
}
?>
	
<div class="promo-area" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $setts[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="promo-text">
                        <h1 class="avigher-title bolder fontsize30"><?php echo translate_header( 535, $lang);?></h1>
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
                        <li class="breadcrumb-item"><a href="<?php echo $url;?>"><?php echo translate_header( 40, $lang);?></a>
                        </li>
                        <li class="breadcrumb-item active"><?php echo translate_header( 535, $lang);?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
 

<main class="checkout-area main-content">
        <div class="container">
        
        <div class="row justify-content-center">
	

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
    
    
    
    @if(Session::has('get_error'))

	    <div class="alert alert-danger">

	      <?php $value_email = Session::get('get_error');
		  
		  
		   ?>
           
          <?php echo translate_header( 916, $lang);?>  <a href="<?php echo $url;?>/resend/<?php echo base64_encode($value_email);?>" style="font-weight:bold; color:#0000FF; text-decoration:underline;"><?php echo translate_header( 919, $lang);?></a>

	    </div>

	@endif
    
    </div>
        
      <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="panel panel-default" style="padding:40px">
                <div class="panel-heading">
                <span class="loginleft">
                <?php echo translate_header( 535, $lang);?>
                </span>
                <span class="loginright">
               <a class="btn btn-link fleft" href="{{ route('forgot-password') }}"><?php echo translate_header( 505, $lang);?></a>
                </span>
                <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <form class="form-horizontal loginform" role="form" method="POST" action="{{ route('login') }}" id="checkout-form">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                   <div class="height20 clearfix"></div>
                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class=""><?php echo translate_header( 922, $lang);?></label>
                                <input id="username" type="text" class="form-control radiusoff" name="username" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password"><?php echo translate_header( 433, $lang);?></label>
                                <input id="password" type="password" class="form-control radiusoff" name="password" required>
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        
                        
                        

                        <div class="row" align="center">
                            <div class="col-md-12" align="center">
                              
                               
                                <input name="" type="submit" value="<?php echo translate_header( 391, $lang);?>" class="custom-btn fleft">
                              
                                <a class="btn btn-link fleft" href="{{ route('register') }}">
                                    <?php echo translate_header( 925, $lang);?>
                                </a>
                               
                                
                            </div>
                        </div>
                        
                        <div class="height20 clearfix"></div>
                        
                        <div class="row" align="center">
                        <div class="col-md-12" align="center">
                        <a href="{{ url('/login/facebook') }}">

                        <img src="<?php echo $url;?>/local/images/facebook_btn.png" border="0" alt="facebook login" class=""  />
                        </a>
                                
                              
                           <a href="{{ url('/login/google') }}" class="">
                        <img src="<?php echo $url;?>/local/images/google_btn.png" border="0" alt="google plus login" class="" />
                        </a>
                        
                        </div>
                        
                        </div>
                        
                       
                        
                    </form>
                    
                    
                </div>
            </div>
            
            </div>
            
            
        </div>
        
    </div>
</div>

</div>
</div>
<div class="clearfix"></div>
</main>

@include('footer')
@endsection
