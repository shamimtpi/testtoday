<?php 
use Illuminate\Support\Facades\Route;
use Carbon\Carbon;
$ncurrentPath= Route::getFacadeRoot()->current()->uri();
$url = URL::to("/");
$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
$users = DB::select('select * from users where id = ?',[$setid]);	



$aid=1;
		$admindetails = DB::table('users')
		 ->where('id', '=', $aid)
		 ->first();

	
		
		$admin_email = $admindetails->email;
		
$colname = "footer-menu";
	$pages_cnt = DB::table('pages')
				->whereRaw('FIND_IN_SET(?,menu_position)', [$colname])
                ->orderBy('menu_order','asc')
				->count();

$user_list_count = DB::table('users')
		           ->where('id', '!=', 1)
				   ->where('delete_status', '=', '')
		           ->count();	

$sett_meta_well_two = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 2)
				->where('sett_meta_key', '=' , "site_back_to_top")
		        
				->count();
				
			if(!empty($sett_meta_well_two))
			{	
		   $sett_meta_two =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 2)
				->where('sett_meta_key', '=' , "site_back_to_top")
		        
				->get();
			$site_back_to_top = $sett_meta_two[0]->sett_meta_value;
			}
			else
			{
			$site_back_to_top = "";
			}

$default = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }	
function foot_translate($id,$lang) 
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



$sett_meta_cookie = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 75)
				->where('sett_meta_key', '=' , "site_cookie")
		        
				->count();
				
			if(!empty($sett_meta_cookie))
			{	
		   $sett_meta_two =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 75)
				->where('sett_meta_key', '=' , "site_cookie")
		        
				->get();
			$site_cookie = $sett_meta_two[0]->sett_meta_value;
			}
			else
			{
			$site_cookie = "";
			}


$sett_meta_cookie_position = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 76)
				->where('sett_meta_key', '=' , "site_cookie_position")
		        
				->count();
				
			if(!empty($sett_meta_cookie_position))
			{	
		   $sett_meta_two =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 76)
				->where('sett_meta_key', '=' , "site_cookie_position")
		        
				->get();
			$site_cookie_position = $sett_meta_two[0]->sett_meta_value;
			}
			else
			{
			$site_cookie_position = "";
			}								   												
?>


  <!--infolink ads
 
<script type="text/javascript">
var infolinks_pid = 3181359;
var infolinks_wsid = 0;
</script>
<script type="text/javascript" src="//resources.infolinks.com/js/infolinks_main.js"></script>
 
  infolink ads-->





 

     
<footer class="footer-area">
        <div class="footer-top">
            <div class="cp_container">
                <div class="row">
                 

					<!-- Widget 1 -->
                    <div class="col-md-2 col-sm-4">
                        <div class="footer-widget">
                            <h3 class="footer-title">WordPress Theme</h3>
                            <ul class="our-support">
                               <li><a target="__blank" href="https://themeforest.net/item/avada-responsive-multipurpose-theme/2833226">Avada Multipurpus Theme</a></li>
                               <li><a target="__blank" href="https://themes.muffingroup.com/be/splash/">Be Multipurpus Theme</a></li>
                               <li><a target="__blank" href="https://www.elegantthemes.com/gallery/divi/">DiVi Multipurpus Theme</a></li>
                               <li><a target="__blank" href="https://demo.xtemos.com/basel/">Basel Woocommerce Theme</a></li>
                               <li><a target="__blank" href="https://themeforest.net/item/newspaper/5489609">Newspaper Theme Portal</a></li>
                            </ul>
                        </div>
                    </div>


              <!-- Widget 2 -->
                <div class="col-md-2 col-sm-4">
                        <div class="footer-widget  support-pd">
                            <h3 class="footer-title"><?php echo foot_translate( 178, $lang);?></h3>
                            <ul class="product-list">
                                
                                <?php
					$cate_cnts = DB::table('product_categories')
								 ->where('delete_status','=','')
								 ->where('lang_code','=',$lang)
								 ->where('cat_type','=','default')
								 ->where('status','=',1)
								 ->orderBy('id','desc')
								 ->take(5)
								 ->count();
					if(!empty($cate_cnts))
					{
					
					$views_category = DB::table('product_categories')
								 ->where('delete_status','=','')
								 ->where('status','=',1)
								 ->where('lang_code','=',$lang)
								 ->where('cat_type','=','default')
								 ->orderBy('id','desc')
								 ->take(5)
								 ->get();	
					foreach($views_category as $views){	
					
					if($lang == "en")
											  {
												$catt_id = $views->id; 
											  }
											  else
											  {
												 $catt_id = $views->parent;
											  }			 		 
					?>
                                <li><a href="<?php echo $url;?>/search/<?php echo $catt_id;?>-cat/<?php echo $views->post_slug;?>"><?php echo $views->cat_name;?></a>
                                </li>
                               <?php } } ?>
                            </ul>
                        </div>
                    </div>


  					<!-- Widget 3 -->
						<div class="col-md-2 col-sm-4">
                        <div class="footer-widget support-pd">
                            <h3 class="footer-title">Tutorials</h3>
                            <ul class="our-support">
                               <li><a target="__blank" href="https://helpx.adobe.com/photoshop/tutorials.html">Photoshop Tutorials</a></li>
                               <li><a target="__blank" href="https://www.w3schools.com/js/">JavaScript Tutorials</a></li>
                               <li><a target="__blank" href="https://developer.wordpress.org/themes/">WordPress Tutorials</a></li>
                               <li><a target="__blank" href="https://www.tutorialspoint.com/">Free Online Tutorials</a></li>
                               <li><a target="__blank" href="#">Free Coding Tutorials</a></li>
                            </ul>
                        </div>
                    </div>
                   
                 <!-- Widget 4 -->

    			 <div class="col-md-2 col-sm-4">
                        <div class="footer-widget support-pd">
                            <h3 class="footer-title">About</h3>
                            <ul class="our-support">
                               <li><a target="__blank" href="https://www.codepopular.com/page/about-us">About us </a></li>
                               <li><a target="__blank" href="#">How it Works </a></li>
                               <li><a target="__blank" href="#">Security </a></li>
                               <li><a target="__blank" href="#">Investor </a></li>
                               <li><a target="__blank" href="#">News</a></li>
                            </ul>
                        </div>
                    </div>

				<!-- Widget 5 -->
                    
                    <div class="col-md-2 col-sm-4">
                        <div class="footer-widget support-pd">
                            <h3 class="footer-title">Important Link</h3>
                             <ul class="our-support">
                               <li><a target="__blank" href="https://w3schools.com">W3 Schools</a></li>
                               <li><a target="__blank" href="http://themeforest.com">Themeforest</a></li>
                               <li><a target="__blank" href="https://getbootstrap.com/">Bootstrap</a></li>
                               <li><a target="__blank" href="http://laravel.com">Laravel</a></li>
                               <li><a target="__blank" href="https://www.linkedin.com/jobs">Linkedin Jobs</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Widget 6 -->
                    <div class="col-md-2 col-sm-4">
                        <div class="footer-widget support-pd">
                            <h3 class="footer-title">Quick Help</h3>
                            <ul class="our-support">
                               <li><a target="__blank" href="#">Help Center</a></li>
                               <li><a target="__blank" href="#">Theme Support</a></li>
                               <li><a target="__blank" href="#">WordPress Install</a></li>
                               <li><a target="__blank" href="#">Update Website</a></li>
                               <li><a target="__blank" href="#">Ho to Create Account</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Widget 7 -->
                    <div class="col-md-2 col-sm-4">
                        <div class="footer-widget">
                            <h3 class="footer-title">WordPress Plugins</h3>
                             <ul class="our-support">
                               <li><a target="__blank" href="https://visualcomposer.com/">Visual Composer</a></li>
                               <li><a target="__blank" href="https://www.elegantthemes.com/gallery/divi/">Divi Page Builder</a></li>
                               <li><a target="__blank" href="https://woocommerce.com/">Woocommerce Plugin</a></li>
                               <li><a target="__blank" href="https://wordpress.org/plugins/wordpress-seo/">Yost SEO Plugin</a></li>
                               <li><a target="__blank" href="https://elementor.com/">Elementor Page builder</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Widget 8 -->
                   
                    <div class="col-md-2 col-sm-4">
                        <div class="footer-widget support-pd">
                            <h3 class="footer-title">Our Community</h3>
                              <ul class="our-support">
                               <li><a target="__blank" href="https://www.codepopular.com/blog">Latest Blog</a></li>
                               <li><a target="__blank" href="https://facebook.com/groups/codepopular/">Facebook Group</a></li>
                               <li><a target="__blank" href="#">Fourm</a></li>
                               <li><a target="__blank" href="https://www.facebook.com/codepopularOfficial/?modal=admin_todo_tour">Meetups</a></li>
                               <li><a target="__blank" href="https://www.youtube.com/channel/UC6D-DkmbAj67GgDvOU2DMEg">Youtube Video</a></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Widget 9 -->
                    <div class="col-md-2 col-sm-4">
                        <div class="footer-widget support-pd">
                            <h3 class="footer-title"><?php echo foot_translate( 490, $lang);?></h3>
                            <ul class="our-support">
                            <?php if(!empty($pages_cnt)){
									 $colname = "footer-menu";
									 $pages = DB::table('pages')
									          ->where('lang_code','=',$lang)
									          ->whereRaw('FIND_IN_SET(?,menu_position)', [$colname])
                                              ->orderBy('menu_order','asc')
					                          ->get();
									 ?>
                                 <?php foreach($pages as $page){
								if($page->page_id==4){ $pagerurl = $url.'/'.'contact-us'; }
								
								else { $pagerurl = $url.'/page/'.$page->post_slug; }
								?> 
                               <li><a href="<?php echo $pagerurl; ?>"><?php echo $page->page_title;?></a></li>
                                 <?php } ?>
                            </ul>
                            <?php } ?>
                        </div>
                    </div>

				<!-- Widget 10 -->

                    <div class="col-md-2 col-sm-4">
                        <div class="footer-widget">
                            <h3 class="footer-title"><?php echo foot_translate( 493, $lang);?></h3>
                            <div class="social">
           
          <?php if(!empty($setts[0]->site_facebook)){?><a href="<?php echo $setts[0]->site_facebook;?>" target="_blank"><i class="fa fa-facebook"></i></a><?php } ?>
                                    
                                    <?php if(!empty($setts[0]->site_twitter)){?><a href="<?php echo $setts[0]->site_twitter;?>" target="_blank"><i class="fa fa-twitter"></i></a><?php } ?>
                                    <?php if(!empty($setts[0]->site_gplus)){?><a href="<?php echo $setts[0]->site_gplus;?>" target="_blank"><i class="fa fa-google-plus"></i></a><?php } ?>
									<?php if(!empty($setts[0]->site_pinterest)){?><a href="<?php echo $setts[0]->site_pinterest;?>" target="_blank"><i class="fa fa-pinterest"></i></a><?php } ?>
									<?php if(!empty($setts[0]->site_instagram)){?><a href="<?php echo $setts[0]->site_instagram;?>" target="_blank"><i class="fa fa-instagram"></i></a><?php } ?>
       
                             </div>
                             <br>
                             <a href="@if(!Auth::check()){{route('login')}}@endif" class="btn btn-info d-block" style="margin-bottom:10px">Singn in account</a>  
                             <a href="@if(!Auth::check()){{route('register')}}@endif" class="btn btn-success d-block">Register New account</a>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-9">
                        <div class="footer-widget">
                            <h3 class="footer-title"><?php echo foot_translate( 496, $lang);?></h3>
                            <p><?php echo foot_translate( 37, $lang);?></p>
                            
                            @if(Session::has('nletter_success'))

						    <div class="alert alert-success custom_alert">

						      {{ Session::get('nletter_success') }}

						    </div>

						@endif

			        @if(Session::has('nletter_error'))

				    <div class="alert alert-danger custom_alert">

				      {{ Session::get('nletter_error') }}

				    </div>

					@endif
                            
                            
                            <form class="subscribe-form" method="POST" action="{{ route('newsletter') }}" id="formIDZero" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <?php if(!empty($setts[0]->site_logo)){
							 
							?>
						
						<input type="hidden" name="site_logo" value="<?php echo $url.'/local/images/media/settings/'.$setts[0]->site_logo;?>">
					
						<?php } else { ?>
						
						<input type="hidden" name="site_logo" value="">
						
						<?php } ?>
                        
                        <input type="hidden" id="activated" name="activated" value="0">
                        
                        <input type="hidden" name="site_url" value="<?php echo $url;?>">
						
						<input type="hidden" id="admin_email" name="admin_email" value="<?php echo $admin_email;?>">
						<input type="hidden" name="site_name" value="<?php echo $setts[0]->site_name;?>">
          
                            
                                <input type="email" class="validate[required,custom[email]]" name="email" placeholder="<?php echo foot_translate( 949, $lang);?>">
                                <button type="submit"><?php echo foot_translate( 499, $lang);?></button>
                            </form>
                            <span class="community-count"><strong>11<?php echo $user_list_count;?></strong><?php echo foot_translate( 502, $lang);?> <a href=""></a></span>
                          





<script type="text/javascript"> 

var url = 'https://wiki.teamfortress.com/wiki/Main_Page';
$.getJSON('https://api.gosquared.com/now/v3/pages?api_key=demo&site_token=GSN-106863-S&href=' + encodeURIComponent(url), function(data) {
  $('#online-now').addClass('visible').find('.visitors').text(data.visitors);
});
</script>

                        </div>
                    </div>
                    <!-- End Widget -->
                    
                    
                </div>
            </div>
        </div>
        <div class="footer-buttom">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4 col-md-4 col-xs-12 text-left">
                        <div class="copy-right">
                            <p><?php echo foot_translate( 28, $lang);?> </p>
                        </div>
                    </div>
                    <div class="col-sm-8 col-md-8 col-xs-12 text-left">
                        <div class="codepopular-footer-menu">
                            <ul>
                            	<li><a href="{{$url}}/page/about-us">About Us</a></li>
                            	<li><a href="{{$url}}/page/privacy-policy">Privacy Policy</a></li>
                            	<li><a href="{{$url}}/page/terms-conditions">Terms and Condition</a></li>
                            	<li><a href="{{$url}}/page/return-and-refund-policy">Refund Policy</a></li>
                            	<li><a href="{{$url}}/contact-us">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
    </footer>






<section class="mobile_sticky_footer hide_desktop">
    <div class="navigation-list">
		<a href="{{URL::to('/')}}" class="navigation-icon navigation-mobile_home">
			<i class="fa fa-home"></i> Home</a>
	    <a href="javascript:void(Tawk_API.toggle())" class="navigation-icon navigation-mobile_cat active" id="navigation-mobile_cat"><i class="fa fa-comments"></i> Message</a><a href="#" class="navigation-icon navigation-mobile_search"><i class="fa fa-search"></i> Search</a>
	   <a href="{{URL::to('cart')}}" class="navigation-icon navigation-mobile_cart">
		<i class="fa fa-shopping-cart"></i> Cart</a>
	</div>
  </section>
<style>
	
body{
	padding-bottom:100px


}
.mobile_sticky_footer {
    position: fixed;
    bottom: 0;
    left: 0;
    right: 0;
    z-index: 999999;
    background-color: #fff;
    border-top: 1px solid #ccc;
}

.mobile_sticky_footer .navigation-list {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 10px 15px;
}
.mobile_sticky_footer .navigation-icon i {
    font-size: 24px;
}

.mobile_sticky_footer .navigation-icon {
    display: flex;
    flex-direction: column;
    align-items: center;
    color: #000;
}

</style>








<?php if($site_cookie == "on") {?>    
<link rel="stylesheet" type="text/css" href="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.css" />
<script src="//cdnjs.cloudflare.com/ajax/libs/cookieconsent2/3.1.0/cookieconsent.min.js"></script>
<script>
window.addEventListener("load", function(){
window.cookieconsent.initialise({
  "palette": {
    "popup": {
      "background": "#000"
    },
    "button": {
      "background": "#f1d600"
    }
  },
  "showLink": false,
  "position": "<?php echo $site_cookie_position;?>",
  "content": {
    "message": "<?php echo foot_translate( 1212, $lang);?>",
    "dismiss": "<?php echo foot_translate( 1215, $lang);?>"
  }
})});
</script>
<?php } ?>

    <script src="<?php echo $url;?>/local/resources//views/theme/js/bootstrap.min.js"></script>
     <script src="<?php echo $url;?>/local/resources//views/theme/js/mmenu-light.js"></script>
    <?php $mobilelogo = "mobilelogo"; if(!empty($setts[0]->site_logo)){  $bge = "<a href=".$url."><img src=".$url."/local/images/media/settings/".$setts[0]->site_logo." border=0 class=".$mobilelogo."></a>"; } else { $bge = $setts[0]->site_name; } ?>


<script>  
 	const mobile_menu = new MmenuLight( document.querySelector( '#mobile_menu' ), {
				// title: 'Menu',
				// theme: 'light',
				// selected: 'Selected'
			});
			mobile_menu.enable( 'all' ); // '(max-width: 900px)'
			mobile_menu.offcanvas({
				// position: 'left' [| 'right'],
				// move: true [| false],
				 blockPage: true, //[| false | 'modal']
				 
			});

			//	Open the menu.
			document.querySelector( 'a[href="#mobile_menu"]' )
				.addEventListener( 'click', ( evnt ) => {
					mobile_menu.open();

					//	Don't forget to "preventDefault" and to "stopPropagation".
					evnt.preventDefault();
					evnt.stopPropagation();
				});

	 $('body').click(function(){
    
        $('.mm--main').removeClass('mm--open');
        $(this).removeClass('mm-body--open');
	 });

</script>


<script>  
 	const user_board = new MmenuLight( document.querySelector( '#user_board' ), {
				// title: 'Menu',
				// theme: 'light',
				// selected: 'Selected'
			});
			user_board.enable( '(max-width: 991px)' ); // '(max-width: 900px)'
			user_board.offcanvas({
			  position: 'right',
				// move: true [| false],
				// blockPage: true [| false | 'modal']
			});

			//	Open the menu.
			document.querySelector( 'a[href="#user_board"]' )
				.addEventListener( 'click', ( evnte ) => {
					user_board.open();

					//	Don't forget to "preventDefault" and to "stopPropagation".
					evnte.preventDefault();
					evnte.stopPropagation();
				});

</script>




    <script src="<?php echo $url;?>/local/resources/views/theme/js/avigher.min.js"></script>
    <script src="<?php echo $url;?>/local/resources/views/theme/js/jquery.settings.min.js"></script>
    <script src="<?php echo $url;?>/local/resources/views/theme/js/jquery.newfyler.js"></script>
    <script src="<?php echo $url;?>/local/resources/views/theme/js/jquery.timer.min.js"></script>
    <script src="<?php echo $url;?>/local/resources/views/theme/js/owl.carousel.min.js"></script>
    <script src="<?php echo $url;?>/local/resources/views/theme/js/main.js"></script>

<?php
$sett_meta_chat = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 15)
				->where('sett_meta_key', '=' , "site_live_chat")
		        
				->count();
				
			if(!empty($sett_meta_chat))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 15)
				->where('sett_meta_key', '=' , "site_live_chat")
		        
				->get();
			$sett_meta_chat = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_meta_chat = "";
			}
if(!empty($sett_meta_chat))
{
//echo html_entity_decode($sett_meta_chat);
}
?>




<script src="<?php echo $url;?>/local/resources/views/theme/js/jquery.validationEngine-en.js" type="text/javascript" charset="utf-8">
	</script>
	<script src="<?php echo $url;?>/local/resources/views/theme/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	</script>
	<script>
		jQuery(document).ready(function(){
			
			jQuery("#formID").validationEngine('attach', { promptPosition: "topLeft" });
			jQuery("#formID_n1").validationEngine('attach', { promptPosition: "topLeft" });
			jQuery("#formID_n2").validationEngine('attach', { promptPosition: "topLeft" });
			
			jQuery("#formIfooter").validationEngine('attach', { promptPosition: "topLeft" });
			jQuery("#formwithdraw").validationEngine('attach', { promptPosition: "topLeft" });
			jQuery("#formIDZero").validationEngine('attach', { promptPosition: "topLeft" });
			jQuery("#formIDreport").validationEngine('attach', { promptPosition: "topLeft" });
			
		});
		
		
		function withdraw_checking(str)
    {	

        document.getElementById("localbank").style.display="none";
		document.getElementById("paypal").style.display="none";
		document.getElementById("stripe").style.display="none";
		document.getElementById("paytm").style.display="none";
		document.getElementById("perfectmoney").style.display="none";
		
	if(str=="paypal")
	{	
		document.getElementById("localbank").style.display="none";
		document.getElementById("paypal").style.display="block";
		document.getElementById("stripe").style.display="none";
		document.getElementById("paytm").style.display="none";
		
	}
	else if(str=="localbank")
	{
		document.getElementById("paypal").style.display="none";
		document.getElementById("localbank").style.display="block";
		document.getElementById("stripe").style.display="none";
		document.getElementById("paytm").style.display="none";
		
	}
	else if(str=="stripe")
	{
		document.getElementById("paypal").style.display="none";
		document.getElementById("localbank").style.display="none";
		document.getElementById("stripe").style.display="block";
		document.getElementById("paytm").style.display="none";
		
	}
	else if(str=="paytm")
	{
		document.getElementById("paypal").style.display="none";
		document.getElementById("localbank").style.display="none";
		document.getElementById("stripe").style.display="none";
		document.getElementById("paytm").style.display="block";
	}
	else if(str=="perfectmoney")
	{
		document.getElementById("paypal").style.display="none";
		document.getElementById("localbank").style.display="none";
		document.getElementById("stripe").style.display="none";
		document.getElementById("paytm").style.display="none";
		document.getElementById("perfectmoney").style.display="block";
	}
	
	
	
   }
   
   
   
   
    </script>
    
    <?php /* scroll top */ ?>
		
		
<?php /* end scroll top */?>
    
    
    
    
    
    <?php /* mp3 */?>
    <script src="<?php echo $url;?>/local/resources/views/theme/js/mp3.js"></script>

<script>
    $(document).ready(function () {
        $('.mediPlayer').mediaPlayer();
    });
</script>

<?php /* end mp3 */?>

<?php /* ?>
<script type="text/javascript" src="<?php echo $url;?>/local/resources/views/theme/js/jquery.simplePagination.min.js"></script>
            <script type="text/javascript">
		$(function(){
			var perPage = <?php echo $setts[0]->site_post_per;?>;
			var opened = 1;
			var onClass = 'on';
			var paginationSelector = '.pagess';
			$('.bloglist').simplePagination(perPage, opened, onClass, paginationSelector);
		});
	
	</script>
    <?php */?>
    
 <script type="text/javascript">
 $('ul.nav li.dropdown').hover(function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
}, function() {
  $(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
});	

</script>
 
<?php /********** POPUP GALLERY ********/?>

 @include('chat')

<?php /* top to scroller */?>
<?php if($site_back_to_top=="on"){?>

<div id="gotop"></div>
<script type="text/javascript">
(function($){
    'use strict';
    
    var defaults = {
        background : '<?php echo $setts[0]->site_button_color;?>', // Background color
        color: '#fff', // Icon color
        rounded: true, // if true make the button rounded
        width: '45px',
        height: '45px',
        bottom : '25px', // Button bottom position
        right : '25px', // Button right position
        windowScrollShow: 400, // Window height after which show the button
        speed: 800,
        customHtml: '', // Set custom html for icon
        mobileOnly: false // Show button only on mobile device
    }
    
    // ----------------------------------
    
    $.fn.gotop = function( options ){
        
        var opts = $.extend(true, {}, defaults, options)
        ,   isMobile = $.fn.gotop.isMobile()
        ,   $el = this;
        

        return this.each(function(){
            // Hide the element
            $el.hide();

            // ----------------------------------

            // Make the button rounded
            if(opts.rounded == true) {
                $el.css('border-radius', '50%');
            }

            // ----------------------------------

            // CSS 
            $el.css({
                cursor: 'pointer',
                position: 'fixed',
                'align-items': 'center',
                'justify-content': 'center',
                background: opts.background,
                color: opts.color,
                width: opts.width,
                height: opts.height,
                bottom: opts.bottom, 
                right: opts.right
            });

            // ----------------------------------

            // Set default icon if customHtml option is empty
            if(opts.customHtml != '') {
                $el.append(opts.customHtml);            
            } else {
                $el.append('&uarr;');
            }

            // ----------------------------------
            
            // Back to top
            $el.click(function (e) {
              e.preventDefault();
              $('html, body').animate({scrollTop: 0}, opts.speed);
            });
            
            // ----------------------------------
            
            // Show the scroll to top button only on mobile devices
            if (opts.mobileOnly == true) {
                if(isMobile) {
                    $(window).scroll(function() {
                        $.fn.gotop.showButton($el, opts.windowScrollShow);
                    });                    
                } else {
                    return false;
                }
            }
            else
            {
                // Show the scroll to top button on all devices
                $(window).scroll(function() {
                    $.fn.gotop.showButton($el, opts.windowScrollShow);
                }); 
            }            
            
            // ----------------------------------
            
        });
    };
    
    // --------------------------------------------------------------------------
    
    $.fn.gotop.isMobile = function() { 
        return /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent); 
    }
    
    // --------------------------------------------------------------------------
    
    $.fn.gotop.showButton = function(element, windowScrollHeight) {
        
        if( $(window).scrollTop() > windowScrollHeight ) {
            element.fadeIn(400)
                .css('display', 'flex');
        } else {
            element.fadeOut(400);
        }
    }
    
    // --------------------------------------------------------------------------
    
}(jQuery));


</script>
<?php if(!empty($sett_meta_chat)){ $moberor = "5em"; } else { $moberor = "2em"; } ?>

<script>
$('#gotop').gotop({
  customHtml: '<i class="fa fa-angle-up fa-2x"></i>',
  bottom: '<?php echo $moberor;?>',
  right: '2em'
});
</script>

<?php } ?>
<?php /* top to scroller */ ?>

<?php /* feature item */?>
<script src='<?php echo $url;?>/local/resources/views/theme/carousel/feature_slider.js'></script>

  

    <script type="text/javascript">
    $('.owl-carousel').owlCarousel({
  
  loop: true,
  nav: true,
  dots: true,
  margin: 10,
  autoplay: true,
  autoplayTimeout: 2500
 
  
});
    </script>
<?php /* feature item */?>    

