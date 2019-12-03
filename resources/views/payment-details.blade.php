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

    
    <div class="promo-area" style="background-image: url(<?php echo $url;?>/local/images/media/settings/<?php echo $setts[0]->site_banner;?>)">
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
<div class="clearfix height20"></div>
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
	
	
	
	
	 <div class="text-center">   
	<div class="clearfix height30"></div>
	<div class="h4 black">
    <label class="black"><?php echo translate( 796, $lang);?></label> : <?php echo $amount; ?> <?php echo $currency; ?>
	</div>
	<div class="clear height20"></div>
     <?php 
	if(!empty($view_count))
	{
	$view_orders = DB::table('product_orders')
						->where('purchase_token', '=', $order_no)
						->get();
	$item_name = "";
	foreach($view_orders as $views)
	{
	$item_name .= $views->item_name.',';
	}
	$item_namer = rtrim($item_name,',');					
	?>
    
    
    <?php } else { $item_namer = ""; } ?>
    
    
    <?php if($payment_type=="perfectmoney"){
	
	/* perfect money */
		
		 $check_perfect_salt = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 90)
				->where('sett_meta_key', '=' , "perfectmoney_id")
		        
				->count();
		if(!empty($check_perfect_salt))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 90)
				->where('sett_meta_key', '=' , "perfectmoney_id")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 90)
				->where('sett_meta_key', '=' , "perfectmoney_id")
		        
				->get();
			$perfectmoney_id = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$perfectmoney_id = "";
			}	
		}
		else
		{
		  $perfectmoney_id = "";
		}
		
		
		
		
		$check_perfect_name = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 91)
				->where('sett_meta_key', '=' , "perfectmoney_name")
		        
				->count();
		if(!empty($check_perfect_name))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 91)
				->where('sett_meta_key', '=' , "perfectmoney_name")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 91)
				->where('sett_meta_key', '=' , "perfectmoney_name")
		        
				->get();
			$perfectmoney_name = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$perfectmoney_name = "";
			}	
		}
		else
		{
		  $perfectmoney_name = "";
		}
		
		
		/* perfect money */		 
		
		
		?>
	
    <form action="https://perfectmoney.is/api/step1.asp" method="POST">
    <input type="hidden" name="PAYEE_ACCOUNT" value="<?php echo $perfectmoney_id;?>">
    <input type="hidden" name="PAYEE_NAME" value="<?php echo $perfectmoney_name;?>">
    <input type="hidden" name="PAYMENT_AMOUNT" value="<?php echo $amount; ?>">
    <input type="hidden" name="PAYMENT_UNITS" value="<?php echo $setts[0]->site_currency;?>">
    <input type="hidden" name="PAYMENT_ID" value="<?php echo $order_no;?>">
    <input type="hidden" name="STATUS_URL" value="<?php echo $url;?>/perfectmoney_status">
    <input type="hidden" name="PAYMENT_URL" value="<?php echo $url;?>/perfectmoney_success">
    <input type="hidden" name="PAYMENT_URL_METHOD" value="POST">
    <input type="hidden" name="NOPAYMENT_URL" value="<?php echo $url;?>/cancel">
    <input type="hidden" name="NOPAYMENT_URL_METHOD" value="POST">
    <input type="hidden" name="BAGGAGE_FIELDS" value="">
    <input type="hidden" name="SUGGESTED_MEMO" value="">
    <input type="hidden" name="SUGGESTED_MEMO_NOCHANGE" value="">
    <input type="hidden" name="FORCED_PAYER_ACCOUNT" value="">
    <input type="hidden" name="AVAILABLE_PAYMENT_METHODS" value="all">
    <input type="hidden" name="INTERFACE_LANGUAGE" value="en_US">
    <input type="submit" name="submit" value="<?php echo translate( 958, $lang);?>" class="custom-btn customwidth">
    </form>
    
    
    
    <?php } ?>
    
    
    
    
    <?php if($payment_type=="payu"){
	
	$user_details = DB::table('users')
		->where('id', '=', Auth::user()->id)
		->get();
		$check_payu_website = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 60)
				->where('sett_meta_key', '=' , "payu_mode")
		        
				->count();
		if(!empty($check_payu_website))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 60)
				->where('sett_meta_key', '=' , "payu_mode")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 60)
				->where('sett_meta_key', '=' , "payu_mode")
		        
				->get();
			$payu_mode = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$payu_mode = "";
			}	
		}
		else
		{
		  $payu_mode = "";
		}
	  
	  
	  
	  
	    $check_payu_merchant = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 61)
				->where('sett_meta_key', '=' , "payu_merchant_key")
		        
				->count();
		if(!empty($check_payu_merchant))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 61)
				->where('sett_meta_key', '=' , "payu_merchant_key")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 61)
				->where('sett_meta_key', '=' , "payu_merchant_key")
		        
				->get();
			$payu_merchant_key = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$payu_merchant_key = "";
			}	
		}
		else
		{
		  $payu_merchant_key = "";
		}
	  
	  
	  
	    $check_payu_salt = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 62)
				->where('sett_meta_key', '=' , "payu_salt")
		        
				->count();
		if(!empty($check_payu_salt))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 62)
				->where('sett_meta_key', '=' , "payu_salt")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 62)
				->where('sett_meta_key', '=' , "payu_salt")
		        
				->get();
			$payu_salt = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$payu_salt = "";
			}	
		}
		else
		{
		  $payu_salt = "";
		}
	  
	  if($payu_mode=='live'){ $action = 'https://secure.payu.in/_payment'; } 
		if($payu_mode=='test'){ $action = 'https://test.payu.in/_payment'; }
		$merchant = $payu_merchant_key;
		$salt = $payu_salt;
		$txnid = substr(hash('sha256', mt_rand() . microtime()), 0, 20);
		$email = $user_details[0]->email;
        $name = $user_details[0]->name;
		$phone = $user_details[0]->phone;
		$hash_string = $merchant."|".$txnid."|".$amount."|".$item_namer."|".$name."|".$email."|||||||||||".$salt;
		$hash = strtolower(hash('sha512', $hash_string));
		$success_url = $url.'/payu_success/'.$order_no.'/'.$txnid;
		$fail_url = $url.'/payu_failed/'.$order_no;
		
		?>
    
    <form action="<?php echo $action; ?>" method="post" name="payuForm" id="payuForm">
	{{ csrf_field() }}
	<input type="hidden" name="cid" value="<?php echo $order_no;?>">
    <input type="hidden" name="key" value="<?php echo $merchant ?>" />
    <input type="hidden" name="hash" value="<?php echo $hash ?>"/>
    <input type="hidden" name="txnid" value="<?php echo $txnid ?>" />
    <input name="amount" type="hidden" value="<?php echo $amount; ?>" />
    <input type="hidden" name="firstname" id="firstname" value="<?php echo $name; ?>" />
    <input type="hidden" name="email" id="email" value="<?php echo $email; ?>" />
    <input type="hidden" name="phone" value="<?php echo $phone; ?>" />
    <input type="hidden" name="productinfo" value="<?php echo $item_namer; ?>">
    <input type="hidden" name="surl" value="<?php echo $success_url; ?>" />
    <input type="hidden" name="furl" value="<?php echo  $fail_url?>"/>
    <input type="hidden" name="service_provider" value=""/>
    <input type="submit" name="submit" value="<?php echo translate( 958, $lang);?>" class="custom-btn customwidth">
    </form>
    
    
    <?php } ?>
    
    
    
    
    
    
    
    
    <?php if($payment_type=="2checkout"){
	
	$user_details = DB::table('users')
		->where('id', '=', Auth::user()->id)
		->get();
		
	$check_2checkout_acc = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 31)
				->where('sett_meta_key', '=' , "two_checkout_account")
		        
				->count();
		if(!empty($check_2checkout_acc))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 31)
				->where('sett_meta_key', '=' , "two_checkout_account")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 31)
				->where('sett_meta_key', '=' , "two_checkout_account")
		        
				->get();
			$two_checkout_account = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$two_checkout_account = "";
			}	
		}
		else
		{
		  $two_checkout_account = "";
		}
		
	$check_2checkout_publish = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 32)
				->where('sett_meta_key', '=' , "two_checkout_publishable")
		        
				->count();
		if(!empty($check_2checkout_publish))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 32)
				->where('sett_meta_key', '=' , "two_checkout_publishable")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 32)
				->where('sett_meta_key', '=' , "two_checkout_publishable")
		        
				->get();
			$two_checkout_publishable = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$two_checkout_publishable = "";
			}	
		}
		else
		{
		  $two_checkout_publishable = "";
		}
				
	?>
     <script type="text/javascript" src="https://www.2checkout.com/checkout/api/2co.min.js"></script>
     <script>
            // Called when token created successfully.
            var successCallback = function(data) {
                var myForm = document.getElementById('myCCForm');

                // Set the token as the value for the token input
                myForm.token.value = data.response.token.token;

                // IMPORTANT: Here we call `submit()` on the form element directly instead of using jQuery to prevent and infinite token request loop.
                myForm.submit();
            };

            // Called when token creation fails.
            var errorCallback = function(data) {
                if (data.errorCode === 200) {
                    tokenRequest();
                } else {
                    alert(data.errorMsg);
                }
            };

            var tokenRequest = function() {
                // Setup token request arguments
                var args = {
                    sellerId: "<?php echo $two_checkout_account;?>",
                    publishableKey: "<?php echo $two_checkout_publishable;?>",
                    ccNo: $("#ccNo").val(),
                    cvv: $("#cvv").val(),
                    expMonth: $("#expMonth").val(),
                    expYear: $("#expYear").val()
                };

                // Make the token request
                TCO.requestToken(successCallback, errorCallback, args);
            };

            $(function() {
                // Pull in the public encryption key for our environment
                TCO.loadPubKey('sandbox');

                $("#myCCForm").submit(function(e) {
                    // Call our token request function
                    tokenRequest();

                    // Prevent form from submitting
                    return false;
                });
            });
        </script>
    <div class="col-md-3"></div>
    <div class="col-md-6">
    <form id="myCCForm" action="{{ url('two_checkout_payment') }}" class="form-image-upload" method="POST" enctype="multipart/form-data">
            {!! csrf_field() !!}
            <input id="token" name="token" type="hidden" value="">
            <input type="hidden" name="order_id" value="<?php echo $order_no;?>"/>
            <input type="hidden" name="amount" value="<?php echo $amount; ?>">
            <input type="hidden" name="city" value="<?php echo $bill_city; ?>">
            <input type="hidden" name="state" value="<?php echo $bill_state; ?>">
            <input type="hidden" name="country" value="<?php echo $bill_country; ?>">
            <input type="hidden" name="postcode" value="<?php echo $bill_postcode; ?>">
            <input type="hidden" name="address" value="<?php echo $bill_address;?>"> 
            
            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                    <label class="info-title black" for="exampleInputName"><?php echo translate( 1078, $lang);?> <span class="red">*</span></label>
                                        <input id="ccNo" type="text" size="20" value="" autocomplete="off" required />
                                    </div>
                                </div>
                                
                            </div>
                       <div class="row">
                       <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title black" for="exampleInputName"><?php echo translate( 1081, $lang);?> <span class="red">*</span></label>
                                        <input type="text" size="2" id="expMonth" required />
                                    </div>
                                </div>
                                
                                
                                <div class="col-sm-6">
                                    <div class="form-group">
                                    <label class="info-title black" for="exampleInputName"><?php echo translate( 1084, $lang);?> <span class="red">*</span></label>
                                        <input type="text" size="2" id="expYear" required />
                                    </div>
                                </div>
                                </div>     
            <div class="row">
                       <div class="col-sm-12">
                                    <div class="form-group">
                                    <label class="info-title black" for="exampleInputName"><?php echo translate( 1087, $lang);?> <span class="red">*</span></label>
                                        <input id="cvv" size="4" type="text" value="" autocomplete="off" required />
                                    </div>
                                </div>
                                </div>
           
            <div class="row">
            <div class="col-sm-12">
            <input type="submit" value="<?php echo translate( 958, $lang);?>" class="custom-btn customwidth">
            </div>
            </div>
        </form>
    </div>
    <div class="col-md-3"></div>
    <?php } ?>
    
    <?php if($payment_type=="paytm"){
	
	$user_details = DB::table('users')
		->where('id', '=', Auth::user()->id)
		->get();
	?>
     <?php if($currency=="INR"){?>
    <form action="{{ url('paytm_details') }}" class="form-image-upload" method="POST" enctype="multipart/form-data">
    {!! csrf_field() !!}
    
    <input id="ORDER_ID" tabindex="1" maxlength="20" size="20" name="ORDER_ID" type="hidden" value="<?php echo $order_no;?>">
    <input id="CUST_ID" tabindex="2" maxlength="12" size="12" name="CUST_ID" type="hidden" value="<?php echo $user_details[0]->id;?>">
    <input id="INDUSTRY_TYPE_ID" tabindex="4" maxlength="12" size="12" name="INDUSTRY_TYPE_ID" type="hidden" value="Retail">
    <input id="CHANNEL_ID" tabindex="4" maxlength="12" size="12" name="CHANNEL_ID" type="hidden" value="WEB">
    <input title="TXN_AMOUNT" tabindex="10" type="hidden" name="TXN_AMOUNT" value="<?php echo $amount; ?>">
    
                        <?php /*?><input type="hidden" name="name" value="<?php echo $user_details[0]->name;?>">
                   
                        <input type="hidden" name="mobile_number" value="<?php echo $user_details[0]->phone;?>">
                        
                        <input type="hidden" name="email" value="<?php echo $user_details[0]->email;?>">
                        <input type="hidden" name="amount" value="<?php echo $amount; ?>"/>
                        <input type="hidden" name="currency" value="<?php echo $currency; ?>"/>
                   
                   <input type="hidden" name="address" value="<?php echo $user_details[0]->address;?>">
                     <input type="hidden" name="order_id" value="<?php echo $order_no;?>"/><?php */?>   
                    
                           
    <input type="submit" name="submit" value="<?php echo translate( 958, $lang);?>" class="custom-btn customwidth">
    </form>
    <?php } else {?>
    <span class="red">( <?php echo translate( 799, $lang);?> )</span>
    
    
    
    <?php } } ?>
    
    
    
    <?php if($payment_type=="razorpay"){?>
    
    
    <?php if($currency=="INR"){?><input type="button" name="submit" value="<?php echo translate( 958, $lang);?>" id="rzp-button1" class="custom-btn customwidth">
    <?php }
		else { ?><span class="red">( <?php echo translate( 802, $lang);?> )</span> <?php } ?>
	<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
    
    <form class="register-form" name='razorpayform' role="form" method="POST" action="{{ route('razorpay_verify') }}" id="formID" enctype="multipart/form-data">
    {{ csrf_field() }}
    
        <input type="hidden" name="order_id" value="<?php echo $order_no;?>"/>
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
    
    
    
    
    
   
    
    
    <?php if($payment_type=="wallet"){?>
    <form class="register-form" role="form" method="POST" action="{{ route('wallet-balance') }}" id="formID" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="cid" value="<?php echo $order_no;?>">
    <input type="hidden" name="amount" value="<?php echo $amount; ?>">
    <input type="submit" name="submit" value="<?php echo translate( 958, $lang);?>" class="custom-btn customwidth">
    </form>    
    <?php } ?>    
    
    <?php if($payment_type=="paypal"){?>
    <form action="<?php echo $paypal_url; ?>" method="post">

        <!-- Identify your business so that you can collect the payments. -->
        <input type="hidden" name="business" value="<?php echo $paypal_id; ?>">
        
        <!-- Specify a Buy Now button. -->
        <input type="hidden" name="cmd" value="_xclick">
        
        <!-- Specify details about the item that buyers will purchase. -->
        <input type="hidden" name="item_name" value="<?php echo $item_namer;?>">
        <input type="hidden" name="item_number" value="<?php echo $order_no;?>">
        <input type="hidden" name="amount" value="<?php echo $amount; ?>">
        <input type="hidden" name="currency_code" value="<?php echo $currency; ?>">
        
        <!-- Specify URLs -->
        <input type='hidden' name='cancel_return' value='<?php echo $url;?>/cancel'>
		<input type='hidden' name='return' value='<?php echo $url;?>/shop_success/<?php echo $order_no;?>'>
		<input type="submit" name="submit" value="<?php echo translate( 958, $lang);?>" class="custom-btn customwidth">
     
    
    </form>
	<?php } if($payment_type=="stripe"){
		$fprice = $amount * 100;
		?>
        
        <form action="{{ route('stripe_success') }}" method="POST">
	{{ csrf_field() }}
	
	<input type="hidden" name="cid" value="<?php echo $order_no;?>">
	<input type="hidden" name="amount" value="<?php echo $fprice; ?>">
	<input type="hidden" name="currency_code" value="<?php echo $currency; ?>">
	<input type="hidden" name="item_name" value="<?php echo $item_namer;?>">
		<script src="https://checkout.stripe.com/checkout.js" 
		class="stripe-button" 
		<?php if($setts[0]->stripe_mode=="test") { ?>
		data-key="<?php echo $setts[0]->test_publish_key; ?>" <?php } ?>
		<?php if($setts[0]->stripe_mode=="live") {  ?>
		data-key="<?php echo $setts[0]->live_publish_key; ?>" 
		<?php }?> 
		data-image="<?php echo $url.'/local/images/media/settings/'.$setts[0]->site_logo;?>" 
		data-name="<?php echo $item_namer;?>" 
		data-description="<?php echo $setts[0]->site_name;?>"
		data-amount="<?php echo $fprice; ?>"
		data-currency="<?php echo $currency; ?>"
		/>
		</script>
	</form>
	<?php } ?>
    
    
    <?php  if($payment_type=="localbank"){  ?>
     <form class="register-form" role="form" method="POST" action="{{ route('localbank') }}" id="formID" enctype="multipart/form-data">
    {{ csrf_field() }}
    <input type="hidden" name="cid" value="<?php echo $order_no;?>">
     <input type="hidden" name="amount" value="<?php echo $amount; ?>">
    <input type="submit" name="submit" value="<?php echo translate( 958, $lang);?>" class="custom-btn customwidth">
    
    </form>
    
    <?php } ?>
    
    
        <div class="clear height50"></div>
    </div>
     
     
     </div>
	
	
	
	
	
	
	
	</div>
</div>
<div class="clearfix"></div>
</main>
	

	
	
      @include('footer')
</body>
</html>