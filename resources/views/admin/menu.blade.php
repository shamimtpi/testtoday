<?php
use Illuminate\Support\Facades\Route;
$currentPaths= Route::getFacadeRoot()->current()->uri();	
$url = URL::to("/");

/*$ncounts = DB::table('users')->get();
		foreach($ncounts as $well)
		{
			$we = $well->id;
			$ewe = $well->email;
			DB::update('update shop set user_id="'.$we.'" where seller_email = ?', [$ewe]);
		}*/
$logid = Auth::user()->id;

$user_checkker = DB::select('select * from users where id = ?',[$logid]);

$hidden = explode(',',$user_checkker[0]->show_menu);
?>	
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                
                <ul class="nav side-menu">
                <?php  if (in_array(1, $hidden)){?>
                  <li><a href="<?php echo $url;?>/admin"><i class="fa fa-laptop"></i> Dashboard </a></li>
                 <?php }  ?> 
                 
                 <?php if(Auth::user()->admin==1 && Auth::user()->id==1) {?>
                  <li><a href="<?php echo $url;?>/admin/verify-purchase-code"><i class="fa fa-cog"></i> Verify Purchase Code </a></li>
                  <?php } ?>
				   
                  <?php  if (in_array(2, $hidden)){?> 
                   <li><a><i class="fa fa-cog"></i> Settings <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo $url;?>/admin/settings">General Settings </a></li>
                      <li><a href="<?php echo $url;?>/admin/media-settings">Media Settings </a></li>
                       <li><a href="<?php echo $url;?>/admin/email-settings">Email Settings </a></li>
                       <li><a href="<?php echo $url;?>/admin/payment-settings">Payment Settings </a></li>
                       <li><a href="<?php echo $url;?>/admin/badges-settings">Badges Settings </a></li>
                       <li><a href="<?php echo $url;?>/admin/cookies-settings">Cookies Settings </a></li>
                      
                    </ul>
                  </li>
                  <?php }  ?> 
                  
                  <?php if(Auth::user()->admin==1 && Auth::user()->id==1) {?>
				   <li><a href="<?php echo $url;?>/admin/administrators"><i class="fa fa-user"></i> Administrators </a></li>
				  <?php } ?>
                  
                  <?php  if (in_array(3, $hidden)){?>
                  <li><a href="<?php echo $url;?>/admin/users"><i class="fa fa-user"></i> Users </a></li>
                  <?php }  ?>
                  
                  <?php  if (in_array(4, $hidden)){?>
                  <li><a href="<?php echo $url;?>/admin/currency"><i class="fa fa-sticky-note"></i> Currency </a></li>
                  <?php }  ?>
                  
                  <?php  if (in_array(5, $hidden)){?>
                  <li><a href="<?php echo $url;?>/admin/country"><i class="fa fa-sticky-note"></i> Country </a></li>
                  <?php }  ?> 
				  
				  
                 
                  
                  <?php  if (in_array(6, $hidden)){?>
                  <li><a><i class="fa fa-cog"></i> Category <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo $url;?>/admin/category">Category </a></li>
                      <li><a href="<?php echo $url;?>/admin/subcategory">Sub Category </a></li>
                     
                    </ul>
                  </li>
                  <?php }  ?> 
                  
                  <?php  if (in_array(7, $hidden)){?>
                  <li><a><i class="fa fa-cog"></i> Framework Category <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo $url;?>/admin/framework_category">Category </a></li>
                      <li><a href="<?php echo $url;?>/admin/framework_subcategory">Sub Category </a></li>
                     
                    </ul>
                  </li>
                   <?php }  ?> 
                  
                  <?php  if (in_array(8, $hidden)){?>
                  <li><a><i class="fa fa-shopping-cart"></i> Items <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo $url;?>/admin/products">Items </a></li>
                      <li><a href="<?php echo $url;?>/admin/orders"> Order Details </a></li>
                     <li><a href="<?php echo $url;?>/admin/refund"> Dispute Refund </a></li>
                     <li><a href="<?php echo $url;?>/admin/rating"> Ratings & Reviews </a></li>
                     <li><a href="<?php echo $url;?>/admin/report"> Report Items</a></li>
                    </ul>
                  </li>
                  <?php }  ?> 
                  
                  <?php  if (in_array(9, $hidden)){?>
                   <li><a href="<?php echo $url;?>/admin/withdraw"><i class="fa fa-sticky-note"></i> Withdraw </a></li>
                  <?php }  ?>
                 
                 <?php  if (in_array(10, $hidden)){?>
                  <li><a href="<?php echo $url;?>/admin/promo"><i class="fa fa-sticky-note"></i> Promo Box </a></li>
                   <?php }  ?>
				  
                  <?php  if (in_array(11, $hidden)){?>
				  <li><a href="<?php echo $url;?>/admin/blog"><i class="fa fa-comments"></i> Blog </a></li>
                  <?php }  ?>
                  
                  <?php  if (in_array(12, $hidden)){?>
                  <li><a href="<?php echo $url;?>/admin/pages"><i class="fa fa-sticky-note"></i> Pages </a></li>
                   <?php }  ?>
                 
                   
                   
                   <?php  if (in_array(13, $hidden)){?>
                   <li><a href="<?php echo $url;?>/admin/newsletter"><i class="fa fa-user"></i> Newsletter </a></li>
                   <?php }  ?>
                  
                  <?php  if (in_array(14, $hidden)){?>
				   <li><a href="<?php echo $url;?>/admin/contact"><i class="fa fa-user"></i> Contact Us </a></li>
				    <?php }  ?>
                   
                   
                   <?php  if (in_array(15, $hidden)){?>
                     <li><a href="<?php echo $url;?>/admin/translate"><i class="fa fa-sticky-note"></i> Translate </a></li>    
				     <?php }  ?>
                    
                     <?php  if (in_array(16, $hidden)){?>
				   <li><a href="<?php echo $url;?>/admin/language"><i class="fa fa-sticky-note"></i> Language </a></li>
				   <?php }  ?>
				  
				  
                  
                </ul>
              </div>

            </div>
			
			
			