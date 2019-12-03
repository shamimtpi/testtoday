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
	<title><?php echo translate( 25, $lang);?> - <?php echo translate( 487, $lang);?></title>




</head>
<body class="index">

    

    <!-- fixed navigation bar -->
    @include('header')

    
     
    

	
    <div class="promo-area" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $settings[0]->site_banner;?>)">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="promo-text">
                        <h2 class="avigher-title bolder fontsize30"><?php echo translate( 487, $lang);?></h2>
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
                        <li class="breadcrumb-item active"><?php echo translate( 487, $lang);?></li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
	
	
	
	

      <main class="checkout-area main-content">

        <div class="container">

<div class="row">
@if(Session::has('success'))

	    <div class="alert alert-success">

	      {{ Session::get('success') }}

	    </div>

	@endif


	
	
 	@if(Session::has('error'))

	    <div class="alert alert-danger">

	      {{ Session::get('error') }}

	    </div>

	@endif


</div>



    <div class="row">
	
	
	
	
	<div class="table-responsive">
        
       
        <div class="text-center">   
	<div class="clearfix height10"></div>
	<div class="h4 black">
    
    <label class="black"><?php echo translate( 283, $lang);?></label> : <?php echo $amount; ?> <?php echo $currency; ?><br/><br/>
    <label class="black">	<?php echo translate( 481, $lang);?></label> : <?php echo $duration; ?> <?php echo translate( 484, $lang);?>
	</div>
	<div class="clear height20"></div>
    
    <?php if($payment_type=="paypal"){?>
    <form action="<?php echo $paypal_url; ?>" method="post">

        <!-- Identify your business so that you can collect the payments. -->
        <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
        
        <!-- Specify a Buy Now button. -->
        <input type="hidden" name="cmd" value="_xclick">
        
        <!-- Specify details about the item that buyers will purchase. -->
        <input type="hidden" name="item_name" value="<?php echo $item_name;?>">
        <input type="hidden" name="item_number" value="<?php echo $item_number;?>">
        <input type="hidden" name="amount" value="<?php echo $amount; ?>">
        <input type="hidden" name="currency_code" value="<?php echo $currency; ?>">
        
        <!-- Specify URLs -->
        <input type='hidden' name='cancel_return' value='<?php echo $url;?>/cancel'>
		<input type='hidden' name='return' value='<?php echo $url;?>/feature_success/<?php echo $item_number;?>'>
		<input type="submit" name="submit" value="<?php echo translate( 958, $lang);?>" class="btn-upper btn btn-primary" style="max-width:120px;">
     
    
    </form>
	<?php } if($payment_type=="stripe"){
		$fprice = $amount * 100;
		?>
        
        <form action="{{ route('stripe_shop_success') }}" method="POST">
	{{ csrf_field() }}
	
	<input type="hidden" name="item_number" value="<?php echo $item_number;?>">
	<input type="hidden" name="amount" value="<?php echo $fprice; ?>">
	<input type="hidden" name="currency_code" value="<?php echo $currency; ?>">
	<input type="hidden" name="item_name" value="<?php echo $item_name;?>">
		<script src="https://checkout.stripe.com/checkout.js" 
		class="stripe-button" 
		<?php if($setts[0]->stripe_mode=="test") { ?>
		data-key="<?php echo $setts[0]->test_publish_key; ?>" <?php } ?>
		<?php if($setts[0]->stripe_mode=="live") {  ?>
		data-key="<?php echo $setts[0]->live_publish_key; ?>" 
		<?php }?> 
		data-image="<?php echo $url.'/local/images/media/settings/'.$setts[0]->site_logo;?>" 
		data-name="<?php echo $item_name;?>" 
		data-description="<?php echo $setts[0]->site_name;?>"
		data-amount="<?php echo $fprice; ?>"
		data-currency="<?php echo $currency; ?>"
		/>
		</script>
	</form>
	<?php } ?>
    
    
    
    
     <?php if($payment_type=="razorpay"){?>
    
    
    <?php if($currency=="INR"){?><input type="button" name="submit" value="<?php echo translate( 958, $lang);?>" id="rzp-button1" class="custom-btn customwidth">
    <?php }
		else { ?><span class="red">( <?php echo translate( 802, $lang);?> )</span> <?php } ?>
	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    
    <form class="register-form" name='razorpayform' role="form" method="POST" action="{{ route('rozarpay_shop_success') }}" id="formID" enctype="multipart/form-data">
    {{ csrf_field() }}
    
        <input type="hidden" name="order_id" value="<?php echo $item_number;?>"/>
        <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
        <input type="hidden" name="razorpay_signature"  id="razorpay_signature" >
        
    </form>
    <script>
    
    var options = <?php echo $json_value?>;
    
    
    options.handler = function (response){
	     
        document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
        document.getElementById('razorpay_signature').value = response.razorpay_signature;
        document.razorpayform.submit();
    };
    
    
    options.theme.image_padding = false;
    
    options.modal = {
        ondismiss: function() {
            console.log("This code runs when the popup is closed");
        },
        
        escape: true,
       
        backdropclose: false
    };
    
    var rzp = new Razorpay(options);
    
    document.getElementById('rzp-button1').onclick = function(e){
        rzp.open();
        e.preventDefault();
    }
    </script>
    

        
    
    <?php } ?>
    
    
    
    
    
    
    <?php if($payment_type=="paytm"){
	
	$user_details = DB::table('users')
		->where('id', '=', Auth::user()->id)
		->get();
	?>
     <?php if($currency=="INR"){?>
    <form action="{{ url('featured_paytm_details') }}" class="form-image-upload" method="POST" enctype="multipart/form-data">
    {!! csrf_field() !!}
    
    <input id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" type="hidden" value="<?php echo $item_number;?>">
    <input id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" type="hidden" value="<?php echo $user_details[0]->id;?>">
    <input id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" type="hidden" value="Retail">
    <input id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" type="hidden" value="WEB">
    <input title="TXN_AMOUNT" tabindex="10" type="hidden" name="TXN_AMOUNT" value="<?php echo $amount; ?>">
                       
    <input type="submit" name="submit" value="<?php echo translate( 958, $lang);?>" class="custom-btn customwidth">
    </form>
    <?php } else {?>
    <span class="red">( <?php echo translate( 799, $lang);?> )</span>
    
    
    
    <?php } } ?>
    
    
       
    </div>
        
        
        
	</div>
	
	
	
	</div>
</div>
<div class="clearfix"></div>
</main>
	

      @include('footer')
</body>
</html>