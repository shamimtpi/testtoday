<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

use File;
use Image;
use Mail;
use Carbon\Carbon;
use PaytmWallet;
use URL;
use Cookie;

class PaytmController extends Controller
{
    
	
	
	public function call_translate($id,$lang) 
   {
   
    $default = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
     
   					
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
	
	public function featureCallback(Request $request)
    {
        
		$default = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
		
		
		
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
	  
	  
	  
		
		
		include(app_path() . '/Paytm/encdec_paytm.php');
		$data = $request->all();
		$paytmChecksum = "";
		$paramList = array();
		$isValidChecksum = "FALSE";
		
		
		$paytmChecksum = isset($data["CHECKSUMHASH"]) ? $data["CHECKSUMHASH"] : ""; 
		$isValidChecksum = verifychecksum_e($paramList, $paytm_merchant_key, $paytmChecksum);
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
       
	   
	   

        if ($data["STATUS"] == "TXN_SUCCESS") 
		{
          
           $token = $data["ORDERID"];
		   $txt_details = $data['TXNID'];
		   
		   
		  
		
		
		
		
		 $featured_days = $setts[0]->featured_days;
		$featured_price = $setts[0]->featured_price;
		$payment_type="paytm";
	$get_record = DB::table('products')
				  ->where('item_token', '=', $token)
				  ->get();
	
	$start_date = date("Y-m-d");
	$end_date = date('Y-m-d', strtotime(' + '.$featured_days.' days'));
	
	
	$orderupdate = DB::table('products')
						->where('item_token', '=', $token)
						
						->update(['item_featured' => 1, 'featured_startdate' => $start_date, 'featured_enddate' => $end_date, 'featured_days' => $featured_days,      'featured_price' => $featured_price, 'featured_payment_type' => $payment_type, 'featured_payment_key' => $txt_details, 'featured_payment_status' => 'paid']);
		 
	
		
	  $user_details = DB::table('users')
              
			       ->where('id', '=', $get_record[0]->user_id)
			   
                   ->get();	   
				   
				   				
						
				$order_id = $token;
				$name = $user_details[0]->name;
				$email = $user_details[0]->email;
				$phone = $user_details[0]->phone;			
				$amount = $featured_price;
	  
	  		
				
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/media/settings/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		
		$aid=1;
		$admindetails = DB::table('users')
		 ->where('id', '=', $aid)
		 ->first();
		
		$admin_email = $admindetails->email;
		
		
		
		$datas = [
            'site_logo' => $site_logo, 'site_name' => $site_name, 'name' => $name,  'email' => $email, 'phone' => $phone, 'amount' => $amount, 'url' => $url, 'order_id' => $order_id, 'featured_days' => $featured_days
        ];
		
		
		
		$check_sett_sname = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->count();
		if(!empty($check_sett_sname))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->get();
			$sett_sender_name = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_sender_name = "";
			}	
		}
		else
		{
		  $sett_sender_name = "";
		}
		
		
		
		
		
		$check_sett_semail = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->count();
		if(!empty($check_sett_semail))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->get();
			$sett_sender_email = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_sender_email = "";
			}	
		}
		else
		{
		  $sett_sender_email = "";
		}
		
		
		
		
		
		Mail::send('featured_email', $datas , function ($message) use ($admin_email,$email,$sett_sender_name,$sett_sender_email,$lang)
        {
            $message->subject($this->call_translate( 1030, $lang));
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($sett_sender_email);

        }); 
		
		
		
		
		Mail::send('featured_email', $datas , function ($message) use ($admin_email,$email,$sett_sender_name,$sett_sender_email,$lang)
        {
            $message->subject($this->call_translate( 1030, $lang));
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($email);

        }); 
		
		 
		 
		 
		 
		  
		$dataa = array('txt_details' => $txt_details);
		return view('paytm_shop_success')->with($dataa);
		
		  
		  
		  
		  
		  
         
        }
		else 
		{
          
         return view('cancel');
        }
		 
		   
		   
		   
       
		
		
		
	}	
	
	
	public function featured_order_details(Request $request)
    {
	
	
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
	  
	  
	  
	
	
	   $url = URL::to("/");
        $data = $request->all();
		
		if($paytm_mode=="TEST")
		{
		  $PAYTM_STATUS_QUERY_NEW_URL='https://securegw-stage.paytm.in/merchant-status/getTxnStatus';
          $PAYTM_TXN_URL='https://securegw-stage.paytm.in/theia/processTransaction';
		}
		else
		{
		  $PAYTM_STATUS_QUERY_NEW_URL='https://securegw.paytm.in/merchant-status/getTxnStatus';
	      $PAYTM_TXN_URL='https://securegw.paytm.in/theia/processTransaction';
		}
		
		
		include(app_path() . '/Paytm/encdec_paytm.php');
		
		
		    $checkSum = "";
			$paramList = array();
			
			$ORDER_ID = $data["ORDER_ID"];
			$CUST_ID = $data["CUST_ID"];
			$INDUSTRY_TYPE_ID = $data["INDUSTRY_TYPE_ID"];
			$CHANNEL_ID = $data["CHANNEL_ID"];
			$TXN_AMOUNT = $data["TXN_AMOUNT"];
			
			
			$paramList["MID"] = $paytm_merchant_id;
			$paramList["ORDER_ID"] = $ORDER_ID;
			$paramList["CUST_ID"] = $CUST_ID;
			$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
			$paramList["CHANNEL_ID"] = $CHANNEL_ID;
			$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
			$paramList["WEBSITE"] = $paytm_merchant_website;
			
			$paramList["CALLBACK_URL"] = $url."/sampleResponse/status";
			
			
			$checkSum = getChecksumFromArray($paramList,$paytm_merchant_key);
			
			$formdata = '<form method="post" action="'.$PAYTM_TXN_URL.'" name="f2">';
		    $formdata .='<input type="hidden" name="_token" value="8lksLPtKKNxPjKWuSU3bzb1GyhJIMr2BojH9WdrL">';

			
			foreach($paramList as $name => $value) {
				$formdata .= '<input type="hidden" name="' . $name .'" value="' . $value . '">';
			}
			
			$formdata .= '<input type="hidden" name="CHECKSUMHASH" value="'.$checkSum.'">
			
			<script type="text/javascript">
                document.f2.submit();
            </script>
             </form>';
			return $formdata;
			
		
		
	
	
	}
	
	
	
	
	
	
	
	public function order_details(Request $request)
    {
	
	
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
	  
	  
	  
	
	
	   $url = URL::to("/");
        $data = $request->all();
		
		if($paytm_mode=="TEST")
		{
		  $PAYTM_STATUS_QUERY_NEW_URL='https://securegw-stage.paytm.in/merchant-status/getTxnStatus';
          $PAYTM_TXN_URL='https://securegw-stage.paytm.in/theia/processTransaction';
		}
		else
		{
		  $PAYTM_STATUS_QUERY_NEW_URL='https://securegw.paytm.in/merchant-status/getTxnStatus';
	      $PAYTM_TXN_URL='https://securegw.paytm.in/theia/processTransaction';
		}
		
		
		include(app_path() . '/Paytm/encdec_paytm.php');
		
		
		    $checkSum = "";
			$paramList = array();
			
			$ORDER_ID = $data["ORDER_ID"];
			$CUST_ID = $data["CUST_ID"];
			$INDUSTRY_TYPE_ID = $data["INDUSTRY_TYPE_ID"];
			$CHANNEL_ID = $data["CHANNEL_ID"];
			$TXN_AMOUNT = $data["TXN_AMOUNT"];
			
			
			$paramList["MID"] = $paytm_merchant_id;
			$paramList["ORDER_ID"] = $ORDER_ID;
			$paramList["CUST_ID"] = $CUST_ID;
			$paramList["INDUSTRY_TYPE_ID"] = $INDUSTRY_TYPE_ID;
			$paramList["CHANNEL_ID"] = $CHANNEL_ID;
			$paramList["TXN_AMOUNT"] = $TXN_AMOUNT;
			$paramList["WEBSITE"] = $paytm_merchant_website;
			
			$paramList["CALLBACK_URL"] = $url."/pgResponse/status";
			
			
			$checkSum = getChecksumFromArray($paramList,$paytm_merchant_key);
			
			$formdata = '<form method="post" action="'.$PAYTM_TXN_URL.'" name="f1">';
		    $formdata .='<input type="hidden" name="_token" value="8lksLPtKKNxPjKWuSU3bzb1GyhJIMr2BojH9WdrL">';

			
			foreach($paramList as $name => $value) {
				$formdata .= '<input type="hidden" name="' . $name .'" value="' . $value . '">';
			}
			
			$formdata .= '<input type="hidden" name="CHECKSUMHASH" value="'.$checkSum.'">
			
			<script type="text/javascript">
                document.f1.submit();
            </script>
             </form>';
			return $formdata;
			
		
		
	
	
	}
	
	
	
	
	/*public function order(Request $request)
    {


        $this->validate($request, [
            'name' => 'required',
            'mobile_number' => 'required',
            
        ]);

        $url = URL::to("/");
        $data = $request->all();
        $order_id = $data['order_id'];
		$name = $data['name'];
		$mobile_number = $data['mobile_number'];
        $amount = $data['amount'];
		$email = $data['email'];
		$currency = $data['currency'];


        


        $payment = PaytmWallet::with('receive');
        $payment->prepare([
          'order' => $order_id,
		  'user' => $name,
          'mobile_number' => $mobile_number,
		  'currency' => $currency,
          'email' => $email,
          'amount' => $amount,
          'callback_url' => $url.'/paytm/status'
        ]);
        return $payment->receive();
    }
	*/
	
	
	
	 public function paymentCallback(Request $request)
    {
        
		$default = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->get();


$default_cnt = DB::table('codepopular_langs')
	              ->where('lang_default','=',1)
		           ->count();
if(!empty(Cookie::get('lang'))){ $lang = Cookie::get('lang'); } else { if(!empty($default_cnt)){ $lang = $default[0]->lang_code; } else { $lang = "en"; } }
		
		
		
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
	  
	  
	  
		
		
		include(app_path() . '/Paytm/encdec_paytm.php');
		$data = $request->all();
		$paytmChecksum = "";
		$paramList = array();
		$isValidChecksum = "FALSE";
		
		
		$paytmChecksum = isset($data["CHECKSUMHASH"]) ? $data["CHECKSUMHASH"] : ""; 
		$isValidChecksum = verifychecksum_e($paramList, $paytm_merchant_key, $paytmChecksum);
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
       
	   
	   

        if ($data["STATUS"] == "TXN_SUCCESS") 
		{
          
           $cid = $data["ORDERID"];
		   $txt_details = $data['TXNID'];
          
		  $orderupdate = DB::table('product_orders')
						->where('purchase_token', '=', $cid)
						->where('status', '=', 'pending')
						->update(['status' => 'completed']);
		 $checkoutupdate = DB::table('product_checkouts')
						->where('purchase_token', '=', $cid)
						->where('payment_status', '=', 'pending')
						->update(['payment_status' => 'completed']);
		
		
		$get_viewr = DB::table('product_orders')
		->where('purchase_token', '=', $cid)
		->where('status', '=', 'completed')
		->count();
		
		
		
		$view_orders = DB::table('product_orders')
						->where('purchase_token', '=', $cid)
						->where('status', '=', 'completed')
						->get();
		
		foreach($view_orders as $views)
		{
		
		$ord_id = $views->ord_id;
		
		$start_date = date("Y-m-d");
		if($views->licence_type=="regular_price_six_month")
		{
		   $end_date = date('Y-m-d', strtotime('+6 month'));
		}
		else if($views->licence_type=="regular_price_one_year")
		{
		   $end_date = date('Y-m-d', strtotime('+12 month'));
		}
		else if($views->licence_type=="extended_price_six_month")
		{
		   $end_date = date('Y-m-d', strtotime('+6 month'));
		}
		else if($views->licence_type=="extended_price_one_year")
		{
		   $end_date = date('Y-m-d', strtotime('+12 month'));
		}
		
		
		DB::update('update product_orders set payment_type="paytm",license_start_date="'.$start_date.'",license_end_date="'.$end_date.'",payment_token="'.$txt_details.'" where status="completed" and ord_id = ?', [$ord_id]);
		
		
		
		
		/* payment approval */
		
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
	  
		
		
		if($payment_website == "no")
		{
		
		
		$view_orders = DB::table('product_orders')->where('ord_id','=',$ord_id)->get();
	  
		  if(empty($view_orders[0]->approval_status))
		  {
		  
		  $buyer_id = $view_orders[0]->user_id;
						  $buyer_details = DB::table('users')->where('id','=',$buyer_id)->get();
						  
						  $vendor_id = $view_orders[0]->item_user_id;
						  $vendor_details = DB::table('users')->where('id','=',$vendor_id)->get();
						  
						  $vendor_balance = $vendor_details[0]->wallet;
						  $vendor_amount = $view_orders[0]->vendor_amount;
						  
						  $total_vendor = $vendor_balance + $vendor_amount;
						  
						DB::update('update users set wallet="'.$total_vendor.'" where id = ?', [$vendor_id]); 
						
						$aid=1;
			$admindetails = DB::table('users')
			 ->where('id', '=', $aid)
			 ->first();
						
						$admin_balance =  $admindetails->wallet;
						$admin_amount = $view_orders[0]->admin_amount;
						
						$total_admin = $admin_balance + $admin_amount;
						
						DB::update('update users set wallet="'.$total_admin.'" where id = ?', [1]);
						
						
						DB::update('update product_orders set approval_status="payment released to vendor" where ord_id = ?', [$ord_id]);  
						
					$purchase_id = $view_orders[0]->purchase_token;	
						
						
			$setid=1;
			$setts = DB::table('settings')
			->where('id', '=', $setid)
			->get();
			
			$url = URL::to("/");
			
			$site_logo=$url.'/local/images/media/settings/'.$setts[0]->site_logo;
			
			$site_name = $setts[0]->site_name;
			
			
			
			
			$admin_email = $admindetails->email;
			$admin_name = $admindetails->name;
			
			$vendor_email = $vendor_details[0]->email;
			
			
			
			
			$check_sett_sname = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->count();
		if(!empty($check_sett_sname))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->get();
			$sett_sender_name = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_sender_name = "";
			}	
		}
		else
		{
		  $sett_sender_name = "";
		}
		
		
		
		
		
		$check_sett_semail = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->count();
		if(!empty($check_sett_semail))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->get();
			$sett_sender_email = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_sender_email = "";
			}	
		}
		else
		{
		  $sett_sender_email = "";
		}
		
		
			
			
			
			$datas = [
				'vendor_email' => $vendor_email, 'url' => $url,  'site_logo' => $site_logo, 'site_name' => $site_name, 'admin_name' => $admin_name, 'purchase_id' => $purchase_id, 'ord_id' => $ord_id
			];
			
			Mail::send('admin.item_payment_approval', $datas , function ($message) use ($admin_email,$admin_name,$vendor_email,$sett_sender_name,$sett_sender_email,$lang)
			{
				$message->subject($this->call_translate( 1060, $lang));
				
				$message->from($sett_sender_email, $sett_sender_name);
	
				$message->to($vendor_email);
	
			}); 
						
						  
						  
		
		
		}
		else
		{
		   
		
		}
			
	}	
		
		
		/* payment approval */
		
		
		
		
		
		
		
		
		
		
		
		}				
		
							
						
		$get_details = DB::table('product_checkouts')
              
			       ->where('purchase_token', '=', $cid)
			   
                   ->get();
				   
			$user_details = DB::table('users')
              
			       ->where('id', '=', $get_details[0]->user_id)
			   
                   ->get();	   
				   
				   				
						
				$order_id = $cid;
				$name = $user_details[0]->name;
				$email = $user_details[0]->email;
				$phone = $user_details[0]->phone;			
				$amount = $get_details[0]->total;
				
				
						
		
		$setid=1;
		$setts = DB::table('settings')
		->where('id', '=', $setid)
		->get();
		
		$url = URL::to("/");
		
		$site_logo=$url.'/local/images/media/settings/'.$setts[0]->site_logo;
		
		$site_name = $setts[0]->site_name;
		
		
		$aid=1;
		$admindetails = DB::table('users')
		 ->where('id', '=', $aid)
		 ->first();
		
		$admin_email = $admindetails->email;
		
		
		
		
		$check_sett_sname = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->count();
		if(!empty($check_sett_sname))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 22)
				->where('sett_meta_key', '=' , "sender_name")
		        
				->get();
			$sett_sender_name = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_sender_name = "";
			}	
		}
		else
		{
		  $sett_sender_name = "";
		}
		
		
		
		
		
		$check_sett_semail = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->count();
		if(!empty($check_sett_semail))
		{
		   
		    $sett_meta_well = DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->count();
				
			if(!empty($sett_meta_well))
			{	
		   $sett_meta =  DB::table('settings_metas')
		        ->where('sett_meta_id', '=' , 23)
				->where('sett_meta_key', '=' , "sender_email")
		        
				->get();
			$sett_sender_email = $sett_meta[0]->sett_meta_value;
			}
			else
			{
			$sett_sender_email = "";
			}	
		}
		else
		{
		  $sett_sender_email = "";
		}
		
		
			
		
		
		$datas = [
            'site_logo' => $site_logo, 'site_name' => $site_name, 'name' => $name,  'email' => $email, 'phone' => $phone, 'amount' => $amount, 'url' => $url, 'order_id' => $order_id
        ];
		
		Mail::send('shop_email', $datas , function ($message) use ($admin_email,$email,$sett_sender_name,$sett_sender_email,$lang)
        {
            $message->subject($this->call_translate( 1063, $lang));
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($sett_sender_email);

        }); 
		
		
		
		
		Mail::send('shop_email', $datas , function ($message) use ($admin_email,$email,$sett_sender_name,$sett_sender_email,$lang)
        {
            $message->subject($this->call_translate( 1063, $lang));
			
            $message->from($sett_sender_email, $sett_sender_name);

            $message->to($email);

        }); 
		
			
			
				
		
		
		$dataa = array('txt_details' => $txt_details);
		return view('paytm_shop_success')->with($dataa);
		
		  
		  
		  
		  
		  
         
        }
		else 
		{
          
         return view('cancel');
        }
		
		
	
	
		
		
} 
	
	
	
	
	
	public function paytm_success($txt_details)
	{
	   
	 
	 $dataa = array('txt_details' => $txt_details);
	return view('paytm_shop_success')->with($dataa);
	
	}
	
	
	
}
