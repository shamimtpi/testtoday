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

</head>
<body class="index">

    

    <!-- fixed navigation bar -->
    @include('header')

    <?php if(!empty($query_cnt)){?>
	<main class="main-wrapper-inner" id="container">
            	<div class="container">
                	<div class="wrapper-inner">
                    <div class="container paddingoff">
                    <div class="fleft">	
                       <?php if(!empty($query[0]->photo)){?>
                    	<figure class="details-image">
                        	<img src="<?php echo $url;?>/local/images/media/<?php echo $query[0]->photo;?>" alt="" class="img-responsive" style="max-height:400px;"/>
                        </figure>
                        <?php } ?>
                     </div>
                       <div class="fleft moveleft20 portdesc">
                         <div class="portline">
                        <div> <label>Client : </label> <?php if(!empty($query[0]->client)){?><?php echo $query[0]->client;?><?php } ?></div>
                        <div>  <label>Site Url : </label> <?php if(!empty($query[0]->site_url)){?><a href="<?php echo $query[0]->site_url;?>" target="_blank"><?php echo $query[0]->site_url;?></a><?php } ?></div>
                        
                        <div> <label>Date : </label> <?php if(!empty($query[0]->submit_date)){?><?php echo date("m-d-Y", strtotime($query[0]->submit_date));?><?php } ?></div>
                         </div>
                      
                       </div>
                       </div> 
                       
                       <div class="clearfix"></div>
                        <div class="about-content">
                            <section>
                            	<h3><?php echo $query[0]->title;?></h3>
                            	<div><?php echo $query[0]->content;?></div>
                            </section>
                            <!-- right -->
                        </div>

                      <div class="clearfix"></div>

                        <!-- content -->
                      <div class="col-md-6 paddingoff">
          <?php if(!empty($previous)){
		?>
         <div class="text-left"><a href="<?php echo $url;?>/portfolio/<?php echo $previous_link[0]->post_slug;?>" class="custombtn"><i class="fa fa-chevron-left" aria-hidden="true"></i> <?php echo '  '.$previous;?></a></div>
         <?php } ?>
         </div>
         <div class="col-md-6 paddingoff">
         <?php if(!empty($next)){
		 ?>
         <div class="text-right"><a href="<?php echo $url;?>/portfolio/<?php echo $next_link[0]->post_slug;?>" class="custombtn"><?php echo $next.'  ';?> <i class="fa fa-chevron-right" aria-hidden="true"></i></a></div>
          <?php } ?>
         </div>
                   <div class="clearfix height40"></div>     
                    
                    </div>

                </div>

            </main>
	
	
	<?php } ?>
	
      <div class="clearfix"></div>
	   <div class="clearfix"></div>

      @include('footer')
</body>
</html>