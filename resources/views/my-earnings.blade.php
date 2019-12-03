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
	<title><?php echo translate( 25, $lang);?> - <?php echo translate( 532, $lang);?></title>




</head>
<body class="index">

    
    <!-- fixed navigation bar -->
    @include('header')

    
    <div class="promo-area" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $setts[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="promo-text">
                    
                        <h2 class="avigher-title bolder fontsize30"><?php echo translate( 532, $lang);?></h2>
                        
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
                       
                        <li class="breadcrumb-item active"><?php echo translate( 532, $lang);?></li>
                       
                    </ol>
                </div>
            </div>
        </div>
    </div> 
    

	
    
	
	
	
	
	
	
	<main class="checkout-area main-content">
<div class="clearfix height20"></div>
        <div class="container">


<div class="row">
                     <div class="col-md-12 col-sm-12">
                    @if(Session::has('wsuccess'))

	    <p class="alert alert-success">

	      {{ Session::get('wsuccess') }}

	    </p>

	@endif


	
	
 	@if(Session::has('werror'))

	    <p class="alert alert-danger">

	      {{ Session::get('werror') }}

	    </p>

	@endif
    </div>
    </div>


    <div class="row">
	
	
	
	<div class="container">

                	
	 
	 
	 
	 
	 	
	
	
		
	<div class="height20 clearfix"></div>
                    
                    
                    
	<div class="col-md-9">
	
	
	
	 
	
	
	
	
	
	
	<div><?php echo translate( 676, $lang);?> : <?php if(!empty($get_users_stage1[0]->referral_amount)){ echo $get_users_stage1[0]->referral_amount; } else { echo "0"; } ?> <?php echo $site_setting[0]->site_currency;?></div>
	<div class="col-md-12 wallet_border">
	
    
    
	<div class="gallerybox_new clearfix">
			
            
            
            
            
            
			
			<div class="para_pads">
			
			<div class="bottombordr">
            
            
            <div class="col-md-8 text-center review_bottom">
            <div class="height30"></div>
			<span class="min_with black"><?php echo translate( 679, $lang);?> : <?php echo $site_setting[0]->site_currency;?> <?php if(!empty($site_setting[0]->withdraw_amt)){ echo $site_setting[0]->withdraw_amt; } else { ?>0<?php } ?></span>
			</div>
            
            
			<div class="col-md-4 text-center review_bottom_two">
			<span class="fontsize35 black"><?php echo $get_users_stage1[0]->wallet;?> <?php echo $site_setting[0]->site_currency;?></span>
			<div class="re_text fontsize20 black"><?php echo translate( 682, $lang);?></div>
			<div class="smalltxt fontsize11 black"><?php echo translate( 685, $lang);?></div>
			
			</div>
			
			
			
			
			<div class="clearfix"></div>
			</div>
			
			
			
			
			
			
			
			</div>
		
		
		
		</div>
	
	
	
	</div>
	
	
	
	
	
	</div>
	
	
	
	<div class="col-md-3">
	<form role="form" method="POST" action="{{ route('my-earnings') }}" id="formwithdraw" class="register-form" enctype="multipart/form-data">
        {{ csrf_field() }}
         <div class="form-group">
            <p class="black"><?php echo translate( 688, $lang);?> :</p>
            <input type="text" class="form-control unicase-form-control validate[required] radiusoff" id="withdraw_amount" name="withdraw_amount">
          </div>
          
          <input type="hidden" name="available_amount" value="<?php echo $get_users_stage1[0]->wallet;?>">
          
          <div class="form-group">
            <p class="black"><?php echo translate( 691, $lang);?> :</p>
            
            <select id="withdraw_type" name="withdraw_type" class="form-control unicase-form-control radiusoff validate[required]" onChange="javascript:withdraw_checking(this.value);">
					<option value=""><?php echo translate( 97, $lang);?></option>
						<?php 
						
						foreach($site_setting as $row)
						{
							$catid=$row->withdraw_option;
							$selected= explode(",",$catid); 
							$length= count($selected);
							for($i=0;$i<$length;$i++)
							{
								 $ader_cat= $selected[$i];
							
						?>
						<option value="<?php echo $ader_cat; ?>" ><?php echo $ader_cat; ?></option>
						<?php 
						} }
						?> 
					</select>
            
          </div>
          
          <div class="form-group" id="paytm" style="display:none;">
            <p class="black"><?php echo translate( 694, $lang);?> :</p>
          
             <input type="text" class="form-control unicase-form-control validate[required] text-input" id="paytm_id" name="paytm_id">	
          </div>
          
          <div class="form-group" id="paypal" style="display:none;">
            <p class="black"><?php echo translate( 697, $lang);?> :</p>
          
             <input type="text" class="form-control unicase-form-control validate[required] text-input" id="paypal_id" name="paypal_id">	
          </div>
          
          
          <div class="form-group" id="perfectmoney" style="display:none;">
            <p class="black"><?php echo translate( 1221, $lang);?> :</p>
          
             <input type="text" class="form-control unicase-form-control validate[required] text-input" id="perfectmoney" name="perfectmoney">	
          </div>
          
          
          
           <div class="form-group" id="stripe" style="display:none;">
            <p class="black"><?php echo translate( 700, $lang);?> :</p>
          
             <input type="text" class="form-control unicase-form-control validate[required] text-input" id="stripe_id" name="stripe_id">	
          </div>
          
          
          
          <div id="localbank" style="display:none;">
           
             <div class="form-group">
				<p class="black"><?php echo translate( 703, $lang);?>	</p>
					<input type="text" class="form-control unicase-form-control validate[required] text-input" id="bank_acc_no" name="bank_acc_no">
					
                    </div>
                    
                     <div class="form-group">
                    			
					
					<p class="black"><?php echo translate( 706, $lang);?></p>
					<input type="text" class="form-control unicase-form-control validate[required] text-input" id="bank_name" name="bank_name">
									
                              </div>
                              
                               <div class="form-group">      
                                    
					
					<p class="black"><?php echo translate( 709, $lang);?></p>
					<input type="text" class="form-control unicase-form-control validate[required] text-input" id="ifsc_code" name="ifsc_code">	
										

			</div>
            
            </div>
          
          
          
          
	 <div class="form-group">
          <input type="submit" name="submit" class="btn-upper custom-btn" value="<?php echo translate( 253, $lang);?>">
          </div>          
    </form>
	</div>
	
	
	
	
                    
                    
	
    
    
	</div>
	
	
	
	
	
    
    <div class="clearfix height100"></div>
    
    
    
    <div class="container-fluid">

                	<div class="col-md-12"> <div class="fontsize24 black"><?php echo translate( 712, $lang);?></div></div>
     <div class="clearfix height50"></div>
    <div class="col-md-12">
                                <div class="table-responsive">
		                         <table class="table">
                                    <thead>
                                        <tr class="balance_heading">
                                            <th><?php echo translate( 655, $lang);?></th>
											<th><?php echo translate( 715, $lang);?></th>
											<th><?php echo translate( 718, $lang);?></th>
                                            <th><?php echo translate( 1224, $lang);?></th>
											<th><?php echo translate( 721, $lang);?></th>
                                            <th><?php echo translate( 724, $lang);?></th>
                                            <th><?php echo translate( 727, $lang);?></th>
                                            <th><?php echo translate( 703, $lang);?></th>
                                            <th><?php echo translate( 730, $lang);?></th>
                                            <th><?php echo translate( 709, $lang);?></th>
                                            <th><?php echo translate( 664, $lang);?></th>
										
                                        </tr>
                                    </thead>
									<tbody>
										<?php if(!empty($complete_withdraw_cnt)){?>
                                        <?php
										$complete_withdraw = DB::table('product_widthrows')
		                        							->where('user_id','=', $logged)
		          											->get(); 
										$i=1;
										foreach($complete_withdraw as $view_withdraw){?>								
										<tr>
											<td><?php echo $i;?></td>
											<td><?php echo $view_withdraw->withdraw_amount.' '.$site_setting[0]->site_currency;?></td>
											<td><?php echo $view_withdraw->withdraw_payment_type;?></td>
                                            <td><?php echo $view_withdraw->perfectmoney_id;?></td>
											<td><?php echo $view_withdraw->paypal_id;?></td>	
												
											<td><?php echo $view_withdraw->stripe_id;?></td>
                                            <td><?php echo $view_withdraw->paytm_no;?></td>												
											<td><?php echo $view_withdraw->bank_account_no;?></td>
                                            <td><?php echo $view_withdraw->bank_info;?></td>
                                            <td><?php echo $view_withdraw->bank_ifsc;?></td>
                                            <?php if($view_withdraw->withdraw_status=="pending"){ $clrd = "red"; } else { $clrd = "green"; } ?>
                                            <td style="color:<?php echo $clrd;?>;"><?php echo $view_withdraw->withdraw_status;?></td>
										</tr>
                                       <?php $i++; } ?> 
									<?php } ?>			
									</tbody>
															
                                </table>
                            </div>
                            </div>
    
    </div>
    
    
    
  
    
    
    
	
	
	
	</div>
</div>
<div class="clearfix"></div>
</main>
	
	

	
	
	
	

      @include('footer')
 
       
</body>
</html>