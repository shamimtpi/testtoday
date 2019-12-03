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
   <title><?php echo translate( 25, $lang);?></title>
	<style type="text/css">
	body
	{
	background:#000000;
	}
    </style>
    
    <script type="text/javascript">
      
      var calcHeight = function() {
        var headerDimensions = $('.preview_header').height();
        $('.full-screen-preview_frame').height($(window).height() - headerDimensions);
      }

      $(document).ready(function() {
        calcHeight();
      });

      $(window).resize(function() {
        calcHeight();
      }).load(function() {
        calcHeight();
      });
    </script>


</head>
 <body class="full-screen-preview">
    
<div class="preview__header" data-view="ctaHeader">

  <div class="preview__avigher-logo">
    <a href="<?php echo base64_decode($prod_slug);?>"><?php echo $setts[0]->site_name;?></a>
  </div>

  <div class="preview__actions">
  <div class="preview__action--buy">
    <a class="e-btn--3d -color-primary" href="<?php echo base64_decode($prod_slug);?>"><?php echo translate( 622, $lang);?></a>
  </div>

  <div class="preview__action--close">
    <a href="<?php echo str_replace("-","/",$slug);?>">
      <i class="e-icon -icon-cancel"></i><span><?php echo translate( 808, $lang);?></span>
</a>  </div>
</div>
</div>

<iframe class="full-screen-preview__frame" src="<?php echo str_replace("-","/",$slug);?>" name="preview-frame" frameborder="0" noresize="noresize" data-view="fullScreenPreview">
</iframe>

    

    
       
</body>
</html>