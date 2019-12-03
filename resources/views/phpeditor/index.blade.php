<?php
  use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();  
$url = URL::to("/");
$setid=1;
    $setts = DB::table('settings')
    ->where('id', '=', $setid)
    ->get();
    $headertype = $setts[0]->header_type;
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
<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
   @include('style')
   
   <title>Online PHP Editor</title>
    <!-- Open graph meta tag -->
    <meta property="og:title" content="Online PHP Editor - CodePopular">
    <meta property="og:site_name" content="CodePopular">
    <meta property="og:url" content="https://www.codepopular.com">
    <meta property="og:description" content="PHP Online code editor helps you to write and test run your php code online from your browser anywhere, anytime. its a userful online php tester">
    <meta property="og:type" content="website">
    <meta property="og:locale" content="en_US" />
    <meta property="og:image" content="https://www.codepopular.com/local/resources/views/phpeditor/online-php-editor.png"/>
    <!-- Open graph meta tag end -->



</head>
 
<body>
 @include('header')



<div class="editor_warraper">
<div class="editor_left_area">
 
 <script type="text/javascript">
var bannersnack_embed = {"hash":"bdk30n33x","width":180,"height":600,"t":1573901332,"userId":40016719,"type":"html5"};
</script>
<script type="text/javascript" src="//cdn.bannersnack.com/iframe/embed.js"></script>
 
</div>
<div class="code php_editor_area">
    
<iframe src="https://softdevltd.com/phpeditor" width="100%" height="100%"></iframe>

</div>

<div class="editor_right_area">
 {{--  <span>Ads Space Here</span> --}}
</div>
</div>





<style>


.ace_editor {
	font-size: 14px !important;
}

.editor_warraper{
  display:flex;
}
.editor_left_area{
    color: #fff;
    width: 20%;
    text-align:center;
    height:100vh;
    display:flex;
    align-items:center;
    justify-content:center;
}

.editor_right_area{
  color: #fff;
  width: 20%;
  display:flex;
  align-items:center;
  justify-content:center;
 
}
.php_editor_area{
  width:100%;
  margin: 20px 20px;
  background:#fff;
  border-top:20px solid #1ea3c1;
  border-left:7px solid #1ea3c1;
  border-right:7px solid #1ea3c1;
  border-bottom:7px solid #1ea3c1;

}

.footer-top{
  display: none;
}

body{
    background-color: #a4d9f9;
    background-image: url({{asset('local/resources/views/phpeditor/editorbg.jpg')}});
    background-position: top left;
    background-repeat: repeat;
    background-attachment: fixed;
}


</style>

<p style="display:inline;text-align: center"><?php echo 'Current PHP version: ' . phpversion();?></p>

@include('footer')
</body>
</html>

