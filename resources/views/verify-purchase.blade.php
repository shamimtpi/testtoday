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
	<title><?php echo translate( 25, $lang);?> - <?php echo translate( 1248, $lang);?></title>




</head>
<body class="index">

    

    <!-- fixed navigation bar -->
    @include('header')

    
   
    
    <?php if($site_verify_purchase=="on"){?>
    
     <section class="home_banner" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $setts[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="avigher-wrap searchhome">
                        <h2 class="avigher-title bolder fontsize30"><?php echo translate( 1248, $lang);?></h2>
                        <form action="{{ route('verify-purchase') }}" method="post" id="formID">
                        {{ csrf_field() }}
                        <div class="col-md-12">
                        
                        <div class="col-md-2"></div>
                       <div class="col-md-8">
                        
                        <div class="col-md-10 paddingoff">
                        
                            <input type="text" name="check_verify" class="validate[required]"  placeholder="<?php echo translate( 1260, $lang);?>">
                       </div>
                       
                       <div class="col-md-2 paddingoff">    
                            <input type="submit" id="btnclick" value="<?php echo translate( 1254, $lang);?>" />
                       </div> 
                       
                       </div>
                       
                       <div class="col-md-2"></div>
                       
                       </div>
                       </form> 
                        
                        <div class="clearfix height30"></div>

                        

                    </div>
                </div>
            </div>
        </div>
    </section>
    
    



 <div class="about-breadcrumb">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="<?php echo $url;?>"><?php echo translate( 40, $lang);?></a>
                        </li>
                        
                        <li class="breadcrumb-item active"><?php echo translate( 1248, $lang);?></li>
                        
                    </ol>
                </div>
            </div>
        </div>
    </div> 
    

	
    
	
	
	
	
	
	
	<main class="checkout-area main-content">
<div class="clearfix height20"></div>
        <div class="container">





    <div class="row">
	
	
	
	
	
	
	
	
	
	
	<div class="">
    <?php if(!empty($items_count)){?>
    <div class="">
     <div class="col-md-2"></div>
        <div class="col-md-8">
        <table class="table table-bordered">
            <thead>
                <tr><th><?php echo translate( 88, $lang);?></th> 
                <th><?php echo translate( 1272, $lang);?></th></tr>
             </thead>
             <tbody>
                <tr>
                <td><?php echo translate( 1263, $lang);?></td>
                <td><a href="<?php echo $url;?>/item/<?php echo $item_id;?>/<?php echo $item_slug;?>"><?php echo $item_name;?></a></td>
                </tr>
                
                <tr><td><?php echo translate( 760, $lang);?></td><td><?php echo $purchase_date;?></td></tr>
                
                <tr><td><?php echo translate( 757, $lang);?></td><td><?php echo $user_name;?></td></tr>
                
                <tr><td><?php echo translate( 1269, $lang);?></td><td><?php echo $license_text;?></td></tr>
                
                <tr><td><?php echo translate( 1266, $lang);?></td><td><?php echo $support_date;?></td></tr>
                
                </tbody>
                
                </table>
        </div>
        <div class="col-md-2"></div> 
    </div>
    <?php } else { if(!empty($check_verify)){ ?>
    <div class="fontsize20 text-center red"><?php echo translate( 1275, $lang);?></div>
    <?php } } ?>
</div>
	
	</div>
</div>
<div class="clearfix"></div>
</main>
	
	
	
	<?php } ?>
	
	
	

      @include('footer')
       
</body>
</html>