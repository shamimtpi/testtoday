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
	<title><?php echo translate( 25, $lang);?> - S3 Image Upload</title>




</head>
<body class="index">

    

    <!-- fixed navigation bar -->
    @include('header')

    
    <div class="promo-area" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $setts[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="promo-text">
                        <h2 class="avigher-title bolder fontsize30">S3 Image Upload</h2>
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
                        
                        <li class="breadcrumb-item active">S3 Image Upload</li>
                        
                    </ol>
                </div>
            </div>
        </div>
    </div> 
    

	
    
	
	
	
	
	
	
	<main class="checkout-area main-content">
<div class="clearfix height20"></div>
        <div class="container">
  <div class="panel panel-primary">
    


    <div class="panel-body">


      @if (count($errors) > 0)
	 <div class="alert alert-danger">
	    <strong>Whoops!</strong> There were some problems with your input.<br><br>
		<ul>
		  @foreach ($errors->all() as $error)
		    <li>{{ $error }}</li>
		  @endforeach
		 </ul>
	    </div>
      @endif


	  @if ($message = Session::get('success'))
		<div class="alert alert-success alert-block">
			<button type="button" class="close" data-dismiss="alert">×</button>
		        <strong>{{ $message }}</strong>
		</div>
		<img src="{{ Session::get('path') }}">
	  @endif


	  <form action="{{ url('s3-image-upload') }}" enctype="multipart/form-data" method="POST">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-12">
				<input type="file" name="image" />
			</div>
			<div class="col-md-12">
				<button type="submit" class="btn btn-success">Upload</button>
			</div>
		</div>
	  </form>
    </div>


  </div>
</div>
<div class="clearfix"></div>
</main>
	
	
	
	
	
	
	

      @include('footer')
       
</body>
</html>