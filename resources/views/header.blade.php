<?php
use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();	
$url = URL::to("/");


$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
if($currentPaths=="/")
 {
 $activemenu = "/";
 }
 else 
 {
  $activemenu = $currentPaths;
 }
 
 
 
if($activemenu == "/"){ $active_home = "active"; } else { $active_home =""; }



if($activemenu == "blog" or $activemenu == "blog/{id}") { $active_blog = "active"; } else { $active_blog = ""; }

if($activemenu == "contact-us") { $active_contact = "active"; } else { $active_contact = ""; }

if($activemenu == "register"){ $active_register = "active"; } else { $active_register = ""; }
if($activemenu == "dashboard" or $activemenu == "my-comments"){ $active_dashboard = "active"; } else { $active_dashboard = ""; }


 $colname = "main-menu";
	$pages_cnt = DB::table('pages')
	            ->where('lang_code', '=', $lang)
				->whereRaw('FIND_IN_SET(?,menu_position)', [$colname])
                ->orderBy('menu_order','asc')
				->count();
					
if(Auth::check()) {
	   $log_id = Auth::user()->id;
	   
	   $cart_views_count = DB::table('product_orders')
		
		->where('user_id', '=', $log_id)
		->where('status', '=', 'pending')
		
		->count();
	   
	   
	   $cart_views = DB::table('product_orders')
		
		->where('user_id', '=', $log_id)
		->where('status', '=', 'pending')
		
		->get();
		
		$user_wallet = Auth::user()->wallet;
		
		}
		else
		{
		$cart_views_count = 0;
		$cart_views = "";
		$user_wallet = 0;
		}
	

$check_sett_purchase = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 100)
				->where('sett_meta_key', '=' , "site_verify_purchase")
		        
				->count();
		if(!empty($check_sett_purchase))
		{
		   
		    $sett_meta_seo = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 100)
				->where('sett_meta_key', '=' , "site_verify_purchase")
		        
				->count();
				
			if(!empty($sett_meta_seo))
			{	
		   $sett_meta_chat =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 100)
				->where('sett_meta_key', '=' , "site_verify_purchase")
		        
				->get();
			$site_verify_purchase = $sett_meta_chat[0]->sett_meta_value;
			}
			else
			{
			$site_verify_purchase = "";
			}	
		}
		else
		{
		  $site_verify_purchase = "";
		}		
		
							
?>


<?php if($setts[0]->site_loading_url!="" && $setts[0]->site_loading=='1'){?>	
<div class="loader"></div>
<?php } ?>	

<header class="header-area">


    <!-- MOBILE-MENU-AREA START -->
       	<div class="mobile_menu_header">
				<a class="mobile_menu_bar" href="#mobile_menu"> <i class="fa fa-bars"></i></a>
				
				   @if(!empty($setts[0]->site_logo))
                        
                        	<span onClick=" window.location.href ='<?php echo $url;?>'"><img src="<?php echo $url.'/local/images/media/settings/'.$setts[0]->site_logo;?>" border="0" alt="{{$setts[0]->site_name}}" /></span>
                      
                    @endif
@if(Auth::check())
<a class="user_board_mobile" href="#user_board"><img style="margin-left:5px" width="40" height="40" src="{{asset('local/images/media/userphoto/')}}/{{Auth::user()->photo}}" alt="{{Auth::user()->name}}"></a>
@else



  <a style="font-size: 14px;float:right;margin-top:10px;" href="<?php echo $url;?>/login" class="btn btn-primary btn-sm"><i class="fa fa-user"></i> <?php echo translate( 535, $lang);?>
                    	</a>
       @endif           


				<nav id="mobile_menu">

					     <ul>
                                <li><a href="<?php echo $url;?>/all-items"><?php echo translate( 217, $lang);?></a>
                                            </li>
                                   <?php
					$cate_cnts = DB::table('product_categories')
								 ->where('delete_status','=','')
								 ->where('status','=',1)
								 ->where('lang_code','=',$lang)
								 ->where('display_menu','=',1)
								 ->orderBy('cat_name','asc')
								 ->count();
					if(!empty($cate_cnts))
					{
					
					$views_category = DB::table('product_categories')
								 ->where('delete_status','=','')
								 ->where('status','=',1)
								 ->where('lang_code','=',$lang)
								 ->where('display_menu','=',1)
								 ->orderBy('cat_name','asc')
								 ->get();	
					foreach($views_category as $views){		
					if($lang == "en")
						  {
						    $cat_id = $views->id; 
						  }
						  else
						  {
						     $cat_id = $views->parent;
						  }			 		 
					?>
                                    <li><a href="<?php echo $url;?>/search/search/<?php echo $cat_id;?>-cat/<?php echo $views->post_slug;?>"><?php echo $views->cat_name;?></a>
                                        
                                        <?php
					  $subcat_cnt = DB::table('product_subcats')
									->where('delete_status','=','')
									->where('status','=',1)
									
									->where('cat_id','=',$cat_id)
									->where('lang_code','=',$lang)
									
									->orderBy('subid','asc')
									->count();
					  if(!empty($subcat_cnt))
					  {	
					  
					  $viewsub = DB::table('product_subcats')
									->where('delete_status','=','')
									->where('status','=',1)
									
									->where('cat_id','=',$cat_id)
									->where('lang_code','=',$lang)
									
									->orderBy('subid','asc')
									->get();
					  
					  		
					  ?>


					  <ul class="sub-menu">
                      <?php foreach($viewsub as $subs){
					  
					  if($lang == "en")
						  {
						    $subcat_id = $subs->subid; 
						  }
						  else
						  {
						     $subcat_id = $subs->parent;
						  }	
					  ?>
                                            <li><a href="<?php echo $url;?>/search/search/<?php echo $subcat_id;?>-subcat/<?php echo $subs->post_slug;?>"><?php echo $subs->subcat_name;?></a>
                                            </li>
                                        <?php } ?>    
                                           
                                        </ul>
                                    </li>
                                     <?php } } } ?>
                                    
                                    
                                     <?php if(!empty($pages_cnt)){
									 $colname = "main-menu";
									 $pages = DB::table('pages')
									          ->where('lang_code', '=', $lang)
									          ->whereRaw('FIND_IN_SET(?,menu_position)', [$colname])
                                              ->orderBy('menu_order','asc')
					                          ->get();
									 ?>
                                  <li><a href="javascript:void(0)"><?php echo translate( 538, $lang);?></a>    
                                  <ul class="sub-menu">   
                                <?php foreach($pages as $page){
								
								if($lang == "en")
						  {
						    $page_id = $page->page_id; 
						  }
						  else
						  {
						     $page_id = $page->parent;
						  }
								
								if($page_id==4){ $pagerurl = $url.'/'.'contact-us'; }
								
								else { $pagerurl = $url.'/page/'.$page->post_slug; }
								?>
                                
                                <li><a href="<?php echo $pagerurl; ?>"><?php echo $page->page_title;?></a></li>
                                <?php } ?>
                                
                                </ul>
                                <?php } ?>
                                
                                </li>
                                
                                
                                <?php if($setts[0]->site_blog_visible=="yes"){?><li><a href="<?php echo $url;?>/blog"><?php echo translate( 226, $lang);?></a></li><?php } ?>
                                    
                                </ul>
				</nav>
			</div>
        <!-- MOBILE-MENU AREA END -->







@if(Auth::check())
 <!-- MOBILE-MENU-AREA START -->
       	<div class="user_board_header">
				<nav id="user_board">
					     <ul>
                          
                           
                                    @if(Auth::user()->admin==1)
	        <li>
	        	<a href="<?php echo $url;?>/dashboard"><?php echo translate( 517, $lang);?></a>
	        </li>
	        
	        <li>
	        	<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><?php echo translate( 520, $lang);?>
	        		
	        	</a>
	        </li>
	        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	            {{ csrf_field() }}
	         </form>
	    @else                                
	        <li>
	        	<a href="<?php echo $url;?>/{{Auth::user()->user_slug}}"><?php echo translate( 517, $lang);?>
	        	</a>
	        </li>
	          <li>
	        	<a href="<?php echo $url;?>/dashboard"><?php echo translate( 424, $lang);?>
	        	</a>
	        </li>
	        
	            
	       <li>
		       	<a href="<?php echo $url;?>/my-items"><?php echo translate( 523, $lang);?>	
		       	</a>
	       </li>
	       
	       <li>
		       	<a href="<?php echo $url;?>/my-shopping"><?php echo translate( 526, $lang);?>
		       	</a>
	       </li>
	       
	       <li>
	       	<a href="<?php echo $url;?>/my-orders"><?php echo translate( 529, $lang);?></a>
	       </li>
	       
	       <li>
		       	<a href="<?php echo $url;?>/my-earnings"><?php echo translate( 532, $lang);?>
		       	</a>
	       </li>
	        
	          <li>
	          	<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><?php echo translate( 520, $lang);?>
	          	</a>
	          </li>
	            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	               {{ csrf_field() }}
	             </form>
	       @endif      
                                
                                
                                    
                                </ul>
				</nav>
			</div>
        <!-- MOBILE-MENU AREA END -->

@endif


        <div class="user-board-area">
            <div class="container">
                <div class="row">

                    <div class="col-lg-2 col-md-12 hidemobile">
                        <div class="logo">
                       @if(!empty($setts[0]->site_logo))
                        <a class="" href="<?php echo $url;?>">
                        	<img src="<?php echo $url.'/local/images/media/settings/'.$setts[0]->site_logo;?>" border="0" alt="<?php echo $setts[0]->site_name;?>" />
                        </a>
                      @else
                        <a class="" href="<?php echo $url;?>"><?php echo $setts[0]->site_name;?></a>
                       @endif
                            
                        </div>
                    </div>

                    <div class="col-lg-10 col-md-12 col-xs-12 no-padding find_freelancer">

                         <!-- freelancer search -->
						<form action="javascript:void(Tawk_API.toggle())" method="get">
						   <div class="freelancer-search-area">
						   <input type="text" class="form-control-sm" placeholder="Find freelancer to get help">
						    <button class="" type="submit"><i class="fa fa-search"></i></button>
						   </div>
						</form>
                        
                         <!-- End freelancer search -->



                        <div class="userboard hidemobile" style="width: 100%">
                            <ul class="board-item">
                                <li class="price-cart"><a class="login_btn" href="javascript:void(0);"><i class="fa fa-shopping-cart"></i> <span><?php echo $cart_views_count;?></span></a>
                                    <ul class="cart-details">
                                        
                                          <?php if(!empty($cart_views_count)){?>
                                <?php 
								
								$price_val=0;
								$ord_id = ""; 
								$item_name = "";
								foreach($cart_views as $item){
								
								 $item_id = $item->item_token; 
								 
								$view_item = DB::table('products')
													->where('item_token','=',$item_id)
													->get();
													
										$ord_id .=	$item->ord_id.',';		
														
														
								if($lang == "en")
								{
								   $texter = "item_id";
								}
								else
								{
								  $texter = "parent";
								}			
								$get_tile = DB::table('products')->where($texter,'=',$item->item_id)->count();	
								if(!empty($get_tile))
								{
								$get_tiles = DB::table('products')->where($texter,'=',$item->item_id)->get();
								$titler = $get_tiles[0]->item_title;	
								}
								else
								{
								$titler = "";
								}								
													?>
                                        <li>
                                            <div class="cart-img">
                                            <?php
														if(!empty($view_item[0]->preview_image)){
														
											?>
                                                <img alt="" src="<?php echo $url;?>/local/images/media/preview/<?php echo $view_item[0]->preview_image;?>">
                                            <?php } else { ?>
                                            <img src="<?php echo $url;?>/local/images/noimage_box.jpg" alt="" >
                                            <?php } ?>    
                                            </div>
                                            <div class="cart-info">
                                                <h4 class="dotted"><a href="<?php echo $url;?>/item/<?php echo $item->item_id;?>/<?php echo $view_item[0]->item_slug;?>"><?php echo $titler;?></a></h4>
                                                <span><?php echo $item->price;?> <?php echo $setts[0]->site_currency;?></span>
                                            </div>
                                            <div class="cart-del">
                                                <a href="<?php echo $url;?>/cart/<?php echo $item->ord_id;?>" onClick="return confirm('Are you sure you want to delete?');"><img src="<?php echo $url;?>/local/images/delete.png" border="0"></a>
                                            </div>
                                        </li>
                                        
                                        <?php $price_val +=$item->price; }  ?>
                                        
                                        
                                        
                                        <li>
                                            <h5><?php echo translate( 286, $lang);?></h5>
                                            <p><?php echo $price_val;?> <?php echo $setts[0]->site_currency;?></p>
                                        </li>
                                        <li>
                                            <a class="btn-filled pull-left" href="<?php echo $url;?>/cart"><?php echo translate( 511, $lang);?></a>
                                            <a class="btn-filled pull-right" href="<?php echo $url;?>/checkout"><?php echo translate( 325, $lang);?></a></li>
                                       <?php } else {  ?>  
                                       
                                       <li>
                                            
                                           <div align="center"> <?php echo translate( 322, $lang);?></div>
                                        </li>
                                        
                                        <?php } ?>   
                                            
                                    </ul>
                                </li>
      @if(Auth::check())
                               

                              
    <li class="dropdown">
    <a href="#" class=" login_btn" data-toggle="dropdown" data-hover="dropdown" data-delay="1000">
       
         @if($setts[0]->site_currency=="USD")
          ${{$user_wallet}}
         @else
           $setts[0]->site_currency
         @endif

           <img style="margin-left: 6px; border-left: 1px solid #fff;height: 36px;
    margin-right: -9px;" src="{{asset('local/images/media/userphoto/')}}/{{Auth::user()->photo}}" alt="User Photo"></a>
  


    </a>

    <ul class="dropdown-menu hidemobile">
	   @if(Auth::user()->admin==1)
	        <li>
	        	<a href="<?php echo $url;?>/dashboard"><?php echo translate( 517, $lang);?></a>
	        </li>
	        
	        <li>
	        	<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><?php echo translate( 520, $lang);?>
	        		
	        	</a>
	        </li>
	        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	            {{ csrf_field() }}
	         </form>
	    @else                                
	        <li>
	        	<a href="<?php echo $url;?>/{{Auth::user()->user_slug}}"><?php echo translate( 517, $lang);?>
	        	</a>
	        </li>
	          <li>
	        	<a href="<?php echo $url;?>/dashboard"><?php echo translate( 424, $lang);?>
	        	</a>
	        </li>
	        
	            
	       <li>
		       	<a href="<?php echo $url;?>/my-items"><?php echo translate( 523, $lang);?>	
		       	</a>
	       </li>
	       
	       <li>
		       	<a href="<?php echo $url;?>/my-shopping"><?php echo translate( 526, $lang);?>
		       	</a>
	       </li>
	       
	       <li>
	       	<a href="<?php echo $url;?>/my-orders"><?php echo translate( 529, $lang);?></a>
	       </li>
	       
	       <li>
		       	<a href="<?php echo $url;?>/my-earnings"><?php echo translate( 532, $lang);?>
		       	</a>
	       </li>
	        
	          <li>
	          	<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><?php echo translate( 520, $lang);?>
	          	</a>
	          </li>
	            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	               {{ csrf_field() }}
	             </form>
	       @endif                      
    </ul>
</li>
                   @else
                    <li>
                    	<a href="<?php echo $url;?>/login" class="login_btn"><i class="fa fa-user"></i> <?php echo translate( 535, $lang);?>
                    	</a>
                    </li>
                   @endif
                                
                                
          
                            </ul>
                        </div>
                    </div>
                    
                    
                    
                </div>
            </div>
        </div>
        <!-- USER AREA END -->
        <?php
		$item_meta_cc = DB::table('product_metas')
		           		  ->where('item_meta_key', '=' , "item_type")
		                  ->where('item_meta_value', '=' , "yes")
				          ->count();
		?>
        <!-- MAIN MENU AREA START -->
        <div class="main-menu-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="main-menu">
                            <nav>
                                <ul id="nav">
                                <li><a href="<?php echo $url;?>/all-items"><?php echo translate( 217, $lang);?></a>
                                            </li>
                              
                                <li>
                                	<a href="<?php echo $url;?>/free-items"><?php echo translate( 64, $lang);?></a>
                                            </li>

                                            
                                   <?php
					$cate_cnts = DB::table('product_categories')
								 ->where('delete_status','=','')
								 ->where('status','=',1)
								 ->where('lang_code','=',$lang)
								 ->where('display_menu','=',1)
								 ->orderBy('cat_name','asc')
								 ->count();
					if(!empty($cate_cnts))
					{
					
					$views_category = DB::table('product_categories')
								 ->where('delete_status','=','')
								 ->where('status','=',1)
								 ->where('lang_code','=',$lang)
								 ->where('display_menu','=',1)
								 ->orderBy('cat_name','asc')
								 ->get();	
					foreach($views_category as $views){	
					if($lang == "en")
						  {
						    $cat_id = $views->id; 
						  }
						  else
						  {
						     $cat_id = $views->parent;
						  }			 		 
					?>
                                     <li><a href="<?php echo $url;?>/search/search/<?php echo $cat_id;?>-cat/<?php echo $views->post_slug;?>"><?php echo $views->cat_name;?></a>
                                        
                                        <?php
					  $subcat_cnt = DB::table('product_subcats')
									->where('delete_status','=','')
									->where('status','=',1)
									
									->where('cat_id','=',$cat_id)
									->where('lang_code','=',$lang)
									->orderBy('subid','asc')
									->count();
					  if(!empty($subcat_cnt))
					  {	
					  
					  $viewsub = DB::table('product_subcats')
									->where('delete_status','=','')
									->where('status','=',1)
									
									->where('cat_id','=',$cat_id)
									->where('lang_code','=',$lang)
									->orderBy('subid','asc')
									->get();
					  
					  		
					  ?><ul class="sub-menu">
                      <?php foreach($viewsub as $subs){
					  if($lang == "en")
						  {
						    $subcat_id = $subs->subid; 
						  }
						  else
						  {
						     $subcat_id = $subs->parent;
						  }	
					  ?>
                                            <li><a href="<?php echo $url;?>/search/search/<?php echo $subcat_id;?>-subcat/<?php echo $subs->post_slug;?>"><?php echo $subs->subcat_name;?></a>
                                            </li>
                                        <?php } ?>    
                                           
                                        </ul>
                                    </li>
                                     <?php } } } ?>
                                    
                                    
                                     <?php if(!empty($pages_cnt)){
									 $colname = "main-menu";
									 $pages = DB::table('pages')
									          ->where('lang_code', '=', $lang)
									          ->whereRaw('FIND_IN_SET(?,menu_position)', [$colname])
                                              ->orderBy('menu_order','asc')
					                          ->get();
									 ?>
                                  <li><a href="javascript:void(0)"><?php echo translate( 538, $lang);?></a>    
                                  <ul class="sub-menu">   
                                <?php foreach($pages as $page){
								
								if($lang == "en")
						  {
						    $page_id = $page->page_id; 
						  }
						  else
						  {
						     $page_id = $page->parent;
						  }
								
								if($page_id==4){ $pagerurl = $url.'/'.'contact-us'; }
								
								else { $pagerurl = $url.'/page/'.$page->post_slug; }
								?>
                                
                                <li><a href="<?php echo $pagerurl; ?>"><?php echo $page->page_title;?></a></li>
                                <?php } ?>
                                <?php if($site_verify_purchase=="off"){?><li><a href="<?php echo $url;?>/verify-purchase"><?php echo translate( 1248, $lang);?></a></li><?php } ?>
                                </ul>
                                <?php } ?>
                                
                                </li>
                                
                                
                                <?php if($setts[0]->site_blog_visible=="yes"){?><li><a href="<?php echo $url;?>/blog"><?php echo translate( 226, $lang);?></a></li><?php } ?>
                                    
                                </ul>
                            </nav>
                            <!-- Menu Item End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
    </header>






