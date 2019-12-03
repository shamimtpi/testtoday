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

if($lang == "en")
						  {
						    $texter = "page_id"; 
						  }
						  else
						  {
						     $texter = "parent";
						  }

$donate_info = DB::table('pages')
		->where($texter, '=', 5)
		->where('lang_code', '=', $lang)
		->get();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    @include('style')
	<title><?php echo translate( 25, $lang);?> - <?php echo $donate_info[0]->page_title;?></title>
</head>
<body class="index">
    <!-- fixed navigation bar -->
    @include('header')
    <main class="main-wrapper-inner" id="container">

            	<div class="container">
         

<div class="donate_warraper">
  <div class="donate_container">
    <img src="<?php echo $url;?>/local/images/media/page/{{$donate_info[0]->photo}}" alt="profile image" class="profile-img">
    
    <div class="content">
      <div class="sub-content">
         <p>{!! $donate_info[0]->page_desc !!}</p>          
      </div>
      <div class="donaite-button">
          <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=VDPYG99CHXGMJ&source=url" target="_blank" class="btn btn-success btn-lg text-center">Donate Now</a>
      </div>
    </div>
  </div>
</div>


<style type="text/css">
	



body{
  background: #a4d9f9;
 
}

.donate_warraper{
  padding:50px 0px;
}

.donate_container{
  max-width: 600px;
  width:100%;
  height: 100%;
  background: #fff;
  border-radius: 10px;
  box-shadow: 0 2px 10px 0 rgba(0,0,0,0.16), 0 2px 10px 0 rgba(0,0,0,0.12);
  margin: 0 auto;
  position: relative;
}

.donate_container .profile-img{
  width: 100px;
  height: 100px;
  border-radius: 50%;
  position: absolute;
  top: -65px;
  left: 42%;
  border: 2px solid #a4d9f9;
}

.content{
  padding: 65px 20px 20px;
}
.donaite-button{
	text-align: center;
	padding-top:20px;
}
.donaite-button a{
	color:#fff !important;
	font-weight:bold;

}


</style>

                </div>

        </main>
	
      @include('footer')
       
</body>
</html>