<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use File;
use Image;


class PaymentsettingsController extends Controller
{
    
   

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }
    
	
	public function showform() {
      $msettings = DB::select('select * from settings where id = ?',[1]);
	  
	   $withdraw=array("paypal","stripe","localbank","paytm","perfectmoney");
	  $payment=array("paypal","stripe","wallet","razorpay","paytm","2checkout","payu","perfectmoney", "localbank");
	  
	  
	  
	  $check_sett_ref = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 5)
				->where('sett_meta_key', '=' , "referral_amount")
		        
				->count();
		if(!empty($check_sett_ref))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 5)
				->where('sett_meta_key', '=' , "referral_amount")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 5)
				->where('sett_meta_key', '=' , "referral_amount")
		        
				->get();
			$referral_amount = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$referral_amount = 0;
			}	
		}
		else
		{
		  $referral_amount = 0;
		}
	  
	  
	  $check_sett_razor = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 6)
				->where('sett_meta_key', '=' , "razorpay_key_id")
		        
				->count();
		if(!empty($check_sett_razor))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 6)
				->where('sett_meta_key', '=' , "razorpay_key_id")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 6)
				->where('sett_meta_key', '=' , "razorpay_key_id")
		        
				->get();
			$sett_razor_item = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_razor_item = "";
			}	
		}
		else
		{
		  $sett_razor_item = "";
		}
		
		
	  
	  
	  $check_secret_razor = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 7)
				->where('sett_meta_key', '=' , "razorpay_key_secret")
		        
				->count();
		if(!empty($check_secret_razor))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 7)
				->where('sett_meta_key', '=' , "razorpay_key_secret")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 7)
				->where('sett_meta_key', '=' , "razorpay_key_secret")
		        
				->get();
			$sett_razor_secret = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_razor_secret = "";
			}	
		}
		else
		{
		  $sett_razor_secret = "";
		}
		
	  
	  
	  
	  
	  
	  $check_mode_paytm = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 8)
				->where('sett_meta_key', '=' , "paytm_mode")
		        
				->count();
		if(!empty($check_mode_paytm))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 8)
				->where('sett_meta_key', '=' , "paytm_mode")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 8)
				->where('sett_meta_key', '=' , "paytm_mode")
		        
				->get();
			$paytm_mode = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$paytm_mode = "";
			}	
		}
		else
		{
		  $paytm_mode = "";
		}
	  
	  
	  
	  
	    $check_merchant_key = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 9)
				->where('sett_meta_key', '=' , "paytm_merchant_key")
		        
				->count();
		if(!empty($check_merchant_key))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 9)
				->where('sett_meta_key', '=' , "paytm_merchant_key")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 9)
				->where('sett_meta_key', '=' , "paytm_merchant_key")
		        
				->get();
			$paytm_merchant_key = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$paytm_merchant_key = "";
			}	
		}
		else
		{
		  $paytm_merchant_key = "";
		}
	  
	  
	  
	  
	  
	  
	  $check_merchant_id = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 10)
				->where('sett_meta_key', '=' , "paytm_merchant_id")
		        
				->count();
		if(!empty($check_merchant_id))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 10)
				->where('sett_meta_key', '=' , "paytm_merchant_id")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 10)
				->where('sett_meta_key', '=' , "paytm_merchant_id")
		        
				->get();
			$paytm_merchant_id = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$paytm_merchant_id = "";
			}	
		}
		else
		{
		  $paytm_merchant_id = "";
		}
	  
	  
	  
	  
	  $check_merchant_website = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 11)
				->where('sett_meta_key', '=' , "paytm_merchant_website")
		        
				->count();
		if(!empty($check_merchant_website))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 11)
				->where('sett_meta_key', '=' , "paytm_merchant_website")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 11)
				->where('sett_meta_key', '=' , "paytm_merchant_website")
		        
				->get();
			$paytm_merchant_website = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$paytm_merchant_website = "";
			}	
		}
		else
		{
		  $paytm_merchant_website = "";
		}
	  
	  
	  
	  
	  
	  $check_payment_website = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 20)
				->where('sett_meta_key', '=' , "payment_approval")
		        
				->count();
		if(!empty($check_payment_website))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 20)
				->where('sett_meta_key', '=' , "payment_approval")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 20)
				->where('sett_meta_key', '=' , "payment_approval")
		        
				->get();
			$payment_website = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$payment_website = "";
			}	
		}
		else
		{
		  $payment_website = "";
		}
	  
	  
	  /* 2checkout */
	  
	  
	  $check_2checkout = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 30)
				->where('sett_meta_key', '=' , "two_checkout_mode")
		        
				->count();
		if(!empty($check_2checkout))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 30)
				->where('sett_meta_key', '=' , "two_checkout_mode")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 30)
				->where('sett_meta_key', '=' , "two_checkout_mode")
		        
				->get();
			$two_checkout_mode = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$two_checkout_mode = "";
			}	
		}
		else
		{
		  $two_checkout_mode = "";
		}
		
		
		
		
		
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
		
		
		
		
		
		$check_2checkout_private = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 33)
				->where('sett_meta_key', '=' , "two_checkout_private")
		        
				->count();
		if(!empty($check_2checkout_private))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 33)
				->where('sett_meta_key', '=' , "two_checkout_private")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 33)
				->where('sett_meta_key', '=' , "two_checkout_private")
		        
				->get();
			$two_checkout_private = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$two_checkout_private = "";
			}	
		}
		else
		{
		  $two_checkout_private = "";
		}
		
	 /* 2checkout */	
	  
	  
	  
	  
	  
	  /* payu */
	 
	 
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
	  
	  /* payu */
	  
	  
	  
	  
	  /* new */		 
				 
		$check_sett_code = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 73)
				->where('sett_meta_key', '=' , "cc_token")
		        
				->count();
		if(!empty($check_sett_code))
		{
		   
		    $sett_meta_well_four = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 73)
				->where('sett_meta_key', '=' , "cc_token")
		        
				->count();
				
			if(!empty($sett_meta_well_four))
			{	
		   $sett_meta_four =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 73)
				->where('sett_meta_key', '=' , "cc_token")
		        
				->get();
			$code_feedback = $sett_meta_four[0]->sett_meta_value;
			}
			else
			{
			$code_feedback = "";
			}	
		}
		else
		{
		  $code_feedback = "";
		}
		
		
		
		$check_sett_byname = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 74)
				->where('sett_meta_key', '=' , "cc_byname")
		        
				->count();
		if(!empty($check_sett_byname))
		{
		   
		    $sett_meta_well_four = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 74)
				->where('sett_meta_key', '=' , "cc_byname")
		        
				->count();
				
			if(!empty($sett_meta_well_four))
			{	
		   $sett_meta_four =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 74)
				->where('sett_meta_key', '=' , "cc_byname")
		        
				->get();
			$cc_byname = $sett_meta_four[0]->sett_meta_value;
			}
			else
			{
			$cc_byname = "";
			}	
		}
		else
		{
		  $cc_byname = "";
		}
		
		
		
		$purchase_code = base64_decode($code_feedback);
    	$o = $this->verifyPurchase( $purchase_code );
		if ( is_object($o) ) 
		{
		   if($o->buyer== base64_decode($cc_byname) && $o->item_name=="CodePopular Marketplace")
		   {
		      $cany_check_value = 1;
		   }
		   else
		   {
		     $cany_check_value = 0;
		   }
		}
		else
		{
		   $cany_check_value = 0;
		} 
		/* new */
		
		
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
		
		
		/* local bank */
		
		$check_local_name = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 98)
				->where('sett_meta_key', '=' , "bank_details")
		        
				->count();
		if(!empty($check_local_name))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 98)
				->where('sett_meta_key', '=' , "bank_details")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 98)
				->where('sett_meta_key', '=' , "bank_details")
		        
				->get();
			$bank_details = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$bank_details = "";
			}	
		}
		else
		{
		  $bank_details = "";
		}
		
		
		/* local bank */	 
				 
		
	  
		
	  $data=array('msettings'=>$msettings, 'withdraw' => $withdraw, 'payment' => $payment, 'referral_amount' => $referral_amount, 'sett_razor_item' => $sett_razor_item, 'sett_razor_secret' => $sett_razor_secret, 'paytm_mode' => $paytm_mode, 'paytm_merchant_key' => $paytm_merchant_key, 'paytm_merchant_id' => $paytm_merchant_id, 'paytm_merchant_website' => $paytm_merchant_website, 'payment_website' => $payment_website, 'two_checkout_mode' => $two_checkout_mode, 'two_checkout_account' => $two_checkout_account, 'two_checkout_publishable' => $two_checkout_publishable, 'two_checkout_private' => $two_checkout_private, 'payu_mode' => $payu_mode, 'payu_merchant_key' => $payu_merchant_key, 'payu_salt' => $payu_salt, 'cany_check_value' => $cany_check_value, 'perfectmoney_id' => $perfectmoney_id, 'perfectmoney_name' => $perfectmoney_name, 'bank_details' => $bank_details);
      return view('admin.payment-settings')->with($data);
   }
   
   
   /* new */
	
	public function getPurchaseData( $code ) {
	
	$bearer = "M0yOfwFBnujwQt4KgVNuHiLDn7si9ExH";
      
      
      $bearer   = 'bearer ' . $bearer;
      $header   = array();
      $header[] = 'Content-length: 0';
      $header[] = 'Content-type: application/json; charset=utf-8';
      $header[] = 'Authorization: ' . $bearer;
      
      $verify_url = 'https://api.envato.com/v1/market/private/user/verify-purchase:'.$code.'.json';
      $ch_verify = curl_init( $verify_url . '?code=' . $code );
      
      curl_setopt( $ch_verify, CURLOPT_HTTPHEADER, $header );
      curl_setopt( $ch_verify, CURLOPT_SSL_VERIFYPEER, false );
      curl_setopt( $ch_verify, CURLOPT_RETURNTRANSFER, 1 );
      curl_setopt( $ch_verify, CURLOPT_CONNECTTIMEOUT, 5 );
      curl_setopt( $ch_verify, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
      
      $cinit_verify_data = curl_exec( $ch_verify );
      curl_close( $ch_verify );
      
      if ($cinit_verify_data != "")    
        return json_decode($cinit_verify_data);  
      else
        return false;
        
    }
    
    public function verifyPurchase( $code ) {
      $verify_obj = self::getPurchaseData($code); 
      
      
      if ( 
          (false === $verify_obj) || 
          !is_object($verify_obj) ||
          !isset($verify_obj->{"verify-purchase"}) ||
          !isset($verify_obj->{"verify-purchase"}->item_name)
      )
        return -1;

      
      if (
        $verify_obj->{"verify-purchase"}->supported_until == "" ||
        $verify_obj->{"verify-purchase"}->supported_until != null
      )
        return $verify_obj->{"verify-purchase"};  
      
      
      return 0;
      
    }
	
	/* new */
    	
	
	
    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users'
            
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
	 
	  protected $fillable = ['name', 'email','password','phone'];
	 
    protected function editsettings(Request $request)
    {
       
		
		
		
		
         
		 $data = $request->all();
			
         
		
		
		
		 $rules = array(
               
		
		
		
        );
		
		$messages = array(
            
           
			
        );
		
		$validator = Validator::make($request->all(), $rules, $messages);
		
		
		
		if ($validator->fails())
		{
			$failedRules = $validator->failed();
			 
			return back()->withErrors($validator);
		}
		else
		{ 
		
		
		
		
		
		
		
		if(!empty($data['with_submit_product']))
		{
			$with_submit_product=$data['with_submit_product'];
		}
		else
		{
			$with_submit_product=0;
		}
		
		
		
		if(!empty($data['withdraw_opt']))
		{
		$withdraw_opt="";
		foreach($data['withdraw_opt'] as $with)
		{
			$withdraw_opt .=$with.",";
		}
		$withdraw = rtrim($withdraw_opt,",");
		}
		else
		{
		$withdraw = "";
		}
		
		
		if(!empty($data['payment_opt']))
		{
		$payment_opt="";
		foreach($data['payment_opt'] as $with)
		{
			$payment_opt .=$with.",";
		}
		$payment = rtrim($payment_opt,",");
		}
		else
		{
		$payment = "";
		}
		
		$paypal_id = $data['paypal_id'];
		$paypal_url = $data['paypal_url'];
		$stripe_mode = $data['stripe_mode'];
		$test_publish_key = $data['test_publish_key'];
		$test_secret_key = $data['test_secret_key'];
		$live_publish_key = $data['live_publish_key'];
		$live_secret_key = $data['live_secret_key'];
		
		$commission_mode=$data['commission_mode'];
		$commission_amt=$data['commission_amt'];
		$withdraw_amt=$data['withdraw_amt'];
		
		$processing_fee = $data['processing_fee'];
		
		$featured_price = $data['featured_price'];
		$featured_days = $data['featured_days'];
		
		if(!empty($data['refund_time_limit']))
		{
		  $refund_time_limit =  $data['refund_time_limit'];
		}
		else
		{
		   $refund_time_limit = 0;
		}
		
		
		
		if($data['referral_amount']!="")
		{
		
		   $check_user_meta =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 5)
				                ->where('sett_meta_key', '=' , 'referral_amount')
		                        ->count();
			if(!empty($check_user_meta))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['referral_amount'].'" where sett_meta_key="referral_amount" and sett_meta_id = ?', [5]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [5,"referral_amount",$data['referral_amount']]);
			
			}					
		
		  
		}
		
		
		
		
		if($data['razorpay_key_id']!="")
		{
		
		   $check_user_razor =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 6)
				                ->where('sett_meta_key', '=' , 'razorpay_key_id')
		                        ->count();
			if(!empty($check_user_razor))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['razorpay_key_id'].'" where sett_meta_key="razorpay_key_id" and sett_meta_id = ?', [6]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [6,"razorpay_key_id",$data['razorpay_key_id']]);
			
			}					
		
		  
		}
		
		
		
		
		if($data['razorpay_key_secret']!="")
		{
		
		   $check_user_razor =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 7)
				                ->where('sett_meta_key', '=' , 'razorpay_key_secret')
		                        ->count();
			if(!empty($check_user_razor))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['razorpay_key_secret'].'" where sett_meta_key="razorpay_key_secret" and sett_meta_id = ?', [7]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [7,"razorpay_key_secret",$data['razorpay_key_secret']]);
			
			}					
		
		  
		}
		
		
		
		
		
		
		
		if($data['paytm_mode']!="")
		{
		
		   $check_user_paytm =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 8)
				                ->where('sett_meta_key', '=' , 'paytm_mode')
		                        ->count();
			if(!empty($check_user_paytm))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['paytm_mode'].'" where sett_meta_key="paytm_mode" and sett_meta_id = ?', [8]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [8,"paytm_mode",$data['paytm_mode']]);
			
			}					
		
		  
		}
		
		
		
		
		
		if($data['paytm_merchant_key']!="")
		{
		
		   $check_user_paytm =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 9)
				                ->where('sett_meta_key', '=' , 'paytm_merchant_key')
		                        ->count();
			if(!empty($check_user_paytm))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['paytm_merchant_key'].'" where sett_meta_key="paytm_merchant_key" and sett_meta_id = ?', [9]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [9,"paytm_merchant_key",$data['paytm_merchant_key']]);
			
			}					
		
		  
		}
		
		
		
		
		
		if($data['paytm_merchant_id']!="")
		{
		
		   $check_user_paytm =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 10)
				                ->where('sett_meta_key', '=' , 'paytm_merchant_id')
		                        ->count();
			if(!empty($check_user_paytm))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['paytm_merchant_id'].'" where sett_meta_key="paytm_merchant_id" and sett_meta_id = ?', [10]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [10,"paytm_merchant_id",$data['paytm_merchant_id']]);
			
			}					
		
		  
		}
		
		
		
		
		
		if($data['paytm_merchant_website']!="")
		{
		
		   $check_user_paytm =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 11)
				                ->where('sett_meta_key', '=' , 'paytm_merchant_website')
		                        ->count();
			if(!empty($check_user_paytm))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['paytm_merchant_website'].'" where sett_meta_key="paytm_merchant_website" and sett_meta_id = ?', [11]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [11,"paytm_merchant_website",$data['paytm_merchant_website']]);
			
			}					
		
		  
		}
		
		
		
		
		
		if($data['payment_approval']!="")
		{
		
		   $check_user_payment =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 20)
				                ->where('sett_meta_key', '=' , 'payment_approval')
		                        ->count();
			if(!empty($check_user_payment))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['payment_approval'].'" where sett_meta_key="payment_approval" and sett_meta_id = ?', [20]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [20,"payment_approval",$data['payment_approval']]);
			
			}					
		
		  
		}
		
		
		
		
		
		if($data['two_checkout_mode']!="")
		{
		
		   $check_user_payment =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 30)
				                ->where('sett_meta_key', '=' , 'two_checkout_mode')
		                        ->count();
			if(!empty($check_user_payment))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['two_checkout_mode'].'" where sett_meta_key="two_checkout_mode" and sett_meta_id = ?', [30]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [30,"two_checkout_mode",$data['two_checkout_mode']]);
			
			}					
		
		  
		}
		
		
		
		
		if($data['two_checkout_account']!="")
		{
		
		   $check_user_payment =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 31)
				                ->where('sett_meta_key', '=' , 'two_checkout_account')
		                        ->count();
			if(!empty($check_user_payment))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['two_checkout_account'].'" where sett_meta_key="two_checkout_account" and sett_meta_id = ?', [31]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [31,"two_checkout_account",$data['two_checkout_account']]);
			
			}					
		
		  
		}
		
		
		
		if($data['two_checkout_publishable']!="")
		{
		
		   $check_user_payment =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 32)
				                ->where('sett_meta_key', '=' , 'two_checkout_publishable')
		                        ->count();
			if(!empty($check_user_payment))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['two_checkout_publishable'].'" where sett_meta_key="two_checkout_publishable" and sett_meta_id = ?', [32]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [32,"two_checkout_publishable",$data['two_checkout_publishable']]);
			
			}					
		
		  
		}
		
		
		
		
		if($data['two_checkout_private']!="")
		{
		
		   $check_user_payment =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 33)
				                ->where('sett_meta_key', '=' , 'two_checkout_private')
		                        ->count();
			if(!empty($check_user_payment))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['two_checkout_private'].'" where sett_meta_key="two_checkout_private" and sett_meta_id = ?', [33]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [33,"two_checkout_private",$data['two_checkout_private']]);
			
			}					
		
		  
		}
		
		
		
		
		
		
		
		/* payu */
		
		
		if($data['payu_mode']!="")
		{
		
		   $check_user_payment =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 60)
				                ->where('sett_meta_key', '=' , 'payu_mode')
		                        ->count();
			if(!empty($check_user_payment))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['payu_mode'].'" where sett_meta_key="payu_mode" and sett_meta_id = ?', [60]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [60,"payu_mode",$data['payu_mode']]);
			
			}					
		
		  
		}
		
		
		
		
		if($data['payu_merchant_key']!="")
		{
		
		   $check_user_payment =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 61)
				                ->where('sett_meta_key', '=' , 'payu_merchant_key')
		                        ->count();
			if(!empty($check_user_payment))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['payu_merchant_key'].'" where sett_meta_key="payu_merchant_key" and sett_meta_id = ?', [61]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [61,"payu_merchant_key",$data['payu_merchant_key']]);
			
			}					
		
		  
		}
		
		
		
		if($data['payu_salt']!="")
		{
		
		   $check_user_payment =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 62)
				                ->where('sett_meta_key', '=' , 'payu_salt')
		                        ->count();
			if(!empty($check_user_payment))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['payu_salt'].'" where sett_meta_key="payu_salt" and sett_meta_id = ?', [62]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [62,"payu_salt",$data['payu_salt']]);
			
			}					
		
		  
		}
		
		
		/* payu */
		
		
		
		/* perfect money */
		
		if($data['perfectmoney_id']!="")
		{
		
		   $check_user_payment =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 90)
				                ->where('sett_meta_key', '=' , 'perfectmoney_id')
		                        ->count();
			if(!empty($check_user_payment))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['perfectmoney_id'].'" where sett_meta_key="perfectmoney_id" and sett_meta_id = ?', [90]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [90,"perfectmoney_id",$data['perfectmoney_id']]);
			
			}					
		
		  
		}
		
		
		
		if($data['perfectmoney_name']!="")
		{
		
		   $check_user_payment =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 91)
				                ->where('sett_meta_key', '=' , 'perfectmoney_name')
		                        ->count();
			if(!empty($check_user_payment))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['perfectmoney_name'].'" where sett_meta_key="perfectmoney_name" and sett_meta_id = ?', [91]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [91,"perfectmoney_name",$data['perfectmoney_name']]);
			
			}					
		
		  
		}
		
		
		/* perfect money */
		
		
		
		/* local bank */
		
		if($data['bank_details']!="")
		{
		
		   $check_user_payment =  DB::table('settings_metas')
		        				->where('sett_meta_id', '=' , 98)
				                ->where('sett_meta_key', '=' , 'bank_details')
		                        ->count();
			if(!empty($check_user_payment))
			{
			   DB::update('update settings_metas set sett_meta_value="'.$data['bank_details'].'" where sett_meta_key="bank_details" and sett_meta_id = ?', [98]);
			}
			else
			{
			DB::insert('insert into settings_metas (sett_meta_id,sett_meta_key,sett_meta_value) values (?, ?, ?)', [98,"bank_details",$data['bank_details']]);
			
			}					
		
		  
		}
		
		/* local bank */
		
		
		
		
		DB::update('update settings set
		payment_option="'.$payment.'", 
		withdraw_option="'.$withdraw.'",
		paypal_id="'.$paypal_id.'",
		paypal_url="'.$paypal_url.'",
		stripe_mode="'.$stripe_mode.'",
		test_publish_key="'.$test_publish_key.'",
		test_secret_key="'.$test_secret_key.'",
		live_publish_key="'.$live_publish_key.'",
		live_secret_key="'.$live_secret_key.'",
		commission_mode="'.$commission_mode.'",
		commission_amt="'.$commission_amt.'",
		withdraw_amt="'.$withdraw_amt.'",
		processing_fee="'.$processing_fee.'",
		with_submit_product="'.$with_submit_product.'",
		featured_price="'.$featured_price.'",
		featured_days = "'.$featured_days.'",
		refund_time_limit = "'.$refund_time_limit.'"
		where id = ?', [1]);
		
			return back()->with('success', 'Payment Settings has been updated');
       
			
        
		
		}
		
		
    }
}
