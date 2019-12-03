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

$edit_pages = DB::table('pages')
        ->where($texter, '=', 4)
        ->where('lang_code', '=', $lang)
        ->get();
?>
<!DOCTYPE html>
<html lang="en">
<head>

    

   @include('style')
    <title><?php echo translate( 25, $lang);?> - <?php echo $edit_pages[0]->page_title;?></title>




</head>
<body class="index">

   

    <!-- fixed navigation bar -->
    @include('header')

    
    
     <div class="promo-area" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $setts[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="promo-text">
                        <h1 class="avigher-title bolder fontsize30"><?php echo $edit_pages[0]->page_title;?></h1>
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
                        <li class="breadcrumb-item"><a href="<?php echo $url;?>">Home</a>
                        </li>
                        <li class="breadcrumb-item active"><?php echo $edit_pages[0]->page_title;?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    
    
    
    
    <main class="main-wrapper-inner" id="container">

                <div class="container">
                
                <div class="row">
                     <div class="col-md-12 col-sm-12">
                    @if(Session::has('csuccess'))

        <p class="alert alert-success">

          {{ Session::get('csuccess') }}

        </p>

    @endif


    
    
    @if(Session::has('cerror'))

        <p class="alert alert-danger">

          {{ Session::get('cerror') }}

        </p>

    @endif
    
    
    
            
    </div>
    </div>

                    <div class="wrapper-inner">

                        <!-- map -->

                        <div class="map-wrapper">

                             <?php if(!empty($setting[0]->site_address)){?>
    
 <!--   <iframe width="100%" height="450" frameborder="0" style="border:0" src="https://www.google.com/maps/embed/v1/place?key=<?php echo $setting[0]->site_map_api;?>&q=<?php echo $setting[0]->site_address;?>" allowfullscreen>-->
    <!--</iframe>-->
    
    
    <div class="mapouter"><div class="gmap_canvas"><iframe width="100%" height="500" id="gmap_canvas" src="https://maps.google.com/maps?q=codepopula&t=&z=13&ie=UTF8&iwloc=&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"></iframe>Google Maps Generator by <a href="https://www.embedgooglemap.net">embedgooglemap.net</a></div><style>.mapouter{position:relative;text-align:right;height:500px;width:100%;}.gmap_canvas {overflow:hidden;background:none!important;height:500px;width:100%;}</style></div>
   
    <?php } ?>

                        </div>

                        <!-- map -->

                        <!-- contact -->

                        <div class="contact-wrapper">

                            <!-- left -->
                            <div class="height50"></div>
                            <div class="height20"></div>

                            <div class="row">

                                <div class="col-md-4 text-center">
                                 <h4><?php echo translate( 397, $lang);?></h4>
                                <p><?php echo $setting[0]->site_address;?></p>
                                </div>
                                
                                <div class="col-md-4 text-center">
                                <h4><?php echo translate( 400, $lang);?></h4>
                                <p><?php echo $setting[0]->site_phone;?></p>
                                </div>
                                
                                <div class="col-md-4 text-center">
                                <h4><?php echo translate( 403, $lang);?></h4>
                                <p><?php echo $setting[0]->site_email;?></p>
                                </div>

                            </div>
                            <div class="clearfix height50"></div>
                            <div class="height20"></div>
                            <!-- left -->

                            <!-- right -->

                            <div>

                                <div class="row">
                                <div class="col-sm-12 paddingoff">

                                    <h4 class="text-left"><?php echo translate( 406, $lang);?></h4>
                                    <p><?php echo $edit_pages[0]->page_desc;?></p>

                                </div>
                                </div>
                                 <div class="height20"></div>
                                <!-- contact-form -->

                                <div class="contact-form">

                                   

                                    <form class="form-horizontal" role="form" method="POST" action="{{ route('contact-us') }}" id="formID" enctype="multipart/form-data">{{ csrf_field() }}
                                    
                                    
                                    
                                    <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                    <label><?php echo translate( 409, $lang);?> <span class="required">*</span></label>
                                        <input name="name" id="name" type="text" placeholder="" class="validate[required]">
                                    </div>
                                </div>
                                
                                
                                
                                <div class="col-sm-4">
                                    <div class="form-group">
                                    <label><?php echo translate( 412, $lang);?> <span class="required">*</span></label>
                                        <input name="email" id="email" type="text" placeholder="" class="validate[required,custom[email]]">
                                    </div>
                                </div>
                                
                                
                                <div class="col-sm-4">
                                    <div class="form-group">
                                    <label><?php echo translate( 415, $lang);?> <span class="required">*</span></label>
                                        <input name="phone_no" id="phone_no" type="text" placeholder="" class="validate[required]">
                                    </div>
                                </div>
                                
                            </div>
                                    
                                      <div class="row">  
                                         <div class="col-sm-12">
                                         <div class="form-group">
                                    <label><?php echo translate( 418, $lang);?> <span class="required">*</span></label>
                                        <textarea name="msg" id="msg" cols="" rows="6" class="validate[required] text-input"></textarea>
                                    </div>
                                         
                                         </div>
                                         
                                      </div>   
                                        
                                        
                                      <div class="row {{ $errors->has('g-recaptcha-response') ? ' has-error' : '' }}">  
                                         <div class="col-sm-12">
                                           <div class="form-group">
                                            {!! NoCaptcha::display() !!}
                                            @if ($errors->has('g-recaptcha-response'))
                                                <span class="help-block">
                                                    <strong>The captcha field is required or invalid.</strong>
                                                </span>
                                            @endif
                                             </div>
                                           </div>
                                         </div>
                                         
                                         <div class="row">  
                                         <div class="col-sm-12">
                                         <div class="form-group">
                                         <input name="" type="submit" value="<?php echo translate( 421, $lang);?>" class="custom-btn custombtn_width">
                                         </div>
                                         </div>
                                         </div>
                                        
                                        

                                        
                                        

                                    </form>

                                </div>

                                <!-- contact-form -->

                            </div>

                            <!-- right -->

                        </div>

                        <!-- contact -->

                    </div>

                </div>

            </main>      

      @include('footer')
       
</body>
</html>